<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:32
 */


namespace AI\Common;

use AI\Common\Contracts\AccessTokenInterface;
use AI\Common\Exceptions\HttpException;
use AI\Common\Exceptions\InvalidArgumentException;
use AI\Common\Traits\HasHttpRequests;
use AI\Common\Traits\InteractsWithCache;
use Pimple\Container;
use Psr\Http\Message\RequestInterface;

abstract class AccessToken implements AccessTokenInterface
{
    use HasHttpRequests, InteractsWithCache;

    /**
     * @var \Pimple\Container
     */
    protected $app;

    /**
     * @var string
     */
    protected $requestMethod = 'GET';

    /**
     * @var string
     */
    protected $endpointToGetToken;

    /**
     * @var string
     */
    protected $queryName;

    /**
     * @var array
     */
    protected $token;

    /**
     * @var int
     */
    protected $safeSeconds = 500;

    /**
     * @var string
     */
    protected $tokenKey = 'access_token';

    /**
     * @var string
     */
    protected $cachePrefix = 'hahaxixi.ai.access_token.';

    /**
     * AccessToken constructor.
     *
     * @param \Pimple\Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * @return array
     */
    public function getRefreshedToken()
    {
        return $this->getToken(true);
    }

    /**
     * @param bool $refresh
     *
     * @return array
     */
    public function getToken($refresh = false)
    {
        $cacheKey = $this->getCacheKey();
        $cache = $this->getCache();
        if (!$refresh && $cache->has($cacheKey)) {
            return $cache->get($cacheKey);
        }
        $token = $this->requestToken($this->getCredentials());

        $this->setToken($token[$this->tokenKey], isset($token['expires_in']) ? $token['expires_in'] : 7200);

        return $token;
    }

    /**
     * @param string $token
     * @param int $lifetime
     *
     * @return \AI\Common\AccessToken
     */
    public function setToken($token, $lifetime = 7200)
    {
        $this->getCache()->set($this->getCacheKey(), [
            $this->tokenKey => $token,
            'expires_in' => $lifetime,
        ], $lifetime - $this->safeSeconds);

        return $this;
    }

    /**
     * @return \AI\Common\Contracts\AccessTokenInterface
     */
    public function refresh()
    {
        $this->getToken(true);

        return $this;
    }

    /**
     * @param array $credentials
     *
     * @return array
     *
     * @throws \AI\Common\Exceptions\HttpException
     */
    public function requestToken(array $credentials)
    {
        $result = json_decode($this->sendRequest($credentials)->getBody()->getContents(), true);

        if (empty($result[$this->tokenKey])) {
            throw new HttpException('Request access_token fail: ' . json_encode($result, JSON_UNESCAPED_UNICODE));
        }

        return $result;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array $requestOptions
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function applyToRequest(RequestInterface $request, array $requestOptions = [])
    {

        parse_str($request->getUri()->getQuery(), $query);
        $query = http_build_query(array_merge($this->getQuery(), $query));

        return $request->withUri($request->getUri()->withQuery($query));
    }

    /**
     * Send http request.
     *
     * @param array $credentials
     *
     * @return \Psr\Http\Message\ResponseInterface|\AI\Common\Tool\Collection|array|object|string
     */
    protected function sendRequest(array $credentials)
    {
        $options = [
            ($this->requestMethod === 'GET') ? 'query' : 'json' => $credentials,
        ];

        return $this->setHttpClient($this->app['http_client'])->request($this->getEndpoint(), $this->requestMethod, $options);
    }

    /**
     * @return string
     */
    protected function getCacheKey()
    {
        return $this->cachePrefix . md5(json_encode($this->getCredentials()));
    }

    /**
     * The request query will be used to add to the request.
     *
     * @return array
     */
    protected function getQuery()
    {
        return [isset($this->queryName) ? $this->queryName : $this->tokenKey => $this->getToken()[$this->tokenKey]];
    }

    /**
     * @return string
     *
     * @throws \AI\Common\Exceptions\InvalidArgumentException
     */
    public function getEndpoint()
    {
        if (empty($this->endpointToGetToken)) {
            throw new InvalidArgumentException('No endpoint for access token request.');
        }

        return $this->endpointToGetToken;
    }

    /**
     * Credential for get token.
     *
     * @return array
     */
    abstract protected function getCredentials();
}

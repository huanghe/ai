<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:45
 */

namespace AI\Common;

use AI\Common\Contracts\AccessTokenInterface;
use AI\Common\Http\Response;
use AI\Common\Traits\HasHttpRequests;
use GuzzleHttp\Client;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BaseClient
{
    use HasHttpRequests {
        request as performRequest;
    }

    /**
     * @var \AI\Common\ServiceContainer
     */
    protected $app;

    /**
     * @var \AI\Common\Contracts\AccessTokenInterface
     */
    protected $accessToken = false;

    /**
     * @var
     */
    protected $baseUri;

    /**
     * BaseClient constructor.
     *
     * @param \AI\Common\ServiceContainer $app
     * @param \AI\Common\Contracts\AccessTokenInterface|null $accessToken
     */
    public function __construct(ServiceContainer $app, AccessTokenInterface $accessToken = null)
    {
        $this->app = $app;

        if (isset($this->app['access_token'])) {//查找是否注入了access_token对象
            $this->accessToken = $this->app['access_token'];
        }
        if ($accessToken !== null) {//查找是否传入了access_token对象
            $this->accessToken = $accessToken;
        }
    }

    /**
     * GET request.
     *
     * @param string $url
     * @param array $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\AI\Common\Tool\Collection|array|object|string
     */
    public function httpGet($url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    /**
     * POST request.
     *
     * @param string $url
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface|\AI\Common\Tool\Collection|array|object|string
     */
    public function httpPost($url, array $data = [])
    {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }

    /**
     * JSON request.
     *
     * @param string $url
     * @param string|array $data
     * @param array $headers
     * @param array $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\AI\Common\Tool\Collection|array|object|string
     */
    public function httpPostJson($url, array $data = [], array $headers = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data, 'headers' => $headers]);
    }

    /**
     * Upload file.
     *
     * @param string $url
     * @param array $files
     * @param array $form
     * @param array $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\AI\Common\Tool\Collection|array|object|string
     */
    public function httpUpload($url, array $files = [], array $form = [], array $query = [])
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name' => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request($url, 'POST', ['query' => $query, 'multipart' => $multipart]);
    }

    /**
     * @return AccessTokenInterface
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param \AI\Common\Contracts\AccessTokenInterface $accessToken
     *
     * @return $this
     */
    public function setAccessToken(AccessTokenInterface $accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @param bool $returnRaw
     *
     * @return \Psr\Http\Message\ResponseInterface|\AI\Common\Tool\Collection|array|object|string
     */
    public function request($url, $method = 'GET', array $options = [], $returnRaw = false)
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }
        $response = $this->performRequest($url, $method, $options);

        return $returnRaw ? $response : $this->resolveResponse($response, $this->app->config->get('response_type', 'array'));
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     *
     * @return \AI\Common\Http\Response
     */
    public function requestRaw($url, $method = 'GET', array $options = [])
    {
        return Response::buildFromPsrResponse($this->request($url, $method, $options, true));
    }

    /**
     * Return GuzzleHttp\Client instance.
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        if (!($this->httpClient instanceof Client)) {
            $this->httpClient = isset($this->app['http_client']) ? $this->app['http_client'] : new Client();
        }

        return $this->httpClient;
    }

    /**
     * Register Guzzle middlewares.
     */
    protected function registerHttpMiddlewares()
    {
        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');
        // access token
        if ($this->accessToken !== false) {
            $this->pushMiddleware($this->accessTokenMiddleware(), 'access_token');
        }
        // log
        $this->pushMiddleware($this->logMiddleware(), 'log');
    }

    /**
     * Attache access token to request query.
     *
     * @return \Closure
     */
    protected function accessTokenMiddleware()
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                if ($this->accessToken) {
                    $request = $this->accessToken->applyToRequest($request, $options);
                }

                return $handler($request, $options);
            };
        };
    }

    /**
     * Log the request.
     *
     * @return \Closure
     */
    protected function logMiddleware()
    {
        //没有设置日志默认设置response和error
        $formatter = new MessageFormatter(isset($this->app['config']['http.log_template']) ? $this->app['config']['http.log_template'] : "<<<<<<<<\n{response}\n--------\n{error}");

        return Middleware::log($this->app['logger'], $formatter);
    }

    /**
     * Return retry middleware.
     *
     * @return \Closure
     */
    protected function retryMiddleware()
    {
        return Middleware::retry(function (
            $retries,
            RequestInterface $request,
            ResponseInterface $response = null
        ) {
            // Limit the number of retries to 2
            if ($retries < $this->app->config->get('http.retries', 1) && $response && $body = $response->getBody()) {
                // Retry on server errors
                $response = json_decode($body, true);

                if ($this->accessToken !== false && isset($response['error'])) {//需要token并且返回错误的情况下，error为百度返回的错误码
                    $this->accessToken->refresh();
                    $this->app['logger']->debug('Retrying with refreshed access token.');

                    return true;
                }
            }

            return false;
        }, function () {
            return abs($this->app->config->get('http.retry_delay', 500));
        });
    }
}

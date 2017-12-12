<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:29
 */

namespace AI\Baidu\Auth;

use AI\Common\AccessToken as BaseAccessToken;
use AI\Common\Exceptions\InvalidConfigException;

/**
 * Class AuthorizerAccessToken.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected $baseUri = 'https://aip.baidubce.com/oauth/2.0/';

    /**
     * @var string
     */
    protected $endpointToGetToken = 'token';

    /**
     * @var int
     */
    protected $safeSeconds = 0;

    /**
     * Credential for get token.
     *
     * @return array
     */
    protected function getCredentials()
    {
        if (!isset($this->app['config']['baidu']['app_key']) || !isset($this->app['config']['baidu']['secret_key'])) {
            throw new InvalidConfigException("app_key:['baidu']['app_key'] or secret_key:['baidu']['secret_key'] not set");
        }
        return [
            'grant_type' => 'client_credentials',
            'client_id' => $this->app['config']['baidu']['app_key'],
            'client_secret' => $this->app['config']['baidu']['secret_key'],
        ];
    }
}

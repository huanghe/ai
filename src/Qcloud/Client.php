<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/12/7
 * Time: 22:44
 */
namespace AI\Qcloud;

use AI\Common\BaseClient;

/**
 * Class Client.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Client extends BaseClient
{
    const EXPIRED_SECONDS = 2592000;
    /**
     * @var string
     */
    protected $baseUri = 'http://recognition.image.myqcloud.com/';
    /**
     * @var string:curl_getinfo($curlHandle)返回的值
     */
    public static $_httpInfo = '';

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-7
     *  updated_at: 2017-12-
     * @param $url
     * @param array $data
     * @return \AI\Common\Tool\Collection|array|object|\Psr\Http\Message\ResponseInterface|string
     *  desc   :
     */
    public function post($url, $data = [])
    {
        $data['appid'] = $this->app['config']['qcloud']['app_id'];
        //如果传入的是url，则需要头部'application/json',否则为'multipart/form-data'
        $contentType = isset($data['url']) ? 'application/json' : 'multipart/form-data';
        $headers = $this->getHeader($contentType);
        return $this->httpPostJson($url, $data, $headers);
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-12
     *  updated_at: 2018-12-7
     * @param $contentType
     * @return array
     *  desc   :设置头部及签名
     */
    private function getHeader($contentType)
    {
        return [
            'Authorization' => Auth::appSign($this->app['config']['qcloud']['app_id'], $this->app['config']['qcloud']['secret_id'], $this->app['config']['qcloud']['secret_key']),
            'Content-Type' => $contentType,
            'Expect' => '',
            'Host' => 'recognition.image.myqcloud.com',
        ];
    }

    /**
     * return the status message
     */
    public static function statusText($status)
    {
        switch ($status) {
            case 0:
                $statusText = 'CONNECT_FAIL';
                break;
            case 200:
                $statusText = 'HTTP OK';
                break;
            case 400:
                $statusText = 'BAD_REQUEST';
                break;
            case 401:
                $statusText = 'UNAUTHORIZED';
                break;
            case 403:
                $statusText = 'FORBIDDEN';
                break;
            case 404:
                $statusText = 'NOTFOUND';
                break;
            case 411:
                $statusText = 'REQ_NOLENGTH';
                break;
            case 423:
                $statusText = 'SERVER_NOTFOUND';
                break;
            case 424:
                $statusText = 'METHOD_NOTFOUND';
                break;
            case 425:
                $statusText = 'REQUEST_OVERFLOW';
                break;
            case 500:
                $statusText = 'INTERNAL_SERVER_ERROR';
                break;
            case 503:
                $statusText = 'SERVICE_UNAVAILABLE';
                break;
            case 504:
                $statusText = 'GATEWAY_TIME_OUT';
                break;
            default:
                $statusText = $status;
                break;
        }
        return $statusText;
    }

    /**
     * return the status message
     */
    public static function getStatusText()
    {
        $info = self::$_httpInfo;
        $status = $info['http_code'];
        return self::statusText($status);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/12
 * Time: 22:44
 */
namespace AI\Youtu;

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
    protected $baseUri = 'https://api.youtu.qq.com/';
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
     * @param array $params
     * @param array $headers
     * @return \AI\Common\Tool\Collection|array|object|\Psr\Http\Message\ResponseInterface|string
     *  desc   :
     */
    public function post($url, $data = [], $params = [], $headers = [])
    {
        return $this->httpPost($url, $data);
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
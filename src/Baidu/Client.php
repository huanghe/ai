<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:44
 */
namespace AI\Baidu;

use AI\Common\BaseClient;

/**
 * Class Client.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $baseUri = 'https://aip.baidubce.com/rest/2.0/ocr/v1/';

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

}
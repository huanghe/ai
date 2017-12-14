<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/14
 * Time: 09:44
 */
namespace AI\FacePlus;

use AI\Common\BaseClient;

/**
 * Class Client.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Client extends BaseClient
{
    private $fileKey = ['image_file' => 'v', 'image_file1' => 'v', 'template_file' => 'v'];
    /**
     * @var string
     */
    protected $baseUri = 'https://api-cn.faceplusplus.com/';
    /**
     * @var string:curl_getinfo($curlHandle)返回的值
     */
    public static $_httpInfo = '';

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-14
     *  updated_at: 2017-12-
     * @param $url
     * @param array $data
     * @return \AI\Common\Tool\Collection|array|object|\Psr\Http\Message\ResponseInterface|string
     *  desc   :
     */
    public function post($url, $data = [])
    {
        $data['api_key'] = $this->app['config']['face_plus']['api_key'];
        $data['api_secret'] = $this->app['config']['face_plus']['api_secret'];
        $intersectData = array_intersect_key($data, $this->fileKey);
        if (!empty($intersectData)) {//使用post multipart/form-data的方式上传
            $newData = array_diff_key($data, $intersectData);
            return $this->httpUpload($url, $intersectData, $newData);
        } else {
            return $this->httpPost($url, $data);
        }
    }


}
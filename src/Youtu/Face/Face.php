<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/12
 */
namespace AI\Youtu\Face;

use AI\Common\Tool\File;
use AI\Youtu\Client;
use AI\Common\Exceptions\InvalidArgumentException;

/**
 * Class Face.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Face
{
    protected $client;
    /**
     * @var: 路径
     */
    protected $endPoint;
    /**
     * @var string
     */
    protected $versionUrl = 'youtu/api/';
    /**
     * @var : data的参数
     */
    protected $params;

    public function __construct($app)
    {
        $this->client = new Client($app);
    }


    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-7
     *  updated_at: 2017-12-
     *  desc   :
     */
    public function get()
    {
        return $this->client->post($this->endPoint, $this->params);
    }



    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-12
     *  updated_at: 2017-12-12
     * @param string $param
     * @return $this
     *  desc   :    指定调用的接口
     */
    public function select($param = 'detectface')
    {
        $allowFaceType = require __DIR__ . '/SupportType.php';
        if (!in_array($param, $allowFaceType)) {
            throw new InvalidArgumentException('invalid argument:' . $param);
        }
        $this->endPoint = $this->versionUrl . $param;
        return $this;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-8
     *  updated_at: 2017-12-
     * @param $condition
     * @return $this
     *  desc   :    请求的参数，一般包含 image
     */
    public function where($condition)
    {
        $this->params = $condition;
        if (isset($this->params['image'])) {
            $this->params['image'] = File::base64LocalImage($this->params['image']);
        }
        return $this;
    }


}
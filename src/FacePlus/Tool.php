<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/14
 * Time: 15:35
 */
namespace AI\FacePlus;
/**
 * Trait Tool.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
Trait Tool
{
    protected $client;
    /**
     * @var: 路径
     */
    protected $endPoint;
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
     *  created_at: 2017-12-14
     *  updated_at: 2017-12-14
     * @param string $param
     * @return $this
     *  desc   :    指定调用的接口
     */
    public function select($param = 'detect')
    {
        $versionUrl = in_array($param, $this->backVersionApi) ? $this->backVersionUrl : $this->versionUrl;
        $this->endPoint = $versionUrl . $param;
        return $this;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-14
     *  updated_at: 2017-12-
     * @param $condition
     * @return $this
     *  desc   :    请求的参数，一般包含 image
     */
    public function where($condition)
    {
        $this->params = $condition;
        return $this;
    }
}
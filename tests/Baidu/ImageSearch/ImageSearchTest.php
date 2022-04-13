<?php
namespace AI\Tests\Baidu\ImageSearch;

use AI\Entry;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/8/13
 * Time: 16:26
 */
class ImageSearchTest extends TestCase
{
    /**
     * @array 配置
     */
    public $config;

    //vendor/phpunit/phpunit/phpunit --testdox tests/Baidu/ImageSearch/ImageSearchTest.php

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->config = require __DIR__ . '/../../config/ai.php';
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2018-8-13
     *  updated_at: 2018-8-
     * @return bool
     *  desc   :    相同图测试
     */
    public function testSameHq()
    {
        return true;
        if (!file_exists(__DIR__ . '/../../file/cup.jpg'))
            return false;
        $result = Entry::Baidu($this->config)->imageSearch->select('realtime_search/same_hq/add')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg'),'brief'=>'{"name":"杯子", "id":"666"}'])->get();//入库
//        $result = Entry::Baidu($this->config)->imageSearch->select('realtime_search/same_hq/search')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg'), 'type' => 'gender'])->get();//检索
//        $result = Entry::Baidu($this->config)->imageSearch->select('realtime_search/same_hq/delete')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg')])->get();//删除
//        $result = Entry::Baidu($this->config)->imageSearch->select('realtime_search/same_hq/update')->where(['image' => file_get_contents(__DIR__ . '/../../file/body1.jpg'),'brief'=>'{"name":"杯子", "id":"888"}'])->get();//更新

        var_dump($result);
        exit;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2018-8-13
     *  updated_at: 2018-8-
     *  desc   :    相似图测试
     */
    public function testSimilar()
    {
        return true;
        if (!file_exists(__DIR__ . '/../../file/cup.jpg'))
            return false;
//        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/similar/add')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg'),'brief'=>'{"name":"杯子", "id":"666"}'])->get();//入库
//        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/similar/search')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg'), 'type' => 'gender'])->get();//检索
        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/similar/delete')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg')])->get();//删除
//        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/similar/update')->where(['image' => file_get_contents(__DIR__ . '/../../file/body1.jpg'),'brief'=>'{"name":"杯子", "id":"888"}'])->get();//更新

        var_dump($result);
        exit;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2018-8-13
     *  updated_at: 2018-8-
     *  desc   :商品检索测试
     */
    public function testProduct()
    {
        if (!file_exists(__DIR__ . '/../../file/cup.jpg'))
            return false;
//        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/product/add')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg'),'brief'=>'{"name":"杯子", "id":"666"}'])->get();//入库
//        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/product/search')->where(['image' => file_get_contents(__DIR__ . '/../../file/cup.jpg'), 'type' => 'gender'])->get();//检索
        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/product/delete')->where(['cont_sign' => '191504247,601493294'])->get();//删除
//        $result = Entry::Baidu($this->config)->imageSearch->select('v1/realtime_search/product/update')->where(['image' => file_get_contents(__DIR__ . '/../../file/body1.jpg'),'brief'=>'{"name":"杯子", "id":"888"}'])->get();//更新

        var_dump($result);
//        var_dump($result);
        exit;
    }
}
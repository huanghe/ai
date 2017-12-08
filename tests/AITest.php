<?php

use AI\Entry;


/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/11/22
 * Time: 19:17
 */
class AITest extends PHPUnit_Framework_TestCase
{
    public function testIceInit()
    {
        $config = require __DIR__.'/config/baidu.php';
        $result = Entry::Baidu($config)->ocr->select('idcard')->where(['image' => file_get_contents(__DIR__ . '/file/idcard.jpg'), 'id_card_side' => 'front'])->get();//身份证
//        $result = Entry::Baidu($config)->ocr->select('form_ocr/request')->where(['image' => file_get_contents(__DIR__ . '/file/idcard.jpg')])->get();//身份证
//        $result = Entry::Baidu($config)->ocr->select('vehicle_license')->where(['image' => file_get_contents(__DIR__ . '/file/xingshizheng002.jpg')])->get();//行驶证
        print_r($result);
        exit;
        $this->assertEquals('1111', $orc->get());
    }
}

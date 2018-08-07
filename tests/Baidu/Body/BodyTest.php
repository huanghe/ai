<?php

namespace AI\Tests\Baidu\Body;

use AI\Entry;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/8/6
 * Time: 12:14
 */
class BodyTest extends \PHPUnit_Framework_TestCase
{
    //vendor/phpunit/phpunit/phpunit --testdox tests/Baidu/Body/BodyTest.php
    public function testGet()
    {
        $config = require __DIR__ . '/../../config/ai.php';
        if (!file_exists(__DIR__ . '/../../file/body1.jpg'))//需要找一张人体识别的图片
            return false;
//        $result = Entry::Baidu($config)->body->select('analysis')->where(['image' => file_get_contents(__DIR__ . '/../../file/body1.jpg')])->get();//人体关键点识别
        $result = Entry::Baidu($config)->body->select('attr')->where(['image' => file_get_contents(__DIR__ . '/../../file/body1.jpg'), 'type' =>'gender'])->get();//人体属性识别
//        $result = Entry::Baidu($config)->body->select('num')->where(['image' => file_get_contents(__DIR__ . '/../../file/body1.jpg')])->get();//人流量统计

        var_dump($result);
        exit;
    }
}
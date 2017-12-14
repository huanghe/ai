<?php

namespace AI\Tests\Youtu\Face;

use AI\Entry;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 */
class FaceTest extends \PHPUnit_Framework_TestCase
{
    //vendor/phpunit/phpunit/phpunit --testdox tests/Youtu/Face/FaceTest.php
    public function testGet()
    {
        $config = require __DIR__ . '/../../config/youtu.php';
//        $result = Entry::Youtu($config)->face->select('detectface')->where(['image' => __DIR__ . '/../../file/face_01.jpg', 'mode' => 1])->get();//身份证
        $result = Entry::Youtu($config)->face->select('detectface')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg', 'mode' => 1])->get();//身份证
        print_r($result);
        exit;
    }
}
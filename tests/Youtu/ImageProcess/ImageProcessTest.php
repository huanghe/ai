<?php

namespace AI\Tests\Youtu\ImageProcess;

use AI\Entry;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/3/26
 * Time: 15:56
 */
class ImageProcessTest extends \PHPUnit_Framework_TestCase
{
    //vendor/phpunit/phpunit/phpunit --testdox tests/Youtu/ImageProcess/ImageProcessTest.php
    public function testGet()
    {
        $config = require __DIR__ . '/../../config/ai.php';
        $opdata = [['cmd' => 'doFaceMerge', 'params' => ['model_id' => 'cf_wzry_zhugeImage']]];
//        $request = ['img_data' => __DIR__ . '/../../file/face_01.jpg', 'rsp_img_type' => "url", 'opdata' => $opdata];
        $request = ['img_data' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_04.jpg', 'rsp_img_type' => "url", 'opdata' => $opdata];
        $result = Entry::Youtu($config)->imageProcess->select()->where($request)->get();//人脸融合
        print_r($result);
        exit;
    }
}
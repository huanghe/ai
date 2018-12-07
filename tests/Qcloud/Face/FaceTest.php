<?php

namespace AI\Tests\Qcloud\Face;

use AI\Entry;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 */
class FaceTest extends \PHPUnit_Framework_TestCase
{
    //vendor/phpunit/phpunit/phpunit --testdox tests/Qcloud/Face/FaceTest.php
    public function testGet()
    {
        $config = require __DIR__ . '/../../config/ai.php';
        //创建一个Person, 使用图片url
//        $result = Entry::Qcloud($config)->face->select('newperson')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg',
//            'appid' => $config['qcloud']['app_id'], 'group_ids' => [ "tencent", "qq" ], 'person_id' => 'person_1'])->get();
        //删除个体
//         $result = Entry::Qcloud($config)->face->select('delperson')->where(['appid' => $config['qcloud']['app_id'], 'person_id' => 'person_1'])->get();
//        $result = Entry::Qcloud($config)->face->select('newperson')->where(['image' => __DIR__ . '/../../file/face_01.jpg', 'appid' => $config['qcloud']['app_id'], 'group_ids' => ["qq"], 'person_id' => 'person_2'])->get();//创建一个Person, 使用二进制上传
        //人脸检索
//        $result = Entry::Qcloud($config)->face->select('identify')->where(['image' => __DIR__ . '/../../file/face_01.jpg', 'appid' => $config['qcloud']['app_id'], 'group_ids' => ["tencent"]])->get();
        //人脸检索
//        $result = Entry::Qcloud($config)->face->select('multidentify')->where(['image' => __DIR__ . '/../../file/face_01.jpg', 'appid' => $config['qcloud']['app_id'], 'group_ids' => ["tencent"]])->get();
        //人脸验证
//        $result = Entry::Qcloud($config)->face->select('verify')->where(['image' => __DIR__ . '/../../file/face_01.jpg', 'appid' => $config['qcloud']['app_id'], 'person_id' => 'person_2'])->get();
        //人脸检测
        $result = Entry::Qcloud($config)->face->select('detect')->where(['image' => __DIR__ . '/../../file/face_02.jpg', 'appid' => $config['qcloud']['app_id'], 'mode' => 1])->get();
        //五官定位
//        $result = Entry::Qcloud($config)->face->select('shape')->where(['image' => __DIR__ . '/../../file/face_02.jpg', 'appid' => $config['qcloud']['app_id'], 'mode' => 1])->get();
        //人脸静态活体检测
//        $result = Entry::Qcloud($config)->face->select('livedetectpicture')->where(['image' => __DIR__ . '/../../file/face_02.jpg', 'appid' => $config['qcloud']['app_id']])->get();
        print_r($result);
        exit;
    }
}
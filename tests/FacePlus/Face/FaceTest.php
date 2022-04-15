<?php

namespace AI\Tests\FacePlus\Face;

use AI\Entry;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 */
class FaceTest extends TestCase
{
    /**
     * @var 配置
     */
    public $config;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->config = require __DIR__ . '/../../config/ai.php';
    }

    //vendor/phpunit/phpunit/phpunit --testdox tests/FacePlus/Face/FaceTest.php
    public function testGet()
    {
        return true;
        $result = Entry::FacePlus($this->config)->face->select('detect')->where(['image_file' => __DIR__ . '/../../file/face_01.jpg', 'return_attributes' => 'skinstatus'])->get();//身份证
//        $result = Entry::FacePlus($this->config)->face->select('detect')->where(['image_base64' => \AI\Common\Tool\File::base64LocalImage(__DIR__ . '/../../file/face_01.jpg'), 'return_attributes' => 'skinstatus'])->get();//身份证
//        $result = Entry::FacePlus($this->config)->face->select('detect')->where(['image_url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg', 'return_attributes' => 'skinstatus'])->get();//身份证
        var_dump($result);
        exit;
    }

    public function testGetFaceSets()
    {
        $result = Entry::FacePlus($this->config)->face->select('getfacesets')->get();//身份证
        var_dump($result);
        exit;
    }
}
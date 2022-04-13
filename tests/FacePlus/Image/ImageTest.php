<?php

namespace AI\Tests\FacePlus\Image;

use AI\Entry;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 * 调用方法：vendor/phpunit/phpunit/phpunit --testdox tests/FacePlus/Image/ImageTest.php
 */
class ImageTest extends TestCase
{
    public $config;

    /**
     * OcrTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->config = require __DIR__ . '/../../config/ai.php';
    }
    //
    public function testGet()
    {
        return true;
        $result = Entry::FacePlus($this->config)->image->select('recognizetext')->where(['image_file' => __DIR__ . '/../../file/ocr_txt001.jpg'])->get();//一般文字图片
        $result = Entry::FacePlus($this->config)->image->select('detect')->where(['image_base64' => \AI\Common\Tool\File::base64LocalImage(__DIR__ . '/../../file/face_01.jpg'), 'return_attributes' => 'skinstatus'])->get();//身份证
//        $result = Entry::FacePlus($this->config)->image->select('detect')->where(['image_url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg', 'return_attributes' => 'skinstatus'])->get();//身份证
        var_dump($result);
        exit;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-28
     *  updated_at: 2017-12-
     *  desc   :
     */
    public function testDetectSceneAndObject()
    {
//        $result = Entry::FacePlus($this->config)->image->select('detectsceneandobject')->where(['image_file' => __DIR__ . '/../../file/cat.jpg'])->get();//一般文字图片
        $result = Entry::FacePlus($this->config)->image->select('detectsceneandobject')->where(['image_base64' => base64_encode(file_get_contents(__DIR__ . '/../../file/cup.jpg'))])->get();//一般文字图片
        var_dump($result);
        exit;
    }
}
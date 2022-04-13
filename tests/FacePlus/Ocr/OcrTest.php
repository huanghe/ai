<?php

namespace AI\Tests\FacePlus\Ocr;

use AI\Entry;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 * 调用方法：vendor/phpunit/phpunit/phpunit --testdox tests/FacePlus/Ocr/OcrTest.php
 */
class OcrTest extends TestCase
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

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-13
     *  updated_at: 2017-12-
     *  desc   :    检测和识别中华人民共和国第二代身份证的关键字段内容
     */
    public function testIdCard()
    {
        //image_url,图片的URL
        //image_file,一个图片，二进制文件
        //image_base64,base64编码的二进制图片数据
        return true;
        $result = Entry::FacePlus($this->config)->ocr->select('ocridcard')->where(['image_url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_namecard_02.jpg'])->get();//身份证
        var_dump($result);
        exit;
    }


    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-29
     *  updated_at: 2017-12-
     *  desc   :    检测和识别中华人民共和国机动车驾驶证，目前只支持驾照主页正面
     */
    public function testOcrdriverlicense()
    {
//        return true;
        $result = Entry::FacePlus($this->config)->ocr->select('ocrdriverlicense')->where(['image_url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_jsz_01.jpg'])->get();//驾驶证
        var_dump($result);
        exit;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-29
     *  updated_at: 2017-12-
     *  desc   :    检测和识别中华人民共和国机动车行驶证
     */
    public function testoOrvehiclelicense()
    {
        return true;
        $result = Entry::FacePlus($this->config)->ocr->select('ocrvehiclelicense')->where(['image_url' => 'http://open.youtu.qq.com/app/img/experience/char_general/icon_ocr_xsz_02.jpg'])->get();//行驶证
        var_dump($result);
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-29
     *  updated_at: 2017-12-
     *  desc   :    银行卡
     */
    public function testOcrbankcard()
    {
        return true;
        $result = Entry::FacePlus($this->config)->ocr->select('ocrbankcard')->where(['image_url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_card_1.jpg'])->get();//银行卡
        var_dump($result);
    }
}
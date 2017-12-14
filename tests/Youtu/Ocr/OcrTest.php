<?php

namespace AI\Tests\Youtu\Ocr;

use AI\Entry;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 */
class OcrTest extends \PHPUnit_Framework_TestCase
{
    public $config;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->config = require __DIR__ . '/../../config/youtu.php';
    }

    //vendor/phpunit/phpunit/phpunit --testdox tests/Youtu/Ocr/OcrTest.php
//    public function testGet()
//    {
//        $result = Entry::Youtu($this->config)->ocr->select('idcardocr')->where(['image' => __DIR__ . '/../../file/idcard_02.jpg', 'seq' => '', 'card_type' => 0])->get();//身份证
////        $result = Entry::Youtu($config)->ocr->select('idcardocr')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_id_01.jpg', 'seq' => '', 'card_type' => 0])->get();//身份证
//        var_dump($result);
//        exit;
//    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-13
     *  updated_at: 2017-12-
     *  desc   :    名片
     */
//    public function testBc(){
//        $result = Entry::Youtu($this->config)->ocr->select('bcocr')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_namecard_02.jpg'])->get();//身份证
//        var_dump($result);
//        exit;
//    }
    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-
     *  updated_at: 2017-12-
     *  desc   :    通用
     */
    public function testGeneral()
    {
        return true;
        $result = Entry::Youtu($this->config)->ocr->select('generalocr')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_common07.jpg'])->get();//通用
        var_dump($result);

    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-
     *  updated_at: 2017-12-
     *  desc   :营业执照
     */
    public function testBizlicenseocr()
    {
        return true;
        $result = Entry::Youtu($this->config)->ocr->select('bizlicenseocr')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_yyzz_01.jpg'])->get();//通用
        var_dump($result);
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-
     *  updated_at: 2017-12-
     *  desc   :    银行卡
     */
    public function testCreditcardocr()
    {
        return true;
        $result = Entry::Youtu($this->config)->ocr->select('creditcardocr')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_card_1.jpg'])->get();//银行卡
        var_dump($result);
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-13
     *  updated_at: 2017-12-
     *  desc   :    车牌
     */
    public function testPlateocr()
    {
        return true;
        $result = Entry::Youtu($this->config)->ocr->select('plateocr')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_license_1.jpg'])->get();//银行卡
        var_dump($result);
    }

    public function testDriverlicenseocr()
    {
        $result = Entry::Youtu($this->config)->ocr->select('driverlicenseocr')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/char_general/ocr_jsz_01.jpg', 'type' => 1])->get();//驾驶证
        var_dump($result);
    }
}
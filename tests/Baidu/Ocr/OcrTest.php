<?php
namespace AI\Tests\Baidu\Ocr;

use AI\Entry;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 */
class OcrTest extends \PHPUnit_Framework_TestCase
{
    //vendor/phpunit/phpunit/phpunit --testdox tests/Baidu/Ocr/OcrTest.php
    public function testGet()
    {
        $config = require __DIR__ . '/../../config/ai.php';
        $result = Entry::Baidu($config)->ocr->select('accurate_basic')->where(['image' => file_get_contents(__DIR__ . '/../../file/ocr_txt001.jpg')])->get();//身份证

        var_dump($result);
        exit;
//        $result = Entry::Baidu($config)->ocr->select('receipt')->where(['image' => file_get_contents(__DIR__ . '/../../file/demo-receipt-1.jpg'), 'id_card_side' => 'front'])->get();//票据
//        $result = Entry::Baidu($config)->ocr->select('form_ocr/request')->where(['image' => file_get_contents(__DIR__ . '/../../file/idcard.jpg')])->get();//身份证
//        $result = Entry::Baidu($config)->ocr->select('vehicle_license')->where(['image' => file_get_contents(__DIR__ . '/../../file/xingshizheng002.jpg')])->get();//行驶证
    }
}
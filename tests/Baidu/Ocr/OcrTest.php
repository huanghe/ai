<?php
namespace AI\Tests\Baidu\Ocr;

use AI\Entry;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 * 测试方法:vendor/phpunit/phpunit/phpunit --testdox tests/Baidu/Ocr/OcrTest.php
 */
class OcrTest extends \PHPUnit_Framework_TestCase
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
    //
    public function testGet()
    {
        return true;
        $result = Entry::Baidu($this->config)->ocr->select('accurate_basic')->where(['image' => file_get_contents(__DIR__ . '/../../file/ocr_txt001.jpg')])->get();//通用

//         $result = Entry::Baidu($this->config)->ocr->select('idcard')->where(['image' => file_get_contents(__DIR__ . '/../../file/idcard_02.jpg'), 'id_card_side' => 'front'])->get();//身份证

//        $result = Entry::Baidu($this->config)->ocr->select('receipt')->where(['image' => file_get_contents(__DIR__ . '/../../file/demo-receipt-1.jpg'), 'id_card_side' => 'front'])->get();//票据
//        $result = Entry::Baidu($this->config)->ocr->select('form_ocr/request')->where(['image' => file_get_contents(__DIR__ . '/../../file/idcard.jpg')])->get();//身份证
//        $result = Entry::Baidu($this->config)->ocr->select('vehicle_license')->where(['image' => file_get_contents(__DIR__ . '/../../file/xingshizheng002.jpg')])->get();//行驶证
        return $result;

    }

    /**
 *  author:HAHAXIXI
 *  created_at: 2017-12-28
 *  updated_at: 2017-12-
 *  desc   :    通用文字识别（含位置信息版）
 */
    public function testGeneral()
    {
        return true;
//        $result = Entry::Baidu($this->config)->ocr->select('general')->where(['url' => 'http://aip.bdstatic.com/portal/dist/1513863228374/ai_images/technology/ocr-general/general/demo-card-2.jpg'])->get();//通用
        $result = Entry::Baidu($this->config)->ocr->select('general')->where(['image' => file_get_contents(__DIR__ . '/../../file/ocr_txt001.jpg')])->get();//通用
        var_dump($result);
        exit;
    }
    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-28
     *  updated_at: 2017-12-
     *  desc   :    通用文字识别
     */
    public function testGeneralBasic()
    {
        $result = Entry::Baidu($this->config)->ocr->select('general_basic')->where(['url' => 'http://aip.bdstatic.com/portal/dist/1513863228374/ai_images/technology/ocr-general/general/demo-card-2.jpg'])->get();//通用
//        $result = Entry::Baidu($this->config)->ocr->select('general_basic')->where(['image' => file_get_contents(__DIR__ . '/../../file/ocr_txt001.jpg')])->get();//通用
        var_dump($result);
        exit;
    }
}
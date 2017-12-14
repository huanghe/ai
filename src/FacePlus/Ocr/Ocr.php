<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/14
 * Time: 15:41
 */
namespace AI\FacePlus\Ocr;

use AI\FacePlus\Tool;

/**
 * Class Ocr.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Ocr
{
    use Tool;
    /**
     * @var string
     */
    protected $versionUrl = 'cardpp/v1/';
    /**
     * @var array
     */
    protected $backVersionApi = [
        'ocrbankcard',
    ];
    /**
     * @var string 第二路由
     */
    protected $backVersionUrl = 'cardpp/beta/';
}
<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/14
 * Time: 15:43
 */
namespace AI\FacePlus\Image;

use AI\FacePlus\Tool;


/**
 * Class Image.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Image
{
    use Tool;
    /**
     * @var string
     */
    protected $versionUrl = 'imagepp/v1/';
    /**
     * @var array
     */
    protected $backVersionApi = [
        'detectsceneandobject',//调用者提供图片文件或者图片URL，进行图片分析，识别图片场景和图片主体。
    ];
    /**
     * @var string 第二路由
     */
    protected $backVersionUrl = 'imagepp/beta/';
}
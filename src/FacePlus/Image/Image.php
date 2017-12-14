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
        'detectsceneandobject',
    ];
    /**
     * @var string 第二路由
     */
    protected $backVersionUrl = 'imagepp/beta/';
}
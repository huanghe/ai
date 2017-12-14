<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/14
 */
namespace AI\FacePlus\Body;

use AI\FacePlus\Tool;

/**
 * Class Face.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Body
{
    use Tool;
    /**
     * @var string
     */
    protected $versionUrl = 'humanbodypp/v1/';
    /**
     * @var array
     */
    protected $backVersionApi = [
        'gesture',
    ];
    /**
     * @var string 第二路由
     */
    protected $backVersionUrl = 'humanbodypp/beta/';

}
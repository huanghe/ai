<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/14
 */
namespace AI\FacePlus\Face;

use AI\FacePlus\Tool;

/**
 * Class Face.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Face
{
    use Tool;
    /**
     * @var string
     */
    protected $versionUrl = 'facepp/v3/';
    /**
     * @var array
     */
    protected $backVersionApi = [
        'create', 'addface', 'removeface', 'update', 'getdetail', 'delete', 'getfacesets',
    ];
    /**
     * @var string 第二路由
     */
    protected $backVersionUrl = 'facepp/v3/faceset/';

}
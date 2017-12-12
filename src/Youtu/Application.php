<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/12
 * Time: 10:52
 */
namespace AI\Youtu;

use AI\Common\ServiceContainer;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/12
 * Time: 17:48
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Ocr\ServiceProvider::class,
//        Face\ServiceProvider::class,
    ];
}
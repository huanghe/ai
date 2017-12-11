<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:52
 */
namespace AI\Baidu;

use AI\Common\ServiceContainer;

/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/2
 * Time: 17:48
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Ocr\ServiceProvider::class,
        Face\ServiceProvider::class,
    ];
}
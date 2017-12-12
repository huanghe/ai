<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 23:05
 */
namespace AI\Common\Contracts;


interface MessageInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return mixed
     */
    public function transformForJsonRequest();

    /**
     * @return string
     */
    public function transformToXml();
}

<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 23:07
 */
namespace AI\Common\Contracts;


interface EventHandlerInterface
{
    /**
     * @param array $payload
     */
    public function handle(array $payload = []);
}
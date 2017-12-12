<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:34
 */

namespace AI\Common\Contracts;


use Psr\Http\Message\RequestInterface;


interface AccessTokenInterface
{
    /**
     * @return array
     */
    public function getToken();

    /**
     * @return \AI\Common\Contracts\AccessTokenInterface
     */
    public function refresh();

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array                              $requestOptions
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function applyToRequest(RequestInterface $request, array $requestOptions = []);
}

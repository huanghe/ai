<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/12/7
 * Time: 20:28
 */
namespace AI\Qcloud\Face;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['face']) || $app['face'] = function ($app) {
            return new Face($app);
        };
    }
}
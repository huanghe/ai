<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/8/6
 * Time: 11:50
 */
namespace AI\Baidu\Body;

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
        isset($app['body']) || $app['body'] = function ($app) {
            return new Body($app);
        };
    }
}
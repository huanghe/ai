<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/12/11
 * Time: 20:28
 */
namespace AI\Baidu\ImageSearch;

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
        isset($app['imageSearch']) || $app['imageSearch'] = function ($app) {
            return new ImageSearch($app);
        };
    }
}
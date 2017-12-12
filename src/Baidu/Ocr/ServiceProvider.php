<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:28
 */
namespace AI\Baidu\Ocr;

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
        isset($app['ocr']) || $app['ocr'] = function ($app) {
            return new Ocr($app);
        };
    }
}
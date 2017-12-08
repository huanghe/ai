<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:38
 */
namespace AI\Common;

use GuzzleHttp\Client;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;

class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var array
     */
    protected $defaultConfig = [];


    /**
     * @var string
     */
    protected $id;

    /**
     * Constructor.
     *
     * @param array $config
     * @param array $prepends
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($prepends);

        $this->registerConfig($config)
            ->registerProviders()
            ->registerLogger()
            ->registerRequest()
            ->registerHttpClient();

        $this->id = md5(json_encode($config));
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return all providers.
     *
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * Register config.
     *
     * @param array $config
     *
     * @return $this
     */
    protected function registerConfig(array $config)
    {
        $this['config'] = function () use ($config) {
            return new Config(
                array_replace_recursive($this->defaultConfig, $config)
            );
        };

        return $this;
    }

    /**
     * Register service providers.
     *
     * @return $this
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }

        return $this;
    }

    /**
     * Register request.
     *
     * @return $this
     */
    protected function registerRequest()
    {
        isset($this['request']) || $this['request'] = function () {
            return Request::createFromGlobals();
        };

        return $this;
    }

    /**
     * Register logger.
     *
     * @return $this
     */
    protected function registerLogger()
    {
        if (isset($this['logger'])) {
            return $this;
        }

        $logger = new Logger(str_replace('\\', '.', strtolower(get_class($this))));

        if ($logFile = $this['config']['log.file']) {
            $logger->pushHandler(new StreamHandler(
                    $logFile,
                    $this['config']->get('log.level', Logger::WARNING),
                    true,
                    $this['config']->get('log.permission', null))
            );
        } elseif ($this['config']['log.handler'] instanceof HandlerInterface) {
            $logger->pushHandler($this['config']['log.handler']);
        } else {
            $logger->pushHandler(new ErrorLogHandler());
        }

        $this['logger'] = $logger;

        return $this;
    }

    /**
     * @return $this
     */
    protected function registerHttpClient()
    {
        isset($this['http_client']) || $this['http_client'] = function ($app) {
            return new Client($app['config']->get('http', []));
        };

        return $this;
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }
}
<?php
namespace AI;
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/02
 * Time: 18:27
 */
class Entry
{
    /**
     * @param string $name
     * @param array $config
     *
     * @return \AI\Common\ServiceContainer
     */
    public function Init($name, array $config)
    {
        $namespace = Common\Tool\Str::studly($name);
        $application = "\\AI\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::Init($name, ...$arguments);
    }
}
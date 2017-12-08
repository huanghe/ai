<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 23:12
 */

namespace AI\Common\Traits;

use Closure;
use AI\Common\Contracts\EventHandlerInterface;
use AI\Common\Decorators\FinallyResult;
use AI\Common\Decorators\TerminateResult;
use AI\Common\Exceptions\InvalidArgumentException;
use AI\Common\ServiceContainer;

trait Observable
{
    /**
     * @var array
     */
    protected $handlers = [];

    /**
     * @param \Closure|EventHandlerInterface|string $handler
     * @param \Closure|EventHandlerInterface|string $condition
     *
     * @throws \AI\Common\Exceptions\InvalidArgumentException
     */
    public function push($handler, $condition = '*')
    {
        list($handler, $condition) = $this->resolveHandlerAndCondition($handler, $condition);

        if (!isset($this->handlers[$condition])) {
            $this->handlers[$condition] = [];
        }

        array_push($this->handlers[$condition], $handler);
    }

    /**
     * @param \Closure|EventHandlerInterface|string $handler
     * @param \Closure|EventHandlerInterface|string $condition
     */
    public function unshift($handler, $condition = '*')
    {
        list($handler, $condition) = $this->resolveHandlerAndCondition($handler, $condition);

        if (!isset($this->handlers[$condition])) {
            $this->handlers[$condition] = [];
        }

        array_unshift($this->handlers[$condition], $handler);
    }

    /**
     * @param string $condition
     * @param \Closure|EventHandlerInterface|string $handler
     */
    public function observe($condition, $handler)
    {
        $this->push($handler, $condition);
    }

    /**
     * @param string $condition
     * @param \Closure|EventHandlerInterface|string $handler
     */
    public function on($condition, $handler)
    {
        $this->push($handler, $condition);
    }

    /**
     * @param string|int $event
     * @param array ...$payload
     *
     * @return mixed|null
     */
    public function dispatch($event, $payload)
    {
        return $this->notify($event, $payload);
    }

    /**
     * @param string|int $event
     * @param array ...$payload
     *
     * @return mixed|null
     */
    public function notify($event, $payload)
    {
        $result = null;

        foreach ($this->handlers as $condition => $handlers) {
            if ($condition === '*' || ($condition & $event) === $event) {
                foreach ($handlers as $handler) {
                    $response = $this->callHandler($handler, $payload);

                    switch (true) {
                        case $response instanceof TerminateResult:
                            return $response->content;
                        case true === $response:
                            continue 2;
                        case false === $response:
                            break 2;
                        case !empty($response) && !($result instanceof FinallyResult):
                            $result = $response;
                    }
                }
            }
        }

        return $result instanceof FinallyResult ? $result->content : $result;
    }

    /**
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * @param \Closure $handler
     * @param array $payload
     *
     * @return mixed
     */
    protected function callHandler(Closure $handler, array $payload)
    {
        try {
            return $handler($payload);
        } catch (\Exception $e) {
            if (property_exists($this, 'app') && $this->app instanceof ServiceContainer) {
                $this->app['logger']->error($e->getCode() . ': ' . $e->getMessage(), [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
            }
        }
    }

    /**
     * @param $handler
     *
     * @return \Closure
     *
     * @throws \AI\Common\Exceptions\InvalidArgumentException
     */
    protected function makeClosure($handler)
    {
        if (is_callable($handler)) {
            return $handler;
        }

        if (is_string($handler)) {
            if (!class_exists($handler)) {
                throw new InvalidArgumentException(sprintf('Class "%s" not exists.', $handler));
            }

            if (!in_array(EventHandlerInterface::class, (new \ReflectionClass($handler))->getInterfaceNames(), true)) {
                throw new InvalidArgumentException(sprintf('Class "%s" not an instance of "%s".', $handler, EventHandlerInterface::class));
            }

            return function ($payload) use ($handler) {
                return (new $handler(isset($this->app) ? $this->app : null))->handle($payload);
            };
        }

        if ($handler instanceof EventHandlerInterface) {
            return function () use ($handler) {
                return $handler->handle(...func_get_args());
            };
        }

        throw new InvalidArgumentException('No valid handler is found in arguments.');
    }

    /**
     * @param $handler
     * @param $condition
     *
     * @return array
     */
    protected function resolveHandlerAndCondition($handler, $condition)
    {
        if (is_int($handler) || (is_string($handler) && !class_exists($handler))) {
            list($handler, $condition) = [$condition, $handler];
        }

        return [$this->makeClosure($handler), $condition];
    }
}

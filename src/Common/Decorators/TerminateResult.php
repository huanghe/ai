<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 23:20
 */
namespace AI\Common\Decorators;


class TerminateResult
{
    /**
     * @var mixed
     */
    public $content;

    /**
     * FinallyResult constructor.
     *
     * @param mixed $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }
}
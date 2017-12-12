<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:35
 */
namespace AI\Common\Exceptions;

use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpException.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class HttpException extends Exception
{
    /**
     * @var \Psr\Http\Message\ResponseInterface|null
     */
    public $response;

    /**
     * @var \Psr\Http\Message\ResponseInterface|\AI\Common\Tool\Collection|array|object|string
     */
    public $formattedResponse;

    /**
     * HttpException constructor.
     *
     * @param string                                   $message
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param null                                     $formattedResponse
     * @param int|null                                 $code
     */
    public function __construct($message, ResponseInterface $response = null, $formattedResponse = null, $code = null)
    {
        parent::__construct($message, $code);

        $this->response = $response;
        $this->formattedResponse = $formattedResponse;

        if ($response) {
            $response->getBody()->rewind();
        }
    }
}
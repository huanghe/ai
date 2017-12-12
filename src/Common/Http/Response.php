<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 23:21
 */
namespace AI\Common\Http;

use AI\Common\Tool\Collection;
use AI\Common\Tool\XML;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;

class Response extends GuzzleResponse
{
    /**
     * @return string
     */
    public function getBodyContents()
    {
        $this->getBody()->rewind();
        $contents = $this->getBody()->getContents();
        $this->getBody()->rewind();

        return $contents;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return  \AI\Common\Http\Response
     */
    public static function buildFromPsrResponse(ResponseInterface $response)
    {
        return new static(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    /**
     * Build to json.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Build to array.
     *
     * @return array
     */
    public function toArray()
    {
        $content = $this->getBodyContents();

        if (false !== stripos($this->getHeaderLine('Content-Type'), 'xml') || stripos($content, '<xml') === 0) {
            return XML::parse($content);
        }

        $array = json_decode($this->getBodyContents(), true);

        if (JSON_ERROR_NONE === json_last_error()) {
            return $array;
        }

        return [];
    }

    /**
     * Get collection data.
     *
     * @return \AI\Common\Tool\Collection
     */
    public function toCollection()
    {
        return new Collection($this->toArray());
    }

    /**
     * @return object
     */
    public function toObject()
    {
        return json_decode($this->getBodyContents());
    }

    /**
     * @return bool|string
     */
    public function __toString()
    {
        return $this->getBodyContents();
    }
}
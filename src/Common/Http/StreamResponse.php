<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 23:16
 */
namespace AI\Common\Http;

use AI\Common\Tool\File;

class StreamResponse extends Response
{
    /**
     * @param string $directory
     * @param string $filename
     *
     * @return bool|int
     */
    public function save($directory, $filename = '')
    {
        $this->getBody()->rewind();

        $directory = rtrim($directory, '/');

        if (!is_writable($directory)) {
            mkdir($directory, 0755, true); // @codeCoverageIgnore
        }

        $contents = $this->getBody()->getContents();

        if (empty($filename)) {
            $filename = md5($contents);
        }

        if (empty(pathinfo($filename, PATHINFO_EXTENSION))) {
            $filename .= File::getStreamExt($this->getBody());
        }

        file_put_contents($directory.'/'.$filename, $contents);

        return $filename;
    }

    /**
     * @param string $directory
     * @param string $filename
     *
     * @return bool|int
     */
    public function saveAs($directory, $filename)
    {
        return $this->save($directory, $filename);
    }
}
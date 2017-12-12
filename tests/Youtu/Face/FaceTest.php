<?php

namespace AI\Tests\Youtu\Face;

use AI\Entry;
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 15:56
 */
class FaceTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $config = require __DIR__.'/../../config/youtu.php';

        $result = Entry::Youtu($config)->face->select('detect')->where(['image' => file_get_contents(__DIR__ . '/file/face_detect.jpeg'), 'id_card_side' => 'front'])->get();//身份证

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/12
 */
namespace AI\Youtu\Face;

use AI\Youtu\Client;
use AI\Common\Exceptions\InvalidArgumentException;

/**
 * Class Face.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Face
{
    protected $client;
    /**
     * @var: 路径
     */
    protected $endPoint;
    /**
     * @var string
     */
    protected $versionUrl = 'youtu/api/';
    /**
     * @var string 人脸对比url后缀
     */
    private $matchEndPoint = 'match';
    /**
     * @var : data的参数
     */
    protected $params;

    public function __construct($app)
    {
        $this->client = new Client($app);
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-11
     *  updated_at: 2017-12-
     * @param $images
     * @return array|string
     *  desc   :
     */
    private function getEncodeImages($images)
    {
        if (is_string($images)) {
            return base64_encode(trim($images));
        }

        $result = [];
        foreach ($images as $image) {
            if (!empty($image)) {
                $result[] = base64_encode($image);
            }
        }

        return $result;
    }


    /**
     * 获取图片信息
     * @param  $content string
     * @return array
     */
    public static function getImageInfo($content)
    {
        $info = getimagesizefromstring($content);
        return [
            'mime' => $info['mime'],
            'width' => $info[0],
            'height' => $info[1],
        ];
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-7
     *  updated_at: 2017-12-
     *  desc   :
     */
    public function get()
    {
        $this->client->post($this->endPoint, $this->params);
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-7
     *  updated_at: 2017-12-8
     * @param string $param
     * @return $this
     *  desc   :    指定调用的接口
     */
    public function select($param = 'detect')
    {
        $allowOcrType = require __DIR__ . '/SupportType.php';
        if (!in_array($param, $allowOcrType)) {
            throw new InvalidArgumentException('invalid argument:' . $param);
        }
        $this->endPoint = $this->versionUrl . $param;
        return $this;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-8
     *  updated_at: 2017-12-
     * @param $condition
     * @return $this
     *  desc   :    请求的参数，一般包含 image
     */
    public function where($condition)
    {
        $this->params = $condition;
        if (isset($this->params['image'])) {
            $this->params['image'] = $this->base64Image($this->params['image']);
        }
        return $this;
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-
     *  updated_at: 2017-12-
     * @param $imagePath
     * @return string
     * @throws InvalidArgumentException
     *  desc   :    base64编码对应路径的文件
     */
    private function base64Image($imagePath)
    {
        $realImagePath = realpath($imagePath);
        if (!file_exists($realImagePath)) {
            throw new InvalidArgumentException('file ' . $imagePath . ' not exists');
        }
        return base64_encode(file_get_contents($realImagePath));
    }
}
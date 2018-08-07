<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2018/8/6
 */
namespace AI\Baidu\Body;

use AI\Baidu\Client;
use AI\Common\Exceptions\InvalidArgumentException;

/**
 * Class Body.
 *
 * @author hahaxixi <hahaxixicc@gmail.com>
 */
class Body
{
    protected $client;
    /**
     * @var: 路径
     */
    protected $endPoint;
    /**
     * @var string
     */
    protected $versionUrl = 'image-classify/v1/';

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
     *  author:HAHAXIXI
     *  created_at: 2017-12-11
     *  updated_at: 2018-8-6
     * @param $url
     * @return bool
     * @throws InvalidArgumentException
     *  desc   :
     */
    protected function validate($url)
    {
        $this->params['image'] = $this->getEncodeImages($this->params['image']);

        //编码后大小不超过4M
        if (empty($this->params['image']) || strlen($this->params['image']) >= 4 * 1024 * 1024) {
            throw new InvalidArgumentException('image size error');//SDK100
        }

        return true;
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
        $this->validate($this->endPoint);
        return $this->client->post($this->endPoint, $this->params);
    }

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-7
     *  updated_at: 2018-8-6
     * @param string $param
     * @return $this
     * @throws InvalidArgumentException
     *  desc   :    指定调用的接口
     */
    public function select($param = 'analysis')
    {
        $allowType = require __DIR__ . '/SupportType.php';
        if (!in_array($param, $allowType)) {
            throw new InvalidArgumentException('invalid argument:' . $param);
        }
        $this->endPoint = $this->versionUrl . 'body_' . $param;
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
        return $this;
    }
}
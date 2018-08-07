<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/11
 */
namespace AI\Baidu\Face;

use AI\Baidu\Client;
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
    protected $versionUrl = 'face/v2/';
    /**
     * @var array
     */
    protected $versionApi_1 = [
        'add', 'update', 'delete', 'get',
    ];
    /**
     * @var string 第二路由
     */
    protected $versionUrl_1 = 'face/v2/faceset/user/';
    /**
     * @var array
     */
    protected $versionApi_2 = [
        'getlist', 'getusers', 'adduser', 'deleteuser'
    ];
    /**
     * @var string 第三路由,人脸组
     */
    protected $versionUrl_2 = 'face/v2/faceset/group/';
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
     *  author:HAHAXIXI
     *  created_at: 2017-12-11
     *  updated_at: 2017-12-
     * @param $url
     * @return bool
     * @throws InvalidArgumentException
     *  desc   :
     */
    protected function validate($url)
    {
        // user_info参数 不超过256B
        if (isset($this->params['user_info'])) {

            if (strlen($this->params['user_info']) > 256) {
                throw new InvalidArgumentException('user_info size error');//SDK103
            }
        }

        // group_id参数 组成为字母/数字/下划线，且不超过48B
        if (isset($this->params['group_id'])) {

            if (is_array($this->params['group_id'])) {
                $groupIds = $this->params['group_id'];
            } else {
                $groupIds = array(
                    $this->params['group_id'],
                );
            }

            foreach ($groupIds as $groupId) {
                if (!preg_match('/^\w+$/', $groupId)) {
                    throw new InvalidArgumentException('group_id format error');//SDK104
                }

                if (strlen($groupId) > 48) {
                    throw new InvalidArgumentException('group_id size error');//SDK105
                }
            }

            $this->params['group_id'] = implode(',', $groupIds);
        }

        // uid参数 组成为字母/数字/下划线，且不超过128B
        if (isset($this->params['uid'])) {
            if (!preg_match('/^\w+$/', $this->params['uid'])) {
                throw new InvalidArgumentException('uid format error');//SDK106
            }

            if (strlen($this->params['uid']) > 128) {
                throw new InvalidArgumentException('uid size error');//SDK107
            }
        }

        if (isset($this->params['image'])) {
            $this->params['image'] = $this->getEncodeImages($this->params['image']);

            //编码后小于10m
            if (empty($this->params['image']) || strlen($this->params['image']) >= 10 * 1024 * 1024) {
                throw new InvalidArgumentException('image size error');//SDK100
            }
        } elseif (isset($this->params['images'])) {
            $images = $this->getEncodeImages($this->params['images']);
            $this->params['images'] = implode(',', $images);

            // 人脸比对 编码后小于20m 其他 10m
            if ($url == $this->matchEndPoint) {
                if (count($images) < 2 || strlen($this->params['images']) >= 20 * 1024 * 1024) {
                    throw new InvalidArgumentException('image size error');//SDK100
                }
            } else {
                if (count($images) < 1 || strlen($this->params['images']) >= 10 * 1024 * 1024) {
                    throw new InvalidArgumentException('image size error');//SDK100
                }
            }
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
        if (in_array($param, $this->versionApi_1)) {
            $versionUrl = $this->versionUrl_1;
        } elseif (in_array($param, $this->versionApi_2)) {
            $versionUrl = $this->versionUrl_2;
        } else {
            $versionUrl = $this->versionUrl;
        }
        $this->endPoint = $versionUrl . $param;
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
## Develop documents
<a href="http://blog.hahaxixi.cc/2017/12/27/AI-API/" target="_blank">开发文档</a>

## Support platform

 1.<a href="http://ai.baidu.com" target="_blank">百度AI开放平台</a>

 2.<a href="https://open.youtu.qq.com" target="_blank">腾讯AI开放平台</a>

 3.<a href="https://www.faceplusplus.com.cn" target="_blank">FACE++AI开放平台</a>


## Feature

- 统一主流AI平台SDK调用方法；
- 像查询数据库一样优雅调用API；

## Installation

composer require hahaxixi/ai

## Usage

```php
$config = [
    'baidu' => [
        'app_id' => '10489***',
        'app_key' => 'H3IUUHlkLibdo3ywdGF***',
        'secret_key' => 'SV3TRWfPakOL010uOthiaD***',
    ],
    'youtu' => [
             'app_id' => '1011***',
             'secret_id' => 'AKIDIROBe3bk2MadU9oDe1Rks***',
             'secret_key' => 'tlYRLAnE8wZBqQoZDh0GGKJF***',
             'user_id' => 269548****
    ]
    'face_plus' => [
                'api_key' => 'txLCeDRVAPl3BgQtvKlPO2HMw***',
                'api_secret' => 'ZICErqEtel-4448WsRu2GV***',
    ],
];

//百度
$result = Entry::Baidu($config)->face->select('detect')->where(['image' => file_get_contents(__DIR__ . '/file/face_detect.jpeg'), 'id_card_side' => 'front'])->get();
//腾讯优图
$result = Entry::Youtu($config)->face->select('detectface')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg', 'mode' => 1])->get();
//face++
$result =  Entry::FacePlus($config)->face->select('detect')->where(['image_file' =>__DIR__ . '/../../file/face_01.jpg' , 'return_attributes' => 'skinstatus'])->get();


```
## License

Apache License Version 2.0 see [Apache License](http://www.apache.org/licenses/LICENSE-2.0.html)

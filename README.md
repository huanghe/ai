## Support platform

 1.百度AI开放平台:https://ai.baidu.com/

 2.腾讯优图AI开放平台:https://open.youtu.qq.com

 3.Face++人工智能开放平台:https://www.faceplusplus.com.cn/

```
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
    'face_plus' => [
            'api_key' => 'txLCeDRVAPl3BgQtvKlPO2HMw***',
            'api_secret' => 'ZICErqEtel-4448WsRu2GV***',
        ],
    'youtu' => [
             'app_id' => '1011***',
             'secret_id' => 'AKIDIROBe3bk2MadU9oDe1Rks***',
             'secret_key' => 'tlYRLAnE8wZBqQoZDh0GGKJF***',
             'user_id' => 269548****
    ]

]
$result = Entry::Baidu($config)->face->select('detect')->where(['image' => file_get_contents(__DIR__ . '/file/face_detect.jpeg'), 'id_card_side' => 'front'])->get();//百度
$result =  Entry::FacePlus($config)->face->select('detect')->where(['image_file' =>__DIR__ . '/../../file/face_01.jpg' , 'return_attributes' => 'skinstatus'])->get();//face++
$result = Entry::Youtu($config)->face->select('detectface')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg', 'mode' => 1])->get();//腾讯优图


```
## License

Apache License Version 2.0 see http://www.apache.org/licenses/LICENSE-2.0.html
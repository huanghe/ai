## Feature


 - 统一主流AI平台SDK；
 - 像查询数据库一样优雅调用API；

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
             'user_id' => 2695484555
    ]

]
     $result = Entry::Baidu($config)->face->select('detect')->where(['image' => file_get_contents(__DIR__ . '/file/face_detect.jpeg'), 'id_card_side' => 'front'])->get();//百度
     $result =  Entry::FacePlus($config)->face->select('detect')->where(['image_file' =>__DIR__ . '/../../file/face_01.jpg' , 'return_attributes' => 'skinstatus'])->get();//face++
     $result = Entry::Youtu($config)->face->select('detectface')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg', 'mode' => 1])->get();//腾讯优图

```
The MIT License (MIT)

Copyright (c) 2017 hahaxixi

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
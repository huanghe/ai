## Develop documents
<a href="http://blog.hahaxixi.cc/2017/12/27/AI-API/" target="_blank">开发文档</a>

## Support platform

 1.<a href="http://ai.baidu.com" target="_blank">百度AI开放平台</a>

 2.<a href="https://open.youtu.qq.com" target="_blank">腾讯AI开放平台</a>

 3.<a href="https://www.faceplusplus.com.cn" target="_blank">FACE++AI开放平台</a>


## Feature

- 统一主流AI平台SDK调用方法；
- 像查询数据库一样优雅调用API；

## SimpleTest

1. [下载zip包](https://github.com/huanghe/ai/archive/master.zip) 或者clone本项目
2. 进入本项目根目录，执行`composer install`,（[不知道composer,点此了解PHP包管理工具composer](https://getcomposer.org/)）
3. 在项目目录`tests->config`下面添加配置文件`ai.php`（需要自己到各平台注册获取试用账号）,内容如：
	
	```php
	return [
	    'baidu' => [
	        'app_id' => '***',
	        'app_key' => '***',
	        'secret_key' => '***',
	    ],
	    'youtu' => [
	         'app_id' => '***',
	         'secret_id' => '***',
	         'secret_key' => '***',
	         'user_id' => ****
	    ]
	    'face_plus' => [
	         'api_key' => '***',
	         'api_secret' => '***',
	    ],
	];

	```

4. 在命令行执行命令,比如测试腾讯优图人脸识别：
`vendor/phpunit/phpunit/phpunit --testdox tests/Youtu/Face/FaceTest.php`

## Installation

`composer require hahaxixi/ai`

## Usage

```php
$config = [
    'baidu' => [
        'app_id' => '***',
        'app_key' => '***',
        'secret_key' => '***',
    ],
    'youtu' => [
         'app_id' => '***',
         'secret_id' => '***',
         'secret_key' => '***',
         'user_id' => ****
    ]
    'face_plus' => [
         'api_key' => '***',
         'api_secret' => '***',
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

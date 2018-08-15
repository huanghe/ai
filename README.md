## Recent Releases
- 增加百度图片搜索（2018-8-13）
- 支持百度人体分析（2018-8-7）
## Recent Test
- 所有API在2018-01-11通过测试
## Develop documents
<a href="http://blog.hahaxixi.cc/2017/12/27/AI-API/" target="_blank">开发文档</a>
## Feature

- 统一AI平台SDK调用方法；
- 像查询数据库一样优雅调用API；
- 所传参数和原平台开发文档保持一致，节约开发者学习成本

## Support platform(支持的平台)

 1.<a href="http://ai.baidu.com" target="_blank">百度AI开放平台</a>

 2.<a href="https://open.youtu.qq.com" target="_blank">腾讯AI开放平台</a>

 3.<a href="https://www.faceplusplus.com.cn" target="_blank">FACE++AI开放平台</a>


## SimpleTest

1. [下载zip包](https://github.com/huanghe/ai/archive/master.zip) 或者clone本项目
2. 进入本项目根目录，执行`composer install`,（[包管理工具composer](https://getcomposer.org/)）
3. 在项目目录`tests->config`下面添加配置文件`ai.php`（需要自己到各平台注册获取试用账号）,内容如：
	
	```php
	return [
        'debug' => true,
        'log' => [
            'level' => 'debug',
            'file' => './tests/logs/ai.log',//日志相对路径
            'template' => "<<<<<<<<\n{response}\n--------\n{error}",//日志模版
        ],
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

4. 在命令行下进入根目录,执行命令,比如测试腾讯优图人脸识别：
`vendor/phpunit/phpunit/phpunit --testdox tests/Youtu/Face/FaceTest.php`

## Installation

`composer require hahaxixi/ai`

## Usage
1.一般使用
```php
$config = [
    'log' => [...],//如，laravel:'file' => storage_path('logs/ai.log'),
    'baidu' => [...],
    'youtu' => [...],
    'face_plus' => [...],
];

//百度
$result = Entry::Baidu($config)->face->select('detect')->where(['image' => file_get_contents(__DIR__ . '/file/face_detect.jpeg'), 'id_card_side' => 'front'])->get();
//腾讯优图
$result = Entry::Youtu($config)->face->select('detectface')->where(['url' => 'http://open.youtu.qq.com/app/img/experience/face_img/face_06.jpg', 'mode' => 1])->get();
//face++
$result = Entry::FacePlus($config)->face->select('detect')->where(['image_file' =>__DIR__ . '/../../file/face_01.jpg' , 'return_attributes' => 'skinstatus'])->get();

```

2.Laravel使用

- 项目目录`config`下面添加配置文件`ai.php`,配置内容和上文SimpleTest一致
- 一行代码调用人脸检测示例
```php
$result = Entry::Baidu(config('ai'))->face->select('detect')->where(['image' => file_get_contents(__DIR__ . '/file/face_detect.jpeg'), 'id_card_side' => 'front'])->get();

```

3.Yii2使用

- 在配置文件`params-local.php`添加
```php
    'ai'=>[
        'log' => [...],
        'face_plus' => [...],
        'baidu' => [...],
        'youtu' => [...],
    ],
```
- 一行代码调用人脸检测示例
```php
$result = Entry::Baidu(Yii::$app->params['ai'])->face->select('detect')->where(['image' => file_get_contents(__DIR__ . '/file/face_detect.jpeg'), 'id_card_side' => 'front'])->get();

```

## License

Apache License Version 2.0 see [Apache License](http://www.apache.org/licenses/LICENSE-2.0.html)

<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/11
 * Time: 20:48
 */
return [
    'detect',//人脸检测
    'match',//人脸比对
    'verify',//人脸认证:uid用户id,group_id:用户组;image:图像base64编码
    'identify',//人脸识别   group_id:用户组;image:图像base64编码，每次仅支持单张图片，图片编码后大小不超过10M,ext_fields,user_top_num
];
<?php

namespace AI\Youtu;

class Auth
{
    const AUTH_URL_FORMAT_ERROR = -1;
    const AUTH_SECRET_ID_KEY_ERROR = -2;

    /**
     * 签名函数
     * @param   $expired:    过期时间
     * @param   $userid:     暂时不用
     * @return string          签名
     */
    public static function appSign($expired,$userid) {
        $secretId = Conf::$SECRET_ID;
        $secretKey = Conf::$SECRET_KEY;
        $appid  =  Conf::$APPID;
        if (empty($secretId) || empty($secretKey)) {
            return self::AUTH_SECRET_ID_KEY_ERROR;
        }
        
        $now = time();
        $rdm = rand();
        $plainText = 'a='.$appid.'&k='.$secretId.'&e='.$expired.'&t='.$now.'&r='.$rdm.'&u='.$userid;
        $bin = hash_hmac("SHA1", $plainText, $secretKey, true);
        $bin = $bin.$plainText;        
        $sign = base64_encode($bin);        
        
        return $sign;
    }
}


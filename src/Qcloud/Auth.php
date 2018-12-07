<?php

namespace AI\Qcloud;

class Auth
{
    const AUTH_URL_FORMAT_ERROR = -1;
    const AUTH_SECRET_ID_KEY_ERROR = -2;
    // 30 days
    const EXPIRED_SECONDS = 2592000;

    /**
     *  author:HAHAXIXI
     *  created_at: 2018/12/7
     *  updated_at: 2018/12/7
     * @param $appId
     * @param $secretId
     * @param $secretKey
     * @param $userId //暂时不用
     * @param $Bucket //暂时不用
     * @return int|string   签名
     *  desc   :
     */
    public static function appSign($appId, $secretId, $secretKey, $userId = "0", $bucket = "tencentyun")
    {
        $current = time();
        $expired = $current + self::EXPIRED_SECONDS;
        $rdm = rand();
        if (empty($secretId) || empty($secretKey)) {
            return self::AUTH_SECRET_ID_KEY_ERROR;
        }
        $plainText = 'a=' . $appId . '&b=' . $bucket . '&k=' . $secretId . '&e=' . $expired . '&t=' . $current . '&r=' . $rdm;
        $bin = hash_hmac("SHA1", $plainText, $secretKey, true);
        $bin = $bin . $plainText;
        $sign = base64_encode($bin);
        return $sign;
    }
}


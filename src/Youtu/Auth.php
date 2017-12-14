<?php

namespace AI\Youtu;

class Auth
{
    const AUTH_URL_FORMAT_ERROR = -1;
    const AUTH_SECRET_ID_KEY_ERROR = -2;
    // 30 days
    const EXPIRED_SECONDS = 2592000;

    /**
     *  author:HAHAXIXI
     *  created_at: 2017-12-12
     *  updated_at: 2017-12-
     * @param $appId
     * @param $secretId
     * @param $secretKey
     * @param $userId//暂时不用
     * @return int|string   签名
     *  desc   :
     */
    public static function appSign($appId, $secretId, $secretKey, $userId)
    {
        $now = time();
        $expired = $now + self::EXPIRED_SECONDS;
        $rdm = rand();
        if (empty($secretId) || empty($secretKey)) {
            return self::AUTH_SECRET_ID_KEY_ERROR;
        }
        $plainText = 'a=' . $appId . '&k=' . $secretId . '&e=' . $expired . '&t=' . $now . '&r=' . $rdm . '&u=' . $userId;
        $bin = hash_hmac("SHA1", $plainText, $secretKey, true);
        $bin = $bin . $plainText;
        $sign = base64_encode($bin);
        return $sign;
    }
}


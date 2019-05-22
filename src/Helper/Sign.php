<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-05-17
 * Time: 10:49
 */

namespace PoloDcApi\Helper;


class Sign {

    static public function getSecret($data, $key) {
        ksort($data);
        $sign_data = array();
        foreach ($data as $id => $item) {
            if (!empty($item)) {
                $sign_data[] = self::percentEncode($id) . '=' . self::percentEncode($item);
            }
        }
        $sign_data = implode('&', $sign_data);
        return self::encode($sign_data, $key);
    }

    // 使用urlencode编码后，将"+","*","%7E"做替换即满足 API规定的编码规范
    static private function percentEncode($str) {
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);
        return $res;
    }

    static private function encode($str, $key) {
        return base64_encode(hash_hmac('sha1', self::percentEncode($str), $key, true));
    }
}
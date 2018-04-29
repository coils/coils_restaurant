<?php
/**
 * gnavi_api_class.php
 *
 * ぐるなびレストラン検索API class
 * 
 * 使用する時は，アクセスキーを変更して下さい．
 * 
 * @copyright (c) 2018 Yuki Tsuji
 */

class Gnavi_api {

    /**
     * アクセスキー
     * @var string
     */
    private static $token = 'アクセスキー';

    /**
     * レストラン検索
     * @return object
     */
    public static function getRestaurants() {
        $api_url = "https://api.gnavi.co.jp/RestSearchAPI/20150630/";
        $access_key = self::$token;
        $format = "json";
        $get = [
            'format' => $format,
            'keyid' => $access_key
        ];
        if (!is_null(filter_input_array(INPUT_GET))) {
            $get += filter_input_array(INPUT_GET);
        }
        $url = sprintf("%s?%s", $api_url, http_build_query($get));
        $json = file_get_contents($url);
        $object = json_decode($json);
        return $object;
    }
}
?>

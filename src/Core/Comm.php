<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-05-18
 * Time: 13:46
 */

namespace PoloDcApi\Core;


abstract class Comm {
    const USER_AGENT = "POLO DATA CENTER SDK v1";
    const VERSION = 'v1';
    protected $is_sandbox = false;
    protected $format = 'json';
    protected $key = '';//用户key
    protected $secret = '';//用户secret
    protected $url_prefix = '';

    public function __construct($config) {
        $this->key = @$config['key'];
        $this->secret = @$config['secret'];
        $this->url_prefix = rtrim(@$config['url_prefix'], '/');
        $this->setSandBox();
    }

    protected function setSandBox() {
        $url_detail = parse_url($this->url_prefix, PHP_URL_PORT);
        if($url_detail != 80){
            $this->is_sandbox = true;
        }
    }

    /**
     * @param $url
     * @param array $data
     * @return string
     */
    public function makeUrl($url, array $data = []) {
        $url = ltrim($url, '/');
        if (!empty($data) && is_array($data)) {
            $query_string = http_build_query($data);
            if (false !== strpos($url, '?')) {
                $url .= '&' . $query_string;
            } else {
                $url .= '?' . $query_string;
            }
        }
        $url = sprintf("%s/%s/%s", $this->url_prefix, self::VERSION, $url);
        return $url;
    }

}
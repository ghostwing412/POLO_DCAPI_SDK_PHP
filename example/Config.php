<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-05-18
 * Time: 17:07
 */

require '../vendor/autoload.php';

class Config {
    public $options = [
        'url_prefix' => '',//接口访问链接前缀；文档中域名说明
        'key' => '',//用户key
        'secret' => ''//用户secret
    ];

    function __construct($controller) {
        $this->obj = new $controller($this->options);
    }

    public function __call($name, $arguments) {
        if(method_exists($this->obj, $name)){
            return call_user_func_array([$this->obj, $name], $arguments);
        }else{
            throw new \Exception('method '.$name. ' not exists');
        }
    }
}
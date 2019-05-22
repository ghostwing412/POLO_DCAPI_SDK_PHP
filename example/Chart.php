<?php

require 'Config.php';


$api = @$_GET['api'];
$method = [
    'frameUrl' => [
        ['main', 'frame'],
    ],
    'htmlData' => [
        '/dc_api_sdk_php/example/Chart.php?api=htmlData&{c_code=:(c_code)&}{cate_code=:(cate_code)&}{chart_code=:chart_code}',
    ]
];
class main {
    static public function frameUrl(){
        $api_obj = self::init();
        $url = $api_obj->frameUrl();
        echo "<script src='js/jquery-1.12.0.min.js' ></script>";
        echo "<script src='{$url}'></script>";
    }

    static public function htmlData(){
        $url_pattern = '/dc_api_sdk_php/example/Chart.php?api=htmlData&{c_code=:(c_code)&}{cate_code=:(cate_code)&}{chart_code=:chart_code}';
        $data = array_merge(['c_code'=>null, 'chart_code'=>null, 'cate_code'=>'zst', 'attr'=>null, 'sortFlag'=>null], $_GET);
        $api_obj = self::init();
        $result = $api_obj->htmlData($url_pattern, $data['cate_code'], $data['c_code'], $data['chart_code'], $data['attr'], $data['sortFlag']);
        if($result['is_html']){
            echo "<script src='js/jquery-1.12.0.min.js' ></script>";
            echo $result['data'];
        }else{
            echo json_encode($result['data']);
        }
    }

    static private function init(){
        return new Config(\PoloDcApi\Core\Chart::class);
    }

}
try {
    if(method_exists('main', $api)){
        call_user_func_array(['main', $api], []);
    }else{
        throw new \PoloDcApi\Helper\Submit_Exception('api 不存在');
    }
} catch (\PoloDcApi\Helper\Submit_Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
}

<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-06-20
 * Time: 11:27
 */
require 'Config.php';

$api = $_GET['api'];
$method = [
    'last' => [
        'dlt', //彩种
        \PoloDcApi\Core\Norm::DLT_DXB//norm标识
    ],
    'date' => [
        'dlt',//彩种
        date('Y-m-d', strtotime('-10 days')),
        date('Y-m-d')
    ]
];

try {
    $result = new Config(\PoloDcApi\Core\Norm::class);
    if (array_key_exists($api, $method)) {
        $data = call_user_func_array([$result, $api], $method[$api]);
        echo json_encode($data);
    }else{
        throw new \PoloDcApi\Helper\Submit_Exception('api 不存在');
    }
} catch (\PoloDcApi\Helper\Submit_Exception $e) {
    echo $e->getMessage().PHP_EOL;
    echo $e->getTraceAsString();
}

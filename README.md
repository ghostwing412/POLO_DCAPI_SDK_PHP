# dc_api_sdk_php

数据中心接口PHP版本SDK

项目地址:[Github](https://github.com/ghostwing412/POLO_DCAPI_SDK_PHP)

### 安装说明

+ 可直接从`Github`上面下载，项目中包含`autoload.php`可加载命名空间规则
+ `composer require polocai/dc_api_sdk_php`加入composer包管理

### `example`目录为调用实例

### 调用说明
+ 配置
        
        'url_prefix' => '',//接口访问链接前缀；文档中域名说明，不同域名区分沙盒模式及生产模式
        'key' => '',//用户key
        'secret' => ''//用户secret`
        
+ 走势图`htmlData`接口参数`url`

    0.  必须包含`:cate_code`，`:c_code`，`:chart_code`关键字
    1. 链接中`{xxx:(cate_code)xxx}`或者`{xxx:cate_code}`大括号内的内容将被cate_code参数替换
    
        0. 如果该参数为空，大括号整个以空值替换
        1. 如果该参数值为`zst`，那么替换结果为`xxxzstxxx`以及`xxxzst`







<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-05-20
 * Time: 17:22
 */

namespace PoloDcApi\Core;


use PoloDcApi\Helper\Submit;
use PoloDcApi\Helper\Submit_Exception;

class Chart extends Comm {
    /**
     * 获取走势图帧模式访问链接
     * @param string $cate_code 图形标识
     * @param null $lottery 彩种标识
     * @param string $box 容器$selector
     */
    public function frameUrl($cate_code = 'zst', $c_code = null, $box = 'body') {
        if ($this->is_sandbox) {
            $url = $this->url_prefix . '/public/dc_api/js/chart_builder.min.js';
        } else {
            $url = str_replace('/dcApi', '', $this->url_prefix) . '/public/dc_api/js/chart_builder_' . self::VERSION . '.min.js';
        }
        $query = [
            'key' => $this->key,
            'cate_code' => $cate_code,
            'box' => $box
        ];
        if (is_null($c_code)) {
            $query['c_code'] = $c_code;
        }
        return $url . '?' . http_build_query($query);
    }

    /**
     * 获取走势图数据
     * @param string $url 替换链接值 必须包含:cate_code，:c_code，:chart_code关键字
     * @param string $cate_code 走势图图形种类标识；默认zst，当时在页面有携带此参数提交时，必须带入
     * @param null|string $c_code 走势图彩种标识；默认为空，当时在页面有携带此参数提交时，必须带入
     * @param null|string $chart_code 走势图图形标识；默认为空，当时在页面有携带此参数提交时，必须带入
     * @param null|string $attr 走势图筛选参数；由走势图页面筛选控件操作，直接加入链接querystring
     * @param null|string $sortFlag 走势图排序；由走势图页面排序控件操作，直接加入链接querystring
     * @throws Submit_Exception
     * @return array 返回数组，is_html为true时，代表data值为页面数据；否则data为走势图插件访问接口返回数据
     */
    public function htmlData($url, $cate_code = 'zst', $c_code = null, $chart_code = null, $attr = null, $sortFlag = null) {
        $data['key'] = $this->key;
        foreach (['c_code', 'chart_code', 'cate_code', 'attr', 'sortFlag'] as $key => $value) {
            if (!is_null($$value)) {
                $data[$value] = $$value;
            }
        }
        if ($this->chkUrlKeywords('cate_code', $url) && $this->chkUrlKeywords('c_code', $url) && $this->chkUrlKeywords('chart_code', $url)) {
            $data['url'] = $url;
        } else {
            throw new Submit_Exception("url配置中必须同时包含:cate_code,:c_code,:chart_code或者:(cate_code),:(c_code),:(chart_code)关键字");
        }
        $data['format'] = 'json';
        $data = array_filter($data);
        $key = $this->secret;
        $data['secret'] = \PoloDcApi\Helper\Sign::getSecret($data, $key);//获取加密参数
        $url = $this->makeUrl('/chart/htmlData', $data);
        $curl = new Submit();
        $result = $curl->get($url);
        $return_data = [
            'is_html' => false,
            'data' => ''
        ];
        if (isset($result['html'])) {//gzuncompress(base64_decode())解压数据；需要1.11.0以上版本的jquery脚本
            $return_data['is_html'] = true;
            $return_data['data'] = gzuncompress(base64_decode($result['html']));
        } elseif (isset($result['data'])) {
            $return_data['data'] = gzuncompress(base64_decode($result['data']));//解压数据；
        }
        return $return_data;
    }

    private function chkUrlKeywords($keywords, $url) {
        return false !== strpos($url, ":({$keywords})") || false !== strpos($url, ":{$keywords}");
    }

}
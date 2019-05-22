<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-05-17
 * Time: 10:57
 */

namespace PoloDcApi\Core;

use PoloDcApi\Helper\Sign;
use PoloDcApi\Helper\Submit;
use PoloDcApi\Helper\Submit_Exception;

class Draw extends Comm {

    /**
     * 开奖最新数据
     * @param string $lottery 彩种标识
     * @param int $row 获取行数；
     * @return array
     * @throws \PoloDcApi\Helper\Submit_Exception
     */
    public function last($lottery, $row=5){
        $url = '/draw/last';
        $data = [
            'key' => $this->key,
            'format' => $this->format,
            'code' => $lottery,
            'row' => (int) $row
        ];
        $data['secret'] = Sign::getSecret($data, $this->secret);
        $url = $this->makeUrl($url,$data);
        $request = new Submit();
        $result = $request->get($url);
        return $result['data'];
    }

    /**
     * 获取历史数据
     * @param string $lottery 彩种标识
     * @param string $start 开始日期，格式：yyyyMMdd|yyyy-MM-dd
     * @param string $end 结束日期
     * @throws \PoloDcApi\Helper\Submit_Exception
     */
    public function date($lottery, $start, $end){
        $url = '/draw/date';
        $data = [
            'key' => $this->key,
            'format' => $this->format,
            'code' => $lottery,
            'start_date' => $start,
            'end_date' => $end
        ];
        if(!$this->chkDate($start) || !$this->chkDate($end)){
            throw new Submit_Exception("时间范围只支持yyyyMMdd或者yyyy-MM-dd");
        }
        $data['secret'] = Sign::getSecret($data, $this->secret);
        $url = $this->makeUrl($url, $data);
        $request = new Submit();
        $result = $request->get($url);
        return $result['data'];
    }

    private function chkDate($date){
        return preg_match('#\d{4}-\d{1,2}-\d{1,2}#', $date) || preg_match('#\d{4}\d{1,2}\d{1,2}#', $date);
    }
}
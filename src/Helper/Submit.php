<?php
/**
 * Created by PhpStorm.
 * User: ghostwing412
 * Date: 2019-05-17
 * Time: 10:56
 */

namespace PoloDcApi\Helper;


use PoloDcApi\Http\RequestCore;
use PoloDcApi\Http\RequestCore_Exception;
use PoloDcApi\Http\ResponseCore;

class Submit {



    /**
     * @param $url
     * @param null|bool $is_sandbox
     * @param null|string $proxy
     * @return bool
     * @throws Submit_Exception
     */
    public function get($url, $proxy = null) {
        try {
            $request = $this->newRequest($url, $proxy);
            $request->set_method(RequestCore::HTTP_GET);
            return $this->resultHandler($request);
        } catch (RequestCore_Exception $e) {
            throw new Submit_Exception($e->getMessage());
        }
    }

    /**
     * @param $url
     * @param array $data
     * @param null|bool $is_sandbox
     * @param null|string $proxy
     * @throws Submit_Exception
     */
    public function post($url, array $data = [], $proxy = null) {
        try {
            $request = $this->newRequest($url, $proxy);
            $request->set_method(RequestCore::HTTP_POST);
            $request->set_body(http_build_query($data));
            return $this->resultHandler($request);
        } catch (RequestCore_Exception $e) {
            throw new Submit_Exception($e->getMessage());
        }
    }

    /**
     * @param RequestCore $request
     * @return mixed
     * @throws RequestCore_Exception
     * @throws Submit_Exception
     */
    private function resultHandler(RequestCore &$request) {
        /**
         * @var ResponseCore $response
         */
        $response = $request->send_request(true);
        $result = json_decode($response->body, 1);
        if ($response->isOK()) {
            return $result;
        } elseif (is_array($result)) {
            throw new Submit_Exception("PoloDcApi request fail! err_code:{$result['code']}; err_msg:{$result['error']}; err_time:" . date('H:i:s m/d/Y', $result['time']));
        }
    }

    private function newRequest($url, $proxy) {
        $request = new RequestCore($url, $proxy);
        $request->ssl_verification = false;
        return $request;
    }



}
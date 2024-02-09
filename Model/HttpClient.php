<?php
/*
 *
 * @author VxCommerce
 * @copyright Copyright (c) 2024 VxCommerce (https://magento2.vxcommerce.net)
 * @package Magento CorePackage
 *
 */

namespace VxCommerce\Core\Model;

/**
 *
 */
class HttpClient{

    /**
     * @var
     */
    protected $_baseUrl;

    /**
     * @var
     */
    protected $_headers;

    /**
     * @var
     */
    protected $_requestInfo;

    /**
     * @return mixed
     */
    public function getBaseUrl() {
        return $this->_baseUrl;
    }


    /**
     * @param $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl) {
        $this->_baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaders() {
        return $this->_headers;
    }

    /**
     * @param $headers
     * @return $this
     */
    public function setHeaders($headers) {
        $this->_headers = $headers;
        return $this;
    }

    /**
     * @param $endpoint
     * @param $payload
     * @return HttpResponse
     * @throws \Exception
     */
    public function post(
        $endpoint,
        $payload
    ) {
        $url = $this->_baseUrl . $endpoint;

        $this->request($url, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->getHeaders(),
            CURLOPT_POSTFIELDS => $this->preparePayload($payload),
            CURLOPT_VERBOSE => false,
        ]);
        return $this->handleResponse();
    }

    /**
     * @param $endpoint
     * @return HttpResponse
     * @throws \Exception
     */
    public function get(
        $endpoint
    ) {
        $url = $this->_baseUrl . $endpoint;

        $this->request($url, array(
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->getHeaders(),
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
        ));
        return $this->handleResponse();
    }

    /**
     * @param $endpoint
     * @param $payload
     * @return HttpResponse
     * @throws \Exception
     */
    public function put(
        $endpoint,
        $payload
    ) {
        $url = $this->_baseUrl . $endpoint;

        $this->request($url, array(
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->getHeaders(),
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
        ));
        return $this->handleResponse();
    }

    /**
     * @param $endpoint
     * @param $payload
     * @return HttpResponse
     * @throws \Exception
     */
    public function delete(
        $endpoint,
        $payload
    ) {
        $url = $this->_baseUrl . $endpoint;

        $this->request($url, array(
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->getHeaders(),
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
        ));
        return $this->handleResponse();
    }

    /**
     * @param $url
     * @param $options
     * @return true
     * @throws \Exception
     */
    protected function request(
        $url,
        $options
    ) {
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);

        if ($response === false){
            throw new \Exception('Http Client Exception. Reason:'.curl_error($ch));
        }

        $this->_requestInfo['response'] = json_decode($response,true);
        $this->_requestInfo['info'] = curl_getinfo($ch);

        return true;
    }

    /**
     * @return HttpResponse
     */
    public function handleResponse(){
        return new HttpResponse($this->_requestInfo);
    }

    /**
     * @param $data
     * @return false|string
     */
    protected function preparePayload($data){

        $filtered = [];
        foreach ($data as $item){
            if (is_array($item) && !empty($item)){
                $filtered[] = array_filter($item);
            }
        }
        $payload = !empty($filtered) ? $filtered : array_filter($data);
        return json_encode($payload);
    }
}

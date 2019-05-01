<?php
/**
 * Created by PhpStorm.
 * User: zhaolm
 * Date: 2019-03-18
 * Time: 11:04
 */

namespace Map\Tengxun;

class TengxunMapApi
{
    /** @var string 应用key */
    protected $key = '';

    /** @var string 应用密钥 */
    protected $secret_key = '';

    protected $host = 'https://apis.map.qq.com';
    protected $path = '/ws/geocoder/v1';
    protected $sign = '';
    protected $params = [];


    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret_key = $secret;
    }

    /**
     * 地址转经纬度
     * @param string $address
     * @throws \Exception
     */
    public function getGeocoder($address = '')
    {
        try{
            $this->params['key'] = $this->key;
            $this->params['address'] = $address;

            $this->sign();
            $fullUrl = $this->generateFullUrl();


            return $this->parseContent($this->getRequest($fullUrl));
        }catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * 腾讯签名算法
     * 首先对参数按照升序排序
     * 请求路径 + ？+ （string）请求参数 + sk 进行拼接 然后调用md5进行签名计算
     */
    protected function sign()
    {
        arsort($this->params);

        $string = '';
        foreach ($this->params as $key=>$param)
        {
            $string .= $key . '=' . $param . '&';
        }


        $sign = md5($this->path . '?' . rtrim($string, '&') . $this->secret_key);
        $this->params['sig'] = $sign;
    }


    /**
     * 完整url
     * @return string
     * @throws \Exception
     */
    protected function generateFullUrl()
    {
        return $this->host . $this->path . '?' . http_build_query($this->params) . $this->sign;
    }


    protected function parseContent($content)
    {
        $content = json_decode($content, true);
        if (!isset($content['status']) || !empty($content['status'])){
            throw new \Exception('获取经纬度失败， 请稍后再试');
        }

        return $content['result']['location'];
    }


    protected function getRequest($url)
    {
        $otpions = [
            'http' => [
                'method' => 'GET',
                'timeout' => '2'
            ]
        ];

        $context = stream_context_create($otpions);
        return file_get_contents($url, false, $context);
    }

}
<?php

/**
 * Created by PhpStorm.
 * User: dmk
 * Date: 2016/9/23
 * Time: 21:32
 */
namespace Cxycdz\Curl;
//这个就是我们刚才自己定义的命名空间

class Curl
{
// CURL http post 方式提交数据
    function curl_http_post($url, $data = array())
    {

        return $this->curl_get_contents($url, $data, false);
    }

// CURL http get 方式获取网页
    function curl_http_get($url)
    {
        return $this->curl_get_contents($url, array(), false);
    }

    // CURL https post 方式提交数据
    function curl_https_post($url, $data)
    {
        return $this->curl_get_contents($url, $data, true);
    }


// CURL https get 方式获取网页
    function curl_https_get($url)
    {
        return $this->curl_get_contents($url, array(), true);
    }


    //CURL 获此网页内容
    function curl_get_contents($url, $data = array(), $https = false)
    {
        $results['error'] = '';
        $results['status'] = 0;
        $results['data'] = array();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $curl = curl_init();                              // 启动一个CURL会话


        if (!empty($data) && is_array($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);                        // 发送一个常规的Post请求
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);              // Post提交的数据包
        }
        if ($https) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);              // 对认证证书来源的检查
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);              // 从证书中检查SSL加密算法是否存在
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);              // 使用自动跳转
        }
        curl_setopt($curl, CURLOPT_URL, $url);                      // 要访问的地址
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);                    // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0);                      // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);              // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);          // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);                 // 自动设置Referer

        $results['data'] = curl_exec($curl);                     // 执行操作
        if (curl_errno($curl)) {
            $results['error'] = curl_error($curl);                    //捕抓异常
        }
        curl_close($curl);                                              // 关闭CURL会话
        return $results;                                                // 返回数据

    }


}
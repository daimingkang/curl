#安装
```
 php composer require cxycdz/curl
```
或者在你的composer.json中的requeire中加入
```
"cxycdz/curl":"~1.0"
```
#配置
在config/app.php的providers中配置
```
'providers' => [

     ...
        Cxycdz\Curl\CurlProvider::class,
```        
#使用
在控制器中直接
 ```
    $curl=app('curl');
    $data=$curl->curl_http_get('http://www.cxycdz.cn');
    .....
```     
更多文档进入www.cxycdz.cn    
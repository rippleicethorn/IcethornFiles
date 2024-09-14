<?php
$token = $_GET['key'];//获取安全秘钥

$key = 'xiaolubo-cache';//设置一个安全秘钥，防止被人恶意访问

if($token != $key){//两者秘钥对比是否一致

    exit('No Access');
    
}
require 'cache.inc.php';//引入cache

$cache = new Cache('./Cache/',600); //缓存目录路径，删除600秒前生成的临时文件，秒数可根据自己调用量调整

$cache->clean();//开始清理缓存

//正确清理缓存  域名/hcapi.php?key=你的安全秘钥


echo 'ok';
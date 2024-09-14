<?php

// error_reporting(0);
//跨域
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: x-requested-with,content-type');
header('Access-Control-Allow-Methods: GET, POST');

/*if (isset($_SERVER['HTTP_REFERER'])) {
    if (stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) {
        echo '{"code":110,"msg":"看什么看，再看我报警了。。"}';
        exit;
    }
} else {
      echo '{"code":110,"msg":"看什么看，再看我报警了。。"}';
      exit;
}*/
include ('data.php');
    $json = [
       'code' => 1,
       'data' => $lele
    ];
die(json_encode($json));


//$config = file_get_contents('config.json'); 

//echo $config;

?>
<?php 
error_reporting(0); //抑制所有错误信息
include("tj.php");//统计在线人数代码
include("./admin/data.php");
require 'cache.inc.php';//cache缓存开启
header("Content-type:text/html;charset=utf-8");   //  设置编码
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');//禁止页面被缓存
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
header('Access-Control-Allow-Origin: *');//跨域
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: x-requested-with,content-type');
header('Access-Control-Allow-Methods: GET, POST');

$cache = new Cache('./Cache/',600); //省略参数即采用缺省设置, $cache = new Cache($cachedir)，参数二为缓存时间单位/秒;
$url = urldecode($_GET['url']);
$url = str_replace("", "", $url);
$url = str_replace("", "", $url);
$url = str_replace("", "", $url);
$url = str_replace("", "", $url);
	if (empty($url)) {
      exit('<html>
	  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
      <meta name="robots" content="noarchive">
      <title>冰棘视频播放器</title>
	  <link rel="shortcut icon" href="http://icethorn.gitee.io/icethornfilms/Pictures/pink.jpg">
      <style>
      h1{color:#FF00FF; text-align:center; font-family: Microsoft Jhenghei;}p{color:#FF00FF; font-size: 1.2rem;text-align:center;font-family: Microsoft Jhenghei;}

      </style>
      </head>
      <body style="background: #FFFFFF url(http://qqjsz.cn/p/606839b9.jpg) no-repeat fixed center;">
      <table width="100%" height="100%" align="center"><tbody><tr>
      <td align="center">
      <h1><b>冰棘视频播放器<br><h1>您好像没有输入视频链接地址哦</h1><p>本播放器只做学习交流，使用本播放器造成的任何后果概不负责</p><p><font size="2">2021 All Rights Reserved <a href="http://icethorn.gitee.io/icethornfiles" target="_Blank">冰棘视频播放器</a><br>所有资源均来源第三方资源，并不提供影片资源存储，也不参与录制、上传相关视频，视频版权归属其合法持有人所有<br>本站不对使用者的行为负担任何法律责任。如果有因为本站而导致您的权益受到损害，请与我们联系，我们将理性对待，协助你解决相关问题。<a href="http://icethorn.gitee.io/icethornfiles/xieyi.html" target="_Blank">免责声明</a></font></p></b></h1></td></tr></tbody></table>
      </body>
      <script src="广告位"></script>
      </html>');
      } else {
		$type = $cache->load(); //装载缓存,缓存有效则不执行以下页面代码
		if($type == ''){//读取缓存
		if(strstr($url, '.m3u8')==true || strstr($url, '.mp4')==true || strstr($url, 'cdn.lby')==true || strstr($url, '.flv')==true){
		$type = str_replace("cdn.lby","cdnvip.lby",$url);;//获取播放链接
		}
		if($type == ''){//读取缓存
		$fh = file_get_contents("https://sha.4v0r.cn/xunhuanjson.php?url=".$lele['uid']."&my=".$lele['token']."&url=".$url);//接口一
        $jx = json_decode($fh, true);
        $type =$jx['url'];
		}
		if (strstr($url, 'cqzyw.net') == true || strstr($url, 'haodanxia') == true) { //阿里资源接口
        $type = $url;
        }
        if (!empty(urldecode($_REQUEST['digest']))) {
        $type = $url . '&digest=' . urldecode($_REQUEST['digest']);}
		if(strstr($url, '_xiaoluobo')){//微云接口
        $fh = file_get_contents($lele['wyapi'].$url);//接口四
        $jx = json_decode($fh, true);
        $type =$jx['url'];
		}
		if($type == ''){//接口一为空调用接口二
        $fh = file_get_contents($lele['jxapi2'].$url);//接口二
        $jx = json_decode($fh, true);
        $type =$jx['url'];
		}	
		if($type == ''){//接口二为空调用接口三
        $fh = file_get_contents($lele['jxapi3'].$url);//接口三
        $jx = json_decode($fh, true);
        $type =$jx['url'];
		}
		}
		if(strstr($url, 'mgtv.com') == false){//芒果链接不写入缓存
		
		if($type != '')$cache->write(1,$type);//缓存播放解析好的播放链接，作用提升网站打开速度
		}

	}
		if (strstr
		($url, 'fun.tv')
		.strstr($url,'miguvideo.com')
		.strstr($url,'sohu.com')
//		.strstr($url,'待添加域名')  //需要CK播放器播放的复制这里的代码递增添加
		== true){//指定使用ck播放器判断代码
			$player = 'ckplayer';//选用ck播放器，其他播放器改名字，名字自定义随你取
			}else{//否则使用dp播放器
			$player = 'dplayer';//选用dp播放器，其他播放器改名字，名字自定义随你取
			}
			if($type == ''){
				exit('<html><meta name="robots" content="noarchive">
	  <style>h1{color:#FFFFFF; text-align:center; font-family: Microsoft Jhenghei;}p{color:#CCCCCC; font-size: 1.2rem;text-align:center;font-family: Microsoft Jhenghei;}</style>
	  <body bgcolor="#000000"><table width="100%" height="100%" align="center"><td align="center"><h1>解析失败，请稍后再试~</font><font size="2"></font></p></table></body></html>');
			}
     
	 function get_url($url, $type = 0, $post_data = '', $ua = '' , $cookie = '',  $redirect = true){
		$refere = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$header = array("Referer:".$refere,"User-Agent:".$_SERVER['HTTP_USER_AGENT']);
		// 初始化cURL
		$curl = curl_init();
		// 设置网址
		curl_setopt($curl,CURLOPT_URL, $url);
		// 设置UA
		if(empty($ua) == false){
			$header[] = 'User-Agent:'.$_SERVER['HTTP_USER_AGENT'];
		}
		// 设置Cookie
		if(empty($cookie) == false){
			$header[] = 'Cookie:'.$cookie;
		}
		// 设置请求头
		if(empty($ua) == false or empty($cookie) == false or empty($header) == false){
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}
		// 设置POST数据
		if($type == 1){
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		}
		// 设置重定向
		if($redirect == false){
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		}
		//允许执行的最长秒数
		curl_setopt($curl,CURLOPT_TIMEOUT,10); 
		// 过SSL验证证书
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		// 将头部作为数据流输出
		curl_setopt($curl, CURLOPT_HEADER, false);
		// 设置以变量形式存储返回数据
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// 请求并存储数据
		$return = curl_exec($curl);
		// 分割头部和身体
		if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200'){
			$return_header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
			$return_header = substr($return, 0, $return_header_size);
			$return_data = substr($return, $return_header_size);
		}
		// 关闭cURL
		curl_close($curl);
		// 返回数据
		return $return;
	}


?>
<?php 

if($player == 'dplayer' || is_mobile() == true){
echo '<!DOCTYPE html>
<html lang="zh-CN">
';}else{
echo '<html lang="zh-CN">
';}
?>
<head>
<title data-vue-meta="true">冰棘视频播放器</title>
<link rel="shortcut icon" href="http://icethorn.gitee.io/icethornfilms/Pictures/pink.jpg">
<meta data-vue-meta="true" itemprop="name" content=""/>
<meta data-vue-meta="true" itemprop="image" content="./favicon.ico" />
<meta data-vue-meta="true" name="description" itemprop="description" content="">
<meta data-vue-meta="true" name="keywords" content="Bilibili,哔哩哔哩,哔哩哔哩动画,哔哩哔哩弹幕网,弹幕视频,B站,弹幕,字幕,AMV,MAD,MTV,ANIME,追新番,新番动漫,新番吐槽,巡音,镜音双子,千本樱,初音MIKU,舞蹈MMD,MIKUMIKUDANCE,洛天依原创曲,洛天依翻唱曲,洛天依投食歌,洛天依MMD,vocaloid家族,OST,BGM,动漫歌曲,日本动漫音乐,宫崎骏动漫音乐,动漫音乐推荐,燃系mad,治愈系mad,MAD MOVIE,MAD高燃">
<<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1,viewport-fit=cover">
<meta name="renderer" content="webkit"> <!-- 启用360浏览器的极速模式(webkit) -->
<meta name="theme-color" content="#de698c">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="applicable-device" content="mobile">
<meta name="screen-orientation" content="portrait">
<meta name="x5-orientation" content="portrait">
<?php
if($player == 'dplayer' || is_mobile() == true){
	echo '<link rel="stylesheet" href="./css/btjsonplayer.min.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/js/jquery.min.js"></script>
	<script type="text/javascript" src="./btjson/js/btjson.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/btjsonplay.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/js/layer.min.js"></script>';
}else{
echo '<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/ckplayerx/ckplayer.js"></script>';
}
?>
<?php
if(strpos($type,'m3u8')){//如过你们喜欢使用P2P加速  那么请把下面的hls.min.js改成hls.p2p.js即可
echo '<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/js/hls.min.js"></script>';
//'<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/js/hls.p2p.js"></script>';
}elseif(strpos($type,'flv')){
echo'<script type="text/javascript" type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/js/flv.min.js"></script>';
}
?>
<meta name="referrer" content="Origin">
</head>
<body>
<?php
if($player == 'dplayer' || is_mobile() == true){
echo '<div id="player" style="position:absolute;left:0px;top:0px;"></div>
<div id="ADplayer" style="position:absolute;left:0px;top:0px;"></div>
<div id="ADtip" style="position:absolute;left:0px;top:0px;"></div>
<script>
var up = {
	"usernum":"'.$users_online.'",//在线人数
	"mylink":"",//域名需要加上https://
	"diyid":[0,"lele",1]//自定义弹幕id
	}
var config = {
	"api":"/dmku/",//弹幕接口   前面架设自己的域名 防止后台弹幕库报错    例如   https://www.baidu.com/dmku/
	"url":"'.$type.'",//视频链接
	"id":"'.md5($_GET['url']).'",//视频id
	"sid":"'.$_GET['sid'].'",//集数id
	"pic":"'.$_GET['pic'].'",//视频封面
	"title":"'.$_GET['name'].'",//视频标题
	"next":"'.$_GET['next'].'",//下一集链接
	"user": "'.$_GET['user'].'",//用户名
	"group": "'.$_GET['group'].'",//用户组
	}
lele.start()
</script>';
}else{
echo '<div class="huiv"></div>
<script type="text/javascript">var huiid = "'.$type.'"; </script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/btjson/danmu@latest/ckplayerx/player.js"></script>';
}
function is_mobile(){
	//获取USER AGENT
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	//分析数据
	$is_pc = (strpos($agent, 'windows nt')) ? true : false; 
	$is_iphone = (strpos($agent, 'iphone')) ? true : false; 
	$is_ipad = (strpos($agent, 'iPad')) ? true : false; 
	$is_android = (strpos($agent, 'android')) ? true : false;  //输出数据
	
	if ($is_iphone || $is_ipad || $is_android){
			return true;
		}else{
			return false;
		}}
?>
</body>

</html>
<?php
error_reporting(0);
include('config.php');
$token = $_COOKIE["admin_token"];
$session = md5($conf['admin_user'].md5($conf['admin_pwd']));
 if($session !== $token){
    exit("error");
 }
  if (isset($_GET['act']) && $_GET['act'] == 'setting') {
    $datas = $_POST;
    $data = $datas['lele'];
    $json = var_export($data, true);
    if (file_put_contents('data.php', "<?php\n \$lele = ".$json.";\n?>")) {
        echo '{code:1,msg:修改成功}';
    } else {
        echo "<script>alert('修改失败！可能是文件权限问题，请给予data.php写入权限！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $lele = $data;
}
if (isset($_GET['act']) && $_GET['act'] == 'reset' ) {
	$file = 'luobo.config.php'; //还原配置
    $newFile = 'data.php'; //还原文件
    copy($file,$newFile); //拷贝到新目录
echo '<script language="javascript"> alert("还原成功~");'.'location.href="'.$_SERVER["HTTP_REFERER"].'";</script>';
}
?>
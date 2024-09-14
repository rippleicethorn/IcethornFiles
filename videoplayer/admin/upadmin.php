<?php include_once('head.php')?>
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="//cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<?php
error_reporting(0);
include('config.php');
if($token=$_COOKIE["admin_token"]){
	$session = md5($conf['admin_user'].md5($conf['admin_pwd']));
	if($session==$token){
		if(isset($_POST['id'])&&$_POST['id']==1){
			$myfile = fopen("config.php", "w");
			$txt = '<?php
$conf=array(
	"admin_user" => "'.$_POST['username'].'",
	"admin_pwd" => "'.$_POST['password'].'",
);
?>';
			fwrite($myfile, $txt);
			fclose($myfile);
			echo '<script language="javascript"> alert("管理账户修改成功，请牢记账号密码。\n新账号：'.$_POST['username'].'\n新密码：'.$_POST['password'].'");</script>';
			echo '<script language="javascript">window.location.href=\'login.php\';</script>';
		}
	}else{
		echo '<script language="javascript">window.location.href=\'login.php\';</script>';
	}
}else{
	echo '<script language="javascript">window.location.href=\'login.php\';</script>';
}
?>
<body>
<?php include_once('daohang.php')?>
<div class="container">
<div class="row">
<!--管理员信息修改-->
<div class="panel panel-success form-group">
  <div class="panel-heading">
    <h3 class="panel-title">管理员账号修改</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <div class="page-header">
        <h3>管理员账号修改<small>（若只修改密码，账号请填写原账号即可）</small></h3>
      </div>
      <form action="upadmin.php" method="post">
      <input type="hidden" name="id"  value="1">
      <div class="form-group">
        <label>管理员账号设置：</label>
        <input type="text" name="username" class="form-control" placeholder="请输入新账号" required="required">
      </div>
      <div class="form-group">
        <label>管理员密码设置：</label>
        <input type="password" name="password" class="form-control" placeholder="请输入新密码" required="required">
      </div>
      <div class="form-group" style=" text-align:center"><small>（提示：如果账号密码忘记，将 后台/config.php 文件替换成刚下载的原始文件即可还原，设置的数据不会丢失。）</small></div>
      <button type="submit" class="btn btn-success btn-block">确定修改</button>
      </form>
    </div>
  </div>
</div>
<?php include_once('author.php')?>
</body>
</html>


<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="">冰棘弹幕客户端后台系统 - 管理中心</a> </div>
    <div class="collapse navbar-collapse" id="example-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
      <?php if(php_self() == 'upadmin.php'){echo '<li class="active">';}else{echo '<li>';}?><a href="upadmin.php"><span class="glyphicon glyphicon-user"></span>账号修改</a></li>
      <?php if(php_self() == 'index.php'){echo '<li class="active">';}else{echo '<li>';}?><a href="index.php"><span class="glyphicon glyphicon-list-alt"></span>网站信息</a></li>
      <?php if(php_self() == 'dm.php'){echo '<li class="active">';}else{echo '<li>';}?><a href="dm.php"><span class="glyphicon glyphicon-exclamation-sign"></span>弹幕管理</a></li>
      <?php if(php_self() == 'exit.php'){echo '<li class="active">';}else{echo '<li>';}?><a href="exit.php"><span class="glyphicon glyphicon-off"></span>安全退出</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
function php_self(){
      $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
      return $php_self;
  }
?>
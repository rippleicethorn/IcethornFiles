<?php include('data.php');?>
<?php include_once('head.php')?>
<link rel="stylesheet" type="text/css" href="https://www.layuicdn.com/layui/css/layui.css" />
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<?php
error_reporting(0);
include('config.php');
$token = $_COOKIE["admin_token"];
$session = md5($conf['admin_user'].md5($conf['admin_pwd']));
if($session !== $token){
echo '<script language="javascript">window.location.href=\'login.php\';</script>';
  }
?>
<body>
<?php include_once('daohang.php')?>
<form class="layui-form layui-form-pane"  name="configform" id="configform" >
	<div class="layui-tab" overflow>
 		<div class="layui-tab-content">
				<div class="layui-tab-item layui-show" name="基本设置">
						<div class="layui-tab" overflow>
						<ul class="layui-tab-title">
							<li class="layui-this">弹幕列表</li>
							<li class="">举报列表</li>
						</ul>
					<div class="layui-tab-content">
						<div class="layui-tab-item layui-show" name="弹幕列表">
                        <div class="chu" style="margin-top:10px;text-align:center;">
								<div class="demoTable layui-form-item">
									<div class="layui-inline">
									<label class="layui-form-label">搜索</label>
									<div class="layui-input-inline">
										<input class="layui-input"  id="textdemo" placeholder="请输入弹幕id或弹幕关键字">
									</div>
									<button class="layui-btn" lay-submit="search_submits" type="button" lay-filter="reloadlst_submit">搜索</button>
									</div>
								</div>
							</div>
								<table class="layui-hide" id="dmlist" lay-filter="dmlist">
								</table>
						</div>

					<div class="layui-tab-item" name="举报列表">
								<table class="layui-hide" id="dmreport" lay-filter="report">
								</table>
					</div>

					</div>
					</div>
				</div>
				</div>
		</div>
	</div>
</form>
<script type="text/html" id="listbar">
<a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="reffer" >访问</a>
<a class="layui-btn layui-btn-xs" lay-event="dmedit" >编辑</a>
<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" >删除</a>
</script>
<script type="text/html" id="reportbar">
<a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="reffer" >访问</a>
<a class="layui-btn layui-btn-xs" lay-event="edit" >误报</a>
<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" >删除</a>
</script>
<table id="dmlist" lay-filter="dmlist"></table>
<script type="text/javascript" src="https://www.layuicdn.com/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="./js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="./js/config.js" type="text/javascript" charset="utf-8"></script>
<script type="text/html" id="toolbarDemo">
  <div class="layui-btn-container">
    <button class="layui-btn layui-btn-sm" lay-event="del">删除选中</button>
    <button class="layui-btn layui-btn-sm" lay-event="shuaxin">刷新列表</button>
  </div>
</script>
 
<script type="text/template" id="bondTemplateList">

    <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" lay-filter="component-form-group" id="submits" onsubmit="return false">
            <div class="layui-row layui-col-space10 layui-form-item">
                <input type="hidden" name="cid" value="{{ d[4] }}">
                <div class="layui-col-lg5">
                    <label class="layui-form-label">ID：</label>
  						<div class="layui-input-block">
              <div class="layui-input-inline" style="width: 140px;">
                        <input type="text" name="id" placeholder="请输入名称" autocomplete="off" lay-verify="required" class="layui-input" value="{{ d[0]?d[0]:'' }}" {{# if(d[0]){ }}disabled{{# } }}>
                    </div>
						<div class="layui-inline" style="left: -11px;">
					</div>
				</div>
                </div>
                <div class="layui-col-lg5">
                    <label class="layui-form-label">颜色：</label>
  						<div class="layui-input-block">
							<div class="layui-input-inline" style="width: 140px;">
								<input type="text" name="color" placeholder="请选择颜色" class="layui-input" id="test-form-input" value="{{ d[3]?d[3]:'' }}">
							</div>
						<div class="layui-inline" style="left: -11px;">
						<div id="test-form"></div>
					</div>
				</div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">内容:</label>
                    <div class="layui-input-block">
                    <textarea name="text" placeholder="请输入内容" class="layui-textarea"
                              lay-verify="required">
                        {{ d[5] ? d[5]:'' }}
                    </textarea>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="bond_sumbit">立即提交</button>
                </div>
            </div>
        </form>
    </div>
					
</script>         


</body>
</html>
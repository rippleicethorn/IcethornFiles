<?php include('data.php');?>
<?php include_once('head.php')?>
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="https://cdn.bootcss.com/bootstrap-colorpicker/3.0.0-beta.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="//cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap-colorpicker/3.0.0-beta.1/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="https://www.layuicdn.com/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="./js/config.js" type="text/javascript" charset="utf-8"></script>
<script>
$(function() {
    $('#color').colorpicker({
            allowEmpty:true,//允许为空,显示清楚颜色按钮
            color: "<?php echo $lele['color']?>",//初始化颜色
            showInput: true,//显示输入
            containerClassName: "full-spectrum",
            showInitial: true,//显示初始颜色,提供现在选择的颜色和初始颜色对比
            showPalette: true,//显示选择器面板
            showSelectionPalette: true,//记住选择过的颜色
            showAlpha: true,//显示透明度选择
            maxPaletteSize: 7,//记住选择过的颜色的最大数量
            preferredFormat: "hex"//输入框颜色格式,(hex十六进制,hex3十六进制可以的话只显示3位,hsl,rgb三原
    });
});
</script>
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
<div class="container">
<div class="row">
<!--网站信息修改-->
<div class="panel panel-primary form-group">
  <div class="panel-heading">
    <h3 class="panel-title">网站信息修改</h3>
  </div>
  <div class="panel-body"> 
  <form name="leleconfig" id="leleconfig">
  <input type="hidden">
    <!--全局信息修改 分类一-->
        <div class="form-group">
          <div class="form-group"><label>弹幕播放器开关</label></div>
          <label class="checkbox-inline">
              <input type="radio" value="on" name="lele[danmuon]" <?php $t=$lele['danmuon'];  if ($t=="on") { echo "checked";} ?> > 开启弹幕</span></label>
             <label class="checkbox-inline"><input type="radio" value="off" style=" margin-left:20px;" name="lele[danmuon]" <?php $t=$lele['danmuon'];  if ($t=="off") { echo "checked";} ?> > 关闭弹幕</span></label>
        </div>
        <div class="form-group">
          <label>主题颜色<small>（进度条、按钮颜色等）</small></label>
          <div class="form-group"> <div class="input-group"><div class="input-group-addon">请选择颜色</div><input type="text" class="form-control" name="lele[color]" id="color" placeholder="颜色代码 例如：#00a1d6"></div></div>
        </div>
        <div class="form-group">
          <label>播放器LOGO<small>（播放器右上角的logo，建议透明logo效果最佳）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[logo]" class="form-control textarea animate-box" rows="1" placeholder="图片地址 例如：/xiaoluobo/logo.png" ><?php echo $lele['logo']?></textarea>
        </div>
        <div class="form-group">
          <label>加载等待时间<small>（跳转等待时间,输入"0"或 空 则不开启等待时间）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[waittime]" class="form-control textarea animate-box" rows="1" placeholder="单位/秒 loading页等待时间" ><?php echo $lele['waittime']?></textarea>
        </div>
        <div class="form-group">
          <label>弹幕发送间隔<small>（每秒只能发送一次弹幕）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[sendtime]" class="form-control textarea animate-box" rows="1" placeholder="单位/秒 指的是间隔几秒才能发送新弹幕" ><?php echo $lele['sendtime']?></textarea>
        </div>
        <div class="form-group">
          <label>弹幕礼仪文字<small>（弹幕输入框显示文字，建议四字之内）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[dmliyi]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边文字提示" ><?php echo $lele['dmliyi']?></textarea>
        </div>
         <div class="form-group">
          <label>弹幕礼仪链接<small>（点击弹幕礼仪文字跳转链接）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[dmrule]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边按钮链接" ><?php echo $lele['dmrule']?></textarea>
        </div>
        <div class="form-group">
          <label>账号<small>（解析账号在后台获取,后台地址#）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[uid]" class="form-control textarea animate-box" rows="1" placeholder="解析账号" ><?php echo $lele['uid'] ?></textarea>
        </div>
        <div class="form-group">
          <label>密钥<small>（这里填写你的密钥，在#平台可以查看）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[token]" class="form-control textarea animate-box" rows="1" placeholder="密钥地址" ><?php echo $lele['token']?></textarea>
        </div>
        <div class="form-group">
          <label>备用json2<small>（这里填写你的微云json接口）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[wyapi]" class="form-control textarea animate-box" rows="1" placeholder="密钥地址" ><?php echo $lele['jxapi2']?></textarea>
        </div>
        <div class="form-group">
          <label>备用json3<small>（这里填写你的备用json接口2）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[jxapi2]" class="form-control textarea animate-box" rows="1" placeholder="密钥地址" ><?php echo $lele['jxapi3']?></textarea>
        </div>
        <div class="form-group">
          <label>备用json4<small>（这里填写你的备用json接口3）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[jxapi3]" class="form-control textarea animate-box" rows="1" placeholder="密钥地址" ><?php echo $lele['jxapi4']?></textarea>
        </div>
        <div class="form-group">
          <label>鼠标右键文字<small>（建议六字之内）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[yjtest]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边文字提示" ><?php echo $lele['yjtest']?></textarea>
        </div>
         <div class="form-group">
          <label>右键文字链接<small>（点击右键文字跳转）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[yjrule]" class="form-control textarea animate-box" rows="1" placeholder="弹幕框右边按钮链接" ><?php echo $lele['yjrule']?></textarea>
        </div>
         <div class="form-group">
          <label>弹幕关键字禁用<small>（屏蔽弹幕敏感字发送）</small></label>
		  <textarea style="max-width:100%;" type="text" name="lele[pbgjz]" class="form-control textarea animate-box" rows="3" placeholder="输入关键字以,隔开" ><?php echo $lele['pbgjz']?></textarea>
        </div>
        <div class="form-group">
          <label>暂停广告开关</label>
          <label class="checkbox-inline">
              <input type="radio" value="on" name="lele[ads][pause][state]" <?php $t=$lele['ads']['pause']['state'];  if ($t=="on") { echo "checked";} ?> > 开启广告</span></label>
             <label class="checkbox-inline"><input type="radio" value="off" style=" margin-left:20px;" name="lele[ads][pause][state]" <?php $t=$lele['ads']['pause']['state'];  if ($t=="off") { echo "checked";} ?> > 关闭广告</span></label>
        </div>
        <div class="form-group">
          <label>播放器背景图<small>（在加载视频时候出现的图片，视频加载后会被覆盖~）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[ads][pause][bjt]" class="form-control textarea animate-box" rows="1" placeholder="背景图链接" ><?php echo $lele['ads']['pause']['bjt']?></textarea>
        </div>
        <div class="form-group">
          <label>播放暂停图片<small>（暂停视频时显示的广告图片）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[ads][pause][pic]" class="form-control textarea animate-box" rows="1" placeholder="暂停图片链接" ><?php echo $lele['ads']['pause']['pic']?></textarea>
        </div>
        <div class="form-group">
          <label>图片跳转链接<small>（暂停视频时点击广告图片跳转链接）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[ads][pause][link]" class="form-control textarea animate-box" rows="1" placeholder="图片链接地址"><?php echo $lele['ads']['pause']['link']?></textarea>
        </div>
        <div class="form-group">
          <label>自动播放开关</label>
          <label class="checkbox-inline">
              <input type="radio" value="true" name="lele[autoplay]" <?php $t=$lele['autoplay'];  if ($t=="true") { echo "checked";} ?> > 开启自动播放</span></label>
             <label class="checkbox-inline"><input type="radio" value="false" style=" margin-left:20px;" name="lele[autoplay]" <?php $t=$lele['autoplay'];  if ($t=="false") { echo "checked";} ?> > 关闭自动播放</span></label>
        </div>
        <div class="form-group">
          <label>哔哩哔哩弹幕<small>（获取方法：随便点击一个哔哩哔哩视频链接查看源代码搜索"aid="，获取aid值即可）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[bilibili]" class="form-control textarea animate-box" rows="1" placeholder="请输入aid值 为空则不启用"><?php echo $lele['bilibili']?></textarea>
        </div>
        <div class="form-group">
          <label>跑马灯遮挡层<small>（用于遮挡播放器顶部跑马灯广告专用默认为0%,需要遮挡多大自行输入，支持精确到小数点）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[pmdzd]" class="form-control textarea animate-box" rows="1" placeholder="请输入遮挡层大小，例如：9%或者9.1%"><?php echo $lele['pmdzd']?></textarea>
        </div>
        <div class="form-group">
          <label>自定义跑马灯<small>（用于播放器任意位置进行文字跑马灯，有一定能力者可以自定义跑马灯代码）</small></label>
          <textarea style="max-width:100%;" type="text" name="lele[pmdzdy]" class="form-control textarea animate-box" rows="3" placeholder="请输入跑马灯代码~"><?php echo $lele['pmdzdy']?></textarea>
        </div>
        <button type="button" onclick="Save()" class="btn btn-primary btn-block" >确定修改</button><br/>
        <button type="reset" onclick="Reduction()" class="btn btn-primary btn-block" >还原默认</button>
      </form>
    </div>
    <?php include_once('author.php')?>
</body>
</html>
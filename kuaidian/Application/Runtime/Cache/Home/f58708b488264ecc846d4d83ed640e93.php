<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
    <title></title>
    <!--让IE用最新模式渲染,获得更好的效果-->
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <!--视口，viewport，指的就是手机端可见窗口（去掉导航栏、菜单栏、地址栏之后的窗口）
    再添加视口这段代码之前，设备会按照桌面电脑的分辨率去渲染整个页面，然后再按照比例显示到手机上
    添加强制按照手机的屏幕分辨率渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/page.css">
    <script type="text/javascript"  src="/Public/Home/js/jquery-1.11.1.js"></script>
</head>

<body>
<div class="col-lg-10 cus-content">
	<div class="panel panel-default">
		<!-- <div class="panel panel-default"> -->

			
<form action=""  method="post" class="definewidth m20" id="form_edit"  enctype="multipart/form-data">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">真实姓名</td>
            <td><?php echo ($admin["truename"]); ?></td>
        </tr>
        <tr>
            <td class="tableleft">原密码</td>
            <td>
            	<input type="password" name="ypassword" id="ypassword" placeholder="可留空" autocomplete="off" pattern="[\S]{6}[\S]*" title="密码不少于6个字符"/>
            	<label  id="pwdtip1" style="color:red;"></label>
            </td>
        </tr>
        <tr>
            <td class="tableleft">新密码</td>
            <td>
            	<input type="password" name="password" id="password" autocomplete="off" placeholder="可留空" pattern="[\S]{6}[\S]*" title="密码不少于6个字符"/>
            	<label  id="pwdtip2" style="color:red;"></label>
            </td>
        </tr>
        <tr>
            <td class="tableleft">确认密码</td>
            <td>
            	<input type="password" name="rpassword" id="rpassword" autocomplete="off" placeholder="可留空" pattern="[\S]{6}[\S]*" title="密码不少于6个字符"/>
            	<label  id="pwdtip3" style="color:red;"></label>
            </td>
        </tr>
        <tr>
            <td class="tableleft">餐厅名称</td>
            <td><?php echo ($admin["storename"]); ?></td>
        </tr>
        <tr>
            <td class="tableleft">餐厅LOGO</td>
            <td>
            <?php showImage($admin['sm_logo'], 60,60); ?>
            <input type="file" name="logo" />
            </td>
        </tr>
        <tr>
            <td class="tableleft">手机号码</td>
            <td>
            	<input type="text" name="tel" id="tel" value="<?php echo ($admin["tel"]); ?>" autocomplete="off" required pattern="^(1)[0-9]{10}$" title="请填写正确的手机号"/>
            	<label  id="teltip" style="color:red;"></label>
            </td>
        </tr>
        <input type="hidden" name="id" value="<?php echo ($admin["id"]); ?>" />
        <tr>
            <td class="tableleft" id="tips" style="color:red;text-align:center;"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button" id="save">保存</button>				 &nbsp;&nbsp;
                <button type="button" class="btn btn-success" name="backid" id="backid">返回</button>
            </td>
        </tr>
    </table>
</form>
<script>
$(function () {   
	//返回
	$('#backid').click(function(){
			window.location.href="<?php echo U('Store/info');?>";
	 });
	
	//验证原密码是否正确
	  $("#ypassword").blur(function(){
	    var ypassword = $(this).val();
	    var admin_pwd = <?php echo ($admin['password']); ?>;
	    if(ypassword != admin_pwd)
	    {
	    	$('#pwdtip1').html('原密码错误');
	    	return false;
	    }
	    return true;
	  });
	  $("#ypassword").focus(function(){
		    $('#pwdtip1').html('');
		    return true;
      });
	
	//验证新密码的格式
	$("#password").blur(function(){
		var password = $(this).val();
		var reg = /^[0-9A-Za-z]{6,}$/;
		if(!reg.test(password))
		{
			$('#pwdtip2').html('密码少于6个字符');
			return false;
		}
		return true;
	});
	$("#password").focus(function(){
	    $('#pwdtip2').html('');
	    return true;
  	});
	
	//验证确认密码
	$('#rpassword').blur(function(){
		var password = $('#password').val();
		var rpassword = $('#rpassword').val();
		if(password != rpassword)
		{
			$('#pwdtip3').html('两次密码输入不一致'); //方法1
			/*//方法2
			var html = "<label  style=\"color:red;\">两次密码输入不一致</label>";
			$('#pwdtip3').append(html);*/
			return false;
		}
		return true;
	});
	$("#rpassword").focus(function(){
	    $('#pwdtip3').html('');
	    return true;
  	});
	
	//手机号码验证  
	$('#tel').blur(function(){
		var tel = $(this).val();
		var reg = /^(1)[0-9]{10}$/;
		if(!reg.test(tel))
		{
			$('#teltip').html('请填写正确的手机号');
	    	return false;
		}
		return true;
	});
	$("#tel").focus(function(){
	    $('#teltip').html('');
	    return true;
  	});
	
});
</script>
			
		<!-- </div> -->
	</div>
</div>
</body>
</html>
<script type="text/javascript">
var ThinkPHP={
		   'MODULE':'/index.php/Home',
};
</script>
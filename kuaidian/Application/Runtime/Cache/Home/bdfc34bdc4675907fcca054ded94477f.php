<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>店铺后台管理系统</title>
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css" />
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
   
	<style>
		.cus-menu{
			border:1px solid #ddd !important;
			border-radius:5px;
		}
		.cus-menu li ul{
			padding-left:35px;
		}
		.cus-content .table th{
			font-size:13px;
		}
		.cus-content .table td{
			font-size:12px;
			vertical-align:middle;
		}
		.cus-content .pagination{
			margin:0px;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top cus-nav">
		<div class="container">
			<div class="narbar-header">
				<a href="#" class="navbar-brand">店铺后台管理系统</a>
			</div>
			<ul class="nav navbar-nav pull-right">
				<li><a href="#"><?php if($username) echo "欢迎您，$username";?></a></li>
                <li><a href="#">退出</a></li> 
                <li>
                    <a href="#">消息<span class="badge">10</span></a>
                </li>
			</ul>
		</div>
	</nav>
	<ul class="nav nav-pills" style="padding-top:50px" id="tabbar-ul">
		<li class="active"><a href="#">基本信息表&nbsp;&nbsp;</a></li><button type="button" class="close" data-dismiss="alert"  style="float:left" ><span aria-hidden="true" >&times;</span></button>
	</ul>
	<div class="row">
		<div class="col-lg-2 cus-menu"  id="menu-div" >
			<ul class="nav nav-pills nav-stacked" id>
				<li>
                    <a href="#menu-left" data-toggle="collapse">
                        <span class="glyphicon glyphicon-collapse-down"></span>系统首页
                    </a>
                    <ul class="nav nav-pills nav-stacked collapse in" id="menu-left">
                        <li>
                            <a href="<?php  echo U('info');?>"><span class="glyphicon glyphicon-expand"></span>基本信息</a>
                        </li>
                    </ul>
                </li>
				<li>
					<a href="#menu-left1" data-toggle="collapse">
						<span class="glyphicon glyphicon-collapse-down"></span>菜品管理
					</a>
					<ul class="nav nav-pills nav-stacked collapse in" id="menu-left1">
						<li>
                            <a href="#"><span class="glyphicon glyphicon-expand"></span>菜品列表</a>
                        </li>
                		<li>
                            <a href="#"><span class="glyphicon glyphicon-expand"></span>菜品分类</a>
                        </li>
					</ul>
				</li>
				<li>
					<a href="#menu-left2" data-toggle="collapse">
						<span class="glyphicon glyphicon-collapse-down"></span>订单管理
					</a>
					<ul class="nav nav-pills nav-stacked collapse in" id="menu-left2">
						<li>
                            <a href="#"><span class="glyphicon glyphicon-expand"></span>订单列表</a>
                        </li>
					</ul>
				</li>
				<li>
					<a href="#menu-left3" data-toggle="collapse">
						<span class="glyphicon glyphicon-collapse-down"></span>营业统计
					</a>
					<ul class="nav nav-pills nav-stacked collapse in" id="menu-left3">
						<li>
                            <a href="#"><span class="glyphicon glyphicon-expand"></span>统计列表</a>
                        </li>
					</ul>
				</li>
			</ul>
		</div>
		
		
<div class="col-lg-10 cus-content">
	<div class="panel panel-default">
		<div class="panel panel-default">
			<iframe name="form_submit" style="display:none;"></iframe>
			<form  target="form_submit" action=""  method="post" class="definewidth m20" id="form_edit"  enctype="multipart/form-data">
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
		</div>
	</div>
</div>
<script>
$(function () {   
	//返回
	$('#backid').click(function(){
			window.location.href="<?php echo U('Index/index');?>";
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
		
	</div>
</body>
</html>
<script type="text/javascript">
//导航条中标签的“x”关闭对应标签
$("#tabbar-ul").on('click','button',function(){
	var li = $(this).prev();
	li.remove();
	$(this).remove();
});
//导航条中点击标签，蓝色块（<li class="active">）跳到对应的标签上
$("ul#tabbar-ul").on('click','li',function(){ 
	$("ul#tabbar-ul li").removeClass("active");
	$(this).addClass("active");
});
 
$("#menu-div ul li ul li a").click(function(){
	var text = $(this).text();
	var html = "";
	$("#tabbar-ul li").removeClass("active");
	//html += "<li class=\"active\"><a href=\"#\">"+text+"&nbsp;&nbsp;<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\" >&times;</span></button></a></li>"
	html += "<li class=\"active\"><a href=\"#\">"+text+"&nbsp;&nbsp;</a></li><button type=\"button\" class=\"close\" data-dismiss=\"alert\"  style=\"float:left\" ><span aria-hidden=\"true\" >&times;</span></button>";
	$("#tabbar-ul").append(html);
});
</script>
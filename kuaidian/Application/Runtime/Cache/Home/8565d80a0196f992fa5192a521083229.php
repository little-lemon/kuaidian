<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人餐厅管理中心</title>
	<script type="text/javascript" language="javascript" src="/Public/datepicker/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">
body {
	background-image:url(/Public/Admin/images/beijing.jpg);
	background-repeat:no-repeat;
	background-attachment:fixed;
	background-size:100%;
	width:100%;
	height:100%;
}
.container{
	width:450px;
	height:300px;
	background:#ffffff;
	position:absolute;
	left:50%;
	top:50%;
	transform:translate(-50%,-50%);
	border-radius:10px;
}
</style>
</head>

<body>
	<div class="container">
		<form role="form" method="post" action="">
			<div class="form-group">
			<h3 class="text-center">个人餐厅管理系统</h3>
				<input type="text" class="form-control" placeholder="用户名" id="user" name="username" />
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="密码" id="pass" name="password" />
			</div>
			<div class="form-group">
				<input type="text" placeholder="验证码"  class="form-control"  id="checkcode"  name="chkcode"  style="display:inline; width:155px;" />&nbsp;
				<img onclick="this.src='<?php echo U('chkcode'); ?>#'+Math.random();" src="<?php echo U('chkcode'); ?>" />&nbsp;
				<a href="#" onclick="$(this).prev('img').trigger('click');" style="color:#00C5CD;">看不清？换一张</a>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox"  value="1"  name="remember"  id="remember" />请记住我
				</label>
			</div>
			<button type="submit" class="btn btn-success btn-block">提交</button>
			<div class="form-group">
				<span class="glyphicon glyphicon-circle-arrow-right" style="color:red;"></span>
				<a href="<?php echo U('register'); ?>"  style="color:#FF0000;" >立即注册</a>
			</div>
		</form>
	</div>
</body>
</html>
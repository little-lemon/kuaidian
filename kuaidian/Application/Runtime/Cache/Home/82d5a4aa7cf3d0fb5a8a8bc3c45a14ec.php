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
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css">
    <link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top cus-nav">
		<div class="container">
			<div class="narbar-header">
				<a href="#" class="navbar-brand">后台管理系统</a>
			</div>
			<ul class="nav navbar-nav pull-right">
				<li><a href="#"><?php if($adminName) echo "欢迎您，$adminName"; ?></a></li>
                <li><a href="<?php echo U('Home/Login/logout'); ?>"  target="_top">退出</a></li>
                <li>
                    <a href="#">消息<span class="badge">10</span></a>
                </li>
			</ul>
		</div>
	</nav>
	<ul class="nav nav-pills" style="padding-top:50px">
		<li class="active"><a href="#">订单管理</a></li>
		<li><a href="#">员工管理</a></li>
        <li><a href="#">会员管理</a></li>
        <li><a href="#">促销管理</a></li>
        <li><a href="#">车辆管理</a></li>
	</ul>
</body>
</html>
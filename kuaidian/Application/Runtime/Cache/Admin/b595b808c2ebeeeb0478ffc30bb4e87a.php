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
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
    
	<frameset rows="90,*" framespacing="0" border="0">
		<frame src="<?php echo U('Admin/Index/top'); ?>" id="header-frame" name="header-frame" frameborder="no" scrolling="no">
		<frameset cols="190,*" framespacing="0" border="0" id="frame-body">
			<frame src="<?php echo U('Admin/Index/menu'); ?>"  id="menu-frame" name="menu-frame" frameborder="no">
			<frame src="<?php echo U('Admin/Index/main'); ?>"  id="main-frame" name="main-frame" frameborder="no">
		</frameset>
	</frameset><noframes></noframes>
</head>

<body>
</body>
</html>
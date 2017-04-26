<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <!--让IE用最新模式渲染,获得更好的效果-->
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <!--视口，viewport，指的就是手机端可见窗口（去掉导航栏、菜单栏、地址栏之后的窗口）
    再添加视口这段代码之前，设备会按照桌面电脑的分辨率去渲染整个页面，然后再按照比例显示到手机上
    添加强制按照手机的屏幕分辨率渲染页面-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
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
		<li class="active"><a href="<?php echo U('Index/info'); ?>">基本信息&nbsp;&nbsp;</a></li><button type="button" class="close" data-dismiss="alert"  style="float:left" ><span aria-hidden="true" >&times;</span></button>
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
                            <a href="<?php echo U('Index/info'); ?>"><span class="glyphicon glyphicon-expand"></span>基本信息</a>
                        </li>
                    </ul>
                </li>
				<li>
					<a href="#menu-left2" data-toggle="collapse">
						<span class="glyphicon glyphicon-collapse-down"></span>菜品管理
					</a>
					<ul class="nav nav-pills nav-stacked collapse in" id="menu-left2">
						<li>
                            <a href="#"><span class="glyphicon glyphicon-expand"></span>菜品列表</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Category/catlst'); ?>"><span class="glyphicon glyphicon-expand"></span>菜品分类</a>
                        </li>
					</ul>
				</li>
				<li>
					<a href="#menu-left3" data-toggle="collapse">
						<span class="glyphicon glyphicon-collapse-down"></span>订单管理
					</a>
					<ul class="nav nav-pills nav-stacked collapse in" id="menu-left3">
						<li>
                            <a href="#"><span class="glyphicon glyphicon-expand"></span>订单列表</a>
                        </li>
					</ul>
				</li>
				<li>
					<a href="#menu-left4" data-toggle="collapse">
						<span class="glyphicon glyphicon-collapse-down"></span>营业统计
					</a>
					<ul class="nav nav-pills nav-stacked collapse in" id="menu-left4">
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

			<table class="table table-bordered table-hover definewidth m10">
				<tr>
		            <td width="10%" class="tableleft my">当前账号</td>
		            <td><?php echo ($admin["username"]); if(!empty($admin['truename'])): ?>(<?php echo ($admin["truename"]); ?>)<?php endif; ?></td>
		        </tr>
		        <tr>
		            <td class="tableleft">级别</td>
		            <td>超级管理员</td>
		        </tr>
		        <tr>
		            <td class="tableleft">餐厅名</td>
		            <td><?php echo ($admin["storename"]); ?></td>
		        </tr>
		        <tr>
		            <td class="tableleft">手机号</td>
		            <td><?php if(!empty($admin['tel'])): echo ($admin['tel']); else: ?>--<?php endif; ?></td>
		        </tr>
		        <tr>
		            <td class="tableleft">状态</td>
		            <td><?php if($admin["status"] == 1): ?><font color="#5bb75b">正常</font><?php else: ?><font color="red">禁用</font><?php endif; ?></td>
		        </tr>
		        <tr>
		            <td class="tableleft">加盟时间</td>
		            <td><?php if(!empty($admin['addtime'])): echo (date("Y-m-d H:i:s",$admin['addtime'])); else: ?>0<?php endif; ?></td>
		        </tr>
	            <tr>
	                <td colSpan=2 style="padding-left:160px;">
	                    <button type="button" class="btn btn-success" name="backid" id="backid">修改信息</button>
	                </td>
	            </tr>
			</table>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('#backid').click(function(){
			window.location.href="<?php echo U('Index/edit');?>";
		});
	});
</script>
 
		
	</div>
</body>
</html>
<script type="text/javascript">
$(function(){
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
		var href = $(this).attr("href");
		//alert(href);
		var html = "";
		$("#tabbar-ul li").removeClass("active");
		//html += "<li class=\"active\"><a href=\"#\">"+text+"&nbsp;&nbsp;<button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\" >&times;</span></button></a></li>"
		html += "<li class=\"active\"><a href=\""+href+"\">"+text+"&nbsp;&nbsp;</a></li><button type=\"button\" class=\"close\" data-dismiss=\"alert\"  style=\"float:left\" ><span aria-hidden=\"true\" >&times;</span></button>";
		$("#tabbar-ul").append(html);
	});
});

</script>
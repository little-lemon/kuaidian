<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
    <!--让IE用最新模式渲染,获得更好的效果-->
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <!--视口，viewport，指的就是手机端可见窗口（去掉导航栏、菜单栏、地址栏之后的窗口）
    再添加视口这段代码之前，设备会按照桌面电脑的分辨率去渲染整个页面，然后再按照比例显示到手机上
    添加强制按照手机的屏幕分辨率渲染页面-->
	<title>快点订餐</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<!--Bootstrap-->
	<link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="/Public/User/js/jquery-1.11.1.js"></script>
	<!-- <script src="/Public/Bootstrap/js/jquery.min.js"></script>   -->
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
	<!--/Bootstrap-->
	<link rel="stylesheet" href="/Public/User/css/index.css">
	<script type="text/javascript" src="/Public/User/js/index.js"></script> 
</head>
<body>
	<!-- 头部 -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="#" class="navbar-brand logo" ><img src="/Public/User/images/index/kd_logo.png" width="50" height="50" alt="快点订餐系统"></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">	
			  	<?php if($_SESSION['username']== ''): ?><li class="active"><a href="#"   id="btn-login"><span class="glyphicon glyphicon-user"></span>登录</a></li>
				<li><a href="#" id="btn-reg"><span class="glyphicon glyphicon-pencil"></span>注册</a></li>
		 	   <?php else: ?>
		 	  	<li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span>个人中心</a></li>  <!--  "<?php echo U('Personal/index');?>&act=index" -->
			    <li><a href="<?php echo U('logout');?>"><span class="glyphicon glyphicon-zoom-out"></span>退出</a></li><?php endif; ?>  
  				<li><a  href="#"  id="btn-cart"><span class="glyphicon glyphicon-shopping-cart"></span>购物车</a></li>
  				<li><a  href="#"  id="btn-pick"><span class="glyphicon glyphicon-question-sign" id="pick"></span>我要摘单<span class="badge">3</span></a></li>
 			</ul>	
		</div>
	</div>
</nav>

 <!-- 登陆模态框声明 -->
<div class="modal fade" id="myModal_1" tabindex="-1" role="dialog">
	<!-- 窗口声明 -->
	<div class="modal-dialog" role="document" >
		<!-- 内容声明 -->
		<div class="modal-content">
		
 		</div>
	</div>
</div>
 <!-- 注册模态框声明 -->
<div class="modal fade" id="myModal_2" tabindex="-1" role="dialog">
	<!-- 窗口声明 -->
	<div class="modal-dialog" role="document" >
		<!-- 内容声明 -->
		<div class="modal-content">
		
 		</div>
	</div>
</div>
<div class="container" style="width:95%;padding:0px;">
	<div class="carousel slide" id="myCarousel">
		<!--标识符部分-->
		<ul class="carousel-indicators">
			<li class="active" data-target="#myCarousel" data-slide-to="0"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ul>
		<div class="carousel-inner">
			<div class="item active">
				<img src="/Public/User/images/index/slide1.png" width="100%" style="height:180px;" >
				<div class="carousel-caption">
					这是轮播图的标题1
				</div>
			</div>
			<div class="item">
				<img src="/Public/User/images/index/slide2.png" width="100%" style="height:180px;" >
				<div class="carousel-caption">
					这是轮播图的标题2
				</div>
			</div>
			<div class="item">
				<img src="/Public/User/images/index/slide3.png" width="100%" style="height:180px;">
				<div class="carousel-caption">
					这是轮播图的标题3
				</div>
			</div>
		</div>
		<a class="carousel-control left" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="carousel-control right" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</div>
</div>
	<!-- /头部 -->
	
	<!-- 主体 -->
	<div class="container" style="width:95%; padding:0px; ">
		<div class="panel panel-default" style="margin:0px;">
			<div class="btn-group">
				<button type="button" class="btn btn-default active">默认</button>
				<button type="button" class="btn btn-default">价格</button>
				<button type="button" class="btn btn-default">评分</button>
				<button type="button" class="btn btn-default">销量</button>
			</div>
			<div class="row">
				<div class="panel-body" style="padding-bottom:0px;">
				<?php if(!empty($storeData)): if(is_array($storeData)): foreach($storeData as $key=>$vo): ?><div class="col-sm-6 col-md-4 col-lg-3 rstblock" id="rstblock">
							<a href="<?php echo U('Goods/goods?store_id='.$vo['id']); ?>">
								<div class="rstblock-logo">
									<img class="rstblock-logo-icon" src="/Public/Uploads/<?php echo ($vo['sm_logo']); ?>">
									<span>45分钟</span>
								</div>
								<div class="rstblock-content rstblock">
									<div class="rstblock-title"><?php echo ($vo['storename']); ?></div>
									<div>5颗星</div> <!--<span class="rstblock-monthsales" style="float:right;">月售1361单</span>-->
									<div class="rstblock-cost">15元起送 30分钟送达</div>
									<div class="rstblock-cost">配送费¥1</div>
								</div>
							</a>
						</div><?php endforeach; endif; ?>
				<?php else: ?>
				没有相关结果!<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- /主体 -->

	<!-- 底部 -->
	<footer id="footer">
	<div class="container">
		 <div class="row cus-copy" >
			<p>欢迎加入 | 合作事宜 | 版权投诉</p>
			<p> ©2016-2017 happitao.com 版权所有备案号闽ICP备16036358号-1 </p>
		 </div>
	 </div>
	 </footer>
	<!-- /底部 -->
</body>
</html>
<script type="text/javascript">
 $(function(){
	$('#btn-login').on('click', function () {
		$('#myModal_1').modal({
			backdrop:'static',
			show:true,
			remote:'<?php echo U("Index/login"); ?>'
		});
	});
	$('#btn-reg').on('click', function () {
		$('#myModal_2').modal({
			backdrop:'static',
			show:true,
			remote:'<?php echo U("Index/register"); ?>'
		});
	});
	$('#btn-cart').on('click', function () {
		$('#myModal_1').modal({
			backdrop:'static',
			show:true,
			remote:'remote.html'
		});
	});
   	$('#btn-pick').on('click', function () {
		$('#myModal_2').modal({
			backdrop:'static',
			show:true,
			remote:'remote.html'
		});
	});
 });	
</script>
<script type="text/javascript" src="/Public/user/js/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/user/js/jquery.form.js"></script>
<!--  <link rel="stylesheet" href="./css/jquery.ui.css">
 <script type="text/javascript" src="./js/jquery.ui.js"></script>
 <script type="text/javascript" src="./js/jquery.validate.js"></script>
 <script type="text/javascript" src="./js/jquery.form.js"></script>-->
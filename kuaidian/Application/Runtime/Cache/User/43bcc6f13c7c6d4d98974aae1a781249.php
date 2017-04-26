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
	<link rel="stylesheet" href="/Public/User/css/goods.css">
	<script type="text/javascript" src="/Public/User/js/goods.js"></script> 
</head>
<body>
<div id="header">
	<nav class="navbar">
		<div class="container">
			<div class="navbar-header">
				<a href="#" class="navbar-brand logo" ><img src="/Public/User/images/index/kd_logo.png" width="50" height="50" alt="快点订餐系统"></a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" style="background-color:#6600FF;">
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
				    <li><a href="<?php echo U('Index/logout');?>"><span class="glyphicon glyphicon-zoom-out"></span>退出</a></li><?php endif; ?> 
					<li><a href="<?php echo U('User/Cart/lst','',FALSE); ?>/storeId/<?php echo ($storeId); ?>"><span class="glyphicon glyphicon-shopping-cart"  id="btn-cart" >购物车</span></a></li> <!--   href="<?php echo U('Goods/cart');?>"  -->
				</ul>	
			</div>
		</div>
	</nav>
	
	 <!-- 登陆模态框声明 -->
	<div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" >
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
	
	<div class="row">
		<div class="container" style="padding:0px;">
			<img src="/Public/User/images/index/kd_logo.png" alt="快点订餐系统" id="store_logo">
			<div class="shopguide-info">
				<div><h1>芋见甜品</h1></div>
				<div>5颗星 月售1361单</div>
			</div>
			<div class="shopguide-server" style="float:right;">
				<span class="right">
					<em>起送价</em>
					<em class="shopguide-server-value">15元</em>
				</span>
				<span class="right">
					<em>配送费</em>
					<em class="shopguide-server-value">免费配送</em>
				</span>
				<span class="-right">
					<em>平均送达速度</em>
					<em class="shopguide-server-value">30分钟</em>
				</span>
			</div>
		</div>
	</div>
</div>
<nav class="navbar navbar-default" role="navigation"> <!--style="background-color:#FFFFFF;"-->
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">所有商品</a></li>
        <li><a href="#">评价</a></li>
		<li><a href="#">商家性质</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">默认排序</a></li>
		<li><a href="#">评分<span class="glyphicon glyphicon-arrow-down"></span></a></li>
		<li><a href="#">销量<span class="glyphicon glyphicon-arrow-down"></span></a></li>
		<li><a href="#">价格<span class="glyphicon glyphicon-arrow-down"></span><span class="glyphicon glyphicon-arrow-up"></span></a></li>
		<li>
			<!-- <form class="navbar-form navbar-left" role="search">  -->
				<div class="input-group">
				<input type="text" class="form-control" placeholder="Search">
				<span class="input-group-btn">
				<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
				</span>
				</div><!-- /input-group -->
			 <!--  </form>  -->
		</li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

 <!-- 登陆模态框声明 -->
<div class="modal fade" id="myModal_3" tabindex="-1" role="dialog">
	<!-- 窗口声明 -->
	<div class="modal-dialog" role="document" >
		<!-- 内容声明 -->
		<div class="modal-content">
		
 		</div>
	</div>
</div>
 <!-- 注册模态框声明 -->
<div class="modal fade" id="myModal_4" tabindex="-1" role="dialog">
	<!-- 窗口声明 -->
	<div class="modal-dialog" role="document" >
		<!-- 内容声明 -->
		<div class="modal-content">
		
 		</div>
	</div>
</div>

<div class="container" style="width:95%; padding:0px; ">
	<div class="panel panel-default" style="margin:0px;">
		<div class="row">
			<div class="panel-body" style="padding-bottom:0px;">
			<?php if(!empty($goodsData)): if(is_array($goodsData)): foreach($goodsData as $key=>$vo): ?><div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 rstblock" id="rstblock">
					<a href="#">
						<div class="rstblock-logo">
							<img class="rstblock-logo-icon" src="/Public/Uploads/<?php echo ($vo['goods_sm_pic']); ?>">
						</div>
						<div class="rstblock-content rstblock left" >
							<div class="rstblock-title"><?php echo ($vo["goods_name"]); ?></div>
							<div><img src="/Public/User/images/goods/4_star.jpg"></div> <!--<span class="rstblock-monthsales" style="float:right;">月售1361单</span>-->
							<div class="rstblock-cost">15元起送</div>
							<div class="rstblock-cost">配送费¥1</div>
						</div>
					</a>
					<div class="add_cart_1" >
						<span type="button" class="btn btn-primary btn_radius" id="<?php echo ($vo['id']); ?>"  >加入购物车</span>
					</div>
					<div class="add_cart_2" style="display:none;">
						<div class="input-group input-group-sm" style="width:90px;" >
							<span class="input-group-addon reduce_num" style="border-radius:25px 0 0 25px;">-</span>
							<input type="text" class="form-control amount" value="0"  _goodsId="<?php echo ($vo['id']); ?>"  _storeId="<?php echo ($vo['store_id']); ?>"  name="count" />  <!-- name="count[<?php echo ($vo['id']); ?>]"  -->
							<span class="input-group-addon add_num" style="border-radius:0 25px 25px 0;">+</span>
						</div>
					</div>
				</div><?php endforeach; endif; ?>
			<?php else: ?>
				没有相关结果!<?php endif; ?>
			</div>
		</div>
	</div>
</div>

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
<div class="navbar-fixed-bottom" >
	<div class="shopping_cart_right">
		<div class="row cus-foot shopping_cart_border shopping_cart_1row" id="pick">
			<div class="col-xs-12 col-sm-12 shopping_cart_letf_text" >
				<span>购物车</span>
				<span><a href="#">[清空]</a></span>
			</div>
		</div>
		<div class="row cus-foot shopping_cart_border" id="cart_footer">
			<div class="col-xs-6 col-sm-6 shopping_cart_letf_text shopping_cart_2row_right">
				<span class="glyphicon glyphicon-shopping-cart" style="border-right: 1px solid #fff; padding-right:10px;" id="cart_icon"></span>
				<span style="padding-left:5px;">配送费¥0</span>
			</div>
			<div class="col-xs-6 col-sm-6 shopping_cart_2row_left">
				<span>购物车是空的</span>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
var ThinkPHP={
		   'MODULE':'/index.php/User',
};
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
	/*$('#btn-cart').on('click', function () {
		$('#myModal_1').modal({
			backdrop:'static',
			show:true,
			remote:'remote.html'
		});
	});*/
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
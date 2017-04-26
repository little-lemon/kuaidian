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
	<link rel="stylesheet" href="/Public/User/css/header-footer.css">
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
				    <li><a href="<?php echo U('Index/logout');?>"><span class="glyphicon glyphicon-zoom-out"></span>退出</a></li><?php endif; ?>  
	  				<li><a  href="<?php echo U('Cart/lst');?>"  id="btn-cart"><span class="glyphicon glyphicon-shopping-cart"></span>购物车</a></li>
	  				<li><a  href="<?php echo U('Pick/lst');?>"  id="btn-pick"><span class="glyphicon glyphicon-question-sign" id="pick"></span>我要摘单<span class="badge">3</span></a></li>
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


	<!--内容-->
	
<script src="/Public/User/js/pick.js"></script>
<link rel="stylesheet" href="/Public/User/css/pick.css">
	
<!--主体部分-->
<div class="container" style=" padding:0px;">
	<div style="margin-top:60px ;">
		<div class="row" style="margin:0 auto;">
			<!--订单左侧栏-->
			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" style="padding-right:15px; margin-bottom:10px;">
				<div style="width: 180px;height:55px;background: url(/Public/User/images/order/myorder.png);text-align:center;line-height:55px;">
					<a href="<?php echo U('Index/order');?>" style="color:#000000;font-weight:800;">
						摘单列表
					</a>
				</div>
			</div>
			<!--/订单左侧栏-->
			
			<!--订单右侧栏-详细信息-->
			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="padding-right:15px;">
				<?php if(!empty($orderData)): if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><div class="panel panel-default">
					<div class="panel-body" style="font-size:14px;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  line_height"><b><?php echo ($vo["storename"]); ?></b></div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  line_height" ><b>地址：</b><?php echo ($vo["storeaddress"]); ?></div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  line_height"><b>订单号：</b><?php echo ($vo["order_number"]); ?></div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8  line_height"><b>下单时间：</b><?php echo ($vo["add_times"]); ?></div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 line_height"><b>手机：</b><?php echo ($vo["scr_tel"]); ?></div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 line_height"><b>送餐地址：</b><?php echo ($vo["scr_address"]); ?></div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 line_height"><b>总金额：</b><em class="tooltips"><?php echo ($vo["total_price"]); ?>元</em></div>
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="margin-top:10px;"><button type="submit" class="btn btn-primary pickBtn" style="width:120px;">摘单</button></div>
					</div>
				</div><?php endforeach; endif; ?>
				<?php else: ?>
				<div class="panel panel-default">
					<div class="panel-body" style="font-size:14px;">
						摘单列表为空
					</div>
				</div><?php endif; ?>
			</div>
			<!--/订单右侧栏-详细信-->
			
			<!-- 摘单模态框声明 -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
				<!-- 窗口声明 -->
				<div class="modal-dialog" role="document"  style="width:300px;">
					<!-- 内容声明 -->
					<div class="modal-content">
					
			 		</div>
				</div>
			</div>
			<!-- /摘单模态框声明 -->
		
		</div>
	</div>
</div>
<!--/主体部分-->
<script>
</script>
	<!--/内容-->

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
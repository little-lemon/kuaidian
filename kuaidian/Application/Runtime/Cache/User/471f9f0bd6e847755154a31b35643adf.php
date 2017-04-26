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
	
<script src="/Public/User/js/comment.js"></script>
<link rel="stylesheet" href="/Public/User/css/comment.css">
	
<!--主体部分-->
<div class="container" style=" padding:0px;">
	<div style="margin:60px 0 10px 0;">
		<div class="row" style="margin:0 auto;">
			<!--订单评价-->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			
				<div class="panel panel-default">
					<div class="panel-body" style="font-size:14px;">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5  line_height"><b>火锅店</b></div>
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7  line_height"><b>订单状态：</b><em class="tooltips">订单已完成</em></div>
						<div class="clear"></div>
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5  line_height"><b>订单号：</b>1490543952245713</div>
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7  line_height"><b>下单时间：</b>2017-03-26 23:59</div>
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 line_height"><b>手机：</b>18459175634</div>
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 line_height"><b>地址：</b>here</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 line_height star_comment">
							牛肉火锅：
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
						</div>
		
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 line_height star_comment">
							鱼豆腐：
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 line_height star_comment">
							整体评价：
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
							<img src="/Public/User/images/comment/white_star.png" class="star"/>
						</div>
						<div class="form-group">
							<!--<label for="inputEmail" class="col-sm-2 control-label checkout-field">备注</label>-->
							<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="margin-top:10px;">
							  <textarea class="form-control" rows="3"></textarea>
							</div>
						</div>
						<!--<div class="confirm_order btnBase security-btn-01 toConfirm mt-ljx" orderid="1271930" day="<?php echo ($list["day"]); ?>">确认收餐</div>-->
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;"><button type="submit" class="btn btn-primary" style="width:120px;" id="btn">提交</button></div>
					</div>
				</div>
				
			</div>
			<!--/订单评价-->
		</div>
	</div>
</div>
<!--/主体部分-->
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
		   'PUBLIC':'/Public',
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
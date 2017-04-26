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
	
<script src="/Public/User/js/cart.js"></script>
<link rel="stylesheet" href="/Public/User/css/cart.css">
	
<!--主体部分-->
<div class="container" style=" padding:0px;">
	<div style="margin-top:60px ;">
		<div class="row" style="margin:0 auto;">
		<form class="form-horizontal"  id="order_submit"  method="post" > <!-- action="<?php echo U('Cart/orderSubmit');?>"   -->
	
			<!--订单详情-->
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:15px;padding-right:15px;">
				<div class="order">
					<?php if(is_array($storeInfo)): foreach($storeInfo as $key=>$vo): ?><div class="order-title">
						<input type="hidden" name="store_id" value="<?php echo ($vo["id"]); ?>">
						<img src="/Public/Uploads/<?php echo ($vo['sm_logo']); ?>"  alt="..." class="img-rounded store-logo">
						<h3><?php echo ($vo["storename"]); ?></h3>
						<div class="order-line"></div>
						<span class="order-details">订单详情</span>
						<span class="order-details-2"  id="go-back">返回</span>
					</div><?php endforeach; endif; ?>
					
					<?php if(!empty($goodsData)): ?><div>
						<div class="itemname" style="color:#34D209;">商品</div>
						<div class="itemquantity" style="color:#34D209;">数量</div>
						<div class="itemtotal" style="color:#34D209;">单价</div>
					</div>
					<?php if(is_array($goodsData)): foreach($goodsData as $key=>$vo): ?><div>
						<div class="itemname"><?php echo ($vo["goods_name"]); ?></div>
						<div class="itemquantity">
							<div class="input-group input-group-sm" style="width:90px;margin-top:3px;">
								<span class="input-group-addon reduce_num" style="border-radius:25px 0 0 25px;">-</span>
								<!-- <input type="text" class="form-control amount" _goodsId="<?php echo ($vo['id']); ?>"  _storeId="<?php echo ($vo['store_id']); ?>"  value="<?php echo ($vo["goods_count"]); ?>" /> -->
								<label class="form-control amount" _goodsId="<?php echo ($vo['id']); ?>"  _storeId="<?php echo ($vo['store_id']); ?>" ><?php echo ($vo["goods_count"]); ?></label>
								<span class="input-group-addon add_num" style="border-radius:0 25px 25px 0;">+</span>
							</div>
						</div>
						<div class="itemtotal  unitPrice">¥<?php echo ($vo["goods_price"]); ?></div>
					</div><?php endforeach; endif; ?>
					<div style="border-bottom:1px dashed #cccccc;">
						<div class="itemname" style="color:#34D209;">合计</div>
						<div class="itemquantity" ><lable id="totalAmount"  style="width:80px;display:block;text-align:center ;">0</lable></div>
						<div class="itemtotal"  id="totalPrice_1">¥0.00</div>
					</div>
					<div>
						<div class="itemtotal-2">餐盒费 ：<label style="color:#34D209;" id="lunchFee" >¥1.00</label></div>
					</div>
					<div>
						<div class="itemtotal-2">配送费 ：<label style="color:#34D209;" id="distributionCost">¥0.00</label></div>
					</div>
					<div>
						<div class="itemtotal-2" style="color:#34D209;font-size:18px;">
							应付 ：<label  id="totalPrice_2">¥0.00</label>
							<input type="hidden" name="total_price"  id="total_price"  value="0.00">
						</div>
					</div>
					<?php else: ?>
						<div  class="empty-cart">购物车为空！</div><?php endif; ?>
					<div class="bottom_border"></div>
					
				</div>
			</div>
			<!--/订单详情-->
			
			<!--收餐信息-->
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:15px;padding-right:15px;">
				<div class="checkout" style="padding-left:10px;padding-right:10px;" >
					<div>
						<h3 class="checkout-title" >收餐信息</h3>
						<span class="addrManagement"  id="selectAddr">选择一个收获地址</span>
					</div>
					<!--  <form class="form-horizontal" > -->
					  <div class="form-group">
						<label for="inputUsername" class="col-sm-2 control-label checkout-field">联系人</label>
						<div class="col-sm-5">
						  <input type="text" class="form-control" id="inputUsername"   name="scr_name" required title="请填写联系人" />
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputTel" class="col-sm-2 control-label checkout-field">收餐电话</label>
						<div class="col-sm-5">
						  <input type="text" class="form-control" id="inputTel"  name="scr_tel"   required pattern="^0?1[3|4|5|8][0-9]\d{8}$" title="请填写正确的手机号" />
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputAddr" class="col-sm-2 control-label checkout-field">收餐地址</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="inputAddr"  name="scr_address"  autocomplete="off" required />
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputRoomTime" class="col-sm-2 control-label checkout-field">送餐时间</label>
						<div class="col-sm-3">
						  	<select class="sendTime f-sel"  id="inputRoomTime"  name="room_time">
								<option value="0" >立即送出</option>
							</select>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label checkout-field">支付方式</label>
						<div class="col-sm-10">
						 <!-- <input type="email" class="form-control" id="inputEmail3" placeholder="Email">-->
							 <ul class="room-pay" style="padding:0;"> <!-- style="padding:0px 10px 0px 10px;"-->
								<li class="radioItem active offline f-orders normal_btn" >
									<input type="radio" autocomplete="off" name="payment_method"  value="0"  checked="checked"  />
									<a href="javascript:void(0);">
										餐到付款
									</a>
								</li>
								<li class="radioItem disable online normal_btn disable_btn f-orders" name="payment_method"  style="margin-left:20px;">  <!--   -->
									<input type="radio" autocomplete="off"  name="payment_method"  value="1"  />
									<a href="javascript:void(0);" title="该餐馆暂时不支持在线支付">
										在线支付
									</a>
								</li>
							</ul>
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label checkout-field">备注</label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3"  name="mark"></textarea>
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary btn_orderConfirm" style="width:120px;">确认下单</button>
						 	<div class="confirming" style="display: none;margin-left: 126px;color:#34D209">
									正在提交订单，请等待…
							</div>
						</div>
					  </div>
					<!--  </form> -->
				</div>
			</div>
			<!--/收餐信息-->
			
			
		</form>
		</div>
	</div>
</div>
<!--/主体部分-->
<script>
//提交表单数据
	
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
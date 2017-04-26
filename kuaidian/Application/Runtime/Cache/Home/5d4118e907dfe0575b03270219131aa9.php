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
<div class="col-lg-10 cus-content">
	<div class="panel panel-default">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#FFFFFF;">
				<form role="form" class="form-inline">
					<div class="form-group">
						<input type="text" placeholder="请输入订单号" class="form-control">
						<button class="btn btn-primary form-control">点击查询</button>
					</div>
				</form>
			</div>
			<table class="table table-bordered table-hover">
			<?php if(!empty($orderData)): if(is_array($orderData)): foreach($orderData as $key=>$vo): ?><tr style="background:#f5f5f5;">
					<td>
						<input type="checkbox" name="ids" value="<?php echo ($vo['order_number']); ?>"/>
					</td>
					<td style="text-align:left;"><b>订单号:<?php echo ($vo["order_number"]); ?></b></td>
					<td style="text-align:left;"><b>送餐电话:<?php echo ($vo["scr_tel"]); ?></b></td> 
					<td style="text-align:left;max-width:330px"><b>送餐地址:<?php echo ($vo["scr_address"]); ?></b></td>
					<td style="text-align:left;">
						<b>送餐时间:
							<?php if($vo["room_time"] == 0): ?>立即送出
							<?php else: ?>
								<?php echo ($vo["room_time"]); endif; ?>
						</b>
					</td>
					<td style="text-align:left;"><b>状态:
						<?php if($vo["post_status"] == 0): ?>未派送
						<?php elseif($vo["post_status"] == 1): ?>
							已派送
						<?php else: ?>
							已收餐<?php endif; ?>
						</b>
					</td>    
					<td style="text-align:left;"><b>下单时间:<?php echo ($vo["add_times"]); ?></b></td>
					<td><button class="btn btn-primary btn-sm">操作</button></td>
				</tr>  
				<!-- 列出具体菜品 -->
				<?php if(is_array($vo['goods'])): foreach($vo['goods'] as $key=>$vo1): ?><tr>
					<td></td>
					<td colspan="2" style="text-align:left;"><?php echo ($vo1["goods_name"]); ?></td>
					<td colspan="5" style="text-align:left;"><?php echo ($vo1["goods_number"]); ?> × ¥<?php echo ($vo1["goods_price"]); ?></td>
				</tr><?php endforeach; endif; ?>
				<!-- /列出具体菜品 --><?php endforeach; endif; endif; ?>
			</table>
		</div>
	</div>
</div>
</body>
</html>
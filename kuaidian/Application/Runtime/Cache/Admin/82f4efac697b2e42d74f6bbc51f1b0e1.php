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
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/page.css">
    <link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery-1.4.4.js"></script>
</head>

<body>
<div class="col-lg-10 cus-content">
	<div class="panel panel-default">
		<div class="panel panel-default">

			
<div class="panel-heading">
快点订餐系统管理中心--添加管理员
<a href="<?php echo U('lst'); ?>"  class="addright" ><span class="glyphicon glyphicon-plus">管理员列表</span></a>
</div>
<form action="" method="post" >
<table class="table table-bordered table-hover">
	<tr>
		<td class="mytd">所在角色：</td>
		<td>
				<?php foreach($roleData as $k => $v): ?>
				<input type="checkbox"  name="role_id[]"  value="<?php echo ($v["id"]); ?>" /><?php echo ($v["role_name"]); ?> &nbsp;
				<?php endforeach; ?>
		</td>
	</tr>
	<tr>
		<td class="mytd">用户名：</td>
		<td>
			<input  type="text" name="username" value="" />
		</td>
	</tr>
	<tr>
		<td class="mytd">密码：</td>
		<td>
			<input  type="password" name="password" size="25"/>
		</td>
	</tr>
	<tr>
		<td class="mytd">确认密码：</td>
		<td>
			<input  type="password" name="cpassword" size="25"/>
		</td>
	</tr>
	<tr>
		<td class="mytd">是否启用 1：启用0：禁用：</td>
		<td>
	       	<input type="radio" name="status" value="1" checked="checked" />启用 
	       	<input type="radio" name="status" value="0"  />禁用 
		</td>
	</tr>
	<tr>
	    <td colspan="99" align="center">
	        <input type="submit" class="button" value=" 确定 " />
	        <input type="reset" class="button" value=" 重置 " />
	    </td>
	</tr>
</table>
</form>
			
		</div>
	</div>
</div>
</body>
</html>
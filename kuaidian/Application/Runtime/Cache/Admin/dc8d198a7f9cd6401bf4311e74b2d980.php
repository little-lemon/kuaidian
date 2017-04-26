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
    <script type="text/javascript" src="/Public/Admin/js/jquery-1.11.1.js"></script>
</head>

<body>
<div class="col-lg-10 cus-content">
	<div class="panel panel-default">
		<div class="panel panel-default">

			
<div class="panel-heading">
快点订餐系统管理中心--修改店铺权限
<a href="<?php echo U('lst'); ?>"  class="addright" ><span class="glyphicon glyphicon-plus">店铺权限列表</span></a>
</div>
<form action="" method="post" >
<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
<table class="table table-bordered table-hover">
	<tr>
		<td class="mytd">上级权限：</td>
		<td>
			<select name="parent_id" class="form-control input-sm" style="width:auto;">
				<option value="0">顶级权限</option>
				<?php foreach ($parentData as $k => $v): ?> 
				<?php if($v['id'] == $data['id'] || in_array($v['id'], $children)) continue; ?>
				<?php  if($v['id'] == $data['parent_id']) $select = 'selected="selected"'; else $select = ''; ?>
				<option <?php echo ($select); ?> value="<?php echo $v['id']; ?>" ><?php echo str_repeat('-', 8*$v['level']).$v['pri_name']; ?></option>
				<?php endforeach; ?>	
			</select>
		</td>
	</tr>
	<tr>
	    <td class="mytd">权限名称：</td>
	    <td>
	        <input  type="text" name="pri_name" value="<?php echo $data['pri_name']; ?>" />
	    </td>
	</tr>
	<tr>
	    <td class="mytd">模块名称：</td>
	    <td>
	        <input  type="text" name="module_name" value="<?php echo $data['module_name']; ?>" />
	    </td>
	</tr>
	<tr>
	    <td class="mytd">控制器名称：</td>
	    <td>
	        <input  type="text" name="controller_name" value="<?php echo $data['controller_name']; ?>" />
	    </td>
	</tr>
	<tr>
	    <td class="mytd">方法名称：</td>
	    <td>
	        <input  type="text" name="action_name" value="<?php echo $data['action_name']; ?>" />
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
<script>
$(":submit").click(function(){
	var sec = 3;
	$(this).attr('disabled','disabled');
	$(this).val(sec + "秒之后提交");
	var _this = $(this);
	setInterval(function(){
		if(--sec == 0)
		{
			$("form[name=main_form]").submit();
	
		}
		else
			_this.val(sec + "秒之后提交");
		_this.val();
	},1000);
});
</script>
			
		</div>
	</div>
</div>
</body>
</html>
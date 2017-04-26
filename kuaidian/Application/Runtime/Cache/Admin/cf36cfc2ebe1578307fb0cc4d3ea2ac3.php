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
快点订餐系统管理中心--添加角色
<a href="<?php echo U('lst'); ?>"  class="addright" ><span class="glyphicon glyphicon-plus">角色列表</span></a>
</div>
<form name="main_form" action="/index.php/Admin/Role/edit/id/1.html" method="post" >
<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
<table class="table  table-hover" >
	<tr style=“border:0;”>
		<td class="mytd" >角色名称：</td>
		<td>
			<input type="text" name="role_name" value="<?php echo $data['role_name']; ?>"  />
		</td>
	</tr>
	<tr>
		<td class="mytd" style=" vertical-align:top">权限列表：</td>
		<td>
			<?php foreach ($priData as $k => $v): if(strpos(','.$pri_id.',' , ','.$v[id].',') !==FALSE) $check = 'checked="checked"'; else $check = ''; ?>
				<?php echo str_repeat('-',$v['level']*8); ?>
				<input <?php echo ($check); ?> level="<?php echo ($v["level"]); ?>"  type="checkbox" name="pri_id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["pri_name"]); ?><br />
			<?php endforeach; ?>
		</td>
	<tr>
	    <td colspan="99" align="center">
	        <input type="submit" class="button" value=" 确定 " />
	        <input type="reset" class="button" value=" 重置 " />
	    </td>
	</tr>
</table>
</form>
<script>
//让提交只能点一次
$(":submit").click(function(){
	var sec = 3;
	$(this).attr('disabled','disabled');
	$(this).val(sec + "秒之后提交");
	var _this = $(this);
	setInterval(function(){
		if(--sec == 0)
			$("form[name=main_form]").submit();
		else
			_this.val(sec + "秒之后提交");
		_this.val();
	},1000);
});

//为所有的选择框绑定点击事件
$(":checkbox").click(function(){
	// 先取出当前权限的level值是多少
	var cur_level = $(this).attr("level");
	// 判断是选中还是取消
	if($(this).attr("checked"))
	{
		var tmplevel = cur_level; // 给一个临时的变量后面要进行减操作
		// 先取出这个复选框所有前面的复选框
		var allprev = $(this).prevAll(":checkbox");
		// 循环每一个前面的复选框判断是不是上级的
		$(allprev).each(function(k,v){
			// 判断是不是上级的权限
			if($(v).attr("level") < tmplevel)
			{
				tmplevel--; // 再向上提一级
				$(v).attr("checked", "checked");
			}
		});
		// 所有子权限也选中
		// 先取出这个复选框所有前面的复选框
		var allprev = $(this).nextAll(":checkbox");
		// 循环每一个前面的复选框判断是不是上级的
		$(allprev).each(function(k,v){
			// 判断是不是上级的权限
			if($(v).attr("level") > cur_level)
				$(v).attr("checked", "checked");
			else
				return false;   // 遇到一个平级的权限就停止循环后面的不用再判断了
		});
	}
	else
	{
		// 先取出这个复选框所有前面的复选框
		var allprev = $(this).nextAll(":checkbox");
		// 循环每一个前面的复选框判断是不是上级的
		$(allprev).each(function(k,v){
			// 判断是不是上级的权限
			if($(v).attr("level" ) > cur_level)
				$(v).removeAttr("checked");
			else
				return false;   // 遇到一个平级的权限就停止循环后面的不用再判断了
		});
	}
});
</script>
			
		</div>
	</div>
</div>
</body>
</html>
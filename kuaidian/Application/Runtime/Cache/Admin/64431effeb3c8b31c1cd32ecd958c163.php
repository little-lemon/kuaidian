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

			
<div class="panel-body">
<div class="panel-default">
<form class="form-inline" action="/index.php/Admin/Role/lst.html"  method="get">  
    角色名称：
    <input type="text" name="role_name" id="rolename"class="abc input-default" placeholder="输入角色名称搜索"  value="<?php echo I(get.role_name); ?>" />&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    <a href="<?php echo U('add'); ?>"  class="addright" ><span class="glyphicon glyphicon-plus">添加角色</span></a>
</form>
</div>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>角色名称</th>
        <th>权限名称</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php if(!empty($data)): if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
        <td><?php echo ($vo['role_name']); ?></td>
        <td><?php echo ($vo['pri_name']); ?></td>
        <td>
			【<a href="<?php echo U('edit?id='.$vo['id']); ?>" >修改</a>】
			【<a href="<?php echo U('delete?id='.$vo['id']); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>】
        </td>
        </tr><?php endforeach; endif; ?>	
    <?php else: ?>
        <tr><td colspan="11">没有相关结果!</td></tr><?php endif; ?>
</table>
    <div class="digg" style="margin-top:10px;float:right;margin-right: 30px;">
               <?php echo ($page); ?>
    </div>
    
<script src="/Public/artDialog/lib/sea.js"></script>    
<script>
seajs.config({
  alias: {
    "jquery": "jquery-1.10.2.js"
  }
});
</script>
<script>
	$(function(){
		//启用设置
		$('.enable').click(function(){
			var userid = $(this).attr('_userid');
			if($.trim(userid) == '')
			{
				return false;
			}
			//$.post("<?php echo U('Store/edit');?>", {ids : storeid}, function(obj){
				//window.location.reload();
			//});
			$.ajax({
				type:"GET",
				// 大U生成的地址默认带后缀，如：/index.php/Admin/Goods/ajaxGetAttr.html/type_id/+type_id
				// 第三个参数就是去掉.html后缀否则TP会报错
				url:"<?php echo U('ajaxEnable','',FALSE)?>/userid/"+userid,
				success:function(data)
				{
					 window.location.reload();
				}
			});
		});
		
		//全选设置
		$('#ids').click(function(){
			if($(this).is(':checked')){
				$(this).parents('table').find('input[type=checkbox]').prop("checked",true);
			}
			else{
				$(this).parents('table').find('input[type=checkbox]').prop("checked",false);
			}
		});
		
		//禁用设置
		$('#disable').click(function(){
			var _checkbox = $('table').find('input[name=ids]');
			var str = '';
			_checkbox.each(function(){
				if($(this).is(':checked')){
					str += $(this).val()+','
				}
			});
			if(str == ''){
				return false;
			}
			seajs.use(['jquery', '/Public/artDialog/src/dialog'], function ($, dialog) {
				var d = dialog({
					title:'提示',
					content:'确定要禁用选中项吗?',
					lock:true,
					cancel:true,
					width:300,
					ok:function(){
						$.ajax({
							typr:"GET",
							url:"<?php echo U('ajaxDisable','',FALSE)?>/userids/"+str,
							success:function(data)
							{
								window.location.reload(); 
							}
						});
					},
					okValue: '确定',
					cancelValue: '关闭'
				});
				d.show();
			});
		});
		
		
	});
</script>
			
		</div>
	</div>
</div>
</body>
</html>
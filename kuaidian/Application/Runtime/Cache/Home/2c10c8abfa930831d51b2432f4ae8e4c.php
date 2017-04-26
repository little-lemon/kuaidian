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
    <link rel="stylesheet" type="text/css" href="/Public/Bootstrap/css/bootstrap.min.css">
    <script src="/Public/Bootstrap/js/jquery.min.js"></script>
    <script src="/Public/Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/page.css">
    <script type="text/javascript"  src="/Public/Home/js/jquery-1.11.1.js"></script>
</head>

<body>
<div class="col-lg-10 cus-content">
	<div class="panel panel-default">
		<!-- <div class="panel panel-default"> -->

			

<div class="panel-body">
<div class="panel-default">
<form class="form-inline definewidth m20" action="/index.php/Home/Goods/lst.html"  method="get">  
    
    菜名：
    <input type="text" name="goods_name" id="goods_name"class="abc input-default" placeholder="输入菜名搜索" value="" >&nbsp;&nbsp;  
    
        <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
        <button type="button" class="btn btn-success" id="addnew">添加菜品</button>
    
</form>
</div>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th width="2%"><input id="ids" type="checkbox"/></th>
        <th>菜品ID</th>
        <th>所属分类</th>
        <th>菜品名称</th>
        <th>菜品价格</th>
        <th>菜品图片</th>
        <th>销量</th>
        <th>是否推荐</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php if(!empty($goodsData)): if(is_array($goodsData)): foreach($goodsData as $key=>$vo): ?><tr>
	        <td><input type="checkbox" name="ids" value="<?php echo ($vo['id']); ?>"/></td>
	        <td><?php echo ($vo['id']); ?></td>
	        <td><?php echo ($vo['cat_name']); ?></td>
	        <td><?php echo ($vo['goods_name']); ?></td>
	        <td><?php echo ($vo['goods_price']); ?></td>
	        <td><?php showImage($vo['goods_sm_pic'], 60,60); ?></td>
	        <td><?php echo ($vo['sale_num']); ?></td>
	        <td><?php if($vo['is_recommend'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
	        <td><?php echo (date("Y-m-d H:i:s",$vo['addtime'])); ?></td>
	        <td>  <a href="<?php echo U('goods/edit', array('id'=>$vo['id']));?>">编辑</a></td> 
        </tr><?php endforeach; endif; ?>	
    <?php else: ?>
        <tr><td colspan="11">没有相关结果!</td></tr><?php endif; ?>
</table>
	<div style="margin-left: 35px;margin-top: 10px;position: absolute;">选中项：<span id="del" style="color:#0088cc;cursor:pointer;">删除</span></div>
    <div class="digg" style="margin-top:10px;float:right;margin-right: 30px;">
               <?php echo ($page); ?>
    </div>
</div>

<script type ="text/javascript" src="/Public/artDialog/artDialog.js?skin=default"></script>
<script type ="text/javascript" src="/Public/artDialog/plugins/iframeTools.js"></script>

<script type="text/javascript" src="/Public/user/js/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/user/js/jquery.form.js"></script>

<script>
$(function(){	
	//添加分类
	$('#addnew').click(function(){
		//window.location.href="<?php echo U('Goods/add');?>";
		art.dialog.open(
				"<?php echo U('goods/add');?>",{
					id:'add_dialog',
					title:'添加分类',
					width:550,
					height:400,
					lock:true,
					close:function(){
						art.dialog.open.origin.location.href="<?php echo U('Goods/lst');?>";
					}
				});
	});
	
	//全选设置
	$('#ids').click(function(){
	       if($(this).is(':checked')){
	           $(this).parents('table').find('input[type=checkbox]').prop("checked", true);
	       }
	       else{
	           $(this).parents('table').find('input[type=checkbox]').prop("checked", false);
	       }
	   });
	
 	//删除设置
	$('#del').click(function(){
		var _checkbox = $('table').find('input[name=ids]');
		var str = '';
		_checkbox.each(function(){
			if($(this).is(':checked')){
				str += $(this).val()+',';
			}
		});
		if(str == ''){
			return false;
		}
		else{
				var d = art.dialog({
					title:'提示',
					content:'确定要删除选中项吗?',
					lock:true,
					cancel:true,
					width:300,
					ok:function(){
						$.ajax({
							type:"GET",
							url:"<?php echo U('ajaxGoodsDel','',FALSE)?>/goods_ids/"+str,
							success:function(data)
							{
								window.location.reload(); 
							}
						});
					},
					okValue: '确定',
					cancelValue: '关闭'
				});
		}
	});
 	
 	
})
</script>
			
		<!-- </div> -->
	</div>
</div>
</body>
</html>
<script type="text/javascript">
var ThinkPHP={
		   'MODULE':'/index.php/Home',
};
</script>
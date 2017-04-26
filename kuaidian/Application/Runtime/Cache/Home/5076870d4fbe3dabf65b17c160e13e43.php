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
<center>
<form action="" method="post"  id="form_edit" style="width:90%;margin-top:40px;">
    <table class="table table-bordered table-hover">
        <tr>
            <td width="20%" class="tableleft">分类名称</td>
            <td>
            <input type="text" name="name"  autocomplete="off" placeholder="分类名称"required />
            (如:主食、配菜、饮品、套餐...)
            </td>
        </tr>
        <tr>
        <input type="hidden" name="cid" value="<?php echo ($app["cid"]); ?>" id="appid">
        <tr>
            <td class="tableleft" id="tips" style="color:red;text-align:center;"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button>              &nbsp;&nbsp;
                <button type="button" class="btn btn-success" name="backid" id="backid">返回</button>
            </td>
        </tr>
    </table>
</form>
</center>
</body>
</html>
<script>
	$(function(){
		$('#backid').click(function(){
			//window.location.href="<?php echo U('Category/lst');?>";
			parent.art.dialog({id:'add_dialog'}).close();
		});
		$('#form_edit').submit(function(){
			$.ajax({
				url:"<?php echo U('Category/add');?>",
				dataType:'json',
				type:'post',
				data:$(this).serialize(),
				success:function(obj){
					if(obj.code != 0){
						$('#tips').html(obj.msg);
					}else{
						$('#tips').html(obj.msg);
						setTimeout(function(){
							parent.art.dialog({id:'add_dialog'}).close();
						},500);
					}
				}
			});
			return false;
		});
	});
</script>
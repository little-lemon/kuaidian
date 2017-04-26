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
<form enctype="multipart/form-data" action="" method="post"  id="form_edit"  style="width:90%;margin-top:30px;">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="20%" class="tableleft">菜品名称</td>
            <td><input type="text" name="goods_name"  autocomplete="off" required/></td>
        </tr>
        <tr>
            <td width="20%" class="tableleft">所属分类</td>
            <td>
            <select name="cat_id" required>
            <?php if(is_array($cat)): foreach($cat as $key=>$co): ?><option value="<?php echo ($co["id"]); ?>"><?php echo ($co["name"]); ?></option><?php endforeach; endif; ?>
            </select>
            </td>
        </tr>
        <tr>
            <td width="20%" class="tableleft">菜品价格</td>
            <td><input type="text" name="goods_price" value="<?php echo ($admin["goodsprice"]); ?>" autocomplete="off" required/></td>
        </tr>
        <tr>
            <td width="20%" class="tableleft">菜品图片</td>
            <td>
            <input type="file" name="goods_pic" required /></td>
        </tr>
        <tr>
        <td class="tableleft">是否推荐</td>
            <td >
            	<input type="radio" name="is_recommend" value="1"  checked="checked"/>是
            	<input type="radio" name="is_recommend" value="0"  />否
            </td>
        </tr>
        <tr>
            <td class="tableleft" id="tips" style="color:red;text-align:center;"></td>
            <td>
                <button type="submit" class="btn btn-primary" >保存</button>              &nbsp;&nbsp;
                <button type="button" class="btn btn-success" name="backid" id="backid">返回</button>
            </td>
        </tr>
    </table>
</form>
</center>
</body>
</html>
<script type="text/javascript" src="/Public/Admin/js/jquery-1.11.1.js"></script>

<!-- <script type="text/javascript" src="/Public/user/js/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/user/js/jquery.form.js"></script>

<script>
	$(function(){
		$('#backid').click(function(){
			//window.location.href="<?php echo U('Category/lst');?>";
			parent.art.dialog({id:'add_dialog'}).close();
		});
        
        $('#form_add #form_add_sub').button();
    	$('#form_add').validate({ 
    		submitHandler: function(form) {
    			$(form).ajaxSubmit({
    				url:"add",
    				type:'POST',
    				data:{},
    				beforeSubmit:function(){
    					$('#form_add #form_add_sub').button('disable');
    				},
    				success:function(obj){
    					if(obj.code != 0){
    						$('#tips').html(obj.msg);
    					}else{
    						$('#tips').html(obj.msg);
    						setTimeout(function(){
    							parent.art.dialog({id:'add_dialog'}).close();
    						},500);
    					}
    				},
    			});
    		},
 		});
	});
</script> -->
<script>
	$(function(){
		$('#backid').click(function(){
			//window.location.href="<?php echo U('Category/lst');?>";
			parent.art.dialog({id:'add_dialog'}).close();
		});
/*         $('#form_eidt').submit(function(){
            return true;
        }); */
		 /* $('#form_edit').submit(function(){
			$.ajax({
				url:"<?php echo U('Goods/add'); ?>",
				dataType:'json',
				type:'post',
				data:$(this).serialize(),
				success:function(obj){
					if(obj.code != 0){
						$('#tips').html(obj.msg);
					}
				}
			});
			return false;
		});  */
 	});

	
</script>
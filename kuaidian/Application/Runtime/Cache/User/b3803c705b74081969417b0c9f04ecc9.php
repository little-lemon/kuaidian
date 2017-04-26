<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header" style="background-color:#eeeeee;border-radius:5px 5px 0 0;">
	<button class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">提示</h4>
</div>
<div class="modal-body">
	<form method="post"  id="pick_submit">
		<input type="hidden" name="order_number" value="<?php echo ($orderNumber); ?>">
	</form>
	确定要摘单吗？
</div>
<div class="modal-footer">
	<button class="btn btn-primary"   id="btn_pickConfirm">确定</button>
	<button class="btn btn-default" data-dismiss="modal"  id="btn_cancle">取消</button>
</div>
<script>
$("#btn_pickConfirm").click(function(){
	$.ajax({
		url:ThinkPHP['MODULE']+'/Pick/ajaxPickSubmit',
		data : $('#pick_submit').serialize(),
		type : 'post',
		dataType : 'json',
		success : function(data){
		    if( data.code == 0 ){
		    	//alert('摘单成功');
			 	window.location.href = ThinkPHP['MODULE']+'/Pick/lst';
			} else if( data.code == 1){
				$('#btn_cancle').click();
				$('#btn-login').click();
				//window.location.href = "<?php echo U('Index/order');?>";
			}else{
				alert(data.msg);
			}
		},
	});
	return false;
});
</script>
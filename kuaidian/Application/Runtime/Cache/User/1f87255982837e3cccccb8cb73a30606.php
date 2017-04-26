<?php if (!defined('THINK_PATH')) exit();?><div class="modal-header" style="background-color:#eeeeee;border-radius:5px 5px 0 0;">
	<button class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">提示</h4>
</div>
<div class="modal-body">
	
		<input type="hidden" name="order_number" value="<?php echo ($orderNumber); ?>">
	
	确定要摘单吗？
</div>
<div class="modal-footer">
	<button class="btn btn-primary">确定</button>
	<button class="btn btn-default" data-dismiss="modal">取消</button>
</div>
<?php if (!defined('THINK_PATH')) exit();?><!--  <script type="text/javascript" src="/Public/user/js/user.js"></script> -->
<form method="post"  id="register"  class="form-horizontal">
	<div class="modal-header">
		<button class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">会员注册</h4>
	</div>
	<div class="modal-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group has-feedback">
						<label class="col-md-3 hidden-xs control-label">手机</label>
						<div class="col-md-9 col-xs-12">
							<input type="text" name="username"   class="form-control"  placeholder="请输入手机号码">
						    <span class="glyphicon  form-control-feedback"></span>
							</div>
					</div>						
					</div>
				<div class="col-md-12">
				  	<div class="form-group has-feedback">
						<label class="col-md-3 hidden-xs control-label allstyle"  >密码</label>
						<div class="col-md-9 col-xs-12">
							<input type="password" name="password" class="password form-control" placeholder="请输入您的密码">	
						    <span class="glyphicon  form-control-feedback"></span>
						</div>
					</div>
					</div>
				<div class="col-md-12">
				    <div class="form-group has-feedback">
						<label class="col-md-3 hidden-xs control-label">验证码</label>
						<div class="col-md-5 col-xs-6">
							<input type="text" class="form-control" name="verify" placeholder="请输入验证码">	
						    <span class="glyphicon  form-control-feedback"></span>
						</div>
						<div class="col-md-4 col-xs-6">
	                              <a class="verify-img-wrap js-verify-refresh" href="javascript:void(0)">
	                                  <!-- <img  class="changimg1 verifyimg1" style="width:100%;height:100%;height:35px;display:block;"   id="verify1" src="<?php echo U('User/verify');?>&a=b"  >   -->
	                                 <img  onclick="this.src='<?php echo U('chkcode'); ?>#'+Math.random();"  src="<?php echo U('chkcode'); ?>"  style="width:100%;height:100%;height:35px;display:block;" />
	                              </a>
						</div>
					</div>
					</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
	   <!--  <input type="submit"  value="注册"  id="register_sub"/> --> 
	    <button class="btn "  type="submit"  id="register_sub">注册</button>
	</div>
</form>
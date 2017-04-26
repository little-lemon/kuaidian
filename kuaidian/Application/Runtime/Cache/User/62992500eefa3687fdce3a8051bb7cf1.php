<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="/Public/user/js/user.js"></script>
<form  id="login" class="form-horizontal" >
            <div class="modal-header">
				<button class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">会员登录</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label class="col-md-3 hidden-xs control-label">手机</label>
								<div class="col-md-9 col-xs-12">
									<input type="text" name="username"   class="form-control" placeholder="请输入手机号码">
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
									<input type="text" class="form-control" id="verify"  name="verify" placeholder="请输入验证码">	
								    <span class="glyphicon  form-control-feedback"  id="mark"></span>
								</div>
							    <div class="col-md-4 col-xs-6">
	                                <a class="verify-img-wrap js-verify-refresh" href="javascript:void(0)">
	                                   <img  onclick="this.src='<?php echo U('chkcode'); ?>#'+Math.random();"  src="<?php echo U('chkcode'); ?>"  style="width:100%;height:100%;height:35px;display:block;" />
	                                </a>
								</div>
							</div>
 						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <input class="btn"  type="submit" value="登录" id="login_sub"/> -->
				<button class="btn"  id="login_sub">登录</button>
				<button class="btn btn-primary" id="go-register">去注册</button>
			</div>
		</form> 
 <script type="text/javascript">
  
   	$('#go-register').on('click', function () {
		$('#myModal_1').modal('hide');
		$('#btn-reg').click();
	});
   	
  /*//验证验证码是否正确
   	$("#verify").blur(function(){
   		var code = $(this).val();
   		$.ajax({
   			type : "GET",
   			url:"<?php echo U('ajaxCheckCode','',FALSE)?>/code/"+code,
   			dataType : "json",
   			success:function(data)
			{
   				//alert(data);
			     if(data.ok == 1){
					 //alert(data.verify);
					 $("#mark").removeClass("glyphicon-remove");
					 $("#mark").addClass("glyphicon-ok");
				 }
				 if(data.ok == 0){
					 $("#mark").removeClass("glyphicon-ok");
					 $("#mark").addClass("glyphicon-remove");
				 }
			},
   		});
   	});*/
   	
 	$("#verify").focus(function(){
 		$("#mark").removeClass("glyphicon-ok glyphicon-remove");
 	});
  </script>
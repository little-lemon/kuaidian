$(function(){
	$('#login #login_sub').button();
	$('#register #register_sub').button();
	//登陆模态框设置
	$('#login').validate({ 
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				//url:'User/Index/loginAction',
				url:ThinkPHP['MODULE']+'/Index/loginAction',
				type:'POST',
				data:{},
				beforeSubmit:function(){
					$('#login #login_sub').button('disable');
				},
				success:function(responseText){
					if(responseText>0){
						alert(123);
						$('#login input[type="submit"]').button('enable');	
						setTimeout(function(){
							$('#login').resetForm();
							window.location.reload(); //刷新当前页面.
						},1000);
					}
					else{
						$('#login input[type="submit"]').button('enable');
						alert('账号密码不正确');
					}
				},
			});
		},
		//错误存放的位置
		errorPlacement: function(error, element) {  
		    //error.appendTo(element.parent());  
			error.appendTo(element.siblings('*:last'));  
		},
		 highlight : function (element, errorClass) {
			  $(element).parent().parent().addClass("has-error"); 
			  $(element).siblings('*:first').addClass("glyphicon-remove"); 
			  $(element).parent().parent().removeClass("has-success"); 
			  $(element).siblings('*:first').removeClass("glyphicon-ok"); 
			},
		 unhighlight : function (element, errorClass) {
			 $(element).parent().parent().removeClass("has-error"); 
			 $(element).siblings('*:last').removeClass("glyphicon-remove"); 
			 $(element).parent().parent().addClass("has-success"); 
			 $(element).siblings('*:last').addClass("glyphicon-ok"); 
			},
		rules:{
			username:{
				required:true,
				inAt:true,
			},
			password:{
				required:true,
				minlength:6,
				maxlength:15,
			},
			verify:{
				required:true,
				remote:{
					//url:'User/Index/checkVerify',
					url:ThinkPHP['MODULE']+'/Index/checkVerify',
					type:'post',
				},
			},
		},
		messages:{
			username:{
				required:'&nbsp;',
				inAt:'&nbsp;',
				rangelength:'&nbsp;',
			},
			password:{
				required:'&nbsp;',
				minlength:'&nbsp;',
				maxlength:'&nbsp;',
			},
			verify:{
				required:'&nbsp;',
				remote:'&nbsp;',
			},
		},
		
	});
	
	
	$('#register').validate({ 
  		 submitHandler:function(form){ 
    				$(form).ajaxSubmit({             
    					//url:'User/Index/registerAction',
    					url:ThinkPHP['MODULE']+'/Index/registerAction',
    					type:'POST',
  		 			    data:{},
  					    beforeSubmit:function(){  
   						    $('#register #register_sub').button('disable');
   					   },
  					    success:function(responseText){
  						if(responseText){
  							 if(responseText>0){
    		 					$('#register input[type="submit"]').button('enable');	
   						   setTimeout(function(){
   					          $('#register').resetForm();
  		                         // location.href="User/Index/index";
   					             window.location.reload(); //刷新当前页面.
  		 				              },1000);
  							 }else{
  								  alert('注册账号被占用');
  							 }
  						}
  					}           
  				});
  			 
  		 },
  		 errorPlacement: function(error, element) {  //错误存放的位置
  			    error.appendTo(element.siblings('*:last'));  
  		},
  	 
  	     highlight : function (element, errorClass) {
  	  		  $(element).parent().parent().addClass("has-error"); 
       		  $(element).siblings('*:first').addClass("glyphicon-remove"); 
       		  $(element).parent().parent().removeClass("has-success"); 
       		  $(element).siblings('*:first').removeClass("glyphicon-ok"); 
   			},
  		 unhighlight : function (element, errorClass) {
  			 $(element).parent().parent().removeClass("has-error"); 
  			 $(element).siblings('*:last').removeClass("glyphicon-remove"); 
  			 $(element).parent().parent().addClass("has-success"); 
  			 $(element).siblings('*:last').addClass("glyphicon-ok"); 
   			},

     		 rules:{
  				username:{
   					 required: true,
   					 inAt : true,
   				  
  		 		},
  				password:{
  					 required:true,
  				     minlength:6,
  				     maxlength:15,
  		 		},
  		 		verify:{
  					 required:true,
  			 		 remote:{
  			 			    //url:'User/Index/checkVerify',
  			 			    url:ThinkPHP['MODULE']+'/Index/checkVerify',
  					    	type:'post',
  			 			},
  		 		},
  			 
  		 },
  		 messages:{
  				username:{
   				    required: '&nbsp;',
   				    inAt : '&nbsp;',
    		 		}, 
  				password:{
  					required:'&nbsp;',
  					//minlength:$.format('&nbsp;'),
  					//maxlength:$.format('&nbsp;'),
  					minlength:'&nbsp;',
  					maxlength:'&nbsp;',
  		 		},
  		 		verify:{
  					required:'&nbsp;',
  					remote:'&nbsp;',
  		 		},
  			},
  		 
  		  
  	 });

   	
   	//自定义验证，电话号码
   	$.validator.addMethod('inAt', function (value, element) {
   		var text = /^1[34578]{1}\d{9}$/;
   		return this.optional(element) || (text.test(value));
   	}, '电话号码不正确');
	
});
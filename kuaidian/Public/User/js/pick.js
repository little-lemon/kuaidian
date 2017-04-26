// JavaScript Document
$(function(){
	$('#height').click(function(){
		var height = $(this).outerHeight(); 
		alert(height);
	});
	
	$('#width').click(function(){
		var width = $(this).width(); 
		alert(width);
	});	
	
	//使模态框垂直居中显示
	$('#myModal').on('shown.bs.modal', function (e) { 
		// 关键代码，如没将modal设置为 block，则$modala_dialog.height() 为零 
	    $(this).css('display', 'block'); 
	    var modalHeight=$(window).height() / 2 - $('#myModal .modal-dialog').height() / 2; 
	    var modalWidth=$(window).width() / 2 - $('#myModal .modal-dialog').width() / 2; 
	    $(this).find('.modal-dialog').css({  
	    	'margin-top': modalHeight,
	    	'margin-left':modalWidth
	    }); 
	});

	$('.pickBtn').click(function(){
		var orderNumber = $(this).parent().parent().children().eq(2).text();
		var strs= new Array(); //定义一数组 
		strs=orderNumber.split("：");
		orderNumber=strs[1];
		//单击事件,显示模态框
		$('#myModal').modal({
			backdrop:'static',
			remote:ThinkPHP['MODULE']+'/Pick/pick_confirm/order_number/'+orderNumber,
		});
		//每次隐藏时，清除数据。确保点击时，重新加载
	    $("#myModal").on("hidden.bs.modal", function() {
	        $(this).removeData("bs.modal");
	    });
	});
	
});



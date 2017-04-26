// JavaScript Document
$(document).ready(function(){
	
	//测试标签的高度
	$('#height').click(function(){
		var height = $(this).outerHeight(); 
		alert(height);
	});
	
	//测试便签的宽度
	$('#width').click(function(){
		var width = $(this).width(); 
		alert(width);
	});
	
	//点击 “返回” 跳回到上一个页面
	/*方法1*/
	$('#go-back').click(function(){
		window.history.back(-1);
	});
	/*方法2*/
	/*var goBackBtn = document.getElementById("go-back");
	goBackBtn.onclick = function(){
		window.history.back(-1);
	}*/
	
	//购物车+1
	function addOne(store_id,goods_id){
    	var storeId_goodsId_count = new Array(store_id,goods_id,'+',1);
    	$.ajax({
			type:"GET",
			url:ThinkPHP['MODULE']+'/Goods/ajaxAddToCart/storeId_goodsId_count/'+storeId_goodsId_count,
			success:function(data)
			{
				window.location.reload();
//				if(data == 'yes')
//					window.location.href=ThinkPHP['MODULE']+'/Cart/lst';
			}
		});
	}
	
	//购物车-1
	function subOne(store_id,goods_id){
    	var storeId_goodsId_count = new Array(store_id,goods_id,'-',1);
    	$.ajax({
			type:"GET",
			url:ThinkPHP['MODULE']+'/Goods/ajaxAddToCart/storeId_goodsId_count/'+storeId_goodsId_count,
			success:function(data)
			{
				window.location.reload();
//				if(data == 'yes')
//					window.location.href=ThinkPHP['MODULE']+'/Cart/lst';
			}
		});
	}	
	
	//减少
	$(".reduce_num").on('click',function(){
		var amount = $(this).next();
//			var text = $(this).next().attr("name");
     		var amount = $(this).next();
     		var goods_id = amount.attr("_goodsId");
     		var store_id = amount.attr("_storeId");
     		subOne(store_id,goods_id);
			amount.val(parseInt(amount.val()) - 1);
	});

	//增加
	$(".add_num").on('click',function(){
		//var text = $(".amount").text();
		//alert(text);
		var amount = $(this).prev();
		var goods_id = amount.attr("_goodsId");
		var store_id = amount.attr("_storeId");
		addOne(store_id,goods_id);
		amount.val(parseInt(amount.val()) + 1);
	});
	
	//自动计算总数量
	var list = document.getElementsByClassName("amount");
	var totalAmount = 0;
	for(var i=0;i<list.length;i++){
		var tmp = list[i].innerText;
		totalAmount = totalAmount + parseInt(tmp);
	}
	document.getElementById('totalAmount').innerHTML= totalAmount;
	
	//自动计算总价格
	var unitPriceList = document.getElementsByClassName("unitPrice");
	var amountList = document.getElementsByClassName("amount");
	var totalPrice = 0;
	for(var i=0;i<unitPriceList.length;i++){
		var unitPrice = unitPriceList[i].innerText;
		unitPrice=unitPrice.substr(1);
		var amount = amountList[i].innerText;
		totalPrice = totalPrice + parseInt(unitPrice)*parseInt(amount);
	}
	totalPrice = '¥' + totalPrice + '.00';
	document.getElementById('totalPrice_1').innerHTML= totalPrice;
	
	//自动应付价格  从上面获得totalPrice，继续计算
	totalPrice = totalPrice.substr(1);
	var lunchFee = document.getElementById("lunchFee").innerText.substr(1);
	var distributionCost = document.getElementById("distributionCost").innerText.substr(1);
	totalPrice = parseInt(totalPrice) + parseInt(lunchFee) + parseInt(distributionCost);
	document.getElementById('total_price').value =totalPrice + '.00';
	//totalPrice = '¥' + totalPrice + '.00';
	document.getElementById('totalPrice_2').innerHTML='¥' + totalPrice + '.00';
	
	//送餐时间设置
	var FIFTEEN_MINUTES = 15 * 60 * 1000;
	
	function complement(str) {
		if (String(str).length == 1) {
			str = '0' + str;
		}
		return str;
	}

	function insertSendTimeOption(send, close) {
		var sendTime = send.getTime();
		var closeTime = close.getTime();
		var gap = sendTime % FIFTEEN_MINUTES;
		if (gap != 0) {
			sendTime += FIFTEEN_MINUTES - gap;
		}

		var difference = closeTime - sendTime;
		for (var i = 0; i <= difference / FIFTEEN_MINUTES; i++) {
			var t = new Date(sendTime + FIFTEEN_MINUTES * i);
			var text = complement(t.getHours()) + ':' + complement(t.getMinutes());
/*			var option = $('<option>', {
				text: text
			});*/
			var option = "<option value=\""+text+"\">"+text+"</option>";
			$('.sendTime').append(option);
		}
	}

	var openAmStr = '10:30'.split(':');
	var sendAmStr = '10:30'.split(':');
	var closeAmStr = '12:00'.split(':');
	var openPmStr = '12:00'.split(':');
	var sendPmStr = '12:00'.split(':');
	//var closePmStr = '20:00'.split(':');
	var closePmStr = '23:00'.split(':');
	var nowTime = new Date();
	var now = new Date(1970, 0, 1, nowTime.getHours(), nowTime.getMinutes());
	var openAm = new Date(1970, 0, 1, openAmStr[0], openAmStr[1]);
	var sendAm = new Date(1970, 0, 1, sendAmStr[0], sendAmStr[1]);
	var closeAm = new Date(1970, 0, 1, closeAmStr[0], closeAmStr[1]);
	var openPm = new Date(1970, 0, 1, openPmStr[0], openPmStr[1]);
	var sendPm = new Date(1970, 0, 1, sendPmStr[0], sendPmStr[1]);
	var closePm = new Date(1970, 0, 1, closePmStr[0], closePmStr[1]);
	if (openAm <= now && closeAm > now) {
		insertSendTimeOption(sendAm < now ? now: sendAm, closeAm);
	} else if (openPm <= now && closePm > now) {
		insertSendTimeOption(sendPm < now ? now: sendPm, closePm);
	}
	
	//选择支付方式
	/*var payList = document.getElementsByClassName("radioItem"); 
	for (var i=0; i < payList.length; i++){
		payList.addEventListener('click',function(){
			
		});
	}*/
	$('.radioItem').click(function(){
		var classValue_1 = $(this).attr('class');
		if(classValue_1.indexOf(" disable ") > 0 ){
			if( $(this).next().length != 0 ){
				var nextLi = $(this).next();
				classValue_2 = nextLi.attr('class').replace(' active ',' disable ');
				nextLi.attr('class', classValue_2);
			}
			else {
				var nextLi = $(this).prev();
				classValue_2 = nextLi.attr('class').replace(' active ',' disable ');
				nextLi.attr('class', classValue_2);
			}
			classValue_1 = classValue_1.replace(' disable ',' active ');
			$(this).attr('class', classValue_1);
			$(this).children(':first').click();
		}
	});
	
	
	$('.btn_orderConfirm').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Cart/ajaxOrderSubmit',
			data : $('#order_submit').serialize(),
			type : 'post',
			dataType : 'json',
			beforeSend : function(){
				var url = ThinkPHP['MODULE']+'/Cart/ajaxOrderSubmit';
				$('.btn_orderConfirm').hide();
				$('.confirming').show();
			},
			success : function(data){
				if( data.code == 0 ){
					alert('下单成功');
					$('.btn_orderConfirm').html('下单成功').show();
				 	$('.confirming').hide();
				 	window.location.href = ThinkPHP['MODULE']+'/Order/lst';
				} else if( data.code == 1){
					$('#btn-login').click();
					//window.location.href = "{:U('Index/order')}";
				}else{
					alert(data.msg);
					$('.btn_orderConfirm').show();
				 	$('.confirming').hide();
				}
			},
		});
		return false;
	});
	
	
});
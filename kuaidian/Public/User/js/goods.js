// JavaScript Document
$(function(){
	
	$('#test').click(function(){
		var height = $(this).outerHeight(); 
		alert(height);
	});
	
	//购物车+1
	function addOne(store_id,goods_id){
    	var storeId_goodsId_count = new Array(store_id,goods_id,'+',1);
    	$.ajax({
			type:"GET",
			url:ThinkPHP['MODULE']+'/Goods/ajaxAddToCart/storeId_goodsId_count/'+storeId_goodsId_count,
			success:function(data)
			{
				alert(data);
//				if(data == 'yes')
//					window.location.href=ThinkPHP['MODULE']+'/Cart/lst';
			}
		});
	}
	
	//购物车-1
	function subOne(store_id,goods_id){
    	var storeId_goodsId_count = new Array(store_id,goods_id,'+',1);
    	$.ajax({
			type:"GET",
			url:ThinkPHP['MODULE']+'/Goods/ajaxAddToCart/storeId_goodsId_count/'+storeId_goodsId_count,
			success:function(data)
			{
				alert(data);
//				if(data == 'yes')
//					window.location.href=ThinkPHP['MODULE']+'/Cart/lst';
			}
		});
	}	
	
	//点击加入购物车，增加数量
	$('.add_cart_1 span').on('click',function(){
		 var add_cart_1 = $(this).parent();
		 var add_cart_2 = add_cart_1.next();
		 var goods_id = add_cart_2.find("input:text").attr("_goodsId");
		 var store_id = add_cart_2.find("input:text").attr("_storeId");
		 addOne(store_id,goods_id);
		 add_cart_1.css('display','none');
		 add_cart_2.find("input[type='text']").val("1");
		 add_cart_2.css('display','block');
	});
		
	//减少
	$(".reduce_num").on('click',function(){
		var amount = $(this).next();
		if (parseInt(amount.val()) <= 1){
			var add_cart_2 = $(this).parent().parent();
			var add_cart_1 = add_cart_2.prev();
			var amount = $(this).next();
			var goods_id = amount.attr("_goodsId");
			var store_id = amount.attr("_storeId");
			subOne(store_id,goods_id);
			amount.val(parseInt(amount.val()) - 1);
			add_cart_2.css('display','none');
		 	add_cart_1.css('display','block');
			//alert("商品数量最少为1");
		} else{
//			var text = $(this).next().attr("name");
     		var amount = $(this).next();
     		var goods_id = amount.attr("_goodsId");
     		var store_id = amount.attr("_storeId");
     		subOne(store_id,goods_id);
			amount.val(parseInt(amount.val()) - 1);
		}
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
		
		//点击购物车的图标，隐藏上面部分
/*	$('#cart_icon').click(function(){
		var btn = $('#pick');
		btn.hide(); 
	});*/
	
	
	$('#cart_icon').click(function(){
		var btn = $('.shopping_cart_1row');
		if(btn.is(':hidden')){
			btn.show(); 
		}
		else{
			btn.hide(); 
		}
	});
	
 
	
	//点击 导航栏的购物车按钮
	/*$('#btn-cart').click(function(){
		//var result = $(".add_cart_2").css('display');
//		var result = $(".add_cart_2").css('display').size();
		$(".add_cart_2").each(function(){//通过each来遍历
		    if($(this).css("display")=='block'){ //通过$(this).css("css名") 来获取当前遍历元素的display值
		    	var goods_id = $(this).find("input:text").attr("_goodsId");
		    	var goods_count = $(this).find("input:text").val();
		    	//var goods_cat_obj = {goods_id:goods_id,goods_count:goods_count};
		    	var goods_id_count =new Array(goods_id,goods_count);
		    	$.ajax({
					type:"GET",
					url:ThinkPHP['MODULE']+'/Goods/ajaxAddToCart/goods_id_count/'+goods_id_count,
					success:function(data)
					{
						if(data == 'yes')
							window.location.href=ThinkPHP['MODULE']+'/Cart/lst';
					}
				});
			}
		});
	});*/
	
	
 });	

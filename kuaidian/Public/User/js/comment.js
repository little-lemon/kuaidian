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
	
	
	//评价获得几星
	var star_comment = document.getElementsByClassName("star_comment");
	for(var m=0;m<star_comment.length;m++)
	{
		var imgs = star_comment[m].getElementsByClassName("star");
		for(var i=0;i<imgs.length;i++)
		{		   
			imgs[i].onmouseenter = OnMouseEnter;
			imgs[i].onmouseleave = OnMouseLeave;
			imgs[i].onclick = OnClick;
		}
		
		//判断是否被点击，是 就保存黄色；不是 就变为白色
		var isClick = false;
	
		//鼠标点击td保留背景色
		function OnClick()
		{
			if (!isClick)
			{
				//OnMouseEnter;
				isClick = true;
			}
		}
	
		//鼠标停留td背景色变黄
		function OnMouseEnter()
		{
			var previous = this.previousElementSibling;
			this.src=ThinkPHP['PUBLIC']+"/User/images/comment/yellow_star.png";
			while (previous)
			{
				previous.src=ThinkPHP['PUBLIC']+"/User/images/comment/yellow_star.png";
				previous = previous.previousElementSibling;
			}
			
		}
		//鼠标移开td背景色变白
		function OnMouseLeave()
		{
			if (!isClick)
			{
				var previous = this.previousElementSibling;
				this.src=ThinkPHP['PUBLIC']+"/User/images/comment/white_star.png";
				while (previous) {
					previous.src=ThinkPHP['PUBLIC']+"/User/images/comment/white_star.png";
					previous = previous.previousElementSibling;
				}
			}
		}
		
	}
	
	$('#btn').click(function(){
		var arr = new Array();
		for(var n=0;n<star_comment.length;n++){
			var imgs = star_comment[n].getElementsByClassName("star");
			var count = 0;
			for(var i=0;i<imgs.length;i++)
			{
				var src = imgs[i].src;
				if(src.indexOf('yellow_star.png') >= 0)
					count++;
			}
			arr[n] = count;
			alert(arr[n]);
		}
/*		$.ajax({
		   data:arr[0],
		   success:function(data){
			   alert(data);
			},
		});*/
	});
	
	
});
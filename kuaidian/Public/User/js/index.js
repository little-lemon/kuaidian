// JavaScript Document
$(function () {	
	$(".rstblock").hover(
	  function () {
		$(this).addClass("hover-background-color");
	  },
	  function () {
		$(this).removeClass("hover-background-color");
	  }
	);
}); 
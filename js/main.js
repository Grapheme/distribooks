$(document).ready(function(){
	$(".enter-text").click(function(){
		$(".dark-screen").fadeIn("fast");
		$(".window-auth").fadeIn("fast");
	});
	$(".donation").click(function(){
		$(".dark-screen").fadeIn("fast");
		$(".window-donation").fadeIn("fast");
	});
	
	$(".dark-screen").click(function(){
		$(".dark-screen").fadeOut("fast");
		$(".window-donation").fadeOut("fast");
		$(".request-div").fadeOut("fast",function(){$(this).find('form').defaultValidationErrorStatus();});
		$(".window-auth").fadeOut("fast");
	});
	
	$(".donate-close").click(function() {
		$(".dark-screen").fadeOut("fast");
		$(".window-donation").fadeOut("fast");
		$(".request-div").fadeOut("fast",function(){$(this).find('form').defaultValidationErrorStatus();});
	});
	
	var recall = "close";
	
	$(".recall").click(function () {
		if(recall == "open"){
			$(".recall-div").slideUp("fast",function(){$(this).find('form').defaultValidationErrorStatus();});
			recall = "close";
		}else{
			$(".recall-div").css({
				"top:":$(this).offset().top,
				"left":$(this).offset().left
			});
			$(".recall-div").slideDown("fast",function(){$(this).find('form').defaultValidationErrorStatus();});
			recall = "open";
		}
	});
	
	$(document).click(function(event) {
	if($(event.target).closest(".recall-div,.recall").length) return;
		$(".recall-div").slideUp("fast",function(){$(this).find('form').defaultValidationErrorStatus();});
		recall = "close";
	});

	var minmenu = "close";

	$(".menu-open").click(function () {
		if( minmenu == "open" ) {
			$(".min-menu").slideUp("fast");
			minmenu = "close";
		} else {
			$(".min-menu").css({
				"top:" : $(this).offset().top,
				"left" : $(this).offset().left
			});
			$(".min-menu").slideDown("fast");
			minmenu = "open";	
		}
	});
	
	$(document).click(function(event) {
    	if ($(event.target).closest(".min-menu,.menu-open").length) return;
   		$(".min-menu").slideUp("fast");
   		minmenu = "close";
  	});
	
	var timer;
	
	$(".shopi#like,.share-product,.like").mousemove(function(){
		var data_tooltip = $(this).attr("data-tooltip");
		var position_left = $(this).offset().left;
		var position_top = $(this).offset().top;
		$(".sn-tooltip").css({"top":position_top+20,"left":position_left}).show();
	});
	$(".shopi#like,.sn-tooltip,.share-product,.like").mouseleave(function () {
		timer = setTimeout(close_tooltip, 500);
	});
	$(".shopi#like,.sn-tooltip,.share-product,.like").mousemove(function () {
		clearTimeout(timer);
	});
	
	function close_tooltip(){
		$(".sn-tooltip").hide().css({"top":0,"left":0});
	}
	
	var slide = "1";
	
	$(".box-1").hover(
  		function () {
  			if(slide!='1') {
    		$(".slider").removeClass('style').removeClass('dist').removeClass('trans').addClass('edit');}
  		},
  		function () {
    		slide = '1';
  		}
	);
	$(".box-2").hover(
  		function () {
    		if(slide!='2') {
    		$(".slider").removeClass('style').removeClass('dist').removeClass('edit').addClass('trans');}
  		},
  		function () {
    		slide = '2';
  		}
	);
	$(".box-3").hover(
  		function () {
    		if(slide!='3') {
    		$(".slider").removeClass('dist').removeClass('trans').removeClass('edit').addClass('style');}
  		},
  		function () {
    		slide = '3';
  		}
	);
	$(".box-4").hover(
  		function () {
    		if(slide!='4') {
    		$(".slider").removeClass('style').removeClass('trans').removeClass('edit').addClass('dist');}
  		},
  		function () {
    		slide = '4';
  		}
	);
	
	var basket = "close";
	
	$("html").click(function() {
		
	});
	
	$(document).click(function(event) {
    	if ($(event.target).closest(".button.basket,.basket-min-div").length) return;
   		$(".basket-min-div").fadeOut("fast");
   		basket = "close";
  	});
	
	$(".basket-close").click(function() {
		$(".basket-min-div").fadeOut("fast");
		basket = "close";
	});
	
	$(".basket-show-link").click(function(){
		if(basket == "close") { $(".basket-min-div").fadeIn("fast"); basket = "open"; }
		else { $(".basket-min-div").fadeOut("fast"); basket = "close"; }
	});
	
	
	var search = "close";
	
	$('.search input').focus(function() {
		$(".search-full").slideDown("fast");
		$(".search").addClass("open");
		search = "open";
	});
	
	$(document).click(function(event) {
    	if ($(event.target).closest(".search-full,.search,.search-page").length) return;
   		$(".search-full").slideUp("fast");
   		$(".search").removeClass("open");
   		search = "close";
  	});
	
});

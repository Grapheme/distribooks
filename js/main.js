$(document).ready(function() {
	
	var slide = "1";
	
	$(".box-1").hover(
  		function () {
  			if(slide!='1') {
    		$(".slider").css({'background-image': "url('img/slider-1.png')"});}
  		},
  		function () {
    		slide = '1';
  		}
	);
	$(".box-2").hover(
  		function () {
    		if(slide!='2') {
    		$(".slider").css({'background-image': "url('img/style-pic.png')"});}
  		},
  		function () {
    		slide = '2';
  		}
	);
	$(".box-3").hover(
  		function () {
    		if(slide!='3') {
    		$(".slider").css({'background-image': "url('img/trans-pic.png')"});}
  		},
  		function () {
    		slide = '3';
  		}
	);
	$(".box-4").hover(
  		function () {
    		if(slide!='4') {
    		$(".slider").css({'background-image': "url('img/dist-pic.png')"});}
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
	
	$(".button.basket").click(function() {
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
    	if ($(event.target).closest(".search-full,.search").length) return;
   		$(".search-full").slideUp("fast");
   		$(".search").removeClass("open");
   		search = "close";
  	});
	
});

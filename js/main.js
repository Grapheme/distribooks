$(document).ready(function() {
	
	var slide = "1";
	
	$(".box-1").hover(
  		function () {
  			if(slide!='1') {
    		$(".slider").stop().animate({opacity: 0},0,function(){
    			$(this).css({'background-image': "url('img/slider-1.png')"})
               .animate({opacity: 1},{duration:250});
 			});}
  		},
  		function () {
    		slide = '1';
  		}
	);
	$(".box-2").hover(
  		function () {
    		if(slide!='2') {
    		$(".slider").stop().animate({opacity: 0},0,function(){
    			$(this).css({'background-image': "url('img/style-pic.png')"})
               .animate({opacity: 1},{duration:250});
 			});}
  		},
  		function () {
    		slide = '2';
  		}
	);
	$(".box-3").hover(
  		function () {
    		if(slide!='3') {
    		$(".slider").stop().animate({opacity: 0},0,function(){
    			$(this).css({'background-image': "url('img/trans-pic.png')"})
               .animate({opacity: 1},{duration:250});
 			});}
  		},
  		function () {
    		slide = '3';
  		}
	);
	$(".box-4").hover(
  		function () {
    		if(slide!='4') {
    		$(".slider").stop().animate({opacity: 0},0,function(){
    			$(this).css({'background-image': "url('img/dist-pic.png')"})
               .animate({opacity: 1},{duration:250});
 			});}
  		},
  		function () {
    		slide = '4';
  		}
	);
});

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
});

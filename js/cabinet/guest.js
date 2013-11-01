/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	$(".apply-order-editing").click(function(){showRequestDivForm($(".div-request-order-editing"));});
	$(".apply-do-editing").click(function(){showRequestDivForm($(".div-request-do-editing"));});
	$(".apply-order-clearance").click(function(){showRequestDivForm($(".div-request-order-clearance"));});
	$(".apply-do-clearance").click(function(){showRequestDivForm($(".div-request-do-clearance"));});
	$(".apply-order-translation").click(function(){showRequestDivForm($(".div-request-order-translation"));});
	$(".apply-do-translation").click(function(){showRequestDivForm($(".div-request-do-translation"));});
	$(".apply-order-distribution").click(function(){showRequestDivForm($(".div-request-order-distribution"));});
	$(".apply-do-distribution").click(function(){showRequestDivForm($(".div-request-do-distribution"));});
	$(".recall-button").click(function(){
		var _form = $(this).parents("form");
		var options = mainOptions;
		options.success = function(response,status,xhr,jqForm){
			mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
			if(response.status){
				$(_form).resetForm();
				$(".before-recall-div").addClass('hidden');
				$(".after-recall-div").fadeIn();
			}else{
				$("div.div-form-operation").after('<div class="msg-alert error">'+response.responseText+'</div>');
			}
		}
		$(_form).ajaxSubmit(options);
		return false;
	});
	
	$(".sign-in-link").click(function(){
		if($(this).hasClass('buy')){
			var largeExpDate = new Date();
			largeExpDate.setTime(largeExpDate.getTime()+(24*3600*1000));
			cookies.setCookie('buy_book',$(this).attr('data-book-id'),largeExpDate,'/')
		}else{
			cookies.deleteCookie('buy_book','/');
		}
		$(".dark-screen").fadeIn("fast");
		$(".window-auth").fadeIn("fast");
	});
	$(".buy-link").click(function(){
		var book = $(this).attr('data-book-id');
		$.ajax({
			url: mt.getLangBaseURL('buy-book'),
			type: 'POST',dataType: 'json',data:{'book':book},
			beforeSend: function(){},
			success: function(response,textStatus,xhr){
				if(response.status){
					mt.redirect(response.redirect);
				}
			},
			error: function(xhr,textStatus,errorThrown){}
		});
	});
	
	function showRequestDivForm(element){
		$(".dark-screen").fadeIn("fast");
		$(element).fadeIn("fast");
		$(".after-recall-div").hide();
		$(".before-recall-div").removeClass('hidden');
	}
});
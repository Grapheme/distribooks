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
	function showRequestDivForm(element){
		$(".dark-screen").fadeIn("fast");
		$(element).fadeIn("fast");
		$(".after-recall-div").hide();
		$(".before-recall-div").removeClass('hidden');
	}
});
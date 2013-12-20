/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$(".set-pay-method").click(function(){
		var pay_method = $(this).attr('data-pay-method').trim();
		var books = [];
		if(cookies.getCookie('buy_book') !== false){
			books = JSON.stringify([cookies.getCookie('buy_book')]);
		}else if(cookies.getCookie('basket_books') !== false){
			books = cookies.getCookie('basket_books');
		}
		if(books != ''){
			$.ajax({
				url: mt.getLangBaseURL('get-payu'),
				data: {
					'books':books,
					'pay_method':pay_method,
					'discount':$("#DISCOUNT").val().trim(),
					'total':$("#TOTAL_SUMMA").html().trim()
				},
				type: 'POST',dataType: 'json',
				beforeSend: function(){},
				success: function(response,textStatus,xhr){
					if(response.status){
						$("#PAY_METHOD").val(pay_method);
						$("#ORDER_REF").val(response.transaction);
						$("#ORDER_DATE").val(response.transaction_time);
						$("#ORDER_HASH").val(response.order_hash);
						$("#payu-submit-form").submit();
					}
				},
				error: function(xhr,textStatus,errorThrown){}
			});
		}else{
			alert(Localize[mt.currentLanguage]['no_books_pay']);
		}
	});
	$(".recall-union-email").click(function(){
		var _form = $(this).parents('form');
		var options = {
			target: null,dataType:'json',type:'post',
			beforeSubmit: mt.ajaxBeforeSubmit,
			success: function(response,status,xhr,jqForm){
				mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
				if(response.status == true){
					if(response.exist){
						$(_form).addClass('hidden');
						$('.form-union-account').find('input[name="email"]').val($(_form).find('input[name="email"]').val().trim());
						$('.form-union-account').find('input[name="password"]').focus();
						$('.form-union-account').removeClass('hidden');
						$('.div-request-union-email').find('.recall-text').html(response.responseText);
					}
					if(response.redirect !== false){
						mt.redirect(response.redirect);
					}
				}
			}
		}
		$(_form).ajaxSubmit(options);
		return false;
	})
	$(".recall-union-account").click(function(){
		var _form = $(this).parents('form');
		var options = {
			target: null,dataType:'json',type:'post',
			beforeSubmit: mt.ajaxBeforeSubmit,
			success: function(response,status,xhr,jqForm){
				mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
				if(response.status == true){
					if(response.redirect !== false){
						mt.redirect(response.redirect);
					}
				}
			}
		}
		$(_form).ajaxSubmit(options);
		return false;
	})

});
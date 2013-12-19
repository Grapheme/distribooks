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
});
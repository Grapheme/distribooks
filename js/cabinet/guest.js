/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
var largeExpDate = new Date();
largeExpDate.setTime(largeExpDate.getTime()+(24*3600*1000));

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
			cookies.setCookie('buy_book',$(this).parents('.buyor').attr('data-book-id'),largeExpDate,'/');
		}else{
			cookies.deleteCookie('buy_book','/');
		}
		$(".dark-screen").fadeIn("fast");
		$(".forgot-left").addClass('hidden');
		$(".form-sign").show();
		$(".window-auth").fadeIn("fast");
	});
	$(".buy-link").click(function(){
		cookies.setCookie('buy_book',$(this).parents('.buyor').attr('data-book-id'),largeExpDate,'/');
	});
	$(".basket-link").click(function(){
		var bookID = $(this).parents('.buyor').attr('data-book-id').trim();
		var pathname = location.pathname;
		var basket_books = [];
		if(cookies.getCookie('basket_books') !== false){basket_books = JSON.parse(cookies.getCookie('basket_books'));}
		if(cookies.getCookie('buy_book') !== false){cookies.deleteCookie('buy_book','/');}
		if(basket_books.length < mt.max_basket && basket_books.indexOf(bookID) == -1){
			basket_books.push(bookID);
			cookies.setCookie('basket_books',JSON.stringify(basket_books),largeExpDate,'/');
			addToBasketBlock(this);
		}
	});
	$(".remove-book-in-basket").click(function(){removeBookInBasket(this);});
	$(".clear-basket").click(function(){
		$.ajax({
			url: mt.getLangBaseURL('clear-basket'),type: 'POST',dataType: 'json',
			beforeSend: function(){},
			success: function(response,textStatus,xhr){
				if(response.status){
					$("div.basket-items-list").empty();
					$("div.basket-items-action-list").empty();
					$(".basket-show-link").eq(0).click();
					$(".basket-show-link").addClass('hidden');
					$('div.buyor').find(".incart").remove();
					$('div.buyor').find(".tocart").removeClass('hidden');
				}
			},
			error: function(xhr,textStatus,errorThrown){}
		})
	});
	$(".form-search").submit(function(){
		if($(".input-search-text").emptyValue() === true){
			return false;
		}
	});
	$("#a-forgor-password").click(function(){
		$(".form-sign").fadeOut('fast',function(){
			$(".form-forgor-password").removeClass('hidden');
		})
	});
	$(".auto-buy-link").click(function(){
		cookies.setCookie('buy_book',$(this).parents('.buyor').attr('data-book-id'),largeExpDate,'/');
		$.ajax({
			url: mt.getLangBaseURL('auto-buy-book'),
			type: 'POST',dataType: 'json',
			success: function(response,textStatus,xhr){
				if(response.status){
					mt.redirect(response.redirect);
				}else{
					alert(response.responseText);
				}
			}
		});
	});
	function currencyExchange(price){
		
		if(mt.currentLanguage == 'en'){
			price = parseInt(price);
			if(cookies.getCookie('project_config') !== false){
				var configuration = JSON.parse(cookies.getCookie('project_config'));
				mt.dollar_rate = configuration['dollar_rate'];
			}
			price = Math.round(price/mt.dollar_rate).toFixed(2);
		}
		return price;
	}
	function showRequestDivForm(element){
		$(".dark-screen").fadeIn("fast");
		$(element).fadeIn("fast");
		$(".after-recall-div").hide();
		$(".before-recall-div").removeClass('hidden');
	}
	function removeBookInBasket(_this){
		
		var bookID = $(_this).parents('.basket-item').attr('data-book-id').trim();
		if(cookies.getCookie('basket_books') !== false){
			basket_books = JSON.parse(cookies.getCookie('basket_books'));
			if(basket_books.indexOf(bookID) != -1){
				delete basket_books[basket_books.indexOf(bookID)];
				var newBasketBooks = mt.getNotNullElements(basket_books);
				if(newBasketBooks !== null){
					var cookieValue = JSON.stringify(newBasketBooks);
					cookies.setCookie('basket_books',cookieValue,largeExpDate,'/');
				}else{
					cookies.deleteCookie('basket_books','/');
					$(".basket-show-link").eq(0).click();
					$(".basket-show-link").addClass('hidden');
					if($(".basket-main-total-price").length > 0){
						$(".basket-min").empty();
						$("a.basket").addClass('hidden');
					}
				}
				removeToBasketBlock(bookID);
			}
		}
	}
	function addToBasketBlock(_this){
		$.ajax({
			url: mt.getLangBaseURL('add-book-in-basket'),
			type: 'POST',dataType: 'json',data:{'book':$(_this).parents('.buyor').attr('data-book-id').trim()},
			beforeSend: function(){},
			success: function(response,textStatus,xhr){
				if(response.status){
					if(response.responseBooks != ''){
						$("div.basket-items-list").append(response.responseBooks);
						$("div.basket-items-list").find(".remove-book-in-basket:last").on('click',function(event){event.preventDefault();event.stopPropagation();removeBookInBasket(this);});
						$(".basket-total-price").html(response.booksTotalPrice);
					}
					if(response.responseBooks !== false){
						if(response.isFullAction == true){
							if($("div.basket-items-action-list").find(".basket-sale-full-action").length == 0){
								$("div.basket-items-action-list").prepend(response.responseBooksActions);
							}else{
								$("div.basket-items-action-list").append(response.responseBooksActions);
							}
							$("div.basket-items-action-list").find(".remove-book-in-basket:last").on('click',function(event){event.preventDefault();event.stopPropagation();removeBookInBasket(this);});
							$("div.basket-items-action-list").find("div.basket-sale-empty-action").not('.hidden').eq(0).addClass('hidden');
						}else{
							$("div.basket-items-action-list").append(response.responseBooksActions);
						}
					}
					$("a.basket-show-link").removeClass('hidden');
					$(_this).parents('p.tocart').addClass('hidden').after('<p class="incart"><span>'+Localize[mt.currentLanguage]['book_in_basket']+'</span></p>');
					actionBasketTarget();
				}
			},
			error: function(xhr,textStatus,errorThrown){}
		})
	}
	function refreshBasket(){
		
		$.ajax({
			url: mt.getLangBaseURL('refresh-books-in-basket'),type: 'POST',dataType: 'json',
			beforeSend: function(){},
			success: function(response,textStatus,xhr){
				if(response.status){
					$("div.basket-items-full-list").html(response.responseText);
					if($(".basket-main-total-price").length > 0){
						$(".basket-main-total-price").html(priceOnAction(response.booksTotalPrice));
						$("#count-book").html(response.booksTotalCount);
					}
					$(".basket-total-price").html(response.booksTotalPrice);
					$("div.basket-items-full-list").find(".remove-book-in-basket").on('click',function(event){event.preventDefault();event.stopPropagation();removeBookInBasket(this);});
				}
			},
			error: function(xhr,textStatus,errorThrown){}
		})
	}
	function removeToBasketBlock(bookID){
		$.ajax({
			url: mt.getLangBaseURL('remove-book-in-basket'),
			type: 'POST',dataType: 'json',data:{'book':bookID},
			beforeSend: function(){
				$('div.basket-book-item[data-book-id="'+bookID+'"]').children().addClass('hidden');
				$('div.basket-book-item[data-book-id="'+bookID+'"]').addClass('loading');
			},
			success: function(response,textStatus,xhr){
				if(response.status){
					$('div.basket-book-item[data-book-id="'+bookID+'"]').remove();
					$('div.buyor[data-book-id="'+bookID+'"]').find(".incart").remove();
					$('div.buyor[data-book-id="'+bookID+'"]').find(".tocart").removeClass('hidden');
					if(response.booksTotalPrice == null){
						cookies.deleteCookie('basket_total_price','/');
					}else{
						$(".basket-total-price").html(response.booksTotalPrice);
						cookies.setCookie('basket_total_price',response.booksTotalPrice,largeExpDate,'/');
					}
					refreshBasket();
					actionBasketTarget();
				}
			},
			error: function(xhr,textStatus,errorThrown){
				$('div.basket-book-item[data-book-id="'+bookID+'"]').children().removeClass('hidden');
				$('div.basket-book-item[data-book-id="'+bookID+'"]').removeClass('loading');
			}
		})
	}
	function actionBasketTarget(){
		
		var total_price = 0;
		var action_price = 0;
		var action_percent = false;
		if(cookies.getCookie('basket_total_price') !== false){
			total_price = parseInt(cookies.getCookie('basket_total_price'));
		}
		if(cookies.getCookie('project_config') !== false){
			var configuration = JSON.parse(cookies.getCookie('project_config'));
			action_price = currencyExchange(configuration['action_price']);
			action_percent = configuration['action_percent']*1;
		}
		if(action_price > 0 && total_price > 0){
			if(total_price >= action_price){
				$(".summa-action-block").removeClass('hidden');
				$(".summa-action-block-info").addClass('hidden');
			}else{
				$(".summa-action-block").addClass('hidden');
				$(".summa-action-block-info").removeClass('hidden');
			}
		}
		return action_percent;
	}
	function priceOnAction(price){
		
		var action_price = 0;
		var action_percent = false;
		var currency = ' руб.';
		price = parseInt(price);
		if(cookies.getCookie('project_config') !== false){
			var configuration = JSON.parse(cookies.getCookie('project_config'));
			action_price = currencyExchange(configuration['action_price']);
			action_percent = configuration['action_percent']*1;
		}
		if(action_price > 0 && action_percent !== false && price >= action_price){
			price = price - Math.round(price*(action_percent/100));
		}
		if(mt.currentLanguage == 'en'){
			currency = ' $';
		}
		
		return price+currency;
	}
});
/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	/*-------------------------------------------------------------------- */
	$(".show-meta").click(function(){
		$(this).siblings('.meta-block').toggleClass('hidden');
	});
	$(".add-media-content").click(function(){
		$(this).siblings('textarea:last').clone().insertBefore(this);
	});
	$(".remove-media-content").click(function(){
		if($(this).siblings('textarea').length > 1){
			$(this).siblings('textarea:last').remove();
		}
	});
	
	$("button.btn-submit").click(function(){
		var _form = $(this).parents('form');
		$(this).addClass('loading');
		$(_form).formSubmitInServer();
	})
	$("button.btn-img-submit").click(function(){
		$(this).addClass('loading');
		var _form = $(this).parents('form');
		$(_form).ajaxSubmit(uploadImage.singlePhotoOption);
		return false;
	});
	
	$("button.remove-item").click(function(){
		if(!confirm('Удалить запись?')){ return false;}
		var _this = this;
		var itemID = $(this).attr('data-item');
		var action = $(this).parents('table').attr('data-action');
		$.ajax({
			url: action,type: 'POST',dataType: 'json',data:{'id':itemID},
			beforeSend: function(){},
			success: function(response,textStatus,xhr){
				if(response.status){$(_this).parents('tr').remove();}
			},
			error: function(xhr,textStatus,errorThrown){}
		});
	});
	$("button.btn-book-caption").click(function(){
		var _this = this;
		var number = $(this).attr('data-item');
		var caption = $(this).siblings('input.book-caption').val().trim();
		var sort = $(this).siblings('input.book-sort').val().trim();
		var format = $(this).siblings('select.book-format').val().trim();
		var action = $(this).parents('ul.book-items').attr('data-action');
		$.ajax({
			url: action,type: 'POST',dataType: 'json',
			data:{'number':number,'caption':caption,'sort':sort,'format':format},
			beforeSend: function(){$(_this).addClass('loading');},
			success: function(response,textStatus,xhr){
				$(_this).removeClass('loading');
				if(response.status){
					$(_this).html('OK').removeClass('btn-info').addClass('btn-success');
				}else{
					$(_this).html('NOT').removeClass('btn-info').addClass('btn-danger');
				}
			},
			error: function(xhr,textStatus,errorThrown){
				$(_this).removeClass('loading');
				$(_this).html('ERR').removeClass('btn-info').addClass('btn-danger');
			}
		});
	});
});
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
});
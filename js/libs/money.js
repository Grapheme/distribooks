/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

var ub = ub || {};
ub.balance = 0;
ub.setValue = function(value){ub.balance = value;};
ub.setBalance = function(element){$(element).html(ub.balance);};
$(function(){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	if($("#user-balance").exists()){ub.setValue($("#user-balance").html());}else{ub.setValue(0);}
	$("a.course-subscribe").click(function(){
		var _this = this;
		var coursePrice = $(_this).attr('data-course-price').trim();
		if(parseFloat(coursePrice) > parseFloat(ub.balance)){
			alert('Ваш баланс меньше стоимости курса');
			return false;
		}else{
			var courseID = $(_this).attr('data-course').trim();
			if($(_this).hasClass('btn-loading')){$(_this).addClass('loading');}
			$.ajax({
				url: mt.getBaseURL('courses/subscribe'),
				data: {'course':courseID},type: 'POST',dataType: 'json',
				success: function(response,textStatus,xhr){
					$(_this).removeClass('loading');
					if(response.status == true){
						ub.setValue(response.balance);
						ub.setBalance($("#user-balance"));
						if(typeof VK_API !== "undefined"){
							VK_API.clearConfig();
							VK_API.setConfig('pageTitle',$(_this).parents('div.div-link-course').find('.course-header-title').html().trim());
							VK_API.setConfig('pageDescription',$(_this).parents('div.div-link-course').find('.course-header-description').html().trim());
							VK_API.setConfig('pageUrl',$(_this).parents('div.div-link-course').attr('data-hreflink').trim());
							VK_API.setConfig('pageImage',mt.getBaseURL('loadimage/course-thumbnail/'+courseID));
						}
						if(typeof FB_API !== "undefined"){
							FB_API.clearConfig();
							FB_API.setConfig('pageTitle',$(_this).parents('div.div-link-course').find('.course-header-title').html().trim());
							FB_API.setConfig('pageDescription',$(_this).parents('div.div-link-course').find('.course-header-description').html().trim());
							FB_API.setConfig('pageUrl',$(_this).parents('div.div-link-course').attr('data-hreflink').trim());
							FB_API.setConfig('pageImage',mt.getBaseURL('loadimage/course-thumbnail/'+courseID));
						}
						if($(_this).attr('data-target') == 'no-btn'){
							$(_this).remove();
						}else if($(_this).attr('data-target') == 'no-text'){
							$(_this).remove();
						}else{
							$(_this).replaceWith('<div class="msg-alert">'+response.responseText+'</div>');
						}
						$("div.wallpost-popup").removeClass('hidden');
					}else{
						alert(response.responseText);
					}
				},
				error: function(xhr,textStatus,errorThrown){
					$(_this).removeClass('loading');
				}
			});
		}
	});
	$("button.btn-financial-report-period-view").click(function(){pagination.showFinancialReport(1);});
	$("#input-balance").keyup(function(){
		var val = parseInt($('#input-balance').val().trim());
		if(val > 0){
			$("#input-balance").val(val);
			$('#bal-action').removeAttr('disabled');
			$('#bal-action span').html(val);
		}else{
			$('#bal-action').attr('disabled','disabled');
			$('#bal-action span').html(0);
		}
	});
	
	$("form.form-replenishment-balance .btn-submit").click(function(){
		var balance = parseInt($('#input-balance').val().trim());
		$.ajax({
			url: mt.getBaseURL('balance-replenishment'),
			data: {'balance':balance},type: 'POST',dataType: 'json',
			beforeSend: function(){$("form.form-replenishment-balance").find('button.btn-submit').addClass('loading');},
			success: function(response,textStatus,xhr){
				if(response.status){
					$("form.form-replenishment-balance").find('input.operation-xml-content').val(response.responseXML);
					$("form.form-replenishment-balance").find('input.operation-signature-content').val(response.responseSignature);
					$("form.form-replenishment-balance").submit();
				}
			},
			error: function(xhr,textStatus,errorThrown){
				$("form.form-replenishment-balance").find('button.btn-submit').removeClass('loading');
			}
		});
		
		
	});
});
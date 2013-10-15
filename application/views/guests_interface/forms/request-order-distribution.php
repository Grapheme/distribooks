<div class="request-div div-request-order-distribution">
	<div class="recall-in request">
		<div class="after-recall-div">
			<img class="recall-after" src="<?=baseURL('img/after-recall.png');?>">
			<p class="recall-after-text"><?=lang('form_recall_after_text')?></p>
			<div class="recall-text"><?=lang('form_recall_after_message')?></div>
		</div>
		<div class="before-recall-div">
			<a href="#" class="donate-close"></a>
			<img class="recall-img" src="<?=baseURL('img/request.png')?>">
			<div class="recall-text"><?=lang('form_service_text');?></div>
			<form>
				<input class="error" type="text" placeholder="<?=lang('form_service_name');?>">
				<input type="text" placeholder="E-mail">
				<input type="text" placeholder="<?=lang('form_service_number');?>">
				<textarea class="error" placeholder="<?=lang('form_service_message');?>:"></textarea>
				<input type="button" class="recall-button" value="<?=lang('form_service_button');?>">
			</form>
		</div>
	</div>
</div>
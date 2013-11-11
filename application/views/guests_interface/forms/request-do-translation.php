<div class="request-div div-request-do-translation">
	<div class="recall-in request">
		<div class="after-recall-div">
			<img class="recall-after" src="<?=baseURL('img/after-recall.png');?>">
			<p class="recall-after-text"><?=lang('form_recall_after_text')?></p>
			<div class="recall-text"><?=lang('form_recall_after_message')?></div>
		</div>
		<div class="before-recall-div">
			<a href="#" class="donate-close  no-clickable"></a>
			<img class="recall-img" src="<?=baseURL('img/request.png')?>">
			<div class="recall-text"><?=lang('form_service_text');?></div>
			<form action="<?=site_url('request-do-translation');?>" method="POST">
				<input class="valid-required" name="yourself" type="text" placeholder="<?=lang('form_service_name');?>">
				<input class="valid-required valid-email" name="email" type="text" placeholder="E-mail">
				<input class="valid-required valid-phone-number" name="phone" type="text" placeholder="<?=lang('form_service_number');?>">
				<textarea class="valid-required" name="message" placeholder="<?=lang('form_service_message');?>:"></textarea>
				<input type="button" class="recall-button btn-loading" value="<?=lang('form_service_button');?>">
			</form>
		</div>
	</div>
</div>
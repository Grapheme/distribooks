<form action="<?=site_url('request-call');?>" method="POST">
	<input type="text" class="valid-required" name="yourself" placeholder="<?=lang('form_recall_name')?>">
	<input type="text" class="valid-required valid-email" name="email" placeholder="E-mail">
	<input type="text" class="valid-required valid-phone-number" name="phone" placeholder="<?=lang('form_recall_number')?>">
	<input type="button" class="recall-button btn-loading" value="<?=lang('form_recall_button');?>">
</form>
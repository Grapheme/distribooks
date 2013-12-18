<form action="<?=site_url('request-call');?>" method="POST">
	<input type="text" class="valid-required" name="yourself" placeholder="<?=lang('form_recall_name')?>">
	<input type="text" class="valid-required valid-email" name="email" placeholder="E-mail">
	<textarea class="valid-required" name="phone" placeholder="<?=lang('form_recall_number')?>"></textarea>
	<input type="button" class="recall-button btn-loading" value="<?=lang('form_recall_button');?>">
</form>
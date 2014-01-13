<form action="<?=site_url('set-gift-email');?>" class="form-gift-email" method="POST">
	<input type="text" class="valid-required valid-email" name="email" placeholder="E-mail"><br/>
	<button type="button" class="recall-gift-email btn-loading"><?=lang('gift_email');?></button>
</form>
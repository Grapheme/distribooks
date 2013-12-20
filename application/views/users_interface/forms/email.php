<form action="<?=site_url(USER_START_PAGE.'/save-email');?>" class="form-union-email" method="POST">
	<input type="text" class="valid-required valid-email" name="email" placeholder="E-mail"><br/>
	<button type="button" class="recall-union-email btn-loading"><?=lang('union_email');?></button>
</form>
<form action="<?=site_url(USER_START_PAGE.'/save-email');?>" class="form-union-account hidden" method="POST">
	<input type="text" class="valid-required valid-email" name="email" placeholder="E-mail"><br/>
	<input type="password" class="valid-required" name="password" placeholder="<?=lang('signin_password')?>"><br/>
	<button type="button" class="recall-union-account btn-loading"><?=lang('union_account');?></button>
</form>
<a href="#" class="no-clickable" id="noask-email"><?=lang('no-ask-email')?></a>
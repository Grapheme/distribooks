<form action="<?=site_url(USER_START_PAGE.'/save-email');?>" method="POST">
	<input type="text" class="valid-required valid-email" name="email" placeholder="E-mail"><br/>
	<input type="password" class="hidden" name="password" placeholder="<?=lang('signin_password')?>"><br/>
	<button type="button" class="btn-union-email btn-loading"><?=lang('union_email');?></button>
</form>
<div class="window-auth">
	<div class="auth-top">
		<img class="auth-top-img" src="<?=baseURL('img/auth-img.png');?>">
		<div class="auth-text"><?=lang('signin_auth_text')?></div>
	</div>
	<div class="clear"></div>
	<div class="auth-left">
		<form action="">
			<input type="text" name="name" placeholder="<?=lang('signin_nickname')?>">
			<input type="text" name="email" placeholder="E-mail">
			<input type="text" name="phone" placeholder="<?=lang('signin_number')?>">
			<input type="button" value="<?=lang('signin_button')?>" class="auth-button">
		</form>
	</div>
	<div class="auth-right">
		<a href="#" class="auth-soc" id="tw"></a>
		<a href="#" class="auth-soc" id="vk"></a>
		<a href="#" class="auth-soc" id="fb"></a>
		<a href="#" class="auth-soc" id="ok"></a>
		<input type="text" name="email-soc" placeholder="E-mail" class="auth-soc-email">
		<p><?=lang('signin_auth_soc')?></p>
	</div>
</div>
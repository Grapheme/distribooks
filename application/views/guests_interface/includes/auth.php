<div class="window-auth">
	<div class="auth-top">
		<img class="auth-top-img" src="<?=baseURL('img/auth-img.png');?>">
		<div class="auth-text"><?=lang('signin_auth_text')?></div>
	</div>
	<div class="clear"></div>
	<div class="auth-left">
		<form action="<?=baseURL($this->uri->language_string.'/sign-in/manual');?>" method="POST">
			<input type="text" class="valid-required tooltip-place" data-tooltip-place="right" name="login" placeholder="<?=lang('signin_nickname')?>">
			<input type="password" class="valid-required tooltip-place" data-tooltip-place="right" name="password" placeholder="<?=lang('signin_password')?>">
			<div class="div-form-operation">
				<button type="button" class="auth-button btn-sign-submit btn-loading"><?=lang('signin_button')?></button>
			</div>
		</form>
	</div>
	<div class="auth-right">
		<a href="<?=OAUTH_VK.site_url('sign-in/vk');?>" class="auth-soc" id="vk"></a>
		<a href="<?=OAUTH_FACEBOOK.site_url('sign-in/facebook');?>" class="auth-soc" id="fb"></a>
		<form action="<?=baseURL($this->uri->language_string.'/sign-up/manual');?>" method="POST">
			<input type="text" name="email" placeholder="E-mail" class="auth-soc-email valid-required valid-email">
			<p><?=lang('signin_auth_soc')?></p>
			<div class="div-form-operation">
				<button type="button" class="auth-button btn-sign-submit btn-loading"><?=lang('signup_button')?></button>
			</div>
		</form>
	</div>
</div>
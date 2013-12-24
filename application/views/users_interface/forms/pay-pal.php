<?php
if($this->uri->language_string == RUSLAN):
	$icon_link = 'https://www.paypal.com/ru_RU/i/btn/btn_dg_pay_w_paypal.gif';
elseif($this->uri->language_string == ENGLAN):
	$icon_link = 'https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif';
endif;
?>
<form action="<?=site_url(USER_START_PAGE.'/checkout-paypal')?>" METHOD="POST">
	<input type="hidden" name="books[]" value="" />
	<input type="image" name="paypal_submit" id="paypal_submit"  src="<?=$icon_link;?>" border="0" align="top" alt="<?=lang('pay_with_paypal')?>"/>
</form>
<form name="live_update_form_prev" method="POST" action="https://secure.payu.ru/order/lu.php" id="payu-submit-form">
	<input name="MERCHANT" type="hidden" value="<?=PAYU_MERCHANT;?>" id="MERCHANT">
	<input name="ORDER_REF" autocomplete="off" type="hidden" value="" id="ORDER_REF">
	<input name="ORDER_DATE" autocomplete="off" type="hidden" value="" id="ORDER_DATE">
	<?php $total_summa = 0;?>
<?php for($i=0;$i<count($books);$i++):?>
	<?php if(($i+1)%$this->project_config['free_book'] != 0):?>
	<input name="ORDER_PNAME[]" type="hidden" value="<?=$books[$i][$this->uri->language_string.'_title'];?>">
	<input name="ORDER_PCODE[]" type="hidden" value="<?=$books[$i]['id'];?>">
	<?php endif;?>
<?php if(($i+1)%$this->project_config['free_book'] != 0):?>
	<?php if($books[$i]['price_action'] > 0):?>
	<input name="ORDER_PRICE[]" type="hidden" value="<?=$books[$i]['price_action'];?>">
		<?php $total_summa += $books[$i]['price_action'];?>
	<?php else:?>
	<input name="ORDER_PRICE[]" type="hidden" value="<?=$books[$i]['price'];?>">
		<?php $total_summa += $books[$i]['price'];?>
	<?php endif;?>
<?php endif;?>
	<?php if(($i+1)%$this->project_config['free_book'] != 0):?>
	<input name="ORDER_PRICE_TYPE[]" type="hidden" value="GROSS">
	<input name="ORDER_QTY[]" type="hidden" value="1">
	<input name="ORDER_VAT[]" type="hidden" value="18">
	<?php endif;?>
<?php endfor;?>
	<input name="ORDER_SHIPPING" type="hidden" value="0">
<?php
	$discount = 0;
	if($this->project_config['action_price'] > 0):
		if($total_summa > $this->project_config['action_price']):
			$discount = round($total_summa*($this->project_config['action_percent']/100),2,PHP_ROUND_HALF_EVEN);
		endif;
	endif;
?>
	<input name="DISCOUNT" type="hidden" value="<?=$discount;?>" id="DISCOUNT">

	<input name="PRICES_CURRENCY" type="hidden" value="RUB">
	<input name="PAY_METHOD" autocomplete="off" type="hidden" value="" id="PAY_METHOD">
	<input name="ORDER_HASH" autocomplete="off" type="hidden" value="" id="ORDER_HASH">
	<input name="BACK_REF" type="hidden" value="<?=site_url('cabinet');?>">
	<input name="LANGUAGE" type="hidden" value="<?=$this->uri->language_string;?>" id="LANGUAGE">
	<input name="TESTORDER" type="hidden" value="FALSE">
	<div id="TOTAL_SUMMA" class="hidden"><?=$total_summa-$discount;?></div>
</form>
<?php
	if(!isset($basket_list)):
		$basket_list = NULL;
	endif;
?>
<div class="basket-min-div">
	<a href="" class="basket-close no-clickable"></a>
	<img src="<?=baseURL('img/basket-arrow.png');?>" class="basket-arrow">
	<div class="basket-min">
		<p class="basket-title"><?=lang('basket_title');?></p>
		<div class="basket-items-full-list">
			<?php $this->load->view('guests_interface/html/basket/basket-full-lists',array('basket_list'=>$basket_list));?>
		</div>
		<div class="basket-line"></div>
		<div class="basket-item">
			<div style="float: left;">
			<a href="" class="no-clickable clear-basket"><?=lang('clear-basket');?></a>
			<?php if($this->project_config['action_price'] > 0):?>
				<div class="summa-action-block<?=(CurrencyExchangeRUStoUS($this->account_basket['basket_total_price']) < $this->project_config['action_price'])?' hidden':'';?>">
					<?=lang('top_menu_promotion');?> -<?=$this->project_config['action_percent']?>%
				</div>
			<?php endif;?>
			</div>
			<div style="float: right;">
				<!--<p class="basket-item-name all"><?=lang('basket_total');?>:</p>-->
				<p class="basket-price basket-total-price" style="border: 0;"><?=$this->account_basket['basket_total_price'];?></p>
				<div class="basket-one-buy">
					<a href="<?=site_url('basket')?>" class="buy buy-all"><?=lang('basket_buy');?></a>
				</div>
			</div>
		</div>
	</div>
</div>
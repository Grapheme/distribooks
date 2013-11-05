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
			<a href="" class="no-clickable clear-basket"><?=lang('clear-basket');?></a>
			<div style="float: right;">
				<p class="basket-item-name all"><?=lang('basket_total');?>:</p>
				<p class="basket-price basket-total-price" style="border: 0;"><?=$this->account_basket['basket_total_price'];?></p>
				<div class="basket-one-buy">
					<a href="<?=site_url('basket')?>" class="buy buy-all"><?=lang('basket_buy_all');?></a>
				</div>
			</div>
		</div>
	</div>
</div>
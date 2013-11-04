<?php 
	$HTMLbasketList = '';
	for($i=0;$i<count($basket_list);$i++):
		$HTMLbasketList .= $this->load->view('guests_interface/html/basket/basket-item',array('book'=>$basket_list[$i]),TRUE);
	endfor;
//	if($i-1 == $this->input->cookie('free_book_number')):
		$HTMLbasketList .= $this->load->view('guests_interface/html/basket/basket-item-sale-full',NULL,TRUE);
		$HTMLbasketList .= $this->load->view('guests_interface/html/basket/basket-item-sale-empty',NULL,TRUE);
//	elseif($i == $this->input->cookie('free_book_number')):
		
//	endif;
?>
<div class="basket-min-div">
	<a href="" class="basket-close no-clickable"></a>
	<img src="<?=baseURL('img/basket-arrow.png');?>" class="basket-arrow">
	<div class="basket-min">
		<p class="basket-title"><?=lang('basket_title');?></p>
		<div class="basket-items-list"><?=$HTMLbasketList;?></div>
		<div class="basket-line"></div>
		<div class="basket-item">
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
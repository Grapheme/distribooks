<?php 
	$HTMLbasketList = '';
	$HTMLbasketActionList = '';
	$booksBasketCount = count($basket_list); $freeBooks = 0;
	for($i=0;$i<$booksBasketCount;$i++):
		if(($i+1)%$this->project_config['free_book'] != 0):
			$HTMLbasketList .= $this->load->view('guests_interface/html/basket/basket-item',array('book'=>$basket_list[$i]),TRUE);
		else:
			$freeBooks++;
			$HTMLbasketActionList .= $this->load->view('guests_interface/html/basket/basket-item-sale-full',array('book'=>$basket_list[$i]),TRUE);
			$HTMLbasketActionList .= $this->load->view('guests_interface/html/basket/basket-item-sale-empty',array('hidden'=>TRUE),TRUE);
		endif;
	endfor;
	if(($freeBooks == 0 && $booksBasketCount == 3) || ($freeBooks == 1 && $booksBasketCount == 7)):
		$HTMLbasketActionList .= $this->load->view('guests_interface/html/basket/basket-item-sale-empty',array('hidden'=>FALSE),TRUE);
	endif;
?>
<div class="basket-min-div">
	<a href="" class="basket-close no-clickable"></a>
	<img src="<?=baseURL('img/basket-arrow.png');?>" class="basket-arrow">
	<div class="basket-min">
		<p class="basket-title"><?=lang('basket_title');?></p>
		<div class="basket-items-list"><?=$HTMLbasketList;?></div>
		<div class="basket-items-action-list"><?=$HTMLbasketActionList;?></div>
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
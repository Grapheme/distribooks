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
<div class="basket-items-list"><?=$HTMLbasketList;?></div>
<div class="basket-items-action-list"><?=$HTMLbasketActionList;?></div>
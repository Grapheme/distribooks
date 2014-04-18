<?php 
	$HTMLbasketList = '';
	for($i=0;$i<count($basket_list);$i++):
		if(($i+1)%$this->project_config['free_book'] == 0):
			$HTMLbasketList .= $this->load->view('guests_interface/html/basket/basket-item-sale-full',array('book'=>$basket_list[$i]),TRUE);
		else:
			$HTMLbasketList .= $this->load->view('guests_interface/html/basket/basket-item',array('book'=>$basket_list[$i]),TRUE);
		endif;
	endfor;
?>
<div class="basket-items-list"><?=$HTMLbasketList;?></div>

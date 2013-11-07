<div class="basket-item basket-book-item" data-book-id="<?=$book['id'];?>">
	<a class="basket-rm remove-book-in-basket no-clickable" href=""></a>
	<div class="basket-img">&nbsp;<img src="<?=baseURL($book['thumbnail']);?>"></div>
	<a href="<?=site_url($this->uri->language_string.'/'.$book['page_address'])?>" class="basket-item-name"><?=$book[$this->uri->language_string.'_title'];?></a>
	<p class="basket-price">
	<?php if($book['price_action'] > 0):?>
		<?=getPriceInCurrency($book['price_action'])?>
	<?php else:?>
		<?=getPriceInCurrency($book['price'])?>
	<?php endif;?>
	</p>
</div>
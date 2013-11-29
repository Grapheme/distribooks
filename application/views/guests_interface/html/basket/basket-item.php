<div class="basket-item basket-book-item" data-book-id="<?=$book['id'];?>">
	<a class="basket-rm remove-book-in-basket no-clickable" href=""></a>
	<div class="basket-img">&nbsp;<img src="<?=baseURL($book['thumbnail']);?>"></div>
	<a href="<?=baseURL($this->uri->language_string.'/'.$book['page_address'])?>" class="basket-item-name"><?=$book[$this->uri->language_string.'_title'];?></a>
	<div class="basket-author">
	<?php for($j=0;$j<count($book['authors']);$j++):?>
		<a href="<?=site_url('catalog?author='.$book['authors'][$j]['id'])?>"><?=$book['authors'][$j][$this->uri->language_string.'_name'];?></a><?php if(isset($book['authors'][$j+1])):?>, <?php endif;?>
	<?php endfor;?>
	</div>
	<p class="basket-price">
	<?php if($book['price_action'] > 0):?>
		<?=getPriceInCurrency($book['price_action'])?>
	<?php else:?>
		<?=getPriceInCurrency($book['price'])?>
	<?php endif;?>
	</p>
</div>
<div class="basket-sale-full-action basket-book-item" data-book-id="<?=$book['id'];?>">
	<div class="basket-item basket-sale book-as-action" data-book-id="<?=$book['id'];?>">
		<a class="basket-rm remove-book-in-basket book-as-action no-clickable" href="#"></a>
		<div class="basket-img">&nbsp;<img src="<?=baseURL($book['thumbnail']);?>"></div>
		<a href="<?=site_url($this->uri->language_string.'/'.$book['page_address'])?>" class="basket-item-name"><?=$book[$this->uri->language_string.'_title'];?></a>
	</div>
	<div class="basket-sale-bottom"></div>
</div>
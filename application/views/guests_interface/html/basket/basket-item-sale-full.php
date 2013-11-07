<div class="basket-sale-full-action basket-book-item" data-book-id="<?=$book['id'];?>">
	<div class="basket-item basket-sale book-as-action" data-book-id="<?=$book['id'];?>">
		<a class="basket-rm remove-book-in-basket book-as-action no-clickable" href="#"></a>
		<div class="basket-img">&nbsp;<img src="<?=baseURL($book['thumbnail']);?>"></div>
		<a href="<?=site_url($this->uri->language_string.'/'.$book['page_address'])?>" class="basket-item-name"><?=$book[$this->uri->language_string.'_title'];?></a>
		<p class="author">
			<?php for($j=0;$j<count($book['authors']);$j++):?>
				<a href="<?=site_url('catalog?author='.$book['authors'][$j]['id'])?>"><?=$book['authors'][$j][$this->uri->language_string.'_name'];?></a><?php if(isset($book['authors'][$j+1])):?>,<br/> <?php endif;?>
			<?php endfor;?>
		</p>
	</div>
	<div class="basket-sale-bottom"></div>
</div>
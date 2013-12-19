<div class="yellow">
	<div class="container_5">
		<div style="position: relative;"><img src="<?=baseURL('img/shadow-y.png');?>" class="shadow-top"></div>
		<div class="grid_1">&nbsp;</div>
		<div class="grid_4">
			<h2><span class="sale-title"><?=lang('catalog_promotion')?>:</span></h2>
			<?php if($this->uri->language_string == 'ru'): ?>
				<img src="<?=baseURL('img/sale.png')?>" class="sale">
			<?php elseif($this->uri->language_string == 'en'): ?>
				<img src="<?=baseURL('img/sale_en.png')?>" class="sale">
			<?php endif;?>
			<div class="position: relative;"><a href="<?=site_url('catalog')?>" class="button red sale"><?=lang('catalog_choice_books')?></a></div>
		</div>
	</div>
</div>
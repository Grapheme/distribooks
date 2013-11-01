<?php if($book['signed_book'] === FALSE):?>
	<?php if(!empty($currency) && isset($currency[$book['currency']-1]['title'])):?>
		<?php if($book['price_action'] > 0):?>
			<p class="price old"><?=$book['price_action']?> <?=$currency[$book['currency']-1]['title'];?></p>
		<?php endif;?>
		<?php if($book['price'] > 0):?>
			<p class="price"><?=$book['price']?> <?=$currency[$book['currency']-1]['title'];?></p>
		<?php else:?>
			<p class="price">Бесплатно</p>
		<?php endif;?>
	<?php endif;?>
<?php endif;?>
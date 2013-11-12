<?php if($book['signed_book'] === FALSE):?>
	<?php if($book['price_action'] > 0):?>
		<p class="price old"><?=getPriceInCurrency($book['price'])?></p>
		<p class="price new"><?=getPriceInCurrency($book['price_action'])?></p>
	<?php else:?>
		<?php if($book['price'] > 0):?>
			<p class="price"><?=getPriceInCurrency($book['price'])?></p>
		<?php endif;?>
	<?php endif;?>
<?php endif;?>
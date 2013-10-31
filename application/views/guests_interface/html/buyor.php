<div class="buyor">
	<?php if($this->loginstatus === FALSE):?>
		<a href="" class="buy sign-in-link no-clickable"><?=lang('book_shop_buyor')?></a>
	<?php else:?>
		<a href="" class="buy no-clickable"><?=lang('book_shop_buyor')?></a>
	<?php endif?>
	<p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
</div>
<?php if($this->account['group'] != ADMIN_GROUP_VALUE):?>
	<?php if($mySignedBook === FALSE):?>
		<div class="buyor">
			<a data-book-id="<?=$book_id;?>" href="" class="buy <?=($this->loginstatus === FALSE)?'sign-in-link':'buy-link';?> no-clickable"><?=lang('book_shop_buyor')?></a>
			<p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
		</div>
	<?php endif;?>
<?php endif;?>
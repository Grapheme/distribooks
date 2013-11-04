<?php if($this->account['group'] != ADMIN_GROUP_VALUE):?>
	<?php if($mySignedBook === FALSE):?>
		<div class="buyor" data-book-id="<?=$book_id;?>">
			<a href="" class="buy <?=($this->loginstatus === FALSE)?'sign-in-link':'buy-link';?> no-clickable"><?=lang('book_shop_buyor')?></a>
			<p class="tocart<?=($in_basket === TRUE)?' hidden':'';?>">
				<span><?=lang('book_or')?></span>
				<a href="" class="basket-link<?=($this->loginstatus === TRUE && $this->account['group'] == USER_GROUP_VALUE)?'-auth':'';?> no-clickable"><?=lang('book_shop_tocart')?></a>
			</p>
		<?php if($in_basket === TRUE):?>
			<p class="incart"><span><?=lang('book_in_basket')?></span></p>
		<?php endif;?>
		</div>
	<?php endif;?>
<?php endif;?>
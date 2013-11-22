<?php if($this->account['group'] != ADMIN_GROUP_VALUE):?>
	<?php if($mySignedBook === FALSE):?>
		<div class="buyor" data-book-id="<?=$book_id;?>">
			<a href="<?=(isUserLoggined())?site_url('pay'):'';?>" class="buy <?=(!isUserLoggined())?'sign-in-link no-clickable':'buy-link';?>"><?=lang('book_shop_buyor')?></a>
			<p class="tocart<?=($in_basket === TRUE)?' hidden':'';?>">
				<span><?=lang('book_or')?></span>
				<a href="" class="basket-link no-clickable"><?=lang('book_shop_tocart')?></a>
			</p>
		<?php if($in_basket === TRUE):?>
			<p class="incart"><span><?=lang('book_in_basket')?></span></p>
		<?php endif;?>
		</div>
	<?php endif;?>
<?php endif;?>
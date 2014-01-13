<div class="formats">
<?php if(!empty($formats['categories_ids'])):?>
	<a href="<?=site_url('formats');?>" class="formats-title"><?=lang('book_formats')?>:</a>
	<?php for($i=0;$i<count($formats['categories_ids']);$i++):?>
		<?php if(isset($formats['categories_titles'][$formats['categories_ids'][$i]])):?>
			<p class="format">
			<?=($i==0)?'<b>':'';?><?=$formats['categories_titles'][$formats['categories_ids'][$i]][$this->uri->language_string.'_title'];?>:<?=($i==0)?'</b>':'';?>
			</p>
		<?php endif;?>
		<?php for($j=0;$j<count($formats['formats']);$j++):?>
			<?php if($formats['categories_ids'][$i] == $formats['formats'][$j]['category_id']):?>
				<?php 
					$download_link = '#'; $download_class = ' no-clickable';
					if($book['signed_book'] === TRUE):
						$download_link = site_url('download-book?book='.$book['id'].'&format='.$formats['formats'][$j]['format_id']);
						$download_class = '';
					endif;
				?>
					<a class="format-link<?=$download_class;?>" href="<?=$download_link;?>"><?=$formats['formats'][$j]['title']?></a><?php if(isset($formats['formats'][$j+1]['category_id']) && $formats['formats'][$j+1]['category_id'] == $formats['categories_ids'][$i]):?>,<?php endif;?>
			<?php endif;?>
		<?php endfor;?>
	<?php endfor;?>
<?php else:?>
	<p class="formats-title"><?=lang('book_formats_failed')?></p>
<?php endif;?>
</div>
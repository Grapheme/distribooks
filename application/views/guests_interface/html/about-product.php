<div class="about-product">
	<a class="share-product" href="#"><img src="<?=baseURL('img/big-like.png')?>"><span><?=lang('book_share')?></span></a>
	<p class="about-p"><?=lang('book_age_limit')?>: <span><?=$age_limit['title'];?></span></p>
	<p class="about-p"><?=lang('book_genre')?>: <a href="<?=site_url('catalog?genre='.$book['genre']);?>"><?=$book['genre_title'];?></a></p>
	<p class="about-p"><?=lang('book_tags')?>: <?php for($i=0;$i<count($keywords);$i++):?><a href="<?=site_url('catalog?keyword='.md5(trim($keywords[$i])))?>"><?=$keywords[$i];?></a><?php if(isset($keywords[$i+1])):?>,<?php endif;?><?php endfor;?></p>
	<p class="about-p"><?=lang('book_copyright')?>: <span><?=$book[$this->uri->language_string.'_copyright'];?></span></p>
	<p class="about-p"><?=lang('book_date_released')?>: <span><?=$book['date_released'];?></span></p>
	<p class="about-p"><?=lang('book_size')?>: <span><?=$book[$this->uri->language_string.'_size'];?></span></p>
	<p class="about-p"><?=lang('book_isbn')?>: <span><?=$book['isbn'];?></span></p>
</div>
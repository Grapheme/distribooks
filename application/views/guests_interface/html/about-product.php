<div class="about-product">
	<div class="pluso-div">
		<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="#ffffff" data-options="medium,square,line,vertical,nocounter,theme=01" data-services=""></div>
	<span><?=lang('book_share')?></span></div>
	<p class="about-p"><?=lang('book_age_limit')?>: <span><?=$age_limit['title'];?></span></p>
	<p class="about-p"><?=lang('book_genre')?>: <a href="<?=site_url('catalog?genre='.$book['genre']);?>"><?=$book['genre_title'];?></a></p>
	<p class="about-p"><?=lang('book_tags')?>: <?php for($i=0;$i<count($keywords);$i++):?><a href="<?=site_url('catalog?keyword='.md5(trim($keywords[$i])))?>"><?=$keywords[$i];?></a><?php if(isset($keywords[$i+1])):?>,<?php endif;?><?php endfor;?></p>
	<p class="about-p"><?=lang('book_copyright')?>: <span><?=$book[$this->uri->language_string.'_copyright'];?></span></p>
	<p class="about-p"><?=lang('book_date_released')?>: <span><?=$book['date_released'];?></span></p>
	<p class="about-p"><?=lang('book_size')?>: <span><?=$book[$this->uri->language_string.'_size'];?></span></p>
	<p class="about-p"><?=lang('book_isbn')?>: <span><?=$book['isbn'];?></span></p>
</div>
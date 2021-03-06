<div class="shop-top">
	<div class="shop-img">
		<?php $this->load->view('guests_interface/html/book-properties');?>
		<div class="shop-img-cont"><a href="<?=site_url($book['page_address'])?>"><img class="zoom-img" src="<?=baseURL($book['thumbnail']);?>" data-zoom-image="<?=baseURL($book['origin']);?>"></a></div>
	</div>
	<div class="shop-about">
		<a href="<?=site_url($book['page_address'])?>" class="title"><?=$book[$this->uri->language_string.'_title'];?></a>
		<p class="author">
		<?php for($j=0;$j<count($book['authors']);$j++):?>
			<a href="<?=site_url('catalog?author='.$book['authors'][$j]['id'])?>"><?=$book['authors'][$j][$this->uri->language_string.'_name'];?></a><?php if(isset($book['authors'][$j+1])):?>,<br/> <?php endif;?>
		<?php endfor;?>
		</p>
		<?php
			$disabled = TRUE;
			if(isUserLoggined()):
				if($book['signed_book'] === TRUE):
					$disabled = FALSE;
				endif;
			endif;
		?>
		<?php $this->load->view('guests_interface/html/book-rating',array('disabled'=>$disabled,'bookID'=>$book['id']));?>
		<a href="<?=site_url('catalog?genre='.$book['genre']);?>" class="genre"><?=$book['genre_title'];?></a>
		<?php $this->load->view('guests_interface/html/book-price');?>
	</div>
</div>
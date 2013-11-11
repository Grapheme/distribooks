<div class="shop-top">
	<div class="shop-img">
		<?php $this->load->view('guests_interface/html/book-properties');?>
		<div class="shop-img-cont"><img src="<?=baseURL($book['thumbnail']);?>"></div>
	</div>
	<div class="shop-about">
		<a href="<?=site_url($book['page_address'])?>" class="title"><?=$book[$this->uri->language_string.'_title'];?></a>
		<p class="author">
		<?php for($j=0;$j<count($book['authors']);$j++):?>
			<a href="<?=site_url('catalog?author='.$book['authors'][$j]['id'])?>"><?=$book['authors'][$j][$this->uri->language_string.'_name'];?></a><?php if(isset($book['authors'][$j+1])):?>,<br/> <?php endif;?>
		<?php endfor;?>
		</p>
		<div class="input select rating-f">
			<select class="example-f" name="rating">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
		</div>
		<a href="<?=site_url('catalog?genre='.$book['genre']);?>" class="genre"><?=$book['genre_title'];?></a>
		<?php $this->load->view('guests_interface/html/book-price');?>
	</div>
</div>
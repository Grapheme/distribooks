
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('guests_interface/includes/ie7');?>
		<?php $this->load->view('guests_interface/includes/header');?>
		<div class="dark-screen"></div>
		<div class="window-donation">
			<?php $this->load->view('guests_interface/forms/donation');?>
		</div>
		<?php $this->load->view('guests_interface/includes/recall-div');?>
		<?php $this->load->view('guests_interface/includes/sn-tooltips');?>
		<?php $this->load->view('guests_interface/includes/main-menu');?>
		<?php $this->load->view('guests_interface/includes/auth');?>
		<div class="clear"></div>
		<div class="container_5">
			<div class="grid_1 left-boxes shop">
				<?php $this->load->view('guests_interface/includes/left-nav');?>
				<?php $this->load->view('guests_interface/includes/gift-pad',array('style'=>' style="position: absolute; border: 1px solid #fff;"'));?>
			</div>
			<div class="grid_4 news-one">
				<div class="product-div">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi big" id="play"></a>
							<a href="#" class="shopi big" id="a"></a>
							<a href="#" class="shopi big" id="adult"><img src="<?=baseURL($age_limit['image']);?>"></a>
							<div class="shop-img-cont one"><img src="<?=baseURL($book['image']);?>"></div>
						</div>
						<div class="shop-about big">
							<p href="" class="title no-clickable"><?=$book[$this->uri->language_string.'_title'];?></p>
							<p class="author-big">
							<?php for($j=0;$j<count($book['authors']);$j++):?>
								<a href="<?=site_url('catalog?author='.$authors[$j]['id'])?>"><?=$authors[$j][$this->uri->language_string.'_name'];?></a><?php if(isset($book['authors'][$j+1])):?>, <?php endif;?>
							<?php endfor;?>
							</p>
							<div class="rating">
								<?=lang('book_ballot')?>
								<div>
									<img src="<?=baseURL('img/star.png');?>">
									<img src="<?=baseURL('img/star.png');?>">
									<img src="<?=baseURL('img/star.png');?>">
									<img src="<?=baseURL('img/star-none.png');?>">
									<img src="<?=baseURL('img/star-none.png');?>">
								</div>
							</div>
							<p class="price-big"><?=$book['price']?> <?=$currency[$book['currency']-1]['title'];?></p>
							<div class="buyor">
								<a href="#" class="buy"><?=lang('book_shop_buyor')?></a><p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
							</div>
							<div class="pos3-no">
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
							<div class="formats">
								<p class="formats-title"><?=lang('book_formats')?>:</p>
								<p class="format">Удобные:</p>
								<a class="format-link" href="#">fb2</a>, <a class="format-link" href="#">ePub</a>
								<p class="format">Для компьютера:</p>
								<a class="format-link" href="#">txt.zip</a>, <a class="format-link" href="#">rtf</a>, <a class="format-link" href="#">pdf A4</a>, <a class="format-link" href="#">html.zip</a>
								<p class="format">Для ридеров:</p>
								<a class="format-link" href="#">pdf A6</a>, <a class="format-link" href="#">mobi (Kindle)</a>
								<p class="format">Для телефона:</p>
								<a class="format-link" href="#">txt</a>, <a class="format-link" href="#">java</a>
								<p class="format">Другие:</p>
								<a class="format-link" href="#">lrf</a>, <a class="format-link" href="#">rb</a>, <a class="format-link" href="#">isilo3</a>, <a class="format-link" href="#">lit</a>, <a class="format-link" href="#">doc.prc</a>
							</div>
							</div>
						</div>
					</div>
				</div>
				<div class="pos3">
					<div class="about-product">
						<a class="share-product" href="#"><img src="<?=baseURL('img/big-like.png')?>"><span><?=lang('book_share')?></span></a>
						<p class="about-p"><?=lang('book_age_limit')?>: <span>16+</span></p>
						<p class="about-p"><?=lang('book_genre')?>: <a href="<?=site_url('catalog?genre='.$book['genre']);?>"><?=$book['genre_title'];?></a></p>
						<p class="about-p"><?=lang('book_tags')?>: <?php for($i=0;$i<count($keywords);$i++):?><a href="<?=site_url('catalog?keyword='.md5(trim($keywords[$i])))?>"><?=$keywords[$i];?></a><?php if(isset($keywords[$i+1])):?>,<?php endif;?><?php endfor;?></p>
						<p class="about-p"><?=lang('book_copyright')?>: <span><?=$book[$this->uri->language_string.'_copyright'];?></span></p>
						<p class="about-p"><?=lang('book_date_released')?>: <span><?=$book['date_released'];?></span></p>
						<p class="about-p"><?=lang('book_size')?>: <span><?=$book[$this->uri->language_string.'_size'];?></span></p>
						<p class="about-p"><?=lang('book_isbn')?>: <span><?=$book['isbn'];?></span></p>
					</div>
					<div class="formats">
						<p class="formats-title"><?=lang('book_formats')?>:</p>
						<p class="format">Удобные:</p>
						<a class="format-link" href="#">fb2, ePub</a>
						<p class="format">Для компьютера:</p>
						<a class="format-link" href="#">txt.zip, rtf, pdf A4, html.zip</a>
						<p class="format">Для ридеров:</p>
						<a class="format-link" href="#">pdf A6, mobi (Kindle)</a>
						<p class="format">Для телефона:</p>
						<a class="format-link" href="#">txt, java</a>
						<p class="format">Другие:</p>
						<a class="format-link" href="#">lrf, rb, isilo3, lit, doc.prc</a>
					</div>
				</div>
				<div class="product-desc">
					<?=$book[$this->uri->language_string.'_text']?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="min-nav pos3">
			<?php $this->load->view('guests_interface/includes/small-nav');?>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('guests_interface/html/yelow-block');?>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
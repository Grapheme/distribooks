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
				<div style="position: relative;">
					<?php $this->load->view('guests_interface/includes/gift-pad',array('style'=>' style="position: absolute !important;"'));?>
				</div>
			</div>
			<div class="grid_4 top-shop-div">
			<?php if(!empty($catalog)):?>
				<div class="grid_4 shop-new-div">
					<p class="top-shop-title"><?=lang('catalog_catalog')?>:</p>
				<?php if($this->input->get('directing') === FALSE || $this->input->get('directing') == 'desc'):?>
					<p class="shop-sort"><?=lang('book_sort_by')?>: <a href="<?=site_url('catalog?sort=price&directing=asc')?>" class="sort-link"><?=lang('book_sort_price')?></a> | <a href="<?=site_url('catalog?sort='.$this->uri->language_string.'_title&directing=asc')?>" class="sort-link"><?=lang('book_sort_title')?></a> | <a href="<?=site_url('catalog?sort=rating&directing=asc')?>" class="sort-link"><?=lang('book_sort_rating')?></a></p>
				<?php else:?>
					<p class="shop-sort"><?=lang('book_sort_by')?>: <a href="<?=site_url('catalog?sort=price&directing=desc')?>" class="sort-link"><?=lang('book_sort_price')?></a> | <a href="<?=site_url('catalog?sort='.$this->uri->language_string.'_title&directing=desc')?>" class="sort-link"><?=lang('book_sort_title')?></a> | <a href="<?=site_url('catalog?sort=rating&directing=desc')?>" class="sort-link"><?=lang('book_sort_rating')?></a></p>
				<?php endif;?>
				<?php for($i=0;$i<count($catalog);$i++):?>
					<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count($catalog)-1))?' omega':'';?>">
						<div class="shop-top">
							<div class="shop-img">
								<a href="#" class="shopi" id="play" src=""></a>
								<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
								<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
								<div class="shop-img-cont"><img src="<?=baseURL($catalog[$i]['thumbnail']);?>"></div>
							</div>
							<div class="shop-about">
								<a href="<?=site_url($catalog[$i]['page_address']);?>" class="title"><?=$catalog[$i][$this->uri->language_string.'_title'];?></a>
								<p class="author">
								<?php for($j=0;$j<count($catalog[$i]['authors']);$j++):?>
									<?=$catalog[$i]['authors'][$j][$this->uri->language_string.'_name'];?><?php if(isset($catalog[$i]['authors'][$j+1])):?>, <?php endif;?>
								<?php endfor;?>
								</p>
								<div class="rating-shop">
									<img src="<?=baseURL('img/star.png');?>">
									<img src="<?=baseURL('img/star.png');?>">
									<img src="<?=baseURL('img/star.png');?>">
									<img src="<?=baseURL('img/star-none.png');?>">
									<img src="<?=baseURL('img/star-none.png');?>">
								</div>
								<a href="#" class="genre"><?=$catalog[$i]['genre_title'];?></a>
								<p class="price"><?=$catalog[$i]['price']?> <?=$currency[$catalog[$i]['currency']-1]['title'];?></p>
							</div>
						</div>
						<div class="buyor">
							<a href="#" class="buy"><?=lang('book_shop_buyor')?></a><p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
						</div>
					</div>
				<?php if(($i+1)%3 == 0):?>
					<div class="clear"></div>
				<?php endif?>
				<?php endfor;?>
					<?=$pages;?>
				</div>
			<?php endif;?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="yellow blue">
			<div class="container_5">
				<div style="position: relative;"><img src="<?=baseURL('img/shadow-top.png');?>" class="shadow-top"></div>
				<div class="grid_1 gift shop">&nbsp;</div>
				<div class="grid_1 pos1">&nbsp;</div>
				<?php for($i=0;$i<count($trailers);$i++):?>
				<div class="grid_2 vidiv">
					<a href="#" class="vid-like"><img src="<?=baseURL('img/shop-like.png');?>"><?=lang('book_share')?></a>
					<a href="#" class="vid-name">Softman</a>
					<a href="#" class="vid-play"></a>
					<a href="#" class="vid" style="background-image: url('<?=baseURL('img/vid.png');?>');">
						<img class="adult" src="<?=baseURL('img/adult.png');?>">
					</a>
				</div>
				<?php endfor;?>
			</div>
		</div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
		<?php if(!empty($bestsellers)):?>
			<div class="grid_1">&nbsp;</div>
			<div class="grid_4 shop-new-div">
				<p class="top-shop-title"><?=lang('catalog_top_shop')?>:</p>
			<?php for($i=0;$i<count($bestsellers);$i++):?>
				<div class="top-shop">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a"></a>
							<a href="#" class="shopi" id="like" data-tooltip="2323"></a>
							<div class="shop-img-cont big"><img src="<?=baseURL($bestsellers[$i]['thumbnail']);?>"></div>
						</div>
						<div class="shop-about">
							<a href="<?=site_url($bestsellers[$i]['page_address'])?>" class="title"><?=$bestsellers[$i][$this->uri->language_string.'_title'];?></a>
							<p class="author">
							<?php for($j=0;$j<count($bestsellers[$i]['authors']);$j++):?>
								<?=$bestsellers[$i]['authors'][$j][$this->uri->language_string.'_name'];?><?php if(isset($bestsellers[$i]['authors'][$j+1])):?>, <?php endif;?>
							<?php endfor;?>
							</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre"><?=$bestsellers[$i]['genre_title'];?></a>
							<p class="price"><?=$bestsellers[$i]['price']?> <?=$currency[$bestsellers[$i]['currency']-1]['title'];?></p>
						</div>
					</div>
					<div class="buyor">
						<a href="#" class="buy"><?=lang('book_shop_buyor')?></a><p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
					</div>
					<div class="shop-desc">
						<?=$bestsellers[$i][$this->uri->language_string.'_anonce']?>
					</div>
				</div>
			<?php endfor;?>
			</div>
		<?php endif;?>
		<?php if(!empty($novelty)):?>
			<div class="grid_1">&nbsp;</div>
			<div class="grid_4 shop-new-div">
				<p class="top-shop-title"><?=lang('catalog_novelty')?>:</p>
			<?php for($i=0;$i<count($novelty);$i++):?>
				<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count($novelty)-1))?' omega':'';?>">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL($novelty[$i]['thumbnail']);?>"></div>
						</div>
						<div class="shop-about">
							<a href="<?=site_url($novelty[$i]['page_address'])?>" class="title"><?=$novelty[$i][$this->uri->language_string.'_title'];?></a>
							<p class="author">
							<?php for($j=0;$j<count($novelty[$i]['authors']);$j++):?>
								<?=$novelty[$i]['authors'][$j][$this->uri->language_string.'_name'];?><?php if(isset($novelty[$i]['authors'][$j+1])):?>, <?php endif;?>
							<?php endfor;?>
							</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre"><?=$novelty[$i]['genre_title'];?></a>
							<p class="price"><?=$novelty[$i]['price']?> <?=$currency[$novelty[$i]['currency']-1]['title'];?></p>
						</div>
					</div>
					<div class="buyor">
						<a href="#" class="buy"><?=lang('book_shop_buyor')?></a><p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
					</div>
				</div>
			<?php endfor;?>
				<div class="clear"></div>
			</div>
		<?php endif;?>
		<?php if(!empty($recommended)):?>
			<div class="grid_1">&nbsp;</div>
			<div class="grid_4 shop-new-div">
				<p class="top-shop-title"><?=lang('catalog_recommended')?>:</p>
			<?php for($i=0;$i<count($recommended);$i++):?>
				<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count($recommended)-1))?' omega':'';?>">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL($recommended[$i]['thumbnail']);?>"></div>
						</div>
						<div class="shop-about">
							<a href="<?=site_url($recommended[$i]['page_address'])?>" class="title"><?=$recommended[$i][$this->uri->language_string.'_title'];?></a>
							<p class="author">
							<?php for($j=0;$j<count($recommended[$i]['authors']);$j++):?>
								<?=$recommended[$i]['authors'][$j][$this->uri->language_string.'_name'];?><?php if(isset($recommended[$i]['authors'][$j+1])):?>, <?php endif;?>
							<?php endfor;?>
							</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre"><?=$recommended[$i]['genre_title'];?></a>
							<p class="price"><?=$recommended[$i]['price']?> <?=$currency[$recommended[$i]['currency']-1]['title'];?></p>
						</div>
					</div>
					<div class="buyor">
						<a href="#" class="buy"><?=lang('book_shop_buyor')?></a><p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
					</div>
				</div>
			<?php endfor;?>
				<div class="clear"></div>
			</div>
		<?php endif;?>
		
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('guests_interface/html/yelow-block');?>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
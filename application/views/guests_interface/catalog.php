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
				<p class="top-shop-title"><?=lang('catalog_top_shop')?>:</p>
			<?php for($i=0;$i<3;$i++):?>
				<div class="top-shop">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a"></a>
							<a href="#" class="shopi" id="like" data-tooltip="2323"></a>
							<div class="shop-img-cont big"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Show</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Comedy</a>
							<p class="price">780 RUB</p>
						</div>
					</div>
					<div class="buyor">
						<a href="#" class="buy"><?=lang('book_shop_buyor')?></a><p class="tocart"><span><?=lang('book_or')?></span><a href="#"><?=lang('book_shop_tocart')?></a></p>
					</div>
					<div class="shop-desc">
						Действие нового романа "Метро 2034" разворачивается во вселенной, описанной в первой части дилогии. 
						Весь мир разрушен ядерной войной. Остатки человечества коротают последние дни в бункерах и бомбоубежищах, 
						самое большое из которых - Московский Метрополитен... Все те, кто оказался в нем, когда на столицу падали 
						боеголовки ракет, спаслись.
					</div>
				</div>
			<?php endfor;?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="yellow blue">
			<div class="container_5">
				<div style="position: relative;"><img src="<?=baseURL('img/shadow-top.png');?>" class="shadow-top"></div>
				<div class="grid_1 gift shop">&nbsp;</div>
				<div class="grid_1 pos1">&nbsp;</div>
				<div class="grid_2 vidiv">
					<a href="#" class="vid-like"><img src="<?=baseURL('img/shop-like.png');?>"><?=lang('book_share')?></a>
					<a href="#" class="vid-name">Softman</a>
					<a href="#" class="vid-play"></a>
					<a href="#" class="vid" style="background-image: url('<?=baseURL('img/vid.png');?>');">
						<img class="adult" src="<?=baseURL('img/adult.png');?>">
					</a>
				</div>
				<div class="grid_2 vidiv">
					<a href="#" class="vid-like"><img src="<?=baseURL('img/shop-like.png');?>"><?=lang('book_share')?></a>
					<a href="#" class="vid-name">Softman</a>
					<a href="#" class="vid-play"></a>
					<a href="#" class="vid" style="background-image: url('<?=baseURL('img/vid.png');?>');">
						<img class="adult" src="<?=baseURL('img/adult.png');?>">
					</a>
				</div>
			</div>
		</div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
		<?php if(!empty($novelty)):?>
			<div class="grid_1">&nbsp;</div>
			<div class="grid_4 shop-new-div">
				<p class="top-shop-title"><?=lang('catalog_novelty')?>:</p>
			<?php for($i=0;$i<count($novelty);$i++):?>
				<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count()-1))?' omega':'';?>">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Birman</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Drama</a>
							<p class="price">450 RUB</p>
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
				<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count()-1))?' omega':'';?>">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Birman</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Drama</a>
							<p class="price">450 RUB</p>
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
		<?php if(!empty($catalog)):?>
			<div class="grid_1">&nbsp;</div>
			<div class="grid_4 shop-new-div">
				<p class="top-shop-title"><?=lang('catalog_catalog')?>:</p>
				<p class="shop-sort"><?=lang('book_sort_by')?>: <a href="#" class="sort-link"><?=lang('book_sort_price')?></a> | <a href="#" class="sort-link"><?=lang('book_sort_title')?></a> | <a href="#" class="sort-link"><?=lang('book_sort_rating')?></a></p>
			<?php for($i=0;$i<count($catalog);$i++):?>
				<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count()-1))?' omega':'';?>">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Birman</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Drama</a>
							<p class="price">450 RUB</p>
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
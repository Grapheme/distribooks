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
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
			<div class="grid_1 gift">
				<?php $this->load->view('guests_interface/includes/gift-pad');?>
			</div>
			<div class="grid_4 right-box">
				<div class="grid_4 alpha omega boxes" style="margin-left: -15px;">
					<?php $this->load->view('guests_interface/includes/big-nav');?>
				</div>
			<?php for($i=0;$i<count($novelty);$i++):?>
				<div class="grid_1 omega">
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
								<a href="<?=site_url('catalog?author='.$novelty[$i]['authors'][$j]['id'])?>"><?=$novelty[$i]['authors'][$j][$this->uri->language_string.'_name'];?></a><?php if(isset($novelty[$i]['authors'][$j+1])):?>, <?php endif;?>
							<?php endfor;?>
							</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="<?=site_url('catalog?genre='.$novelty[$i]['genre']);?>" class="genre"><?=$novelty[$i]['genre_title'];?></a>
							<p class="price old"><?=$novelty[$i]['price_action']?> <?=$currency[$novelty[$i]['currency']-1]['title'];?></p>
							<p class="price"><?=$novelty[$i]['price']?> <?=$currency[$novelty[$i]['currency']-1]['title'];?></p>
						</div>
					</div>
					<?php $this->load->view('guests_interface/html/buyor');?>
				</div>
			<?php endfor;?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="yellow">
			<div class="container_5">
			<?php if(!empty($news)):?>
				<div class="grid_1 news-div pos3-no">
					<div class="news-cont">
						<p class="title"><?=lang('news_block');?></p>
					<?php for($i=0;$i<count($news);$i++):?>
						<div class="news">
							<a href="<?=$news[$i]['page_address'];?>" class="news-title"><?=$news[$i][$this->uri->language_string.'_title'];?></a>
							<a href="" class="date no-clickable"><?=swapDotDateWithoutTime($news[$i]['date'])?></a>
							<p class="news-desc"><?=$news[$i][$this->uri->language_string.'_small_anonce'];?></p>
						</div>
					<?php endfor;?>
					</div>
				</div>
			<?php endif;?>
			<?php for($i=0;$i<2;$i++):?>
				<div class="grid_2 vidiv">
					<a href="#" class="vid-like"><img src="<?=baseURL('img/shop-like.png');?>"><?=lang('book_share');?></a>
					<a href="#" class="vid-name">Softman</a>
					<a href="#" class="vid-play"></a>
					<a href="#" class="vid" style="background-image: url('<?=baseURL('img/vid.png');?>');">
						<img class="adult" src="<?=baseURL('img/adult.png');?>">
					</a>
				</div>
			<?php endfor;?>
			</div>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
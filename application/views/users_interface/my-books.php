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
			</div>
			<div class="grid_4 top-shop-div">
		<?php if(!empty($books)):?>
			<?php for($i=0;$i<count($books);$i++):?>
				<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count($books)-1))?' omega':'';?>">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL($books[$i]['thumbnail']);?>"></div>
						</div>
						<div class="shop-about">
							<a href="<?=site_url($books[$i]['page_address']);?>" class="title"><?=$books[$i][$this->uri->language_string.'_title'];?></a>
							<p class="author">
							<?php for($j=0;$j<count($books[$i]['authors']);$j++):?>
								<a href="<?=site_url('catalog?author='.$books[$i]['authors'][$j]['id'])?>"><?=$books[$i]['authors'][$j][$this->uri->language_string.'_name'];?></a><?php if(isset($books[$i]['authors'][$j+1])):?>, <?php endif;?>
							<?php endfor;?>
							</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="<?=site_url('catalog?genre='.$books[$i]['genre']);?>" class="genre"><?=$books[$i]['genre_title'];?></a>
						</div>
					</div>
				</div>
				<?php if(($i+1)%3 == 0):?>
				<div class="clear"></div>
				<?php endif?>
			<?php endfor;?>
			<div class="clear"></div>
			<?=$pages;?>
		<?php endif;?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
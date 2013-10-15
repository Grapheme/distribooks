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
		<?php if(!empty($news['image'])):?>
			<div class="news-one-div">
				<img src="<?=baseURL($news['image']);?>">
			</div>
		<?php endif;?>
			<div class="news-text">
				<p class="news-date"><?=swapDotDateWithoutTime($news['date']);?></p>
				<p class="news-one-title"><?=$news[$this->uri->language_string.'_title'];?></p>
				<p><a class="share-product" href="#"><img src="<?=baseURL('img/big-like.png')?>"><span><?=lang('book_share')?></span></a></p>
				<p class="news-pre"><?=$news[$this->uri->language_string.'_anonce'];?></p>
				<?=$news[$this->uri->language_string.'_text'];?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('guests_interface/html/yelow-block');?>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
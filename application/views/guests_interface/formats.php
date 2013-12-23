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
					<div class="gift-pad"<?=(isset($style))?$style:'';?> style="position: absolute !important;">
						<img src="<?=baseURL('img/book.png');?>">
						<div>
							<h2><span><?=lang('gift_pad_h2')?></span></h2>
							<p><?=lang('gift_pad_text')?></p>
							<a href="<?=site_url('catalog');?>" class="button red"><?=lang('gift_pad_button')?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_4 news-one">
				<div style="margin-bottom: 25px;">
					<p class="title-1"><?=lang('formats_text');?></p>
				</div>
			<?php for($i=0;$i<count($formats);$i++):?>
				<?php if($i%2 == 0):?>
					<div class="clear"></div>
				<?php endif;?>
				<div class="format-div">
					<div><img src="<?=baseURL($formats[$i]['image']);?>"></div>
					<div>
						<p class="format-title"><?=$formats[$i]['title']?></p>
						<p class="format-text"><?=$formats[$i][$this->uri->language_string.'_description']?></p>
					</div>
				</div>
			<?php endfor; ?>
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
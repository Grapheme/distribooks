<?php
	$CI = & get_instance();
	$CI->load->helper('language');
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $CI->load->view('guests_interface/includes/head');?>
</head>
<body>
	<div class="wrapper">
		<?php $CI->load->view('guests_interface/includes/ie7');?>
		<?php $CI->load->view('guests_interface/includes/header');?>
		<div class="dark-screen"></div>
		<div class="window-donation">
			<?php $CI->load->view('guests_interface/forms/donation');?>
		</div>
		<?php $CI->load->view('guests_interface/includes/recall-div');?>
		<?php $CI->load->view('guests_interface/includes/sn-tooltips');?>
		<?php $CI->load->view('guests_interface/includes/main-menu');?>
		<?php $CI->load->view('guests_interface/includes/auth');?>
		<div class="clear"></div>
		<div class="container_5">
			<div class="grid_1 left-boxes shop">
				<?php $CI->load->view('guests_interface/includes/left-nav');?>
				<div style="position: relative;">
					<div class="gift-pad" style="margin-bottom: 25px;">
						<img src="<?=baseURL('img/book.png');?>">
						<div>
							<h2><span>Book is the best gift</span></h2>
							<p>Present book comfortably through our website</p>
							<a href="#" class="button red">Present</a>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_4 news-one">
				<div class="not-found">
					<p class="not-found-title" id="menu"><?=lang('404_menu')?>:</p>
					<div class="not-found-nav" id="menu-nav">
						<nav>
							<ul>
								<li><a href="<?=site_url('catalog');?>"><?=lang('top_menu_catalog');?></a></li>
								<li><a href="<?=site_url('about');?>"><?=lang('top_menu_about');?></a></li>
							</ul>
						</nav>
					</div>
					<p class="not-found-title" id="usl"><?=lang('404_services')?>:</p>
					<div class="not-found-nav" id="usl-nav">
						<nav>
							<ul>
								<li><a href="<?=site_url('editing');?>"><?=lang('menu_editing');?></a></li>
								<li><a href="<?=site_url('typography');?>"><?=lang('menu_typography');?></a></li>
								<li><a href="<?=site_url('translation');?>"><?=lang('menu_translation');?></a></li>
								<li><a href="<?=site_url('distribution');?>"><?=lang('menu_distribution');?></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $CI->load->view('guests_interface/includes/small-nav');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php $CI->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $CI->load->view('guests_interface/includes/scripts');?>
</body>
</html>
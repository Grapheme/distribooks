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
		<?php $this->load->view('guests_interface/forms/request-order-distribution');?>
		<?php $this->load->view('guests_interface/forms/request-do-distribution');?>
		<div class="clear"></div>
		<div class="container_5">
			<div class="clear"></div>
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
				<?php $this->load->view('guests_interface/includes/gift-pad');?>
			</div>
		</div>
		<div class="container_5">
			<div class="grid_1 left-boxes">
				<?php $this->load->view('guests_interface/includes/left-nav');?>
				<?php $this->load->view('guests_interface/includes/gift-pad');?>
			</div>
			</div>
			<div class="dist-div">
				<div class="container_5">
					<div class="grid_1 pos3-no">&nbsp;</div>
					<div class="grid_2 information">
						<div>
							<img class="inf-img" src="<?=baseURL('img/dist-left.png')?>" style="margin-bottom: 54px;">
							<a href="#" class="apply-button apply-order-distribution no-clickable"><?=lang('service_send_enquiry');?></a>
						</div>
						<div>
							<p class="title"><span><?=lang('service_order_distribution');?></span></p>
							<div class="like"><a href="#"><img src="<?=baseURL('img/like.png')?>"></a><p><?=lang('service_for_author');?></p></div>
						</div>
						<p class="desc"><?=lang('service_order_distribution_text');?></p>
					</div>
					<div class="grid_2 information">
						<div>
							<img class="inf-img" src="<?=baseURL('img/dist-right.png')?>" style="margin-bottom: 20px;">
							<a href="#" class="apply-button apply-do-distribution no-clickable"><?=lang('service_send_enquiry');?></a>
						</div>
						<div>
							<p class="title"><span><?=lang('service_begin_distribution');?></span></p>
							<div class="like"><a href="#"><img src="<?=baseURL('img/like.png')?>"></a><p><?=lang('service_for_author');?></p></div>
						</div>
						<p class="desc"><?=lang('service_begin_distribution_text');?></p>
					</div>
				</div>		
			</div>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
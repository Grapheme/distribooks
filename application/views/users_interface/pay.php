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
			<div class="grid_4 cart-page">
				<img src="<?=baseURL('img/payu.jpg');?>" style="margin: 0 auto; display: block; width: 200px;">
				<p class="payment-p"><?=lang('pay-title');?></p>
				<p class="payment-p"><?=lang('pay-desc');?> <a href="payu.ru">PayU</a></p>
				<p class="payment-p"><?=lang('pay-choose');?>:</p>
				<p class="payu-payment">
					<a href="#"><img src="<?=baseURL('img/pay/mts.jpg');?>"></a>
					<a href="#"><img src="<?=baseURL('img/pay/megafon.png');?>"></a>
					<a href="#"><img src="<?=baseURL('img/pay/beeline.png');?>"></a>
					<a href="#"><img src="<?=baseURL('img/pay/mastercard.png');?>"></a>
					<a href="#"><img src="<?=baseURL('img/pay/visa.png');?>"></a>
					<a href="#"><img src="<?=baseURL('img/pay/alphabank.png');?>"></a>
					<a href="#"><img src="<?=baseURL('img/pay/qiwi.png');?>"></a>
					<a href="#"><img src="<?=baseURL('img/pay/mail.png');?>"></a>
				</p>
				<p class="payment-p"><?=lang('pay-type');?></p>	
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
	
	<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.barrating.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/barrating-config.js')?>"></script>
</body>
</html>
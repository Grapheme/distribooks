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
				<p class="top-shop-title"><?=lang('pay-choose');?>:</p>
				<div class="payment-s-div">
					<!--<a href="" data-pay-method="MTS" class="no-clickable">
						<img src="<?=baseURL('img/pay/mts.jpg');?>">
					</a>
					<a href="" data-pay-method="MEGAFON" class="set-pay-method no-clickable">
						<img src="<?=baseURL('img/pay/megafon.png');?>">
					</a>
					<a href="" data-pay-method="BEELINE" class="set-pay-method no-clickable">
						<img src="<?=baseURL('img/pay/beeline.png');?>">
					</a>-->
					<div class="payment-div">
						<?php $this->load->view("users_interface/forms/pay-pal");?>
					</div>
					
					<script src="https://www.paypalobjects.com/js/external/dg.js" type="text/javascript"></script>
					<script>
						var dg = new PAYPAL.apps.DGFlow({trigger: 'paypal_submit',expType: 'instant'});
					</script>
					<div class="payment-div">
						<a href="" data-pay-method="CCVISAMC" class="set-pay-method no-clickable">
							<img src="<?=baseURL('img/pay/mastercard.png');?>"><br>
							<span>Master Card</span>
						</a>
					</div>
					<div class="payment-div">
						<a href="" data-pay-method="CCVISAMC" class="set-pay-method no-clickable">
							<img src="<?=baseURL('img/pay/visa.png');?>"><br>
							<span>VISA</span>
						</a>
					</div>
					<div class="payment-div">
						<a href="" data-pay-method="ALFACLICK" class="set-pay-method no-clickable">
							<img src="<?=baseURL('img/pay/alfabank.png');?>"><br>
							<span><?=lang('alpha_click')?></span>
						</a>
					</div>
					<div class="payment-div">
						<a href="" data-pay-method="QIWI"  class="set-pay-method no-clickable">
							<img src="<?=baseURL('img/pay/qiwi.png');?>"><br>
							<span>Qiwi</span>
						</a>
					</div>
					<div class="payment-div">
						<a href="" data-pay-method="MAILRU" class="set-pay-method no-clickable">
							<img src="<?=baseURL('img/pay/mailru.png');?>"><br>
							<span>Mail.Ru</span>
						</a>
					</div>
				</div>
				<div class="payment-desc"><?=$text_blocks['content'];?></div>
				<div class="payment-sec"><img src="<?=baseURL('img/pay/visa-sec.gif');?>"></div>
				<div class="payment-sec"><img src="<?=baseURL('img/pay/mc-sec.gif');?>"></div>
				<!--<p class="payment-p"><?=lang('pay-type');?></p>-->
				<?php $this->load->view("users_interface/forms/pay-u");?>
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
	<script type="text/javascript" src="<?=baseURL('js/cabinet/user.js')?>"></script>
	<?php $this->load->view('guests_interface/includes/metrika');?>
</body>
</html>
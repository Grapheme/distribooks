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
				<p>Онлайн оплата</p>
				<p>Оплата заказа через интернет осуществляется через международный процессинговый центр <a href="payu.ru">PayU</a></p>
				<p>Выберите способ оплаты</p>
				<p>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
					<a href="#"><img src="<?=baseURL('img/');?>"></a>
				</p>
				<p>Введите соответствующие данные в форму</p>	
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
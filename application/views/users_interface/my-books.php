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
		<?php 
			$notificationText = '';
			if($this->input->get('err') !== FALSE):
				$notificationText = 'Возникла ошибка при оплате. Попробуйте снова!.<br/>Если ошибка повториться обратитесь за помощью к администрации сайта';
			elseif($this->input->get('result') !== FALSE):
				switch($this->input->get('result')):
					case 0: $notificationText = 'Оплата прошла успешно';
						break;
					case 1: $notificationText = 'Оплата невыполнена';
						break;
					case -1: $notificationText = 'Счет на оплату успешно выставлен покупателю в его QIWI кошелек, но еще не оплачен';
						break;
					default:
						break;
				endswitch;
			endif;?>
		<?php if(!empty($notificationText)):?>
			<div class="pay-messages"><?=$notificationText;?></div>
		<?php endif;?>
		<?php if(empty($this->profile['email']) && $this->input->cookie('reques_email') === FALSE):?>
			<?php $this->load->view('users_interface/includes/request-email');?>
		<?php endif;?>
		<?php if(!empty($books)):?>
			<?php for($i=0;$i<count($books);$i++):?>
				<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count($books)-1))?' omega':'';?>">
					<?php $this->load->view('guests_interface/html/book-in-shop',array('book'=>$books[$i],'currency'=>array()));?>
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
	
	<script type="text/javascript" src="<?=baseURL('js/cabinet/user.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.barrating.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/barrating-config.js')?>"></script>
</body>
</html>
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
			elseif($this->input->get('gift') !== FALSE && ($this->input->get('result') == 0 || $this->input->get('result') == 2)):
				$notificationText = lang('payu_succesfull_gift');
			elseif($this->input->get('result') !== FALSE):
				switch($this->input->get('result')):
					case 0: $notificationText = lang('payu_succesfull');
							if($order_status == 0):
								$notificationText.= ' '.lang('pay_wait_books');
							else:
								$notificationText.= ' '.lang('pay_insert_books');
							endif;
						break;
					case 1: $notificationText = lang('payu_failure');
						break;
					case -1: $notificationText = lang('payu_succesfull_qiwi');
						break;
					default:
						break;
				endswitch;
			endif;?>
		<?php if(!empty($notificationText)):?>
			<div class="pay-messages">
				<?=$notificationText;?>
			</div>
		<?php endif;?>
				<div id="book-list">
			<?php if(!empty($books)):?>
					<?php $this->load->view('html/print-books-list',array('books'=>$books));?>
				<div class="clear"></div>
				<?=$pages;?>
			<?php elseif(empty($notificationText)):?>
				<?=lang('cabinel_empty_books');?>
			<?php endif;?>
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
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
<?php if((int)$reques_email === 0 && $this->input->get('gift') === FALSE):?>
	<?php $this->load->view('users_interface/includes/request-email');?>
	<script type="text/javascript">
		$(".dark-screen").fadeIn("fast");
	</script>
<?php endif;?>
<?php if(!is_null($order_pay_status) && $order_status == 0 && $this->input->get('result') !== FALSE && $this->input->get('gift') === FALSE):?>
	<script type="text/javascript" src="<?=baseURL('js/libs/history.js');?>"></script>
	<script type="text/javascript">
		var requestIntervalID = {};
		function clearGetURL(){
			return mt.currentURL.replace(/\?result=\d&status=ok/,'');
		}
		function requestPayStatus(){
			$.ajax({
				url: mt.getLangBaseURL('request-pay-status'),type: 'POST',dataType: 'json',
				beforeSend: function(){},
				success: function(response,textStatus,xhr){
					if(response.status){
						$(".pay-messages").remove();
						$("#book-list").html(response.responseText);
						clearInterval(requestIntervalID);
						History.navigateToPath(clearGetURL());
					}
				},
				error: function(xhr,textStatus,errorThrown){}
			});
		}
		$(function(){
			requestIntervalID = window.setInterval(requestPayStatus,10000);
		})
	</script>
<?php endif;?>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/user.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.barrating.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/barrating-config.js')?>"></script>
	<?php $this->load->view('guests_interface/includes/metrika');?>
</body>
</html>
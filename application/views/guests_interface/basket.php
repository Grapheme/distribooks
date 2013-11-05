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
				<div class="gift-pad sale10" style="margin-bottom: 25px;">
					<img src="<?=baseURL('img/sale10.png');?>" class="sale10-img">
					<h2><span>Расскажи про книгу и получи скидку</span></h2>
					<img src="<?=baseURL('img/sale10-bottom.png');?>" class="sale10-bottom-img">
				</div>
			</div>
			<div class="grid_4 cart-page">
				<div class="basket-min">
					<p class="basket-title"><?=lang('basket_title');?></p>
					<div class="basket-items-full-list">
						<?php $this->load->view('guests_interface/html/basket/basket-full-lists',array('basket_list'=>$basket_list));?>
					</div>
					<div class="basket-item" style="background: #fff; margin-top: 10px; margin-bottom: 25px;">
						<div>
							<p class="basket-item-name all" style="width: 210px;; color: #000; margin-left: 15px;">Всего выбрано <?=count($basket_list);?> книг на сумму</p>
							<p class="basket-price" style="border: 0;"><?=$this->account_basket['basket_total_price'];?></p>
							<div class="basket-one-buy">
								<a href="" class="buy buy-all no-clickable basket-buy-link" style="margin-right: 5px; width: 180px"><?=lang('basket_buy_all');?></a>
							</div>
						</div>
					</div>
					<div class="basket-bottom-sale-top"></div>
					<div class="basket-bottom-sale">
						<p class="basket-bottom-sale-text">
							Выбери книг на сумму <span>3000 р.</span> и получи скидку <span>10%</span> на всю сумму
						</p>
					</div>
					<div class="basket-bottom-sale-bottom"></div>
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
</body>
</html>
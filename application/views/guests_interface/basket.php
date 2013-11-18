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
			<?php if(!empty($basket_list)):?>
				<div class="basket-min">
					<p class="basket-title"><?=lang('basket_title');?></p>
					<div class="basket-items-full-list">
						<?php $this->load->view('guests_interface/html/basket/basket-full-lists',array('basket_list'=>$basket_list));?>
					</div>
					<div class="basket-item" style="background: #fff; margin-top: 10px; margin-bottom: 25px;">
					<?php 
						$total_summa = (int)$this->account_basket['basket_total_price'];
						if($this->account_basket['basket_total_price'] >= $this->project_config['action_price']):
							$total_summa = $total_summa - round($total_summa*($this->project_config['action_percent']/100),2);
						endif;
					?>
						<div>
							<p class="basket-price basket-main-total-price" style="border: 0;"><?=addCurrencyInPrice(number_format($total_summa,2,'.',''));?></p>
							<p class="basket-item-name all" style="width: 210px;; color: #000; margin-left: 15px; float:right;"><?=lang('basket_page_part4');?> <?=count($basket_list);?> <?=lang('basket_page_part5');?></p>
							<div class="basket-one-buy">
								<a href="" class="buy buy-all no-clickable <?=(isUserLoggined() === FALSE)?'sign-in-link':'basket-buy-link';?>" style="margin-right: 5px; width: 180px"><?=lang('basket_buy_all');?></a>
							</div>
						</div>
					</div>
					<?php if($this->project_config['action_price'] > 0):?>
						<div class="summa-action-block<?=($this->account_basket['basket_total_price'] < $this->project_config['action_price'])?' hidden':'';?>">
							<?=lang('top_menu_promotion');?> -<?=$this->project_config['action_percent']?>%
						</div>
					<?php endif;?>
			<?php if($this->project_config['action_price'] > 0):?>
				<div class="summa-action-block-info<?=($this->account_basket['basket_total_price'] > $this->project_config['action_price'])?' hidden':'';?>">
					<div class="basket-bottom-sale-top"></div>
					<div class="basket-bottom-sale">
						<p class="basket-bottom-sale-text">
							<?=lang('basket_page_part1');?> <span><?=getPriceInCurrency($this->project_config['action_price']);?></span> <?=lang('basket_page_part2');?> <span><?=$this->project_config['action_percent']?>%</span> <?=lang('basket_page_part3');?>
						</p>
					</div>
					<div class="basket-bottom-sale-bottom"></div>
				</div>
			<?php endif;?>
				</div>
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
</body>
</html>
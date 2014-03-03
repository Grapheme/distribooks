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
			<div class="grid_4 top-shop-div cart-page">
	<?php if(isUserLoggined()):
			$notificationText = '';
			if($this->input->get('err') !== FALSE):
				$notificationText = 'Возникла ошибка при оплате. Попробуйте снова.<br/>Если ошибка повториться обратитесь за помощью к администрации сайта';
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
			endif;
			if(!empty($notificationText)):?>
			<div class="pay-messages"><?=$notificationText;?></div>
		<?php endif;
		endif;?>
			<?php if(!empty($basket_list)):?>
				<div class="basket-min">
					<p class="basket-title"><?=lang('basket_title');?></p>
					<div class="basket-items-full-list">
						<?php $this->load->view('guests_interface/html/basket/basket-full-lists',array('basket_list'=>$basket_list));?>
					</div>
					<div class="basket-item" style="background: #fff; margin-top: 10px; margin-bottom: 25px;">
					<?php 
						$total_summa = $basket_total_price;
						$action_price = CurrencyExchangeUStoRUS($this->project_config['action_price']);
						//$total_summa = (float)$this->account_basket['basket_total_price'];
						if($basket_total_price >= $action_price):
							$total_summa = $total_summa - round($total_summa*($this->project_config['action_percent']/100),2,PHP_ROUND_HALF_EVEN);
						endif;
					?>
						<div>
							<p class="basket-price basket-main-total-price" style="border: 0;">
							<?php if($this->uri->language_string == RUSLAN):?>
								<?=addCurrencyInPrice($total_summa);?>
							<?php else:?>
								<?=addCurrencyInPrice(number_format($total_summa,2,'.',''));?>
							<?php endif;?>
							</p>
							<p class="basket-item-name all" style="width: 210px;; color: #000; margin-left: 15px; float:right;"><?=lang('basket_page_part4');?> &mdash; <span id="count-book"><?=count($basket_list).' '.$this->plural_words->pluralBook(count($basket_list),$this->uri->language_string);?></span> <?=lang('basket_page_part5');?></p>
							<div class="basket-one-buy">
								<a style="left: 0;" class="buy buy-all gifts-link no-clickable" href="#"><?=lang('books_shop_gift');?></a>
								<a href="<?=(isUserLoggined())?site_url('pay'):'';?>" class="buy buy-all <?=(isUserLoggined() === FALSE)?'sign-in-link no-clickable':'';?>" style="margin-right: 5px; width: 180px"><?=lang('basket_buy_all');?></a>
							</div>
						<?php if(!isAdminLoggined()):?>
							<div class="clear"></div>
							<!-- <div class="buy-as-gift">
								
							</div> -->
						<?php endif;?>
						</div>
					</div>
					<?php if($action_price > 0):?>
						<div class="summa-action-block<?=($basket_total_price < $action_price)?' hidden':'';?>">
							<div class="basket-bottom-sale-top"></div>
							<div class="basket-bottom-sale">
								<p class="basket-bottom-sale-text">
									<?=lang('top_menu_promotion');?> <span>-<?=$this->project_config['action_percent']?>%</span>
								</p>
							</div>
							<div class="basket-bottom-sale-bottom"></div>
						</div>
					<?php endif;?>
			<?php if($action_price > 0):?>
				<div class="summa-action-block-info<?=($basket_total_price > $action_price)?' hidden':'';?>">
					<div class="basket-bottom-sale-top"></div>
					<div class="basket-bottom-sale">
						<p class="basket-bottom-sale-text">
							<?=lang('basket_page_part1');?> <span><?=getPriceInCurrency($action_price);?></span> <?=lang('basket_page_part2');?> <span><?=$this->project_config['action_percent']?>%</span> <?=lang('basket_page_part3');?>
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
		<?php $this->load->view('guests_interface/includes/modal-message');?>
		<?php $this->load->view('guests_interface/includes/modal-gift');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<?php $this->load->view('guests_interface/includes/metrika');?>
</body>
</html>
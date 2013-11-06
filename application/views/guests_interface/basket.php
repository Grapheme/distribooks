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
					<p class="basket-title incart">Каждая четвертая книга в подарок!</p>
					<div class="clear"></div>
					<div class="basket-item">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/book-sh.png');?>">
						</div>
						<p class="basket-item-name">
							<span>Назавние</span>
							<a href="#">Автор Автор</a>
						</p>
						<p class="basket-price pos3-no"><a href="#" class="date">4 июня 2013</a></p>
						<p class="basket-price">200 р.</p>
						<div class="basket-one-buy">
							<div class="basket-select">
								<select name="FormatSelect" class="format-select">
									<option value="0">Выбрать формат</option>
									<option value="1"> </option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-item">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/book-sh.png');?>">
						</div>
						<p class="basket-item-name">
							<span>Назавние Назавние На Назавние Назав Назавние Назавзавние Назазав</span>
							<a href="#">Автор Автор</a>
						</p>
						<p class="basket-price pos3-no"><a href="#" class="date">4 июня 2013</a></p>
						<p class="basket-price">200 р.</p>
						<div class="basket-one-buy">
							<div class="basket-select">
								<select name="FormatSelect" class="format-select">
									<option value="0">Выбрать формат</option>
									<option value="1"> </option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-item">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/book-sh.png');?>">
						</div>
						<p class="basket-item-name">
							<span>Назавние Назавние На Назавние Назав Назавние Назавзавние Назазав</span>
							<a href="#">Автор Автор</a>
						</p>
						<p class="basket-price pos3-no"><a href="#" class="date">4 июня 2013</a></p>
						<p class="basket-price">200 р.</p>
						<div class="basket-one-buy">
							<div class="basket-select">
								<select name="FormatSelect" class="format-select">
									<option value="0">Выбрать формат</option>
									<option value="1"> </option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-item basket-sale">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/book-sh.png');?>">
						</div>
						<p class="basket-item-name">
							<span>Назавние Назавние На Назавние Назав Назавние Назавзавние Назазав</span>
							<a href="#">Автор Автор</a>
						</p>
						<p class="basket-gift-text">Каждая четвертая книга в подарок</p>
						<div class="basket-one-buy" style="margin-left: 13px;">
							<div class="basket-select">
								<select>
									<option value="1">Выбрать формат</option>
									<option value="2">Формат2</option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-sale-bottom"></div>
					<div class="basket-item">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/book-sh.png');?>">
						</div>
						<p class="basket-item-name">
							<span>Назавние Назавние На Назавние Назав Назавние Назавзавние Назазав</span>
							<a href="#">Автор Автор</a>
						</p>
						<p class="basket-price pos3-no"><a href="#" class="date">4 июня 2013</a></p>
						<p class="basket-price">200 р.</p>
						<div class="basket-one-buy">
							<div class="basket-select">
								<select name="FormatSelect" class="format-select error">
									<option value="0">Выбрать формат</option>
									<option value="1"> </option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-item">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/book-sh.png');?>">
						</div>
						<p class="basket-item-name">
							<span>Назавние Назавние На Назавние Назав Назавние Назавзавние Назазав</span>
							<a href="#">Автор Автор</a>
						</p>
						<p class="basket-price pos3-no"><a href="#" class="date">4 июня 2013</a></p>
						<p class="basket-price">200 р.</p>
						<div class="basket-one-buy">
							<div class="basket-select">
								<select name="FormatSelect" class="format-select">
									<option value="0">Выбрать формат</option>
									<option value="1"> </option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-item">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/book-sh.png');?>">
						</div>
						<p class="basket-item-name"><span>Назавние Назавние На Назавние Назав Назавние Назавзавние Назазав</span>
							<a href="#">Автор Автор</a>
						</p>
						<p class="basket-price pos3-no"><a href="#" class="date">4 июня 2013</a></p>
						<p class="basket-price">200 р.</p>
						<div class="basket-one-buy">
							<div class="basket-select">
								<select name="FormatSelect" class="format-select">
									<option value="0">Выбрать формат</option>
									<option value="1"> </option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-item basket-sale">
						<a class="basket-rm" href="#"></a>
						<div class="basket-img">
							<img src="<?=baseURL('img/cart-gift.png');?>" class="cart-gift">
						</div>
						<p class="basket-item-name">
							<span style="overflow: visible; white-space: normal;">Выберите любую книгу в подарок</span>
						</p>
						<p class="basket-gift-text">Каждая четвертая книга в подарок</p>
						<div class="basket-one-buy" style="margin-left: 13px;">
							<a href="#" class="button red buy" style="padding: 0;">Выбрать</a>
							<div class="basket-select">
								<select>
									<option value="1">Формат</option>
									<option value="2">Формат2</option>
								</select>
							</div>
						</div>
					</div>
					<div class="basket-sale-bottom"></div>
					<!--<div class="basket-line"></div>-->
					<div class="basket-item" style="background: #fff; margin-top: 10px; margin-bottom: 25px;">
						<div>
							<div class="basket-one-buy">
								<a href="#" class="buy buy-all" style="margin-right: 5px; width: 180px">Buy all</a>
							</div>
							<p class="basket-item-name all" style="width: 210px;; color: #000; margin-left: 15px;">Всего выбрано 5 книг на сумму</p>
							<p class="basket-price" style="border: 0;">2000 р.</p>
							<div class="cart-check-div">
								<input id="cart" type="checkbox" class="cart-check" checked="checked">
								<label for="cart"><p class="cart-label-text">Использовать скидку</p></label>
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
<div class="basket-min-div">
	<a href="#" class="basket-close"></a>
	<img src="<?=baseURL('img/basket-arrow.png');?>" class="basket-arrow">
	<div class="basket-min">
		<p class="basket-title"><?=lang('basket_title');?></p>
		<div class="basket-item">
			<a class="basket-rm" href="#"></a>
			<div class="basket-img"><img src="<?=baseURL('img/book-big.png');?>"></div>
			<p class="basket-item-name">Назавние Назавние Назавние Назавние</p>
			<p class="basket-price">200 р.</p>
			<div class="basket-one-buy">
				<a href="#" class="buy"><?=lang('basket_buy');?></a>
				<div class="basket-select">
					<select name="FormatSelect" class="format-select">
						<option selected="selected" value=""><?=lang('basket_format');?></option>
					</select>
				</div>
			</div>
		</div>
		<div class="basket-item">
			<a class="basket-rm" href="#"></a>
			<div class="basket-img"><img src="<?=baseURL('img/book-big.png');?>"></div>
			<p class="basket-item-name">Назавние Назавние Назавние Назавние</p>
			<p class="basket-price">200 р.</p>
			<div class="basket-one-buy">
				<a href="#" class="buy"><?=lang('basket_buy');?></a>
				<div class="basket-select">
					<select>
						<option selected="selected" value=""><?=lang('basket_format');?></option>
					</select>
				</div>
			</div>
		</div>
		<div class="basket-item">
			<a class="basket-rm" href="#"></a>
			<div class="basket-img"><img src="<?=baseURL('img/book-big.png');?>"></div>
			<p class="basket-item-name">Назавние Назавние Назавние Назавние</p>
			<p class="basket-price">200 р.</p>
			<div class="basket-one-buy">
				<a href="#" class="buy"><?=lang('basket_buy');?></a>
				<div class="basket-select">
					<select>
						<option value="1"> </option>
						<option value="2"> </option>
					</select>
				</div>
			</div>
		</div>
		<div class="basket-item basket-sale">
			<a class="basket-rm" href="#"></a>
			<div class="basket-img"><img src="<?=baseURL('img/book-big.png');?>"></div>
			<p class="basket-item-name">Назавние Назавние Назавние Назавние</p>
			<p class="basket-price"></p>
			<div class="basket-one-buy">
				<div class="basket-select" style="margin-left: 2px;">
					<select>
						<option value="1"> </option>
						<option value="2"> </option>
					</select>
				</div>
			</div>
		</div>
		<div class="basket-sale-bottom"></div>
		<div class="basket-item basket-sale">
			<a class="basket-rm" href="#"></a>
			<div class="basket-img"><img src="<?=baseURL('img/cart-gift.png');?>" class="cart-gift"></div>
			<p class="basket-item-name">Назавние Назавние Назавние Назавние</p>
			<p class="basket-price"><a href="#" class="button red">Выбрать</a></p>
			<div class="basket-one-buy">
				<a href="#" class="buy"><?=lang('basket_buy');?></a>
				<div class="basket-select">
					<select>
						<option value="1"> </option>
						<option value="2"> </option>
					</select>
				</div>
			</div>
		</div>
		<div class="basket-sale-bottom"></div>
		<div class="basket-line"></div>
		<div class="basket-item">
		<div style="float: right;">
			<p class="basket-item-name all"><?=lang('basket_total');?>:</p>
			<p class="basket-price" style="border: 0;">2000 р.</p>
			<div class="basket-one-buy">
				<a href="cart.html" class="buy buy-all"><?=lang('basket_buy_all');?></a>
			</div>
		</div>
		</div>
	</div>
</div>
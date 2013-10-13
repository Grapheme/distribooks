<form action="">
	<a href="#" class="donate-close"></a>
	<div class="donate-top">
		<img class="donate-top-img" src="<?=baseURL('img/big-coins.png');?>">
		<div class="donate-text"><?=lang('form_donation_thank_you')?></div>
	</div>
	<div class="donate-div">
		<div class="how-much" id="f">
			<img src="<?=baseURL('img/coins-1.png');?>">
			<p>100 р.</p>
			<div>
				<input type="radio" name="howmuch" value="100" id="100" class="howmuch">
				<label for="100"></label>
			</div>
		</div>
		<div class="how-much" id="s">
			<img src="<?=baseURL('img/coins-2.png');?>">
			<p>1000 р.</p>
			<div>
				<input type="radio" name="howmuch" value="1000" id="1000" class="howmuch">
				<label for="1000"></label>
			</div>
		</div>
		<div class="how-much" id="t">
			<img src="<?=baseURL('img/coins-3.png');?>">
			<p>10 000 р.</p>
			<div>
				<input type="radio" name="howmuch" value="10000" id="10000" class="howmuch">
				<label for="10000"></label>
			</div>
		</div>
		<div class="how-much" id="l">
			<img src="<?=baseURL('img/coins-4.png');?>">
			<p>100 000 р.</p>
			<div>
				<input type="radio" name="howmuch" value="100000" id="100000" class="howmuch">
				<label for="100000"></label>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="donate-another-div">
		<input class="donate-another" type="text" placeholder="<?=lang('form_donation_summs')?>">
		<p class="donate-another-text"><?=lang('form_donate_another_text')?>:</p>
	</div>
	<div class="donate-links">
		<a href="#" class="donate-link" id="wm"></a>
		<a href="#" class="donate-link" id="visa"></a>
		<a href="#" class="donate-link" id="mc"></a>
	</div>
</form>
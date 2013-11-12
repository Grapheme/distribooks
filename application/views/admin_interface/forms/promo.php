<form action="<?=site_url(ADMIN_START_PAGE.'/promo-save');?>" method="POST" class="form-profile">
	<div class="control-group">
		<label>Курс доллара:</label>
		<input type="text" class="valid-required" name="dollar_rate" value="<?=$config['dollar_rate']?>"><br/>
		<label>Номер бесплатной книги:</label>
		<input type="text" class="valid-required" name="free_book" readonly="readonly" value="<?=$config['free_book']?>"><br/>
		<label>Количество бесплатных книг:</label>
		<input type="text" class="valid-required" name="count_free_book" readonly="readonly" value="<?=$config['count_free_book']?>"><br/>
		<label>Сумма для скидки:</label>
		<input type="text" class="valid-required" name="action_price" value="<?=$config['action_price'];?>"><br/>
		<label>Процент скидки:</label>
		<input type="text" class="valid-required" name="action_percent" value="<?=$config['action_percent'];?>"><br/>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit btn-success no-clickable btn-loading">Сохранить</button>
	</div>
</form>
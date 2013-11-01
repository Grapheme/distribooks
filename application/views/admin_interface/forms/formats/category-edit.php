<?=form_open(ADMIN_START_PAGE.'/formats/category/update',array('class'=>'form-manage-formats','method'=>'POST')); ?>
	<input type="hidden" name="id" value="<?=$this->input->get('id')?>" />
	<div class="control-group">
		<label>Название</label>
		<input type="text" name="ru_title" class="span3 valid-required" value="<?=$category['ru_title'];?>" placeholder="Название" />
		<label>Title</label>
		<input type="text" name="en_title" class="span3 valid-required" value="<?=$category['en_title'];?>" placeholder="Title" />
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="<?=$category['sort'];?>" placeholder="№" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?= form_close(); ?>
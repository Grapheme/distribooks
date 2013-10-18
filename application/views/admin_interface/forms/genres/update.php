<?=form_open(ADMIN_START_PAGE.'/genres/update',array('class'=>'form-manage-genres')); ?>
	<input type="hidden" name="id" value="<?=$this->input->get('id');?>">
	<ul id="ProductTab" class="nav nav-tabs">
		<li class="active"><a href="#ru" data-toggle="tab">Русский</a></li>
		<li><a href="#en" data-toggle="tab">English</a></li>
	</ul>
	<div id="ProductTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="ru">
			<div class="control-group">
				<label>Название:</label>
				<input type="text" name="ru_title" class="span3" value="<?=$genre['ru_title']?>" />
			</div>
		</div>
		<div class="tab-pane fade" id="en">
			<div class="control-group">
				<label>Title:</label>
				<input type="text" name="en_title" class="span3" value="<?=$genre['en_title']?>" />
			</div>
		</div>
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="<?=$genre['sort'];?>" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>
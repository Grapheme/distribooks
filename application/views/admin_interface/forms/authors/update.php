<?=form_open(ADMIN_START_PAGE.'/authors/update',array('class'=>'form-manage-authors')); ?>
	<input type="hidden" name="id" value="<?=$this->input->get('id');?>">
	<ul id="ProductTab" class="nav nav-tabs">
		<li class="active"><a href="#ru" data-toggle="tab">Русский</a></li>
		<li><a href="#en" data-toggle="tab">English</a></li>
	</ul>
	<div id="ProductTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="ru">
			<div class="control-group">
				<label>Имя:</label>
				<input type="text" name="ru_name" class="span3" value="<?=$author['ru_name']?>" placeholder="Имя" />
			</div>
		</div>
		<div class="tab-pane fade" id="en">
			<div class="control-group">
				<label>Name:</label>
				<input type="text" name="en_name" class="span3" value="<?=$author['en_name']?>" placeholder="Name" />
			</div>
		</div>
	</div>
	<hr/>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>
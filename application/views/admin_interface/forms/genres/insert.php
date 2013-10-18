<?=form_open(ADMIN_START_PAGE.'/genres/insert',array('class'=>'form-manage-genres')); ?>
	<ul id="ProductTab" class="nav nav-tabs">
		<li class="active"><a href="#ru" data-toggle="tab">Русский</a></li>
		<li><a href="#en" data-toggle="tab">English</a></li>
	</ul>
	<div id="ProductTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="ru">
			<div class="control-group">
				<label>Название:</label>
				<input type="text" name="ru_title" class="span3" value="" />
			</div>
		</div>
		<div class="tab-pane fade" id="en">
			<div class="control-group">
				<label>Title:</label>
				<input type="text" name="en_title" class="span3" value="" />
			</div>
		</div>
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Добавить</button>
	</div>
<?=form_close();?>
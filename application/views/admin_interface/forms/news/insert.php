<?=form_open_multipart(ADMIN_START_PAGE.'/news/insert',array('class'=>'form-news')); ?>
	<ul id="ProductTab" class="nav nav-tabs">
		<li class="active"><a href="#ru" data-toggle="tab">Русский</a></li>
		<li><a href="#en" data-toggle="tab">English</a></li>
	</ul>
	<div id="ProductTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="ru">
			<a href="#" class="show-meta no-clickable">Заголовки страницы</a>
			<div class="control-group meta-block hidden">
				<label>Title:</label>
				<input type="text" name="ru_page_title" class="span6" value="" />
				<label>Description:</label>
				<textarea class="span6" name="ru_page_description"></textarea>
				<label>H1:</label>
				<input type="text" name="ru_page_h1" class="span6" value="" />
			</div>
			<hr/>
			<div class="control-group">
				<label>Название:</label>
				<input type="text" name="ru_title" class="span3" value="" />
				<label>Краткое описание:</label>
				<input type="text" name="ru_small_anonce" class="span3" value=""/>
				<blockquote><small>Для отображения на главной странице</small></blockquote>
				<label>Анонс:</label>
				<textarea rows="2" class="span6" name="ru_anonce"></textarea>
				<label>Основной текст:</label>
				<textarea style="height: 200px;" class="redactor" name="ru_text"></textarea>
			</div>
		</div>
		<div class="tab-pane fade" id="en">
			<a href="#" class="show-meta no-clickable">Page titles</a>
			<div class="control-group meta-block hidden">
				<label>Title:</label>
				<input type="text" name="en_page_title" class="span6" value="" />
				<label>Description:</label>
				<textarea class="span6" name="en_page_description"></textarea>
				<label>H1:</label>
				<input type="text" name="en_page_h1" class="span6" value="" />
			</div>
			<hr/>
			<div class="control-group">
				<label>Title:</label>
				<input type="text" name="en_title" class="span3" value="" />
				<label>Short anonce:</label>
				<input type="text" name="en_small_anonce" class="span3" value=""/>
				<blockquote><small>To display the home page</small></blockquote>
				<label>Anonce:</label>
				<textarea rows="2" class="span6" name="en_anonce"></textarea>
				<label>Main text:</label>
				<textarea style="height: 200px;" class="redactor" name="en_text"></textarea>
			</div>
		</div>
	</div>
	<div class="controls">
		<label>Дата публикации: </label>
		<input type="text" name="date" class="span2 set-news-data" readonly="readonly" value="<?=date("d.m.Y")?>"/>
	</div>
	<div class="controls">
		<label>Изображение:</label>
		<input type="file" autocomplete="off" name="file" size="52">
		<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
		<div id="div-upload-photo" class="bar-file-upload hidden">
			<div class="progress progress-info progress-striped active">
				<div class="bar" style="width: 0%"></div>
			</div>
		</div>
	</div>
	<div class="control-group">
		<label>Постоянный адрес страницы (page address):</label>
		<input type="text" name="page_address" class="span6" value="" placeholder="" />
		<blockquote>
			<small>Указывать только URI (без доменного имени)</small>
			<small>По-умолчанию транслит русского названия</small>
		</blockquote>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-img-submit no-clickable btn-loading">Добавить</button>
	</div>
<?=form_close();?>
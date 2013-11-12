<?=form_open_multipart(ADMIN_START_PAGE.'/seo/update',array('class'=>'form-books')); ?>
	<input type="hidden" name="meta_titles_id" value="<?=$meta_titles['id'];?>" />
	<ul id="ProductTab" class="nav nav-tabs">
		<li class="active"><a href="#ru" data-toggle="tab">Русский</a></li>
		<li><a href="#en" data-toggle="tab">English</a></li>
	</ul>
	<div id="ProductTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="ru">
			<div class="control-group meta-block">
				<label>Title:</label>
				<input type="text" name="ru_page_title" class="span6" value="<?=$meta_titles['ru_page_title'];?>" />
				<label>Description:</label>
				<textarea class="span6" name="ru_page_description"><?=$meta_titles['ru_page_description'];?></textarea>
				<label>H1:</label>
				<input type="text" name="ru_page_h1" class="span6" value="<?=$meta_titles['ru_page_h1'];?>" />
			</div>
		</div>
		<div class="tab-pane fade" id="en">
			<a href="#" class="show-meta no-clickable">Page titles</a>
			<div class="control-group meta-block">
				<label>Title:</label>
				<input type="text" name="en_page_title" class="span6" value="<?=$meta_titles['en_page_title'];?>" />
				<label>Description:</label>
				<textarea class="span6" name="en_page_description"><?=$meta_titles['en_page_description'];?></textarea>
				<label>H1:</label>
				<input type="text" name="en_page_h1" class="span6" value="<?=$meta_titles['en_page_h1'];?>" />
			</div>
			<hr/>
		</div>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>
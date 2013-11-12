<?=form_open_multipart(ADMIN_START_PAGE.'/books/update',array('class'=>'form-books')); ?>
	<input type="hidden" name="book_id" value="<?=$book['id'];?>" />
	<input type="hidden" name="meta_titles_id" value="<?=$meta_titles['id'];?>" />
	<ul id="ProductTab" class="nav nav-tabs">
		<li class="active"><a href="#ru" data-toggle="tab">Русский</a></li>
		<li><a href="#en" data-toggle="tab">English</a></li>
		<li><a href="#video" data-toggle="tab">Видео контент</a></li>
		<li><a href="#audio" data-toggle="tab">Аудио контент</a></li>
	</ul>
	<div id="ProductTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="ru">
			<a href="#" class="show-meta no-clickable">Заголовки страницы</a>
			<div class="control-group meta-block hidden">
				<label>Title:</label>
				<input type="text" name="ru_page_title" class="span6" value="<?=$meta_titles['ru_page_title'];?>" />
				<label>Description:</label>
				<textarea class="span6" name="ru_page_description"><?=$meta_titles['ru_page_description'];?></textarea>
				<label>H1:</label>
				<input type="text" name="ru_page_h1" class="span6" value="<?=$meta_titles['ru_page_h1'];?>" />
			</div>
			<hr/>
			<div class="control-group">
				<label>Название:</label>
				<input type="text" name="ru_title" class="span3" value="<?=$book['ru_title'];?>" />
				<label>Анонс:</label>
				<textarea rows="2" class="span6" name="ru_anonce"><?=$book['ru_anonce'];?></textarea>
				<label>Основной текст:</label>
				<textarea style="height: 200px;" class="redactor" name="ru_text"><?=$book['ru_text'];?></textarea>
				<label>Правообладатель:</label>
				<input type="text" name="ru_copyright" class="span4" value="<?=$book['ru_copyright'];?>" />
				<label>Объем: </label>
				<input type="text" name="ru_size" class="span3" value="<?=$book['ru_size'];?>"/>
			</div>
		</div>
		<div class="tab-pane fade" id="en">
			<a href="#" class="show-meta no-clickable">Page titles</a>
			<div class="control-group meta-block hidden">
				<label>Title:</label>
				<input type="text" name="en_page_title" class="span6" value="<?=$meta_titles['en_page_title'];?>" />
				<label>Description:</label>
				<textarea class="span6" name="en_page_description"><?=$meta_titles['en_page_description'];?></textarea>
				<label>H1:</label>
				<input type="text" name="en_page_h1" class="span6" value="<?=$meta_titles['en_page_h1'];?>" />
			</div>
			<hr/>
			<div class="control-group">
				<label>Title:</label>
				<input type="text" name="en_title" class="span3" value="<?=$book['en_title'];?>" />
				<label>Anonce:</label>
				<textarea rows="2" class="span6" name="en_anonce"><?=$book['en_anonce'];?></textarea>
				<label>Main text:</label>
				<textarea style="height: 200px;" class="redactor" name="en_text"><?=$book['en_text'];?></textarea>
				<label>Copyright:</label>
				<input type="text" name="en_copyright" class="span4" value="<?=$book['en_copyright'];?>" />
				<label>Size: </label>
				<input type="text" name="en_size" class="span3" value="<?=$book['en_size'];?>"/>
			</div>
		</div>
		<div class="tab-pane fade" id="video">
			<div class="control-group">
				<label>Трейлер:</label>
				<?php $trailers = json_decode($book['trailers']);?>
			<?php if(!empty($trailers)):?>
				<?php for($i=0;$i<count($trailers);$i++):?>
					<textarea rows="2" class="span6" name="trailers[]"><?=$trailers[$i];?></textarea>
				<?php endfor;?>
			<?php else:?>
					<textarea rows="2" class="span6" name="trailers[]"></textarea>
			<?php endif;?>
				<!--<a href="#" class="btn add-media-content no-clickable" title="добавить трейлер"><i class="icon-plus"></i></a>
				<a href="#" class="btn remove-media-content no-clickable" title="удалить трейлер"><i class="icon-minus"></i></a>-->
			</div>
		</div>
		<div class="tab-pane fade" id="audio">
			<div class="control-group">
				<label>Аудиозапись:</label>
				<?php $audio_recording = json_decode($book['audio_recording']);?>
			<?php if(!empty($audio_recording)):?>
				<?php for($i=0;$i<count($audio_recording);$i++):?>
					<textarea rows="2" class="span6" name="audio_recording[]"><?=$audio_recording[$i];?></textarea>
				<?php endfor;?>
			<?php else:?>
					<textarea rows="2" class="span6" name="audio_recording[]"></textarea>
			<?php endif;?>
				<!--<a href="#" class="btn remove-media-content no-clickable" title="добавить аудиозапись"><i class="icon-plus"></i></a>
				<a href="#" class="btn remove-media-content no-clickable" title="удалить аудиозапись"><i class="icon-minus"></i></a>-->
			</div>
		</div>
	</div>
	<hr/>
	<h3>Общая информация</h3>
	<div class="controls">
		<label>Изображение:</label>
		<?php if(!empty($book['thumbnail'])):?>
			<div class="clearfix">
				<img class="img-rounded destination-photo" src="<?=base_url($book['thumbnail']);?>" title="">
			</div>
		<?php endif;?>
		<input type="file" autocomplete="off" name="file" size="52">
		<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
		<div id="div-upload-photo" class="bar-file-upload hidden">
			<div class="progress progress-info progress-striped active">
				<div class="bar" style="width: 0%"></div>
			</div>
		</div>
		<label class="checkbox"><input type="checkbox" class="checkbox-delete-image" name="delete_image" value="1" autocomplete="off"/>Удалить изображение</label>
	</div>
	<div class="controls">
		<label>Ключевые слова (Теги):</label>
		<input type="text" name="keywords" class="span6" value="<?=$book['keywords'];?>" placeholder="Введите ключевые слова через запятую" />
		<label>Авторы:</label>
		<input type="text" value="" class="span6 authors-list" name="authors" />
		<p>Вводить только на русском языке</p>
	</div>
	<div class="controls">
		<label>Возрастное ограничение:</label>
		<select class="span1" name="age_limit">
		<?php for($i=0;$i<count($age_limit);$i++):?>
			<option value="<?=$age_limit[$i]['id']?>" <?=($age_limit[$i]['id'] == $book['age_limit'])?'selected':'';?>><?=$age_limit[$i]['title'];?></option>
		<?php endfor;?>
		</select>
		<label>Жанр:</label>
		<select class="span4" name="genre">
		<?php for($i=0;$i<count($genres);$i++):?>
			<option value="<?=$genres[$i]['id']?>" <?=($genres[$i]['id'] == $book['genre'])?'selected':'';?>><?=$genres[$i]['ru_title'];?></option>
		<?php endfor;?>
		</select>
		<label>Дата выхода: </label>
		<input type="text" name="date_released" class="span3" value="<?=$book['date_released'];?>"/>
		<label>ISBN: </label>
		<input type="text" name="isbn" class="span3" value="<?=$book['isbn'];?>"/>
	</div>
	<div class="controls">
		<label>Цена:</label>
		<input type="text" class="span2" name="price" value="<?=$book['price'];?>"/>
		<label>Цена со скидкой:</label>
		<input type="text" class="span2" name="price_action" value="<?=$book['price_action'];?>" />
		<!--<label>Валюта:</label>
		<select class="span2" name="currency">
		<?php for($i=0;$i<count($currency);$i++):?>
			<option value="<?=$currency[$i]['id']?>" <?=($currency[$i]['id'] == $book['currency'])?'selected':'';?>><?=$currency[$i]['title'];?></option>
		<?php endfor;?>
		</select>-->
	</div>
	<div class="control-group">
		<label>Постоянный адрес страницы (page address):</label>
		<input type="text" name="page_address" class="span6" value="<?=$meta_titles['page_address'];?>" />
		<blockquote>
			<small>Указывать только URI (без доменного имени)</small>
			<small>По-умолчанию транслит русского названия</small>
		</blockquote>
	</div>
	<div class="control-group">
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="<?=$book['sort'];?>" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-img-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>
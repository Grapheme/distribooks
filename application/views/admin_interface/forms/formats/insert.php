<?=form_open(ADMIN_START_PAGE.'/formats/insert',array('class'=>'form-manage-formats','method'=>'POST')); ?>
	<div class="control-group">
		<label>Название</label>
		<input type="text" name="title" class="span3 valid-required" value="" placeholder="Название" />
		<label>Категория</label>
		<select autocomplete="off" name="category">
		<?php for($i=0;$i<count($categories);$i++):?>
			<option value="<?=$categories[$i]['id'];?>" <?=($this->input->get('category') == $categories[$i]['id'])?'selected="selected"':'';?>><?=$categories[$i]['title'];?></option>
		<?php endfor;?>
		</select>
		<label>Описание</label>
		<textarea name="description" class="span6"></textarea>
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
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="" placeholder="№" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-img-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?= form_close(); ?>
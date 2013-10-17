<?=form_open(ADMIN_START_PAGE.'/formats/update',array('class'=>'form-manage-formats','method'=>'POST')); ?>
	<input type="hidden" name="id" value="<?=$format['id'];?>" />
	<div class="control-group">
		<label>Название</label>
		<input type="text" name="title" class="span3 valid-required" value="<?=$format['title'];?>" placeholder="Название" />
		<label>Категория</label>
		<select autocomplete="off" name="category">
		<?php for($i=0;$i<count($categories);$i++):?>
			<option value="<?=$categories[$i]['id'];?>" <?=($categories[$i]['id'] == $format['category'])?'selected="selected"':'';?>><?=$categories[$i]['title'];?></option>
		<?php endfor;?>
		</select>
		<label>Описание</label>
		<textarea name="description" class="span6"><?=$format['description'];?></textarea>
		<div class="controls">
			<label>Изображение:</label>
			<?php if(!empty($format['image'])):?>
				<div class="clearfix">
					<img class="img-rounded destination-photo" src="<?=base_url($format['image']);?>" title="">
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
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="<?=$format['sort'];?>" placeholder="№" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-img-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>
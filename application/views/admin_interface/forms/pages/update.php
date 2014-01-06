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
		<?php if($edit_content):?>
			<div class="control-group meta-block">
				<label>Текстовые блоки:</label>
				<textarea class="span6" placeholder="Верхний левый блок" name="ru_content[left_top_block]"><?=(isset($ru_page_content['left_top_block']))?$ru_page_content['left_top_block']:'';?></textarea>
				<textarea class="span6" placeholder="Верхний правый блок" name="ru_content[right_top_block]"><?=(isset($ru_page_content['right_top_block']))?$ru_page_content['right_top_block']:'';?></textarea>
				<textarea class="span6" placeholder="Нижний левый блок" name="ru_content[left_bottom_block]"><?=(isset($ru_page_content['left_bottom_block']))?$ru_page_content['left_bottom_block']:'';?></textarea>
				<textarea class="span6" placeholder="Нижний правый блок" name="ru_content[right_bottom_block]"><?=(isset($ru_page_content['right_bottom_block']))?$ru_page_content['right_bottom_block']:'';?></textarea>
			</div>
		<?php endif;?>
		</div>
		<div class="tab-pane fade" id="en">
			<div class="control-group meta-block">
				<label>Title:</label>
				<input type="text" name="en_page_title" class="span6" value="<?=$meta_titles['en_page_title'];?>" />
				<label>Description:</label>
				<textarea class="span6" name="en_page_description"><?=$meta_titles['en_page_description'];?></textarea>
				<label>H1:</label>
				<input type="text" name="en_page_h1" class="span6" value="<?=$meta_titles['en_page_h1'];?>" />
			</div>
		<?php if($edit_content):?>
			<div class="control-group meta-block">
				<label>Text blocks:</label>
				<textarea class="span6" placeholder="Top left block" name="en_content[left_top_block]"><?=(isset($en_page_content['left_top_block']))?$en_page_content['left_top_block']:'';?></textarea>
				<textarea class="span6" placeholder="Top right block" name="en_content[right_top_block]"><?=(isset($en_page_content['right_top_block']))?$en_page_content['right_top_block']:'';?></textarea>
				<textarea class="span6" placeholder="Bottom left block" name="en_content[left_bottom_block]"><?=(isset($en_page_content['left_bottom_block']))?$en_page_content['left_bottom_block']:'';?></textarea>
				<textarea class="span6" placeholder="Bottom right block" name="en_content[right_bottom_block]"><?=(isset($en_page_content['right_bottom_block']))?$en_page_content['right_bottom_block']:'';?></textarea>
			</div>
		<?php endif;?>
		</div>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>
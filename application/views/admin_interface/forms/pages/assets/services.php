<?php if($containerLANG == RUSLAN):?>
	<div class="control-group meta-block">
		<label>Блок заказать (Название):</label>
		<input type="text" name="ru_content[left_title]" class="span4" value="<?=(isset($ru_page_content['left_title']))?$ru_page_content['left_title']:'';?>" />
		<label>Блок заказать:</label>
		<textarea class="span6" rows="5" name="ru_content[left_top_block]"><?=(isset($ru_page_content['left_top_block']))?$ru_page_content['left_top_block']:'';?></textarea>
		<label>Блок заказать (кнопка):</label>
		<input type="text" name="ru_content[left_button]" class="span2" value="<?=(isset($ru_page_content['left_button']))?$ru_page_content['left_button']:'';?>" />
		<label>Блок заказать (нижний):</label>
		<textarea class="span6" rows="5" name="ru_content[left_bottom_block]"><?=(isset($ru_page_content['left_bottom_block']))?$ru_page_content['left_bottom_block']:'';?></textarea>
		<label>Блок заняться (Название):</label>
		<input type="text" name="ru_content[right_title]" class="span4" value="<?=(isset($ru_page_content['right_title']))?$ru_page_content['right_title']:'';?>" />
		<label>Блок заняться:</label>
		<textarea class="span6" rows="5" name="ru_content[right_top_block]"><?=(isset($ru_page_content['right_top_block']))?$ru_page_content['right_top_block']:'';?></textarea>
		<label>Блок заняться (кнопка):</label>
		<input type="text" name="ru_content[right_button]" class="span2" value="<?=(isset($ru_page_content['right_button']))?$ru_page_content['right_button']:'';?>" />
		<label>Блок заняться (нижний):</label>
		<textarea class="span6" rows="5" name="ru_content[right_bottom_block]"><?=(isset($ru_page_content['right_bottom_block']))?$ru_page_content['right_bottom_block']:'';?></textarea>
	</div>
<?php endif;?>

<?php if($containerLANG == ENGLAN):?>
	<div class="control-group meta-block">
		<label>Block order (title):</label>
		<input type="text" name="en_content[left_title]" class="span4" value="<?=(isset($en_page_content['left_title']))?$en_page_content['left_title']:'';?>" />
		<label>Block order:</label>
		<textarea class="span6" rows="5" name="en_content[left_top_block]"><?=(isset($en_page_content['left_top_block']))?$en_page_content['left_top_block']:'';?></textarea>
		<label>Block order (button):</label>
		<input type="text" name="en_content[left_button]" class="span2" value="<?=(isset($en_page_content['left_button']))?$en_page_content['left_button']:'';?>" />
		<label>Block order (bottom):</label>
		<textarea class="span6" rows="5" name="en_content[left_bottom_block]"><?=(isset($en_page_content['left_bottom_block']))?$en_page_content['left_bottom_block']:'';?></textarea>
		<label>Block to do (title):</label>
		<input type="text" name="en_content[right_title]" class="span4" value="<?=(isset($en_page_content['right_title']))?$en_page_content['left_title']:'';?>" />
		<label>Block to do:</label>
		<textarea class="span6" rows="5" name="en_content[right_top_block]"><?=(isset($en_page_content['right_top_block']))?$en_page_content['right_top_block']:'';?></textarea>
		<label>Block to do (button):</label>
		<input type="text" name="en_content[right_button]" class="span2" value="<?=(isset($en_page_content['right_button']))?$en_page_content['left_button']:'';?>" />
		<label>Block to do (bottom):</label>
		<textarea class="span6" rows="5"name="en_content[right_bottom_block]"><?=(isset($en_page_content['right_bottom_block']))?$en_page_content['right_bottom_block']:'';?></textarea>
	</div>
<?php endif;?>
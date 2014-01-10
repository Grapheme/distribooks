<?php if($containerLANG == RUSLAN):?>
	<div class="control-group meta-block">
		<label>Блок заказать:</label>
		<textarea class="span6" rows="5" name="ru_content[left_top_block]"><?=(isset($ru_page_content['left_top_block']))?$ru_page_content['left_top_block']:'';?></textarea>
		<label>Блок заказать (кнопка):</label>
		<input type="text" name="ru_content[left_button]" class="span2" value="<?=(isset($ru_page_content['left_button']))?$ru_page_content['left_button']:'';?>" />
		<label>Блок заказать (нижний):</label>
		<textarea class="span6" rows="5" name="ru_content[left_bottom_block]"><?=(isset($ru_page_content['left_bottom_block']))?$ru_page_content['left_bottom_block']:'';?></textarea>
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
		<label>Block Order Editing:</label>
		<textarea class="span6" rows="5" name="en_content[left_top_block]"><?=(isset($en_page_content['left_top_block']))?$en_page_content['left_top_block']:'';?></textarea>
		<label>Block Order Editing (button):</label>
		<input type="text" name="en_content[left_button]" class="span2" value="<?=(isset($en_page_content['left_button']))?$en_page_content['left_button']:'';?>" />
		<label>Block Order Editing (bottom):</label>
		<textarea class="span6" rows="5" name="en_content[left_bottom_block]"><?=(isset($en_page_content['left_bottom_block']))?$en_page_content['left_bottom_block']:'';?></textarea>
		<label>Block Do editing:</label>
		<textarea class="span6" rows="5" name="en_content[right_top_block]"><?=(isset($en_page_content['right_top_block']))?$en_page_content['right_top_block']:'';?></textarea>
		<label>Block Do editing (button):</label>
		<input type="text" name="en_content[right_button]" class="span2" value="<?=(isset($en_page_content['right_button']))?$en_page_content['left_button']:'';?>" />
		<label>Block Order Editing (bottom):</label>
		<textarea class="span6" rows="5"name="en_content[right_bottom_block]"><?=(isset($en_page_content['right_bottom_block']))?$en_page_content['right_bottom_block']:'';?></textarea>
	</div>
<?php endif;?>
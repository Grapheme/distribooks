<?php if($containerLANG == RUSLAN):?>
	<div class="control-group meta-block">
		<label>Контент страницы:</label>
		<textarea class="redactor" style="height: 300px;" name="ru_content[content]"><?=(isset($ru_page_content['content']))?$ru_page_content['content']:'';?></textarea>
		<label>Адресный блок:</label>
		<textarea class="span6" rows="6" name="ru_content[address_block]"><?=(isset($ru_page_content['address_block']))?$ru_page_content['address_block']:'';?></textarea>
	</div>
<?php endif;?>

<?php if($containerLANG == ENGLAN):?>
	<div class="control-group meta-block">
		<label>Page content:</label>
		<textarea class="redactor" style="height: 300px;" name="en_content[content]"><?=(isset($en_page_content['content']))?$en_page_content['content']:'';?></textarea>
		<label>Address block:</label>
		<textarea class="span6" rows="6" name="en_content[address_block]"><?=(isset($en_page_content['address_block']))?$en_page_content['address_block']:'';?></textarea>
	</div>
<?php endif;?>
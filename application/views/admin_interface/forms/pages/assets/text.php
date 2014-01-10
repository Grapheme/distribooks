<?php if($containerLANG == RUSLAN):?>
	<div class="control-group meta-block">
		<label>Контент:</label>
		<textarea class="redactor" style="height: 300px;" name="ru_content[content]"><?=(isset($ru_page_content['content']))?$ru_page_content['content']:'';?></textarea>
	</div>
<?php endif;?>

<?php if($containerLANG == ENGLAN):?>
	<div class="control-group meta-block">
		<label>Content:</label>
		<textarea class="redactor" style="height: 300px;" name="en_content[content]"><?=(isset($en_page_content['content']))?$en_page_content['content']:'';?></textarea>
	</div>
<?php endif;?>
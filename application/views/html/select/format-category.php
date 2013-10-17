<div class="inline">
	<select autocomplete="off" class="select-format-category" name="category">
	<option value="">Категория не указана</option>
	<?php for($i=0;$i<count($categories);$i++):?>
		<option value="<?=$categories[$i]['id'];?>" <?=($this->input->get('category') == $categories[$i]['id'])?'selected="selected"':'';?>><?=$categories[$i]['title'];?></option>
	<?php endfor;?>
	</select>
</div>
<div class="inline">
	<select autocomplete="off" class="select-genres" name="genre">
	<option value="">Жанр не указан</option>
	<?php for($i=0;$i<count($genres);$i++):?>
		<option value="<?=$genres[$i]['id'];?>" <?=($this->input->get('genre') == $genres[$i]['id'])?'selected="selected"':'';?>><?=$genres[$i]['ru_title'];?></option>
	<?php endfor;?>
	</select>
</div>
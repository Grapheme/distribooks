<form action="">
	<div class="format-select">
	<select>
		<option value="" selected="selected"><?=lang('top_menu_find_genre');?></option>
	</select>
	</div>
	<div><input type="text" placeholder="<?=lang('top_menu_find_author');?>"></div>
	<div>
		<span><?=lang('top_menu_find_audio');?> </span><input id="audio" type="checkbox" name="audio" checked="checked">
		<label for="audio"></label>
	</div>
	<div>
		<span><?=lang('top_menu_find_text');?> </span><input id="text" type="checkbox" name="text" checked="checked">
		<label for="text"></label>
	</div>
	<div><input type="text" placeholder="<?=lang('top_menu_find_format');?>"></div>
</form>
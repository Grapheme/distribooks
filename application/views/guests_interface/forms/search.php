<form action="<?=site_url('search');?>" class="form-search" method="GET">
	<input type="text" class="input-search-text" name="param" value="<?=$this->input->get('param');?>" placeholder="<?=lang('top_menu_find');?>">
	<button type="submit" class="btn-search-submit"></button>
</form>
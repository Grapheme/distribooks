<?php $resources = json_decode($book['files'],TRUE);?>
<ul class="book-items clearfix" data-action="<?=site_url(ADMIN_START_PAGE.'/books/caption?book='.$this->input->get('id'));?>">
<?php for($i=0;$i<count($resources);$i++):?>
	<li class="span3">
		<img src="<?=site_url('book-format/'.$resources[$i]['format_id'])?>" alt="" title="<?=$resources[$i]['file_name'];?>">
		<label>Подпись:</label><input type="text" name="caption" class="book-caption" value="<?=$resources[$i]['caption'];?>" /><br/>
		<label>№ п.п.:</label><input type="text" name="sort" class="span1 book-sort" value="<?=$resources[$i]['sort'];?>" />
		<label>Формат:</label>
		<select class="span1 book-format" name="format">
		<?php for($j=0;$j<count($formats);$j++):?>
			<option value="<?=$formats[$j]['id'];?>" <?=($formats[$j]['id'] == $resources[$i]['format_id'])?'selected':''?>><?=$formats[$j]['title'];?></option>
		<?php endfor;?>
		</select>
		<button data-item="<?=$resources[$i]['number'];?>" class="btn btn-info btn-book-caption"><i class="icon-check"></i></button>
	</li>
<?php endfor;?>
</ul>

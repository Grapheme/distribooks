<?php $resources = json_decode($book['files'],TRUE);?>
<ul class="resources-items clearfix">
<?php for($i=0;$i<count($resources);$i++):?>
	<li class="span3">
		<img src="<?=site_url('book-format/'.$resources[$i]['format_id'])?>" alt="" title="<?=$resources[$i]['file_name'];?>">
		<label>Подпись:</label><input type="text" name="caption" class="resource-caption" value="<?=$resources[$i]['caption'];?>" /><br/>
		<label>№ п.п.:</label><input type="text" name="number" class="span1 resource-number" value="<?=$resources[$i]['number'];?>" />
		<label>Формат:</label>
		<select class="span3" name="format">
		<?php for($j=0;$j<count($formats);$j++):?>
			<option value="<?=$formats[$j]['id'];?>" <?=($formats[$j]['id'] == $resources[$i]['format'])?'selected':''?>><?=$formats[$j]['title'];?></option>
		<?php endfor;?>
		</select>
		<input type="text" name="format" class="span1 resource-number" value="<?=$resources[$i]['number'];?>" />
	</li>
<?php endfor;?>
</ul>
<button class="btn btn-info btn-resources-caption">Сохранить</button>
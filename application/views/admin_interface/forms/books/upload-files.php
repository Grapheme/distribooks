<?php $resources = json_decode($book['files'],TRUE);?>
<div class="clearfix">
	<ul class="resources-items resources-documents" data-action="<?=site_url(ADMIN_START_PAGE.'/books/remove/book?book='.$this->input->get('id'));?>">
	<?php for($i=0;$i<count($resources);$i++):?>
		<li>
			<img src="<?=site_url('book-format/'.$resources[$i]['format_id'])?>" alt="">
			<a href="" data-resource-id="<?=$resources[$i]['number']?>" class="no-clickable delete-resource-item">&times;</a>
		</li>
	<?php endfor;?>
	</ul>
</div>
<?=$this->load->view('html/zone-upload-book',array('action'=>site_url(ADMIN_START_PAGE.'/books/uploading?id='.$this->input->get('id'))));?>

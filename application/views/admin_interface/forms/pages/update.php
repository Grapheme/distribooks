<?=form_open_multipart(ADMIN_START_PAGE.'/seo/update',array('class'=>'form-books')); ?>
	<input type="hidden" name="meta_titles_id" value="<?=$meta_titles['id'];?>" />
	<input type="hidden" name="meta_titles_group" value="<?=$meta_titles['group'];?>" />
	<ul id="ProductTab" class="nav nav-tabs">
		<li class="active"><a href="#ru" data-toggle="tab">Русский</a></li>
		<li><a href="#en" data-toggle="tab">English</a></li>
	</ul>
	<div id="ProductTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="ru">
			<div class="control-group meta-block<?=(!$edit_meta_titles)?' hidden':'';?>">
				<label>Title:</label>
				<input type="text" name="ru_page_title" class="span6" value="<?=$meta_titles['ru_page_title'];?>" />
				<label>Description:</label>
				<textarea class="span6" name="ru_page_description"><?=$meta_titles['ru_page_description'];?></textarea>
				<label>H1:</label>
				<input type="text" name="ru_page_h1" class="span6" value="<?=$meta_titles['ru_page_h1'];?>" />
			</div>
		<?php if($meta_titles['group'] == 'services'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/services',array('containerLANG'=>RUSLAN));?>
		<?php endif;?>
		<?php if($meta_titles['group'] == 'about'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/about',array('containerLANG'=>RUSLAN));?>
		<?php endif;?>
		<?php if($meta_titles['group'] == 'donation'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/text',array('containerLANG'=>RUSLAN));?>
		<?php endif;?>
		<?php if($meta_titles['group'] == 'pay'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/text',array('containerLANG'=>RUSLAN));?>
		<?php endif;?>
		</div>
		<div class="tab-pane fade" id="en">
			<div class="control-group meta-block<?=(!$edit_meta_titles)?' hidden':'';?>">
				<label>Title:</label>
				<input type="text" name="en_page_title" class="span6" value="<?=$meta_titles['en_page_title'];?>" />
				<label>Description:</label>
				<textarea class="span6" name="en_page_description"><?=$meta_titles['en_page_description'];?></textarea>
				<label>H1:</label>
				<input type="text" name="en_page_h1" class="span6" value="<?=$meta_titles['en_page_h1'];?>" />
			</div>
		<?php if($meta_titles['group'] == 'services'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/services',array('containerLANG'=>ENGLAN));?>
		<?php endif;?>
		<?php if($meta_titles['group'] == 'about'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/about',array('containerLANG'=>ENGLAN));?>
		<?php endif;?>
		<?php if($meta_titles['group'] == 'donation'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/text',array('containerLANG'=>ENGLAN));?>
		<?php endif;?>
		<?php if($meta_titles['group'] == 'pay'):?>
			<?php $this->load->view('admin_interface/forms/pages/assets/text',array('containerLANG'=>ENGLAN));?>
		<?php endif;?>
		</div>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-success btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?=form_close();?>
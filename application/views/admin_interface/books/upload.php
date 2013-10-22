<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
</head>
<body>
	<?php $this->load->view("admin_interface/includes/navbar");?>
	<div class="container">
		<div class="row">
			<div class="span3">
				<?php $this->load->view("admin_interface/includes/sidebar");?>
			</div>
			<div class="span9">
				<ul class="breadcrumb">
					<li><a href="<?=site_url(ADMIN_START_PAGE);?>">Панель управления</a> <span class="divider">/</span></li>
					<li><a href="<?=site_url(ADMIN_START_PAGE.'/genres');?>">Жанры</a> <span class="divider">/</span></li>
					<li><a href="<?=site_url(ADMIN_START_PAGE.'/books'.getUrlLink());?>">Книги</a> <span class="divider">/</span></li>
					<li class="active">Загрузка книг</li>
				</ul>
				<div class="clear"></div>
				<div class="clearfix">
					<ul class="nav nav-tabs">
						<li <?=($this->input->get('mode') == 'files')?'class="active"':''?>><a href="<?=site_url(ADMIN_START_PAGE.'/books/upload?mode=files&id='.$this->input->get('id'));?>">Файлы книг</a></li>
						<li <?=($this->input->get('mode') == 'caption')?'class="active"':''?>><a href="<?=site_url(ADMIN_START_PAGE.'/books/upload?mode=caption&id='.$this->input->get('id'));?>">Подписи</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			<?php if($this->input->get('mode')=='files'):?>
				<?php $this->load->view('admin_interface/forms/books/upload-files');?>
			<?php else:?>
				<?php $this->load->view('admin_interface/forms/books/caption-files');?>
			<?php endif;?>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript" src="<?=site_url('js/libs/single-upload-document.js');?>"></script>
</body>
</html>
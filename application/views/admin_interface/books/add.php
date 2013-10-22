<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
<link rel="stylesheet" href="<?=site_url('css/admin-panel/redactor.css');?>" />
<link rel="stylesheet" href="<?=site_url('css/admin-panel/token-input.css');?>" type="text/css" />
<link rel="stylesheet" href="<?=site_url('css/admin-panel/token-input-facebook.css');?>" type="text/css" />
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
					<li class="active">Добавление</li>
				</ul>
				<div class="clear"></div>
				<?php $this->load->view('admin_interface/forms/books/insert');?>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	
	<script type="text/javascript" src="<?=site_url('js/vendor/redactor.min.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/redactor-config.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/vendor/jquery.tokeninput.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/token-config.js');?>"></script>
</body>
</html>
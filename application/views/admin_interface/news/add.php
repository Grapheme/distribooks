<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
<link rel="stylesheet" href="<?=site_url('css/admin-panel/redactor.css');?>" />
<link rel="stylesheet" href="<?=site_url('css/datapicker/jquery-ui-datapicker.css');?>" />
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
					<li><a href="<?=site_url(ADMIN_START_PAGE.'/news');?>">Новости</a> <span class="divider">/</span></li>
					<li class="active">Добавление новости</li>
				</ul>
				<div class="clear"></div>
				<?php $this->load->view('admin_interface/forms/news/insert');?>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript" src="<?=site_url('js/vendor/redactor.min.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/redactor-config.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker-ru.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/datepicker-config.js');?>"></script>
</body>
</html>
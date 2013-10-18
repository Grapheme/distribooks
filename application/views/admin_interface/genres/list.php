<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>

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
					<li class="active">Жанры</li>
				</ul>
				<div class="clear"></div>
				<div class="inline">
					<a href="<?=site_url(ADMIN_START_PAGE.'/genres/add')?>" class="btn btn-info">Добавить жанр</a>
				</div>
				<h2>Жанры</h2>
				<?php $this->load->view('html/multy-search-form',array('form_action'=>uri_string(),'search_action'=>'search-genres-list')); ?>
				<?=$pages;?>
				<table class="table table-bordered table-striped table-hover table-condensed" data-action="<?=site_url(ADMIN_START_PAGE.'/genres/remove');?>">
					<thead>
						<tr>
							<th class="span2"></th>
							<th class="span5">Название</th>
							<th class="span1">№ п.п.</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($genres);$i++):?>
						<tr>
							<td>
								<a <?=($this->input->get('search') != '' && count($genres) > 1)?'target="_blank"':''?> href="<?=site_url(ADMIN_START_PAGE.'/genres/edit?id='.$genres[$i]['id'])?>" class="btn btn-link" ><i class="icon-pencil"></i></a>
								<button data-item="<?=$genres[$i]['id'];?>" class="btn btn-link remove-item"><i class="icon-remove"></i></button>
							</td>
							<td><?=$genres[$i]['ru_title'].' ('.$genres[$i]['en_title'].')';?></td>
							<td><?=$genres[$i]['sort'];?></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
				<?=$pages;?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	
	<script type="text/javascript" src="<?=site_url('js/vendor/jquery.tokeninput.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/token-config.js');?>"></script>
</body>
</html>
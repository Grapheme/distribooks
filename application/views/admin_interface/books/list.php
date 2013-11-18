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
					<li><a href="<?=site_url(ADMIN_START_PAGE.'/genres');?>">Жанры</a> <span class="divider">/</span></li>
					<li class="active">Книги</li>
				</ul>
				<div class="clear"></div>
				<label>Фильтр по жанру</label>
				<?php $this->load->view('html/select/genres');?>
				<a href="<?=site_url(ADMIN_START_PAGE.'/books/add'.getUrlLink())?>" class="btn btn-info">Добавить книгу</a>
				<h2>Книги</h2>
				<?php $this->load->view('html/multy-search-form',array('form_action'=>uri_string(),'search_action'=>'search-books-list')); ?>
				<?=$pages;?>
				<table class="table table-bordered table-striped table-hover table-condensed" data-action="<?=site_url(ADMIN_START_PAGE.'/books/remove');?>">
					<thead>
						<tr>
							<th class="span2"></th>
							<th class="span1"></th>
							<th class="span2">Название</th>
							<th class="span3">Описание</th>
							<th class="span1">№ п.п.</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($books);$i++):?>
						<tr>
							<td>
								<a <?=($this->input->get('search') != '' && count($books) > 1)?'target="_blank"':''?> href="<?=site_url(ADMIN_START_PAGE.'/books/edit?id='.$books[$i]['id'])?>" class="btn btn-link" ><i class="icon-pencil"></i></a>
								<a <?=($this->input->get('search') != '' && count($books) > 1)?'target="_blank"':''?> href="<?=site_url(ADMIN_START_PAGE.'/books/upload?mode=files&id='.$books[$i]['id'])?>" title="Книги" class="btn btn-link" ><i class="icon-book"></i></a>
								<button data-item="<?=$books[$i]['id'];?>" class="btn btn-link remove-item"><i class="icon-remove"></i></button>
							</td>
							<td>
							<?php if(!empty($books[$i]['thumbnail'])):?>
								<img src="<?=base_url($books[$i]['thumbnail'])?>" alt="" title="<?=$books[$i]['ru_title'];?>">
							<?php endif;?>
							</td>
							<td><?=$books[$i]['ru_title'].' ('.$books[$i]['en_title'].')';?></td>
							<td><?=word_limiter($books[$i]['ru_anonce'],25);?></td>
							<td><?=$books[$i]['ru_sort'].' ('.$books[$i]['en_sort'].')';?></td>
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
	<script type="text/javascript" src="<?=site_url('js/cabinet/selects.js');?>"></script>
</body>
</html>
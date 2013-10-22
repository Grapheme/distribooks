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
					<li><a href="<?=site_url(ADMIN_START_PAGE.'/formats/categories');?>">Категории форматов</a> <span class="divider">/</span></li>
					<li class="active">Форматы</li>
				</ul>
				<div class="clear"></div>
				<label>Фильтр по категории</label>
				<?php $this->load->view('html/select/format-category');?>
				<a href="<?=site_url(ADMIN_START_PAGE.'/formats/add'.getUrlLink())?>" class="btn">Добавить формат</a>
			<?php if(!empty($formats)):?>
				<h2>Форматы</h2>
				<table class="table table-bordered table-striped table-hover table-condensed" data-action="<?=site_url(ADMIN_START_PAGE.'/formats/remove')?>">
					<thead>
						<tr>
							<th class="span2"></th>
							<th class="span2">Название</th>
							<th class="span1">№ п.п.</th>
						</tr>
					</thead>
					<tbody>
					<?php $this->load->helper('text');?>
					<?php for($i=0;$i<count($formats);$i++):?>
						<tr>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/formats/edit?id='.$formats[$i]['id'])?>" class="btn btn-link" ><i class="icon-edit"></i></a>
								<button data-item="<?=$formats[$i]['id'];?>" class="btn btn-link remove-item"><i class="icon-remove"></i></button>
							</td>
							<td class="menu-title"><?=$formats[$i]['title'];?></td>
							<td class="menu-title"><?=word_limiter($formats[$i]['description'],15);?></td>
							<td class="menu-title"><?=$formats[$i]['sort'];?></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
			<?php else:?>
				<div class="msg-alert">Список форматов пуст</div>
			<?php endif;?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript" src="<?=site_url('js/cabinet/selects.js');?>"></script>
</body>
</html>
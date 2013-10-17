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
					<li class="active">Категории форматов</li>
				</ul>
				<div class="clear"></div>
				<div class="result-request"></div>
			<?php if(!empty($categories)):?>
				<h2>Категории форматов</h2>
				<table class="table table-bordered table-striped table-hover table-condensed" data-action="<?=site_url(ADMIN_START_PAGE.'/formats/save-categories')?>">
					<thead>
						<tr>
							<th class="span1"></th>
							<th class="span6">Название</th>
							<th class="span1">№ п.п.</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($categories);$i++):?>
						<tr>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/formats/categories/edit?id='.$categories[$i]['id'])?>" class="btn btn-link" ><i class="icon-edit"></i></a>
							</td>
							<td class="menu-title">
								<a href="<?=site_url(ADMIN_START_PAGE.'/formats?category='.$categories[$i]['id'])?>"><?=$categories[$i]['title'];?></a>
							</td>
							<td class="menu-title"><?=$categories[$i]['sort'];?></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
			<?php else:?>
				<div class="msg-alert">Список категорий пуст</div>
			<?php endif;?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>
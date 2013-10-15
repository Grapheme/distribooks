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
					<li class="active">Новости</li>
				</ul>
				<div class="clear"></div>
				<div class="inline">
					<a href="<?=site_url(ADMIN_START_PAGE.'/news/add')?>" class="btn btn-info">Добавить новость</a>
				</div>
				<h2>Новости</h2>
				<table class="table table-bordered table-striped table-hover table-condensed" data-action="<?=site_url(ADMIN_START_PAGE.'/news/remove');?>">
					<thead>
						<tr>
							<th class="span2"></th>
							<th class="span6">Название</th>
							<th class="span1">Дата</th>
							<th class="span1">№ п.п.</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($news);$i++):?>
						<tr>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/news/edit?id='.$news[$i]['id'])?>" class="btn btn-link" ><i class="icon-pencil"></i></a>
								<button data-item="<?=$news[$i]['id'];?>" class="btn btn-link remove-item"><i class="icon-remove"></i></button>
							</td>
							<td><?=$news[$i]['ru_title'];?></td>
							<td><?=swapDotDateWithoutTime($news[$i]['date']);?></td>
							<td><?=$news[$i]['sort'];?></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>
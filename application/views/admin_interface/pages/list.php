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
					<li class="active">SEO</li>
				</ul>
				<div class="clear"></div>
				<h2>SEO</h2>
				<table class="table table-bordered table-striped table-hover table-condensed">
					<thead>
						<tr>
							<th class="span2"></th>
							<th class="span5">Название</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($meta_titles);$i++):?>
						<tr>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/seo/edit?id='.$meta_titles[$i]['id'])?>" class="btn btn-link" ><i class="icon-pencil"></i></a>
							</td>
							<td><?=$meta_titles[$i]['ru_page_title'].' ('.$meta_titles[$i]['en_page_title'].')';?></td>
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
	
	<script type="text/javascript" src="<?=site_url('js/vendor/jquery.tokeninput.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/token-config.js');?>"></script>
</body>
</html>
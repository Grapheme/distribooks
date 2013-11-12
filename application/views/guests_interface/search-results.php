<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('guests_interface/includes/ie7');?>
		<?php $this->load->view('guests_interface/includes/header');?>
		<div class="dark-screen"></div>
		<div class="window-donation">
			<?php $this->load->view('guests_interface/forms/donation');?>
		</div>
		<?php $this->load->view('guests_interface/includes/recall-div');?>
		<?php $this->load->view('guests_interface/includes/sn-tooltips');?>
		<?php $this->load->view('guests_interface/includes/main-menu');?>
		<?php $this->load->view('guests_interface/includes/auth');?>
		<div class="clear"></div>
		<div class="container_5">
			<div class="grid_1 left-boxes shop">
				<?php $this->load->view('guests_interface/includes/left-nav');?>
			</div>
			<div class="grid_4 top-shop-div">
		<?php if(!empty($catalog)):?>
			<?php for($i=0;$i<count($catalog);$i++):?>
				<div class="top-shop<?=($i==0)?' alpha':'';?><?=($i==(count($catalog)-1))?' omega':'';?>">
					<?php $this->load->view('guests_interface/html/book-in-shop',array('book'=>$catalog[$i]));?>
					<?php $this->load->view('guests_interface/html/buyor',array('book_id'=>$catalog[$i]['id'],'mySignedBook'=>$catalog[$i]['signed_book'],'in_basket'=>$catalog[$i]['book_in_basket']));?>
					<div class="shop-desc">
						<?=$catalog[$i][$this->uri->language_string.'_anonce']?>
					</div>
				</div>
			<?php if(($i+1)%3 == 0):?>
				<div class="clear"></div>
			<?php endif?>
			<?php endfor;?>
		<?php else:?>
			<p><?=lang('search_catalog_fail');?></p>
		<?php endif;?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	
	<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.barrating.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/barrating-config.js')?>"></script>
</body>
</html>
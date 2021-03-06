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
				<?php $this->load->view('guests_interface/includes/gift-pad',array('style'=>' style="position: absolute; border: 1px solid #fff;"'));?>
			</div>
		<?php if(!empty($news)):?>
			<div class="grid_4 news-one">
			<?php for($i=0;$i<count($news);$i++):?>
				<div style="overflow: hidden;">
					<div class="news-one-div all">
						&nbsp;<?php if(baseURL($news[$i]['thumbnail']) != baseURL()) {?>} <a href="<?=$news[$i]['page_address'];?>"><img src="<?=baseURL($news[$i]['thumbnail']);?>"></a><? } ?>
					</div>
					<div class="news-text all">
						<a href="<?=$news[$i]['page_address'];?>" class="news-one-title"><?=$news[$i][$this->uri->language_string.'_title'];?></a>
						<p class="news-all-text">
							<?=$news[$i][$this->uri->language_string.'_anonce'];?>
						</p>
						<a class="news-date all no-clickable" href=""><?=swapDotDateWithoutTime($news[$i]['date']);?></a>
					</div>
				</div>
			<?php endfor;?>
			</div>
			<?=$pages;?>
		<?php endif;?>
		</div>
		<div class="clear"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('guests_interface/html/yelow-block');?>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<?php $this->load->view('guests_interface/includes/metrika');?>
</body>
</html>
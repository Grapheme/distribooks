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
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
			<div class="grid_1 gift">
				<?php $this->load->view('guests_interface/includes/gift-pad');?>
			</div>
			<div class="grid_4 right-box">
				<div class="grid_4 alpha omega boxes" style="margin-left: -15px;">
					<?php $this->load->view('guests_interface/includes/big-nav');?>
				</div>
			<?php for($i=0;$i<count($novelty);$i++):?>
				<div class="grid_1 omega index-box">
					<?php $this->load->view('guests_interface/html/book-in-shop',array('book'=>$novelty[$i]));?>
					<?php $this->load->view('guests_interface/html/buyor',array('book_id'=>$novelty[$i]['id'],'mySignedBook'=>$novelty[$i]['signed_book'],'in_basket'=>$novelty[$i]['book_in_basket']));?>
				</div>
			<?php endfor;?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="yellow">
			<div class="container_5">
			<?php if(!empty($news)):?>
				<div class="grid_1 news-div pos3-no">
					<div class="news-cont">
						<p class="title"><a href="<?=site_url('news');?>" style="color: #fff; text-decoration: none;"><?=lang('news_block');?></a></p>
					<?php if(count($news) >= 2) { $cnews = 2; } else { $cnews = count($news); } ?>
					<?php for($i=0;$i<$cnews;$i++):?>
						<div class="news">
							<a href="<?=$news[$i]['page_address'];?>" class="news-title"><?=$news[$i][$this->uri->language_string.'_title'];?></a>
							<a href="" class="date no-clickable"><?=swapDotDateWithoutTime($news[$i]['date'])?></a>
							<p class="news-desc"><?=$news[$i][$this->uri->language_string.'_small_anonce'];?></p>
						</div>
					<?php endfor;?>
					</div>
				</div>
			<?php endif;?>
		<?php if(!empty($trailers)):?>
			<?php for($i=0;$i<count($trailers);$i++):?>
				<div class="grid_2 vidiv">
					<a href="<?=site_url($trailers[$i]['page_address'])?>" class="title"><?=$trailers[$i][$this->uri->language_string.'_title'];?></a>
					<?=$trailers[$i]['trailer'];?>
				</div>
			<?php endfor;?>
		<?php endif;?>
			</div>
			<?php $this->load->view('guests_interface/includes/modal-message');?>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.barrating.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/barrating-config.js')?>"></script>
	<script src="<?=baseURL('js/vendor/jquery.elevatezoom.min.js');?>"></script>
	<script>
		$('.zoom-img').elevateZoom({
			responsive: true,
			zoomWindowWidth:168,
            zoomWindowHeight:182,
            scrollZoom : true,
            zoomWindowOffety: -8
		});
	</script>
	<?php $this->load->view('guests_interface/includes/metrika');?>
</body>
</html>
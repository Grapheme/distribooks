
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
			<div class="grid_4 news-one">
				<div class="product-div">
					<div class="shop-top">
						<div class="shop-img">
							<?php $this->load->view('guests_interface/html/book-properties',array('book'=>$book,'big_icons'=>TRUE));?>
							<a href="#" class="shopi big"><img src="<?=baseURL($age_limit['image']);?>"></a>
							<div class="shop-img-cont one"><img id="zoomImage" src="<?=baseURL($book['image']);?>" data-zoom-image="<?=baseURL($book['origin']);?>"></div>
						</div>
						<div class="shop-about big">
							<p class="title no-clickable"><?=$book[$this->uri->language_string.'_title'];?></p>
							<p class="author-big">
							<?php for($j=0;$j<count($authors);$j++):?>
								<a href="<?=site_url('catalog?author='.$authors[$j]['id'])?>"><?=$authors[$j][$this->uri->language_string.'_name'];?></a><?php if(isset($authors[$j+1])):?>, <?php endif;?>
							<?php endfor;?>
							</p>
							<?php
								$disabled = TRUE;
								if(isUserLoggined()):
									if($book['signed_book'] === TRUE):
										$disabled = FALSE;
									endif;
								endif;
							?>
							<?php $this->load->view('guests_interface/html/book-rating',array('disabled'=>$disabled,'bookID'=>$book['id']))?>
							<?php $this->load->view('guests_interface/html/book-price');?>
							<?php $this->load->view('guests_interface/html/buyor',array('book_id'=>$book['id'],'mySignedBook'=>$book['signed_book'],'in_basket'=>$book['book_in_basket']));?>
							<div class="pos3-no">
								<?php $this->load->view('guests_interface/html/about-product')?>
								<?php $this->load->view('guests_interface/html/book-formats',array('formats'=>$formats,'book'=>$book));?>
							</div>
						<?php if(!isAdminLoggined() && $book['signed_book'] === FALSE):?>
							<div class="buyor" data-book-id="<?=$book['id'];?>">
								<a class="gift-link no-clickable" href=""><?=lang('book_shop_gift');?></a>
							</div>
						<?php endif;?>
						</div>
					</div>
				</div>
				<div class="pos3">
					<?php $this->load->view('guests_interface/html/about-product')?>
					<?php $this->load->view('guests_interface/html/book-formats',array('formats'=>$formats,'book'=>$book))?>
				</div>
				<div class="product-desc">
					<?=$book[$this->uri->language_string.'_text']?>
				</div>
				
				<?php
					if(!empty($book['trailers'])):
						if($video_trailer = json_decode($book['trailers'],TRUE)):
							if(isset($video_trailer[0]) && !empty($video_trailer[0])):
								?> <p><?=lang('trailer');?>:</p> <?php
								echo $video_trailer[0];
							endif;
						endif;
					endif;
				?>
				<?php
					if(!empty($book['audio_recording'])):
						if($audio_recording = json_decode($book['audio_recording'],TRUE)):
							if(isset($audio_recording[0]) && !empty($audio_recording[0])):
								?> <p><?=lang('audio');?>:</p> <?php
								echo $audio_recording[0];
							endif;
						endif;
					endif;
				?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="min-nav pos3">
			<?php $this->load->view('guests_interface/includes/small-nav');?>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('guests_interface/html/yelow-block');?>
		<?php $this->load->view('guests_interface/includes/footer');?>
		<?php $this->load->view('guests_interface/includes/modal-message');?>
		<?php $this->load->view('guests_interface/includes/modal-gift');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
	<script src="<?=baseURL('js/vendor/jquery.elevatezoom.min.js');?>"></script>
	<script>
		$('#zoomImage').elevateZoom({responsive: true});
	</script>
	<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.barrating.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/barrating-config.js')?>"></script>
	<?php $this->load->view('guests_interface/includes/metrika');?>
</body>
</html>
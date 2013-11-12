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
		<?php $this->load->view('guests_interface/forms/request-order-translation');?>
		<?php $this->load->view('guests_interface/forms/request-do-translation');?>
		<div class="clear"></div>
		<div class="container_5">
			<div class="clear"></div>
			<div class="min-nav pos3">
				<nav>
					<ul>
						<li><a href="<?=site_url('editing');?>" class="min-option" id="m1"><p><?=lang('menu_editing');?></p><div class="triangle"></div></a></li>
						<li><a href="<?=site_url('typography');?>" class="min-option" id="m2"><p><?=lang('menu_typography');?></p><div class="triangle"></div></a></li>
						<li><a href="<?=site_url('translation');?>" class="min-option" id="m3"><p><?=lang('menu_translation');?></p><div class="triangle"></div></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="container_5">
			<div class="grid_1 left-boxes">
				<?php $this->load->view('guests_interface/includes/left-nav');?>
				<?php $this->load->view('guests_interface/includes/gift-pad');?>
			</div>
		</div>
		<div class="red-div">
			<div class="container_5">
				<div class="grid_1 pos3-no">&nbsp;</div>
				<div class="grid_2 information">
					<div>
						<img class="inf-img" src="<?=baseURL('img/trans-left.png')?>" style="margin-bottom: 24px;">
						<a href="#" class="apply-button apply-order-translation no-clickable"><?=lang('service_send_enquiry');?></a>
					</div>
					<div>
						<p class="title"><span><?=lang('service_request_translation');?></span></p>
						<div class="like"><a href="#"><img src="<?=baseURL('img/like.png')?>"></a><p><?=lang('service_for_author');?></p></div>
					</div>
					<p class="desc"><?=lang('service_request_translation_text');?></p>
				</div>
				<div class="grid_2 information">
					<div>
						<img class="inf-img" src="<?=baseURL('img/trans-right.png')?>">
						<a href="#" class="apply-button apply-do-translation no-clickable"><?=lang('service_send_enquiry');?></a>
					</div>
					<div>
						<p class="title"><span><?=lang('service_begin_translating');?></span></p>
						<div class="like"><a href="#"><img src="<?=baseURL('img/like.png')?>"></a><p><?=lang('service_for_author');?></p></div>
					</div>
					<p class="desc"><?=lang('service_begin_translating_text');?></p>
				</div>
			</div>
		</div>
		<div class="container_5">
			<div class="clear"></div>
			<div class="grid_1 pos3-no">&nbsp;</div>
			<div class="grid_2 info-bottom-div">
				<div class="info-bottom">
					<p>Translation services for your books, our creative studio providing professional translators who have extensive 
					experience with fiction. Usually, it supports the language in which the translation possessing literary talent, with 
					successful experience in reputable translation agencies. Proposal under the terms of our cooperation will be sent to 
					you by e-mail, based on the processing of applications received from you.</p>
				</div>
			</div>
			<div class="grid_2 info-bottom-div">
				<div class="info-bottom right">
					<p>Creative Workshop DistribBooks, helps talented and promising writers and translators - to realize their creative 
					potential. Thanks to the joint efforts of the creative (in the editing and translation, design, marketing and promotion) 
					of the material authors, we create and publish enjoying high popularity among readers - electronic literature. Proposal 
					under the terms of our cooperation will be sent to you by e-mail, based on the processing of applications received from you.</p>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<nav>
					<ul>
						<li><a href="<?=site_url('distribution');?>" class="min-option" id="m4"><p><?=lang('menu_distribution');?></p><div class="triangle"></div></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
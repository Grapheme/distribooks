<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
	<link rel="stylesheet" href="<?=baseURL('css/tooltip.css');?>">
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
		<?php $this->load->view('guests_interface/forms/request-order-clearance');?>
		<?php $this->load->view('guests_interface/forms/request-do-clearance');?>
		<div class="clear"></div>
		<div class="container_5">
			<div class="clear"></div>
			<div class="min-nav pos3">
				<nav>
					<ul>
						<li><a href="<?=site_url('editing');?>" class="min-option" id="m1"><p><?=lang('menu_editing');?></p><div class="triangle"></div></a></li>
						<li><a href="<?=site_url('typography');?>" class="min-option" id="m2"><p><?=lang('menu_typography');?></p><div class="triangle"></div></a></li>
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
		<div class="style-div">
			<div class="container_5">
				<div class="grid_1 pos3-no">&nbsp;</div>
				<div class="grid_2 information">
					<div>
						<img class="inf-img" src="<?=baseURL('img/style-left.png');?>" style="margin-bottom: 53px;">
						<a href="#" class="apply-button apply-order-clearance no-clickable"><?=lang('service_send_enquiry');?></a>
					</div>
					<div>
						<p class="title"><span><?=lang('service_order_clearance');?></span></p>
						<div class="like"><a href="#"><img src="<?=baseURL('img/like.png');?>"></a><p><?=lang('service_for_author');?></p></div>
						<p class="desc style">If you are the author of a book, at this web page you can quickly and easily apply for 
						registration of your professional design work.</p>
					</div>
				</div>
				<div class="grid_2 information">
					<div>
						<img class="inf-img" src="<?=baseURL('img/style-right.png');?>">
						<a href="#" class="apply-button apply-do-clearance no-clickable"><?=lang('service_send_enquiry');?></a>
					</div>
					<div>
						<p class="title"><span><?=lang('service_do_design');?></span></p>
						<div class="like"><a href="#"><img src="<?=baseURL('img/like.png');?>"></a><p><?=lang('service_for_author');?></p></div>
						<p class="desc style">If you are a professional designer / artist / photographer, have a profile design education 
						and the desire to work in our creative studio, at this page of the website you can quickly and easily make a request 
						to cooperate with us.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container_5">
			<div class="clear"></div>
			<div class="grid_1 pos3-no">&nbsp;</div>
			<div class="grid_2 info-bottom-div">
				<div class="style-bottom">
					<p>Services designer décor of your book (including design unique book covers and illustrations for her) 
					in our creative studio providing professional designers, artists and photographers, with extensive experience 
					in the publishing business. As a rule, it is highly qualified professionals with experience in successful international 
					advertising agencies. Proposal under the terms of our cooperation will be sent to you by e-mail, based on the 
					processing of applications received from you.</p>
				</div>
			</div>
			<div class="grid_2 info-bottom-div">
				<div class="style-bottom right">
					<p>Creative Workshop DistribBooks, helps talented and promising writers and designers - to realize their creative 
					potential. Thanks to the joint efforts of the creative (in the editing and translation, design, 
					marketing and promotion) of the material authors, we create and publish enjoying high popularity 
					among readers - electronic literature. Proposal under the terms of our cooperation will be sent to you 
					by e-mail, based on the processing of applications received from you.</p>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="container_5">
			<div class="min-nav pos3">
				<nav>
					<ul>
						<li><a href="<?=site_url('translation');?>" class="min-option" id="m3"><p><?=lang('menu_translation');?></p><div class="triangle"></div></a></li>
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
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
			<div class="clear"></div>
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
				<?php $this->load->view('guests_interface/includes/gift-pad');?>
			</div>
		</div>
		<div class="container_5">
			<div class="grid_1 left-boxes">
				<?php $this->load->view('guests_interface/includes/left-nav');?>
				<?php $this->load->view('guests_interface/includes/gift-pad');?>
			</div>
			</div>
			<div class="dist-div">
				<div class="container_5">
					<div class="grid_1 pos3-no">&nbsp;</div>
					<div class="grid_2 information">
						<div>
							<img class="inf-img" src="<?=baseURL('img/dist-left.png')?>" style="margin-bottom: 54px;">
							<a href="#" class="apply-button">Отправить заявку</a>
						</div>
						<div>
							<p class="title"><span>Order distribution</span></p>
							<div class="like"><a href="#"><img src="<?=baseURL('img/like.png')?>"></a><p>Для автора и издателя</p></div>
							<p class="desc">If you are the author of a book, at this web page you can quickly and easily apply for the 
							organization of the process of national / international distribution of your books.</p>
						</div>
					</div>
					<div class="grid_2 information">
						<div>
							<img class="inf-img" src="<?=baseURL('img/dist-right.png')?>" style="margin-bottom: 20px;">
							<a href="#" class="apply-button">Отправить заявку</a>
						</div>
						<div>
							<p class="title"><span>To begin translating</span></p>
							<div class="like"><a href="#"><img src="<?=baseURL('img/like.png')?>"></a><p>Для автора и издателя</p></div>
							<p class="desc">If you own an online bookstore, or a representative of the marketplace, legally selling e-books 
							and want to cooperate with our creative studio, at this web page you can quickly and easily make a request to 
							cooperate with us.</p>
						</div>
					</div>
				</div>		
			</div>
			<div class="container_5">
				<div class="clear"></div>
				<div class="grid_1 pos3-no">&nbsp;</div>
				<div class="grid_2 info-bottom-div">
					<div class="dist-bottom">
						<p>Services for the organization of international distribution (to producing) of your books, in our creative 
						workshop provided by specialists, with years of experience in international sales and international business 
						development. As a rule, these are professional managers with the necessary knowledge in the field of marketing and 
						reliable connections with key specialized marketplaces. A computerized accounting system of sales, allows you to create 
						transparent financial reporting for our creative writers workshop. Proposal under the terms of our cooperation will 
						be sent to you by e-mail, based on the processing of applications received from you.</p>
					</div>
				</div>
				<div class="grid_2 info-bottom-div">
					<div class="dist-bottom right">
						<p>Creative Workshop DistribBooks, helps talented and promising writers and translators - to realize their 
						creative potential. Thanks to the joint efforts of the creative (in the editing and translation, design, marketing 
						and promotion) of the material authors, we create and publish enjoying high popularity among readers - electronic 
						literature. Proposal under the terms of our cooperation will be sent to you by e-mail, based on the processing of 
						applications received from you.</p>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
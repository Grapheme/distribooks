<header>
<?php if(isset($sliderExist)):?>
	<div class="slide-container pos3-no">
	<?php if($this->uri->segment(1) == 'editing'):?>
		<div class="slider edit">&nbsp;</div>
	<?php elseif($this->uri->segment(1) == 'typography'):?>
		<div class="slider style">&nbsp;</div>
	<?php elseif($this->uri->segment(1) == 'translation'):?>
		<div class="slider trans">&nbsp;</div>
	<?php elseif($this->uri->segment(1) == 'distribution'):?>
		<div class="slider dist">&nbsp;</div>
	<?php else:?>
		<div class="slider">&nbsp;</div>
	<?php endif;?>
	</div>
<?php endif;?>
	<div class="container_5">
		<div style="position: relative;">
		<?php if(!empty($breadcrumbs)):?>
			<div class="bread">
				<a href="<?=site_url();?>">Главная</a>
			<?php foreach($breadcrumbs as $page_url => $page_title):?>
				/ <a href="<?=site_url('catalog/'.$page_url);?>"><?=$page_title;?></a>
			<?php endforeach;?>
			</div>
		<?php endif;?>
			<div class="search-full">
				<div class="search-full-in">
					<?php $this->load->view('guests_interface/forms/search');?>
				</div>
			</div>
			<?php $this->load->view('guests_interface/includes/basket');?>
		</div>
	</div>
	<div class="social">
		<a href="#" class="social-link" id="vk"></a>
		<a href="#" class="social-link" id="fb"></a>
		<a href="#" class="social-link" id="tw"></a>
		<a href="#" class="social-link" id="vk"></a>
		<a href="#" class="social-link" id="fb"></a>
		<a href="#" class="social-link" id="tw"></a>
	</div>
	<div class="top">
		<div class="container_5">
			<div style="position: relative;">
				<div class="min-div-right pos2">
					<a href="#" class="eng"></a>
					<div class="med-bar"></div>
					<a href="#" class="rus"></a>
					<a href="#" class="enter-text">Sign in</a>&nbsp;<a href="#" class="enter"></a>
				</div>
			</div>
				<div class="grid_1" style="z-index: 100;">&nbsp;
					<a class="top-logo" href="<?=site_url();?>"></a>
				</div>
			<div class="top-container">
				<div class="grid_1">&nbsp;
					<a href="#" class="red button topb-left pos2">В закладки</a>
					<div style="position: absolute; bottom: -1px; line-height: 35px;">
						<p class="top-title">Online Publisher</p>
					</div>
				</div>
				<div class="grid_1">
					<img class="qr pos2" src="<?=baseURL('img/qr.png');?>">
					<div style="position: absolute; bottom: -1px; right: 0;">
						<a href="skype:DistibBooks?call" class="top-contact"><img src="<?=baseURL('img/skype.png');?>">DistibBooks</a>
						<a href="#" class="red button">Promotion 30%!</a>
					</div>
				</div>
				<div class="grid_1">
					<div style="position: absolute; bottom: -1px; width: 100%;">
						<a href="mailto:welcome@distibbooks.com" class="top-contact"><img src="<?=baseURL('img/mail.png');?>">welcome@distibbooks.com</a>
						<a href="#" class="blue button call pos1 recall"><img src="<?=baseURL('img/call.png');?>">Request a call</a>
						<a href="#" class="blue button call pos2 basket"><img src="<?=baseURL('img/cart.png');?>">Shopping Cart&nbsp;<span>2000 р.</span></a>
					</div>
				</div>
				<div class="grid_1 pos1">
					<img class="qr" src="<?=baseURL('img/qr.png');?>">
					<a href="#" class="red button topb">Bookmark</a>
					<div class="lang">
						<a href="<?=baseURL(ENGLAN.'/'.uri_string().urlGETParameters());?>" class="eng"></a>
						<div class="med-bar"></div>
						<a href="<?=baseURL(RUSLAN.'/'.uri_string().urlGETParameters());?>" class="rus"></a>
						<div class="enter-div"><a href="#" class="sign-in">Sign in</a><a href="#" class="enter"></a></div>
					</div>
				</div>
			</div>
			<div class="grid_3 bottom-menu">
				<li><a href="#" class="blue button donation">Make donation</a></li>
				<li><a href="<?=site_url('about');?>" class="blue button">About</a></li>
				<li><a href="<?=site_url('catalog');?>" class="blue button">Catalog</a></li>
			</div>
			<div class="grid_1">
				<div class="search">
					<a href="#"></a><input type="text" placeholder="Find">
				</div>
			</div>
			<div class="grid_1">
				<a href="" class="blue button no-clickable call pos1 basket">
					<img src="<?=baseURL('img/cart.png');?>">Shopping Cart&nbsp;<span>2000 р.</span>
				</a>
			</div>
		</div>
	</div>
	<div class="min-top">
		<div class="min-shadow"></div>
		<div class="container_5">
			<div style="position: relative;"><a class="like-min" href="#"></a></div>
			<div class="grid_1" style="margin-top: 0 !important;">
				<a class="min-logo" href="<?=site_url();?>"></a>
				<div class="min-right">
					<div class="min-div-left">
						<a href="#" class="red button">Promotion -30%!</a><br>
						<a href="#" class="blue button menu-open">Menu</a>
					</div>
					<div class="min-div-right">
						<a href="<?=baseURL(ENGLAN.'/'.uri_string().urlGETParameters());?>" class="eng"></a>
						<div class="med-bar"></div>
						<a href="<?=baseURL(RUSLAN.'/'.uri_string().urlGETParameters());?>" class="rus"></a>
						<div><a href="#" class="enter-text">Sign in</a>&nbsp;<a href="#" class="enter"></a></div>
					</div>
					<a href="#" class="blue button call basket"><img src="<?=baseURL('img/cart.png');?>">Shopping Cart&nbsp;<span>2000 р.</span></a>
				</div>
			</div>
			<div class="clear"></div>
			<div class="search min">
				<a href="#"></a><input type="text" placeholder="Find">
			</div>
		</div>
	</div>
</header>
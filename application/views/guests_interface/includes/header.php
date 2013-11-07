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
				<a href="<?=site_url();?>"><?=lang('index_page');?></a>
			<?php foreach($breadcrumbs as $page_url => $page_title):?>
				/ <a href="<?=site_url($page_url);?>"><?=$page_title;?></a>
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
	</div>
	<div class="top">
		<div class="container_5">
			<div style="position: relative;">
				<div class="min-div-right pos2">
					<a href="<?=baseURL(ENGLAN.'/'.uri_string().urlGETParameters());?>" class="eng"></a>
					<div class="med-bar"></div>
					<a href="<?=baseURL(RUSLAN.'/'.uri_string().urlGETParameters());?>" class="rus"></a>
					<a href="#" class="enter-text"><?=lang('top_menu_sign_in');?></a>&nbsp;<a href="#" class="enter"></a>
				</div>
			</div>
			<div class="grid_1" style="z-index: 100;">&nbsp;
				<a class="top-logo" href="<?=site_url();?>"></a>
			</div>
			<div class="top-container">
				<div class="grid_1">&nbsp;
					<a href="#" class="red button topb-left pos2"><?=lang('top_menu_bookmark');?></a>
					<div style="position: absolute; bottom: -1px; line-height: 35px;">
						<p class="top-title"><?=lang('top_menu_publisher');?></p>
					</div>
				</div>
				<div class="grid_1">
					<img class="qr pos2" src="<?=baseURL('img/qr.png');?>">
					<div style="position: absolute; bottom: -1px; right: 0;">
						<a href="skype:DistibBooks?call" class="top-contact"><img src="<?=baseURL('img/skype.png');?>">DistibBooks</a>
					<?php if($this->project_config['action_percent'] > 0):?>
						<a href="#" class="red button no-clickable"><?=lang('top_menu_promotion');?> -<?=$this->project_config['action_percent']?>%!</a>
					<?php endif;?>
					</div>
				</div>
				<div class="grid_1">
					<div style="position: absolute; bottom: -1px; width: 100%;">
						<a href="mailto:welcome@distibbooks.com" class="top-contact"><img src="<?=baseURL('img/mail.png');?>">welcome@distibbooks.com</a>
						<a href="#" class="blue button call pos1 recall no-clickable"><img src="<?=baseURL('img/call.png');?>"><?=lang('top_menu_request_the_call');?></a>
						<a href="#" class="blue button call pos2 basket no-clickable"><img src="<?=baseURL('img/cart.png');?>"><?=lang('top_menu_find_shopping_card');?>&nbsp;<span>2000 р.</span></a>
					</div>
				</div>
				<div class="grid_1 pos1">
					<img class="qr" src="<?=baseURL('img/qr.png');?>">
					<a href="#" class="red button topb no-clickable"><?=lang('top_menu_bookmark');?></a>
					<div class="lang">
						<a href="<?=baseURL(ENGLAN.'/'.uri_string().urlGETParameters());?>" class="eng<?=($this->uri->language_string == ENGLAN)?' active-lang no-clickable':''?>"></a><div class="med-bar"></div><a href="<?=baseURL(RUSLAN.'/'.uri_string().urlGETParameters());?>" class="rus<?=($this->uri->language_string == RUSLAN)?' active-lang no-clickable':''?>"></a>
					<?php if($this->loginstatus === FALSE):?>
						<?php $this->load->view('headers/guest');?>
					<?php elseif($this->account['group'] == ADMIN_GROUP_VALUE):?>
						<?php $this->load->view('headers/admin');?>
					<?php elseif($this->account['group'] == USER_GROUP_VALUE):?>
						<?php $this->load->view('headers/users');?>
					<?php endif;?>
					</div>
				</div>
			</div>
			<div class="grid_3 bottom-menu">
				<li><a href="#" class="blue button donation no-clickable"><?=lang('top_menu_donation');?></a></li>
				<li><a href="<?=site_url('about');?>" class="blue button"><?=lang('top_menu_about');?></a></li>
				<li><a href="<?=site_url('catalog');?>" class="blue button"><?=lang('top_menu_catalog');?></a></li>
			</div>
			<div class="grid_1">
				<div class="search">
					<a href="#"></a><input type="text" placeholder="<?=lang('top_menu_find');?>">
				</div>
			</div>
			<div class="grid_1">
				<a href="" class="blue button call pos1 basket<?=($this->uri->segment(1) == 'basket')?'':' basket-show-link';?> no-clickable<?=(empty($this->account_basket['basket_books']))?' hidden':'';?>">
					<img src="<?=baseURL('img/cart.png');?>"><?=lang('top_menu_find_shopping_card');?>&nbsp;<span class="basket-total-price"><?=$this->account_basket['basket_total_price'];?></span>
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
					<?php if($this->project_config['action_percent'] > 0):?>
						<a href="#" class="red button no-clickable"><?=lang('top_menu_promotion');?> -<?=$this->project_config['action_percent']?>%!</a><br>
					<?php endif;?>
						<a href="#" class="blue button menu-open no-clickable"><?=lang('top_menu_main');?></a>
					</div>
					<div class="min-div-right">
						<a href="<?=baseURL(ENGLAN.'/'.uri_string().urlGETParameters());?>" class="eng"></a><div class="med-bar"></div><a href="<?=baseURL(RUSLAN.'/'.uri_string().urlGETParameters());?>" class="rus"></a><div><a href="" class="enter-text no-clickable"><?=lang('top_menu_sign_in');?></a>&nbsp;<a href="#" class="enter"></a></div>
					</div>
					<a href="" class="blue button call basket<?=($this->uri->segment(1) == 'basket')?'':' basket-show-link';?> no-clickable<?=(empty($this->account_basket['basket_books']))?' hidden':'';?>">
						<img src="<?=baseURL('img/cart.png');?>"><?=lang('top_menu_find_shopping_card');?>&nbsp;<span class="basket-total-price"><?=$this->account_basket['basket_total_price'];?></span>
					</a>
				</div>
			</div>
			<div class="clear"></div>
			<div class="search min">
				<a href="#"></a><input type="text" placeholder="<?=lang('top_menu_main');?>">
			</div>
		</div>
	</div>
</header>
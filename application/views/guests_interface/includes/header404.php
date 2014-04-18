<header>
	<div class="container_5">
	</div>
	<div class="social">
		<a href="http://vk.com/distribbooks" class="social-link" target="_blank" id="vk"></a>
		<a href="https://www.facebook.com/pages/Distribbooks/414587435333963?skip_nax_wizard=true" class="social-link" target="_blank" id="fb"></a>
		<a href="https://twitter.com/DistribBooks" target="_blank" class="social-link" id="tw"></a>
		<a href="http://www.odnoklassniki.ru/group/56862678843444" target="_blank" class="social-link" id="odn"></a>
		<a href="https://plus.google.com/u/0/communities/108042272121599202035" target="_blank" class="social-link" id="gooo"></a>
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
						<a class="red button sale-popup-open"><?=lang('top_menu_promotion');?> -<?=$this->project_config['action_percent']?>%!</a>
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
				<?=$this->load->view("guests_interface/forms/search");?>
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
			<div class="grid_1" style="margin-top: 0 !important;">
				<a class="min-logo" href="<?=site_url();?>"></a>
				<div class="min-right">
					<div class="min-div-left">
						<a class="red button sale-popup-open"><?=lang('top_menu_promotion');?> -<?=$this->project_config['action_percent']?>%!</a>
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
				<?=$this->load->view("guests_interface/forms/search");?>
			</div>
		</div>
	</div>
</header>
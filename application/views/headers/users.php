<?php 
	$CI = & get_instance();
	$CI->load->library('notifications_lib');
	$config['account'] = $this->account['id'];
	$CI->notifications_lib->initialize($config);
	$notification_new = $CI->notifications_lib->getCountNotifications(TRUE);
	$limit = PER_PAGE_DEFAULT;
	if($notification_new > PER_PAGE_DEFAULT):
		$limit = $notification_new;
	endif;
	$limit = 1000;
	$notification = $CI->notifications_lib->getNotifications($limit);
?>
<ul class="clearfix">
	<li>
		<span class="alerts">
			Alerts
		<?php if($notification_new > 0):?>
			<span class="alerts-num"><?=$notification_new;?></span>
		<?php endif;?>
		</span>
		<div class="notifications-popup">
			<span class="ntf-popup-header">Уведомления</span>
			<ul class="ntf-popup-list clearfix scroll-pane">
			<?php for($i=0;$i<count($notification);$i++):?>
				<li class="ntf-popup-item">
					<figure><?=$CI->getNotificationIconList($notification[$i]);?></figure>
					<div class="ntf-content">
						<span class="text"><?=$notification[$i]['title'];?></span>
						<span class="date"><?=SwapDotDateWithTime($notification[$i]['date']);?></span>
					</div>
				</li>
			<?php endfor;?>
				<!--<li class="ntf-popup-item last">
					<img src="<?=base_url('img/load_comment.gif');?>">
				</li>-->
			</ul>
			<div class="ntf-bottom clearfix">
				<div class="ntf-bottom-settings">
					<a href="<?=site_url(USER_START_PAGE.'/profile/notifications');?>">настройки</a>
				</div>
				<div class="ntf-bottom-showall">
					<a href="<?=site_url(USER_START_PAGE.'/notifications');?>">показать все</a>
				</div>
			</div>
		</div>
	</li>
	<li>
		<figure>
			<a id="user-profile-link" href="<?=getMyProfileLink();?>">
				<img class="avatar<?=($this->uri->segment(2)=='profile')?' destination-photo':''?>" src="<?=site_url('loadimage/thumbnail/'.$this->account['id']);?>" alt="">
			</a>
		</figure>
		<a href="<?=site_url(USER_START_PAGE);?>"><?=$this->profile['name'].' '.$this->profile['surname'];?></a>
	</li>
	<li><a href="<?=site_url(USER_START_PAGE.'/balance');?>" id="user-balance" class="user-balance"><?=$this->profile['balance'];?> руб.</a></li>
	<li><?=anchor('log-off','Выйти',array('class'=>'exit'));?></li>
</ul>
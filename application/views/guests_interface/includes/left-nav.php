<nav>
	<ul>
		<li><a href="<?=site_url('editing');?>" class="left-box<?=($this->uri->segment(1) == 'editing')?' active':''?>" id="edit"><p>Редактирование</p></a></li>
		<li><a href="<?=site_url('typography');?>" class="left-box<?=($this->uri->segment(1) == 'typography')?' active':''?>" id="style"><p>Оформление</p></a></li>
		<li><a href="<?=site_url('translation');?>" class="left-box<?=($this->uri->segment(1) == 'translation')?' active':''?>" id="trans"><p>Перевод</p></a></li>
		<li><a href="<?=site_url('distribution');?>" class="left-box<?=($this->uri->segment(1) == 'distribution')?' active':''?>" id="dist"><p>Дистрибуция</p></a></li>
	</ul>
</nav>
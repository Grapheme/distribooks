<p>Здравствуйте!</p>
<p>
<?php if($bookName === FALSE):?>
	Вы получили в подарок несколько книг. Для получения подарка авторизуйтесь на сайте distribboks.com.<br/>
<?php else:?>
	Вы получили в подарок книгу "<?=$bookName;?>". Для получения подарка авторизуйтесь на сайте distribboks.com.<br/>
<?php endif;?>
	Логин: <?=$login;?><br/>
	Пароль: <?=$password;?><br/>
</p>
<p>Незаконное копирование и распространение объектов авторского права может влечь уголовную ответственность. </p>
<p>
--
С наилучшими пожеланиями,
команда <?=anchor('','DistribBooks',array('target'=>'_blank'));?>
</p>

<br/><hr/><br/>

<p>Hello,</p>
<p>
<?php if($bookName === FALSE):?>
	You received as a gift a few books. To take your gift please login on distribboks.com. <br/>
<?php else:?>
	You got a gift book "<?=$bookName;?>". To take your gift please login on distribboks.com. <br/>
<?php endif;?>
	Login: <?=$login;?><br/>
	Password: <?=$password;?><br/>
</p>
<p>Illegal copying and distribution of copyrighted works may entail criminal liability.</p>
<p>
--
With kind regards,<br/>
<?=anchor('','DistribBooks',array('target'=>'_blank'));?> Team
</p>
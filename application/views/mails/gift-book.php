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
<br/><br/>
--
Администрация <?=anchor('','Distribboks.com',array('target'=>'_blank'));?>.
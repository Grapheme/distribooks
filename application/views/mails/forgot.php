<p>Здравствуйте!</p>
<p>Кажется, Вы забыли свой пароль.</p>
<p>
	Для доступа к личному кабинету воспользуйтеся логином и паролем.<br/>
	Логин: id<?=$account['id'];?><br/>
	Пароль: <?=$password;?><br/>
</p>
<p>
--
С наилучшими пожеланиями,
команда <?=anchor('','DistribBooks',array('target'=>'_blank'));?>
</p>

<br/><hr/><br/>

<p>Hello,</p>
<p>
	It seems you forgot your password.
</p>
<p>
	To access your account please use the login and password.<br/>
	Login: id<?=$account['id'];?><br/>
	Password: <?=$password;?><br/>
</p>
<p>
--
With kind regards,<br/>
<?=anchor('','DistribBooks',array('target'=>'_blank'));?> Team
</p>
<p>Привет, <em><?=$data['name'].' '.$data['surname'];?></em>.</p>
Кажется, Вы забыли свой пароль. Пройди по <?=anchor('forgot/password/comfirm-code/'.$temporary_code,'ссылке',array('target'=>'_blank'));?>, чтобы создать новый.

<br/><br/>
--
Администрация <?=anchor('','Universiality',array('target'=>'_blank'));?>.
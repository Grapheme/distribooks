<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	$config = array(
		'signin' =>array(
			array('field'=>'email','label'=>'Логин','rules'=>'required|valid_email|trim'),
			array('field'=>'password','label'=>'Пароль','rules'=>'required|trim')
		),
		'signup' =>array(
			array('field'=>'name','label'=>'Имя','rules'=>'required|trim|xss_clean'),
			array('field'=>'surname','label'=>'Имя','rules'=>'required|trim|xss_clean'),
			array('field'=>'email','label'=>'Логин','rules'=>'required|valid_email|trim'),
			array('field'=>'password','label'=>'Пароль','rules'=>'required|min_length[6]|trim'),
			array('field'=>'confirm','label'=>'Повторите пароль','rules'=>'required|min_length[6]|matches[password]|trim'),
		)
	);
?>
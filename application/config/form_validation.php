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
		),
		'editing' => array(
			array('field'=>'yourself','label'=>'Introduce yourself','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'email','label'=>'Email','rules'=>'required|trim|valid_email'),
			array('field'=>'phone','label'=>'Phone','rules'=>'required|trim|xss_clean'),
			array('field'=>'message','label'=>'Message','rules'=>'required|trim|xss_clean'),
		),
		'news' => array(
			array('field'=>'page_address','label'=>'Адрес страницы','rules'=>'trim|alpha_dash')
		),
		'format_categoty' => array(
			array('field'=>'id','label'=>'ID','rules'=>'required|trim|integer'),
			array('field'=>'title','label'=>'Название','rules'=>'required|trim'),
			array('field'=>'sort','label'=>'Порядковый номер','rules'=>'trim|integer')
		),
		'format' => array(
			array('field'=>'title','label'=>'Название','rules'=>'required|trim'),
			array('field'=>'category','label'=>'Категория','rules'=>'required|trim|integer'),
			array('field'=>'sort','label'=>'Порядковый номер','rules'=>'trim|integer')
		),
		'author' =>array(
			array('field'=>'ru_name','label'=>'Имя','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'en_name','label'=>'Name','rules'=>'required|trim|htmlspecialchars|xss_clean'),
		),
	);
?>
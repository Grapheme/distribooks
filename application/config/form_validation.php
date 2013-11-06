<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	$config = array(
		'signin' =>array(
			array('field'=>'login','label'=>'Логин','rules'=>'required|trim'),
			array('field'=>'password','label'=>'Пароль','rules'=>'required|trim')
		),
		'signup' =>array(
			array('field'=>'email','label'=>'Логин','rules'=>'required|valid_email|trim'),
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
			array('field'=>'ru_title','label'=>'Название','rules'=>'required|trim'),
			array('field'=>'en_title','label'=>'Title','rules'=>'required|trim'),
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
		'genre' =>array(
			array('field'=>'ru_title','label'=>'Название','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'en_title','label'=>'Title','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'sort','label'=>'Порядковый номер','rules'=>'trim|integer')
		),
		'books' =>array(
			array('field'=>'ru_title','label'=>'Название','rules'=>'required|trim|htmlspecialchars|xss_clean'),
			array('field'=>'en_title','label'=>'Title','rules'=>'required|trim|htmlspecialchars|xss_clean'),
		),
		'book_caption' =>array(
			array('field'=>'sort','label'=>'Порядковый номер','rules'=>'trim|integer|xss_clean'),
			array('field'=>'number','label'=>'Номер книги','rules'=>'required|trim|integer|xss_clean'),
			array('field'=>'caption','label'=>'Подпись книги','rules'=>'trim|htmlspecialchars|xss_clean'),
			array('field'=>'format','label'=>'Формат','rules'=>'required|trim|integer|xss_clean'),
		),
		'buy_book' =>array(
			array('field'=>'book','label'=>'Номер книги','rules'=>'required|trim|integer')
		),
	);
?>
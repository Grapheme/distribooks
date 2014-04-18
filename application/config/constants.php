<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb');
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b');
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('PATH_SMILEYS',							getcwd().'/img/smileys');

define('BASE_LANG',								'ru');

define('ENGLAN',								'en');
define('RUSLAN',								'ru');

define('NO_IMAGE',								getcwd().'/img/icons/no-photo.png');
define('NO_IMAGE_THUMBNAIL',					getcwd().'/img/icons/no-photo-thumbnail.png');

define('NO_AVATAR',								getcwd().'/img/icons/no-avatar.png');
define('NO_AVATAR_THUMBNAIL',					getcwd().'/img/icons/no-avatar-thumbnail.png');

define('PER_PAGE_DEFAULT',						12);
define('MAX_BOOKS_IN_BASKET',					6);

define('TOOLTIP_FIELD_BLANK',					'data-trigger="manual" data-placement="right" role="tooltip" data-original-title="Поле не заполнено"');
define('TOOLTIP_FIELD_IMAGE_UPLOAD',			'data-trigger="hover" data-placement="top" role="tooltip" data-original-title="Нажмите для загрузки фотографии"');
define('TOOLTIP_BUTTON_EDIT',					'data-trigger="hover" data-placement="bottom" role="tooltip" data-original-title="Редактировать"');
define('TOOLTIP_BUTTON_DELETE',					'data-trigger="hover" data-placement="bottom" role="tooltip" data-original-title="Удалить"');
define('TEMPORARY',								getcwd().'/temporary/');

define('ADMIN_START_PAGE',						'admin-panel');
define('USER_START_PAGE',						'cabinet');

define('BASE_WIDTH',							960);
define('BASE_HEIGHT',							450);
define('BASE_THUMBNAIL_WIDTH',					120);
define('BASE_THUMBNAIL_HEIGHT',					120);
define('THUMBNAIL_PERCENT',						25);

define('ADMIN_GROUP_VALUE',						1);
define('USER_GROUP_VALUE',						2);

define('DOLLAR_RATE',							32.00);

define('TO_BASE_EMAIL',							'welcome@distribbooks.com');
define('FROM_BASE_EMAIL',						'no-reply@distribbooks.com');

define('ALLOWED_TYPES_DOCUMENTS',				'doc|docx|xls|xlsx|txt|pdf|ppt|pptx');
define('ALLOWED_TYPES_IMAGES',					'jpg|gif|jpeg|png');
define('ALLOWED_TYPES_BOOKS',					'*');

define('PAYU_MERCHANT',							'DISTMDDN');
define('PAYU_MERCHANT_LENGTH',					8);
define('PAYU_SECRET_KEY',						'O51N(yo7~?p2w5(x1(57');

define('OAUTH_VK',								'https://oauth.vk.com/authorize?client_id=4047214&response_type=code&redirect_uri=');
define('OAUTH_FACEBOOK',						'https://www.facebook.com/dialog/oauth?client_id=652720394760055&response_type=code&redirect_uri=');
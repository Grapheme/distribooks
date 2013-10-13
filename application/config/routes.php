<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "guests_interface";
$route['404_override'] = '';
/***************************************************** GENERAL INTRERFACE *************************************************/
$route['admin'] = "general_interface/signIN";
$route['login-in'] = "general_interface/loginIn";
$route['log-off'] = "general_interface/logoff";
$route['redactor/upload'] = "general_interface/redactorUploadImage";
$route['redactor/get-uploaded-images'] = "general_interface/redactorUploadedImages";
$route['publications/view-document/:any'] = "general_interface/showDocumentIco";
$route['load-image/avatar/:num'] = "general_interface/loadimage";
/********** sing in by social network *************/
$route['sign-in/vk'] = "general_interface/signInVK";
$route['sign-in/facebook'] = "general_interface/signInUpFacebook";
/*************************************************/
/*************************************************** AJAX INTRERFACE ***********************************************/

/*************************************************** ADMIN INTRERFACE ***********************************************/
$route[ADMIN_START_PAGE] = "admin_interface/controlPanel";
/* ----------------------------------------------- Pages ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/pages'] = "admin_interface/pagesList";
$route[ADMIN_START_PAGE.'/pages/:any/edit'] = "admin_interface/editPages";
/*************************************************** GUEST INTRERFACE ***********************************************/
$route['about'] = "guests_interface/about";
$route['catalog'] = "guests_interface/catalog";
$route['editing'] = "guests_interface/editing";
$route['typography'] = "guests_interface/typography";
$route['translation'] = "guests_interface/translation";
$route['distribution'] = "guests_interface/distribution";
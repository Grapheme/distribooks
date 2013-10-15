<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "guests_interface";
$route['404_override'] = '';
/***************************************************** GENERAL INTRERFACE *************************************************/
$route['admin'] = "global_interface/signIN";
$route['login-in'] = "global_interface/loginIn";
$route['log-off'] = "global_interface/logoff";
$route['redactor/upload'] = "global_interface/redactorUploadImage";
$route['redactor/get-uploaded-images'] = "global_interface/redactorUploadedImages";
$route['publications/view-document/:any'] = "global_interface/showDocumentIco";
$route['load-image/avatar/:num'] = "global_interface/loadimage";
/********** sing in by social network *************/
$route['sign-in/vk'] = "global_interface/signInVK";
$route['sign-in/facebook'] = "global_interface/signInUpFacebook";
/*************************************************/
/*************************************************** AJAX INTRERFACE ***********************************************/

/************************************************* ADMIN AJAX INTRERFACE *******************************************/
/* ---------------- news ----------------- */
$route[ADMIN_START_PAGE.'/news/insert'] = "admin_ajax_interface/insertNews";
$route[ADMIN_START_PAGE.'/news/update'] = "admin_ajax_interface/updateNews";
$route[ADMIN_START_PAGE.'/news/remove'] = "admin_ajax_interface/removeNews";


/*************************************************** ADMIN INTRERFACE ***********************************************/
$route[ADMIN_START_PAGE] = "admin_interface/controlPanel";
$route[ADMIN_START_PAGE.'/news/add'] = "admin_interface/addNews";
$route[ADMIN_START_PAGE.'/news/edit'] = "admin_interface/editNews";
$route[ADMIN_START_PAGE.'/news(\/:any)*?'] = "admin_interface/news";
/* ----------------------------------------------- Pages ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/pages'] = "admin_interface/pagesList";
$route[ADMIN_START_PAGE.'/pages/:any/edit'] = "admin_interface/editPages";
/*************************************************** GUEST INTRERFACE ***********************************************/
$route['news(\/:any)*?'] = "guests_interface/news";

$route['about'] = "guests_interface/about";
$route['catalog'] = "guests_interface/catalog";
$route['editing'] = "guests_interface/editing";
$route['typography'] = "guests_interface/typography";
$route['translation'] = "guests_interface/translation";
$route['distribution'] = "guests_interface/distribution";

$route[':any'] = "guests_interface/redirectPage";
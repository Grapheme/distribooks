<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "guests_interface";
$route['404_override'] = '';
/***************************************************** GENERAL INTRERFACE *************************************************/
$route['admin'] = "global_interface/signIN";
$route['login-in'] = "global_interface/loginIn";
$route['log-off'] = "global_interface/logoff";
$route['redactor/upload'] = "global_interface/redactorUploadImage";
$route['redactor/get-uploaded-images'] = "global_interface/redactorUploadedImages";
$route['book-format/:num'] = "global_interface/showDocumentIco";
$route['load-image/avatar/:num'] = "global_interface/loadimage";
/********** sing in by social network *************/
$route['sign-in/manual'] = "global_interface/loginIn";
$route['sign-up/manual'] = "global_interface/signUpManual";
$route['sign-in/vk'] = "global_interface/signInVK";
$route['sign-in/facebook'] = "global_interface/signInUpFacebook";
/*************************************************/
$route['search-authors-list'] = "global_interface/searchAuthor";
$route['search-genres-list'] = "global_interface/searchGenre";
$route['search-books-list'] = "global_interface/searchBook";
/***************************************************GUEST AJAX INTRERFACE ***********************************************/
$route['request-call'] = "guest_ajax_interface/requestCall";

$route['request-order-editing'] = "guest_ajax_interface/requestOrderEditing";
$route['request-do-editing'] = "guest_ajax_interface/requestDoEditing";

$route['request-order-clearance'] = "guest_ajax_interface/requestOrderClearance";
$route['request-do-clearance'] = "guest_ajax_interface/requestDoClearance";

$route['request-order-translation'] = "guest_ajax_interface/requestOrderTranslation";
$route['request-do-translation'] = "guest_ajax_interface/requestDoTranslation";

$route['request-order-distribution'] = "guest_ajax_interface/requestOrderDistribution";
$route['request-do-distribution'] = "guest_ajax_interface/requestDoDistribution";
/**************************************************** USER INTRERFACE **********************************************/
$route['cabinet'] = "users_interface/cabinet";
$route['cabinet/my-books(\/:any)*?'] = "users_interface/cabinet";
$route['download-book'] = "users_interface/downloadBookFile";
$route['buy-book'] = "user_ajax_interface/singleBuyBook";
$route['buy-books-in-basket'] = "user_ajax_interface/basketBuyBooks";
$route['add-book-in-basket'] = "user_ajax_interface/addBookInBasket";
$route['remove-book-in-basket'] = "user_ajax_interface/removeBookInBasket";
$route['refresh-books-in-basket'] = "user_ajax_interface/refreshBooksInBasket";
$route['clear-basket'] = "user_ajax_interface/clearBasket";
$route['set-book-rating'] = "user_ajax_interface/setBookRating";
/************************************************* ADMIN AJAX INTRERFACE *******************************************/
$route[ADMIN_START_PAGE.'/password-save'] = "admin_ajax_interface/adminSavePassword";
$route[ADMIN_START_PAGE.'/promo-save'] = "admin_ajax_interface/updatePromo";
/* ---------------- seo ------------------ */
$route[ADMIN_START_PAGE.'/seo/update'] = "admin_ajax_interface/updateSEO";
/* ---------------- news ----------------- */
$route[ADMIN_START_PAGE.'/news/insert'] = "admin_ajax_interface/insertNews";
$route[ADMIN_START_PAGE.'/news/update'] = "admin_ajax_interface/updateNews";
$route[ADMIN_START_PAGE.'/news/remove'] = "admin_ajax_interface/removeNews";
/* ---------------- formats ----------------- */
$route[ADMIN_START_PAGE.'/formats/category/update'] = "admin_ajax_interface/updateFormatCategory";
$route[ADMIN_START_PAGE.'/formats/insert'] = "admin_ajax_interface/insertFormat";
$route[ADMIN_START_PAGE.'/formats/update'] = "admin_ajax_interface/updateFormat";
$route[ADMIN_START_PAGE.'/formats/remove'] = "admin_ajax_interface/removeFormat";
/****************** authors ********************/
$route[ADMIN_START_PAGE.'/authors/insert'] = "admin_ajax_interface/insertAuthor";
$route[ADMIN_START_PAGE.'/authors/update'] = "admin_ajax_interface/updateAuthor";
$route[ADMIN_START_PAGE.'/authors/remove'] = "admin_ajax_interface/removeAuthor";
/****************** genres *********************/
$route[ADMIN_START_PAGE.'/genres/insert'] = "admin_ajax_interface/insertGenre";
$route[ADMIN_START_PAGE.'/genres/update'] = "admin_ajax_interface/updateGenre";
$route[ADMIN_START_PAGE.'/genres/remove'] = "admin_ajax_interface/removeGenre";
/****************** books *********************/
$route[ADMIN_START_PAGE.'/books/insert'] = "admin_ajax_interface/insertBook";
$route[ADMIN_START_PAGE.'/books/update'] = "admin_ajax_interface/updateBook";
$route[ADMIN_START_PAGE.'/books/remove'] = "admin_ajax_interface/removeBook";
$route[ADMIN_START_PAGE.'/books/uploading'] = "admin_ajax_interface/uploadBook";
$route[ADMIN_START_PAGE.'/books/remove/book'] = "admin_ajax_interface/removeBookFile";
$route[ADMIN_START_PAGE.'/books/caption'] = "admin_ajax_interface/captionBook";
/************************************************** ADMIN INTRERFACE ***********************************************/
$route[ADMIN_START_PAGE] = "admin_interface/controlPanel";
$route[ADMIN_START_PAGE.'/promo'] = "admin_interface/promoAction";
$route[ADMIN_START_PAGE.'/password'] = "admin_interface/changePassword";

$route[ADMIN_START_PAGE.'/news/add'] = "admin_interface/addNews";
$route[ADMIN_START_PAGE.'/news/edit'] = "admin_interface/editNews";
$route[ADMIN_START_PAGE.'/news(\/:any)*?'] = "admin_interface/news";

$route[ADMIN_START_PAGE.'/formats/categories'] = "admin_interface/formatsСategories";
$route[ADMIN_START_PAGE.'/formats/categories/edit'] = "admin_interface/formatsСategoriesEdit";
$route[ADMIN_START_PAGE.'/formats'] = "admin_interface/formats";
$route[ADMIN_START_PAGE.'/formats/add'] = "admin_interface/addFormat";
$route[ADMIN_START_PAGE.'/formats/edit'] = "admin_interface/editFormat";
/* ----------------------------------------------- Authors ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/authors(\/:any)*?'] = "admin_interface/authorsList";
$route[ADMIN_START_PAGE.'/authors/add'] = "admin_interface/insertAuthor";
$route[ADMIN_START_PAGE.'/authors/edit'] = "admin_interface/editAuthor";
/* ----------------------------------------------- Genres ----------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/genres(\/:any)*?'] = "admin_interface/genresList";
$route[ADMIN_START_PAGE.'/genres/add'] = "admin_interface/insertGenre";
$route[ADMIN_START_PAGE.'/genres/edit'] = "admin_interface/editGenre";
/* ----------------------------------------------- Books ----------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/books(\/:any)*?'] = "admin_interface/booksList";
$route[ADMIN_START_PAGE.'/books/add'] = "admin_interface/insertBook";
$route[ADMIN_START_PAGE.'/books/edit'] = "admin_interface/editBook";
$route[ADMIN_START_PAGE.'/books/upload'] = "admin_interface/uploadBooks";
/* ----------------------------------------------- seo ---------------------------------------------------------- */
$route[ADMIN_START_PAGE.'/seo'] = "admin_interface/pagesList";
$route[ADMIN_START_PAGE.'/seo/edit'] = "admin_interface/editPage";
/*************************************************** GUEST INTRERFACE ***********************************************/
$route['news(\/:any)*?'] = "guests_interface/news";
$route['search'] = "guests_interface/searchResults";

$route['about'] = "guests_interface/about";
$route['sale'] = "guests_interface/sale";
$route['catalog(\/:any)*?'] = "guests_interface/catalog";
$route['editing'] = "guests_interface/editing";
$route['typography'] = "guests_interface/typography";
$route['translation'] = "guests_interface/translation";
$route['distribution'] = "guests_interface/distribution";

$route['basket'] = "guests_interface/basket";

$route['formats'] = "guests_interface/formats";
$route[':any'] = "guests_interface/redirectPage";
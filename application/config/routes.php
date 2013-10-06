<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "guests_interface";
$route['404_override'] = '';
/*************************************************** GLOBAL INTERFACE ***********************************************/
$route['redactor/upload'] = "global_interface/redactorUploadImage";
$route['redactor/get-uploaded-images'] = "global_interface/redactorUploadedImages";
$route['signin/social-networks/link-accounts'] = "global_interface/signInSNLinkAccounts";
$route['registering/activation-code/:any'] = "global_interface/activationAccount";
$route['log-off'] = "global_interface/logoff";
$route['login-in'] = "global_interface/loginIn";
$route['registering'] = "global_interface/signUp";
$route['sign-in/vk'] = "global_interface/signInVK";
$route['sign-in/facebook'] = "global_interface/signInUpFacebook";
$route[USER_START_PAGE.'/balance/liqpay-server-replenishment'] = "global_interface/liqpayServerResponseReplenishment";
/*************************************************** ADMIN AJAX INTRERFACE ***********************************************/
$route[ADMIN_START_PAGE.'/notification/send'] = "admin_ajax_interface/sendNewMessage";
$route['registering/admin'] = "admin_ajax_interface/registerAdmin";
$route['change-account-status'] = "admin_ajax_interface/changeAccountStatus";
$route['change-account-expert-status'] = "admin_ajax_interface/changeAccountExpertStatus";
$route['change-request-expert-status'] = "admin_ajax_interface/changeRequestExpertStatus";
$route['admin/change-course-status'] = "admin_ajax_interface/changeAdminCourseStatus";
$route['change-project-modaration-status'] = "admin_ajax_interface/changeProjectModarationStatus";
/********************************************** COURSE PROJECT INTRERFACE ***********************************************/
/**************** statistics ********************/
$route['course/project/statistic/create-charts'] = "course_project_interface/createStatistisCharts";
/**************** remove items ********************/
$route['remove/course-from-favorite'] = "course_project_interface/removeItems";
$route['remove/project'] = "course_project_interface/removeItems";
/****************** projects *******************/
$route['course/project/manage-step-1'] = "course_project_interface/manageProjectStep1";
$route['course/upload/photo'] = "course_project_interface/uploadCoursePhoto";
$route[USER_START_PAGE.'/course/lesson/upload/resources'] = "course_project_interface/uploadLessonResources";
$route[USER_START_PAGE.'/course/lesson/remove/resources'] = "course_project_interface/removeLessonResources";
$route[USER_START_PAGE.'/course/lesson/upload/documents'] = "course_project_interface/uploadLessonDocuments";
$route[USER_START_PAGE.'/course/lesson/remove/documents'] = "course_project_interface/removeLessonDocuments";
$route['project/moderation/break'] = "course_project_interface/moderationBreak";
$route['course/manage-project'] = "course_project_interface/manageProject";
$route['course/manage-lesson'] = "course_project_interface/manageProjectLesson";
$route['project/lesson/clear/description'] = "course_project_interface/clearLessonDescription";
$route['project/lesson/clear/video'] = "course_project_interface/clearLessonVideo";
$route['project/lesson/clear/links'] = "course_project_interface/clearLessonLinks";
$route['course/manage-task'] = "course_project_interface/manageTask";
$route['task/upload/photo'] = "course_project_interface/uploadTaskPhoto";
$route['course/task/send-comment'] = "course_project_interface/taskSendComment";
$route['course/tasks/send-discussion-comment'] = "course_project_interface/tasksSendDiscussionComment";
$route['courses/change-on-market-status'] = "course_project_interface/changeOnMarketStatus";
/************** tasks *****************/
$route['project/my-task'] = "course_project_interface/manageProjectTask";
/*************************************************** MARKET INTRERFACE ***********************************************/
$route['course/send-review'] = "market_interface/courseSendReview";
$route['project/remove-my-course-review'] = "market_interface/removeMyCourseReview";
$route['courses/subscribe'] = "market_interface/courseSubscribe";
$route['lessons/lesson-passed'] = "market_interface/lessonPassed";
$route['courses/course-to-favorite'] = "market_interface/courseToFavorite";
$route['profile/to-favorite'] = "market_interface/profileToFavorite";
$route['project/task-me-laked'] = "market_interface/taskMeLaked";
$route['project/remove-my-task-comment'] = "market_interface/removeMyTaskComment";
/*************************************************** AJAX INTRERFACE ***********************************************/
/******************guest interface ********************/
$route['send-forgot-password'] = "ajax_interface/forgotPassword";
$route['send-new-password'] = "ajax_interface/sendNewPassword";
$route['valid/exist-email'] = "ajax_interface/existEmail";
$route['get-registering-data'] = "ajax_interface/getRegisteringData";
/******************users interface ********************/
$route['reset-notifications'] = "ajax_interface/resetCountNotifications";
$route['handling-request-expert'] = "ajax_interface/handlingRequestExpert";
$route['balance-replenishment'] = "ajax_interface/balanceReplenishment";
$route['balance/report'] = "ajax_interface/balanceReport";
$route['profile/unbind-account-sn'] = "ajax_interface/unbindAccountSn";
$route['settings/mail'] = "ajax_interface/settingsMail";
$route['settings/system'] = "ajax_interface/settingsSystem";
$route[USER_START_PAGE.'/profile/save'] = "ajax_interface/saveProfileData";
$route[USER_START_PAGE.'/profile/password/change'] = "ajax_interface/changeProfilePassword";
$route[USER_START_PAGE.'/profile/upload/photo'] = "ajax_interface/uploadProfilePhoto";
$route[USER_START_PAGE.'/profile/remove/photo'] = "ajax_interface/removeProfilePhoto";
$route[USER_START_PAGE.'/portfolio/upload/resource'] = "ajax_interface/uploadPortfolioResource";
$route[USER_START_PAGE.'/portfolio/remove/resource'] = "ajax_interface/removePortfolioResource";
/******************load view ********************/
$route['load-view/expert-statement'] = "ajax_interface/loadExpertStatement";
/*************************************************** GUEST INTRERFACE ***********************************************/
$route['clear-session'] = "guests_interface/clearSession";
$route['forgot/password'] = "guests_interface/forgotPassword";
$route['forgot/password/comfirm-code/:any'] = "guests_interface/setNewPassword";
/************** market *****************/
$route['market/projects'] = "guests_interface/market";
$route['market/get-resource'] = "guests_interface/getFileResource";
/************** courses ****************/
$route['courses/projects/:num/:any/lessons'] = "guests_interface/lessonsLandingPage";
$route['courses/projects/:num/:any'] = "guests_interface/projectLandingPage";
$route['project/preview/course/:num'] = "guests_interface/projectPreview";
$route['project/preview/course/:num/remoderation/:num'] = "guests_interface/projectPreview";
$route['project/preview/course/:num/lesson/:num'] = "guests_interface/lessonPreview";
$route['project/:any/lessons'] = "guests_interface/projectLessons";
$route['project/:any/list-of-signatories'] = "guests_interface/listOfSignatories";
$route['project/:any/discussions'] = "guests_interface/projectDiscussions";
$route['project/:any/reviews'] = "guests_interface/projectReviews";
/************** tasks *****************/
$route['project/:any/tasks'] = "guests_interface/projectTasks";
/*************************************/
$route['project/:any'] = "guests_interface/projectInformation";
/********** teachers *************/
$route['teachers'] = "guests_interface/teachersList";
/********** profile *************/
$route['profile'] = "guests_interface/viewProfile";
$route['profile/:any'] = "guests_interface/viewProfile";
/********** loading resources *************/
$route['loadimage/:any/:num'] = "guests_interface/loadimage";
$route['portfolio/view-resource/:any'] = "guests_interface/loadResource";
$route['project-lesson/view-resource/:any'] = "guests_interface/loadResource";
$route['project-lesson/view-document/:any'] = "guests_interface/showDocumentIco";
/***************************************************** guest footer **************************************************/
$route['about-project'] = "guests_interface/aboutProject";
$route['how-this-works'] = "guests_interface/howThisWorks";
$route['terms-of-service'] = "guests_interface/termsOfService";
$route['treaty-provision-of-educational-services'] = "guests_interface/treaty";
$route['help'] = "guests_interface/help";
$route['faq'] = "guests_interface/faq";
/*************************************************** ADMIN INTRERFACE ***********************************************/
$route[ADMIN_START_PAGE] = "admin_interface/control_panel";
$route[ADMIN_START_PAGE.'/profile'] = "admin_interface/profile";
/********** administrtors list *************/
$route[ADMIN_START_PAGE.'/accounts/administrators(\/:any)*?'] = "admin_interface/adminsList";
/********** users list *************/
$route[ADMIN_START_PAGE.'/accounts/users(\/:any)*?'] = "admin_interface/usersList";
/********** courses list *************/
$route[ADMIN_START_PAGE.'/courses/projects(\/:any)*?'] = "admin_interface/projectsCourses";
$route[ADMIN_START_PAGE.'/courses/unpublished(\/:any)*?'] = "admin_interface/unPublishedCourses";
/********** expert apply *************/
$route[ADMIN_START_PAGE.'/accounts/requests-for-expert(\/:any)*?'] = "admin_interface/requestsForExpert";
/********** registration *************/
$route[ADMIN_START_PAGE.'/get-resource'] = "admin_interface/getExpertResource";
/********** registration *************/
$route[ADMIN_START_PAGE.'/register/administrator'] = "admin_interface/registerAdministrator";
/********** notifications *************/
$route[ADMIN_START_PAGE.'/notifications/send-new-message'] = "admin_interface/notificationsNewMessage";
/*************************************************** USERS INTRERFACE ***********************************************/
/********** cabinet *************/
$route[USER_START_PAGE] = "users_interface/startPage";
$route[USER_START_PAGE.'/profile'] = "users_interface/profile";
$route[USER_START_PAGE.'/portfolio'] = "users_interface/portfolio";
$route[USER_START_PAGE.'/profile/password'] = "users_interface/profilePassword";
$route[USER_START_PAGE.'/profile/notifications'] = "users_interface/profileNotifications";
$route[USER_START_PAGE.'/profile/bind-account-vk'] = "users_interface/bindAccountVK";
$route[USER_START_PAGE.'/profile/bind-account-facebook'] = "users_interface/bindAccountFacebook";
$route[USER_START_PAGE.'/balance'] = "users_interface/balance";
$route[USER_START_PAGE.'/balance/reports'] = "users_interface/balanceReports";
$route[USER_START_PAGE.'/balance/withdrawal'] = "users_interface/balanceWithdrawal";
/********** notifications *************/
$route[USER_START_PAGE.'/notifications(\/:any)*?'] = "users_interface/notifications";
/************** study *****************/
$route[USER_START_PAGE.'/study/courses/projects'] = "users_interface/studyProjectsList";
$route[USER_START_PAGE.'/study/courses/tasks'] = "users_interface/studyTasksList";
$route[USER_START_PAGE.'/study/profiles'] = "users_interface/studyProfilesFavorites";
$route[USER_START_PAGE.'/study/profiles/iam-student'] = "users_interface/studyIamStudents";
$route[USER_START_PAGE.'/study/profiles/my-students'] = "users_interface/studyIamSubscribes";
/************** teach *****************/
$route[USER_START_PAGE.'/teach/courses/projects'] = "users_interface/teachProjectsList";
$route[USER_START_PAGE.'/teach/courses/statistic'] = "users_interface/teachProjectStatistic";

// НЕ РАБОЧИЕ ПО ПРИЧИНЕ ОТСУТСТВИЯ ФУНКЦИОНАЛА
$route[USER_START_PAGE.'/teach/courses/projects/subscribers'] = "users_interface/teachProjectsSubscibesList";
//
$route[USER_START_PAGE.'/teach/courses/manage/project/new'] = "users_interface/createNewProject";
$route[USER_START_PAGE.'/teach/courses/manage/project/edit'] = "users_interface/editProject";
$route[USER_START_PAGE.'/teach/courses/manage/project/remove'] = "users_interface/editProject";
$route[USER_START_PAGE.'/teach/courses/manage/remoderation/break'] = "users_interface/breakReModeration";
$route[USER_START_PAGE.'/teach/courses/webinars'] = "users_interface/teachWebinarsList";
$route[USER_START_PAGE.'/teach/courses/create/webinar'] = "users_interface/startManageWebinar";
$route[USER_START_PAGE.'/teach/courses/create/webinar/new'] = "users_interface/createNewWebinar";
/************** expert *****************/
$route[USER_START_PAGE.'/teach/request-for-expert'] = "users_interface/requestForExpert";
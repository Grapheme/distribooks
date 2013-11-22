<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	function isUserLoggined(){
		
		$CI = & get_instance();
		return $CI->isUserLoggined();
		
	}
	
	function isAdminLoggined(){
		
		$CI = & get_instance();
		return $CI->isAdminLoggined();
		
	}
?>
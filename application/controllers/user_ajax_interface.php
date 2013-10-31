<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		if($this->input->is_ajax_request() === FALSE):
			show_error('В доступе отказано');
		endif;
	}
	

}
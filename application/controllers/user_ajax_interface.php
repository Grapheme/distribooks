<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		if($this->input->is_ajax_request() === FALSE && $this->account['group'] == USER_GROUP_VALUE):
			show_error('В доступе отказано');
		endif;
	}
	
	public function buyBook(){
		
		if($this->postDataValidation('buy_book')):
			if($signedID = $this->buyBook($this->input->cookie('buy_book'))):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Книга куплена успешно';
				$this->json_request['redirect'] = site_url(USER_START_PAGE);
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
}
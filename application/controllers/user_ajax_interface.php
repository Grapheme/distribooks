<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		if($this->input->is_ajax_request() === FALSE && $this->account['group'] == USER_GROUP_VALUE):
			show_error('В доступе отказано');
		endif;
	}
	
	public function singleBuyBook(){
		
		if($this->postDataValidation('buy_book')):
			if($signedID = $this->buyBook($this->input->post('book'))):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Книга куплена успешно';
				$this->load->model('books_card');
				$this->json_request['redirect'] = site_url($this->uri->language_string.'/'.$this->books_card->value($this->input->post('book'),'page_address'));
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
}
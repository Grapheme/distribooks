<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guest_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		if($this->input->is_ajax_request() === FALSE):
			show_error('В доступе отказано');
		endif;
	}
	
	public function requestOrderEditing(){
		
		if($this->postDataValidation('editing')):
			$mailtext = $this->load->view('mails/services/order-editing',array('post'=>$this->input->post()),TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на редактирование',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function requestDoEditing(){
		
		if($this->postDataValidation('editing')):
			$mailtext = $this->load->view('mails/services/do-editing',array('post'=>$this->input->post()),TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на редактирование',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}

	public function requestOrderClearance(){
		
		if($this->postDataValidation('editing')):
			$mailtext = $this->load->view('mails/services/order-clearance',array('post'=>$this->input->post()),TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на оформление',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function requestDoClearance(){
		
		if($this->postDataValidation('editing')):
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$mailtext = $this->load->view('mails/services/do-clearance',array('post'=>$this->input->post()),TRUE);
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на офомление',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}

	public function requestOrderTranslation(){
		
		if($this->postDataValidation('editing')):
			$mailtext = $this->load->view('mails/services/order-translation',array('post'=>$this->input->post()),TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на перевод',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function requestDoTranslation(){
		
		if($this->postDataValidation('editing')):
			$mailtext = $this->load->view('mails/services/do-translation',array('post'=>$this->input->post()),TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на перевод',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}

	public function requestOrderDistribution(){
		
		if($this->postDataValidation('editing')):
			$mailtext = $this->load->view('mails/services/order-distribution',array('post'=>$this->input->post()),TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на перевод',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function requestDoDistribution(){
		
		if($this->postDataValidation('editing')):
			$mailtext = $this->load->view('mails/services/do-distribution',array('post'=>$this->input->post()),TRUE);
			$file = NULL;
			if(isset($_FILES['file']) && $_FILES['file']['error'] == 0):
				if(move_uploaded_file($_FILES['file']['tmp_name'],getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'])):
					$file = getcwd().'/'.TEMPORARY.'/'.$_FILES['file']['name'];
				endif;
			endif;
			$this->sendMail(TO_BASE_EMAIL,FROM_BASE_EMAIL,'Distribboks','Новый заказ на перевод',$mailtext,$file);
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}


}
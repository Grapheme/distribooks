<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
	
	function __construct(){
		
		parent::__construct();
		if(!$this->input->is_ajax_request() || $this->account['group'] != ADMIN_GROUP_VALUE):
			show_404();
		endif;
	}
	
	public function registerAdmin(){
		
		if($this->postDataValidation('email') == TRUE):
			if($this->accounts->search('email',$_POST['email']) == FALSE):
				$this->load->helper('string');
				$password = random_string('alnum',8);
				$account = array("vkid"=>0,"facebookid"=>0,"group"=>1,"account"=>0,"email"=>$_POST['email'],'default_photo'=>1,'password'=>md5($password),'active'=>1,'temporary_code'=>'','code_life'=>0,'language'=>$this->language);
				if($accountID = $this->insertItem(array('insert'=>$account,'model'=>'accounts'))):
					ob_start();?>
Здравствуйте <em>Администратор</em>,<br/>
Вы зарегистрированы на сайте UNIVERSIALITY (<?=base_url();?>).<br/>
Логин: <?=$_POST['email'];?><br/>
Пароль: <?=$password;?><br/>
				<?php $mailtext = ob_get_clean();
					$this->sendMail($_POST['email'],'system@universiality.com','Universiality','Вы зарегистрированы на сайте UNIVERSIALITY',$mailtext);
					$this->json_request['responseText'] = 'Пользователь зарегистрирован';
					$this->json_request['status'] = TRUE;
				endif;
			else:
				$this->json_request['responseText'] = 'Email уже зарегистрирован';
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
}
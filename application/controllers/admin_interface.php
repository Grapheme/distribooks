<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	var $offset = 0;
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus || ($this->account['group'] != ADMIN_GROUP_VALUE)):
			redirect('');
		endif;
	}
	
	/******************************************** cabinet *******************************************************/
	public function control_panel(){
		
		$pagevar = array(
			'message' => $this->session->userdata('message'),
		);
		$this->session->unset_userdata('message');
		$this->load->view("admin_interface/cabinet/control-panel",$pagevar);
	}
	
	public function profile(){
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			if($this->postDataValidation('password') == TRUE):
				$update = $this->input->post();
				$msgs = 'Профиль сохранен.';
				if($_FILES['photo']['error'] != 4):
					$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
					$update['photo'] = file_get_contents($_FILES['photo']['tmp_name']);
					$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,64,64);
					$update['thumbnail'] = file_get_contents($_FILES['photo']['tmp_name']);
				endif;
				$update['id'] = $this->user['uid'];
				$this->users->update_record($update);
				if(!empty($update['password'])):
					$this->users->update_field($this->user['uid'],'password',md5($update['password']),'users');
					$msgs .= ' Пароль изменен.';
				endif;
				$this->session->set_userdata('msgs',$msgs);
				redirect($this->uri->uri_string());
			else:
				$json_request['message'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
			endif;
		endif;
		$pagevar = array(
			'languages' => $this->manual_languages->visible_languages(),
			'profile' => $this->users->read_record($this->user['uid'],'users'),
		);
		$this->load->view("admin_interface/cabinet/profile",$pagevar);
	}
	/* -------------------------------------------------------------------------------------------------------- */
	public function adminsList(){
		
		$this->offset = intval($this->uri->segment(5));
		$pagevar = array(
			'users' => $this->accounts->limit($this->per_page,$this->offset,NULL,array('group'=>ADMIN_GROUP_VALUE,'id !='=>$this->account['id'])),
			'pagination' => $this->pagination(ADMIN_START_PAGE.'/accounts/administrators',5,$this->accounts->countAllResults(array('group'=>ADMIN_GROUP_VALUE,'id !='=>$this->account['id'])),$this->per_page),
		);
		$pagevar['users'] = $this->setActiveUsers($pagevar['users']);
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/lists/users/administrators",$pagevar);
	}
	
	public function registerAdministrator(){
		
		$this->load->view("admin_interface/register/administrator");
	}
	/* -------------------------------------------------------------------------------------------------------- */
	public function usersList(){
		
		$this->offset = intval($this->uri->segment(5));
		$this->load->model('users_accounts');
		$pagevar = array(
			'users' => $this->users_accounts->limit($this->per_page,$this->offset),
			'pagination' => $this->pagination(ADMIN_START_PAGE.'/accounts/users',5,$this->users_accounts->countAllResults(),$this->per_page),
		);
		$pagevar['users'] = $this->setActiveUsers($pagevar['users']);
		for($i=0;$i<count($pagevar['users']);$i++):
			$pagevar['users'][$i]['profile_page_address'] = $pagevar['users'][$i]['page_address'];
		endfor;
		$this->session->set_userdata('backpath',site_url(uri_string()));
		$this->load->view("admin_interface/lists/users/users",$pagevar);
	}
	/* -------------------------------------------------------------------------------------------------------- */
}
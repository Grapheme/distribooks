<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		if($this->input->is_ajax_request() === FALSE):
			show_error('В доступе отказано');
		endif;
	}
	
	public function existEmail(){
		
		$this->json_request['status'] = TRUE;
		if($this->accounts->search('email',$this->input->post('parametr'))):
			$this->json_request['status'] = FALSE;
		endif;
		echo json_encode($this->json_request);
	}
	/******************************************** guests interface *******************************************************/
	
	/******************************************** users interface *******************************************************/
	/*********************************************** profiles **********************************************************/
	public function uploadProfilePhoto(){
		
		if($this->postDataValidation('avatar') === TRUE):
			$validImage = $this->validationUploadImage(array('file_name'=>$_FILES['file']['tmp_name'],'min_width'=>200,'max_size'=>1000000));
			if($validImage['status'] == TRUE):
				if($this->CropAvatar(array('filepath'=>$_FILES['file']['tmp_name'],'x_axis'=>$this->input->post('x'),'y_axis'=>$this->input->post('y'),'width'=>$this->input->post('w'),'height'=>$this->input->post('h')))):
					$this->imageManupulation($_FILES['file']['tmp_name'],'width',TRUE,200,200);
					$avatarPath = getcwd().'/diskspace/user'.$this->account['id'].'/profile/';
					$resultUpload = $this->uploadSingleImage($avatarPath,'avatar');
					if($resultUpload['status'] == TRUE):
						$this->accounts->updateField($this->account['id'],'photo','diskspace/user'.$this->account['id'].'/profile/'.$resultUpload['uploadData']['file_name']);
						$this->imageManupulation($_FILES['file']['tmp_name'],'width',TRUE,64,64);
						$resultUpload = $this->uploadSingleImage($avatarPath,'thumbnail-avatar');
						$this->accounts->updateField($this->account['id'],'default_photo',0);
						if($resultUpload['status'] == TRUE):
							$this->accounts->updateField($this->account['id'],'thumbnail','diskspace/user'.$this->account['id'].'/profile/'.$resultUpload['uploadData']['file_name']);
							$this->load->helper('string');
							$this->json_request['responsePhotoSrc'] = site_url('loadimage/photo/'.$this->account['id'].'?'.random_string('alpha',5));
							$this->json_request['status'] = TRUE;
						endif;
					endif;
				endif;
			else:
				$this->json_request['responseText'] = $validImage['response'];
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeProfilePhoto(){
		
		if($this->loginstatus === FALSE && $this->account['group'] != USER_GROUP_VALUE):
			show_error('В доступе отказано');
		endif;
		$this->accounts->updateField($this->account['id'],'photo','');
		$this->accounts->updateField($this->account['id'],'thumbnail','');
		$this->accounts->updateField($this->account['id'],'default_photo',1);
		$this->load->helper('string');
		$this->json_request['responsePhotoSrc'] = site_url('loadimage/photo/'.$this->account['id'].'?'.random_string('alpha',5));
		$this->json_request['status'] = TRUE;
		echo json_encode($this->json_request);
		
	}
	
	public function saveProfileData(){
		
		if($this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		$this->json_request['responseProfilLink'] = '';
		if($this->postDataValidation('user_profile') == TRUE):
			$validPageAddress = $this->validationPageAddress($_POST['page_address']);
			if($validPageAddress['status'] === TRUE):
				$this->saveTextDataProfile($this->input->post());
				if($this->input->post('specialization_status') == 1):
					$this->saveSpecializationProfile();
				endif;
				if($this->input->post('languages_status') == 1):
					$this->saveLanguagesProfile();
				endif;
				$this->json_request['responseProfilLink'] = getMyProfileLink();
				$this->json_request['responseText'] = 'Сохранено';
				$this->json_request['status'] = TRUE;
			else:
				$this->json_request['responseText'] = $this->load->view('html/print-error',array('alert_header'=>FALSE,'message'=>$validPageAddress['responseText']),TRUE);
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function changeProfilePassword(){
		
		if($this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		if($this->postDataValidation('change_password') == TRUE):
			if($this->isNoMyPassword($_POST['oldpassword']) && $this->isMatchesPasswords()):
				$this->accounts->updateField($this->account['id'],'password',md5($_POST['newpassword']));
				$this->setNotification(array('type'=>'2','account'=>$this->account['id']));
				$this->json_request['responseText'] = 'Пароль изменен';
				$this->json_request['status'] = TRUE;
			else:
				$this->json_request['responseText'] = 'Текущий пароль неверен';
			endif;
		endif;
		echo json_encode($this->json_request);
	}
	
	public function balanceReplenishment(){
		
		if($this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		$this->json_request['responseXML'] = $this->json_request['responseSignature'] ='';
		if($this->postDataValidation('balance') == TRUE):
			if($transactionID = $this->writeToFinancialReport(19,$this->account['id'],intval($this->input->post('balance')))):
				$XML_RequestParams = array(
					'result_url' =>site_url(USER_START_PAGE.'/balance'),
					'server_url' =>site_url(USER_START_PAGE.'/balance/liqpay-server-replenishment'),
					'transactionID' => $transactionID,'summa' => $this->input->post('balance')
				);
				$XML_Request = $this->load->view('xml/liqpay_request_replenishment',$XML_RequestParams,TRUE);
				
				$this->json_request['responseXML'] = base64_encode($XML_Request);
				$this->json_request['responseSignature'] = base64_encode(sha1(LIQPAY_SIGNATURE.$XML_Request.LIQPAY_SIGNATURE,1));
				
				$this->load->helper('file');
				write_file(TEMPORARY.'liqpay-requestXML.txt',$XML_Request);
				write_file(TEMPORARY.'liqpay-requestXML64.txt',$this->json_request['responseXML']);
				write_file(TEMPORARY.'liqpay-request-signature.txt',LIQPAY_SIGNATURE.$XML_Request.LIQPAY_SIGNATURE);
				write_file(TEMPORARY.'liqpay-request-signature64.txt',$this->json_request['responseSignature']);
				
				$this->json_request['status'] = TRUE;
			endif;
//			$this->setMyAccountBalance(-intval($this->input->post('balance')));
//			$this->writeToFinancialReport(11,$this->account['id'],intval($this->input->post('balance')));
//			$this->json_request['balance'] = $this->profile['balance'].' руб.';
		endif;
		echo json_encode($this->json_request);
	}
	
	public function balanceReport(){
		
		if($this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		if($this->postDataValidation('financial_report') == TRUE):
			$this->json_request['status'] = TRUE;
			$this->load->model('financial_reports');
			$offset = ($this->input->post('page')-1)*PER_PAGE_DEFAULT;
			$where = array(
				'account'=>$this->account['id'],
				'date >='=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1 00:00:00",$this->input->post('period_begin')),
				'date <='=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1 23:59:59",$this->input->post('period_end'))
			);
			$report = $this->financial_reports->limit(PER_PAGE_DEFAULT,$offset,'date DESC',$where);
			$this->json_request['responseText'] = $this->load->view('html/financial-report',array('report'=>$report),TRUE);
			$this->json_request['responseText'] .= $this->AJAX_Pagination(array('page'=>$this->input->post('page'),'per_page'=>PER_PAGE_DEFAULT,'model'=>'financial_reports','where'=>$where));
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function unbindAccountSn(){
		
		if($this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		if($this->input->get('sn') !== FALSE && $this->input->get('mode') == 'unbind'):
			$this->accounts->updateField($this->account['id'],$this->input->get('sn').'id','');
			$this->accounts->updateField($this->account['id'],$this->input->get('sn').'_access_token','');
			$this->load->model(array('social_networks','users_social_networks'));
			if($SNID = $this->social_networks->search('nick_name',$this->input->get('sn'))):
				$this->users_social_networks->delete(NULL,array('account'=>$this->account['id'],'social_network'=>$SNID));
			endif;
			if($this->input->get('sn') == 'vk'):
				$this->json_request['responseText'] = OAUTH_VK.site_url(USER_START_PAGE.'/profile/bind-account-vk');
				$this->json_request['status'] = TRUE;
			elseif($this->input->get('sn') == 'facebook'):
				$this->json_request['responseText'] = OAUTH_FACEBOOK.site_url(USER_START_PAGE.'/profile/bind-account-facebook');
				$this->json_request['status'] = TRUE;
			endif;
		endif;
		echo json_encode($this->json_request);
	}
	
	private function saveTextDataProfile($post){
		
		$profileData = array("id"=>$this->account['id'],"name"=>$post['name'],"surname"=>$post['surname'],"gender"=>$post['gender'],
			"age"=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['age']),"time_zone"=>$post['time_zone']);
		/**************************************************************************************************************/
		$this->updateItem(array('update'=>$profileData,'model'=>'users_accounts'));
		if($this->accounts->updateField($this->account['id'],'page_address',$post['page_address'])):
			$this->profile = $this->users_accounts->getWhere($this->account['id']);
			$this->session->set_userdata('profile',json_encode($this->profile));
		endif;
		$profileData = array("id"=>$this->profile['account'],'about'=>$post['about'],'links'=>json_encode($post['links']));
		$this->updateItem(array('update'=>$profileData,'model'=>'users'));
		return TRUE;
	}

	private function saveLanguagesProfile(){
		
		$this->load->model('users_languages');
		$this->users_languages->delete(NULL,array('account'=>$this->account['id']));
		if(isset($_POST['languages'])):
			$profileData = array();
			for($i=0;$i<count($_POST['languages']);$i++):
				$profileData[] = array("account" => $this->account['id'],"language" => $_POST['languages'][$i]);
			endfor;
			$this->users_languages->multiInsertRecords($profileData);
		endif;
		return TRUE;
	}
	
	private function saveSpecializationProfile(){
		
		$this->load->model('users_specialization');
		$this->users_specialization->delete(NULL,array('account'=>$this->account['id']));
		if(isset($_POST['specialization'])):
			$profileData = array();
			for($i=0;$i<count($_POST['specialization']);$i++):
				$profileData[] = array("account" => $this->account['id'],"specialization" => $_POST['specialization'][$i]);
			endfor;
			$this->users_specialization->multiInsertRecords($profileData);
		endif;
		return TRUE;
	}
	
	private function isNoMyPassword($password){
		
		if(!empty($password)):
			$currentPassword = $this->accounts->value($this->account['id'],'password');
			if($currentPassword == md5($password)):
				return TRUE;
			endif;
		endif;
		return FALSE;
	}
	
	private function isMatchesPasswords(){
		
		if(isset($_POST['newpassword']) && isset($_POST['confirmpassword'])):
			if(md5($_POST['newpassword']) === md5($_POST['confirmpassword'])):
				return TRUE;
			endif;
		endif;
		return FALSE;
	}
	
	private function validationPageAddress($pageAddress){
		
		$request = array('status'=>FALSE,'responseText'=>'');
		if(!empty($pageAddress) && $this->accounts->search('page_address',$pageAddress,array('id !='=>$this->account['id']))):
			$request['responseText'] = 'Адрес cтраницы уже занят.';
		else:
			$request['status'] = TRUE;
		endif;
		return $request;
	}
}
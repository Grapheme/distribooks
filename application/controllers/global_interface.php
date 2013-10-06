<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Global_interface extends MY_Controller{
	
	function __construct(){

		parent::__construct();
	}
	
	/******************************************** SIGN IN|UP *******************************************************/
	public function loginIn(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('signin') == TRUE):
			if($user = $this->accounts->authentication($_POST['email'],$_POST['password'])):
				if($user['active']):
					$json_request['status'] = TRUE;
					$this->setLoginSession($user['id']);
					$this->clearTemporaryCode($user['id']);
					$json_request['responseText'] = $this->getAccountLoginBlock($user);
					if($this->session->userdata('current_url') !== FALSE && $this->session->userdata('current_url') != ''):
						$json_request['redirect'] = site_url($this->session->userdata('current_url'));
					endif;
				else:
					$json_request['responseText'] = 'Аккаунт не активирован';
				endif;
			else:
				$json_request['responseText'] = 'Неверный логин или пароль';
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function signUp(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'Ошибка при регистрации');
		if($this->postDataValidation('signup') == TRUE):
			if($this->accounts->search('email',$this->input->post('email')) === FALSE):
				if($accountInfo = $this->getRegisterAccount($_POST)):
					if($this->registerUserByVK($accountInfo['accountID'],$accountInfo['userID']) == TRUE):
						$this->session->unset_userdata('signinvk');
					elseif($this->registerUserByFaceBook($accountInfo['accountID'],$accountInfo['userID']) == TRUE):
						$this->session->unset_userdata('signinfb');
					endif;
					$this->createDir(getcwd().'/diskspace/user'.$accountInfo['userID']);
					$json_request['status'] = TRUE;
					$json_request['responseText'] = 'Круто! Вы зарегистрированы.<br/>Мы отправили на email cсылку для активации аккаунта.';
					$mailtext = $this->load->view('mails/signup',array('profile'=>$_POST,'activate_code'=>$accountInfo['activate_code']),TRUE);
					$this->sendMail($_POST['email'],'system@universiality.com','Universiality','Регистрация на UNIVERSIALITY',$mailtext);
				else:
					$json_request['responseText'] = 'Ошибка при регистрации. Повторите снова.';
				endif;
			else:
				$json_request['responseText'] = 'Email уже зарегистрирован';
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function signInSNLinkAccounts(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'Неверный логин или пароль');
		if($this->postDataValidation('signin') == TRUE):
			if($account = $this->accounts->authentication($this->input->post('email',TRUE),$this->input->post('password',TRUE))):
				if($account['active']):
					$result = FALSE;
					if($this->session->userdata('signinvk')):
						$signInVK = json_decode($this->session->userdata('signinvk'),TRUE);
						if(isset($signInVK['uid']) && $signInVK['uid']):
							$this->resetSNAccountID('vk',$signInVK['uid']);
							$result = $this->accounts->updateField($account['id'],'vkid',$signInVK['uid']);
							$result = $this->accounts->updateField($account['id'],'vk_access_token',$signInVK['access_token']);
							$this->setLinkVK($signInVK['screen_name'],$account['id']);
						endif;
					endif;
					if($this->session->userdata('signinfb')):
						$signInFB = json_decode($this->session->userdata('signinfb'),TRUE);
						if(isset($signInFB['id']) && $signInFB['id'] > 0):
							$this->resetSNAccountID('facebook',$signInFB['id']);
							$result = $this->accounts->updateField($account['id'],'facebookid',$signInFB['id']);
							$result = $this->accounts->updateField($account['id'],'facebook_access_token',$signInFB['access_token']);
							$this->setLinkFacebook($signInFB['link'],$account['id']);
						endif;
					endif;
					if($result):
						$this->setLoginSession($account['id']);
						$this->session->unset_userdata(array('signinvk'=>'','signinfb'=>''));
						$json_request['status'] = TRUE;
						$json_request['responseText'] = $this->getAccountLoginBlock($account);
					else:
						$json_request['responseText'] = 'Ошибка при авторизации через социальную сеть.';
					endif;
				else:
					$json_request['responseText'] = 'Аккаунт не активирован';
				endif;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function getRegisteringData(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'reg_data'=>array('snuid'=>0,'name'=>'','surname'=>'','email'=>'','time_zone'=>3,'contacts'=>'','photo'=>'','thumbnail'=>''));
		if($this->session->userdata('signinvk')):
			$data = json_decode($this->session->userdata('signinvk'),TRUE);
			if(isset($data['uid']) && $data['uid'] > 0):
				$json_request['reg_data']['snuid'] = $data['uid'];
				$json_request['reg_data']['name'] = isset($data['first_name'])?$data['first_name']:'';
				$json_request['reg_data']['surname'] = isset($data['last_name'])?$data['last_name']:'';
				$json_request['reg_data']['time_zone'] = isset($data['timezone'])?$data['timezone']:4;
				$json_request['reg_data']['photo'] = isset($data['photo_big'])?$data['photo_big']:'';
				$json_request['reg_data']['thumbnail'] = isset($data['photo'])?$data['photo']:'';
			endif;
		elseif($this->session->userdata('signinfb')):
			$data = json_decode($this->session->userdata('signinfb'),TRUE);
			if(isset($data['id']) && $data['id'] > 0):
				$json_request['reg_data']['snuid'] = $data['id'];
				$json_request['reg_data']['email'] = isset($data['email'])?$data['email']:'';
				$json_request['reg_data']['name'] = isset($data['first_name'])?$data['first_name']:'';
				$json_request['reg_data']['surname'] = isset($data['last_name'])?$data['last_name']:'';
				$json_request['reg_data']['time_zone'] = isset($data['timezone'])?$data['timezone']:4;
				$json_request['reg_data']['photo'] = isset($data['picture']['data']['url'])?$data['picture']['data']['url']:'';
				$json_request['reg_data']['thumbnail'] = isset($data['picture']['data']['url'])?$data['picture']['data']['url']:'';
			endif;
		endif;
		if($json_request['reg_data']['snuid'] > 0):
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	
	public function forgotPassword(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'');
		if($this->postDataValidation('email') == TRUE):
			if($userID = $this->accounts->search('email',$this->input->post('email'))):
				$account = $this->accounts->getWhere($userID);
				if($account['active']):
					$this->load->helper(array('string','date'));
					$temporary_code = random_string('alnum',25);
					$this->accounts->updateField($userID,'temporary_code',$temporary_code);
					if($result = $this->accounts->updateField($userID,'code_life',future_days())):
						$userInfo['name'] ='Администратор'; $userInfo['surname'] ='';
						$user = $this->accounts->getWhere($userID);
						if($user['group'] == USER_GROUP_VALUE):
							$this->load->model('users');
							$userInfo = $this->users->getWhere($user['account']);
							$name = $userInfo['name'].' '.$userInfo['surname'];
						endif;
						$mailtext = $this->load->view('mails/forgot',array('data'=>$userInfo,'temporary_code'=>$temporary_code),TRUE);
						$this->sendMail($_POST['email'],'system@universiality.com','Universiality','Восстановление доступа к сайту UNIVERSIALITY',$mailtext);
						$json_request['responseText'] = 'Мы отправили на email ссылку для изменения пароля.';
						$json_request['status'] = TRUE;
					endif;
				else:
					$json_request['responseText'] = 'Аккаунт не активирован';
				endif;
			else:
				$json_request['responseText'] = 'Email не зарегистрирован';
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function sendNewPassword(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'Невозможно назначить новый пароль');
		if($this->postDataValidation('password') == TRUE):
			if($this->loginstatus):
				$this->accounts->updateField($this->account['id'],'password',md5($this->input->post('password')));
				$json_request['responseText'] = 'Пароль сохранен';
				$json_request['status'] = TRUE;
			endif;
		else:
			$json_request['message'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function activationAccount(){

		if($accountID = $this->accounts->validationTemporaryCode($this->uri->segment(3))):
			$this->accounts->updateField($accountID,'temporary_code','');
			$this->accounts->updateField($accountID,'code_life',0);
			$this->accounts->updateField($accountID,'active',1);
			$this->setLoginSession($accountID);
			$this->load->model('users_accounts');
			$profile = $this->users_accounts->getWhere($accountID);
			$mailtext = $this->load->view('mails/after-activation-account',array('profile'=>$profile),TRUE);
			$this->sendMail($profile['email'],'system@universiality.com','Universiality','Регистрация на UNIVERSIALITY',$mailtext);
			$this->setNotification(array('type'=>1,'account'=>$accountID));
			$this->session->set_userdata('activation',TRUE);
			redirect('?mode=activation&status=1');
		else:
			redirect('');
		endif;
	}
	
	private function getRegisterAccount($post = NULL){
		if(!is_null($post)):
			$this->load->model('users');
			$this->load->helper(array('string','date'));
			$account = array();
			$account['userID'] = $this->users->insertRecord(array('expert'=>0,'name'=>$post['name'],'surname'=>$post['surname']));
			$account['activate_code'] = random_string('alnum',25);
			$account['accountID'] = $this->accounts->insertRecord(array('group'=>2,'account'=>$account['userID'],'email'=>$post['email'],'password'=>md5($post['password']),'signdate'=>date("Y-m-d H:i:s"),'language'=>$this->language,'temporary_code'=>$account['activate_code'],'code_life'=>future_days()));
			if($geoData = $this->setCountryCityLibraries()):
				$this->users->updateField($account['userID'],'country',$geoData['country']);
				$this->users->updateField($account['userID'],'city',$geoData['city']);
			endif;
			return $account;
		endif;
		return FALSE;
	}
	
	private function registerUserByVK($accountID,$userID){
		
		if($this->session->userdata('signinvk') !== FALSE):
			$signUpVK = json_decode($this->session->userdata('signinvk'),TRUE);
			if(isset($signUpVK['uid']) && $signUpVK['uid']):
				if(isset($signUpVK['photo_big']) && !empty($signUpVK['photo_big'])):
					$photo = file_get_contents($signUpVK['photo_big']);
					$this->accounts->updateField($accountID,'photo',$photo);
				endif;
				if(isset($signUpVK['photo']) && !empty($signUpVK['photo'])):
					$thumbnail = file_get_contents($signUpVK['photo']);
					$this->accounts->updateField($accountID,'thumbnail',$thumbnail);
				endif;
				if(isset($signUpVK['sex']) && !empty($signUpVK['sex'])):
					$this->users->updateField($userID,'gender',$signUpVK['sex']);
				endif;
				if(isset($signUpVK['bdate']) && !empty($signUpVK['bdate'])):
					$age = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$signUpVK['bdate']);
					if($age != FALSE && !empty($age)):
						$this->users->updateField($userID,'age',$age);
					endif;
				endif;
				$this->resetSNAccountID('vk',$signUpVK['uid']);
				$this->accounts->updateField($accountID,'vkid',$signUpVK['uid']);
				$this->accounts->updateField($accountID,'vk_access_token',$signUpVK['access_token']);
				$this->setLinkVK($signUpVK['screen_name'],$accountID);
				return TRUE;
			endif;
		endif;
		return FALSE;
	}
	
	private function registerUserByFaceBook($accountID,$userID){
		
		if($this->session->userdata('signinfb') !== FALSE):
			$signUpFB = json_decode($this->session->userdata('signinfb'),TRUE);
			if(isset($signUpFB['id']) && $signUpFB['id']):
				if(isset($signUpFB['picture']['data']['url']) && !empty($signUpFB['picture']['data']['url'])):
					$photo = file_get_contents($signUpFB['picture']['data']['url']);
					$this->accounts->updateField($accountID,'photo',$photo);
					$this->accounts->updateField($accountID,'thumbnail',$this->getImageContent($photo,array('dim'=>'width','ratio'=>TRUE,'width'=>60,'height'=>60)));
				endif;
				if(isset($signUpFB['gender']) && !empty($signUpFB['gender'])):
					if($signUpFB['gender'] == 'male'):
						$signUpFB['sex'] = 1;
					else:
						$signUpFB['sex'] = 2;
					endif;
					$this->users->updateField($userID,'gender',$signUpFB['sex']);
				endif;
				if(isset($signUpFB['birthday']) && !empty($signUpFB['birthday'])):
					$age = preg_replace("/(\d+)\/(\w+)\/(\d+)/i","\$3-\$1-\$2",$signUpFB['birthday']);
					if($age != FALSE && !empty($age)):
						$this->users->updateField($userID,'age',$age);
					endif;
				endif;
				$this->resetSNAccountID('facebook',$signUpFB['id']);
				$this->accounts->updateField($accountID,'facebookid',$signUpFB['id']);
				$this->accounts->updateField($accountID,'facebook_access_token',$signUpFB['access_token']);
				$this->setLinkFacebook($signUpFB['link'],$accountID);
				return TRUE;
			endif;
		endif;
		return FALSE;
	}
	/***************************************************************************************************************/
	public function signInVK(){
		
		if($vkontakte = $this->getVKontakteAccessToken($this->input->get('code'),site_url('sign-in/vk'))):
			if($VKontakteAccountInformation = $this->getVKontakteAccountInformation($vkontakte)):
				$VKontakteAccountInformation['access_token'] = $vkontakte['access_token'];
				if($userID = $this->accounts->search('vkid',$VKontakteAccountInformation['uid'])):
					$this->signInAccount($userID);
					$this->accounts->updateField($userID,'vk_access_token',$vkontakte['access_token']);
				else:
					$this->session->set_userdata(array('signinvk'=>json_encode($VKontakteAccountInformation),'link-account'=>TRUE));
					if($this->session->userdata('current_url') === FALSE || $this->session->userdata('current_url') == ''):
						redirect('?mode=link-account&status=1');
					elseif(strripos($this->session->userdata('current_url'),'?') === FALSE):
						redirect($this->session->userdata('current_url').'?mode=link-account&status=1');
					else:
						redirect($this->session->userdata('current_url').'&mode=link-account&status=1');
					endif;
				endif;
			else:
				show_error('Ошибка при авторизации. Попробуйте позже');
			endif;
		endif;
		redirect($this->session->userdata('current_url'));
	}
	
	public function signInUpFacebook(){
		
		if($accessToken = $this->getFaceBookAccessToken($this->input->get('code'),site_url('sign-in/facebook'))):
			if($faceBookAccountInformation = $this->getFaceBookAccountInformation($accessToken)):
				$faceBookAccountInformation['access_token'] = $accessToken;
				if($userID = $this->accounts->search('facebookid',$faceBookAccountInformation['id'])):
					$this->signInAccount($userID);
					$this->accounts->updateField($userID,'facebook_access_token',$accessToken);
				else:
					$this->session->set_userdata(array('signinfb'=>json_encode($faceBookAccountInformation),'link-account'=>TRUE));
					if($this->session->userdata('current_url') === FALSE || $this->session->userdata('current_url') == ''):
						redirect('?mode=link-account&status=1');
					elseif(strripos($this->session->userdata('current_url'),'?') === FALSE):
						redirect($this->session->userdata('current_url').'?mode=link-account&status=1');
					else:
						redirect($this->session->userdata('current_url').'&mode=link-account&status=1');
					endif;
				endif;
			else:
				show_error('Ошибка при авторизации. Попробуйте позже');
			endif;
		endif;
		redirect($this->session->userdata('current_url'));
	}
	
	private function signInAccount($userID){
		
		if($user = $this->accounts->getWhere($userID,array('active'=>1))):
			$this->setLoginSession($user['id']);
			$this->clearTemporaryCode($user['id']);
			return TRUE;
		endif;
		return FALSE;
	}
	/***************************************************************************************************************/
	public function logoff(){
		
		$this->clearSession(FALSE);
		$this->session->unset_userdata(array('logon'=>'','profile'=>'','account'=>'','backpath'=>'','current_url'=>''));
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('');
		endif;
	}
	
	public function redactorUploadImage(){
		
		if($this->loginstatus):
			if($this->account['group'] == 2):
				$uploadPath = 'diskspace/user'.$this->account['id'].'/download';
			else:
				$uploadPath = 'temporary/trashcan';
			endif;
			if(isset($_FILES['file']['name']) && $_FILES['file']['error'] === UPLOAD_ERR_OK):
				if($this->imageResize($_FILES['file']['tmp_name'])):
					$uploadResult = $this->uploadSingleImage(getcwd().'/'.$uploadPath);
					if($uploadResult['status'] === TRUE && !empty($uploadResult['uploadData'])):
						if($this->imageResize($_FILES['file']['tmp_name'],NULL,TRUE,100,100,TRUE)):
							$this->uploadSingleImage(getcwd().'/'.$uploadPath.'/thumbnail','thumb_'.$uploadResult['uploadData']['file_name']);
						endif;
						$file = array(
							'filelink'=>base_url($uploadPath.'/'.$uploadResult['uploadData']['file_name'])
						);
						echo stripslashes(json_encode($file));
					endif;
				endif;
			elseif($_FILES['file']['error'] !== UPLOAD_ERR_OK):
				$message['error'] = $this->getFileUploadErrorMessage($_FILES['file']);
				echo json_encode($message);
			endif;
		endif;
	}
	
	public function redactorUploadedImages(){
		
		if($this->loginstatus):
			if($this->account['group'] == 2):
				$uploadPath = 'diskspace/user'.$this->account['id'].'/download';
			else:
				$uploadPath = 'temporary/trashcan';
			endif;
			$fullList[0] = $fileList = array('thumb'=>'','image'=>'','title'=>'Изображение','folder'=>'Миниатюры');
			if($listDir = scandir($uploadPath)):
				$index = 0;
				foreach($listDir as $number => $file):
					if(is_file(getcwd().'/'.$uploadPath.'/'.$file)):
						$thumbnail = getcwd().'/'.$uploadPath.'/thumbnail/thumb_'.$file;
						if(file_exists($thumbnail) && is_file($thumbnail)):
							$fileList['thumb'] = site_url($uploadPath.'/thumbnail/thumb_'.$file);
						endif;
						$fileList['image'] = site_url($uploadPath.'/'.$file);
						$fullList[$index] = $fileList;
						$index++;
					endif;
				endforeach;
			endif;
			echo json_encode($fullList);
		endif;
	}
	
}
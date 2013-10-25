<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Global_interface extends MY_Controller{
	
	function __construct(){

		parent::__construct();
		$this->load->helper('language');
		$this->lang->load('localization/global',$this->languages[$this->uri->language_string]);
	}
	
	public function signIN(){
		
		$this->load->view("general_interface/signin");
	}
	
	public function loginIn(){
		
		if(!$this->input->is_ajax_request() && $this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('signin') == TRUE):
			if($user = $this->accounts->authentication($this->input->post('login'),$this->input->post('password'))):
				if($user['active']):
					$this->setLoginSession($user['id']);
					if($user['group'] == ADMIN_GROUP_VALUE):
						$json_request['redirect'] = site_url(ADMIN_START_PAGE);
					elseif($user['group'] == USER_GROUP_VALUE && isset($_SERVER['HTTP_REFERER'])):
						$json_request['redirect'] = $_SERVER['HTTP_REFERER'];
					endif;
					$json_request['status'] = TRUE;
				else:
					$json_request['responseText'] = lang('account_not_active');
				endif;
			else:
				$json_request['responseText'] = lang('auth_in_invalid');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function signUpManual(){
		
		if(!$this->input->is_ajax_request() && $this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('signup') == TRUE):
			if($this->accounts->search('email',$this->input->post('email')) === FALSE):
				if($userID = $this->registerUserManual($this->input->post())):
					$this->signInAccount($userID);
					$json_request['redirect'] = 'cabinet';
					$json_request['status'] = TRUE;
				endif;
			else:
				$json_request['responseText'] = lang('email_exists');
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>'Неверно заполнены поля'),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	public function logoff(){
		
		$this->session->unset_userdata(array('logon'=>'','profile'=>'','account'=>'','backpath'=>''));
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('');
		endif;
	}
	
	public function redactorUploadImage(){
		
		if($this->loginstatus):
			$uploadPath = 'download';
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
			$uploadPath = 'download';
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
	/********** sing in by social network *************/
	public function signInVK(){
				
		if($vkontakte = $this->getVKontakteAccessToken($this->input->get('code'),site_url($this->uri->language_string.'/sign-in/vk'))):
			if($VKontakteAccountInformation = $this->getVKontakteAccountInformation($vkontakte)):
				$VKontakteAccountInformation['access_token'] = $vkontakte['access_token'];
				if($userID = $this->accounts->search('vkid',$VKontakteAccountInformation['uid'])):
					$this->signInAccount($userID);
					$this->accounts->updateField($userID,'vk_access_token',$vkontakte['access_token']);
				else:
					if($userID = $this->registerUserByVK($VKontakteAccountInformation)):
						$this->signInAccount($userID);
					endif;
				endif;
			else:
				show_error('Ошибка при авторизации. Попробуйте позже');
			endif;
		endif;
		redirect($this->session->userdata('current_page').'#comments-form');
	}
	
	public function signInUpFacebook(){
		
		if($accessToken = $this->getFaceBookAccessToken($this->input->get('code'),site_url($this->uri->language_string.'/sign-in/facebook'))):
			if($faceBookAccountInformation = $this->getFaceBookAccountInformation($accessToken)):
				$faceBookAccountInformation['access_token'] = $accessToken;
				if($userID = $this->accounts->search('facebookid',$faceBookAccountInformation['id'])):
					$this->signInAccount($userID);
					$this->accounts->updateField($userID,'facebook_access_token',$accessToken);
				else:
					if($userID = $this->registerUserByFaceBook($faceBookAccountInformation)):
						$this->signInAccount($userID);
					endif;
				endif;
			else:
				show_error('Ошибка при авторизации. Попробуйте позже');
			endif;
		endif;
		redirect($this->session->userdata('current_page').'#comments-form');
	}
	
	private function signInAccount($userID){
		
		if($user = $this->accounts->getWhere($userID,array('active'=>1))):
			$this->setLoginSession($user['id']);
			return TRUE;
		endif;
		return FALSE;
	}
	/*************************************************************************************************************/
	private function registerUserManual($post){
		
		$insert = array('group'=>2,'email'=>$post['email'],'active'=>1,'language'=>1);
		if($accountID = $this->accounts->insertRecord($insert)):
			$this->load->helper('string');
			$password = random_string('alnum',12);
			$this->accounts->updateField($accountID,'password',md5($password));
			$mailtext = $this->load->view('mails/signup',array('login'=>'id'.$accountID,'password'=>$password),TRUE);
			$this->sendMail($post['email'],FROM_BASE_EMAIL,'Distribboks','Регистрация на distribbooks.ru',$mailtext);
			return $accountID;
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
	/*************************************************************************************************************/
	public function searchAuthor(){
		
		$json_request = json_encode(array());
		$this->load->model('authors');
		if($authors = $this->authors->searchAuthorsByChar($this->input->get('q'),RUSLAN)):
			$json_request = json_encode($authors);
		elseif($authors = $this->authors->searchAuthorsByChar($this->input->get('q'),ENGLAN)):
			$json_request = json_encode($authors);
		endif;
		echo $json_request;
	}
	
	public function searchGenre(){
		
		$json_request = json_encode(array());
		$this->load->model('genres');
		if($genres = $this->genres->searchGenresByChar($this->input->get('q'),RUSLAN)):
			$json_request = json_encode($genres);
		elseif($genres = $this->genres->searchGenresByChar($this->input->get('q'),ENGLAN)):
			$json_request = json_encode($genres);
		endif;
		echo $json_request;
	}
	
	public function searchBook(){
		
		$json_request = json_encode(array());
		$this->load->model('books');
		if($books = $this->books->searchBooksByChar($this->input->get('q'),RUSLAN)):
			$json_request = json_encode($books);
		elseif($books = $this->genres->searchBooksByChar($this->input->get('q'),ENGLAN)):
			$json_request = json_encode($books);
		endif;
		echo $json_request;
	}
}
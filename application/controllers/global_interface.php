<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Global_interface extends MY_Controller{
	
	function __construct(){

		parent::__construct();
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
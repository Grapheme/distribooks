<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Global_interface extends MY_Controller{
	
	function __construct(){

		parent::__construct();
		if($this->uri->language_string === FALSE):
			$this->uri->language_string = BASE_LANG;
		endif;
		$this->lang->load('localization/global',$this->languages[$this->uri->language_string]);
	}
	
	/*************************************************************************************************************/
	public function payuIPNRequest(){
		
		$this->load->helper('file');
		if($this->postDataValidation('payu_request')):
			$this->load->model('financial_reports');
			if($report = $this->financial_reports->getWhere($this->input->post('REFNOEXT'),array('transaction_status'=>0,'operation'=>1))):
				if($this->input->post('ORDERSTATUS') == 'PAYMENT_AUTHORIZED' || $this->input->post('ORDERSTATUS') == 'COMPLETE'):
//				 || $this->input->post('ORDERSTATUS') == 'TEST'
					if($account = $this->accounts->getWhere($report['account'],array('group'=>USER_GROUP_VALUE,'active'=>1))):
						write_file(TEMPORARY.'ipn-'.date("YmdHis").'-'.$report['account'].'.txt',json_encode($this->input->post()));
						if(!empty($report['books'])):
							if($booksIDs = json_decode($report['books'])):
								for($i=0;$i<count($booksIDs);$i++):
									$this->buyBook($booksIDs[$i],$report['account']);
								endfor;
								if(!empty($account['email'])):
									$mailtext = $this->load->view('mails/buy-book',array('account'=>$account),TRUE);
									$this->sendMail($account['email'],FROM_BASE_EMAIL,'Distribboks','Покупка книг на distribbooks.com',$mailtext);
								endif;
								$this->financial_reports->updateField($this->input->post('REFNOEXT'),'transaction_status',1);
								//$this->payuIDNRequest($this->input->post(),$report);
								echo $this->payuIPNResponse($this->input->post());
							endif;
						endif;
					endif;
				endif;
			endif;
		endif;
	}
	
	private function payuIPNResponse($pay_post){
		
		$IPN_date = date("YmdHis");
		$pid_id = 0; $pid_name = ''; $pid_date = '';
		if(isset($pay_post['IPN_PID'][0])):
			$pid_id = $pay_post['IPN_PID'][0];
		endif;
		if(isset($pay_post['IPN_PNAME'][0])):
			$pid_name = $pay_post['IPN_PNAME'][0];
		endif;
		if(isset($pay_post['IPN_DATE'])):
			$pid_date = $pay_post['IPN_DATE'];
		endif;
		
		$HASH = strlen($pid_id).$pid_id.strlen($pid_name).$pid_name.strlen($pid_date).$pid_date.strlen($IPN_date).$IPN_date;
		$IPN_Response = '<EPAYMENT>'.$IPN_date.'|MD5('.$HASH.')</EPAYMENT>';
		$IPN_Response_hash = '<EPAYMENT>'.$IPN_date.'|'.hash_hmac('md5',$HASH,PAYU_SECRET_KEY).'</EPAYMENT>';
		write_file(TEMPORARY.'ipn-response'.$IPN_date.'-'.$pid_id.'.txt',$IPN_Response);
		return $IPN_Response_hash;
	}
	
	private function payuIDNRequest($pay_post,$report){
		
		$transaction_time = date("Y-m-d H:i:s");
		$hesh = PAYU_MERCHANT_LENGTH.PAYU_MERCHANT.strlen($pay_post['REFNO']).$pay_post['REFNO'].strlen($report['summa']).$report['summa'].'3RUB'.strlen($transaction_time).$transaction_time;
		$curl_post = 'MERCHANT='.PAYU_MERCHANT.'&ORDER_REF='.$pay_post['REFNO'].'&ORDER_AMOUNT='.$report['summa'].'&ORDER_CURRENCY=RUB&IDN_DATE='.$transaction_time.'&ORDER_HASH='.hash_hmac('md5',$hesh,PAYU_SECRET_KEY);
		try{
			if($curl = curl_init()):
				curl_setopt($curl,CURLOPT_URL,'https://secure.payu.ru/order/idn.php');
				curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
				curl_setopt($curl,CURLOPT_POST,TRUE);
				curl_setopt($curl,CURLOPT_POSTFIELDS,$curl_post);
				$curl_out = curl_exec($curl);
				write_file(TEMPORARY.'idn-'.date("YmdHis").'-'.$report['account'].'.txt',$curl_out);
				curl_close($curl);
				return TRUE;
			endif;
			return FALSE;
		}catch (Exception $e){
			return FALSE;
		}
	}
	/*************************************************************************************************************/
	public function autoBuyBook(){
		
		if(!$this->input->is_ajax_request() && $this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($userID = $this->registerUserManual()):
			$this->signInAccount($userID);
			$json_request['redirect'] = site_url($this->uri->language_string.'/pay');
			$json_request['status'] = TRUE;
		endif;
		echo json_encode($json_request);
	}
	/*************************************************************************************************************/
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
				if($this->signInAccount($user['id'])):
					if($this->isAdminLoggined()):
						$json_request['redirect'] = site_url(ADMIN_START_PAGE);
					elseif($this->isUserLoggined()):
						if(!$json_request['redirect'] = $this->buySingleBook(FALSE)):
							$json_request['redirect'] = site_url(USER_START_PAGE);
						endif;
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
	
	public function forgot(){
		
		if(!$this->input->is_ajax_request() && $this->loginstatus === FALSE):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('signup') == TRUE):
			if($account = $this->accounts->getWhere(NULL,array('email'=>$this->input->post('email')))):
				$this->load->helper('string');
				$password = random_string('alnum',12);
				$this->accounts->updateField($account['id'],'password',md5($password));
				$mailtext = $this->load->view('mails/forgot',array('account'=>$account,'password'=>$password),TRUE);
				$this->sendMail($account['email'],FROM_BASE_EMAIL,'Distribboks','Восстановление доступа на distribbooks.com',$mailtext);
				$json_request['status'] = TRUE;
				$json_request['responseText'] = lang('forgot_email_success');
				$json_request['redirect'] = FALSE;
			else:
				$json_request['responseText'] = lang('forgot_email_notfound');
			endif;
		endif;
		echo json_encode($json_request);
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
	
	private function buySingleBook($pay = FALSE){
		
		if($this->input->cookie('buy_book') !== FALSE):
			if($pay === TRUE):
				if($signedID = $this->buyBook($this->input->cookie('buy_book'))):
					delete_cookie('buy_book');
					return $signedID;
				endif;
			else:
				return site_url($this->uri->language_string.'/pay');
			endif;
		endif;
		return FALSE;
	}
	/********** sing in by social network *************/
	public function signInVK(){
				
		if($vkontakte = $this->getVKontakteAccessToken($this->input->get('code'),site_url($this->uri->language_string.'/sign-in/vk'))):
			if($VKontakteAccountInformation = $this->getVKontakteAccountInformation($vkontakte)):
				$VKontakteAccountInformation['access_token'] = $vkontakte['access_token'];
				if($userID = $this->accounts->search('vkid',$VKontakteAccountInformation['uid'])):
					$this->signInAccount($userID);
					$this->accounts->updateField($userID,'vk_access_token',$vkontakte['access_token']);
					redirect('cabinet');
				else:
					if($userID = $this->registerUserByVK($VKontakteAccountInformation)):
						$this->signInAccount($userID);
						redirect('cabinet');
					endif;
				endif;
			endif;
		endif;
		redirect();
	}
	
	public function signInUpFacebook(){
		
		if($accessToken = $this->getFaceBookAccessToken($this->input->get('code'),site_url($this->uri->language_string.'/sign-in/facebook'))):
			if($faceBookAccountInformation = $this->getFaceBookAccountInformation($accessToken)):
				$faceBookAccountInformation['access_token'] = $accessToken;
				if($userID = $this->accounts->search('facebookid',$faceBookAccountInformation['id'])):
					$this->signInAccount($userID);
					$this->accounts->updateField($userID,'facebook_access_token',$accessToken);
					redirect('cabinet');
				else:
					if($userID = $this->registerUserByFaceBook($faceBookAccountInformation)):
						$this->signInAccount($userID);
						redirect('cabinet');
					endif;
				endif;
			endif;
		endif;
		redirect();
	}
	
	/*************************************************************************************************************/
	private function registerUserManual($post = NULL){
		
		if(is_null($post)):
			$post['email'] = '';
		endif;
		
		$insert = array('group'=>2,'email'=>$post['email'],'active'=>1);
		if($accountID = $this->accounts->insertRecord($insert)):
			$this->load->helper('string');
			$password = random_string('alnum',12);
			$this->accounts->updateField($accountID,'login','id'.$accountID);
			$this->accounts->updateField($accountID,'password',md5($password));
			if(!empty($post['email'])):
				$mailtext = $this->load->view('mails/signup',array('login'=>'id'.$accountID,'password'=>$password),TRUE);
				$this->sendMail($post['email'],FROM_BASE_EMAIL,'Distribboks','Регистрация на distribbooks.ru',$mailtext);
			endif;
			return $accountID;
		endif;
		return FALSE;
	}
	
	private function registerUserByVK($signUpVK){
		
		if(isset($signUpVK['uid']) && $signUpVK['uid']):
			$insert = array("group"=>2,"vkid"=>$signUpVK['uid'],"vk_access_token"=>$signUpVK['access_token'],'email'=>'','active'=>1);
			if($accountID = $this->accounts->insertRecord($insert)):
				$this->load->helper('string');
				$this->accounts->updateField($accountID,'login','id'.$accountID);
				$this->accounts->updateField($accountID,'password',md5(random_string('alnum',12)));
			endif;
			return $accountID;
		endif;
		return FALSE;
	}
	
	private function registerUserByFaceBook($signUpFB){
		
		if(isset($signUpFB['id']) && $signUpFB['id']):
			$insert = array("group"=>2,"facebookid"=>$signUpFB['id'],"facebook_access_token"=>$signUpFB['access_token'],'email'=>'','active'=>1);
			if($accountID = $this->accounts->insertRecord($insert)):
				$this->load->helper('string');
				$this->accounts->updateField($accountID,'login','id'.$accountID);
				$this->accounts->updateField($accountID,'password',md5(random_string('alnum',12)));
			endif;
			return $accountID;
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
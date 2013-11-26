<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	var $account = array('id'=>0,'group'=>0);
	var $profile = '';
	var $loginstatus = FALSE;
	var $account_basket = array('basket_books'=>array(),'basket_total_price'=>0);
	var $project_config = array('dollar_rate'=>32.00,'free_book'=>4,'count_free_book'=>1,'action_price'=>2000,'action_percent'=>10);
	
	var $baseURL = '';
	var $baseLanguageURL = RUSLAN;
	var $languages = array(RUSLAN=>'russian',ENGLAN=>'english');
	
	function __construct(){
		
		parent::__construct();
		$this->baseURL = base_url();
		if($sessionLogon = $this->session->userdata('logon')):
			if($this->account = json_decode($this->session->userdata('account'),TRUE)):
				if($this->session->userdata('profile') == FALSE):
					$profile = $this->accounts->getWhere($this->account['id']);
					if($profile && ($sessionLogon == md5($profile['email']))):
						$this->profile = $profile;
						$this->session->set_userdata('profile',json_encode($this->profile));
						$this->loginstatus = TRUE;
					endif;
				else:
					$this->profile = json_decode($this->session->userdata('profile'),TRUE);
					$this->loginstatus = TRUE;
				endif;
			endif;
		endif;
		$this->setProjectConfig();
	}
	
	public function clearSession($redirect = TRUE){
		
		if($this->session->userdata('signinvk') || $this->session->userdata('signinfb')):
			$this->session->unset_userdata(array('signinvk' => '','signinfb' => ''));
		endif;
		if($redirect == TRUE):
			redirect('');
		endif;
		return TRUE;
		
	}
	
	public function setLoginSession($accountID){
		
		if($accountInfo = $this->accounts->getWhere($accountID)):
			$this->account = array('id'=>$accountInfo['id'],'group'=>$accountInfo['group']);
			$this->session->set_userdata(array('logon'=>md5($accountInfo['email']),'account'=>json_encode($this->account)));
			$this->loginstatus = TRUE;
			return TRUE;
		endif;
		return FALSE;
	}

	public function getAccountBasketBooks(){
		
		$basket_exist = FALSE; $booksIDs = array();
		if($booksIDs = $this->getValuesBasketBooksCookie()):
			$basket_exist = TRUE;
		endif;
		if($this->loginstatus === TRUE && $basket_exist === FALSE):
			$basket = $this->accounts->value($this->account['id'],'basket');
			if(!empty($basket)):
				if($booksIDs = json_decode($basket,TRUE)):
					set_cookie('basket_books',$basket,time()+86500,'','/');
					set_cookie('basket_total_price',$this->getBooksPrice($booksIDs),time()+86500,'','/');
					$basket_exist = TRUE;
				endif;
			endif;
		endif;
		if($basket_exist === TRUE && !empty($booksIDs)):
			$this->account_basket['basket_books'] = $booksIDs;
			$this->account_basket['basket_total_price'] = $this->getBooksPrice($booksIDs);
			
			return $booksIDs;
		endif;
	}

	public function setProjectConfig(){
		
		if($this->input->cookie('project_config') !== FALSE):
			if($project_config = json_decode($this->input->cookie('project_config'),TRUE)):
				$this->project_config = $project_config;
			endif;
		else:
			$this->load->model('configuration');
			if($project_config = $this->configuration->getWhere(1)):
				$this->project_config = $project_config;
				set_cookie('project_config',json_encode($project_config),time()+86500,'','/');
			endif;
		endif;
		return TRUE;
	}

	public function isUserLoggined(){
		
		if($this->loginstatus === TRUE && $this->account['group'] == USER_GROUP_VALUE):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	public function isAdminLoggined(){
		
		if($this->loginstatus === TRUE && $this->account['group'] == ADMIN_GROUP_VALUE):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	/*************************************************************************************************************/
	public function getVKontakteAccessToken($code,$redirect){
		
		$url = "https://oauth.vk.com/access_token?client_id=3955363&client_secret=T08z8CWN82QxY5pl4S1r&code=".$code."&redirect_uri=".$redirect;
		$VKontakteResponse = json_decode($this->getCurlLink($url),TRUE);
		if(isset($VKontakteResponse['access_token'])):
			return $VKontakteResponse;
		else:
			return FALSE;
		endif;
	}
	
	public function getVKontakteAccountInformation($vkontakte){
		
		$url = "https://api.vk.com/method/getProfiles?uid=".$vkontakte['user_id']."&fields=photo,photo_big,sex,bdate,contacts,timezone,screen_name&access_token=".$vkontakte['access_token'];
		$VKontakteResponse = json_decode($this->getCurlLink($url),TRUE);
		if(isset($VKontakteResponse['response'][0])):
			return $VKontakteResponse['response'][0];
		else:
			return FALSE;
		endif;
	}
	
	public function getFaceBookAccessToken($code,$redirect){
		
		$url = "https://graph.facebook.com/oauth/access_token?client_id=652720394760055&client_secret=85181c616f569ab39edb2e9a9ceffbd8&code=".$code."&redirect_uri=".$redirect;
		$FaceBookResultString = $this->getCurlLink($url);
		$FaceBookResultArray = explode('&',$FaceBookResultString);
		$accessToken = explode('=',$FaceBookResultArray[0]);
		if(!empty($accessToken[1])):
			return $accessToken[1];
		else:
			return FALSE;
		endif;
	}
	
	public function getFaceBookAccountInformation($token){
		
		$url = "https://graph.facebook.com/me?fields=id,first_name,email,last_name,timezone,gender,birthday,link,picture.width(200).height(200)&access_token=".$token;
		$FaceBookResponse = $this->getCurlLink($url);
		$response = json_decode($FaceBookResponse,TRUE);
		if(isset($response['id'])):
			return $response;
		endif;
		return FALSE;
	}
	
	public function resetSNAccountID($SN,$value){
		
		if($SNAccountID = $this->accounts->search($SN.'id',$value)):
			$this->accounts->updateField($SNAccountID,$SN.'id','');
			$this->accounts->updateField($SNAccountID,$SN.'_access_token','');
		endif;
	}
	/*************************************************************************************************************/
	public function pagination($url,$uri_segment,$total_rows,$per_page,$get_string = FALSE){
		
		$this->load->library('pagination');
		if($get_string):
			$config['base_url'] = site_url($url); //передавать полностью строку с get параметрами
			$config['page_query_string'] = TRUE;
			$config['query_string_segment'] = 'offset';
		else:
			$config['base_url'] = site_url($url.'/offset/');
		endif;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['num_links'] = 4;
		$config['first_link'] = 'В начало';
		$config['last_link'] = 'В конец';
		$config['next_link'] = 'Далее &raquo;';
		$config['prev_link'] = '&laquo; Назад';
		$config['cur_tag_open'] = '<li class="pagination-list-item active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_open'] = '<div class="pagination"><ul class="pagination-list">';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_tag_open'] = '<li class="pagination-list-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="pagination-list-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="pagination-list-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pagination-list-item">';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="pagination-list-item">';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	
	public function AJAX_Pagination(){
		
		$arguments = &func_get_args();
		$model = (isset($arguments[0]['model']))?$arguments[0]['model']:NULL;
		$where = (isset($arguments[0]['where']))?$arguments[0]['where']:NULL;
		$perPage = (isset($arguments[0]['per_page']))?$arguments[0]['per_page']:PER_PAGE_DEFAULT;
		$currentPage = (isset($arguments[0]['page']))?$arguments[0]['page']:1;
		
		$pagination = '';
		if(!is_null($model)):
			$this->load->model($model);
			$count = $this->$model->countAllResults($where);
			if(!empty($count)):
				$pagination = $this->load->view('html/pagination',array('pages'=>ceil($count/PER_PAGE_DEFAULT),'page'=>$currentPage),TRUE);
			endif;
		endif;
		return $pagination;
	}
	
	public function sendMail($to,$from_mail,$from_name,$subject,$text,$attach = NULL){
		
		$this->load->library('phpmailer');
		$mail = new PHPMailer();
		
//		$mail->SMTPDebug = 1;
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.yandex.ru";
		$mail->Port = 465;
		$mail->Username = "distribbooks@yandex.ru";
		$mail->Password = "gfd688NNDNS";
		
		$mail->AddReplyTo($from_mail,$from_name);
		$mail->AddAddress($to);
		$mail->SetFrom($from_mail,$from_name);
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->AltBody = strip_tags($text,'<p>,<br>,<strong>');
		$mail->MsgHTML($text);
		if(!is_null($attach) && file_exists($attach)):
			$mail->AddAttachment($attach);
		endif;
		return $mail->Send();
	}
	
	public function loadimage(){
		
		$image = ''; $filePath = NULL;
		switch($this->uri->segment(2)):
			case 'photo':$filePath = $this->accounts->value($this->uri->segment(3),'photo'); break;
			case 'thumbnail':$filePath = $this->accounts->value($this->uri->segment(3),'thumbnail'); break;
			case 'course':$this->load->model('courses'); $filePath = $this->courses->value($this->uri->segment(3),'image'); break;
			case 'course-thumbnail':$this->load->model('courses'); $filePath = $this->courses->value($this->uri->segment(3),'thumbnail'); break;
			case 'course-remoderation-thumbnail':$this->load->model('project_moderation'); $filePath = $this->project_moderation->value($this->uri->segment(3),'thumbnail'); break;
			case 'course-remoderation':$this->load->model('project_moderation'); $filePath = $this->project_moderation->value($this->uri->segment(3),'image'); break;
			case 'social-networks':$this->load->model('social_networks'); $image = $this->social_networks->getImage($this->uri->segment(3),'image'); break;
			case 'project-task-thumbnail':$this->load->model('project_tasks'); $filePath = $this->project_tasks->value($this->uri->segment(3),'thumbnail'); break;
			case 'project-task':$this->load->model('project_tasks'); $filePath = $this->project_tasks->value($this->uri->segment(3),'image'); break;
		endswitch;
		if(!is_null($filePath) && is_file(getcwd().'/'.$filePath)):
			$image = file_get_contents(getcwd().'/'.$filePath);
		endif;
		if(empty($image)):
			switch($this->uri->segment(2)):
				case 'photo': $image = file_get_contents(NO_AVATAR); break;
				case 'thumbnail': $image = file_get_contents(NO_AVATAR_THUMBNAIL); break;
				case 'course': $image = file_get_contents(NO_COURSE); break;
				case 'course-thumbnail': $image = file_get_contents(NO_COURSE_THUMBNAIL); break;
				case 'course-remoderation-thumbnail': $image = file_get_contents(NO_COURSE_THUMBNAIL); break;
				case 'course-remoderation': $image = file_get_contents(NO_COURSE); break;
				case 'social-networks': $image = file_get_contents(NO_IMAGE_THUMBNAIL); break;
				case 'project-task-thumbnail': $image = file_get_contents(NO_TASK_THUMBNAIL); break;
				case 'project-task': $image = file_get_contents(NO_TASK); break;
				default : $image = file_get_contents(NO_IMAGE_THUMBNAIL);
			endswitch;
		endif;
		header('Content-type: image/jpeg');
		echo $image;
	}
	
	public function loadResource(){
		
		$resource = NULL;
		if($this->input->get('resource_id') != FALSE && is_numeric($this->input->get('resource_id'))):
			switch($this->uri->segment(1)):
				case 'portfolio': 
					$this->load->model('users_portfolio');
					$record = $this->users_portfolio->getWhere($this->input->get('resource_id'));
					break;
				case 'project-lesson':
					$this->load->model('project_lesson_resources');
					if($record = $this->project_lesson_resources->getWhere($this->input->get('resource_id'))):
						if($this->isMyCourse($record['course']) != FALSE):
							$record['account'] = $this->account['id'];
						elseif($this->account['group'] == ADMIN_GROUP_VALUE):
							$this->load->model('courses');
							$record['account'] = $this->courses->value($record['course'],'account');
						elseif($result = $this->isMySubscribeInCourses(array($record))):
							if(isset($result[0]['mysubscribe']) && $result[0]['mysubscribe'] === TRUE):
								$this->load->model('courses');
								$record['account'] = $this->courses->value($record['course'],'account');
							else:
								$record = NULL;
							endif;
						endif;
					endif;
					break;
			endswitch;
			if(!is_null($record) && isset($record)):
				$filePath = getcwd().'/diskspace/user'.$record['account'].'/'.$record['resource'];
				if(is_file($filePath)):
					$resource = file_get_contents(getcwd().'/diskspace/user'.$record['account'].'/'.$record['resource']);
				endif;
			endif;
		endif;
		if(is_null($resource)):
			$resource = file_get_contents(NO_IMAGE);
		endif;
		header('Content-type: image/jpeg');
		echo $resource;
	}
	
	public function showDocumentIco(){
		
		$ico = NULL;
		if($this->uri->segment(2)):
			$this->load->model('formats');
			if($record = $this->formats->getWhere($this->uri->segment(2))):
				if(!empty($record['image'])):
					$ico = file_get_contents(getcwd().'/'.$record['image']);
				endif;
			endif;
		endif;
		if(is_null($ico)):
			$ico = file_get_contents(getcwd().'/img/unknown.png');
		endif;
		header('Content-type: image/jpeg');
		echo $ico;
	}
	
	public function imageManupulation($userfile,$dim = 'width',$ratio = TRUE,$width = 60,$height = 60){
		
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $userfile;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = $ratio;
		$config['master_dim'] = $dim;
		$config['width'] = $width;
		$config['height'] = $height;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	public function imageResize($filePath,$dim = NULL,$no_more = FALSE,$user_width = NULL,$user_height = NULL,$create_thumb = FALSE){
		
		if(is_file($filePath)):
			list($width,$height,$type) = getimagesize($filePath);
			if(!is_null($user_width) && !is_null($user_height)):
				if($no_more === TRUE):
					if($width > $user_width):
						$width = $user_width;
					endif;
					if($height > $user_height):
						$height = $user_height;
					endif;
				else:
					$width = $user_width;
					$height = $user_height;
				endif;
			endif;
			if(is_null($dim)):
				if($width > $height):
					$dim = 'width';
				else:
					$dim = 'height';
				endif;
			endif;
			if($create_thumb === TRUE):
				$width = round(($width*THUMBNAIL_PERCENT)/100,0);
				$height = round(($height*THUMBNAIL_PERCENT)/100,0);
				$max_width = (!is_null($user_width))?$user_width:BASE_THUMBNAIL_WIDTH;
				$max_height = (!is_null($user_height))?$user_height:BASE_THUMBNAIL_HEIGHT;
				if($width < $max_width):
					$width = $max_width;
				endif;
				if($height < $max_height):
					$height = $max_height;
				endif;
			else:
				if($width > BASE_WIDTH && $no_more === FALSE):
					$width = BASE_WIDTH;
				endif;
				if($height > BASE_HEIGHT && $no_more === FALSE):
					$height = BASE_HEIGHT;
				endif;
			endif;
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $filePath;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['master_dim'] = $dim;
			$config['width'] = $width;
			$config['height'] = $height;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			return TRUE;
		else:
			return FALSE;
		endif;
		
	}
	
	public function CropToSquare(){
		
		$arguments = &func_get_args();
		$fileName = (isset($arguments[0]['filepath']))?$arguments[0]['filepath']:NULL;
		$edgeWidth = (isset($arguments[0]['edgeSize']))?$arguments[0]['edgeSize']:800;
		$copy = (isset($arguments[0]['copy']))?TRUE:FALSE;
		
		if(!is_null($fileName) && is_file($fileName)):
			$this->load->library('images');
			$newFile = FALSE;
			if($copy === TRUE):
				$this->load->helper('string');
				$newFile = getcwd().'/temporary/'.random_string('alnum',12).'.tmp';
			endif;
			if($this->images->cropToSquare($fileName,$edgeWidth,$edgeWidth,$newFile)):
				if($copy === TRUE):
					return $newFile;
				else:
					return TRUE;
				endif;
			endif;
		endif;
		return FALSE;
	}
	
	public function getImageContent($content = NULL,$manupulation = NULL){
		
		if(!is_null($content)):
			$filepath = TEMPORARY.'file-content.tmp';
			file_put_contents($filepath,$content);
			if(!is_null($manupulation) && is_array($manupulation)):
				$this->imageManupulation($filepath,$manupulation['dim'],$manupulation['ratio'],$manupulation['width'],$manupulation['height']);
			endif;
			$fileContent = file_get_contents($filepath);
			$this->filedelete($filepath);
			return $fileContent;
		else:
			return '';
		endif;
	}
	
	public function validationUploadImage(){
		
		$arguments = &func_get_args();
		$fileName = (isset($arguments[0]['file_name']))?$arguments[0]['file_name']:$_FILES['file']['tmp_name'];
		$minWidth = (isset($arguments[0]['min_width']))?$arguments[0]['min_width']:NULL;
		$maxWidth = (isset($arguments[0]['max_width']))?$arguments[0]['max_width']:NULL;
		$onlyWide = (isset($arguments[0]['only_wide']))?$arguments[0]['only_wide']:FALSE;
		$maxSize = (isset($arguments[0]['max_size']))?$arguments[0]['max_size']:NULL;
		$return = array('status'=>FALSE,'response'=>'');
		if(!is_null($fileName) && is_file($fileName)):
			$fileSize = getimagesize($fileName);
			$acceptedTypes = array('image/png','image/jpeg','image/gif');
			if(array_search($fileSize['mime'],$acceptedTypes) !== FALSE):
				if(!is_null($minWidth)):
					if($fileSize[0] >= $minWidth):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Ширина меньше '.$minWidth.'px';
					endif;
				endif;
				if(!is_null($maxWidth)):
					if($fileSize[0] <= $maxWidth):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Ширина больше '.$maxWidth.'px';
					endif;
				endif;
				if($return['status'] == TRUE && $onlyWide === TRUE):
					if($fileSize[0] > $fileSize[1]):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Ширина меньше высоты';
					endif;
				endif;
				if($return['status'] == TRUE && !is_null($maxSize)):
					if(filesize($fileName) < $maxSize):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Размер более '.round($maxSize/1048576).'Мб';
					endif;
				endif;
			endif;
		endif;
		return $return;
	}
	
	public function uploadSingleImage($uploadPath = NULL,$file_name = NULL){
		
		$uploadStatus = array('status'=>FALSE,'message'=>'','uploadData'=>array());
		if(is_null($uploadPath) || ($this->createDir($uploadPath) == FALSE)):
			$uploadPath = NULL;
		endif;
		if(!is_null($uploadPath)):
			if(!empty($_FILES)):
				$this->load->library('upload');
				$this->load->helper('string');
				$config = array();
				$config['upload_path'] = $uploadPath.'/';
				$config['allowed_types'] = ALLOWED_TYPES_IMAGES;
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;
				$config['max_size'] = 5120;
				if(is_null($file_name)):
					$config['file_name'] = random_string('nozero',12).'.'.substr(strrchr($_FILES['file']['name'], '.'),1);
				else:
					$config['file_name'] = $file_name.'.'.substr(strrchr($_FILES['file']['name'], '.'),1);
				endif;
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('file')):
					$uploadStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Файл: '.$_FILES['file']['name'],'message'=>$this->upload->display_errors()),TRUE);
				else:
					$uploadStatus['uploadData'] = $this->upload->data();
					$uploadStatus['status'] = TRUE;
				endif;
			endif;
		endif;
		return $uploadStatus;
	}
	
	public function uploadSingleDocument($uploadPath = NULL,$file_name = NULL){
		
		$uploadStatus = array('status'=>FALSE,'message'=>'','uploadData'=>array());
		if(is_null($uploadPath) || ($this->createDir($uploadPath) == FALSE)):
			$uploadPath = NULL;
		endif;
		if(!is_null($uploadPath)):
			if(!empty($_FILES)):
				$this->load->library('upload');
				$this->load->helper('string');
				$config = array();
				$config['upload_path'] = $uploadPath.'/';
				$config['allowed_types'] = ALLOWED_TYPES_BOOKS;
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;
				$config['max_size'] = 50000;
				if(is_null($file_name)):
					$config['file_name'] = random_string('nozero',12).'.'.substr(strrchr($_FILES['file']['name'], '.'),1);
				else:
					$config['file_name'] = $file_name;
				endif;
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('file')):
					$uploadStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Файл: '.$_FILES['file']['name'],'message'=>$this->upload->display_errors()),TRUE);
				else:
					$uploadStatus['uploadData'] = $this->upload->data();
					$uploadStatus['status'] = TRUE;
				endif;
			endif;
		endif;
		return $uploadStatus;
	}
	
	public function createZIP(){
		
		$zip = new ZipArchive;
		$arguments = &func_get_args();
		$filename = (isset($arguments[0]['file_name']))?$arguments[0]['file_name']:'resources.zip';
		$resources = (isset($arguments[0]['resources']))?$arguments[0]['resources']:NULL;
		$zipPath = (isset($arguments[0]['zip_path']))?$arguments[0]['zip_path']:NULL;
		$zipStatus = array('status'=>FALSE,'message'=>'','file_name'=>$filename,'file_path'=>$zipPath);
		if(is_null($zipPath) || $this->createDir($zipPath) == FALSE):
			$zipPath = NULL;
		endif;
		if(!is_null($zipPath)):
			if(!is_null($resources) && is_array($resources)):
				if($zip->open($zipPath.'/'.$filename,ZIPARCHIVE::CREATE)):
					$root = getcwd();
					chdir($zipPath);
					for($file=0;$file<count($resources);$file++):
						if(is_file($resources[$file]['name'])):
							$result = $zip->addFile($resources[$file]['name']);
						endif;
					endfor;
					$zip->close();
					for($file=0;$file<count($resources);$file++):
						$this->filedelete($resources[$file]['name']);
					endfor;
					chdir($root);
					$zipStatus['status'] = TRUE;
				else:
					$zipStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Создание архива','message'=>'Невозможно создать архив'),TRUE);
				endif;
			else:
				$zipStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Создание архива','message'=>'Отсутствуют файлы для создания архива'),TRUE);
			endif;
		else:
			$zipStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Создание архива','message'=>'Отсутствует каталог'),TRUE);
		endif;
		return $zipStatus;
	}
	
	public function getFileExt($fileName = '',$start_char = 1){
		
		if(!empty($fileName)):
			return substr(strrchr($fileName,'.'),$start_char);
		else:
			return '';
		endif;
	}

	public function filedelete($file = NULL){
		
		if(!is_null($file) && is_file($file)):
			@unlink($file);
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	public function dirDelete($dir = NULL){
		
		if(!is_null($dir) && is_dir($dir)):
			return rmdir($dir);
		endif;
		return FALSE;
	}

	public function translite($string = ''){
		
		if(!empty($string)):
			$rus = array("1","2","3","4","5","6","7","8","9","0","ё","й","ю","ь","ч","щ","ц","у","к","е","н","г","ш","з","х","ъ","ф","ы","в","а","п","р","о","л","д","ж","э","я","с","м","и","т","б","Ё","Й","Ю","Ч","Ь","Щ","Ц","У","К","Е","Н","Г","Ш","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","С","М","И","Т","Б"," ");
			$eng = array("1","2","3","4","5","6","7","8","9","0","yo","iy","yu","","ch","sh","c","u","k","e","n","g","sh","z","h","","f","y","v","a","p","r","o","l","d","j","е","ya","s","m","i","t","b","Yo","Iy","Yu","CH","","SH","C","U","K","E","N","G","SH","Z","H","","F","Y","V","A","P","R","O","L","D","J","E","YA","S","M","I","T","B","-");
			$string = str_replace($rus,$eng,$string);
			if(!empty($string)):
				$string = preg_replace('/[^a-z0-9-\.]/','',strtolower($string));
				$string = preg_replace('/[-]+/','-',$string);
				$string = preg_replace('/[\.]+/','.',$string);
				return $string;
			endif;
		endif;
		return 'undefined';
	}

	public function setActiveUsers($usersList,$field = 'id'){
		
		$list = NULL;
		$session_data = $this->accounts->activeUserData();
		for($i=0;$i<count($session_data);$i++):
			preg_match("/\"account\";s:[0-9]+:\"{\"id\":\"([0-9]+)\"/i",$session_data[$i]['user_data'],$account);
			if(isset($account[1])):
				$list[] = (int)$account[1];
			endif;
		endfor;
		for($i=0;$i<count($usersList);$i++):
			$usersList[$i]['online'] = FALSE;
			for($j=0;$j<count($list);$j++):
				if($usersList[$i][$field] == $list[$j]):
					$usersList[$i]['online'] = TRUE;
				endif;
			endfor;
		endfor;
		if($usersList):
			return $usersList;
		else:
			return NULL;
		endif;
	}
	
	public function postDataValidation($rules){
		
		$this->load->library('form_validation');
		return $this->form_validation->run($rules);
	}
	
	public function createDir($path){
		
		if(!file_exists($path) && !is_dir($path)):
			return mkdir($path,0777,TRUE);
		else:
			return TRUE;
		endif;
	}

	public function insertItem(){
		
		$arguments = &func_get_args();
		$insert = (isset($arguments[0]['insert']))?$arguments[0]['insert']:NULL;
		$model = (isset($arguments[0]['model']))?$arguments[0]['model']:NULL;
		$translit = (isset($arguments[0]['translit']))?$arguments[0]['translit']:NULL;
		unset($arguments);
		if(!is_null($insert) && is_array($insert)):
			if(!is_null($translit)):
				$insert['translit'] = $this->translite($translit);
			endif;
			if(!is_null($model)):
				$this->load->model($model);
				return $this->$model->insertRecord($insert);
			endif;
		endif;
		return FALSE;
	}
	
	public function updateItem(){
		
		$arguments = &func_get_args();
		$update = (isset($arguments[0]['update']))?$arguments[0]['update']:NULL;
		$model = (isset($arguments[0]['model']))?$arguments[0]['model']:NULL;
		$translit = (isset($arguments[0]['translit']))?$arguments[0]['translit']:NULL;
		unset($arguments);
		if(!is_null($update) && is_array($update)):
			if(!is_null($translit)):
				$update['translit'] = $this->translite($translit);
			endif;
			if(!is_null($model)):
				$this->load->model($model);
				return $this->$model->updateRecord($update);
			endif;
		endif;
		return FALSE;
	}
	
	public function getCurlLink($url){
		
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_HEADER,0);
		$result = curl_exec($ch);
		curl_close($ch);
		if($result == FALSE):
			return file_get_contents($url);
		else:
			return $result;
		endif;
	}

	public function getValuesInArray($array,$value = 'id'){
		
		$ids = array();
		for($i=0;$i<count($array);$i++):
			$ids[] = $array[$i][$value];
		endfor;
		return $ids;
	}
	
	public function getTransArrayIDs($array,$value = 'id'){
		
		$newArray = array();
		for($i=0;$i<count($array);$i++):
			$newArray[$array[$i][$value]] = $array[$i];
		endfor;
		return $newArray;
	}
	
	public function TranspondIDtoIndex($array,$field = 'id'){
		
		$TmpIDs = array();
		for($i=0;$i<count($array);$i++):
			$TmpIDs[$array[$i][$field]] = $array[$i];
		endfor;
		$ids = array();
		foreach($TmpIDs as $key => $values):
			unset($values[$field]);
			$ids[$key] = $values;
		endforeach;
		return $ids;
	}
	
	public function reIndexArray($array){
		
		if(!empty($array)):
			$newArray = array();
			foreach($array as $key => $value):
				$newArray[] = $value;
			endforeach;
			return $newArray;
		else:
			return NULL;
		endif;
		
	}

	public function getFileUploadErrorMessage($FileData){
		
		if(isset($FileData['name'])):
			$responseText = 'Файл: '.$FileData['name'].' не загружен. ';
			if($FileData['error'] == 1):
				$responseText .= "\nРазмер зашружаемого файла должен быть не более 2 Мб";
			elseif($FileData['error'] == 3):
				$responseText .= "\nЗагружаемый файл был получен только частично";
			elseif($FileData['error'] == 4):
				$responseText .= "\nОтсутствует файл для загрузки";
			endif;
			return $responseText;
		endif;
		return '';
	}

	public function AssociateRSort($array,$key){
		
		$sorter = array();
		$retArray = array();
		reset($array);
		foreach ($array as $ii => $va):
			$sorter[$ii]=$va[$key];
		endforeach;
		arsort($sorter);
		foreach ($sorter as $ii => $va):
			$retArray[$ii]=$array[$ii];
		endforeach;
		return  $retArray;
	}
	
	public function AssociateSort($array,$key){
		
		$sorter = array();
		$retArray = array();
		reset($array);
		foreach ($array as $ii => $va):
			$sorter[$ii]=$va[$key];
		endforeach;
		asort($sorter);
		foreach ($sorter as $ii => $va):
			$retArray[$ii]=$array[$ii];
		endforeach;
		return  $retArray;
	}
	/* -------------------------------------------------------------------------------------------- */
	public function getDBBasket(){
		
		if($basket = $this->accounts->value($this->account['id'],'basket')):
			set_cookie('basket_books',$basket,time()+86500,'','/');
		endif;
	}
	
	public function validBasket(){
		
		if($this->input->cookie('basket_books') !== FALSE):
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	public function setDBBasket(){
		
		if($this->isUserLoggined()):
			$basket = '';
			if($this->input->cookie('basket_books') !== FALSE):
				$basket = $this->input->cookie('basket_books');
			endif;
			$this->accounts->updateField($this->account['id'],'basket',$basket);
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	/* -------------------------------------------------------------------------------------------- */
	public function getAuthorsByIDs($authors){
		
		$authorsList = array();
		if($authorsIDs = explode(',',$authors)):
			$this->load->model('authors');
			$authorsList = $this->authors->getAuthorsByIDs($authorsIDs);
		endif;
		return $authorsList;
	}
	
	public function getGenresByIDs($genres){
		
		$genresList = array();
		if($genresIDs = explode(',',$genres)):
			$this->load->model('genres');
			$genresList = $this->genres->getGenresByIDs($genresIDs);
		endif;
		return $genresList;
	}
	
	public function getBooksByIDs($books){
		
		$genresList = array();
		if($booksIDs = explode(',',$books)):
			$this->load->model('books');
			$genresList = $this->books->getBooksByIDs($booksIDs);
		endif;
		return $genresList;
	}
	
	public function getBookKeyWords($bookID){
		
		$this->load->model('keywords');
		if($KeyWords = $this->keywords->getBookKeyWords($bookID)):
			for($i=0;$i<count($KeyWords);$i++):
				$KeyWordsList[] = $KeyWords[$i]['word'];
			endfor;
			return implode(', ',$KeyWordsList);
		endif;
		return '';
	}
	
	public function buyBook($bookID,$accountID = NULL){
		
		if(is_null($accountID)):
			$accountID = $this->account['id'];
		endif;
		
		$this->load->model(array('books','signed_books'));
		if($this->books->getWhere($bookID)):
			if(!$this->signed_books->getWhere(NULL,array('book'=>$bookID,'account'=>$accountID))):
				return $signedID = $this->insertItem(array('insert'=>array('book'=>$bookID,'account'=>$accountID),'model'=>'signed_books'));
			endif;
		endif;
		return FALSE;
	}
	
	public function mySignedBooks($books){
		
		$this->load->model('signed_books');
		$mySignedBooks = $this->signed_books->getWhere(NULL,array('account'=>$this->account['id']),TRUE);
		for($i=0;$i<count($books);$i++):
			$books[$i]['signed_book'] = FALSE;
			for($j=0;$j<count($mySignedBooks);$j++):
				if($books[$i]['id'] == $mySignedBooks[$j]['book']):
					$books[$i]['signed_book'] = TRUE;
				endif;
			endfor;
		endfor;
		return $books;
	}
	
	public function booksInBasket($books){
		
		for($i=0;$i<count($books);$i++):
			$books[$i]['book_in_basket'] = FALSE;
		endfor;
		if($booksIDs = $this->getAccountBasketBooks()):
			for($i=0;$i<count($books);$i++):
				for($j=0;$j<count($booksIDs);$j++):
					if($books[$i]['id'] == $booksIDs[$j]):
						$books[$i]['book_in_basket'] = TRUE;
					endif;
				endfor;
			endfor;
		endif;
		return $books;
	}
	
	public function validSignedBook($bookID){
		
		$this->load->model(array('signed_books','books'));
		if($this->signed_books->getWhere(NULL,array('book'=>$bookID,'account'=>$this->account['id']))):
			if($book = $this->books->getWhere($bookID)):
				return $book;
			endif;
		endif;
		return FALSE;
	}
	
	public function setPageAddress($elements,$group){
		
		$metaTitles = $this->meta_titles->getWhere(NULL,array('group'=>$group),TRUE);
		for($i=0;$i<count($elements);$i++):
			$elements[$i]['page_address'] = FALSE;
			for($j=0;$j<count($metaTitles);$j++):
				if($metaTitles[$j]['item_id'] == $elements[$i]['id']):
					$elements[$i]['page_address'] = $metaTitles[$j]['page_address'];
				endif;
			endfor;
		endfor;
		return $elements;
	}

	public function BooksGenre($books){
		
		$this->load->model('genres');
		$genres = $this->genres->getAll();
		for($i=0;$i<count($books);$i++):
			$books[$i]['genre_title'] = '';
			for($j=0;$j<count($genres);$j++):
				if($books[$i]['genre'] == $genres[$j]['id']):
					$books[$i]['genre_title'] = $genres[$j][$this->uri->language_string.'_title'];
				endif;
			endfor;
		endfor;
		return $books;
	}
	
	public function getBookFormats($book_files){
		
		$BookFormats = array('categories_ids'=>array(),'categories_titles'=>array(),'formats'=>array());
		if($formatsList = $this->getBookFormatsList($book_files)):
			$this->load->model('formats_categories');
			if($BookFormats['formats'] = $this->formats_categories->getCategoryByFormatsIDs($formatsList)):
				$BookFormats['categories_ids'] = $this->reIndexArray(array_unique($this->getValuesInArray($BookFormats['formats'],'category_id')));
				for($i=0;$i<count($BookFormats['categories_ids']);$i++):
					for($j=0;$j<count($BookFormats['formats']);$j++):
						if($BookFormats['formats'][$j]['category_id'] == $BookFormats['categories_ids'][$i]):
							$BookFormats['categories_titles'][$BookFormats['categories_ids'][$i]]['ru_title'] = $BookFormats['formats'][$j]['ru_title'];
							$BookFormats['categories_titles'][$BookFormats['categories_ids'][$i]]['en_title'] = $BookFormats['formats'][$j]['en_title'];
						endif;
					endfor;
				endfor;
			endif;
		endif;
		return $BookFormats;
	}
	
	public function getBookFormatsList($book_files){
		
		if(!empty($book_files)):
			if($jsonformats = json_decode($book_files,TRUE)):
				if(isset($jsonformats[0]) && !empty($jsonformats[0])):
					if($formatsList = $this->getValuesInArray($jsonformats,'format_id')):
						return $formatsList;
					endif;
				endif;
			endif;
		else:
			return FALSE;
		endif;
	}

	public function createBasketBlock($BookID){
		
		$productBasket = '';
		$this->load->model('books_card');
		if($book = $this->books_card->getWhere($BookID)):
			$book['authors'] = $this->getAuthorsByIDs($book['authors']);
			$productBasket = $this->load->view('guests_interface/html/basket/basket-item',array('book'=>$book),TRUE);
		endif;
		return $productBasket;
	}
	
	public function createBasketBlockEmptyAction(){
		$productBasket = '';
		for($i=0;$i<$this->project_config['count_free_book'];$i++):
			$productBasket .= $this->load->view('guests_interface/html/basket/basket-item-sale-empty',array('hidden'=>FALSE),TRUE);
		endfor;
		return $productBasket;
	}
	
	public function createBasketBlockAction($BookID){
		
		$productBasket = '';
		$this->load->model('books_card');
		if($book = $this->books_card->getWhere($BookID)):
			$book['authors'] = $this->getAuthorsByIDs($book['authors']);
			$productBasket .= $this->load->view('guests_interface/html/basket/basket-item-sale-full',array('book'=>$book),TRUE);
		endif;
		return $productBasket;
	}
	
	public function removeBasketBlocks(){
		
		$this->load->model('books_card');
		if($booksIDs = $this->getValuesBasketBooksCookie()):
			$booksBasketCount = count($booksIDs);
			if($booksBasketCount%$this->project_config['free_book'] != 0):
				return $this->project_config['count_free_book'];
			endif;
		endif;
		return FALSE;
	}
	
	public function getBasketTotalPrice(){
		
		if($booksIDs = $this->getValuesBasketBooksCookie()):
			return $this->getBooksPrice($booksIDs);
		endif;
		return NULL;
	}
	
	public function getBooksInBasket(){
		
		$this->load->model('books_card');
		if(!empty($this->account_basket['basket_books'])):
			if($books = $this->books_card->getBooksByIDs($this->account_basket['basket_books'])):
				$books = $this->getBooksSortByIDs($books);
				for($i=0;$i<count($books);$i++):
					$books[$i]['authors'] = $this->getAuthorsByIDs($books[$i]['authors']);
				endfor;
				return $books;
			endif;
		endif;
		return NULL;
	}
	
	public function getValuesBasketBooksCookie(){
		
		if($this->input->cookie('basket_books') !== FALSE):
			if($booksIDs = json_decode($this->input->cookie('basket_books'),TRUE)):
				return $booksIDs;
			endif;
		endif;
		return FALSE;
	}
	
	public function getBooksSortByIDs($books,$array = NULL){
		
		if(is_null($array)):
			$array = $this->account_basket['basket_books']; //сортировка по карзине (базовое условие)
		endif;
		$sortBooks = array();
		for($i=0;$i<count($array);$i++):
			for($j=0;$j<count($books);$j++):
				if($array[$i] == $books[$j]['id']):
					$sortBooks[] = $books[$j];
				endif;
			endfor;
		endfor;
		return $sortBooks;
	}	
	
	private function getBooksPrice($booksIDs){
		
		$this->load->model('books');
		$summa = 0;
		if($books = $this->books->getBooksByIDs($booksIDs)):
			for($i=0;$i<count($books);$i++):
				if(($i+1)%$this->project_config['free_book'] != 0):
					if($books[$i]['price_action'] > 0):
						$summa+=$books[$i]['price_action'];
					else:
						$summa+=$books[$i]['price'];
					endif;
				endif;
			endfor;
		endif;
		return getPriceInCurrency($summa);
	}
	
}
?>
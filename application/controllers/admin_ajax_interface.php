<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
	
	function __construct(){
		
		parent::__construct();
		if($this->account['group'] != ADMIN_GROUP_VALUE):
			show_404();
		endif;
	}
	/******************************************** cabinet ******************************************************/
	public function adminSavePassword(){
		
		if($this->account['group'] != ADMIN_GROUP_VALUE):
			show_error('В доступе отказано');
		endif;
		if($this->postDataValidation('password')):
			if($this->validOldPassword($this->input->post('oldpassword'))):
				$this->accounts->updateField($this->account['id'],'password',md5($this->input->post('password')));
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/books');
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Пароль сохранен';
			else:
				$this->json_request['responseText'] = 'Не верный старый пароль';
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function validOldPassword($password = ''){
		
		if($this->accounts->getWhere(NULL,array('id'=>$this->account['id'],'password'=>md5($password)))):
			return TRUE;
		endif;
		return FALSE;
	}
	/********************************************** seo ********************************************************/
	public function updateSEO(){
		
		if($this->postDataValidation('seo') === TRUE):
			if($this->updatingSEO($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Страница cохранена';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/seo');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}

	private function updatingSEO($post){
		
		$seoMeta = array(
			'id'=>$post['meta_titles_id'],
			'ru_page_title'=>$post['ru_page_title'],'ru_page_description'=>$post['ru_page_description'],'ru_page_h1'=>$post['ru_page_h1'],
			'en_page_title'=>$post['en_page_title'],'en_page_description'=>$post['en_page_description'],'en_page_h1'=>$post['en_page_h1']
		);
		$this->updateItem(array('update'=>$seoMeta,'model'=>'meta_titles'));
		return TRUE;
	}
	/********************************************** promo ********************************************************/
	public function updatePromo(){
		
		if($this->postDataValidation('promo') === TRUE):
			if($this->updatingPromo($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Акции сохранены';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/seo');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}

	private function updatingPromo($post){
		
		$post['id'] = 1;
		$this->updateItem(array('update'=>$post,'model'=>'configuration'));
		return TRUE;
	}
	/******************************************** formats ******************************************************/
	public function updateFormatCategory(){
		
		if($this->postDataValidation('format_categoty') === TRUE):
			if($this->updatingFormatCategory()):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Категория cохранена';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/formats/categories');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function insertFormat(){
		
		if($this->postDataValidation('format') === TRUE):
			if($formatID = $this->insertingFormat($this->input->post())):
				$this->json_request['responseText'] = 'Формат добавлен';
				if(isset($_FILES['file']['tmp_name'])):
					$validImage = $this->validationUploadImage(array('min_width'=>120,'max_size'=>1000000));
					if($validImage['status'] == TRUE):
						$this->imageManupulation($_FILES['file']['tmp_name'],'width',TRUE,130,121);
						$photoPath = getcwd().'/download/formats';
						$photoUpload = $this->uploadSingleImage($photoPath);
						if($photoUpload['status'] == TRUE):
							$this->load->model('formats');
							$this->formats->updateField($formatID,'image','download/formats/'.$photoUpload['uploadData']['file_name']);
						endif;
					else:
						$this->json_request['responseText'] = $validImage['response'];
					endif;
				endif;
				$this->json_request['status'] = TRUE;
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/formats?category='.$this->input->post('category'));
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function updateFormat(){
		
		if($this->postDataValidation('format') === TRUE):
			if($this->updatingFormat($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Формат cохранен';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/formats?category='.$this->input->post('category'));
				if($this->input->post('delete_image') !== FALSE):
					$this->deteleFormatImage($this->input->post('id'));
				else:
					if(isset($_FILES['file']['tmp_name'])):
						$validImage = $this->validationUploadImage(array('min_width'=>120,'max_size'=>1000000));
						if($validImage['status'] == TRUE):
							$this->deteleFormatImage($this->input->post('id'));
							$this->imageManupulation($_FILES['file']['tmp_name'],'width',TRUE,130,121);
							$photoPath = getcwd().'/download/formats';
							$photoUpload = $this->uploadSingleImage($photoPath);
							if($photoUpload['status'] == TRUE):
								$this->load->model('formats');
								$this->formats->updateField($this->input->post('id'),'image','download/formats/'.$photoUpload['uploadData']['file_name']);
							endif;
						else:
							$this->json_request['status'] = FALSE;
							$this->json_request['responseText'] = $validImage['response'];
							$this->json_request['redirect'] = FALSE;
						endif;
					endif;
				endif;
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeFormat(){
		
		if($this->input->post('id')):
			$this->deteleFormatImage($this->input->post('id'));
			$this->load->model('formats');
			$this->formats->delete($this->input->post('id'));
			$this->json_request['status'] = TRUE;
		endif;
		echo json_encode($this->json_request);
	}
	
	private function insertingFormat($post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		
		return $this->insertItem(array('insert'=>$post,'model'=>'formats'));
	}
	
	private function updatingFormat($post){
		
		if(isset($post['file'])):
			unset($post['file']);
		endif;
		if(isset($post['delete_image'])):
			unset($post['delete_image']);
		endif;
		$this->updateItem(array('update'=>$post,'model'=>'formats'));
		return TRUE;
	}

	private function updatingFormatCategory(){
		
		$this->updateItem(array('update'=>$this->input->post(),'model'=>'formats_categories'));
		return TRUE;
	}

	private function deteleFormatImage($formatID){
		
		$this->load->model('formats');
		$this->filedelete(getcwd().'/'.$this->formats->value($formatID,'image'));
		$this->formats->updateField($formatID,'image','');
		return TRUE;
	}
	/********************************************* news ********************************************************/
	public function insertNews(){
		
		if($this->postDataValidation('news') === TRUE):
			if($newsID = $this->insertingNews($this->input->post())):
				$this->json_request['responseText'] = 'Новость добавлена';
				if(isset($_FILES['file']['tmp_name'])):
					$validImage = $this->validationUploadImage(array('min_width'=>200,'max_size'=>1000000));
					if($validImage['status'] == TRUE):
						$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,210,298);
						$photoPath = getcwd().'/download/news';
						$photoUpload = $this->uploadSingleImage($photoPath);
						if($photoUpload['status'] == TRUE):
							$this->load->model('news');
							$this->news->updateField($newsID,'image','download/news/'.$photoUpload['uploadData']['file_name']);
							$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,105,149);
							$thumbnailUpload = $this->uploadSingleImage($photoPath);
							if($thumbnailUpload['status'] == TRUE):
								$this->news->updateField($newsID,'thumbnail','download/news/'.$thumbnailUpload['uploadData']['file_name']);
							endif;
						endif;
					else:
						$this->json_request['responseText'] = $validImage['response'];
					endif;
				endif;
				$this->json_request['status'] = TRUE;
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/news');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function updateNews(){
		
		if($this->postDataValidation('news') === TRUE):
			if($this->updatingNews($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Новость cохранен';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/news');
				if($this->input->post('delete_image') !== FALSE):
					$this->deteleNewsImage($this->input->post('news_id'));
				else:
					if(isset($_FILES['file']['tmp_name'])):
						$validImage = $this->validationUploadImage(array('min_width'=>200,'max_size'=>1000000));
						if($validImage['status'] == TRUE):
							$this->deteleNewsImage($this->input->post('news_id'));
							$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,210,298);
							$photoPath = getcwd().'/download/news';
							$photoUpload = $this->uploadSingleImage($photoPath);
							if($photoUpload['status'] == TRUE):
								$this->load->model('news');
								$this->news->updateField($this->input->post('news_id'),'image','download/news/'.$photoUpload['uploadData']['file_name']);
								$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,105,149);
								$thumbnailUpload = $this->uploadSingleImage($photoPath);
								if($thumbnailUpload['status'] == TRUE):
									$this->news->updateField($this->input->post('news_id'),'thumbnail','download/news/'.$thumbnailUpload['uploadData']['file_name']);
								endif;
							endif;
						else:
							$this->json_request['status'] = FALSE;
							$this->json_request['responseText'] = $validImage['response'];
							$this->json_request['redirect'] = FALSE;
						endif;
					endif;
				endif;
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeNews(){
		
		if($this->input->post('id')):
			$this->deteleNewsImage($this->input->post('id'));
			$this->load->model(array('news','meta_titles'));
			$this->news->delete($this->input->post('id'));
			$this->meta_titles->delete(NULL,array('group'=>'books','item_id'=>$this->input->post('id')));
			$this->json_request['status'] = TRUE;
		endif;
		echo json_encode($this->json_request);
	}
	
	private function insertingNews($post){
		
		$newsData = array(
			'ru_title'=>$post['ru_title'],'en_title'=>$post['en_title'],'ru_small_anonce'=>$post['ru_small_anonce'],'en_small_anonce'=>$post['en_small_anonce'],
			'ru_anonce'=>$post['ru_anonce'],'en_anonce'=>$post['en_anonce'],'ru_text'=>$post['ru_text'],'en_text'=>$post['en_text'],
			'date'=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date'])
		);
		$this->load->model('news');
		$newsData['sort'] = $this->news->getNextSortable();
		if($newsID = $this->insertItem(array('insert'=>$newsData,'model'=>'news'))):
			$newsMeta = array(
				'ru_page_title'=>$post['ru_page_title'],'ru_page_description'=>$post['ru_page_description'],'ru_page_h1'=>$post['ru_page_h1'],
				'en_page_title'=>$post['en_page_title'],'en_page_description'=>$post['en_page_description'],'en_page_h1'=>$post['en_page_h1'],
				'group'=>'news','item_id'=>$newsID,'page_address'=>$post['page_address']
			);
			if(empty($newsMeta['page_address'])):
				$newsMeta['page_address'] = $this->translite($post['ru_title']);
			endif;
			$this->insertItem(array('insert'=>$newsMeta,'model'=>'meta_titles'));
			return $newsID;
		endif;
		return FALSE;
	}

	private function updatingNews($post){
		
		$newsData = array(
			'id'=>$post['news_id'],
			'ru_title'=>$post['ru_title'],'en_title'=>$post['en_title'],'ru_small_anonce'=>$post['ru_small_anonce'],'en_small_anonce'=>$post['en_small_anonce'],
			'ru_anonce'=>$post['ru_anonce'],'en_anonce'=>$post['en_anonce'],'ru_text'=>$post['ru_text'],'en_text'=>$post['en_text'],
			'date'=>preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$post['date']),'sort'=>$post['sort']
		);
		$this->updateItem(array('update'=>$newsData,'model'=>'news'));
		$newsMeta = array(
			'id'=>$post['meta_titles_id'],
			'ru_page_title'=>$post['ru_page_title'],'ru_page_description'=>$post['ru_page_description'],'ru_page_h1'=>$post['ru_page_h1'],
			'en_page_title'=>$post['en_page_title'],'en_page_description'=>$post['en_page_description'],'en_page_h1'=>$post['en_page_h1'],
			'group'=>'news','item_id'=>$post['news_id'],'page_address'=>$post['page_address']
		);
		if(empty($newsMeta['page_address'])):
			$newsMeta['page_address'] = $this->translite($post['ru_title']);
		endif;
		$this->updateItem(array('update'=>$newsMeta,'model'=>'meta_titles'));
		return TRUE;
	}

	private function deteleNewsImage($newsID){
		
		$this->load->model('news');
		$this->filedelete(getcwd().'/'.$this->news->value($newsID,'image'));
		$this->filedelete(getcwd().'/'.$this->news->value($newsID,'thumbnail'));
		$this->news->updateField($newsID,'image','');
		$this->news->updateField($newsID,'thumbnail','');
		return TRUE;
	}
	/******************************************* authors *******************************************************/
	public function insertAuthor(){
		
		if($this->postDataValidation('author')):
			if($this->insertingAuthor($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Автор добавлен';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/authors');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function updateAuthor(){
		
		if($this->postDataValidation('author')):
			if($this->updatingAuthor($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Автор cохранен';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/authors');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeAuthor(){
		
		$this->load->model('authors');
		$this->authors->delete($this->input->post('id'));
		$this->json_request['status'] = TRUE;
		echo json_encode($this->json_request);
	}
	
	private function insertingAuthor($post){
		
		return $this->insertItem(array('insert'=>$post,'model'=>'authors'));
		return TRUE;
	}
	
	private function updatingAuthor($post){
		
		$this->updateItem(array('update'=>$post,'model'=>'authors'));
		return TRUE;
	}
	/******************************************* genres *******************************************************/
	public function insertGenre(){
		
		if($this->postDataValidation('genre')):
			if($this->insertingGenre($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Жанр добавлен';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/genres');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function updateGenre(){
		
		if($this->postDataValidation('genre')):
			if($this->updatingGenre($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Жанр cохранен';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/genres');
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeGenre(){
		
		$this->load->model('genres');
		$this->genres->delete($this->input->post('id'));
		$this->json_request['status'] = TRUE;
		echo json_encode($this->json_request);
	}
	
	private function insertingGenre($post){
		
		return $this->insertItem(array('insert'=>$post,'model'=>'genres'));
		return TRUE;
	}
	
	private function updatingGenre($post){
		
		$this->updateItem(array('update'=>$post,'model'=>'genres'));
		return TRUE;
	}
	/******************************************* books *******************************************************/
	public function insertBook(){
		
		if($this->postDataValidation('books')):
			if($this->validationPageAddress($this->input->post('page_address'))):
				if($bookID = $this->insertingBook($this->input->post())):
					$this->json_request['responseText'] = 'Книга добавлена';
					if(isset($_FILES['file']['tmp_name'])):
						$validImage = $this->validationUploadImage(array('min_width'=>300,'max_size'=>1000000));
						if($validImage['status'] == TRUE):
							$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,304,431);
							$photoPath = getcwd().'/download/books';
							$photoUpload = $this->uploadSingleImage($photoPath);
							if($photoUpload['status'] == TRUE):
								$this->load->model('books');
								$this->books->updateField($bookID,'image','download/books/'.$photoUpload['uploadData']['file_name']);
								$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,99,141);
								$thumbnailUpload = $this->uploadSingleImage($photoPath);
								if($thumbnailUpload['status'] == TRUE):
									$this->books->updateField($bookID,'thumbnail','download/books/'.$thumbnailUpload['uploadData']['file_name']);
								endif;
							endif;
						else:
							$this->json_request['responseText'] = $validImage['response'];
						endif;
					endif;
					$this->json_request['status'] = TRUE;
					$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/books?genre='.$this->input->post('genre'));
				endif;
			else:
				$this->json_request['responseText'] = 'Адрес страницы уже занят';
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function updateBook(){
		
		if($this->postDataValidation('books')):
			if($this->updatingBook($this->input->post())):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Книга cохранена';
				$this->json_request['redirect'] = site_url(ADMIN_START_PAGE.'/books?genre='.$this->input->post('genre'));
				if($this->input->post('delete_image') !== FALSE):
					$this->deteleBooksImage($this->input->post('book_id'));
				else:
					if(isset($_FILES['file']['tmp_name'])):
						$validImage = $this->validationUploadImage(array('min_width'=>300,'max_size'=>1000000));
						if($validImage['status'] == TRUE):
							$this->deteleBooksImage($this->input->post('book_id'));
							$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,304,431);
							$photoPath = getcwd().'/download/books';
							$photoUpload = $this->uploadSingleImage($photoPath);
							if($photoUpload['status'] == TRUE):
								$this->load->model('books');
								$this->books->updateField($this->input->post('book_id'),'image','download/books/'.$photoUpload['uploadData']['file_name']);
								$this->imageManupulation($_FILES['file']['tmp_name'],'height',TRUE,105,149);
								$thumbnailUpload = $this->uploadSingleImage($photoPath);
								if($thumbnailUpload['status'] == TRUE):
									$this->books->updateField($this->input->post('book_id'),'thumbnail','download/books/'.$thumbnailUpload['uploadData']['file_name']);
								endif;
							endif;
						else:
							$this->json_request['status'] = FALSE;
							$this->json_request['responseText'] = $validImage['response'];
							$this->json_request['redirect'] = FALSE;
						endif;
					endif;
				endif;
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeBook(){
		
		$this->load->model(array('books','matching','meta_titles'));
		$this->deteleBooksImage($this->input->post('id'));
		$this->books->delete($this->input->post('id'));
		$this->matching->delete(NULL,array('book'=>$this->input->post('id')));
		$this->json_request['status'] = TRUE;
		echo json_encode($this->json_request);
	}
	
	public function uploadBook(){
		
		if(!$this->input->get_request_header('X-file-name',TRUE)):
			show_404();
		endif;
		$this->json_request['resource_id'] = 0; $this->json_request['resource_title'] = ''; $this->json_request['format'] = '';
		$this->load->model(array('books','formats'));
		if($book = $this->books->getWhere($this->input->get('id'))):
			if($this->validBookFiles($book['files'],$_FILES)):
				$resultUpload = $this->uploadSingleDocument(getcwd().'/catalog');
				if($resultUpload['status'] == TRUE):
					$resource = $resultUpload['uploadData'];
					if(!$resource['format_id'] = $this->formats->search('title',$resource['file_ext'])):
						$resource['format_id'] = 0;
					endif;
					$resources = json_decode($book['files'],TRUE);
					$resource['sort'] = $resource['number'] = count($resources)+1;
					$resource['caption'] = '';
					$resources[] = $resource;
					$this->books->updateField($this->input->get('id'),'files',json_encode($resources));
					$this->json_request['resource_title'] = $resultUpload['uploadData']['file_name'].', '.$resultUpload['uploadData']['file_size'].' кбайт';
					$this->load->helper('string');
					$this->json_request['responsePhotoSrc'] = '<img class="" src="'.site_url('book-format/'.$resource['format_id']).'" alt="" />';
					$this->json_request['responsePhotoSrc'] .= '<a href="#" data-resource-id="'.$resource['number'].'" class="delete-resource-item">&times;</a>';
					$this->json_request['status'] = TRUE;
				else:
					$this->json_request['responseText'] = $resultUpload['message'];
				endif;
			else:
				$this->json_request['responseText'] = 'Книга данного формата уже загружена!';
			endif;
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeBookFile(){
		
		$this->json_request['resource_id'] = 0; $this->json_request['resource_title'] = ''; $this->json_request['format'] = '';
		$this->load->model(array('books','formats'));
		if($book = $this->books->getWhere($this->input->get('book'))):
			$resources = json_decode($book['files'],TRUE);
			$resource = array();
			for($i=0;$i<count($resources);$i++):
				if($resources[$i]['number'] != $this->input->post('resourceID')):
					$resource[] = $resources[$i];
				else:
					$this->filedelete($resources[$i]['full_path']);
				endif;
			endfor;
			$this->books->updateField($this->input->get('book'),'files',json_encode($resource));
			$this->json_request['status'] = TRUE;
		endif;
		echo json_encode($this->json_request);
	}
	
	public function captionBook(){
		
		$json_request = array('status'=>FALSE);
		if($this->postDataValidation('book_caption')):
			$this->load->model('books');
			if($book = $this->books->getWhere($this->input->get('book'))):
				$resources = json_decode($book['files'],TRUE);
				for($i=0;$i<count($resources);$i++):
					if($resources[$i]['number'] == $this->input->post('number')):
						$resources[$i]['caption'] = $this->input->post('caption');
						$resources[$i]['sort'] = $this->input->post('sort');
						$resources[$i]['format_id'] = $this->input->post('format');
					endif;
				endfor;
				$this->books->updateField($this->input->get('book'),'files',json_encode($resources));
				$json_request['status'] = TRUE;
			endif;
		else:
			$json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($json_request);
	}
	
	private function insertingBook($post){
		
		$post['currency'] = 1;
		$bookData = array(
			'ru_title'=>$post['ru_title'],'en_title'=>$post['en_title'],'ru_anonce'=>$post['ru_anonce'],'en_anonce'=>$post['en_anonce'],
			'ru_text'=>$post['ru_text'],'en_text'=>$post['en_text'],'date_released'=>$post['date_released'],'ru_size'=>$post['ru_size'],
			'isbn'=>$post['isbn'],'age_limit'=>$post['age_limit'],'genre'=>$post['genre'],'en_size'=>$post['en_size'],
			'currency'=>$post['currency'],'price'=>$post['price'],'price_action'=>$post['price_action'],'authors'=>$post['authors'],
			'ru_copyright'=>$post['ru_copyright'],'en_copyright'=>$post['en_copyright'],
			'trailers'=>json_encode($post['trailers']),'audio_recording'=>json_encode($post['audio_recording'])
		);
		$this->load->model('books');
		$bookData['sort'] = $this->books->getNextSortable();
		if($bookID = $this->insertItem(array('insert'=>$bookData,'model'=>'books'))):
			if(!empty($post['keywords'])):
				$this->setKeyWords($bookID,$post['keywords']);
			endif;
			$bookMeta = array(
				'ru_page_title'=>$post['ru_page_title'],'ru_page_description'=>$post['ru_page_description'],'ru_page_h1'=>$post['ru_page_h1'],
				'en_page_title'=>$post['en_page_title'],'en_page_description'=>$post['en_page_description'],'en_page_h1'=>$post['en_page_h1'],
				'group'=>'books','item_id'=>$bookID,'page_address'=>$post['page_address']
			);
			if(empty($bookMeta['page_address'])):
				$bookMeta['page_address'] = $this->translite($post['ru_title']);
			endif;
			$this->insertItem(array('insert'=>$bookMeta,'model'=>'meta_titles'));
			return $bookID;
		endif;
		return FALSE;
	}
	
	private function updatingBook($post){
		
		$post['currency'] = 1;
		$bookData = array(
			'id'=>$post['book_id'],
			'ru_title'=>$post['ru_title'],'en_title'=>$post['en_title'],'ru_anonce'=>$post['ru_anonce'],'en_anonce'=>$post['en_anonce'],
			'ru_text'=>$post['ru_text'],'en_text'=>$post['en_text'],'date_released'=>$post['date_released'],'ru_size'=>$post['ru_size'],
			'isbn'=>$post['isbn'],'age_limit'=>$post['age_limit'],'genre'=>$post['genre'],'en_size'=>$post['en_size'],
			'currency'=>$post['currency'],'price'=>$post['price'],'price_action'=>$post['price_action'],'authors'=>$post['authors'],
			'ru_copyright'=>$post['ru_copyright'],'en_copyright'=>$post['en_copyright'],'sort'=>$post['sort'],
			'trailers'=>json_encode($post['trailers']),'audio_recording'=>json_encode($post['audio_recording'])
		);
		$this->updateItem(array('update'=>$bookData,'model'=>'books'));
		$this->deleteKeyWords($post['book_id']);
		if(!empty($post['keywords'])):
			$this->setKeyWords($post['book_id'],$post['keywords']);
		endif;
		$bookMeta = array(
			'id'=>$post['meta_titles_id'],'page_address'=>$post['page_address'],
			'ru_page_title'=>$post['ru_page_title'],'ru_page_description'=>$post['ru_page_description'],'ru_page_h1'=>$post['ru_page_h1'],
			'en_page_title'=>$post['en_page_title'],'en_page_description'=>$post['en_page_description'],'en_page_h1'=>$post['en_page_h1'],
		);
		if(empty($bookMeta['page_address'])):
			$bookMeta['page_address'] = $this->translite($post['ru_title']);
		endif;
		$this->updateItem(array('update'=>$bookMeta,'model'=>'meta_titles'));
		return TRUE;
	}

	private function deteleBooksImage($bookID){
		
		$this->load->model('books');
		$this->filedelete(getcwd().'/'.$this->books->value($bookID,'image'));
		$this->filedelete(getcwd().'/'.$this->books->value($bookID,'thumbnail'));
		$this->books->updateField($bookID,'image','');
		$this->books->updateField($bookID,'thumbnail','');
		return TRUE;
	}

	private function validBookFiles($bookFiles,$file){
		
		if(isset($file['file']['name']) && $file['file']['error'] == 0):
			if($formatID = $this->formats->search('title',$this->getFileExt($file['file']['name'],0))):
				if($formatsList = $this->getBookFormatsList($bookFiles)):
					if(in_array($formatID,$formatsList) !== FALSE):
						return FALSE;
					else:
						return TRUE;
					endif;
				else:
					return TRUE;
				endif;
			endif;
		endif;
		return FALSE;
	}
	/****************************************** keywords ******************************************************/
	private function setKeyWords($bookID,$keywords){
		
		if($KeyWordsList = explode(',',$keywords)):
			$this->load->model(array('keywords','matching'));
			for($i=0;$i<count($KeyWordsList);$i++):
				if(!empty($KeyWordsList[$i])):
					$insert_word = array('word'=>trim($KeyWordsList[$i]),'word_hash'=>md5(trim($KeyWordsList[$i])));
					if(!$wordID = $this->keywords->search('word_hash',$insert_word['word_hash'])):
						if($wordID = $this->insertItem(array('insert'=>$insert_word,'model'=>'keywords'))):
							$insert_match = array('word'=>$wordID,'book'=>$bookID);
							$matchID = $this->insertItem(array('insert'=>$insert_match,'model'=>'matching'));
						endif;
					elseif(!$this->matching->getWhere(NULL,array('word'=>$wordID,'book'=>$bookID))):
						$insert_match = array('word'=>$wordID,'book'=>$bookID);
						$matchID = $this->insertItem(array('insert'=>$insert_match,'model'=>'matching'));
					endif;
				endif;
			endfor;
		endif;
	}
	
	private function deleteKeyWords($bookID){
		
		$this->load->model('matching');
		$this->matching->delete(NULL,array('book'=>$bookID));
	}

	private function validationPageAddress($page_address,$group = 'book'){
		
		$this->load->model('meta_titles');
		if($this->meta_titles->getWhere(NULL,array('group'=>$group,'page_address'=>$page_address))):
			return FALSE;
		else:
			return TRUE;
		endif;
	}
	
}
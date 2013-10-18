<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
	
	function __construct(){
		
		parent::__construct();
		if(!$this->input->is_ajax_request() || $this->account['group'] != ADMIN_GROUP_VALUE):
			show_404();
		endif;
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
			$this->load->model('news');
			$this->news->delete($this->input->post('id'));
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
	
}
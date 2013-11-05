<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{

	var $offset = 0;
	
	function __construct(){

		parent::__construct();
		if(!$this->loginstatus || ($this->account['group'] != USER_GROUP_VALUE)):
			redirect('');
		endif;
		if($this->uri->language_string === FALSE):
			$this->config->set_item('base_url',baseURL($this->baseLanguageURL.'/cabinet'));
			redirect();
		else:
			$this->config->set_item('base_url',baseURL($this->uri->language_string.'/'));
		endif;
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
		$this->load->model('meta_titles');
		$this->getAccountBasketBooks();
	}
	
	public function cabinet(){

		$this->load->model('signed_books');
		$this->offset = (int)$this->uri->segment(4);
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'breadcrumbs' => array('cabinet'=>lang('user_cabinet')),
			'books' => $this->signed_books->getMyBooks(PER_PAGE_DEFAULT,$this->offset),
			'pages' => $this->pagination('cabinet/my-books',4,$this->signed_books->countAllResults(array('account'=>$this->account['id'])),PER_PAGE_DEFAULT),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['books'] = $this->BooksGenre($pagevar['books']);
		$pagevar['books'] = $this->mySignedBooks($pagevar['books']);
		for($i=0;$i<count($pagevar['books']);$i++):
			$pagevar['books'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['books'][$i]['authors']);
		endfor;
		$this->load->view("users_interface/my-books",$pagevar);
	}

	public function downloadBookFile(){
		
		$this->load->model(array('signed_books','books'));
		if($signedBook = $this->validSignedBook($this->input->get('book'))):
			if(!empty($signedBook['files'])):
				if($files = json_decode($signedBook['files'],TRUE)):
					if(isset($files[0]) && !empty($files[0])):
						for($i=0;$i<count($files);$i++):
							if($files[$i]['format_id'] == $this->input->get('format')):
								if(file_exists($files[$i]['full_path'])):
									header('Pragma: public');
									header('Expires: 0');
									header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
									header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($files[$i]['full_path'])).' GMT');
									header('Cache-Control: private',false);
									header('Content-Type: '.$files[$i]['file_type']);
									header('Content-Disposition: attachment; filename="'.basename($files[$i]['full_path']).'"');
									header('Content-Transfer-Encoding: binary');
									header('Content-Length: '.filesize($files[$i]['full_path']));
									header('Connection: close');
									readfile($files[$i]['full_path']);
									exit();
								endif;
							endif;
						endfor;
					endif;
				endif;
			endif;
		endif;
		show_404();
	}
}
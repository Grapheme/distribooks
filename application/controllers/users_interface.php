<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{

	var $offset = 0;
	
	function __construct(){

		parent::__construct();
		if($this->isUserLoggined() === FALSE):
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
	
	public function pay(){
		
		$booksIDs = array();
		if($this->input->cookie('buy_book') !== FALSE):
			$booksIDs[] = $this->input->cookie('buy_book');
		elseif($this->input->cookie('basket_books') !== FALSE):
			$booksIDs = json_decode($this->input->cookie('basket_books'));
		else:
			redirect(USER_START_PAGE);
		endif;
		$this->load->model('books');
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'breadcrumbs' => array('pay'=>lang('user_pay')),
			'books' => $this->books->getBooksByIDs($booksIDs,'id,ru_title,en_title,price,price_action'),
			'basket_list' => array()
		);
		$this->load->view("users_interface/pay",$pagevar);
	}
	
	public function cabinet(){
		
		if($this->input->get('err') !== FALSE):
			redirect('basket'.urlGETParameters());
		endif;
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
		if($this->input->get('status') === FALSE):
			if($this->input->get('result') !== FALSE && ($this->input->get('result') == 0 || $this->input->get('result') == -1)):
				if($this->input->cookie('buy_book') !== FALSE):
					delete_cookie('buy_book');
				elseif($this->validBasket()):
					delete_cookie('basket_books');
					delete_cookie('basket_total_price');
					$this->accounts->updateField($this->account['id'],'basket','');
					$this->account_basket['basket_books'] = $pagevar['basket_list'] = array();
				endif;
				redirect(uri_string().urlGETParameters().'&status=ok');
			endif;
		endif;
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
								$full_path = getcwd().'/catalog/'.$files[$i]['file_name'];
								if(file_exists($full_path)):
									header('Pragma: public');
									header('Expires: 0');
									header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
									header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($full_path)).' GMT');
									header('Cache-Control: private',false);
									header('Content-Type: '.$files[$i]['file_type']);
									header('Content-Disposition: attachment; filename="'.basename($full_path).'"');
									header('Content-Transfer-Encoding: binary');
									header('Content-Length: '.filesize($full_path));
									header('Connection: close');
									readfile($full_path);
								else:
									show_404();
								endif;
							endif;
						endfor;
					endif;
				endif;
			endif;
		endif;
		exit;
	}
}
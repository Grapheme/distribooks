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
		$this->load->helper('language');
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
		$this->load->model('meta_titles');
	}
	
	public function cabinet(){

		$this->load->model('signed_books');
		$this->offset = (int)$this->uri->segment(4);
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'breadcrumbs' => array('cabinet'=>lang('user_cabinet')),
			'books' => $this->signed_books->getMyBooks(PER_PAGE_DEFAULT,$this->offset),
			'pages' => $this->pagination('cabinet/my-books',4,$this->signed_books->countAllResults(array('account'=>$this->account['id'])),PER_PAGE_DEFAULT),
		);
		$pagevar['books'] = $this->BooksGenre($pagevar['books']);
		for($i=0;$i<count($pagevar['books']);$i++):
			$pagevar['books'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['books'][$i]['authors']);
		endfor;
		$this->load->view("users_interface/my-books",$pagevar);
	}
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus || ($this->account['group'] != ADMIN_GROUP_VALUE)):
			redirect('');
		endif;
		$this->load->helper('form');
	}
	
	/******************************************** cabinet *******************************************************/
	public function controlPanel(){
		
		$this->load->view("admin_interface/cabinet/control-panel");
	}
	/********************************************** news ********************************************************/
	public function news(){
		
		$this->load->model('news');
		$pagevar = array(
			'news' => $this->news->limit(PER_PAGE_DEFAULT,(int)$this->uri->segment(3)),
			'pages' => $this->pagination(ADMIN_START_PAGE.'/news',4,$this->news->countAllResults(),PER_PAGE_DEFAULT)
		);
		$this->load->view("admin_interface/news/list",$pagevar);
	}
	
	public function addNews(){
		
		$this->load->view("admin_interface/news/add");
	}
	
	public function editNews(){
		
		$this->load->model(array('news','meta_titles'));
		$pagevar = array(
			'news' => $this->news->getWhere($this->input->get('id')),
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('group'=>'news','item_id'=>$this->input->get('id'))),
		);
		$pagevar['news']['date'] = swapDotDateWithoutTime($pagevar['news']['date']);
		$this->load->view("admin_interface/news/edit",$pagevar);
	}
	/******************************************** cabinet *******************************************************/
	
	/********************************************* formats ********************************************************/
	public function formatsСategories(){
		
		$this->load->model('formats_categories');
		$pagevar = array(
			'categories' => $this->formats_categories->getAll()
		);
		$this->load->view("admin_interface/formats/categories",$pagevar);
	}
	
	public function formatsСategoriesEdit(){
		
		$this->load->model('formats_categories');
		$pagevar = array(
			'category' => $this->formats_categories->getWhere($this->input->get('id'))
		);
		$this->load->view("admin_interface/formats/category-edit",$pagevar);
	}
	
	public function formats(){
		
		$this->load->model(array('formats_categories','formats'));
		$pagevar = array(
			'categories' => $this->formats_categories->getAll(),
			'formats' => array()
		);
		if($this->input->get('category') === FALSE || !is_numeric($this->input->get('category'))):
			$pagevar['formats'] = $this->formats->getAll();
		else:
			$pagevar['formats'] = $this->formats->getWhere(NULL,array('category'=>$this->input->get('category')),TRUE);
		endif;
		$this->load->view("admin_interface/formats/list",$pagevar);
	}
	
	public function addFormat(){
		
		$this->load->model('formats_categories');
		$pagevar = array(
			'categories' => $this->formats_categories->getAll()
		);
		$this->load->view("admin_interface/formats/add",$pagevar);
	}
	
	public function editFormat(){
		
		$this->load->model(array('formats_categories','formats'));
		$pagevar = array(
			'categories' => $this->formats_categories->getAll(),
			'format' => $this->formats->getWhere($this->input->get('id'))
		);
		$this->load->view("admin_interface/formats/edit",$pagevar);
	}

	/******************************************** authors ********************************************************/
	public function authorsList(){
		
		$this->load->model('authors');
		$pagevar = array(
			'authors' => array(),
			'pages' => NULL
		);
		if($this->input->get('search') === FALSE || $this->input->get('search') == ''):
			$pagevar['authors'] = $this->authors->limit(PER_PAGE_DEFAULT,$this->uri->segment(4),'ru_name,en_name');
			$pagevar['pages'] = $this->pagination('admin-panel/authors',4,$this->authors->countAllResults(),PER_PAGE_DEFAULT);
		else:
			if($authors = $this->getAuthorsByIDs($this->input->get('search'))):
				$authorsIDs = $this->getValuesInArray($authors,'id');
				$pagevar['authors'] = $this->authors->getWhereIN(array('field'=>'id','where_in'=>$authorsIDs,'many_records'=>TRUE,'order_by'=>'ru_name,en_name'));
			endif;
		endif;
		$this->load->view("admin_interface/authors/list",$pagevar);
	}
	
	public function insertAuthor(){
		
		$this->load->view("admin_interface/authors/add");
	}
	
	public function editAuthor(){
		
		$this->load->model('authors');
		$pagevar = array(
			'author' => $this->authors->getWhere($this->input->get('id'))
		);
		$this->load->view("admin_interface/authors/edit",$pagevar);
	}
	/***********************************************************************************************************/
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		if(!$this->isAdminLoggined()):
			redirect('');
		endif;
		$this->load->helper('form');
	}
	
	/******************************************** cabinet *******************************************************/
	public function controlPanel(){
		
		$this->load->view("admin_interface/cabinet/control-panel");
	}

	public function changePassword(){
		
		$this->load->view("admin_interface/cabinet/profile");
	}
	
	public function promoAction(){
		
		$this->load->model('configuration');
		$pagevar['config'] = $this->configuration->getWhere(1);
		$this->load->view("admin_interface/cabinet/promo",$pagevar);
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
	/********************************************* pages *********************************************************/
	public function pagesList(){
		
		$this->load->model('meta_titles');
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhereIN(array('field'=>'group','where_in'=>array('interface','services','about','donation','pay'),'many_records'=>TRUE))
		);
		$this->load->view("admin_interface/pages/list",$pagevar);
	}

	public function editPage(){
		
		if($this->input->get('id') === FALSE || is_numeric($this->input->get('id')) === FALSE):
			redirect(ADMIN_START_PAGE);
		endif;
		$this->load->model('meta_titles');
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhere($this->input->get('id')),
			'edit_meta_titles' => TRUE,
			'ru_page_content' => array(),
			'en_page_content' => array()
		);
		if(in_array($pagevar['meta_titles']['group'],array('services','about','donation','pay'))):
			$this->load->model('pages');
			if($content = $this->pages->getWhere($pagevar['meta_titles']['item_id'])):
				$pagevar['ru_page_content'] = json_decode($content['ru_content'],TRUE);
				$pagevar['en_page_content'] = json_decode($content['en_content'],TRUE);
			endif;
		endif;
		if(in_array($pagevar['meta_titles']['group'],array('donation'))):
			$pagevar['edit_meta_titles'] = FALSE;
		endif;
		$this->load->view("admin_interface/pages/edit",$pagevar);
	}
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
	/******************************************** genres ********************************************************/
	public function genresList(){
		
		$this->load->model('genres');
		$pagevar = array(
			'genres' => array(),
			'pages' => NULL
		);
		if($this->input->get('search') === FALSE || $this->input->get('search') == ''):
			if($this->input->get('genre') === FALSE || !is_numeric($this->input->get('genre'))):
				$pagevar['genres'] = $this->genres->limit(PER_PAGE_DEFAULT,$this->uri->segment(4));
				$pagevar['pages'] = $this->pagination('admin-panel/genres',4,$this->genres->countAllResults(),PER_PAGE_DEFAULT);
			else:
				$pagevar['genres'] = $this->genres->limit(PER_PAGE_DEFAULT,$this->uri->segment(4),NULL,array('gender'=>$this->input->get('genre')));
				$pagevar['pages'] = $this->pagination('admin-panel/genres',4,$this->genres->countAllResults(array('gender'=>$this->input->get('genre'))),PER_PAGE_DEFAULT);
			endif;
		else:
			if($genres = $this->getGenresByIDs($this->input->get('search'))):
				$genresIDs = $this->getValuesInArray($genres,'id');
				$pagevar['genres'] = $this->genres->getWhereIN(array('field'=>'id','where_in'=>$genresIDs,'many_records'=>TRUE));
			endif;
		endif;
		$this->load->view("admin_interface/genres/list",$pagevar);
	}
	
	public function insertGenre(){
		
		$this->load->view("admin_interface/genres/add");
	}
	
	public function editGenre(){
		
		$this->load->model('genres');
		$pagevar = array(
			'genre' => $this->genres->getWhere($this->input->get('id'))
		);
		$this->load->view("admin_interface/genres/edit",$pagevar);
	}
	/******************************************** books ********************************************************/
	public function booksList(){
		
		$this->load->model(array('books','genres'));
		$pagevar = array(
			'books' => array(),
			'genres' => $this->genres->getAll(),
			'pages' => NULL
		);
		if($this->input->get('search') === FALSE || $this->input->get('search') == ''):
			if($this->input->get('genre') === FALSE || !is_numeric($this->input->get('genre'))):
				$pagevar['books'] = $this->books->limit(PER_PAGE_DEFAULT,$this->uri->segment(4));
				$pagevar['pages'] = $this->pagination('admin-panel/books',4,$this->books->countAllResults(),PER_PAGE_DEFAULT);
			else:
				$pagevar['books'] = $this->books->limit(PER_PAGE_DEFAULT,$this->uri->segment(4),NULL,array('genre'=>$this->input->get('genre')));
				$pagevar['pages'] = $this->pagination('admin-panel/books',4,$this->books->countAllResults(array('genre'=>$this->input->get('genre'))),PER_PAGE_DEFAULT);
			endif;
		else:
			if($books = $this->getBooksByIDs($this->input->get('search'))):
				$booksIDs = $this->getValuesInArray($books,'id');
				$pagevar['books'] = $this->books->getWhereIN(array('field'=>'id','where_in'=>$booksIDs,'many_records'=>TRUE));
			endif;
		endif;
		$this->load->view("admin_interface/books/list",$pagevar);
	}
	
	public function insertBook(){
		
		$this->load->model(array('genres','age_limit','currency'));
		$pagevar = array(
			'genres' => $this->genres->getAll(),
			'age_limit' => $this->age_limit->getAll(),
			'currency' => $this->currency->getAll(),
		);
		$this->load->view("admin_interface/books/add",$pagevar);
	}
	
	public function editBook(){
		
		$this->load->model(array('genres','age_limit','currency','books','meta_titles'));
		$pagevar = array(
			'book' => $this->books->getWhere($this->input->get('id')),
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('group'=>'books','item_id'=>$this->input->get('id'))),
			'genres' => $this->genres->getAll(),
			'age_limit' => $this->age_limit->getAll(),
			'currency' => $this->currency->getAll(),
			'authors' => array()
		);
		$pagevar['authors'] = $this->getAuthorsByIDs($pagevar['book']['authors']);
		$pagevar['book']['keywords'] = $this->getBookKeyWords($pagevar['book']['id']);
		$this->load->view("admin_interface/books/edit",$pagevar);
	}
	
	public function uploadBooks(){
		
		$this->load->model(array('books','formats'));
		$pagevar = array(
			'book' => $this->books->getWhere($this->input->get('id')),
			'formats' => $this->formats->getAll()
		);
		$this->load->view("admin_interface/books/upload",$pagevar);
	}
	/***********************************************************************************************************/
}
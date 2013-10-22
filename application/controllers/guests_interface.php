<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{

	var $offset = 0;
	
	function __construct(){

		parent::__construct();
		if($this->uri->language_string === FALSE):
			$this->config->set_item('base_url',baseURL($this->baseLanguageURL.'/'));
			redirect();
		else:
			$this->config->set_item('base_url',baseURL($this->uri->language_string.'/'));
		endif;
		$this->load->helper('language');
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
		$this->load->model('meta_titles');
	}
	
	public function page404(){
		
		echo '404';
	}
	
	public function index(){
		
		$this->load->model('news');
		
		$pagevar = array(
			'page_content'=> array(),
			'sliderExist' =>TRUE,
			'news' => $this->news->limit(3)
		);
		
		$pagevar['news'] = $this->setPageAddress($pagevar['news'],'news');
		$this->load->view("guests_interface/index",$pagevar);
	}
	
	/************************************************ pages ***********************************************************/
	public function redirectPage(){
		
		if($this->uri->segment(1) !== FALSE):
			$pageContent = '';
			if($page = $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1)))):
				$pagevar = array('meta_titles'=>$page);
				switch($page['group']):
					case 'news':
						$this->load->model('news');
						$pagevar['news'] = $this->news->getWhere($page['item_id']);
						$pagevar['breadcrumbs'] = array('news'=>lang('news_block'),$page['page_address']=>$pagevar['news'][$this->uri->language_string.'_title']);
						$pageContent = $this->load->view('guests_interface/single-news',$pagevar,TRUE);
						break;
					case 'books':
						$this->load->model(array('books_card','currency','age_limit','genres'));
						$pagevar['book'] = $this->books_card->getWhere($page['item_id']);
						$pagevar['authors'] = $this->getAuthorsByIDs($pagevar['book']['authors']);
						$pagevar['currency'] = $this->currency->getAll();
						$pagevar['age_limit'] = $this->age_limit->getAll();
						$pagevar['book']['genre_title'] = $this->genres->value($pagevar['book']['genre'],$this->uri->language_string.'_title');
						
						if($keywords = $this->getBookKeyWords($page['item_id'])):
							$pagevar['keywords'] = explode(',',$keywords);
						endif;
						
						$pagevar['breadcrumbs'] = array('catalog'=>lang('catalog_catalog'),$page['page_address']=>$pagevar['book'][$this->uri->language_string.'_title']);
						$pageContent = $this->load->view('guests_interface/single-book',$pagevar,TRUE);
						break;
				endswitch;
			endif;
			if(empty($pageContent) === FALSE):
				echo $pageContent;
			endif;
		endif;
		show_404();
	}
	
	public function news(){
		
		$this->load->model('news');
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'news' => $this->news->limit(PER_PAGE_DEFAULT,(int)$this->uri->segment(3)),
			'pages'=> $this->pagination('news',3,$this->news->countAllResults(),PER_PAGE_DEFAULT),
			'breadcrumbs' => array('news'=>lang('news_block'))
		);
		$pagevar['news'] = $this->setPageAddress($pagevar['news'],'news');
		$this->load->view("guests_interface/news",$pagevar);
	}
	
	public function about(){
		
		$pagevar = array(
			'page_content'=>array()
		);
		$this->load->view("guests_interface/about",$pagevar);
	}
	
	public function editing(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/editing",$pagevar);
	}
	
	public function typography(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/typography",$pagevar);
	}
	
	public function translation(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/translation",$pagevar);
	}
	
	public function distribution(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/distribution",$pagevar);
	}
	
	public function formats(){
		
		$this->load->model('formats');
		$pagevar = array(
			'page_content'=> array(),
			'breadcrumbs' => array('formats'=>'FORMATS'),
			'formats'=>$this->formats->getWhere(NULL,array('visible'=>1),TRUE)
		);
		$this->load->view("guests_interface/formats",$pagevar);
	}
	
	/*********************************************** catalog ***********************************************************/
	
	public function catalog(){
		
		$this->load->model(array('books_card','currency'));
		$pagevar = array(
			'page_content'=> array(),
			'breadcrumbs' => array('catalog'=>lang('catalog_catalog')),
			'bestsellers' => $this->books_card->limit(5,$this->uri->segment(4)),
			'trailers' => $this->books_card->limit(5,$this->uri->segment(4)),
			'novelty' => $this->books_card->limit(5,$this->uri->segment(4)),
			'recommended' => $this->books_card->limit(5,$this->uri->segment(4)),
			'catalog' => $this->books_card->limit(PER_PAGE_DEFAULT,$this->uri->segment(4)),
			'pages' => $this->pagination('catalog',4,$this->books_card->countAllResults(),PER_PAGE_DEFAULT),
			'currency' => $this->currency->getAll()
		);
		for($i=0;$i<count($pagevar['catalog']);$i++):
			$pagevar['catalog'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['catalog'][$i]['authors']);
		endfor;
		for($i=0;$i<count($pagevar['bestsellers']);$i++):
			$pagevar['bestsellers'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['bestsellers'][$i]['authors']);
		endfor;
		for($i=0;$i<count($pagevar['novelty']);$i++):
			$pagevar['novelty'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['novelty'][$i]['authors']);
		endfor;
		for($i=0;$i<count($pagevar['recommended']);$i++):
			$pagevar['recommended'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['recommended'][$i]['authors']);
		endfor;
		$pagevar['catalog'] = $this->BooksGenre($pagevar['catalog']);
		$pagevar['bestsellers'] = $this->BooksGenre($pagevar['bestsellers']);
		$pagevar['novelty'] = $this->BooksGenre($pagevar['novelty']);
		$pagevar['recommended'] = $this->BooksGenre($pagevar['recommended']);
		$this->load->view("guests_interface/catalog",$pagevar);
	}
	
	private function BooksGenre($books){
		
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
	
	private function setPageAddress($elements,$group){
		
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
}
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
						$pagevar['keywords'] = array();
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
			'bestsellers' => $this->books_card->limit(6),
			'trailers' => array('1','2'),
			'novelty' => $this->books_card->limit(6),
			'recommended' => $this->books_card->limit(6),
			'catalog' => array(),
			'pages' => NULL,
			'currency' => $this->currency->getAll()
		);
		
		$sortBy = NULL;
		$tags = $genre = FALSE;
		if($this->input->get('tag') !== FALSE && $this->input->get('tag') != ''):
			$tags = TRUE;
		endif;
		if($this->input->get('sort') !== FALSE && in_array($this->input->get('sort'),array('price',$this->uri->language_string.'_title','rating')) !== FALSE):
			if($this->input->get('directing') !== FALSE && in_array($this->input->get('directing'),array('desc','asc'))):
				$sortBy = $this->input->get('sort').' '.$this->input->get('directing');
			endif;
		endif;
		if($this->input->get('genre') !== FALSE && is_numeric($this->input->get('genre')) === TRUE):
			$genre = TRUE;
		endif;
		if(is_null($sortBy) && $tags === FALSE && $genre === FALSE):
			$this->offset = (int)$this->uri->segment(3);
			$pagevar['catalog'] = $this->books_card->limit(PER_PAGE_DEFAULT,$this->offset);
			$pagevar['pages'] = $this->pagination('catalog',3,$this->books_card->countAllResults(),PER_PAGE_DEFAULT);
		else:
			$this->offset = (int)$this->input->get('offset');
			if($genre === TRUE):
				$pagevar['catalog'] = $this->books_card->limit(PER_PAGE_DEFAULT,$this->offset,$sortBy,array('genre'=>$this->input->get('genre')));
				$pagevar['pages'] = $this->pagination('catalog'.urlGETParameters('offset'),3,$this->books_card->countAllResults(array('genre'=>$this->input->get('genre'))),PER_PAGE_DEFAULT,TRUE);
				$this->load->model('genres');
				$pagevar['tag_genre'] = $this->genres->value($this->input->get('genre'),$this->uri->language_string.'_title');
			endif;
			if($tags === TRUE):
				//$pagevar['catalog'] = $this->books_card->limit(PER_PAGE_DEFAULT,$this->offset,NULL,);
				//$pagevar['pages'] = $this->pagination('catalog',3,$this->books_card->countAllResults(),PER_PAGE_DEFAULT);
			endif;
		endif;
		
		/*print_r($pagevar['catalog']);exit;*/
		
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
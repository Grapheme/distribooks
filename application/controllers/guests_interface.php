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
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
		$this->load->model('meta_titles');
		$this->getAccountBasketBooks();
	}
	
	public function page404(){
		
		echo '404';
	}
	
	public function index(){
		
		$this->load->model(array('news','books_card'));
		$pagevar = array(
			'page_content'=> array(),
			'sliderExist' =>TRUE,
			'news' => $this->news->limit(3),
			'novelty' => $this->books_card->limit(4),
			'basket_list' => $this->getBooksInBasket()
		);
		for($i=0;$i<count($pagevar['novelty']);$i++):
			$pagevar['novelty'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['novelty'][$i]['authors']);
		endfor;
		$pagevar['novelty'] = $this->BooksGenre($pagevar['novelty']);
		$pagevar['novelty'] = $this->mySignedBooks($pagevar['novelty']);
		$pagevar['novelty'] = $this->booksInBasket($pagevar['novelty']);
		$pagevar['news'] = $this->setPageAddress($pagevar['news'],'news');
		$this->load->view("guests_interface/index",$pagevar);
	}
	/************************************************ pages ***********************************************************/
	public function redirectPage(){
		
		if($this->uri->segment(1) !== FALSE):
			$pageContent = '';
			if($page = $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1)))):
				$pagevar = array('meta_titles'=>$page,'basket_list'=>$this->getBooksInBasket());
				
				switch($page['group']):
					case 'news':
						$this->load->model('news');
						$pagevar['news'] = $this->news->getWhere($page['item_id']);
						$pagevar['breadcrumbs'] = array('news'=>lang('news_block'),$page['page_address']=>$pagevar['news'][$this->uri->language_string.'_title']);
						$pageContent = $this->load->view('guests_interface/single-news',$pagevar,TRUE);
						break;
					case 'books':
						$this->load->model(array('books_card','age_limit','genres'));
						$pagevar['book'] = $this->books_card->getWhere($page['item_id']);
						$signedBook = $this->mySignedBooks(array($pagevar['book']));
						$signedBook = $this->booksInBasket($signedBook);
						$pagevar['book'] = $signedBook[0];
						$pagevar['book']['genre_title'] = $this->genres->value($pagevar['book']['genre'],$this->uri->language_string.'_title');
						$pagevar['authors'] = $this->getAuthorsByIDs($pagevar['book']['authors']);
						$pagevar['age_limit'] = $this->age_limit->getWhere($pagevar['book']['age_limit']);
						$pagevar['formats'] = $this->getBookFormats($pagevar['book']['files']);
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
				return TRUE;
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
			'breadcrumbs' => array('news'=>lang('news_block')),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['news'] = $this->setPageAddress($pagevar['news'],'news');
		$this->load->view("guests_interface/news",$pagevar);
	}
	
	public function about(){
		
		$pagevar = array(
			'page_content'=>array(),
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/about",$pagevar);
	}
	
	public function editing(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE,
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/editing",$pagevar);
	}
	
	public function typography(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE,
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/typography",$pagevar);
	}
	
	public function translation(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE,
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/translation",$pagevar);
	}
	
	public function distribution(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE,
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/distribution",$pagevar);
	}
	
	public function formats(){
		
		$this->load->model('formats');
		$pagevar = array(
			'page_content'=> array(),
			'breadcrumbs' => array('formats'=>'FORMATS'),
			'formats'=>$this->formats->getWhere(NULL,array('visible'=>1),TRUE),
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/formats",$pagevar);
	}
	/*********************************************** basket ***********************************************************/
	public function basket(){
		
		$pagevar = array(
		
		);
		$this->load->view("guests_interface/basket",$pagevar);
	}
	/*********************************************** catalog ***********************************************************/
	public function catalog(){
		
		$this->load->model('books_card');
		$pagevar = array(
			'page_content'=> array(),
			'breadcrumbs' => array('catalog'=>lang('catalog_catalog')),
			'bestsellers' => $this->books_card->limit(6),
			'trailers' => array('1','2'),
			'novelty' => $this->books_card->limit(6),
			'recommended' => $this->books_card->limit(6),
			'catalog' => array(),
			'pages' => NULL,
			'basket_list' => $this->getBooksInBasket()
		);
		$sortBy = NULL; $tags = $genre = $keyword = $author = FALSE;
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
		if($this->input->get('keyword') !== FALSE && $this->input->get('keyword') != ''):
			$keyword = TRUE;
		endif;
		if($this->input->get('author') !== FALSE && is_numeric($this->input->get('author')) === TRUE):
			$author = TRUE;
		endif;
		if(is_null($sortBy) && $tags === FALSE && $genre === FALSE && $keyword === FALSE && $author === FALSE):
			$this->offset = (int)$this->uri->segment(3);
			$pagevar['catalog'] = $this->books_card->limit(PER_PAGE_DEFAULT,$this->offset);
			$pagevar['pages'] = $this->pagination('catalog',3,$this->books_card->countAllResults(),PER_PAGE_DEFAULT);
		elseif(!is_null($sortBy) && $tags === FALSE && $genre === FALSE && $keyword === FALSE && $author === FALSE):
			$this->offset = (int)$this->input->get('offset');
			$pagevar['catalog'] = $this->books_card->limit(PER_PAGE_DEFAULT,$this->offset,$sortBy);
			$pagevar['pages'] = $this->pagination('catalog'.urlGETParameters('offset'),3,$this->books_card->countAllResults(),PER_PAGE_DEFAULT,TRUE);
		else:
			$this->offset = (int)$this->input->get('offset');
			if($genre === TRUE):
				$pagevar['catalog'] = $this->books_card->limit(PER_PAGE_DEFAULT,$this->offset,$sortBy,array('genre'=>$this->input->get('genre')));
				$pagevar['pages'] = $this->pagination('catalog'.urlGETParameters('offset'),3,$this->books_card->countAllResults(array('genre'=>$this->input->get('genre'))),PER_PAGE_DEFAULT,TRUE);
				$this->load->model('genres');
				$pagevar['tag_genre'] = $this->genres->value($this->input->get('genre'),$this->uri->language_string.'_title');
			endif;
			if($keyword === TRUE):
				$this->load->model('keywords');
				if($wordID = $this->keywords->search('word_hash',$this->input->get('keyword'))):
					$pagevar['catalog'] = $this->books_card->getBooksByKeyWord(PER_PAGE_DEFAULT,$this->offset,$sortBy,array('word_id'=>$wordID));
					$pagevar['pages'] = $this->pagination('catalog'.urlGETParameters('offset'),3,$this->books_card->countResultsByKeyWord(array('word_id'=>$wordID)),PER_PAGE_DEFAULT,TRUE);
					$pagevar['tag_keyword'] = $this->keywords->value($wordID,'word');
				endif;
			endif;
			if($author === TRUE):
				$pagevar['catalog'] = $this->books_card->getBooksByAuthor(PER_PAGE_DEFAULT,$this->offset,$sortBy,array('author'=>$this->input->get('author')));
				$pagevar['pages'] = $this->pagination('catalog'.urlGETParameters('offset'),3,$this->books_card->countResultsByAuthor(array('author'=>$this->input->get('author'))),PER_PAGE_DEFAULT,TRUE);
				$this->load->model('authors');
				$pagevar['tag_author'] = $this->authors->value($this->input->get('author'),$this->uri->language_string.'_name');
			endif;
		endif;
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
		
		$pagevar['catalog'] = $this->mySignedBooks($pagevar['catalog']);
		$pagevar['catalog'] = $this->booksInBasket($pagevar['catalog']);
		$pagevar['bestsellers'] = $this->mySignedBooks($pagevar['bestsellers']);
		$pagevar['bestsellers'] = $this->booksInBasket($pagevar['bestsellers']);
		$pagevar['novelty'] = $this->mySignedBooks($pagevar['novelty']);
		$pagevar['novelty'] = $this->booksInBasket($pagevar['novelty']);
		$pagevar['recommended'] = $this->mySignedBooks($pagevar['recommended']);
		$pagevar['recommended'] = $this->booksInBasket($pagevar['recommended']);
		$this->load->view("guests_interface/catalog",$pagevar);
	}
	
}
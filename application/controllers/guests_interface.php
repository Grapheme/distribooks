<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{

	var $offset = 0;
	var $TotalCount = 0;
	
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
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>'home')),
			'sliderExist' =>TRUE,
			'news' => $this->news->limit(3),
			'novelty' => $this->books_card->limit(4,0,'id DESC'),
			'basket_list' => $this->getBooksInBasket(),
			'trailers' => $this->getTrailers(2)
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
	
	public function trailers(){
		
		$this->offset = (int)$this->uri->segment(3);
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'trailers' => $this->getTrailers(1),
			'breadcrumbs' => array(),
			'pages' => $this->pagination('trailers',3,$this->TotalCount,1)
		);
		$pagevar['breadcrumbs'] = array('catalog'=>$pagevar['page_content'][$this->uri->language_string.'_page_title']);
		$this->load->view("guests_interface/trailers",$pagevar);
	}
	
	public function getTrailers($limit = NULL){
		
		$this->load->model('books_card');
		$trailers = array();
		if($trailersJSON = $this->books_card->getTrailers($limit,$this->offset)):
			$this->TotalCount = count($this->books_card->getTrailers());
			for($i=0;$i<count($trailersJSON);$i++):
				if($trailer = json_decode($trailersJSON[$i]['trailers'],TRUE)):
					$trailers[] = $trailer[0];
				endif;
			endfor;
		endif;
		return $trailers;
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
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'breadcrumbs' => array(),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['breadcrumbs'] = array('about'=>$pagevar['page_content'][$this->uri->language_string.'_page_title']);
		$this->load->view("guests_interface/about",$pagevar);
	}

	public function sale(){
		
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/sale",$pagevar);
	}
	
	public function editing(){
		
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'sliderExist' =>TRUE,
			'breadcrumbs' => array(),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['breadcrumbs'] = array('editing'=>$pagevar['page_content'][$this->uri->language_string.'_page_title']);
		$this->load->view("guests_interface/editing",$pagevar);
	}
	
	public function typography(){
		
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'sliderExist' =>TRUE,
			'breadcrumbs' => array(),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['breadcrumbs'] = array('typography'=>$pagevar['page_content'][$this->uri->language_string.'_page_title']);
		$this->load->view("guests_interface/typography",$pagevar);
	}
	
	public function translation(){
		
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'sliderExist' =>TRUE,
			'breadcrumbs' => array(),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['breadcrumbs'] = array('translation'=>$pagevar['page_content'][$this->uri->language_string.'_page_title']);
		$this->load->view("guests_interface/translation",$pagevar);
	}
	
	public function distribution(){
		
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'sliderExist' =>TRUE,
			'breadcrumbs' => array(),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['breadcrumbs'] = array('distribution'=>$pagevar['page_content'][$this->uri->language_string.'_page_title']);
		$this->load->view("guests_interface/distribution",$pagevar);
	}
	
	public function formats(){
		
		$this->load->model('formats');
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'breadcrumbs' => array(),
			'formats'=>$this->formats->getWhere(NULL,array('visible'=>1),TRUE),
			'basket_list' => $this->getBooksInBasket()
		);
		$pagevar['breadcrumbs'] = array('formats'=>$pagevar['page_content'][$this->uri->language_string.'_page_title']);
		$this->load->view("guests_interface/formats",$pagevar);
	}
	/*********************************************** search ***********************************************************/
	public function searchResults(){
		
		$this->load->model('books_card');
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'breadcrumbs' => array('search'.urlGETParameters()=>lang('search_catalog')),
		);
		if($this->input->get('param') !== FALSE && $this->input->get('param') != ''):
			$this->offset = (int)$this->input->get('offset');
			$pagevar['catalog'] = $this->foundBooks($this->input->get('param'));
			for($i=0;$i<count($pagevar['catalog']);$i++):
				$pagevar['catalog'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['catalog'][$i]['authors']);
			endfor;
			$pagevar['catalog'] = $this->BooksGenre($pagevar['catalog']);
			$pagevar['catalog'] = $this->mySignedBooks($pagevar['catalog']);
			$pagevar['catalog'] = $this->booksInBasket($pagevar['catalog']);
			$pagevar['pages'] = $this->pagination('search?param='.$this->input->get('param'),3,$this->TotalCount,PER_PAGE_DEFAULT,TRUE);
		endif;
		$this->load->view("guests_interface/search-results",$pagevar);
	}
	
	private function foundBooks($searchString = ''){
		
		$books = array(); $booksCount = 0; $IDs = array();
		$booksAuthors = array();
		$booksGenres = array();
		$booksKeyWords = array();
		$booksSphinx = array();
		if(!empty($searchString)):
			$this->load->model(array('authors','keywords','books_card','genres'));
			if($IDs = $this->authors->searchAuthorsByString($searchString)):
				$IDs = $this->getValuesInArray($IDs);
				$booksAuthors = $this->books_card->getBooksIDsByAuthorsIDs(PER_PAGE_DEFAULT,$this->offset,$IDs);
			endif;
			if($IDs = $this->keywords->searchKeywordsByString($searchString)):
				$IDs = $this->getValuesInArray($IDs);
				$booksKeyWords = $this->books_card->getBooksIDsByKeyWords(PER_PAGE_DEFAULT,$this->offset,$IDs);
			endif;
			if($IDs = $this->genres->searchGenresByString($searchString)):
				$IDs = $this->getValuesInArray($IDs);
				$booksGenres = $this->books_card->getBooksIDsByGenres(PER_PAGE_DEFAULT,$this->offset,$IDs);
			endif;
			$booksSphinx = $this->getBooksBySphinxSearch($searchString);
		endif;
		$booksIDs = $this->mergingSearchArrays($booksAuthors,$booksKeyWords,$booksGenres,$booksSphinx);
		$books = $this->getUniqueBooks($booksIDs);
		$this->TotalCount = count($books);
		return $books;
	}
	
	private function mergingSearchArrays($authors,$keywords,$booksGenres,$sphinx){
		
		$books = array();
		if(!empty($authors)):
			$books = $authors;
		endif;
		if(!empty($keywords)):
			for($i=0;$i<count($keywords);$i++):
				$books[] = $keywords[$i];
			endfor;
		endif;
		if(!empty($booksGenres)):
			for($i=0;$i<count($booksGenres);$i++):
				$books[] = $booksGenres[$i];
			endfor;
		endif;
		if(!empty($sphinx)):
			for($i=0;$i<count($sphinx);$i++):
				$books[] = $sphinx[$i];
			endfor;
		endif;
		return $books;
	}
	
	private function getBooksBySphinxSearch($searchString = ''){
		
		if(!empty($searchString)):
			$booksSphinx = array();
			/*$this->load->library('sphinxclient');
			$this->sphinxclient->SetServer('localhost',9312);
			$this->sphinxclient->SetMatchMode(SPH_MATCH_ANY);
			$this->sphinxclient->SetLimits($this->offset,PER_PAGE_DEFAULT);
			$this->sphinxclient->SetSortMode(SPH_SORT_RELEVANCE);
			$this->sphinxclient->SetFieldWeights(array('ru_title'=>50,'en_title'=>50,'ru_text'=>30,'en_text'=>20,'ru_anonce'=>5,'en_anonce'=>5));
			$result = $this->sphinxclient->Query($searchString,'distribbooks');
			if($result && isset($result['matches'])):
				if($booksIDs = array_keys($result['matches'])):
					print_r($booksIDs);
					return $booksSphinx;
				endif;
			endif;*/
			if($books = $this->books_card->getBooksIDsByString($searchString)):
				return $books;
			endif;
		endif;
		return NULL;
	}
	
	private function getUniqueBooks($books){
		
		if($booksIDs = $this->getValuesInArray($books)):
			$booksIDs = array_unique($booksIDs);
			return $this->books_card->getBooksByIDs($booksIDs);
		endif;
		return NULL;
	}
	/*********************************************** basket ***********************************************************/
	public function basket(){
		
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>uri_string())),
			'breadcrumbs' => array('basket'=>lang('catalog_catalog')),
			'basket_list' => $this->getBooksInBasket()
		);
		$this->load->view("guests_interface/basket",$pagevar);
	}
	/*********************************************** catalog ***********************************************************/
	public function catalog(){
		
		$this->load->model('books_card');
		$pagevar = array(
			'page_content'=> $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'breadcrumbs' => array('catalog'=>lang('catalog_catalog')),
			'bestsellers' => $this->getBestSellers(),
			'trailers' => array('1','2'),
			'novelty' => $this->books_card->limit(4,0,'id DESC'),
			'recommended' => $this->getRecommended(),
			'catalog' => array(),
			'pages' => NULL,
			'basket_list' => $this->getBooksInBasket(),
			'trailers' => $this->getTrailers(2)
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
		
		$pagevar['catalog'] = $this->sortCatalogByPrice($pagevar['catalog']);
		$this->load->view("guests_interface/catalog",$pagevar);
	}
	
	private function getBestSellers($limit = 4){
		
		$BestSellers = array();
		$this->load->model(array('signed_books','books_card'));
		$sql = "SELECT book AS id,COUNT(*) AS max_signed FROM signed_books GROUP BY book ORDER BY max_signed DESC LIMIT $limit";
		if($maxSigned = $this->signed_books->execute($sql)):
			if($booksIDs = $this->getValuesInArray($maxSigned)):
				$BestSellers = $this->books_card->getBooksByIDs($booksIDs);
				$BestSellers = $this->getBooksSortByIDs($BestSellers,$booksIDs);
			endif;
		endif;
		return $BestSellers;
	}
	
	private function getRecommended($limit = 4){
		
		$this->load->model('books_card');
		$sql = "SELECT *,(price - price_action) AS max_subprice FROM books_card WHERE price > 0 && price_action > 0 ORDER BY max_subprice DESC LIMIT $limit";
		return $this->books_card->execute($sql);
	}
	
	private function sortCatalogByPrice($catalog){
		
		if($this->input->get('sort') == 'price'):
			for($i=0;$i<count($catalog);$i++):
				if($catalog[$i]['price_action'] == 0):
					$catalog[$i]['price_action'] = 1000000;
				endif;
				$catalog[$i]['sort_price'] = min($catalog[$i]['price'],$catalog[$i]['price_action']);
			endfor;
			for($i=0;$i<count($catalog);$i++):
				if($catalog[$i]['price_action'] == 1000000):
					$catalog[$i]['price_action'] = 0;
				endif;
			endfor;
			if($this->input->get('directing') == 'asc'):
				$catalog = $this->AssociateSort($catalog,'sort_price');
			elseif($this->input->get('directing') == 'desc'):
				$catalog = $this->AssociateRSort($catalog,'sort_price');
			endif;
		endif;
		return $this->reIndexArray($catalog);
	}
	
}
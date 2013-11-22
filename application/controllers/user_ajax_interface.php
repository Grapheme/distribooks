<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
	}
	
	public function buySingleBook(){
		
		if(isUserLoggined()):
			if($this->postDataValidation('buy_book')):
				$this->load->model(array('books','signed_books'));
				if($this->books->getWhere($this->input->post('book'))):
					if(!$this->signed_books->getWhere(NULL,array('book'=>$this->input->post('book'),'account'=>$this->account['id']))):
						$this->input->set_cookie('buy_book',$this->input->post('book'));
						$this->json_request['redirect'] = site_url($this->uri->language_string.'/pay');
					endif;
				endif;
				/*if($signedID = $this->buyBook($this->input->post('book'))):
					$this->json_request['status'] = TRUE;
					$this->json_request['responseText'] = 'Книга куплена успешно';
					$this->load->model('books_card');
					$this->json_request['redirect'] = site_url($this->uri->language_string.'/'.$this->books_card->value($this->input->post('book'),'page_address'));
				endif;*/
			else:
				$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
			endif;
		endif;
		echo json_encode($this->json_request);
	}
	
	public function basketBuyBooks(){
		
		if(isUserLoggined()):
			if($this->validBasket() === FALSE):
				$this->getDBBasket();
			endif;
			if($this->validBasket() === TRUE):
				if($booksIDs = $this->getAccountBasketBooks()):
					for($i=0;$i<count($booksIDs);$i++):
						$this->buyBook($booksIDs[$i]);
					endfor;
					delete_cookie('basket_books');
					delete_cookie('basket_total_price');
					$this->accounts->updateField($this->account['id'],'basket','');
					$this->json_request['status'] = TRUE;
					$this->json_request['redirect'] = site_url($this->uri->language_string.'/'.USER_START_PAGE);
				endif;
			endif;
		endif;
		echo json_encode($this->json_request);
	}
	
	public function addBookInBasket(){
		
		$this->json_request['responseBooks']=''; $this->json_request['booksTotalPrice'] = 0;
		$this->json_request['responseBooksActions'] = ''; $this->json_request['isFullAction'] = FALSE;
		if($this->postDataValidation('buy_book')):
			$booksBasketCount = count($this->getValuesBasketBooksCookie());
			if($booksBasketCount <= MAX_BOOKS_IN_BASKET):
				$subNumber = floor($booksBasketCount/$this->project_config['free_book']);
				if($subNumber > 0 && $booksBasketCount > ($this->project_config['free_book']*$subNumber+1)):
					$booksBasketCount = $booksBasketCount - $subNumber;
				endif;
				if($booksBasketCount%($this->project_config['free_book']-1) == 0):
					$this->json_request['responseBooksActions'] = $this->createBasketBlockEmptyAction();
				elseif($booksBasketCount%($this->project_config['free_book']) == 0):
					$this->json_request['responseBooksActions'] = $this->createBasketBlockAction($this->input->post('book'));
					$this->json_request['isFullAction'] = TRUE;
				endif;
				if($this->json_request['isFullAction'] === FALSE):
					$this->json_request['responseBooks'] = $this->createBasketBlock($this->input->post('book'));
					$this->json_request['booksTotalPrice'] = $this->getBasketTotalPrice();
					set_cookie('basket_total_price',$this->json_request['booksTotalPrice'],time()+86500,'','/');
				endif;
				$this->setDBBasket();
				$this->json_request['status'] = TRUE;
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function removeBookInBasket(){
		
		$json_request = array('booksTotalPrice'=>0,'removeLastsActioBook'=>FALSE);
		if($this->postDataValidation('buy_book')):
			$this->json_request['removeLastActioBook'] = $this->removeBasketBlocks();
			$this->setDBBasket();
			$this->json_request['booksTotalPrice'] = $this->getBasketTotalPrice();
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function refreshBooksInBasket(){
		
		$this->getAccountBasketBooks();
		if($basket_list = $this->getBooksInBasket()):
			$this->json_request['responseText'] = $this->load->view('guests_interface/html/basket/basket-full-lists',array('basket_list'=>$basket_list),TRUE);
			$this->json_request['booksTotalPrice'] = $this->getBasketTotalPrice();
			$this->json_request['status'] = TRUE;
		endif;
		echo json_encode($this->json_request);
	}

	public function clearBasket(){
		
		if(isUserLoggined()):
			$this->accounts->updateField($this->account['id'],'basket','');
		endif;
		delete_cookie('basket_books');
		delete_cookie('basket_total_price');
		$this->json_request['status'] = TRUE;
		echo json_encode($this->json_request);
	}

	public function setBookRating(){
		
		
		if(isUserLoggined()):
			if($this->postDataValidation('book_rating')):
				if($book = $this->validSignedBook($this->input->post('book'))):
					$this->load->model('books_rating');
					if($ratingID = $this->books_rating->search('book',$this->input->post('book'),array('account'=>$this->account['id']))):
						$update = array('id'=>$ratingID,'value'=>$this->input->post('rating'));
						$this->updateItem(array('update'=>$update,'model'=>'books_rating'));
						$this->json_request['status'] = TRUE;
					else:
						$insert = array('book'=>$this->input->post('book'),'account'=>$this->account['id'],'value'=>$this->input->post('rating'));
						$this->json_request['status'] = $this->insertItem(array('insert'=>$insert,'model'=>'books_rating'));
					endif;
					$this->updateBookRating($this->input->post('book'));
				endif;
			else:
				$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
			endif;
		endif;
		echo json_encode($this->json_request);
	}
	
	private function updateBookRating($bookID){
		
		$this->load->model(array('books_rating','books'));
		$total_summa = $this->books_rating->getTotalRatingSumma($bookID);
		$total_count = $this->books_rating->countAllResults(array('book'=>$bookID));
		if($total_summa > 0 && $total_count > 0):
			$rating = ceil($total_summa/$total_count);
			$this->books->updateField($bookID,'rating',$rating);
			return TRUE;
		endif;
		return FALSE;
	}
	
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_ajax_interface extends MY_Controller {
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
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
		if($this->postDataValidation('buy_book')):
			$booksBasketCount = count($this->getValuesBasketBooksCookie());
			if(($booksBasketCount%$this->project_config['free_book']) == 0):
				$this->json_request['responseBooks'] = $this->createBasketBlockAction($this->input->post('book'));
			else:
				$this->json_request['responseBooks'] = $this->createBasketBlock($this->input->post('book'));
			endif;
			$this->json_request['booksTotalPrice'] = $this->getBasketTotalPrice();
			set_cookie('basket_total_price',$this->json_request['booksTotalPrice'],time()+86500,'','/');
			$this->json_request['status'] = TRUE;
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
			$this->load->library('plural_words');
			$this->json_request['responseText'] = $this->load->view('guests_interface/html/basket/basket-full-lists',array('basket_list'=>$basket_list),TRUE);
			$this->json_request['booksTotalPrice'] = $this->getBasketTotalPrice();
			$this->json_request['booksTotalCount'] = count($basket_list).' '.$this->plural_words->pluralBook(count($basket_list),$this->uri->language_string);
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
	
	public function payBookPayU(){
		
		if($this->postDataValidation('PayU') == TRUE):
			if($booksIDs = json_decode($this->input->post('books'))):
				$this->load->model('books');
				if($books = $this->books->getBooksByIDs($booksIDs,'id,ru_title,en_title,price,price_action')):
					$booksIDsTranse = array();
					for($i=0;$i<count($booksIDs);$i++):
						$booksIDsTranse[]['id'] = $booksIDs[$i];
					endfor;
					$sortBooks = $this->sortArrayByArray($books,$booksIDsTranse);
					if($this->json_request['transaction'] = $this->writeToFinancialReport(1,$this->input->post('total'),$this->input->post('books'))):
						$this->json_request['transaction_time'] = date("Y-m-d");
						$this->json_request['order_hash'] = $this->getPayUHash($this->input->post(),$sortBooks,$this->json_request['transaction'],$this->json_request['transaction_time']);
						$this->json_request['status'] = TRUE;
					endif;
				endif;
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
	public function noEmailAsk(){
		
		if(isUserLoggined()):
			$this->accounts->updateField($this->account['id'],'no_ask_email',1);
			$this->json_request['status'] = TRUE;
		endif;
		echo json_encode($this->json_request);
	}
	
	public function requestPayStatus(){
		
		if(isUserLoggined()):
			$this->load->model(array('signed_books','financial_reports'));
			if($this->financial_reports->getLastOrder($this->account['id'],'transaction_status',1) == 1):
				if($books = $this->signed_books->getMyBooks(PER_PAGE_DEFAULT,0)):
					$books = $this->BooksGenre($books);
					$books = $this->mySignedBooks($books);
					for($i=0;$i<count($books);$i++):
						$books[$i]['authors'] = $this->getAuthorsByIDs($books[$i]['authors']);
					endfor;
					$this->json_request['responseText'] = $this->load->view('html/print-books-list',array('books'=>$books),TRUE);
					$this->json_request['status'] = TRUE;
				endif;
			endif;
		endif;
		echo json_encode($this->json_request);
	}
	
	public function saveEmail(){
		
		if($this->postDataValidation('signup')):
			if($account = $this->accounts->getWhere(NULL,array('email'=>$this->input->post('email')))):
				if($account['password'] == md5($this->input->post('password'))):
					$this->load->model(array('financial_reports','signed_books'));
					$this->financial_reports->transferRecord($this->account['id'],$account['id']);
					if($newSignedBooks = $this->signed_books->getWhere(NULL,array('account'=>$this->account['id']),TRUE)):
						if($newSignedBooksIDs = $this->getValuesInArray($newSignedBooks,'book')):
							$this->signed_books->deleteOldBooks($newSignedBooksIDs,$account['id']);
						endif;
					endif;
					$this->signed_books->transferRecord($this->account['id'],$account['id']);
					$this->signInAccount($account['id']);
					$this->accounts->updateField($account['id'],'no_ask_email',1);
					$this->json_request['redirect'] = site_url($this->uri->language_string.'/cabinet');
				else:
					$this->json_request['responseText'] = lang('union_email_exist');
					$this->json_request['exist'] = TRUE;
				endif;
			else:
				$this->profile['email'] = $this->input->post('email');
				$this->session->set_userdata('profile',json_encode($this->profile));
				$this->accounts->updateField($this->account['id'],'email',$this->input->post('email'));
				$this->accounts->updateField($this->account['id'],'no_ask_email',1);
				$this->load->helper('string');
				$password = random_string('alnum',12);
				$this->accounts->updateField($this->account['id'],'password',md5($password));
				$mailtext = $this->load->view('mails/signup',array('login'=>'id'.$this->account['id'],'password'=>$password),TRUE);
				$this->sendMail($this->input->post('email'),FROM_BASE_EMAIL,'DistribBooks','Регистрация на distribbooks.ru',$mailtext);
				$this->json_request['redirect'] = site_url($this->uri->language_string.'/cabinet');
			endif;
			$this->json_request['status'] = TRUE;
		endif;
		echo json_encode($this->json_request);
	}
	
	private function getPayUHash($post,$books,$transactionID,$transaction_time){
		
		$order_hash = PAYU_MERCHANT_LENGTH.PAYU_MERCHANT.strlen($transactionID).$transactionID.strlen($transaction_time).$transaction_time;
		for($i=0;$i<count($books);$i++):
			if(($i+1)%$this->project_config['free_book'] != 0):
				$order_hash .= strlen($books[$i][$this->uri->language_string.'_title']).$books[$i][$this->uri->language_string.'_title']; //NAME
			endif;
		endfor;
		for($i=0;$i<count($books);$i++):
			if(($i+1)%$this->project_config['free_book'] != 0):
				$order_hash .= strlen($books[$i]['id']).$books[$i]['id']; //ID
			endif;
		endfor;
		for($i=0;$i<count($books);$i++):
			if(($i+1)%$this->project_config['free_book'] != 0):
				$order_hash .= strlen($books[$i]['price']).$books[$i]['price'];
			endif;
		endfor;
		for($i=0;$i<count($books);$i++):
			if(($i+1)%$this->project_config['free_book'] != 0):
				$order_hash .= '11'; //QTY
			endif;
		endfor;
		for($i=0;$i<count($books);$i++):
			if(($i+1)%$this->project_config['free_book'] != 0):
				$order_hash .= '218'; //VAT
			endif;
		endfor;
		$order_hash .= '10'; //SHIPPING
		$order_hash .= '3RUB'.strlen($post['discount']).$post['discount'];
		$order_hash .= strlen($post['pay_method']).$post['pay_method'];
		for($i=0;$i<count($books);$i++):
			if(($i+1)%$this->project_config['free_book'] != 0):
				$order_hash .= '5GROSS';
			endif;
		endfor;
		return hash_hmac('md5',$order_hash,PAYU_SECRET_KEY);
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
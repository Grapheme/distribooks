<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."/libraries/paypal.php");

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
			'page_content' => $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'breadcrumbs' => array('pay'=>lang('user_pay')),
			'books' => $this->books->getBooksByIDs($booksIDs,'id,ru_title,en_title,price,price_action'),
			'basket_list' => array(),
			'text_blocks' => array('content'=>'')
		);
		$this->load->model('pages');
		if($content = $this->pages->getWhere($pagevar['page_content']['item_id'])):
			$pagevar['text_blocks'] = json_decode($content[$this->uri->language_string.'_content'],TRUE);
		endif;
		$this->load->view("users_interface/pay",$pagevar);
	}
	
	public function cabinet(){
		
		if($this->input->get('err') !== FALSE):
			$this->setPayStatusInLastOrder($this->account['id'],4);
			redirect('basket'.urlGETParameters());
		endif;
		$this->offset = (int)$this->uri->segment(4);
		$this->load->model(array('signed_books','financial_reports'));
		$pagevar = array(
			'page_content' => $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'breadcrumbs' => array('cabinet'=>lang('user_cabinet')),
			'books' => $this->signed_books->getMyBooks(PER_PAGE_DEFAULT,$this->offset),
			'pages' => $this->pagination('cabinet/my-books',4,$this->signed_books->countAllResults(array('account'=>$this->account['id'])),PER_PAGE_DEFAULT),
			'basket_list' => $this->getBooksInBasket(),
			'order_status' => $this->financial_reports->getLastOrder($this->account['id']),
			'order_pay_status' => $this->financial_reports->getLastOrder($this->account['id'],'pay_status',1),
			'reques_email' => $this->accounts->value($this->account['id'],'no_ask_email')
		);
		$pagevar['books'] = $this->BooksGenre($pagevar['books']);
		$pagevar['books'] = $this->mySignedBooks($pagevar['books']);
		for($i=0;$i<count($pagevar['books']);$i++):
			$pagevar['books'][$i]['authors'] = $this->getAuthorsByIDs($pagevar['books'][$i]['authors']);
		endfor;
		if($this->input->get('result') !== FALSE):
			$status = 3; //ошибка
			if((int)$this->input->get('result') === 0):
				$status = 1;//оплата
			elseif((int)$this->input->get('result') === -1):
				$status = 1;//оплата киви
			elseif((int)$this->input->get('result') === 2):
				$status = 1;//оплата
			endif;
			$this->setPayStatusInLastOrder($this->account['id'],$status);
		endif;
		if($this->input->get('status') === FALSE):
			if($this->input->get('result') !== FALSE && ($this->input->get('result') == 0 || $this->input->get('result') == -1 || $this->input->get('result') == 2)):
				if($this->input->cookie('buy_book') !== FALSE):
					delete_cookie('buy_book');
				elseif($this->validBasket()):
					delete_cookie('basket_books');
					delete_cookie('basket_total_price');
					$this->accounts->updateField($this->account['id'],'basket','');
					$this->account_basket['basket_books'] = $pagevar['basket_list'] = array();
				endif;
				$gift_status = '';
				if($this->input->cookie('gift_book') !== FALSE):
					delete_cookie('gift_book');
					$gift_status = '&gift=success';
				endif;
				redirect(uri_string().urlGETParameters().'&status=ok'.$gift_status);
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

	/*************************************************************************************************************/

	public function checkoutPaypal(){
		
		$booksIDs = array(); $payBooks = array();
		if($this->input->cookie('buy_book') !== FALSE):
			$booksIDs[] = $this->input->cookie('buy_book');
		else:
			$booksIDs = $this->getValuesBasketBooksCookie();
		endif;
		$this->load->model('books');
		if(!$books = $this->books->getBooksByIDs($booksIDs,'id,ru_title,en_title,price,price_action')):
			show_404();
		else:
			$total_summa = $total_summa_dollar = $discount = $discount_dollar = 0.00;
			
			$set_rate = FALSE; $dollar_rate = $this->project_config['dollar_rate'];
			if($this->uri->language_string == RUSLAN):
				$set_rate = TRUE;
				$dollar_rate = 1.00;
			endif;
			
			for($i=0,$num=0;$i<count($books);$i++):
				if(($i+1)%$this->project_config['free_book'] != 0):
					$payBooks[$num]['name'] = $books[$i][$this->uri->language_string.'_title'];
					$payBooks[$num]['qty'] = 1;
					if($books[$i]['price_action'] > 0):
						$total_summa += $books[$i]['price_action'];
						$total_summa_dollar += round($books[$i]['price_action']/getDollarRate($set_rate,$dollar_rate),2,PHP_ROUND_HALF_EVEN);
						$payBooks[$num]['amt'] = round($books[$i]['price_action']/getDollarRate($set_rate,$dollar_rate),2,PHP_ROUND_HALF_EVEN);
					else:
						$total_summa += $books[$i]['price'];
						$total_summa_dollar += round($books[$i]['price']/getDollarRate($set_rate,$dollar_rate),2,PHP_ROUND_HALF_EVEN);
						$payBooks[$num]['amt'] = round($books[$i]['price']/getDollarRate($set_rate,$dollar_rate),2,PHP_ROUND_HALF_EVEN);
					endif;
					$num++;
				endif;
			endfor;
			$action_price = round($this->project_config['action_price']/getDollarRate(),2,PHP_ROUND_HALF_EVEN);
			if($this->project_config['action_price'] > 0):
				if($total_summa_dollar > $action_price):
					$discount = round($total_summa*($this->project_config['action_percent']/100),2,PHP_ROUND_HALF_EVEN);
					$discount_dollar = round($total_summa_dollar*($this->project_config['action_percent']/100),2,PHP_ROUND_HALF_EVEN);
				endif;
			endif;
			$total_summa_dollar -= $discount_dollar;
			$total_summa -= $discount;
			if($discount_dollar > 0):
				for($i=0;$i<count($payBooks);$i++):
					$payBooks[$i]['amt'] -= round($payBooks[$i]['amt']*($this->project_config['action_percent']/100),2,PHP_ROUND_HALF_EVEN);
				endfor;
			endif;
			$this->writeToFinancialReport(2,$total_summa,json_encode($booksIDs));
		endif;
		$PaymentOption = "PayPal";
		if($PaymentOption == "PayPal"):
			$paymentAmount = 0;
			for($i=0;$i<count($payBooks);$i++):
				$paymentAmount += $payBooks[$i]['amt'];
			endfor;
			$currencyCodeType = "USD";
			if($this->uri->language_string == RUSLAN):
				$currencyCodeType = "RUB";
			endif;
			$paymentType = "Sale";
			$returnURL = site_url('paypal-request');
			$cancelURL = site_url('paypal-cancel');
			$items = $payBooks;
			$resArray = SetExpressCheckoutDG($paymentAmount,$currencyCodeType,$paymentType,$returnURL,$cancelURL,$payBooks);
			$ack = strtoupper($resArray["ACK"]);
			if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING"):
				$token = urldecode($resArray["TOKEN"]);
				RedirectToPayPalDG($token);
			else:
				$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
				$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
				$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
				$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
				/*echo "SetExpressCheckout API call failed. ";
				echo "Detailed Error Message: " . $ErrorLongMsg;
				echo "Short Error Message: " . $ErrorShortMsg;
				echo "Error Code: " . $ErrorCode;
				echo "Error Severity Code: " . $ErrorSeverityCode;*/
			endif;
		endif;
	}
	
	public function paypalCancel(){
		
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('page_address'=>'pay')),
			'breadcrumbs' => array('pay'=>lang('user_pay')),
			'basket_list' => array()
		);
		$this->load->view('users_interface/paypal-cancel',$pagevar);
	}
	
	public function paypalRequest(){
		
		$message = '';
		$PaymentOption = "PayPal";
		if($PaymentOption == "PayPal"):
			$res = GetExpressCheckoutDetails($_REQUEST['token']);
			$finalPaymentAmount = $res["PAYMENTREQUEST_0_AMT"];
			$token = $_REQUEST['token'];
			$payerID = $_REQUEST['PayerID'];
			$paymentType = 'Sale';
			$currencyCodeType = $res['CURRENCYCODE'];
			$items = array();
			$i = 0;
			while(isset($res["L_PAYMENTREQUEST_0_NAME$i"])):
				$items[] = array('name' => $res["L_PAYMENTREQUEST_0_NAME$i"], 'amt' => $res["L_PAYMENTREQUEST_0_AMT$i"], 'qty' => $res["L_PAYMENTREQUEST_0_QTY$i"]);
				$i++;
			endwhile;
			$resArray = ConfirmPayment($token,$paymentType,$currencyCodeType,$payerID,$finalPaymentAmount,$items);
			$ack = strtoupper($resArray["ACK"]);
			if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING"):
				$transactionId		= $resArray["PAYMENTINFO_0_TRANSACTIONID"]; // Unique transaction ID of the payment.
				$transactionType 	= $resArray["PAYMENTINFO_0_TRANSACTIONTYPE"]; // The type of transaction Possible values: l  cart l  express-checkout
				$paymentType		= $resArray["PAYMENTINFO_0_PAYMENTTYPE"];  // Indicates whether the payment is instant or delayed. Possible values: l  none l  echeck l  instant
				$orderTime 			= $resArray["PAYMENTINFO_0_ORDERTIME"];  // Time/date stamp of payment
				$amt				= $resArray["PAYMENTINFO_0_AMT"];  // The final amount charged, including any  taxes from your Merchant Profile.
				$currencyCode		= $resArray["PAYMENTINFO_0_CURRENCYCODE"];  // A three-character currency code for one of the currencies listed in PayPay-Supported Transactional Currencies. Default: USD.
				$feeAmt				= $resArray["PAYMENTINFO_0_FEEAMT"];  // PayPal fee amount charged for the transaction
			//	$settleAmt			= $resArray["PAYMENTINFO_0_SETTLEAMT"];  // Amount deposited in your PayPal account after a currency conversion.
				$taxAmt				= $resArray["PAYMENTINFO_0_TAXAMT"];  // Tax charged on the transaction.
			//	$exchangeRate		= $resArray["PAYMENTINFO_0_EXCHANGERATE"];  // Exchange rate if a currency conversion occurred. Relevant only if your are billing in their non-primary currency. If the customer chooses to pay with a currency other than the non-primary currency, the conversion occurs in the customer's account.
				$paymentStatus = $resArray["PAYMENTINFO_0_PAYMENTSTATUS"];
				$pendingReason = $resArray["PAYMENTINFO_0_PENDINGREASON"];
				$reasonCode = $resArray["PAYMENTINFO_0_REASONCODE"];
				
				if(isUserLoggined()):
					$this->load->model(array('signed_books','financial_reports'));
					if($reportID = $this->financial_reports->getLastOrder($this->account['id'],'id')):
						if($report = $this->financial_reports->getWhere($reportID,array('transaction_status'=>0,'operation'=>2,'pay_status'=>0))):
							if(!empty($report['books'])):
								if($booksIDs = json_decode($report['books'])):
									for($i=0;$i<count($booksIDs);$i++):
										$this->buyBook($booksIDs[$i],$report['account']);
									endfor;
									if(!empty($this->profile['email'])):
										$mailtext = $this->load->view('mails/buy-book',array('account'=>$this->profile),TRUE);
										$this->sendMail($this->profile['email'],FROM_BASE_EMAIL,'Distribboks','Покупка книг на distribbooks.com',$mailtext);
									elseif(!empty($account['email']) && $report['account_gift'] > 0 && isset($booksIDs[0])):
										$this->sendMailAboutGift($account['id'],$account['email'],$booksIDs[0]);
									endif;
									$this->financial_reports->updateField($reportID,'transaction_status',1);
									$this->financial_reports->updateField($reportID,'pay_status',1);
								endif;
							endif;
						endif;
					endif;
					if($this->validBasket() === FALSE):
						$this->accounts->updateField($this->account['id'],'basket','');
						$this->account_basket['basket_books'] = $pagevar['basket_list'] = array();
					endif;
				endif;
			else:
				$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
				$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
				$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
				$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
				
				$message = "DoExpressCheckoutDetails API call failed. ";
				$message .= "Detailed Error Message: " . $ErrorLongMsg;
				$message .= "Short Error Message: " . $ErrorShortMsg;
				$message .= "Error Code: " . $ErrorCode;
				$message .= "Error Severity Code: " . $ErrorSeverityCode;
			endif;
			$pagevar = array(
				'meta_titles' => $this->meta_titles->getWhere(NULL,array('page_address'=>'pay')),
				'breadcrumbs' => array('pay'=>lang('user_pay')),
				'basket_list' => array(),
				'message' => $message
			);
			$this->load->view('users_interface/paypal-successful',$pagevar);
		else:
			show_404();
		endif;
	}
	
}
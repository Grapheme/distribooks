<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_ajax_interface extends MY_Controller{
	
	var $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE,'responsePhotoSrc'=>'');
	
	function __construct(){
		
		parent::__construct();
		if($this->input->is_ajax_request() === FALSE && $this->account['group'] == USER_GROUP_VALUE):
			show_error('В доступе отказано');
		endif;
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
	}
	
	public function singleBuyBook(){
		
		if($this->postDataValidation('buy_book')):
			if($signedID = $this->buyBook($this->input->post('book'))):
				$this->json_request['status'] = TRUE;
				$this->json_request['responseText'] = 'Книга куплена успешно';
				$this->load->model('books_card');
				$this->json_request['redirect'] = site_url($this->uri->language_string.'/'.$this->books_card->value($this->input->post('book'),'page_address'));
			endif;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
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
				endif;
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
			$this->json_request['booksTotalPrice'] = $this->getBasketTotalPrice();
			$this->json_request['status'] = TRUE;
		else:
			$this->json_request['responseText'] = $this->load->view('html/validation-errors',array('alert_header'=>FALSE),TRUE);
		endif;
		echo json_encode($this->json_request);
	}
	
}
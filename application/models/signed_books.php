<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Signed_books extends MY_Model{

	protected $table = "signed_books";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "account,book";

	function __construct(){
		
		parent::__construct();
	}
	
	function getMyBooks($limit,$offset){
		
		$this->db->select('books_card.*');
		$this->db->from('signed_books');
		$this->db->join('books_card','signed_books.book = books_card.id');
		$this->db->where('signed_books.account',$this->account['id']);
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
}
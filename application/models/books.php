<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Books extends MY_Model{

	protected $table = "books";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,price DESC,genre";

	function __construct(){
		
		parent::__construct();
	}
	
	function getBooksByChar($char,$lang = RUSLAN){

		$this->db->select($this->_fields());
		$this->db->order_by($lang.'_title');
		$this->db->like($lang.'_title',$char,'after');
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function searchBooksByChar($char,$lang = RUSLAN){
		
		$this->db->select('id,'.$lang.'_title AS name');
		$this->db->order_by($lang.'_title');
		$this->db->like($lang.'_title',$char,'after');
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getBooksByIDs($IDs){

		$this->db->select($this->_fields());
		$this->db->where_in('id',$IDs);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getPrice($IDs){
		
		$this->db->select_sum('');
		$this->db->where_in('id',$IDs);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
}
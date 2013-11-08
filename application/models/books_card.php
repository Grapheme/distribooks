<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Books_card extends MY_Model{

	protected $table = "books_card";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,price DESC,genre";

	function __construct(){
		
		parent::__construct();
	}
	
	function getBooksByKeyWord($limit = NULL,$offset = NULL,$orderby = NULL,$where = NULL){
		
		if(is_null($orderby)):
			$orderby = $this->order_by;
		endif;
		$this->db->select($this->_fields());
		$this->db->order_by($orderby);
		$this->db->from($this->table);
		$this->db->join('matching','books_card.id = matching.book');
		$this->db->where('matching.word',$where['word_id']);
		if(is_numeric($limit) && is_numeric($offset)):
			$this->db->limit($limit,$offset);
		elseif(is_numeric($limit)):
			$this->db->limit($limit);
		endif;
		$this->db->group_by('books_card.'.$this->primary_key);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function countResultsByKeyWord($where = NULL){
		
		$this->db->select($this->_fields());
		$this->db->from($this->table);
		$this->db->join('matching','books_card.id = matching.book');
		$this->db->where('matching.word',$where['word_id']);
		$this->db->group_by('books_card.'.$this->primary_key);
		return $this->db->count_all_results();
	}
	
	function getBooksByAuthor($limit = NULL,$offset = NULL,$orderby = NULL,$where = NULL){
		
		if(is_null($orderby)):
			$orderby = $this->order_by;
		endif;
		$this->db->select($this->_fields());
		$this->db->order_by($orderby);
		$this->db->from($this->table);
		$this->db->where('(books_card.authors = \''.$where['author'].'\' OR books_card.authors LIKE \'%'.','.$where['author'].'\' OR books_card.authors LIKE \'%,'.$where['author'].',%\' OR books_card.authors LIKE \''.$where['author'].',%\')',NULL);
		if(is_numeric($limit) && is_numeric($offset)):
			$this->db->limit($limit,$offset);
		elseif(is_numeric($limit)):
			$this->db->limit($limit);
		endif;
		$this->db->group_by('books_card.'.$this->primary_key);
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}

	function countResultsByAuthor($where = NULL){
		
		$this->db->select($this->_fields());
		$this->db->where('(books_card.authors = \''.$where['author'].'\' OR books_card.authors LIKE \'%'.','.$where['author'].'\' OR books_card.authors LIKE \'%,'.$where['author'].',%\' OR books_card.authors LIKE \''.$where['author'].',%\')',NULL);
		return $this->db->count_all_results($this->table);
	}
	
	function getBooksByIDs($IDs,$fields = 'id,page_address,thumbnail,ru_title,en_title,genre,rating,price,price_action,authors'){
		
		if(empty($fields)):
			$fields = $this->_fields();
		endif;
		
		$this->db->select($fields);
		$this->db->where_in('id',$IDs);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
}
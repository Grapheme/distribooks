<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Books_card extends MY_Model{

	protected $table = "books_card";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "ru_sort,en_sort,price DESC,genre";

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
	
	function getBooksByIDs($IDs){
		
		$this->db->select($this->_fields());
		$this->db->where_in('id',$IDs);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getBooksIDsByAuthorsIDs($limit,$offset,$AuthorsIDs){
		
		if(!empty($AuthorsIDs)):
			$this->db->select('id');
			$this->db->order_by($this->order_by);
			$this->db->from($this->table);
			for($i=0;$i<count($AuthorsIDs);$i++):
				$this->db->or_where('(authors = \''.$AuthorsIDs[$i].'\' OR authors LIKE \'%'.','.$AuthorsIDs[$i].'\' OR authors LIKE \'%,'.$AuthorsIDs[$i].',%\' OR authors LIKE \''.$AuthorsIDs[$i].',%\')',NULL);
			endfor;
			$this->db->limit($limit,$offset);
			$this->db->group_by('books_card.'.$this->primary_key);
			$query = $this->db->get();
			if($data = $query->result_array()):
				return $data;
			endif;
		endif;
		return NULL;
	}
	
	function getBooksIDsByKeyWords($limit = NULL,$offset = NULL,$keyWordsIDs){
		
		if(!empty($keyWordsIDs)):
			$this->db->select('id');
			$this->db->from($this->table);
			$this->db->join('matching','books_card.id = matching.book');
			$this->db->where_in('matching.word',$keyWordsIDs);
			$this->db->limit($limit,$offset);
			$this->db->group_by('books_card.'.$this->primary_key);
			$query = $this->db->get();
			if($data = $query->result_array()):
				return $data;
			endif;
		endif;
		return NULL;
	}
	
	function getBooksIDsByGenres($limit = NULL,$offset = NULL,$genresIDs){
		
		if(!empty($genresIDs)):
			$this->db->select('id');
			$this->db->where_in('genre',$genresIDs);
			$this->db->limit($limit,$offset);
			$query = $this->db->get($this->table);
			if($data = $query->result_array()):
				return $data;
			endif;
		endif;
		return NULL;
	}

	function getBooksIDsByString($string){
		
		$this->db->select('id');
		$this->db->or_like('LCASE(ru_title)',mb_strtolower($string));
		$this->db->or_like('LCASE(en_title)',mb_strtolower($string));
		$this->db->or_like('LCASE(ru_anonce)',mb_strtolower($string));
		$this->db->or_like('LCASE(en_anonce)',mb_strtolower($string));
		$this->db->or_like('LCASE(ru_text)',mb_strtolower($string));
		$this->db->or_like('LCASE(en_text)',mb_strtolower($string));
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}

	function getTrailers($limit = NULL){
		
		$sql = "SELECT trailers FROM books_card WHERE trailers != '' ORDER BY id DESC";
		if(!is_null($limit)):
			$sql .= " LIMIT $limit";
		endif;
		$query = $this->db->query($sql);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
}
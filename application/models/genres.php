<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Genres extends MY_Model{

	protected $table = "genres";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,ru_title,en_title";

	function __construct(){
		parent::__construct();
	}
	
	function getGenresByChar($char,$lang = RUSLAN){

		$this->db->select($this->_fields());
		$this->db->order_by($lang.'_title');
		$this->db->like($lang.'_title',$char,'after');
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function searchGenresByChar($char,$lang = RUSLAN){
		
		$this->db->select('id,'.$lang.'_title AS name');
		$this->db->order_by($lang.'_title');
		$this->db->like($lang.'_title',$char,'after');
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
	function getGenresByIDs($IDs){

		$this->db->select('id,ru_title AS name,ru_title,en_title');
		$this->db->where_in('id',$IDs);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
	}
	
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Books_rating extends MY_Model{

	protected $table = "books_rating";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct(){
		
		parent::__construct();
	}
	
	function getTotalRatingSumma($bookID){
		
		$this->db->select_sum('value','rating');
		$this->db->where('book',$bookID);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data[0]['rating'];
		endif;
		return NULL;
	}
}
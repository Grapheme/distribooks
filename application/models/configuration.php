<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Configuration extends MY_Model{

	protected $table = "config";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct(){
		parent::__construct();
	}
	
	function getDollarRate(){
		
		$this->db->select('dollar_rate');
		$this->db->where('id',1);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data[0]['dollar_rate'];
		endif;
		return 0;
	}
	function getFreeBookNumber(){
		
		$this->db->select('free_book');
		$this->db->where('id',1);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data[0]['free_book'];
		endif;
		return 0;
	}
	
	
}
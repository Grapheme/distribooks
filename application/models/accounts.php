<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends MY_Model{

	protected $table = "accounts";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct(){
		
		parent::__construct();
	}
	
	function authentication($login = NULL,$password = NULL){
		
		if(!is_null($login) || !is_null($password)):
			$this->db->select($this->_fields());
			$this->db->where('email',$login);
			$this->db->where('password',md5($password));
			$query = $this->db->get($this->table,1);
			$data = $query->result_array();
			if($data):
				return $data[0];
			endif;
		endif;
		return FALSE;
	}

	function validationTemporaryCode($code = NULL){
		
		if(!is_null($code)):
			$this->db->where('temporary_code',$code);
			$this->db->where('code_life >=',now());
			$query = $this->db->get($this->table,1);
			$data = $query->result_array();
			if($data):
				return $data[0][$this->primary_key];
			endif;
		endif;
		return FALSE;
	}

}
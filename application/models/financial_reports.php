<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Financial_reports extends MY_Model{

	protected $table = "financial_reports";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "date DESC";

	function __construct(){
		
		parent::__construct();
	}

	function transferRecord($from,$to){
	
		$this->db->set('account',$to);
		$this->db->where('account',$from);
		$this->db->update($this->table);
	}
}
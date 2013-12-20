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
	
	function getLastOrder($accountID,$field = 'transaction_status',$pay_status = NULL){
		
		$this->db->select('*,MAX(`date`) AS maxdate');
		$this->db->where('account',$accountID);
		if(!is_null($pay_status)):
			$this->db->where('pay_status',$pay_status);
		endif;
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
			return $data[0][$field];
		endif;
		return FALSE;
	}
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Formats_categories extends MY_Model{

	protected $table = "formats_categories";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,ru_title";

	function __construct(){
		
		parent::__construct();
	}
	
	function getCategoryByFormatsIDs($formatsIDs){
		
		$this->db->select('formats_categories.id AS category_id,formats_categories.ru_title,formats_categories.en_title,formats.id AS format_id,formats.title');
		$this->db->from('formats');
		$this->db->join($this->table,'formats.category = formats_categories.id');
		$this->db->where_in('formats.id',$formatsIDs);
		$this->db->order_by('formats_categories.sort,formats.sort');
		$query = $this->db->get();
		if($data = $query->result_array()):
			return $data;
		endif;
		return NULL;
		
	}
	
}
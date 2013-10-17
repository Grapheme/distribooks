<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Formats_categories extends MY_Model{

	protected $table = "formats_categories";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,title";

	function __construct(){
		
		parent::__construct();
	}
	
}
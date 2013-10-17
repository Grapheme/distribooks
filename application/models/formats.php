<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Formats extends MY_Model{

	protected $table = "formats";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,title";

	function __construct(){
		
		parent::__construct();
	}
	
}
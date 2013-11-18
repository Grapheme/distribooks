<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Model{

	protected $table = "news";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,date DESC";

	function __construct(){
		
		parent::__construct();
	}
	
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Books_card extends MY_Model{

	protected $table = "books_card";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "sort,price DESC,genre";

	function __construct(){
		
		parent::__construct();
	}
	
	
}
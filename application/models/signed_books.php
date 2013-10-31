<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Signed_books extends MY_Model{

	protected $table = "signed_books";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = "account,book";

	function __construct(){
		
		parent::__construct();
	}
}
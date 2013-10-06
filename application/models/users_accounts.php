<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_accounts extends MY_Model{

	protected $table = "users_accounts";
	protected $primary_key = "id";
	protected $fields = array("*");
	protected $order_by = 'email';
	
	function __construct(){
		parent::__construct();
	}
	
}
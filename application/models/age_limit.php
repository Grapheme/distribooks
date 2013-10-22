<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Age_limit extends MY_Model{

	protected $table = "age_limit";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct(){
		parent::__construct();
	}
}
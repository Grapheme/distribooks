<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Meta_titles extends MY_Model{

	protected $table = "meta_titles";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct(){
		
		parent::__construct();
	}
	
}
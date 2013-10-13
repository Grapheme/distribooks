<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{

	var $offset = 0;
	
	function __construct(){

		parent::__construct();
	}
	
	public function index(){
		
		$pagevar = array(
			'page_content'=> array(),
			'sliderExist' =>TRUE
			
		);
		$this->load->view("guests_interface/index",$pagevar);
	}
	
	/************************************************ pages ***********************************************************/
	
	public function about(){
		
		$pagevar = array(
			'page_content'=>array()
		);
		$this->load->view("guests_interface/about",$pagevar);
	}
	
	public function editing(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/editing",$pagevar);
	}
	
	public function typography(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/typography",$pagevar);
	}
	
	public function translation(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/translation",$pagevar);
	}
	
	public function distribution(){
		
		$pagevar = array(
			'page_content'=>array(),
			'sliderExist' =>TRUE
		);
		$this->load->view("guests_interface/distribution",$pagevar);
	}
	
	/*********************************************** catalog ***********************************************************/
	
	public function catalog(){
		
		$pagevar = array(
			'page_content'=>array(),
			'breadcrumbs' =>array('fantastic'=>'Фантастика'),
			'novelty' =>array(),
			'recommended' =>array(),
			'catalog' =>array()
		);
		$this->load->view("guests_interface/catalog",$pagevar);
	}
}
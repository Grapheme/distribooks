<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{

	var $offset = 0;
	
	function __construct(){

		parent::__construct();
		if($this->uri->language_string === FALSE):
			$this->config->set_item('base_url',baseURL($this->baseLanguageURL.'/'));
			redirect();
		else:
			$this->config->set_item('base_url',baseURL($this->uri->language_string.'/'));
		endif;
		$this->load->helper('language');
		$this->lang->load('localization/interface',$this->languages[$this->uri->language_string]);
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
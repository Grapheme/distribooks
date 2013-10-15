<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus || ($this->account['group'] != ADMIN_GROUP_VALUE)):
			redirect('');
		endif;
		$this->load->helper('form');
	}
	
	/******************************************** cabinet *******************************************************/
	public function controlPanel(){
		
		$this->load->view("admin_interface/cabinet/control-panel");
	}
	/********************************************** news ********************************************************/
	public function news(){
		
		$this->load->model('news');
		$pagevar = array(
			'news' => $this->news->limit(PER_PAGE_DEFAULT,(int)$this->uri->segment(3)),
			'pages' => $this->pagination(ADMIN_START_PAGE.'/news',4,$this->news->countAllResults(),PER_PAGE_DEFAULT)
		);
		$this->load->view("admin_interface/news/list",$pagevar);
	}
	
	public function addNews(){
		
		$this->load->view("admin_interface/news/add");
	}
	
	public function editNews(){
		
		$this->load->model(array('news','meta_titles'));
		$pagevar = array(
			'news' => $this->news->getWhere($this->input->get('id')),
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('group'=>'news','item_id'=>$this->input->get('id'))),
		);
		$pagevar['news']['date'] = swapDotDateWithoutTime($pagevar['news']['date']);
		$this->load->view("admin_interface/news/edit",$pagevar);
	}
	
	/******************************************** cabinet *******************************************************/
}
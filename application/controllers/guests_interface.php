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
		$this->load->model('meta_titles');
	}
	
	public function index(){
		
		$this->load->model('news');
		
		$pagevar = array(
			'page_content'=> array(),
			'sliderExist' =>TRUE,
			'news' => $this->news->limit(3)
		);
		
		$pagevar['news'] = $this->setPageAddress($pagevar['news'],'news');
		$this->load->view("guests_interface/index",$pagevar);
	}
	
	/************************************************ pages ***********************************************************/
	
	public function redirectPage(){
		
		if($this->uri->segment(1) !== FALSE):
			$pageContent = '';
			if($page = $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1)))):
				$pagevar = array('meta_titles'=>$page);
				switch($page['group']):
					case 'news':
						$this->load->model('news');
						$pagevar['news'] = $this->news->getWhere($page['item_id']);
						$pagevar['breadcrumbs'] = array('news'=>lang('news_block'),$page['page_address']=>$pagevar['news'][$this->uri->language_string.'_title']);
						$pageContent = $this->load->view('guests_interface/single-news',$pagevar,TRUE);
						break;
				endswitch;
			endif;
			echo $pageContent;
		endif;
	}
	
	public function news(){
		
		$this->load->model('news');
		$pagevar = array(
			'meta_titles' => $this->meta_titles->getWhere(NULL,array('page_address'=>$this->uri->segment(1))),
			'news' => $this->news->limit(PER_PAGE_DEFAULT,(int)$this->uri->segment(3)),
			'pages'=> $this->pagination('news',3,$this->news->countAllResults(),PER_PAGE_DEFAULT),
			'breadcrumbs' => array('news'=>lang('news_block'))
		);
		$pagevar['news'] = $this->setPageAddress($pagevar['news'],'news');
		$this->load->view("guests_interface/news",$pagevar);
	}
	
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

	private function setPageAddress($elements,$group){
		
		$metaTitles = $this->meta_titles->getWhere(NULL,array('group'=>$group),TRUE);
		for($i=0;$i<count($elements);$i++):
			$elements[$i]['page_address'] = FALSE;
			for($j=0;$j<count($metaTitles);$j++):
				if($metaTitles[$j]['item_id'] == $elements[$i]['id']):
					$elements[$i]['page_address'] = $metaTitles[$j]['page_address'];
				endif;
			endfor;
		endfor;
		return $elements;
	}
}
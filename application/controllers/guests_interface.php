<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Guests_interface extends MY_Controller{

	var $offset = 0;
	
	function __construct(){

		parent::__construct();
	}
	
	public function index(){
		
		$pagevar = array(
			'page_content'=>array()
		);
		$this->load->view("guests_interface/index",$pagevar);
	}
	
	/************************************************ profiles ***********************************************************/
	public function viewProfile(){
		
		$this->load->helper(array('date','string'));
		$this->load->model(array('users_accounts','users','unions'));
		if($this->uri->total_segments() == 1):
			if(!$profile = $this->users_accounts->getWhere($this->input->get('user'),array('group'=>2,'active'=>1))):
				show_404();
			endif;
		elseif($this->uri->total_segments() == 2):
			if(!$profile = $this->users_accounts->getWhere(NULL,array('group'=>2,'active'=>1,'page_address'=>$this->uri->segment(2)))):
				show_404();
			endif;
		else:
			show_404();
		endif;
		$pagevar = array(
			'profile' => $profile,
			'social_networks' => $this->getProfileSocialNetworks($profile['id']),
			'teach_courses' => $this->getProfileTeachCourses($profile['id']),
			'study_courses' => $this->getProfileStudyCourses($profile['id']),
			'portfolio' => $this->getProfilePortfolio($profile['id']),
			'my_profile_in_favorite' => $this->unions->isMyProfileFavorite(array('orderby'=>'profile_favorite.date_create DESC','limit'=>7,'account'=>$profile['id'])),
			'profiles_in_my_favorite' => $this->unions->isMyFavoriteProfiles(array('orderby'=>'profile_favorite.date_create DESC','limit'=>7,'account'=>$profile['id'])),
		);
		$pagevar['my_profile_in_favorite'] = $this->getUsersSpecialization($pagevar['my_profile_in_favorite'],'id');
		$pagevar['profiles_in_my_favorite'] = $this->getUsersSpecialization($pagevar['profiles_in_my_favorite'],'id');
		if($profileLanguages = $this->getUsersLenguages(array($profile))):
			$pagevar['profile']['languages'] = $profileLanguages[0]['lenguages'];
		endif;
		if($profileSpecialization = $this->getUsersSpecialization(array($profile))):
			$pagevar['profile']['specialization'] = $profileSpecialization[0]['specialization'];
		endif;
		$pagevar['profile'] = $this->getFavoriteProfile($pagevar['profile']);
		$pagevar['profile']['about'] = $this->users->value($pagevar['profile']['account'],'about');
		$pagevar['profile']['links'] = json_decode($this->users->value($profile['account'],'links'),TRUE);
		if($profile = $this->setActiveUsers(array($pagevar['profile']))):
			$pagevar['profile'] = $profile[0];
		endif;
		$pagevar['popup_statuses'] = $this->setPopupStatuses();
		$this->session->set_userdata('current_url',uri_string().getUrlLink());
		$this->load->view("guests_interface/profile",$pagevar);
	}
	/********************************************************************************************************************/
}
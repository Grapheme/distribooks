<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{

	var $offset = 0;
	
	function __construct(){

		parent::__construct();
		if(!$this->loginstatus || ($this->account['group'] != USER_GROUP_VALUE)):
			redirect('');
		endif;
	}
	
	public function startPage(){
		
		$pagevar = array(
			'hide_info_block' => $this->validUserSettings(2,1)
		);
		$this->load->view('users_interface/pages/panel',$pagevar);
	}

	public function profile(){
		
		$this->load->model(array('users_accounts','users','social_networks'));
		$profile = $this->users_accounts->getWhere($this->account['id']);
		$pagevar = array(
			'profile' => $profile,
			'time_zones' => $this->getProfileTimeZones($profile['time_zone']),
			'specialization' => $this->getProfileSpecializations(),
			'languages' => $this->getProfileLanguages(),
			'default_photo' => $this->accounts->value($this->account['id'],'default_photo'),
			'account' => $this->accounts->getWhere($this->account['id']),
			'social_networks' => $this->getMyProfileSocialNetworks(),
		);
		$pagevar['profile']['about'] = $this->users->value($this->profile['account'],'about');
		$pagevar['profile']['links'] = json_decode($this->users->value($profile['account'],'links'),TRUE);
		$this->load->view("users_interface/cabinet/profile",$pagevar);
	}
	
	public function profilePassword(){
		
		$pagevar = array(
		
		);
		$this->load->view("users_interface/cabinet/password",$pagevar);
	}
	
	public function balance(){
		
		$this->load->view("users_interface/cabinet/balance");
	}
	
	public function balanceReports(){
		
		$this->load->view("users_interface/cabinet/balance-reports");
	}
	
	public function balanceWithdrawal(){
		
		$this->load->view("users_interface/cabinet/balance-withdrawal");
	}
	
	public function bindAccountVK(){
		
		if($vkontakte = $this->getVKontakteAccessToken($this->input->get('code'),site_url(USER_START_PAGE.'/profile/bind-account-vk'))):
			if(isset($vkontakte['access_token']) && isset($vkontakte['user_id'])):
				$this->resetSNAccountID('vk',$vkontakte['user_id']);
				$result = $this->accounts->updateField($this->account['id'],'vkid',$vkontakte['user_id']);
				$result = $this->accounts->updateField($this->account['id'],'vk_access_token',$vkontakte['access_token']);
				if($VKontakteAccountInformation = $this->getVKontakteAccountInformation($vkontakte)):
					$this->setLinkVK($VKontakteAccountInformation['screen_name']);
				endif;
			endif;
		else:
			show_error('Ошибка при привязке. Попробуйте позже');
		endif;
		redirect(USER_START_PAGE.'/profile');
	}
	
	public function bindAccountFacebook(){
		
		if($accessToken = $this->getFaceBookAccessToken($this->input->get('code'),site_url(USER_START_PAGE.'/profile/bind-account-facebook'))):
			if($faceBookAccount = $this->getFaceBookAccountInformation($accessToken)):
				if(isset($faceBookAccount['id'])):
					$this->resetSNAccountID('facebook',$faceBookAccount['id']);
					$result = $this->accounts->updateField($this->account['id'],'facebookid',$faceBookAccount['id']);
					$result = $this->accounts->updateField($this->account['id'],'facebook_access_token',$accessToken);
					$this->setLinkFacebook($faceBookAccount['link']);
				endif;
			endif;
		else:
			show_error('Ошибка при привязке. Попробуйте позже');
		endif;
		redirect(USER_START_PAGE.'/profile');
	}
	
}
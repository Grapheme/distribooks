<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	if(!function_exists('secure_site_url')){
		function secure_site_url($uri = '',$scheme = 'https'){
			$CI = & get_instance();
			$parseURL = parse_url($CI->config->base_url($uri));
			$newURL = $scheme.'://'.$parseURL['host'];
			if(isset($parseURL['path'])):
				$newURL .= $parseURL['path'];
			else:
				$newURL .= '/';
			endif;
			if(isset($parseURL['query'])):
				$newURL .= '?'.$parseURL['query'];
			endif;
			if(isset($parseURL['fragment'])):
				$newURL .= '#'.$parseURL['fragment'];
			endif;
			return $newURL;
		}
	}
	
	function to_underscore($uri_string){
		
		if(!empty($uri_string)):
			return preg_replace('/[\/ ~%.:\-]+/','_',$uri_string);
		else:
			return FALSE;
		endif;
	}
	
	function getDomainURL($url){
		$parse = parse_url($url,PHP_URL_HOST);
		return preg_replace('/(www\.)/','',$parse);
	}

	function getUrlLink(){
		
		$CI = & get_instance();
		$get = $CI->input->get();
		$getLink = '';
		if($get !== FALSE):
			$temp = array();
			foreach($get as $key => $value):
				$temp[] = $key.'='.$value;
			endforeach;
			$getLink = '?'.implode('&',$temp);
		endif;
		return $getLink;
	}
	
	function urlGETParameters($notParameter = FALSE,$prefix = '?'){
		
		$CI = & get_instance();
		$get = $CI->input->get();
		$getLink = '';
		if($get !== FALSE):
			$temp = array();
			foreach($get as $key => $value):
				if($notParameter == TRUE && $key == $notParameter):
					continue;
				else:
					$temp[] = $key.'='.$value;
				endif;
			endforeach;
			$getLink = $prefix.implode('&',$temp);
		endif;
		return $getLink;
	}
	
	function baseURL($url = NULL){
		
		$CI = & get_instance();
		if(!is_null($url)):
			return $CI->baseURL.$url;
		else:
			return $CI->baseURL;
		endif;
	}
	
?>
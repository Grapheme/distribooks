<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	function getPriceInCurrency($bookPrice,$price_title ='руб.'){
		
		$CI = & get_instance();
		if($CI->uri->language_string == RUSLAN):
			return $bookPrice.' '.$price_title;
		elseif($CI->uri->language_string == ENGLAN):
			$CI->load->model('configuration');
			$dollar_rate = $CI->configuration->getDollarRate();
			return round($bookPrice/$dollar_rate,0).' $';
		endif;
	}
?>
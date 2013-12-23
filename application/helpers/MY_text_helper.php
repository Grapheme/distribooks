<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	function getPriceInCurrency($bookPrice,$price_title ='руб.'){
		
		$CI = & get_instance();
		if($CI->uri->language_string == RUSLAN):
			return $bookPrice.' '.$price_title;
		elseif($CI->uri->language_string == ENGLAN):
			$dollar_rate = 32.00;
			if(!empty($CI->project_config['dollar_rate'])):
				$dollar_rate = $CI->project_config['dollar_rate'];
			else:
				$CI->load->model('configuration');
				$dollar_rate = $CI->configuration->getDollarRate();
			endif;
			return '$'.round($bookPrice/$dollar_rate,2);
		endif;
	}
	
	function addCurrencyInPrice($bookPrice){
		
		$CI = & get_instance();
		if($CI->uri->language_string == RUSLAN):
			return $bookPrice.' руб.';
		elseif($CI->uri->language_string == ENGLAN):
			return '$'.$bookPrice;
		endif;
	}
	
	function CurrencyExchange($price){
		
		$CI = & get_instance();
		if($CI->uri->language_string == ENGLAN):
			$dollar_rate = 31.00;
			if(!empty($CI->project_config['dollar_rate'])):
				$dollar_rate = $CI->project_config['dollar_rate'];
			else:
				$CI->load->model('configuration');
				$dollar_rate = $CI->configuration->getDollarRate();
			endif;
			$price = round($price*$dollar_rate,2);
		endif;
		return $price;
	}
	
?>
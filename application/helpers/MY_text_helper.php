<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	function getDollarRate(){
		
		$CI = & get_instance();
		$dollar_rate = 32.00;
		if(!empty($CI->project_config['dollar_rate'])):
			$dollar_rate = $CI->project_config['dollar_rate'];
		else:
			$CI->load->model('configuration');
			$dollar_rate = $CI->configuration->getDollarRate();
		endif;
		return $dollar_rate;
	}
	
	function getPriceInCurrency($bookPrice,$price_title ='руб.'){
		
		$CI = & get_instance();
		if($CI->uri->language_string == RUSLAN):
			return $bookPrice.' '.$price_title;
		elseif($CI->uri->language_string == ENGLAN):
			return '$'.round($bookPrice/getDollarRate(),2,PHP_ROUND_HALF_EVEN);
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
	
	function CurrencyExchangeRUStoUS($price){
		
		$CI = & get_instance();
		if($CI->uri->language_string == ENGLAN):
			$price = round($price*getDollarRate(),2,PHP_ROUND_HALF_EVEN);
		endif;
		return $price;
	}
	
	function CurrencyExchangeUStoRUS($price){
		
		$CI = & get_instance();
		if($CI->uri->language_string == ENGLAN):
			$price = round($price/getDollarRate(),2,PHP_ROUND_HALF_EVEN);
		endif;
		return $price;
	}
?>
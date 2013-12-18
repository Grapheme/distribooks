<?php if(!defined('BASEPATH')) exit('no direct scripting allowed');

class Plural_words{
	
	var $CI;
	
	public function __construct(){
		
		$this->CI = & get_instance();
	}

	public function pluralBook($count,$lang = RUSLAN){
		
		$words = array('книга','книги','книг');
		if($lang == ENGLAN):
			$words = array('book','books','books');
		endif;
		return $this->getWord($count,$words);
	}

	private function getWord($n,$words){
		
		$n = abs($n) % 100;
		$n1 = $n % 10;
		if ($n > 10 && $n < 20) return $words[2];
		if ($n1 > 1 && $n1 < 5) return $words[1];
		if ($n1 == 1) return $words[0];
		return $words[2];
	}
}
?>
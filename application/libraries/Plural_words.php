<?php if(!defined('BASEPATH')) exit('no direct scripting allowed');

class Plural_words{
	
	var $CI;
	
	public function __construct(){
		
		$this->CI = & get_instance();
	}

	public function pluralFiles($count){
		
		$words = array('файл','файла','файлов');
		return $this->getWord($count,$words);
	}
	
	public function pluralHours($count){
		
		$words = array('час','часа','часов');
		return $this->getWord($count,$words);
	}
	
	public function pluralTasks($count){
		
		$words = array('проект','проекта','проектов');
		return $this->getWord($count,$words);
	}
	
	public function pluralVideoLessons($count){
		
		$words = array('видео-урок','видео-урока','видео-уроков');
		return $this->getWord($count,$words);
	}
	
	public function pluralLikedUsers($count){
		
		$words = array('пользователю','пользователям','пользователям');
		return $this->getWord($count,$words);
	}
	
	public function pluralComments($count){
		
		$words = array('комментарий','комментария','комментариев');
		return $this->getWord($count,$words);
	}
	
	public function pluralVisits($count){
		
		$words = array('просмотр','просмотра','просмотров');
		return $this->getWord($count,$words);
	}
	
	public function pluralSubscribesStudents($count){
		
		$words = array('студент подписался на курс','студента подписались на курс','студентов подписались на курс');
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
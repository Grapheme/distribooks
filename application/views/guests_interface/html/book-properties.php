<?php
	$addClass = '';
	if(isset($big_icons)):
		$addClass = ' big';
	endif;
?>

<?php
	if(!empty($book['trailers'])):
		if($video_trailer = json_decode($book['trailers'],TRUE)):
			if(isset($video_trailer[0]) && !empty($video_trailer[0])):
				echo anchor('#','&nbsp;',array('class'=>'shopi no-clickable'.$addClass,'id'=>'play'));
			endif;
		endif;
	endif;
?>
<?php
	if(!empty($book['audio_recording'])):
		if($audio_recording = json_decode($book['audio_recording'],TRUE)):
			if(isset($audio_recording[0]) && !empty($audio_recording[0])):
				echo anchor('#','&nbsp;',array('class'=>'shopi no-clickable'.$addClass,'id'=>'a'));
			endif;
		endif;
	endif;
?>
<?php if($this->loginstatus === TRUE && !isset($big_icons)):?>
	<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
<?php endif;?>
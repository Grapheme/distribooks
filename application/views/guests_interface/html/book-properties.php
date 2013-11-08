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
					<script type="text/javascript">(function() {
					  if (window.pluso)if (typeof window.pluso.start == "function") return;
					  if (window.ifpluso==undefined) { window.ifpluso = 1;
					    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
					    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
					    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
					    var h=d[g]('body')[0];
					    h.appendChild(s);
					  }})();
					</script>
										
	<a href="#" class="shoplus">
		<div class="pluso" data-url="<?=site_url($book['page_address'])?>" data-background="transparent" data-options="medium,square,line,vertical,nocounter,theme=01" data-services=""></div>
	</a>
<?php endif; ?>
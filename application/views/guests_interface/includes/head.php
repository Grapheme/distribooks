<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?=(isset($page_content[$this->uri->language_string.'_page_title']))?$page_content[$this->uri->language_string.'_page_title']:'Distribbooks';?></title>
<meta name="description" content="<?=(isset($page_content[$this->uri->language_string.'_page_description']))?$page_content[$this->uri->language_string.'_page_description']:'Distribbooks';?>">
<script>
	if(window.innerWidth < 767) {
		document.write('<meta name="viewport" content="width=480">');
	} else {
		document.write('<meta name="viewport" content="width=device-width">');
	}
</script>
<link rel="icon" href="<?=baseURL('favicon.ico')?>" type="image/x-icon">
<link rel="shortcut icon" href="<?=baseURL('favicon.ico')?>" type="image/x-icon">
<link rel="stylesheet" href="<?=baseURL('css/normalize.css');?>">
<link rel="stylesheet" href="<?=baseURL('css/main.css');?>">
<link rel="stylesheet" href="<?=baseURL('css/tooltip.css');?>">
<script type="text/javascript" src="//use.typekit.net/tuk3ffo.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
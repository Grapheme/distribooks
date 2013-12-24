<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
</head>
<body>
	<div class="wrapper">
		<?php if(!empty($message)):?>
			<?=$message;?>
		<?php endif;?>
	</div>
	<script type="text/javascript" src="<?=baseURL('js/libs/cookies.js');?>"></script>
	<script type="text/javascript" src="<?=baseURL('js/cabinet/guest.js');?>"></script>
	<script>
<?php if(empty($message)):?>
	alert("Payment Successful");
	cookies.setCookie('paypal_checkout',1,largeExpDate,'/');
<?php else:?>
	alert("Payment failed");
	cookies.setCookie('paypal_checkout',2,largeExpDate,'/');
<?php endif;?>
	window.onload = function(){
		if(window.opener){
			window.close();
		}else{
			if(top.dg.isOpen() == true){
				top.dg.closeFlow();
				return true;
			}
		}
	};
	</script>
</body>
</html>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<?php $this->load->view('guests_interface/includes/head');?>
</head>
<body>
	<div class="wrapper">
		<?php $this->load->view('guests_interface/includes/ie7');?>
		<?php $this->load->view('guests_interface/includes/header');?>
		<div class="dark-screen"></div>
		<div class="window-donation">
			<?php $this->load->view('guests_interface/forms/donation');?>
		</div>
		<div class="recall-div">
			<img class="recall-arrow" src="<?=baseURL('img/recall-arrow.png');?>">
				<div class="recall-in">
					<div class="after-recall-div">
						<img class="recall-after" src="<?=baseURL('img/after-recall.png');?>">
						<p class="recall-after-text">Ваш запрос успешно обработан</p>
					<div class="recall-text">Мы перезвоним в указаное вами время</div>
					</div>
					<div class="before-recall-div">
					<img class="recall-img" src="<?=baseURL('img/recall.png');?>">
					<div class="recall-text">Мы перезвоним в удобное для вас время</div>
					<?php $this->load->view('guests_interface/forms/request-call');?>
				</div>
			</div>
		</div>
		<div class="tooltip">
			<img class="tooltip-arrow" src="<?=baseURL('img/tooltip-arrow.png');?>">
			<div class="tooltip-in">
				<a href="#" class="social-link" id="vk"></a>
				<a href="#" class="social-link" id="vk"></a>
				<a href="#" class="social-link" id="vk"></a>
				<a href="#" class="social-link" id="vk"></a>
				<a href="#" class="social-link" id="vk"></a>
				<a href="#" class="social-link" id="vk"></a>
			</div>
		</div>
		<div class="min-menu">
			<a href="shop.html" class="blue button">Каталог</a><br>
			<a class="blue button">О проекте</a><br>
			<a class="blue button donation">Поддержать проект</a>
		</div>
		<?php $this->load->view('guests_interface/includes/auth');?>
		<div class="container_5">
			<div class="clear"></div>
			<div class="min-nav pos3">
				<?php $this->load->view('guests_interface/includes/small-nav');?>
			</div>
			<div class="grid_1 gift">
				<div class="gift-pad">
					<img src="<?=baseURL('img/book.png');?>">
					<div>
						<h2><span>Book is the best gift</span></h2>
						<p>Present book comfortably through our website</p>
						<a href="#" class="button red">Present</a>
					</div>
				</div>
			</div>
			<div class="grid_4 right-box">
				<div class="grid_4 alpha omega boxes" style="margin-left: -15px;">
					<?php $this->load->view('guests_interface/includes/big-nav');?>
				</div>
				<div class="grid_1 alpha">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Birman</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Drama</a>
							<p class="price old">500 RUB</p>
							<p class="price">450 RUB</p>
						</div>
					</div>
					<div class="buyor"><a href="#" class="buy">Buy</a><p class="tocart"><span>or</span><a href="#">Move to cart</a></p></div>
				</div>
				<div class="grid_1">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Birman</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Drama</a>
							<p class="price old">500 RUB</p>
							<p class="price">450 RUB</p>
							<a class="share-product" href="#"><img src="<?=baseURL('img/big-like.png');?>"><span>Поделиться</span></a>
						</div>
					</div>
					<div class="buyor"><a href="#" class="buy">Buy</a><p class="tocart"><span>or</span><a href="#">Move to cart</a></p></div>
				</div>
				<div class="grid_1">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Show</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Comedy</a>
							<p class="price old">500 RUB</p>
							<p class="price">780 RUB</p>
						</div>
					</div>
					<div class="buyor"><a href="#" class="buy">Buy</a><p class="tocart"><span>or</span><a href="#">Move to cart</a></p></div>
				</div>
				<div class="grid_1 omega">
					<div class="shop-top">
						<div class="shop-img">
							<a href="#" class="shopi" id="play" src=""></a>
							<a href="#" class="shopi" id="a" src="<?=baseURL('img/shop-a.png');?>"></a>
							<a href="#" class="shopi" id="like" src="<?=baseURL('img/shop-like.png');?>"></a>
							<div class="shop-img-cont"><img src="<?=baseURL('img/book-big.png');?>"></div>
						</div>
						<div class="shop-about">
							<a href="#" class="title">Softman</a>
							<p class="author">Author Dickens</p>
							<div class="rating-shop">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
								<img src="<?=baseURL('img/star-none.png');?>">
							</div>
							<a href="#" class="genre">Drama</a>
							<p class="price old">500 RUB</p>
							<p class="price">450 RUB</p>
						</div>
					</div>
					<div class="buyor"><a href="#" class="buy">Buy</a><p class="tocart"><span>or</span><a href="#">Move to cart</a></p></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="yellow">
			<div class="container_5">
				<div class="grid_1 news-div pos3-no">
					<div class="news-cont">
						<p class="title">News</p>
						<div class="news">
							<a href="#" class="news-title">Application</a>
							<a href="#" class="date">22.09.2013</a>
							<p class="news-desc">Start of new generation application</p>
						</div>
						<div class="news">
							<a href="#" class="news-title">Application</a>
							<a href="#" class="date">22.09.2013</a>
							<p class="news-desc">Start of new generation application</p>
						</div>
					</div>
				</div>
				<div class="grid_2 vidiv">
					<a href="#" class="vid-like"><img src="<?=baseURL('img/shop-like.png');?>">Share</a>
					<a href="#" class="vid-name">Softman</a>
					<a href="#" class="vid-play"></a>
					<a href="#" class="vid" style="background-image: url('<?=baseURL('img/vid.png');?>');">
						<img class="adult" src="img/adult.png">
					</a>
				</div>
				<div class="grid_2 vidiv">
					<a href="#" class="vid-like"><img src="<?=baseURL('img/shop-like.png');?>">Share</a>
					<a href="#" class="vid-name">Softman</a>
					<a href="#" class="vid-play"></a>
					<a href="#" class="vid" style="background-image: url('<?=baseURL('img/vid.png');?>');">
						<img class="adult" src="img/adult.png">
					</a>
				</div>
			</div>
		</div>
		<?php $this->load->view('guests_interface/includes/footer');?>
	</div>
	<?php $this->load->view('guests_interface/includes/scripts');?>
</body>
</html>
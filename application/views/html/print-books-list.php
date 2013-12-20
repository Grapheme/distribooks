<?php for($i=0;$i<count($books);$i++):?>
	<div class="grid_1<?=($i==0)?' alpha':'';?><?=($i==(count($books)-1))?' omega':'';?>">
		<div class="shop-top">
			<div class="shop-img">
				<div class="shop-img-cont"><a href="<?=site_url($books[$i]['page_address'])?>"><img src="<?=baseURL($books[$i]['thumbnail']);?>"></a></div>
			</div>
			<div class="shop-about">
				<a href="<?=site_url($books[$i]['page_address'])?>" class="title"><?=$books[$i][$this->uri->language_string.'_title'];?></a>
				<p class="author">
				<?php for($j=0;$j<count($books[$i]['authors']);$j++):?>
					<a href="<?=site_url('catalog?author='.$books[$i]['authors'][$j]['id'])?>"><?=$books[$i]['authors'][$j][$this->uri->language_string.'_name'];?></a><?php if(isset($books[$i]['authors'][$j+1])):?>,<br/> <?php endif;?>
				<?php endfor;?>
				</p>
				<a href="<?=site_url('catalog?genre='.$books[$i]['genre']);?>" class="genre"><?=$books[$i]['genre_title'];?></a>
			</div>
		</div>
	</div>
	<?php if(($i+1)%3 == 0):?>
	<div class="clear"></div>
	<?php endif?>
<?php endfor;?>
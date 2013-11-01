<div class="formats">
<?php if(!empty($formats)):?>
	<p class="formats-title"><?=lang('book_formats')?>:</p>
	<p class="format">Удобные:</p>
	<a class="format-link" href="#">fb2</a>, <a class="format-link" href="#">ePub</a>
	<p class="format">Для компьютера:</p>
	<a class="format-link" href="#">txt.zip</a>, <a class="format-link" href="#">rtf</a>, <a class="format-link" href="#">pdf A4</a>, <a class="format-link" href="#">html.zip</a>
	<p class="format">Для ридеров:</p>
	<a class="format-link" href="#">pdf A6</a>, <a class="format-link" href="#">mobi (Kindle)</a>
	<p class="format">Для телефона:</p>
	<a class="format-link" href="#">txt</a>, <a class="format-link" href="#">java</a>
	<p class="format">Другие:</p>
	<a class="format-link" href="#">lrf</a>, <a class="format-link" href="#">rb</a>, <a class="format-link" href="#">isilo3</a>, <a class="format-link" href="#">lit</a>, <a class="format-link" href="#">doc.prc</a>
<?php else:?>
	<p>Загрузка файлов временно недоступна</p>
<?php endif;?>
</div>
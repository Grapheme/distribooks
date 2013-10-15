<div class="recall-div">
	<img class="recall-arrow" src="<?=baseURL('img/recall-arrow.png');?>">
	<div class="recall-in">
		<div class="after-recall-div">
			<img class="recall-after" src="<?=baseURL('img/after-recall.png');?>">
			<p class="recall-after-text"><?=lang('form_recall_after_text')?></p>
			<div class="recall-text"><?=lang('form_recall_after_message')?></div>
		</div>
		<div class="before-recall-div">
			<img class="recall-img" src="<?=baseURL('img/recall.png');?>">
			<div class="recall-text"><?=lang('form_recall_text')?></div>
			<?php $this->load->view('guests_interface/forms/request-call');?>
		</div>
	</div>
</div>
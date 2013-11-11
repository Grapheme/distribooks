<div class="input select rating-f">
	<select class="select-rating book-ratind<?=($disabled === TRUE)?'-disabled':'';?>" name="rating" data-book-id="<?=$bookID;?>" >
		<option value="1"<?=($book['rating'] == 1)?' selected="selected"':'';?>>1</option>
		<option value="2"<?=($book['rating'] == 2)?' selected="selected"':'';?>>2</option>
		<option value="3"<?=($book['rating'] == 3)?' selected="selected"':'';?>>3</option>
		<option value="4"<?=($book['rating'] == 4)?' selected="selected"':'';?>>4</option>
		<option value="5"<?=($book['rating'] == 5)?' selected="selected"':'';?>>5</option>
	</select>
</div>
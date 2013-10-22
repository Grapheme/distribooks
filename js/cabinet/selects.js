/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$(".select-format-category").change(function(){
		var url = mt.currentURL.replace(/\?(.+)?/,'');
		if($(this).emptyValue() == false){
			url = url+'?category='+$(this).val();
		}
		mt.redirect(url);
	});
	$(".select-genres").change(function(){
		var url = mt.currentURL.replace(/\?(.+)?/,'');
		if($(this).emptyValue() == false){
			url = url+'?genre='+$(this).val();
		}
		mt.redirect(url);
	});
});
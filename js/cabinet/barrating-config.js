/* Author: Grapheme Group
 * http://grapheme.ru/
 */

$(function(){
	$(".book-ratind-disabled").barrating({
		showSelectedRating:false,
		readonly:true
	});
	$(".book-ratind").barrating({
		showSelectedRating:false,
		onSelect:function(value,text){
			try{
				var bookID = $(this).parents('.br-widget').siblings('.select-rating').attr('data-book-id').trim();
				$.ajax({
					url: mt.getLangBaseURL('set-book-rating'),
					data: {'book':bookID,'rating':value},
					type: 'POST',dataType: 'json',
					success: function(response,textStatus,xhr){
					
					},
					error: function(xhr,textStatus,errorThrown){
						console.log(xhr.responseText);
					}
				})
			}catch(e){
				console.log('Book ID is undefined');
			}
		}
	});
});
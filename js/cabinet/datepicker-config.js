/* Author: Grapheme Group
 * http://grapheme.ru/
 */

$(function(){
	$("input.set-news-data").datepicker({
		minDate: "01.01.2000",
		yearRange: '2000:2020',
		changeMonth: true,
		changeYear: true
	});
});
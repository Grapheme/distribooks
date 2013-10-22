/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$("input.authors-list").tokenInput(mt.getBaseURL('search-authors-list'),{
		theme: "facebook",
		hintText: "Введите слово для поиска",
		noResultsText: "Ничего не найдено",
		searchingText: "Поиск...",
	});
	if($("input.suggest-searching").length > 0){
		$("input.suggest-searching").tokenInput(
			getFormAction($("input.suggest-searching")),{
			theme: "facebook",
			hintText: "Введите слово для поиска",
			noResultsText: "Ничего не найдено",
			searchingText: "Поиск...",
			tokenDelimiter: ','
		});
	}
	
	function getFormAction(_input){
		return mt.getBaseURL($(_input).attr('data-search-action').trim());
	}
	
});
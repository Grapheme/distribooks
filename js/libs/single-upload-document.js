/* Author: Grapheme Group
* http://grapheme.ru/
*/
var Book = Book || {};

Book.interval = {};
Book.CurrentSize = 0;
Book.TotalSize = 0;
Book.element = {};
Book.inputFile = {};
Book.progressBar = {};
Book.readFile = function(file){
	var formData = new FormData();
	formData.append('file',file);
	Book.uploadFile(formData,file);
}
Book.uploadFile = function(formData,file){
	var action = $(Book.inputFile).attr('data-action');
	var xhr = new XMLHttpRequest();
	xhr.open('POST',action);
	xhr.fileInfo = file;
	xhr.upload.onprogress = function(event){
		if(event.lengthComputable){
			Book.CurrentSize = event.loaded;
		}
	};
	xhr.onload = function(event){
		var response = $.parseJSON(event.target.responseText);
		if(event.target.readyState == 4){
			if(event.target.status == 200){
				Book.CurrentSize = xhr.fileInfo.size;
				$(Book.progressBar).val(100);
				if(response.status == true){
					$("<li></li>").appendTo("ul.resources-items").html(response.responsePhotoSrc);
					$("ul.resources-items").find("a.delete-resource-item:last").off('click').on("click",function(event){
						event.preventDefault();
						mt.deleteResource(this);
					});
//					$(Book.element).parents('div.book-content-block').find(".lesson-content1").val(response.resource_id);
//					$(Book.element).parents('div.book-content-block').find(".lesson-content2").val(response.resource_title);
				}else{
					$(Book.progressBar).addClass('hidden').val(0);
					$(Book.element).parents('div.div-uploading-document').removeClass('hidden').after('<div class="msg-alert error">'+response.responseText+'</div>');
				}
			}else{
				$(Book.progressBar).addClass('hidden').val(0);
				$(Book.element).parents('div.div-uploading-document').removeClass('hidden').after('<div class="msg-alert error">'+response.responseText+'</div>');
			}
		}
	};
	xhr.setRequestHeader('X-FILE-NAME','true');
	xhr.send(formData);
}
Book.uploadProgress = function(){
	if(Book.CurrentSize == Book.TotalSize){
		clearInterval(Book.interval);
		setTimeout(function(){
			$(Book.progressBar).addClass('hidden').html(0);
			$(Book.element).parents('div.div-uploading-document').removeClass('hidden');
		},1000);
	}else{
		var percent = parseInt((Book.CurrentSize/Book.TotalSize)*100|0);
		$(Book.progressBar).val(percent);
	}
}
$(function(){
	$("a.delete-resource-item").click(function(){
		mt.deleteResource(this);
	});
	$("a.a-select-uploading-document").click(function(){
		Book.element = this;
		$("div.msg-alert").remove();
		Book.inputFile = $(Book.element).siblings('input.input-book-document');
		$(Book.inputFile).click();
		Book.progressBar = $(Book.element).parents('.book-content-block').find('.progress');
	});
	$("input.input-book-document").change(function(event){
		event.stopPropagation();
		event.preventDefault();
		Book.interval = setInterval(Book.uploadProgress,10);
		var file = event.target.files[0];
		Book.TotalSize = file.size;
		$(Book.element).parents('div.div-uploading-document').addClass('hidden');
		$(Book.progressBar).removeClass('hidden').val(0);
		Book.readFile(file);
	});
});
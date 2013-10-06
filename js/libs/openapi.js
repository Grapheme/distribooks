/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 
var VK_API = VK_API || {};

VK_API.config = {domain:'http://vk.com/share.php',pageTitle:'',pageDescription:'',pageUrl:'',pageImage:'',text:'',noparse:''};
VK_API.setConfig = function(param,value){VK_API.config[param] = value;}
VK_API.getConfig = function(param){return VK_API.config[param];}
VK_API.clearConfig = function(){
	VK_API.config['pageTitle'] = '';
	VK_API.config['pageDescription'] = '';
	VK_API.config['pageUrl'] = '';
	VK_API.config['pageImage'] = '';
	VK_API.config['text'] = '';
	VK_API.config['noparse'] = 'false';
}
VK_API.createVKLike = function(){
	window.open(VK_API.createVKLink(),'publication-vk',"top=140,left=150,width=560,height=450,resizable=yes,scrollbars=no,status=no");
}
VK_API.createVKLink = function(){
	return VK_API.config['domain']+'?url='+VK_API.config['pageUrl']+'&title='+VK_API.config['pageTitle']+'&description='+VK_API.config['pageDescription']+'&image='+VK_API.config['pageImage'];
}

var FB_API = FB_API || {};

FB_API.config = {domain:'https://www.facebook.com/sharer/sharer.php',pageTitle:'',pageDescription:'',pageUrl:'',pageImage:'',text:'',noparse:''};
FB_API.setConfig = function(param,value){FB_API.config[param] = value;}
FB_API.getConfig = function(param){return FB_API.config[param];}
FB_API.clearConfig = function(){
	FB_API.config['pageTitle'] = '';
	FB_API.config['pageDescription'] = '';
	FB_API.config['pageUrl'] = '';
	FB_API.config['pageImage'] = '';
	FB_API.config['text'] = '';
}
FB_API.createFBLike = function(){
	window.open(FB_API.createVKLink(),'publication-fb',"top=140,left=150,width=560,height=450,resizable=yes,scrollbars=no,status=no");
}
FB_API.createVKLink = function(){
	return FB_API.config['domain']+'?s=100&p[url]='+encodeURIComponent(FB_API.config['pageUrl'])+'&p[title]='+encodeURIComponent(FB_API.config['pageTitle'])+'&p[summary]='+FB_API.config['pageDescription']+'&p[images][0]='+FB_API.config['pageImage'];
}
$(function(){
	$("button.subscribe-publication-vk").click(function(){VK_API.createVKLike();})
	$("button.subscribe-publication-fb").click(function(){FB_API.createFBLike();})
})
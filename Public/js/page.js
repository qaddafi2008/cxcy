$(document).ready(function() {
	var href = window.location.href;
	var sidebarindex = -1;
	$.each($("#menu>li>a"), function(i,item){  
			$(this).attr("class","but");
			if(href.indexOf($(this).attr("href"))!=-1){
				$(this).attr("class","but_active");
			}
		});
	$.each($("#sidebar a"),function(i,item){
		if(href.indexOf($(this).attr("href"))!=-1){
			sidebarindex = i;
		}
	});
	$.each($("#sidebar li:even"),function(i,item){
		$(this).attr("class","color");
		if((2*i)==sidebarindex)
		{
			$(this).attr("class","color_active");
		}
	});
	$.each($("#sidebar li:odd"),function(i,item){
		$(this).attr("class","");
		if((2*i+1)==sidebarindex)
		{
			$(this).attr("class","color_active");
		}
	});
	
	$(".signin").click(function(e) {
		e.preventDefault();
		$("fieldset#signin_menu").toggle();
		$(".signin").toggleClass("menu-open");
	});

	$("fieldset#signin_menu").mouseup(function() {
		return false
	});
	$(document).mouseup(function(e) {
		if ($(e.target).parent("a.signin").length == 0) {
			$(".signin").removeClass("menu-open");
			$("fieldset#signin_menu").hide();
		}
	});

});
$(function() {
	$('#forgot_username_link').tipsy({
		gravity : 'w'
	});
});


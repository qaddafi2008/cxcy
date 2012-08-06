var href = window.location.href;//当前url
$(document).ready(function() {
	var ishomepage = -1;//当前homepage的index
	$.each($("#menu>li>a"), function(i,item){  
			$(this).attr("class","but");
			if(href.indexOf($(this).attr("href"))!=-1){
				ishomepage = i;
				$(this).attr("class","but_active");
			}
		});
	if(ishomepage==-1)
	{
		$("#menu>li>a:first").attr("class","but_active");
	}
	
	//sidebar一级菜单跟随点击的颜色变化
	$.each($("#list>li>a"),function(i,item){
		$(this).removeClass("color_active");
		$(this).parent("li").addClass("hover");
		if(href.indexOf($(this).attr("href"))!=-1){
			$(this).addClass("color_active");
			$(this).parent("li").removeClass("hover");
			$(this).parent("li").children("dl").show();
		}
	});
	
	//sidebar二级菜单跟随点击的颜色变化
	$.each($("#list>li>dl>dd>a"),function(i,item){
		$(this).click(
				function(){
					$.each($("#list>li>dl>dd>a"),function(i,item)
					{
						$(this).removeClass("color_active");
					});
					$(this).addClass("color_active");
					$(this).parent("dd").parent("dl").parent("li").removeClass("hover");
					$(this).parent("dd").parent("dl").parent("li").children("a").addClass("color_active");
					$(this).parent("dd").parent("dl").parent("li").children("dl").show();
				}
		);
	});
	
	//登陆框
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

	//下拉式菜单，主菜单
	$("#menu li").hover(function() {
		$(this).children("dl").slideDown(100)
	}, function() {
		$(this).children("dl").slideUp(100)
	});
	
	//下拉式菜单，sidebar菜单
	$("#list .hover").hover(function() {
		$(this).children("dl").slideDown(100)
	}, function() {
		$(this).children("dl").slideUp(100)
	}); 
	
	
	//sidebar跟随滚动条滚动
	var basetop = $("#main_block").offset().top ;//sidebar的基准top
	$(window).scroll(function (){ 
		var scrolltop = $(window).scrollTop();
		if(scrolltop>basetop)
		{
			$("#sidebar").animate({top : scrolltop +"px" },{ duration:300 , queue:false });
		}
		else
		{
			$("#sidebar").animate({top : basetop+"px" },{ duration:300 , queue:false });
			
		}
	}); 
	
});
$(function() {
	$('#forgot_username_link').tipsy({
		gravity : 'w'
	});
});

//腾飞创业部分首页的页面内跳转
function forwardto(dest)
{
	var atemp = $("#list>li>dl>dd>a:contains("+dest+")");
	var hreftemp = $(atemp).parent().parent().parent().children("a:first").attr("href");
	if(href.indexOf(hreftemp)==-1)
	{
		top.location = hreftemp;
	}
	
	$.each($("#main_block .title"),function(i,item){
		if($(this).text()==dest)
		{
			var scrolltop = $(this).offset().top+"px";
			$( 'html, body' ).animate( { scrollTop: scrolltop }, { duration:300 , queue:false } );
		}
	});
}

function writeObj(obj){
	    var description = "";
	    for(var i in obj){ 
	        var property=obj[i]; 
	        description+=i+" = "+property+"\n";
	    } 
	    alert(description);
}
function ShowObjProperty(Obj) {
	var PropertyList = '';
	var PropertyCount = 0;
	for (i in Obj) {
		if (Obj.i != null)
			PropertyList = PropertyList + i + '属性：' + Obj.i + '\r\n';
		else
			PropertyList = PropertyList + i + '方法\r\n';
	}
	alert(PropertyList);
}
$(function(){
    //如果申请认证参与按钮的控制
	var isaplly = $('#isApply').val();
	if(1 == isaplly){
		$('#doApplyBtn').attr('value','已申请认证参与');
		$('#doApplyBtn').attr('disabled','disabled');
	}else if(2 == isaplly){
		$('#doApplyBtn').attr('value','已参与');
		$('#doApplyBtn').attr('disabled','disabled');
	}else if("" == isaplly)
		$('#doApplyBtn').remove();
	
	
	//为评论中的回复连接添加点击事件
	$("#lcommenttable a").click(function(){
		var replyname = $(this).attr("data-uname");
		$("#comment").attr("value","回复"+replyname+"：");
	});
	
	//为回复按钮添加点击事件
	$("#updateSObtn").click(function(){
		
		if("" == $('#commenter').val()){
			alert('请先登录！');
			window.location.href= '#welcomeinfo';			
			$("fieldset#signin_menu").toggle();
        	$(".signin").toggleClass("menu-open");
		}else if("" == $("#comment").val())
			alert("请先填写回复内容！");
		else 
			$("#comForm").submit();
	});
	
	$('#doApplyBtn').click(function(){
		var lid = $('#lid').val();
			
		$.ajax({
        	method : "get",
        	url : $("#baseurl").val() + "/doApply/lid/" + lid,
        	cache : false,
        	success : function(msg) {//对返回的数据进行处理
				var resmsg= eval('('+msg+')');
				alert(resmsg.info);
				
				$('#doApplyBtn').attr('value','已申请认证参与');
				$('#doApplyBtn').attr('disabled','disabled');
        	}
    	});						  
	});
	
		   

	

});
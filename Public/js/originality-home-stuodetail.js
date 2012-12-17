$(function(){
		   
	//如果已被当前作者收藏，则屏蔽按钮
	if(1 == $('#isCollected').val())
		$('#doCollect').attr('disabled','disabled');
	if(1 == $("#urole").val())//如果是老师
		$('#doCollect').remove();
	
	$('#doCollect').click(function(){
		var oid = $('#originalityid').val();
			
		$.ajax({
        	method : "get",
        	url : $("#baseurl").val() + "/doCollect/oid/" + oid,
        	cache : false,
        	success : function(msg) {//对返回的数据进行处理
				var resmsg= eval('('+msg+')');
				alert(resmsg.info);
				
				$('#doCollect').attr('disabled','disabled');
        	}
    	});						  
	});
	
	//判断管理员是否已经给出成绩，如果已给出，老师不能再修改成绩
	var fmark = $('#finalMark').val();
  	if('' != fmark){//给出最终成绩
  		$('#teachertips').html("管理员已给出最终成绩："+fmark+" 分。不能再修改!");
		$('#ocomment').attr('disabled','disabled');
		$('#omark').attr('disabled','disabled');
		$('#updateOMarkbtn').attr('disabled','disabled');
	}
		   
	//为评论中的回复连接添加点击事件
	$("#ocommenttable a").click(function(){
		var replyname = $(this).attr("data-uname");
		$("#comment").attr("value","回复"+replyname+"：");
	});
	
	//为回复按钮添加点击事件
	$("#updateSObtn").click(function(){
		if("" == $("#comment").val())
			alert("请先填写回复内容！");
		else
			$("#comForm").submit();
	});
	
	//为提交分数按钮钮添加点击事件
	$("#updateOMarkbtn").click(function(){
		var omark = $("#omark").val();
		if('' == omark){
			alert("请先输入成绩！");
		}else if(isNaN(omark)){//非数字值
			alert("成绩必须为数字！");
		}else
			$("#updateMarkForm").submit();								
	});

});
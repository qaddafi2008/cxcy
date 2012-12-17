$(function(){
	var teacherselected = 0;
    $("#teacherListTable input:checkbox").each(function() {
        $(this).click(function() {
            if ($(this).attr("checked") == "checked") {
                teacherselected++;
                if (teacherselected >= 3) {
					$('#assignBtn').removeAttr("disabled");
                    $.each($("#teacherListTable input:checkbox"), function() {
                        if ($(this).attr("checked") == "checked") {
                        } else {
                            $(this).attr("disabled", "disabled");
                        }
                    });
                }
            } else {
                teacherselected = (teacherselected == 0 ? 0 : teacherselected - 1);
                if (teacherselected == 2) {
					$('#assignBtn').attr("disabled", "disabled");
                    $.each($("#teacherListTable input:checkbox"), function() {
                        if ($(this).attr("checked") == "checked") {
                        } else {
                            $(this).removeAttr("disabled");
                        }
                    });
                }
            }
        });
    });
	
	$("#resetBtn").click(function(){
		teacherselected = 0;		
		$("#teacherListTable input:checkbox").each(function() {
			if ($(this).attr("checked") == "checked") 
                $(this).removeAttr("checked");
			if ($(this).attr("disabled") == "disabled") 
				 $(this).removeAttr("disabled");
		});
		$('#assignBtn').attr("disabled", "disabled");
	});
	
	//判断是否已经为创意分配导师
	var isassign = $("#isAssigned").val();
	if(1 == isassign){
		$("#teacherAssignForm").remove();
		$("#assignStatustip").html("【老师评审情况】");
	}else{
		$("#divmark").remove();
	}
	
	//判断创意是否已经公布
	var ispublic = $("#ispublic").val();
	if(1 == ispublic){
		$("#finalmark").attr("disabled", "disabled");
		$("#updateFinalMarkBtn").remove();
		$("#markTips").html("已公布，不可修改");
	}
	
	//为修改最终成绩按钮添加点击事件
	$("#updateFinalMarkBtn").click(function(){
		var fmark = $("#finalmark").val();
		if('' == fmark){
			alert("请先输入最终成绩！");
		}else if(isNaN(fmark)){//非数字值
			alert("最终成绩必须为数字！");
		}else
			$("#finalMarkForm").submit();
	});
	
});
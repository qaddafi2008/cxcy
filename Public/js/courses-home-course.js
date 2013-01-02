$(function(){  
  //为课程列表中的提交按钮添加事件
  $('#selectCourseBtn').click(function(){
		var val = "";
		$('input[name="cids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要选修的课程！");
		else{
			if(confirm("提交后将不可再修改！确定要提交所选的课程吗？"))
				$("#cSelectionForm").submit();
		}
	});
	
	//为课程列表中全选复选框添加事件
	$('#cb_all').click(function(){
		if($("#cb_all").attr("checked")==undefined)
			$("input:checkbox").attr("checked",false);
		else{
			$("input:checkbox").attr("checked",true);
		}
	});
});
$(function(){
  //设置是否公开radio的选中值
  var ispublic = $('#h_ispublic').val();

  if('' == ispublic){
  	$("input[name=ispublic][value=1]").attr("checked",'checked');
  }else
  	$("input[name=ispublic][value="+ispublic+"]").attr("checked",'checked');
	
  //为课程提交按钮添加事件
  $('#updatecbtn').click(function(){
		var cname = $('#coursename').val();
		var teacher = $('#teacher').val();
		var headcout = $('#headcount').val();
		if('' == cname)
			alert('请输入课程名！');
		else if('' == teacher)
			alert('请输入任课老师！');
		else if(isNaN(headcout))//非数字值
			alert('限选人数必须为数字！');
		else 
			$('#form_course').submit();
  });
  
  //为课程列表中的发布按钮添加事件
  $('#public_button').click(function(){
		var val = "";
		$('input[name="cids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要发布的课程！");
		else{
			if(confirm("确定要发布所选的课程吗？"))
				$("#cpublicForm").submit();
		}
	});
	
	//为课程列表中全选复选框添加事件
	$('#cb_all').click(function(){
		if($("#cb_all").attr("checked")==undefined)
			$("input:checkbox").attr("checked",false);
		else{
			$("#publicCoursesTable input:checkbox").each(function() {
				if ($(this).attr("disabled") == undefined) 
					$(this).attr("checked",true);
			});
		}
	});
	
	//为课程列表中的创建课程按钮添加事件
	$('#createCourse_button').click(function(){
		window.location.href='courseDetail';									 
	});
	
	//选课名单中全选复选框添加事件
	$('#cb_members_all').click(function(){
		if($("#cb_members_all").attr("checked")==undefined)
			$("input:checkbox").attr("checked",false);
		else{
			$("#selectionMembersTable input:checkbox").each(function() {
				if ($(this).attr("disabled") == undefined) 
					$(this).attr("checked",true);
			});
		}
	});
	
	//选课名单中的搜索按钮的动作
	$('#courseNameSearchBtn').click(function(){		
		var keywords_cn = $('#searchCname').val();
		if(keywords_cn == ''){
			$("#selectionMembersTable tr").show();
		}
		
		$.each($(".subjectRow:visible"), function() {
                if ($(this).text().search(keywords_cn) == -1) {
                    $(this).parent("tr").hide();
                }
            });
	});
	
	//选课名单中的批量通过按钮添加事件
	$('#pass_button').click(function(){
		var val = "";
		$('input[name="ccids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要通过的选项！");
		else{
			if(confirm("确定要通过所有选中的项吗？")){
				$('#passOrReject').attr('value',1);
				$("#selectionMemberForm").submit();
			}
		}
	});
	
	////选课名单中的批量拒绝按钮添加事件
	$('#reject_button').click(function(){
		var val = "";
		$('input[name="ccids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要拒绝的选项！");
		else{
			if(confirm("拒绝后将会删除对应的选项！确定要拒绝所有选中的项吗？")){
				$('#passOrReject').attr('value',0);
				$("#selectionMemberForm").submit();
			}
		}
	});
	
	//为成绩列表中的提交成绩按钮添加事件
	$("#updateMarks_button").click(function() {
	   var flag = true;
       $.each($("#cMarksTable input:text"), function() {
            if(isNaN($(this).attr("value"))){
            	flag = false;
			}
        });
	   if(flag)
	   	 $('#cMarksForm').submit();
	   else
	     alert('成绩必须为数字！');
	});
});
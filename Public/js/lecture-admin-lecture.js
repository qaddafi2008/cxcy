$(function(){
   
  //为讲座列表中的发布讲座按钮添加事件
	/*$('#createLecture_button').click(function(){
		window.location.href='createLecture';									 
	});*/
	
	//为讲座详细信息的提交按钮添加事件
	$('#updateLectureBtn').click(function(){
		if("" == $('#subject').val())
			alert("请输入讲座标题！");
		else
			$('#lecture_form').submit();
	});
	
	//为讲座参与名单列表的参与状态下拉菜单添加事件
	$('#select_certification').change(function(){
		filterOList();
	});
	
	function filterOList(){
		var cstatus =  $("#select_certification").children('option:selected').val();
		
		$("#participationListTable tr").show();
		if("不限" == cstatus){
			
		}else{
			$.each($(".cstatus:visible"), function() {
					if ($(this).text() != cstatus) {
						$(this).parent("tr").hide();
						$(this).parent("tr").children(".pidRow").children("[type='checkbox']").attr("checked",false);//去掉隐藏选项的勾
					}
				});
		}
	}
	
	//为讲座参与名单列表中的搜索按钮添加动作
	$('#participationSearchBtn').click(function(){
		filterOList();//过滤下拉框的选项
		
		var keywords_stu = $('#searchWordStu').val();
		if(keywords_stu == ''){
			return;
		}
		
		$.each($(".subjectRow:visible"), function() {
                if ($(this).text().search(keywords_stu) == -1) {
                    $(this).parent("tr").hide();
                }
            });
	});
	
	//为讲座参与名单列表中全选复选框添加事件
	$('#cb_stus_all').click(function(){
		if($("#cb_stus_all").attr("checked")==undefined)
			$("input:checkbox").attr("checked",false);
		else{
			$("#participationListTable input:checkbox").each(function() {
				if ($(this).attr("disabled") == undefined) 
					$(this).attr("checked",true);
			});
		}
	});
	
	//为讲座参与名单列表中的认证通过按钮添加事件
	$('#passBtn').click(function(){
		var val = "";
		$('input[name="pids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要认证通过的选项！");
		else{
			if(confirm("确定要认证通过所有选中的项吗？")){
				$('#passOrReject').attr('value',1);
				$("#participationForm").submit();
			}
		}
	});
	
	//为讲座参与名单列表中的未参与按钮添加事件
	$('#rejectBtn').click(function(){
		var val = "";
		$('input[name="pids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要拒绝的选项！");
		else{
			if(confirm("标记为未参与后将会删除对应的选项！确定要将所有选中的项认证为未参与？")){
				$('#passOrReject').attr('value',0);
				$("#participationForm").submit();
			}
		}
	});
	
	//为讲座参与名单列表中的添加参与名单按钮添加事件
	$('#addParticipationBtn').click(function(){
		var lname = $('#lname').val();
		var lid = $('#lid').val();
		var baseurl = $('#baseUrl').val();
		window.location.href= baseurl+'/addParticipatedStudents/lname/'+lname+'/lid/'+lid;									 
	});
	
	//为添加参与名单的学生选择列表中的搜索按钮添加动作
	$('#studentSearchBtn').click(function(){	
		$("#stuParticipationTable tr").show();
		var keywords_stu = $('#searchWordStu').val();
		if(keywords_stu == ''){
			return;
		}
		
		$.each($(".subjectRow:visible"), function() {
                if ($(this).text().search(keywords_stu) == -1) {
                    $(this).parent("tr").hide();
                }
            });
	});
	
	//为添加参与名单的学生选择列表中的已参与按钮添加动作
	$('#hasParticipatedBtn').click(function(){
		var val = "";
		$('input[name="sids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要添加为“已参与”的选项！");
		else{
			if(confirm("确定要将所有选中的项添加为“已参与”吗？")){
				$("#stuParticipationForm").submit();
			}
		}
	});
	
});
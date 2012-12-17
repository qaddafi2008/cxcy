$(function(){
	$('#select_isopen').change(function(){
		filterOList();
	});
	
	$('#select_assignment').change(function(){
		filterOList();
	});
	
	function filterOList(){
		var fisopen =  $("#select_isopen").children('option:selected').val();
		var fisassigned = $("#select_assignment").children('option:selected').val();
		
		$("#adminoriginalityListTable tr").show();
		if("不限" == fisopen && "不限" == fisassigned){
			
		}else{
			if("不限" != fisopen){
				$.each($(".isopenRow:visible"), function() {
					if ($(this).text() != fisopen) {
						$(this).parent("tr").hide();
					}
				});
			}
			if("不限" !=fisassigned){
				$.each($(".isassignedRow:visible"), function() {
					if ($(this).text() != fisassigned) {
						$(this).parent("tr").hide();
					}
				});
			}
		}
	}
	//学生页面中的搜索按钮的动作
	$('#originalitiesSearchBtn').click(function(){
		filterOList();//过滤下拉框的选项
		
		var keywords_stu = $('#searchWord').val();
		if(keywords_stu == ''){
			return;
		}
		
		$.each($(".subjectRow:visible"), function() {
                if ($(this).text().search(keywords_stu) == -1) {
                    $(this).parent("tr").hide();
                }
            });
	});
});
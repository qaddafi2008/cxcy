$(function(){
	//学生页面中的搜索按钮的动作
	$('#searchOriginality').click(function(){
		var keywords_stu = $('#keywords_stu').val();
		if(keywords_stu == ''){
			$("#originalityListTable tr").show();
			return;
		}
		$("#originalityListTable tr").show();
		
		$.each($(".subjectrow:visible"), function() {
                if ($(this).text().search(keywords_stu) == -1) {
                    $(this).parent("tr").hide();
                }
            });
	});

});
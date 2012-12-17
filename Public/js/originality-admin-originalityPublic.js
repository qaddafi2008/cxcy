$(function(){
	$('#public_button').click(function(){
		var val = "";
		$('input[name="oids[]"]:checked').each(function(){
			val += $(this).val()+",";
		});
		if("" == val)
			alert("请先选择要公布的创意！");
		else{
			if(confirm("确定要公布所选的创意吗？"))
				$("#opublicForm").submit();
		}
	});
	
	$('#cb_all').click(function(){
		if($("#cb_all").attr("checked")==undefined)
			$("input:checkbox").attr("checked",false);
		else{
			$("#publicTable input:checkbox").each(function() {
				if ($(this).attr("disabled") == undefined) 
					$(this).attr("checked",true);
			});
		}
	});
});
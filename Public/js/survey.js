$(function () {
	$('#dialog1').dialog({
		bgiframe: true,
		autoOpen: false,
		width:500,
		modal: true,
		buttons: {
			'确定': function() {
				$(this).dialog('close');
				var q1 = $("input:radio[name='q1']:checked").val();//获取radio选中的值
				var q2 = $("input:radio[name='q2']:checked").val();
				if(q1 == 'no' && q2 == 'no')
				{
					//alert('建议您参加“起步创业”！');
					$('p#result').html('建议您参加“起步创业”！');
					$('#survey_result').dialog('open');//打开对话框
				}else
					$('#dialog2').dialog('open');
					
				
			},
			'忽略': function() {
				$(this).dialog('close');
				$.ajax({//采用ajax与后台进行通信
					url:'surveyIsDone',
					success:function(data){
						//alert(data);
					}
				});
			}
		},
		close: function(event) {
			//$(':text').val('');//获取表单的text元素
			$.ajax({//采用ajax与后台进行通信
					url:'surveyIsDone',
					success:function(data){
						//alert(data);
					}
				});
		}
	});
	
	$('#dialog2').dialog({
		bgiframe: true,
		autoOpen: false,
		width:500,
		modal: true,
		buttons: {
			'确定': function() {
				$(this).dialog('close');
				var q3 = $("input:radio[name='q3']:checked").val();//获取radio选中的值
				var q4 = $("input:radio[name='q4']:checked").val();
				var q5 = $("input:radio[name='q5']:checked").val();
				
				if(q5 == 'yes')
				{
					//alert('建议您参加“助跑创业”！');
					$('p#result').html('建议您参加“助跑创业”！');
					$('#survey_result').dialog('open');
				}else
				{
					if('no' == q3 && 'no' == q4)
					{
						//alert('建议您参加“助跑创业”！');
						$('p#result').html('建议您参加“助跑创业”！');
						$('#survey_result').dialog('open');
					}else
						$('#dialog3').dialog('open');
				}
			},
			'忽略': function() {
				$(this).dialog('close');
				$.ajax({//采用ajax与后台进行通信
					url:'surveyIsDone',
					success:function(data){
						//alert(data);
					}
				});
			}
		},
		close: function(event) {
			$.ajax({//采用ajax与后台进行通信
					url:'surveyIsDone',
					success:function(data){
						//alert(data);
					}
				});
		}
	});
	
	$('#dialog3').dialog({
		bgiframe: true,
		autoOpen: false,
		width:500,
		modal: true,
		buttons: {
			'确定': function() {
				$(this).dialog('close');
				var q6 = $("input:radio[name='q6']:checked").val();//获取radio选中的值
				var q7 = $("input:radio[name='q7']:checked").val();
				
				if('no'==q6 && 'no'==q7)
				{
					//alert('建议您参加“加油创业”！');
					$('p#result').html('建议您参加“加油创业”！');
					$('#survey_result').dialog('open');
				}else
				{
					//alert('建议您参加“腾飞创业”！');
					$('p#result').html('建议您参加“腾飞创业”！');
					$('#survey_result').dialog('open');
				}
			},
			'忽略': function() {
				$(this).dialog('close');
				$.ajax({//采用ajax与后台进行通信
					url:'surveyIsDone',
					success:function(data){
						//alert(data);
					}
				});
			}
		},
		close: function(event) {
			$.ajax({//采用ajax与后台进行通信
					url:'surveyIsDone',
					success:function(data){
						//alert(data);
					}
				});
		}
	});
	
	$('#survey_result').dialog({
		bgiframe: true,
		autoOpen: false,
		width:250,
		modal: true,
		close: function(event) {
			$.ajax({//采用ajax与后台进行通信
					url:'surveyIsDone',
					success:function(data){
						//alert(data);
					}
				});
		}
	});

	/*$('#add').click(function() {
		$('#dialog').dialog('open');
	});*/
	
	var is_surveyed = $('#issurveyed').val();
	if(is_surveyed == -1)//尚未填写调查问卷，且是需要填写的学生用户
		$('#dialog1').dialog('open');
});
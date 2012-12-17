$(function () {
  //设置是否公开radio的选中值
  var isopen = $('#h_isopen').val();
  var oid = $('#stuOriginalityID').val();
  if('' == isopen){
  	$("input[name=isopen][value=1]").attr("checked",'checked');
  }else
  	$("input[name=isopen][value="+isopen+"]").attr("checked",'checked');
  
  //判断是首次创建还是修改
  if('' != oid){//为修改
    $('#file').hide();
	$('#fileStatus').attr('value','1');
  }
  
  //判断是否已经分发给老师修改
  if(1 == $('#isAssigned').val()){//已分发给老师
  	var fmark = $('#finalMark').val();
  	if('' == fmark)//还没给出最终成绩
  		$('#stuotips').html("当前状态：已分发到评委老师，待审核...");
	else
		$('#stuotips').html("最终成绩："+fmark+" 分");
	//$('#tips').show();
		
	//将按钮和输入框disalbe掉
	$('#updateSObtn').attr('disabled','disabled');
	$('#resetSObtn').attr('disabled','disabled');
	$('#delFile').attr('disabled','disabled');
	$('#subject').attr('disabled','disabled');
	$('#authors').attr('disabled','disabled');
  }
	
  //删除文件按钮的事件
  $('#delFile').click(function(){
	if(confirm("确定要删除已提交的申报表吗？")){
		$('#fileStatus').attr('value','2');
		//$('#existedFile').attr('href','');
		
		$('#existedFile').remove();
		$('#file').show();
		$('#delFile').remove();
	}
  });

  //提交按钮的事件
  $('#updateSObtn').click(function(){
	   var obgContent=CKEDITOR.instances.obackground.getData(); //ckeditor的内容验证比较特殊，必须得这样转化，obackground为id/name
	   var abstractContent=CKEDITOR.instances.abstract.getData();
	   var fsContent=CKEDITOR.instances.functiondescription.getData();
	   
	   obgContent = obgContent.replace(/^\s+/g,"");  
       obgContent = obgContent.replace(/\s+$/g,"");  
	   abstractContent = abstractContent.replace(/^\s+/g,"");  
       abstractContent = abstractContent.replace(/\s+$/g,""); 
	   fsContent = fsContent.replace(/^\s+/g,"");  
       fsContent = fsContent.replace(/\s+$/g,""); 
	   
	  if('' == $('#subject').val()){
		  alert('请填写创意名称！');
		  return false;
	  }else if('' == $('#authors').val()){
	  	alert('请填写小组成员！');
		return false;
	  }else if('' == obgContent){
	  	alert('请填写创意背景说明！');
		return false;
	  }else if('' == abstractContent){
	  	alert('请填写创意概述！');
		return false;
	  }else if('' == fsContent){
	  	alert('请填写创意功能说明！');
		return false;
	  }else if('' == $('#file').val() && 1 != $('#fileStatus').val()){
	  	alert('请选择您的创意申报表！');
		return false;
	  }else
	    $('#stuOForm').submit();							   
    
  });
});
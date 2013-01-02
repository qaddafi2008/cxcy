<?php
import('webApp.Action.Admin.Common');
class OriginalityAction extends Action{
	//进入创意申请表页面
	public function odeclareTable(){
		$pathOfOdeclaredTable = M('pathofodeclaredtable');
		$result = $pathOfOdeclaredTable->find();
		if($result){
			$this->assign('tableName',$result['path']);
			$this->display();
		}else{
			$this->display('uploadODeclareTable');
		}
	}
	
	//上传创意申请表
	public function doUploadODeclaredTable(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		$result = Common::uploadFile('OriginalityAdmin');
		if("success" == $result){
			$pathOfOdeclaredTable = M('pathofodeclaredtable');
			$data['path'] = $_FILES ["file"] ["name"];
			if($pathOfOdeclaredTable->add($data))
				$this->success('上传成功！','odeclareTable');
			else
				$this->error('保存到数据库失败！');
		}else if("Invalidsize" == $result){
			$this->error("文件大小超过范围，上传失败！");
		}else if("error" == $result){
			$this->error("上传失败！");
		}
	}
	
	//删除创意申请表
	public function doDeleteODeclaredTable(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		if(!Common::removeOneFile($_POST['tname'],'OriginalityAdmin'))
			$this->error('删除服务器中的文件失败！');
		$pathOfOdeclaredTable = M('pathofodeclaredtable');
		
		if($pathOfOdeclaredTable->where('path IS NOT NULL')->delete())
			$this->success('删除成功！');
		else
			$this->error('删除失败！');
	}
	
	//下载创意申请表
	public function downloadODeclaredTable(){
		$file_name = $_GET['tname'];
		$success = Common::downloadFile($file_name,'OriginalityAdmin');
		if($success == "nofile")
				$this->error("找不到文件...");
	}
	
	//进入评审规则页面
	public function reviewrule(){
		$reviewRule = M('reviewrule');
		$result = $reviewRule->find(1);
		if($result){
			$this->assign('r',$result);
			$this->display();
		}else{
			$this->error('没有初始数据！');
		}	
	}
	
	//更新评审规则
	public function doUpdateReviewRule(){
		$data['subject'] = $_POST['subject'];
		$data['content'] = $_POST['content'];
		
		$reviewRule = M('reviewrule');
		if($reviewRule->where("rrid=".$_POST['rrid'])->save($data))
			$this->success('修改成功！');
		else
			$this->error('修改失败！');
	}
	
	//获取创意列表
	public function getOriginalityList(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		$originality = M('originality');
		$list = $originality->field('oid,subject,author,submittime,isopen,asignment')->order('submittime desc')->select();//指定字段查询
		
		$this->assign ( 'originalityList', $list);
		$this->display('originalityList');
			
	}
	
	//获取创意详细信息
	public function getOriginalityDetail(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		$oid = $_GET['oid'];
		
		$originality = M('originality');
		$result = $originality->where("oid=$oid")->find();
		
		//获得作者姓名
		$stu = M('student');
		$sname = $stu->where("sid=".$result['stuid'])->field('sname')->find();
		$result['sname'] = $sname['sname'];
		
		if(1 == $result['asignment']){//已分配给评委老师
			$model = new Model();
			$querystr = "SELECT teachername,`comment`,mark from originalityreview,stuff WHERE originalityid=$oid and stuffid=teacherid";
			$reviewResult = $model->query($querystr);
		}else{//为分配给评委老师
			//获得所有老师信息
			$stuff = M('stuff');
			$condition['role'] = 1;
			$condition['teachername'] = array("neq","");
			$condition['teachertitle'] = array("neq","");
			$condition['major'] = array("neq","");
			$condition['area'] = array("neq","");
			$teacherlist = $stuff->where($condition)->select();
		}
		
		
		
		$this->assign('teacherlist',$teacherlist);//要显示的老师列表
		$this->assign('reviewList',$reviewResult);//评委老师评审结果
		$this->assign('myOriginality',$result);
		$this->display('originalityDetail');
	}
	
	//分配老师
	public function assignTeachers(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		$oid = $_POST['oid'];
		$teacherIDs = $_POST['teacherid'];
		//echo "$oid : $teacherIDs[0],$teacherIDs[1],$teacherIDs[2]";
		$oreview = M('originalityreview');
		$data['originalityid'] = $oid;
		for($i=0;$i<count($teacherIDs);$i++){
			$data['teacherid'] = $teacherIDs[$i];
			if(!$oreview->add($data))
				$this->error("分配失败！");
		}
		$originality = M('originality');
		$savedata['asignment'] = 1;
		if($originality->where("oid=$oid")->save($savedata))
			$this->success("分配成功","getOriginalityList");
		else
			$this->error("修改分配状态失败！");
	}
	
	//更新最终成绩
	public function updateFinalmark(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		$oid = $_POST['oid'];
		$fmark = $_POST['finalmark'];
		
		$originality = M('originality');
		$data['finalmark'] = $fmark;
		if($originality->where("oid=$oid")->save($data))
			$this->success('提交成功！','getOriginalityList');
		else
			$this->error("提交失败！");
	}
	
	//进行创意公布的列表
	public function originalitypublic(){
		$originality = M('originality');
		$result = $originality->where("finalmark is NOT NULL")->field("oid,subject,author,finalmark,ispublic")->select();
		
		$this->assign('originalities',$result);
		$this->display('originalityPublic');
	}
	
	//批量发布
	public function doPublicOriginalities(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		
		$oids = $_POST['oids'];
		$originality = M('originality');
		$data['ispublic'] = 1;
		$data['publictime'] = date("Y-m-d H:i:s");
		
		for($i=0;$i<count($oids);$i++){
			//echo "$oids[$i] ";
			if(!$originality->where("oid = $oids[$i]")->save($data))
				$this->error("批量发布失败！");
		}
		$this->success('批量发布成功！','originalitypublic');
			
	}
}
?>
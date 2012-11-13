<?php
import("webApp.Action.Admin.Common");
class ActivityAction extends Action{
	/**
	 * 对Activities表中的字段activitytype的说明：
	 * 90：表示国际交流活动
	 * 91：表示国际交流活动下的新闻列表
	 */
	public function index(){
		$this->activity();	
	}

	/**
	 * 活动列表
	 */
	public function activity(){
		$pagetype = 1;
		$activitymodel = M("Activities");
		$condition = "";
		$mode = "detail";
		$condition['activitytype'] = 90;
		$newslist = $activitymodel->where($condition)->order("endtime desc")->select();
		for($i=0;$i<count($newslist);$i++){
			if($newslist[$i]['attachmentpath'])
			{
				$newslist[$i]['filename'] = Common::removesuffix($newslist[$i]['attachmentpath']);
			}
		}
		$this->assign("mode",$mode);
		$this->assign("newslist",$newslist);
		$this->assign("pagetype",$pagetype);
		$this->display("Activity:newslist");
	}

	/**
	 * 显示详细的活动信息
	 */
	public function detail(){
		//var_dump($_GET);
		$activitymodel = M("Activities");
		$pagetype = 1;
		$operation = $_GET['_URL_'][3];
		$acttype = "";
		if($operation == "add"){
			$acttype = 90;
			$htmltitle = "添加活动";
			$this->assign("htmltitle",$htmltitle);

		}
		else if($operation == "modify"){
			$condition = "";
			$condition['activityid'] = $_GET['_URL_'][4];
			$news = $activitymodel->where($condition)->find();
			$news['attachmentpath'] = Common::removesuffix($news['attachmentpath']);
			$acttype = $news['activitytype'];
			$this->assign("news",$news);
		}
		$this->assign("acttype",$acttype);
		$this->assign("pagetype",$pagetype);
		$this->assign("operation",$operation);
		$this->display("Activity:news");
	}

	/**
	 * 处理提交的内容
	 */
	public function submit(){
		$operation = $_POST['operation'];
		$activitymodel = M("Activities");
		if($operation == "add")
		{
			$data['activitytype'] = $_POST['acttype'];
			$data['activitysubject'] = $_POST['subject'];
			$data['createtime'] = $_POST['createtime'];
			$data['applydeadline'] = $_POST['deadlinetime'];
			$data['starttime'] = $_POST['starttime'];
			$data['endtime'] = $_POST['endtime'];
			$data['activitycontent'] = $_POST['activitycontent'];
			$activityid = $activitymodel->add($data);
			if($activityid&&$_FILES['file']){
				$suffix = $activityid.".activity";
				$fileresult = Common::upload($suffix);
				$datatemp['attachmentpath'] = $_FILES ["file"] ["name"]."###".$suffix;
				$datatemp['activityid'] = $activityid;
				$activitymodel->save($datatemp);
			}
			if($fileresult!=ERROR&&$activityid){
				if($_POST['acttype'] == "90"){
					$this->activity();
				}
				elseif($_POST['acttype']=="91"){
					$this->newslist();
				}
			}
		}else if($operation == "modify"){
			$data['activityid'] = $_POST['activityid'];
			$data['activitytype'] = $_POST['acttype'];
			$data['activitysubject'] = $_POST['subject'];
			$data['createtime'] = $_POST['createtime'];
			$data['applydeadline'] = $_POST['deadlinetime'];
			$data['starttime'] = $_POST['starttime'];
			$data['endtime'] = $_POST['endtime'];
			$data['activitycontent'] = $_POST['activitycontent'];

			if($_FILES['file']){
				$suffix = $data['activityid'].".activity";
				$fileresult = Common::upload($suffix);
				if($fileresult!=ERROR){
					$data['attachmentpath'] = $_FILES ["file"] ["name"]."###".$suffix;
				}
			}
			$result = $activitymodel->save($data);;
			if($result){
				if($_POST['acttype'] == "90"){
					$this->activity();
				}
				elseif($_POST['acttype']=="91"){
					$this->newslist();
				}
			}
		}
		$this->error("未知错误");
	}


	/**
	 * 国际交流活动新闻列表
	 */
	public function newslist(){
		$pagetype = 2;
		$activitymodel = M("Activities");
		$condition = "";
		$mode = "news";
		$condition['activitytype'] = 91;
		$newslist = $activitymodel->where($condition)->order("createtime desc")->select();
		for($i=0;$i<count($newslist);$i++){
			if($newslist[$i]['attachmentpath'])
			{
				$newslist[$i]['filename'] = Common::removesuffix($newslist[$i]['attachmentpath']);
			}
		}
		$this->assign("mode",$mode);
		$this->assign("newslist",$newslist);
		$this->assign("pagetype",$pagetype);
		$this->display("Activity:newslist");
	}

	/**
	 * 国际活动新闻详情（增、改）
	 */
	public function news(){
		$pagetype = 2;
		$operation = $_GET['_URL_'][3];
		$acttype = "";
		if($operation == "add"){
			$acttype = 91;
			$htmltitle = "添加新闻";
			$this->assign("htmltitle",$htmltitle);
		}else if($operation == "modify"){
			$condition = "";
			$activitymodel = M("Activities");
			$condition['activityid'] = $_GET['_URL_'][4];
			$news = $activitymodel->where($condition)->find();
			$news['attachmentpath'] = Common::removesuffix($news['attachmentpath']);
			$acttype = $news['activitytype'];
			$this->assign("news",$news);
		}
		$this->assign("acttype",$acttype);
		$this->assign("pagetype",$pagetype);
		$this->assign("operation",$operation);
		$this->display("Activity:news");
	}


	/**
	 * 下载文件
	 */
	public function downfile(){
		try{
			$suffix = $_GET['_URL_'][3].".activity";
			$filename = $_GET['_URL_'][4];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}	
	}
	
	public function downattachment(){
		try{
			$suffix = $_GET['_URL_'][3].".actapp";
			$filename = $_GET['_URL_'][4];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
	
	/**
	 * 按ID删除
	 */
	public function deleteByID(){
		AuthorityAction::checkAdminLogin();
		$condition['activityid'] = $_GET['_URL_'][3];
		$activitymodel = M("Activities");
		$result = $activitymodel->where($condition)->find();
		if($result['attachmentpath']){
			Common::removefile($result['activityid'].".activity");
		}
		$result = $activitymodel->where($condition)->delete();
		$this->ajaxReturn($result,$result>0?"成功":"失败",$result);
	}
	
	/**
	 * 按ID删除学生的报名
	 */
	public function deleteApplyByID(){
		AuthorityAction::checkAdminLogin();
		$condition['actapplicationid'] = $_GET['_URL_'][3];
		$actapp = M("activityapplication");
		$result = $actapp->where($condition)->find();
		if($result['attachmentpath']){
			Common::removeFileDirectly($result['attachmentpath']);
		}
		$result = $actapp->where($condition)->delete();
		$this->ajaxReturn($result,$result>0?"成功":"失败",$result);
	}
	
	/**
	 * 报名列表
	 */
	public function apply(){
		$actapp = M("activityapplication");
		$activity = M("activities");
		$actid = $_GET['_URL_'][3];
		$newslist = "";
		if($actid){
			$condition['actid'] = $actid;
			$newslist = $actapp->where($condition)->select();
		}else{
			$newslist = $actapp->select();
		}
		$condition = null;
		for($i=0;$i<count($newslist);$i++){
			$newslist[$i]['filename'] = Common::removesuffix($newslist[$i]['attachmentpath']);
			$condition['activityid'] = $newslist[$i]['actid'];
			$temp = $activity->where($condition)->field('activitysubject as actname')->find();
			$newslist[$i]['actname'] = $temp['actname'];
			$newslist[$i]['id'] = $newslist[$i]['actapplicationid'];
		}
		$this->assign("newslist",$newslist);
		$this->display("applylist");
	}
}
?>
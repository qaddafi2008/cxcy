<?php
import('webApp.Action.Admin.Common');
class HHFundAction extends Action{

	/**
	 * 对Activities表中的字段activitytype的说明：
	 * 60：表示学生创新创业系列赛事
	 * 61：表示学生创新创业系列赛事的阶段
	 * 62：表示学生创新创业系列赛事的新闻通知
	 * 90：表示国际交流活动
	 * 91：表示国际交流活动下的新闻列表
	 * 
	 * 
	 * 对activityapplication表中的字段acttype的说明：
	 * 60：学生创新创业系列赛事的报名
	 * 63：学生创新创业系列赛事的作品
	 * 90：国际交流活动的报名表
	 * 
	 * 对appraisal表的字段comtype说明（该表的类型与activity和activityapplication中的acttype一致）
	 * 64：学生创新创业系列赛事中管理员分配给老师的附件
	 * 65：学生创新创业系列赛事中老师上传的评审附件
	 * 
	 */
	public function index(){
		$this->activity();
	}

	public function comdetail(){
		$activitymodel = M("Activities");
		$condition = "";
		$condition['activitytype'] = 80;
		$temp = $activitymodel->where($condition)->field("activityid as id")->find();
		if($temp){
			$this->redirect("detail",array('modify'=>$temp['id']));
		}
		else{
			$this->redirect("detail",array("add"=>"0"));
		}
	}

	public function agenda(){
		$activitymodel = M("Activities");
		$condition = "";
		$condition['activitytype'] = 81;
		$temp = $activitymodel->where($condition)->field("activityid as id")->find();
		if($temp){
			$this->redirect("agendadetail",array('modify'=>$temp['id']));
		}
		else{
			$this->redirect("agendadetail",array("add"=>"0"));
		}
	}

	/**
	 * 显示详细的赛事信息
	 */
	public function detail(){
		//var_dump($_GET);
		AuthorityAction::checkAdminLogin();
		$activitymodel = M("Activities");
		$pagetype = 1;
		$operation = $_GET['_URL_'][3];
		$acttype = "";
		if($operation == "add"){
			$acttype = 80;
			$htmltitle = "添加赛事";
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
		AuthorityAction::checkAdminLogin();
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
				if($_POST['acttype'] == "80"){
					$this->success("添加成功！","comdetail");
					//$this->comdetail();
				}elseif($_POST['acttype']=="81"){
					$this->success("添加成功！","agenda");
					//$this->agendadetail();
				}
				elseif($_POST['acttype']=="82"){
					$this->success("添加成功！","newslist");
					//$this->newslist();
				}else{
					$this->error("未知错误");
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
			if($_POST['alreadyfile']==""||$_POST['alreadyfile']==null){
				$suffix = $data['activityid'].".activity";
				Common::removefile($suffix);
				$data['attachmentpath'] = "";
			}
			if($_FILES['file']){
				$suffix = $data['activityid'].".activity";
				$fileresult = Common::upload($suffix);
				if($fileresult!=ERROR){
					$data['attachmentpath'] = $_FILES ["file"] ["name"]."###".$suffix;
				}
			}
			$result = $activitymodel->save($data);;
			if($result){
				if($_POST['acttype'] == "80"){
					$this->success("更新成功！","comdetail");
					//$this->comdetail();
				}elseif($_POST['acttype']=="81"){
					$this->success("更新成功！","agenda");
					//$this->agendadetail();
				}
				elseif($_POST['acttype']=="82"){
					$this->success("更新成功！","newslist");
					//$this->newslist();
				}
			}else{
				$this->error("未知错误");
			}
		}else{
			$this->error("未知错误");
		}
	}


	/**
	 * 赛事新闻列表
	 */
	public function newslist(){
		AuthorityAction::checkAdminLogin();
		$pagetype = 2;
		$activitymodel = M("Activities");
		$condition = "";
		$mode = "news";
		$condition['activitytype'] = 82;
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
	 * 赛事新闻详情（增、改）
	 */
	public function news(){
		AuthorityAction::checkAdminLogin();
		$pagetype = 2;
		$operation = $_GET['_URL_'][3];
		$acttype = "";
		if($operation == "add"){
			$acttype = 82;
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

	public function agendadetail(){
		AuthorityAction::checkAdminLogin();
		$pagetype = 2;
		$operation = $_GET['_URL_'][3];
		$acttype = "";
		if($operation == "add"){
			$acttype = 81;
			$htmltitle = "添加赛程";
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
		AuthorityAction::checkAdminLogin();
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
		AuthorityAction::checkAdminLogin();
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
	public function applytable(){
		AuthorityAction::checkAdminLogin();
		$actapp = M("activityapplication");
		$activity = M("activities");
		$actid = $_GET['_URL_'][3];
		$newslist = "";
		$condition['acttype'] = 80;
		if($actid){
			$condition['actid'] = $actid;
				
		}
		$newslist = $actapp->where($condition)->select();
		$condition = null;
		for($i=0;$i<count($newslist);$i++){
			$newslist[$i]['filename'] = Common::removesuffix($newslist[$i]['attachmentpath']);
			$condition['activityid'] = $newslist[$i]['actid'];
			$temp = $activity->where($condition)->field('activitysubject as actname')->find();
			$newslist[$i]['actname'] = $temp['actname'];
			$newslist[$i]['id'] = $newslist[$i]['actapplicationid'];
		}
		$this->assign("newslist",$newslist);
		$this->display("Activity:applylist");
	}


	/**
	 * 作品列表
	 */
	public function applywork(){
		AuthorityAction::checkAdminLogin();
		$actapp = M("activityapplication");
		$activity = M("activities");
		$actid = $_GET['_URL_'][3];
		$newslist = "";
		$condition['acttype'] = 83;
		if($actid){
			$condition['actid'] = $actid;

		}
		$newslist = $actapp->where($condition)->select();
		$condition = null;
		for($i=0;$i<count($newslist);$i++){
			$newslist[$i]['filename'] = Common::removesuffix($newslist[$i]['attachmentpath']);
			$condition['activityid'] = $newslist[$i]['actid'];
			$temp = $activity->where($condition)->field('activitysubject as actname')->find();
			$newslist[$i]['actname'] = $temp['actname'];
			$newslist[$i]['id'] = $newslist[$i]['actapplicationid'];
		}
		$this->assign("newslist",$newslist);
		$this->display("Activity:applylist");
	}

	/**
	 * 分配作品
	 */
	public function assignwork(){
		AuthorityAction::checkAdminLogin();
		$stuff = M('stuff');
		$list = $stuff->where('role=1')->order('stuffid')->select();
		
		$appraisal = M('appraisal');
		$condition = "";
		for($i=0;$i<count($list);$i++){
			$condition['comtype'] = 84;
			$condition['teacherid'] = $list[$i]['stuffid'];
			$results = $appraisal->where($condition)->find();
			if($results){
				$list[$i]['filename'] = $results['attachmentpath'];
				$list[$i]['assignid'] = $results['appraisalid'];
			}
			
			$condition['comtype'] = 85;
			$results = $appraisal->where($condition)->find();
			if($results){
				$list[$i]['backfilename'] = $results['attachmentpath'];
				$list[$i]['appraisalid'] = $results['appraisalid'];
			}
		}
		$this->assign('recordcounts',count($list));
		$this->assign('list',$list);
		$this->display("Competition:assignwork");
	}

	/**
	 * 回收评审
	 */
	public function getbackwork(){
		$this->assignwork();
	}
	
	/**
	 * 上传给老师的评审附件
	 */
	public function uploadassign(){
		AuthorityAction::checkAdminLogin();
		$appraisal = M('appraisal');
		if($_POST['comtype'] == 99){
			$teacherids = split(",", $_POST['teacherid']);
			$fileuploaded = false;
			$sourcefilename = "";
			$sourcesuffix = "";
			for($j=0;$j<count($teacherids);$j++){
				$data = "";
				$data['comtype'] = 84;
				$data['teacherid'] = $teacherids[$j];
				$results = $appraisal->where($data)->find();
				if(!$results){
					$appraisalid = $appraisal->add($data);
					$data['appraisalid'] = $appraisalid;
				}
				else{
					$data['appraisalid'] = $results['appraisalid'];
				}
				$suffix = $data['appraisalid'].".assign";
				Common::removefile($suffix);
				$data['attachmentpath'] = "";
				if(!$fileuploaded){
					$uploadfile = Common::uploadFile($suffix);
					if($uploadfile=="success"){
						$data['attachmentpath'] = $_FILES['file']['name'];
						$fileuploaded = true;
						$sourcesuffix = $suffix;
						$sourcefilename = $data['attachmentpath'];
					}
				}elseif($fileuploaded){
					$uploadfile = Common::copyfile($sourcefilename."###".$sourcesuffix, $sourcefilename."###".$suffix);
					if($uploadfile){
						$data['attachmentpath'] = $sourcefilename;
					}
				}
				$appraisal->save($data);
			}
		}
		elseif($_POST['teacherid']&&$_POST['comtype']){
			$data = "";
			if($_POST['comtype'] == 4){
				$data['comtype'] = 84;
			}elseif($_POST['comtype']==5){
				$data['comtype'] = 85;
			}else{
				$this->error("类型有误");
			}
			$data['teacherid'] = $_POST['teacherid'];
			$results = $appraisal->where($data)->find();
			if(!$results){
				$appraisalid = $appraisal->add($data);
				$data['appraisalid'] = $appraisalid;
			}
			else{
				$data['appraisalid'] = $results['appraisalid'];
			}
			$suffix = $data['appraisalid'].".assign";
			Common::removefile($suffix);
			$data['attachmentpath'] = "";
			$uploadfile = Common::uploadFile($suffix);
			if($uploadfile=="success"){
				$data['attachmentpath'] = $_FILES['file']['name'];
			}
			$appraisal->save($data);
		}
		$this->assignwork();
	}
	
	/**
	 * 删除给老师的评审
	 */
	public function deleteAssign(){
		AuthorityAction::checkAdminLogin();
		$appraisal = M('appraisal');
		if($_POST['teacherid']){
			$condition['teacherid'] = $_POST['teacherid'];
			$condition['comtype'] = 84;
			$results = $appraisal->where($condition)->find();
			if($results){
				if($results['attachmentpath']){
					Common::removefile($results['appraisalid'].".assign");
					$results['attachmentpath'] = "";
					$temp = $appraisal->save($results);
					$this->ajaxReturn($temp,"成功",$temp);
				}
			}else{
				$this->ajaxReturn(0,"失败",0);
			}
		}
		else{
			$this->ajaxReturn(0,"失败",0);
		}
	}
	
	/**
	 * 删除老师上传的评审
	 */
	public function deleteAppraisal(){
		AuthorityAction::checkAdminLogin();
		$appraisal = M('appraisal');
		if($_POST['teacherid']){
			$condition['teacherid'] = $_POST['teacherid'];
			$condition['comtype'] = 85;
			$results = $appraisal->where($condition)->find();
			if($results){
				if($results['attachmentpath']){
					Common::removefile($results['appraisalid'].".assign");
					$results['attachmentpath'] = "";
					$temp = $appraisal->save($results);
					$this->ajaxReturn($temp,"成功",$temp);
				}
			}else{
				$this->ajaxReturn(0,"失败",0);
			}
		}
		else{
			$this->ajaxReturn(0,"失败",0);
		}
	}
	
	/**
	 * 下载给老师的评审文件
	 */
	public function downassign(){
		AuthorityAction::checkAdminLogin();
		try{
			$suffix = $_GET['_URL_'][3].".assign";
			$filename = $_GET['_URL_'][4];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
	
	/**
	 * 下载老师上传的评审文件
	 */
	public function downappraisal(){
		AuthorityAction::checkAdminLogin();
		try{
			$suffix = $_GET['_URL_'][3].".appraisal";
			$filename = $_GET['_URL_'][4];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
}
?>
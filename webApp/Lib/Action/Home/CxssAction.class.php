<?php
/**
 * 对Activities表中的字段activitytype的说明：
 * 60：表示学生创新创业系列赛事
 * 61：表示学生创新创业系列赛事的阶段
 * 62：表示学生创新创业系列赛事的新闻通知
 * 90：表示国际交流活动
 * 91：表示国际交流活动下的新闻列表
 *
 * 对activityapplication表中的字段acttype的说明：
 * 60：学生创新创业系列赛事的报名
 * 63：学生创新创业系列赛事的作品
 * 90：国际交流活动的报名表
 *
 *
 * 对appraisal表的字段comtype说明（该表的类型与activity和activityapplication中的acttype一致）
 * 64：学生创新创业系列赛事中管理员分配给老师的附件
 * 65：学生创新创业系列赛事中老师上传的评审附件
 */
import('webApp.Action.Admin.Common');
class CxssAction extends Action{

	protected function _empty()
	{
		$this->index();
	}
	public function index() {//首页
		$this->redirect("jinzhan");
	}
	public function jinzhan(){//进展
		$activitymodel = M("Activities");

		//$this->newslist(array("id"=>$temp['id']));
		$condition = "";
		$condition['activitytype'] = 61;
		$maincontent = $activitymodel->field("activityid as id,activitysubject as title,createtime,activitycontent as content,attachmentpath")->where($condition)->select();
		$maincontent[0]['filename'] = Common::removesuffix($maincontent[0]['attachmentpath']);

		$this->assign("mode",$mode);
		$this->assign("maincontent",$maincontent);
		$this->assign("tablenewslist",$newslist);
		$this->setSidebar();
		$this->display ("Gjjl:page");
	}
	public function jieshao(){//介绍
		$activitymodel = M("Activities");
		$condition = "";
		$condition['activitytype'] = 60;
		$maincontent = $activitymodel->field("activityid as id,activitysubject as title,createtime,starttime,endtime,applydeadline,activitycontent as content,attachmentpath")->where($condition)->select();
		$maincontent[0]['filename'] = Common::removesuffix($maincontent[0]['attachmentpath']);
		$this->setSidebar();
		$this->assign("mode",$mode);
		$this->assign("maincontent",$maincontent);
		$this->assign("tablenewslist",$newslist);
		$this->display ("Gjjl:page");
	}
	public function baoming(){//报名页面
		//$this->showpage(1,2);
		$this->apply(60);
	}
	public function zuoping(){//作品
		//$this->showpage(1,3);
		$this->apply(63);
	}
	public function xinwen(){//新闻
		$this->newslist();
	}
	public function shenpi(){
		AuthorityAction::checkTeacherLogin();
		$appraisal = M('appraisal');
		$condition = "";
		$condition['comtype'] = 64;
		$condition['teacherid'] = $_SESSION['uid'];
		$result = $appraisal->where($condition)->find();
		$maincontent[0]['title'] = "作品审批下载";
		$maincontent[0]['fileurl'] = "__URL__/downAssign/".$result['appraisalid']."/".$result['attachmentpath'];
		$maincontent[0]['attachment'] = $result['attachmentpath'];
		$this->setSidebar();
		$this->assign("maincontent",$maincontent);
		$this->display ("Cxss:page");
	}
	public function tijiao(){
		AuthorityAction::checkTeacherLogin();
		$appraisal = M('appraisal');
		
		if($_POST['comtype'] == 65){
			$data = "";
			$data['comtype'] = 65;
			$data['teacherid'] = $_SESSION['uid'];
			$result = $appraisal->where($data)->find();
			if(!$result){
				$id = $appraisal->add($data);
				$data['appraisalid'] = id;
			}else{
				$data['appraisalid'] = $result['appraisalid'];
			}
			$data['attachmentpath'] = "";
			$suffix = $data['appraisalid'].".appraisal";
			$temp = Common::uploadFile($suffix);
			if($temp == "success"){
				$data['attachmentpath'] = $_FILES['file']['name'];
				$appraisal->save($data);
			}
		}
		
		$condition = "";
		$condition['comtype'] = 65;
		$condition['teacherid'] = $_SESSION['uid'];
		$result = $appraisal->where($condition)->find();
		$maincontent[0]['title'] = "作品审批提交";
		$maincontent[0]['fileurl'] = "__URL__/downAppraisal/".$result['appraisalid']."/".$result['attachmentpath'];
		$maincontent[0]['attachment'] = $result['attachmentpath'];
		$this->setSidebar();
		$this->assign("comtype",65);
		$this->assign("maincontent",$maincontent);
		$this->display ("Cxss:page");
	}

	public function setSidebar(){
		//左侧导航栏
		$modelname = "创新创业系列赛事："; //本模块名称
		$navindex = 0;
		if($_SESSION['urole']==2){
			$navlist [$navindex++] = array ("url" => '__URL__/xinwen', "title"=>'赛事新闻');
			$navlist [$navindex++] = array ("url" => '__URL__/jinzhan', "title" => '当前进展' );
			$navlist [$navindex++] = array ("url" => '__URL__/jieshao', "title" => '赛事介绍' );
			$navlist [$navindex++] = array ("url" => '__URL__/baoming', "title" => '报名参加' );
			$navlist [$navindex++] = array ("url" => '__URL__/zuoping', "title" => '提交作品' );
		}elseif($_SESSION['urole']==1){
			$navlist [$navindex++] = array ("url" => '__URL__/xinwen', "title"=>'赛事新闻');
			$navlist [$navindex++] = array ("url" => '__URL__/jinzhan', "title" => '当前进展' );
			$navlist [$navindex++] = array ("url" => '__URL__/jieshao', "title" => '赛事介绍' );
			$navlist [$navindex++] = array ("url" => '__URL__/shenpi', "title" => '下载审批' );
			$navlist [$navindex++] = array ("url" => '__URL__/tijiao', "title" => '提交审批' );	
		}else{
			$navlist [$navindex++] = array ("url" => '__URL__/xinwen', "title"=>'赛事新闻');
			$navlist [$navindex++] = array ("url" => '__URL__/jinzhan', "title" => '当前进展' );
			$navlist [$navindex++] = array ("url" => '__URL__/jieshao', "title" => '赛事介绍' );
			$navlist [$navindex++] = array ("url" => '__URL__/baoming', "title" => '报名参加' );
		}
		
		$this->assign("navlist",$navlist);
		$this->assign("modelname",$modelname);
	}

	/**
	 * 活动列表
	 */
	public function huodong(){
		date_default_timezone_set('Asia/Chongqing');

		$activitymodel = M("Activities");
		$activityapplication = M("activityapplication");
		if(isset($_GET['id'])){
			$condition = "";
			$condition['activityid'] = $_GET['id'];
			$condition['activitytype'] = 60;
			$maincontent = $activitymodel->field("activityid as id,activitysubject as title,createtime,starttime,endtime,applydeadline,activitycontent as content,attachmentpath")->where($condition)->select();
			$maincontent[0]['filename'] = Common::removesuffix($maincontent[0]['attachmentpath']);
		}
		else{
			$maincontent[0]['title'] = "学生创新创业系列赛事";
			$condition = "";
			$mode = "activity";
			$condition['activitytype'] = 60;
			$newslist = $activitymodel->field("activityid as id,activitysubject as title,createtime,starttime,endtime,applydeadline")->where($condition)->order("createtime desc")->select();
			//var_dump($newslist);
			for($i=0;$i<count($newslist);$i++){
				$newslist[$i]['url'] = "__URL__/huodong/id/".$newslist[$i]['id'];
				$now = date("Y-m-d H:i:s");

				if(strtotime($now)<strtotime($newslist[$i]['starttime'])){
					$newslist[$i]['applyurl'] = "notstarted";
				}
				elseif(strtotime($now)>=strtotime($newslist[$i]['endtime'])){
					$newslist[$i]['applyurl'] = "over";
				}elseif(strtotime($now) >= strtotime($newslist[$i]['applydeadline'])){
					$newslist[$i]['applyurl'] = "outofapply";
				}
				else{
					$newslist[$i]['applyurl'] = $newslist[$i]['id'];
				}

				$tempcon = "";
				$tempcon['studentid'] = $_SESSION['uid'];
				$tempcon['actid'] = $newslist[$i]['id'];
				$temp = $activityapplication->where($tempcon)->find();
				if($temp){
					$newslist[$i]['applyurl'] = "applied";
				}
			}
		}
		$this->setSidebar();
		$this->assign("mode",$mode);
		$this->assign("maincontent",$maincontent);
		$this->assign("tablenewslist",$newslist);
		$this->display ("Gjjl:page");
	}

	/**
	 * 活动报名
	 */
	public function apply($type){
		AuthorityAction::checkStudentLogin();
		$activitymodel = M("Activities");
		$activityapplication = M("activityapplication");
		if(isset($_POST["actid"])){
			if(isset($_POST['comacttype'])){
				$type = $_POST['comacttype'];
			}
			$data['actid'] = $_POST["actid"];
			$data['acttype'] = $type;
			$data['studentid'] = $_SESSION['uid'];
			$data['studentname'] = $_SESSION['uname'];
			$existeddata = $activityapplication->where($data)->find();
			if($existeddata){
				$actappid = $existeddata['actapplicationid'];
				$uploadfile = Common::uploadFile($actappid.".actapp");
				if($uploadfile=="nofile"){
					$this->error("请上传文件！","baoming");
				}elseif ($uploadfile=="success"){
					if($existeddata['attachmentpath'] != $_FILES['file']['name']."###".$actappid.".actapp"){
						Common::removeFileDirectly($existeddata['attachmentpath']);
						$existeddata['attachmentpath'] = $_FILES['file']['name']."###".$actappid.".actapp";
						$activityapplication->save($existeddata);
					}
					//$this->success("更新成功！");
				}else{
					$this->error("未知错误！","baoming");
				}
			}
			else{
				$actappid = $activityapplication->add($data);
				$data['actapplicationid'] = $actappid;
				$uploadfile = Common::uploadFile($actappid.".actapp");
				if($uploadfile=="nofile"){
					$activityapplication->delete($data);
					$this->error("请上传文件！","baoming");
				}elseif($uploadfile=="success"){
					$data['acttype'] = $type;
					$data['attachmentpath'] = $_FILES['file']['name']."###".$actappid.".actapp";
					$activityapplication->save($data);
				}else{
					$activityapplication->delete($data);
					$this->error("未知错误！","baoming");
				}
			}
		}
		$condition = "";
		$condition['studentid'] = $_SESSION['uid'];
		$condition['acttype'] = $type;
		$myacts = $activityapplication->where($condition)->field("actapplicationid as id,actid,submittime,attachmentpath")->order('submittime')->select();
		$now = date("Y-m-d H:i:s");
		for($i=0;$i<count($myacts);$i++){
			$myacts[$i]['attachmentpath'] = Common::removesuffix($myacts[$i]['attachmentpath']);
			$temp = ($activitymodel->where("activityid =' ".$myacts[$i]['actid']."'")->field('activitysubject as title,applydeadline as applytime,endtime')->find());
			$myacts[$i]['url'] = "__URL__/jieshao";
			if($type%10==0){
				if(strtotime($now)<strtotime($temp['applytime'])){
					$myacts[$i]['modify'] = "allowmodify";
				}
				else{
					$myacts[$i]['modify'] = "over";
				}
			}else{
				if(strtotime($now)<strtotime($temp['endtime'])){
					$myacts[$i]['modify'] = "allowmodify";
				}
				else{
					$myacts[$i]['modify'] = "over";
				}
			}
			$myacts[$i]['title'] = $temp['title'];
		}
		if($type%10==0){
			$maincontent[0]['title'] = "我的报名情况";
		}else{
			$maincontent[0]['title'] = "我的作品";
		}
		if(!$myacts){
			$activitymodel = M("Activities");
			$condition = "";
			$condition['activitytype'] = 60;
			$temp = $activitymodel->field("activityid as id,activitysubject as title,starttime,endtime,applydeadline as applytime")->where($condition)->find();
				
			$myacts[0]['url'] = "__URL__/jieshao";
			$myacts[0]['title'] = $temp['title'];
			$myacts[0]['actid'] = $temp['id'];
			$now = date("Y-m-d H:i:s");
			if($type%10==0){
				if((strtotime($now)>strtotime($temp['applytime']))){
					$myacts[0]['content'] = "报名截止";
				}elseif(strtotime($now)<strtotime($temp['starttime'])){
					$myacts[0]['content'] = "还未开始";
				}
			}else{
				if((strtotime($now)<strtotime($temp['applytime']))){
					$myacts[0]['content'] = "还未报名";
				}elseif(strtotime($now)>strtotime($temp['endtime'])){
					$myacts[0]['content'] = "已经结束";
				}
			}
			$myacts[0]['content'] = "";
		}

		$this->assign("comacttype",$type);
		$this->assign("mode",$mode);
		$this->assign("maincontent",$maincontent);
		$this->assign("myacts",$myacts);
		$this->setSidebar();
		$this->display("Gjjl:baoming");
	}

	/**
	 * 新闻列表
	 */
	public function newslist(){
		$activitymodel = M("Activities");
		if(isset($_GET['id'])){
			$condition = "";
			$condition['activityid'] = $_GET['id'];
			$condition['activitytype'] = 62;
			$maincontent = $activitymodel->field("activityid as id,activitysubject as title,createtime,activitycontent as content,attachmentpath")->where($condition)->select();
			$maincontent[0]['filename'] = Common::removesuffix($maincontent[0]['attachmentpath']);
		}else{
			$pagetype = 2;
			$condition = "";
			$mode = "news";
			$condition['activitytype'] = 62;
			$newslist = $activitymodel->field("activityid as id,activitysubject as title,createtime")->where($condition)->order("createtime desc")->select();
			//var_dump($newslist);
			for($i=0;$i<count($newslist);$i++){
				$newslist[$i]['url'] = "__URL__/xinwen/id/".$newslist[$i]['id'];
			}
			$maincontent[0]['title'] = "新闻通知";
		}
		$this->assign("mode",$mode);
		$this->assign("maincontent",$maincontent);
		$this->assign("tablenewslist",$newslist);
		$this->setSidebar();
		$this->display ("Gjjl:page");
	}

	public function downfile(){
		try{
			$suffix = $_GET['_URL_'][2].".activity";
			$filename = $_GET['_URL_'][3];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
	public function downattachment(){
		try{
			$suffix = $_GET['_URL_'][2].".actapp";
			$filename = $_GET['_URL_'][3];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
	public function downAssign(){
		try{
			$suffix = $_GET['_URL_'][2].".assign";
			$filename = $_GET['_URL_'][3];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
	public function downAppraisal(){
		try{
			$suffix = $_GET['_URL_'][2].".appraisal";
			$filename = $_GET['_URL_'][3];
			$success = Common::downloadFile($filename, $suffix);
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
}
?>
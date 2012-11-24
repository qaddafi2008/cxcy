<?php
import("webApp.Action.Admin.Common");
class GjjlAction extends Action {
	public function index() {
		$this->setSidebar();
		$activitymodel = M("Activities");
		$condition = "";
		$condition['activitytype'] = 90;
		$maincontent[0]['name'] = "国际交流活动：";
		$maincontent[0]['type'] = "huodong";
		$maincontent[0]['newslist'] = $activitymodel->field("activityid as id,activitysubject as title,createtime as time")->where($condition)->order("createtime desc")->limit(10)->select();
		$condition['activitytype'] = 91;
		$maincontent[1]['name'] = "新闻通知：";
		$maincontent[1]['type'] = "xinwen";
		$maincontent[1]['newslist'] = $activitymodel->field("activityid as id,activitysubject as title,createtime as time")->where($condition)->order("createtime desc")->limit(10)->select();

		$columncount = count($maincontent);
		if($columncount == 2){
			$wordcountmax = 25;
		}elseif($columncount == 3){
			$wordcountmax = 15;
		}

		for($i=0;$i<count($maincontent);$i++){
			for($j=0;$j<count($maincontent[$i]['newslist']);$j++){
				if($wordcountmax){
					$wordcounts = strlen($maincontent[$i]['newslist'][$j]['title']);
					if($wordcounts > $wordcountmax*3){
						$maincontent[$i]['newslist'][$j]['title'] = iconv_substr($maincontent[$i]['newslist'][$j]['title'],0,$wordcountmax*3,'utf-8')."...";
					}
				}

				if(strtotime($maincontent[$i]['newslist'][$j]['time'])==0){
					$maincontent[$i]['newslist'][$j]['time']="";
				}else{
					$maincontent[$i]['newslist'][$j]['time'] = date("Y-m-d",strtotime($maincontent[$i]['newslist'][$j]['time']));
				}
			}
		}

		$imgsrc = "__PUBLIC__/images/home/gjjl.png";
		$this->assign("columncount",count($maincontent));
		$this->assign("maincontent",$maincontent);
		$this->assign("imgsrc",$imgsrc);
		$this->display ("Gjjl:mainpage");
		//$this->redirect("huodong");
	}

	public function setSidebar(){
		$modelname = "国际交流活动";
		$navlist = "";
		$navlist[0] = array('url'=>'__URL__/index','title'=>'首页');
		$navlist[1] = array('url'=>'__URL__/huodong','title'=>'活动列表');
		$navlist[2] = array('url'=>'__URL__/xinwen','title'=>'新闻通知');
		if($_SESSION['urole'] == 2)
			$navlist[3] = array('url'=>'__URL__/baoming','title'=>'报名情况');

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
			$condition['activitytype'] = 90;
			$maincontent = $activitymodel->field("activityid as id,activitysubject as title,createtime,starttime,endtime,applydeadline,activitycontent as content,attachmentpath")->where($condition)->select();
			$maincontent[0]['filename'] = Common::removesuffix($maincontent[0]['attachmentpath']);
			$maincontent[0]['createtime'] = date("Y-m-d",strtotime($maincontent[0]['createtime']));
			$maincontent[0]['starttime'] = date("Y-m-d",strtotime($maincontent[0]['starttime']));
			$maincontent[0]['endtime'] = date("Y-m-d",strtotime($maincontent[0]['endtime']));
			$maincontent[0]['applydeadline'] = date("Y-m-d",strtotime($maincontent[0]['applydeadline']));
		}
		else{
			$maincontent[0]['title'] = "国际交流活动";
			$condition = "";
			$mode = "activity";
			$condition['activitytype'] = 90;
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

				$newslist[$i]['createtime'] = date("Y-m-d",strtotime($newslist[$i]['createtime']));
				$newslist[$i]['starttime'] = date("Y-m-d",strtotime($newslist[$i]['starttime']));
				$newslist[$i]['endtime'] = date("Y-m-d",strtotime($newslist[$i]['endtime']));
				$newslist[$i]['applydeadline'] = date("Y-m-d",strtotime($newslist[$i]['applydeadline']));
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
	public function baoming(){
		AuthorityAction::checkStudentLogin();
		$activitymodel = M("Activities");
		$activityapplication = M("activityapplication");
		if(isset($_POST["actid"])){
			$data['actid'] = $_POST["actid"];
			$data['studentid'] = $_SESSION['uid'];
			$data['studentname'] = $_SESSION['uname'];
			$data['acttype'] = 90;
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
		$condition['acttype'] = 90;
		$myacts = $activityapplication->where($condition)->field("actapplicationid as id,actid,submittime,attachmentpath")->order('submittime')->select();
		$now = date("Y-m-d H:i:s");
		for($i=0;$i<count($myacts);$i++){
			$myacts[$i]['attachmentpath'] = Common::removesuffix($myacts[$i]['attachmentpath']);
			$temp = ($activitymodel->where("activityid =' ".$myacts[$i]['actid']."'")->field('activitysubject as title,applydeadline as time')->find());
			$myacts[$i]['url'] = "__URL__/huodong/id/".$myacts[$i]['actid'];
			if(strtotime($now)<strtotime($temp['time'])){
				$myacts[$i]['modify'] = "";
			}
			else{
				$myacts[$i]['modify'] = "已结束";
			}
			$myacts[$i]['title'] = $temp['title'];
		}
		$maincontent[0]['title'] = "我的报名情况";
		$studentid = $_SESSION['uid'];
		$this->assign("mode",$mode);
		$this->assign("maincontent",$maincontent);
		$this->assign("myacts",$myacts);
		$this->setSidebar();
		$this->display("Gjjl:baoming");
	}

	/**
	 * 新闻列表
	 */
	public function xinwen(){
		$activitymodel = M("Activities");
		if(isset($_GET['id'])){
			$condition = "";
			$condition['activityid'] = $_GET['id'];
			$condition['activitytype'] = 91;
			$maincontent = $activitymodel->field("activityid as id,activitysubject as title,createtime,activitycontent as content,attachmentpath")->where($condition)->select();
			$maincontent[0]['filename'] = Common::removesuffix($maincontent[0]['attachmentpath']);
			$maincontent[0]['createtime'] = date("Y-m-d",strtotime($maincontent[0]['createtime']));

		}else{
			$pagetype = 2;
			$condition = "";
			$mode = "news";
			$condition['activitytype'] = 91;
			$newslist = $activitymodel->field("activityid as id,activitysubject as title,createtime")->where($condition)->order("createtime desc")->select();
			//var_dump($newslist);
			for($i=0;$i<count($newslist);$i++){
				$newslist[$i]['url'] = "__URL__/xinwen/id/".$newslist[$i]['id'];
				if(strtotime($newslist[$i]['createtime'])==0){
					$newslist[$i]['createtime'] = "";
				}else {
					$newslist[$i]['createtime'] = date("Y-m-d",strtotime($newslist[$i]['createtime']));
				}
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
}
?>
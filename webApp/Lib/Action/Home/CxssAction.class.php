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
 * 63：学生创新创业系统赛事的作品
 * 90：国际交流活动的报名表
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

	public function setSidebar(){
		//左侧导航栏
		$modelname = "创新创业系列赛事："; //本模块名称
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/xinwen', "title"=>'赛事新闻');
		$navlist [$navindex++] = array ("url" => '__URL__/jinzhan', "title" => '当前进展' );
		$navlist [$navindex++] = array ("url" => '__URL__/jieshao', "title" => '赛事介绍' );
		$navlist [$navindex++] = array ("url" => '__URL__/baoming', "title" => '报名参加' );
		$navlist [$navindex++] = array ("url" => '__URL__/zuoping', "title" => '提交作品' );

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
		
		$studentid = $_SESSION['uid'];
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
}
?>
<?php
class CxssAction2 extends Action {
	protected function _empty()
	{
		$this->index();
	}
	public function index() {//首页
		$this->showpage(1,0);
	}
	public function jinzhan(){//进展
		$this->showpage(1,0);
	}
	public function jieshao(){//介绍
		$this->showpage(1, 1);
	}
	public function baoming(){//报名页面
		$this->showpage(1,2);
	}
	public function zuoping(){//作品
		$this->showpage(1,3);
	}
	public function xinwen(){//新闻
		$this->showpage(1,4);
	}
	/**
	 * 显示创新创业的页面
	 * @param  $moduleid 模块id，1代表创新创业，2代表河合
	 * @param  $type 0表示首页和进展、1表示介绍、2表示报名、3表示作品、4表示新闻
	 */
	protected function showpage($moduleid,$type)
	{
		//左侧导航栏
		$modelname = "创新创业系列赛事："; //本模块名称
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/xinwen', "title"=>'赛事新闻');
		$navlist [$navindex++] = array ("url" => '__URL__/jinzhan', "title" => '当前进展' );
		$navlist [$navindex++] = array ("url" => '__URL__/jieshao', "title" => '赛事介绍' );
		$navlist [$navindex++] = array ("url" => '__URL__/baoming', "title" => '报名参加' );
		$navlist [$navindex++] = array ("url" => '__URL__/zuoping', "title" => '提交作品' );
		//从数据库转存信息
		$maincontent = null;

		//数据库
		$competitions = M ( 'competitions' );
		$comagenda = M ( 'comagenda' );

		if($type==1)
		{
			//查询competitions表
			$condition1 ['comid'] = $moduleid;
			$temp = $competitions->where ( $condition1 )->select ();

			foreach ( $temp as $one => $value ) {
				$maincontent [$num ++] = array (
						'title' => $value ['subject'],
						'releasetime' => $value['createtime'],
						'content' => $value ['description'],
						'fileurl'=>'__URL__'."/download/"."cxss/".Common::removesuffix($value['attachmentpath']),
						'attachment'=>Common::removesuffix($value['attachmentpath'])
				);
			}
		}
		else if($type==0)
		{
			//查询comagenda表
			$condition2 ['compid'] = $moduleid;
			$temp = $comagenda->where ( $condition2 )->select ();
			foreach ( $temp as $one => $value ) {
				$maincontent [$num ++] = array (
						'title' => $value ['status'],
						'releasetime'=>$value['endtime'],
						'content' => $value ['description'],
						'fileurl'=>'__URL__'."/download/"."cxssproc/".Common::removesuffix($value['attachmentpath']),
						'attachment'=>Common::removesuffix($value['attachmentpath'])
				);
			}
		}
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign ( 'maincontent', $maincontent );
		$this->display("index");
	}
	public function download()
	{
		$file_name = $_GET['_URL_'][3];
		$suffix = $_GET['_URL_'][2];
		Common::downloadFile($file_name, $suffix);
	}
}
?>
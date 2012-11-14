<?php
import('webApp.Action.Admin.Common');
class CompetitionAction extends Action{

	/**
	 * 对Activities表中的字段activitytype的说明：
	 * 60：表示学生创新创业系列赛事
	 * 61：表示学生创新创业系列赛事的阶段
	 * 62：表示学生创新创业系列赛事的新闻通知
	 * 90：表示国际交流活动
	 * 91：表示国际交流活动下的新闻列表
	 */
	public function index(){
		$this->activity();
	}

	public function comdetail(){
		$activitymodel = M("Activities");
		$condition = "";
		$condition['activitytype'] = 60;
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
		$condition['activitytype'] = 61;
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
			$acttype = 60;
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
				if($_POST['acttype'] == "60"){
					$this->success("添加成功！","comdetail");
					//$this->comdetail();
				}elseif($_POST['acttype']=="61"){
					$this->success("添加成功！","agenda");
					//$this->agendadetail();
				}
				elseif($_POST['acttype']=="62"){
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
			if($_POST['acttype'] == "60"){
					$this->success("更新成功！","comdetail");
					//$this->comdetail();
				}elseif($_POST['acttype']=="61"){
					$this->success("更新成功！","agenda");
					//$this->agendadetail();
				}
				elseif($_POST['acttype']=="62"){
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
		$condition['activitytype'] = 62;
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
			$acttype = 62;
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
			$acttype = 61;
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
	public function apply(){
		AuthorityAction::checkAdminLogin();
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


<?php
class CompetitionAction2 extends Action {

	public function detail() {
		//var_dump($_GET);
		$module = $_GET ['_URL_'] [3];//主模块，是创新赛事，或者合河赛事
		$submodule = $_GET ['_URL_'] [4];//子模块，代表阶段设置
		if(!$submodule||$submodule==null||$submodule==""){//设置主模块，故子模块为空
			if ($module == "cxss") {
				$condition = array ('comtype' => 1 );
			}
			else if($module == "hhss"){
				$condition = array ('comtype' => 2 );
			}
			if($condition){
				$competitions = M ( 'competitions' );
				$temp = $competitions->where ( $condition )->find ();
				$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
				$this->assign ( "competition", $temp);
			}
			$this->display ();
		}
		else if($submodule=="proc"){
			if ($module == "cxss") {
				$condition = array ('agendaid' => 1 );
			}
			else if($module == "hhss"){
				$condition = array ('agendaid' => 2 );
			}
			if($condition){
				$comagendas = M ( 'comagenda' );
				$temp = $comagendas->where ( $condition )->find ();
				$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
				$this->assign ( "comagenda", $temp);
			}
			$this->display ("detailproc");
		}
	}
	//主赛事设置的提交，不区分创新创业赛事或者河合；由post过来的comid设置
	public function submit() {
		$module = ($_POST ["comtype"]=='1'?"cxss":"hhss");//所提交更新的模块
		$competition = array ('comid' => $_POST ["comid"], 'subject' => $_POST ["subject"], 'createtime' => $_POST ['createtime'], 'description' => $_POST ['description'] );
		if (! isset ( $_POST ['alreadyfile'] )||$_POST ['alreadyfile']==""||$_POST ['alreadyfile']==null) {
			Common::removefile($module);
			$competition ['attachmentpath'] = "";
		}
		$filestatus = Common::upload($module);
		if($filestatus == SUCCESS){
			$competition ['attachmentpath'] = $_FILES ["file"] ["name"]."###".$module;
		}
		$competitions = M ( 'competitions' );
		$result = $competitions->save ( $competition );
		/*
		 if ($result) {
		// 成功后返回客户端新增的用户ID，并返回提示信息和操作状态
		$this->ajaxReturn ( $result, "(更新成功！)", 1 );
		} else {
		// 错误后返回错误的操作状态和提示信息
		$this->ajaxReturn ( 0, "(未更新！)", 0 );
		}
		*/
		$operation = $_POST['operation'];
		if($operation==null)
		$url = "detail/".$module;//更新后的跳转地址
		else 
			$url = "__GROUP__/Competition/newslist/".$module;
		echo $url;
		if ($result) {
			$this->success('更新成功', $url);
		}else{
			if($filestatus=="nofile")
				$msg = "未设置附件或附件不合法！";
			else if($filestatus==ERROR)
				$msg = "附件上传错误!";
			else if($filestatus=="Invalidsize")
				$msg = "附件过大！";
			$this->error($msg);
		}
	}

	//赛事阶段的设置，不区别创新创业赛事或河合
	public function submitproc() {
		$module = ($_POST ["compid"]=='1'?"cxss":"hhss");
		$comagenda = array ('agendaid' => $_POST ["agendaid"], 'compid' => $_POST ["compid"],'status'=>$_POST ['status'], 'endtime' => $_POST ['endtime'], 'description' => $_POST ['description'] );
		if (! isset ( $_POST ['alreadyfile'] )||$_POST ['alreadyfile']==""||$_POST ['alreadyfile']==null) {
			Common::removefile($module."proc");
			$comagenda ['attachmentpath'] = "";
		}
		$filestatus = Common::upload($module."proc");
		if ($filestatus == SUCCESS) {
			$comagenda ['attachmentpath'] = $_FILES ["file"] ["name"]."###".$module."proc";
		}
		$comagendas = M ( 'comagenda' );
		$result = $comagendas->save ( $comagenda );
		$url = "detail/".$module."/proc";
		if ($result) {
			$this->success('更新成功', $url);
		}else{
			if($filestatus=="nofile")
				$msg = "未设置附件或附件不合法！";
			else if($filestatus==ERROR)
				$msg = "附件上传错误!";
			else if($filestatus=="Invalidsize")
				$msg = "附件过大！";
			$this->error($msg);
		}
	}


	public function newslist()
	{
		$module = $_GET ['_URL_'] [3];
		$newslist = null;
		if($module=="cxss")
		{
			$condition['comtype'] = 1;

		}else if($module=="hhss"){
			$condition['comtype'] = 2;
		}
		if($condition){
			$competitions = M ( 'competitions' );
			$temp = $competitions->where ( $condition )->select ();
			//var_dump($temp);
			$num = 0;
			foreach($temp as $news=>$value){
				$newslist[$num++] = array(
						'id'=>$value['comid'],
						'title'=>$value['subject'],
						'releasetime'=>$value['createtime']
				);
			}
			var_dump($newslist);
			$this->assign("module",$condition['comtype']);
			$this->assign ( "newslist", $newslist);
		}
		$this->display ();
	}

	public function news()
	{
		$operation = $_GET ['_URL_'] [3];
		if($operation=="add")
		{
			$condition['comtype'] = $_GET['_URL_'][4];
			echo $condition['comtype'];
			$this->assign('competition',$condition);
		}
		else if($operation!=null){
			$condition['comid'] = $_GET['_URL_'][4];
			if($condition!=null){
				$competitions = M ( 'competitions' );
				if($operation=="viewdetail"){
					$temp = $competitions->where ( $condition )->find ();
					$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
					$this->assign ( "competition", $temp);
				}else if($operation=="modify"){
					$temp = $competitions->where ( $condition )->find ();
					$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
					$this->assign ( "competition", $temp);
				}else if($operation=="delete"){
						
				}
			}
		}
		$this->assign('operation',$operation);
		$this->display();
	}

}?>
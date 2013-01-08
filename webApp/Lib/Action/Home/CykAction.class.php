<?php
import('webApp.Action.Admin.Common');
class CykAction extends Action{

	public function index() {
		R('Home/Authority/checkLogin');//表示调用Admin分组下Authority模块的checkLogin方法
		$urole = session(C('USER_ROLE'));
		if(2 == $urole)//学生
		{
			$this->getOriginalityList(1);
		}else if (1 == $urole)//老师
		{
			$this->getReviewRule();
		}else
			$this->error('请用学生或老师的账号登录');
	}
	
	//获得学生角色的左侧导航菜单
	private function getStuNavlist(){
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/getOriginalityList', "title"=>'创意列表');
		$navlist [$navindex++] = array ("url" => '__URL__/studentOriginality', "title" => '我的创意' );
		$navlist [$navindex++] = array ("url" => '__URL__/studentCollection', "title" => '我的收藏' );
		$navlist [$navindex++] = array ("url" => '__URL__/resultPublicity', "title" => '结果公示' );
		return $navlist;
	}
	
	//获得老师角色的左侧导航菜单
	private function getTeacherNavlist(){
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/getReviewRule', "title"=>'评审规则');
		$navlist [$navindex++] = array ("url" => '__URL__/getMyAssignedOList', "title" => '创意列表' );
		$navlist [$navindex++] = array ("url" => '__URL__/resultPublicity', "title" => '结果公示' );
		return $navlist;
	}
	
	//学生的创意列表,$actionModule为1或空 表示”创意列表“，为2表示”我的收藏“，为3表示”结果公示“
	public function getOriginalityList($actionModule){
		R('Home/Authority/checkStudentAndTeacherLogin');//表示调用Home分组下Authority模块的checkStudentAndTeacherLogin方法
		
		$urole = session(C('USER_ROLE'));
		//左侧导航栏
		$modelname = "创意库："; //本模块名称
		if(1 == $urole)//4表示“老师的创意列表”
			$navlist = $this->getTeacherNavlist();//获得左侧导航菜单
		else
			$navlist = $this->getStuNavlist();//获得左侧导航菜单
		
		
		if(1 == $actionModule || ''==$actionModule){//1表示”创意列表“
			$originality = M('originality');
			$list = $originality->where('isopen=1')->field('oid,subject,author,submittime,collectiontimes')->order('collectiontimes desc')->select();//指定字段查询
		}else if(2 == $actionModule){//2表示”我的收藏“
			$stuid = session(C('USER_AUTH_KEY'));
			$queryStr = "SELECT oid,subject,author,submittime,collectiontimes from originality WHERE oid IN (SELECT originalityid from collection WHERE stuid =$stuid)";
			$model = new Model();
			$list = $model->query($queryStr);
		}else if(3 == $actionModule){//3表示“结果公示”
			$originality = M('originality');
			$list = $originality->where('ispublic=1')->field('oid,subject,author,submittime,finalmark')->order('finalmark desc')->select();//指定字段查询
		}else if(4 == $actionModule){//4表示“老师的创意列表”
			$tid = session(C('USER_AUTH_KEY'));
			$model = new Model();
			$queryStr = "SELECT oid,subject,author,submittime,collectiontimes FROM originalityreview, originality WHERE teacherid=$tid AND oid=originalityid ORDER BY collectiontimes DESC";
			$list = $model->query($queryStr);
		}
		
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		//$this->assign ( 'maincontent', $maincontent );
		
		//$this->assign ( 'originalityMode', 'student');
		$this->assign ( 'originalityList', $list);
		if(3 == $actionModule)//结果公布，需要显示成绩
			$this->assign ( 'functionBlock', 'resultPublicityList');//设置主模块显示的功能页面
		else
			$this->assign ( 'functionBlock', 'originalityList');//设置主模块显示的功能页面
		
		$this->display("index");
	}
	
	//学生创意之“我的创意”
	public function studentOriginality(){
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		$userId = session(C('USER_AUTH_KEY'));
		//左侧导航栏
		$modelname = "创意库："; //本模块名称
		$navlist = $this->getStuNavlist();//获得左侧导航菜单
		
		$originality = M('originality');
		$result = $originality->where("stuid=$userId")->find();
		
		//获取创意库模板
		$pathOfOdeclaredTable = M('pathofodeclaredtable');
		$odtResult = $pathOfOdeclaredTable->find();
		if($odtResult){//已经有模板就进行赋值
			$result['odtTemplate'] = $odtResult['path'];
		}
		
		//echo $result;return;
		if($result){
			$this->assign('myOriginality',$result);
		}else{
			
		}
		
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign ( 'functionBlock', 'studentOriginalityPage');//设置主模块显示的功能页面
		
		$this->display("index");
	}
	
	//更新创意
	public function updateOriginality(){
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		
		$stuid = session(C('USER_AUTH_KEY'));
		$oid = $_POST['stuOriginalityID'];
		$data['subject'] = $_POST['subject'];
		$data['author'] = $_POST['authors'];
		$data['background'] = $_POST['obackground'];
		$data['abstract'] = $_POST['abstract'];
		$data['functiondescription'] = $_POST['functiondescription'];
		//$data['filepath'] = $_FILES ["file"] ["name"];
		$data['isopen'] = $_POST['isopen'];
		
		$originality = M('originality');
		
		if(null == $oid){//创建新的创意
			$data['filepath'] = $_FILES ["file"] ["name"];
			$result = Common::uploadFile('OriginalityHome.student.'.$stuid);//上传文件
			if('success' == $result){
				$data['stuid'] = $stuid;
				$addRes = $originality->add($data);
				if($addRes){
					$data['oid'] = $addRes;
					$this->assign('myOriginality',$data);
					//$this->assign('functionBlock', 'studentOriginalityPage');//设置主模块显示的功能页面
					
					$this->success("提交成功！");
				}else{
					$this->error("提交失败！");
				}
			}else if("Invalidsize" == $result){
				$this->error("文件大小超过范围，上传失败！");
			}else if("nofile" == $result){
				$this->error("文件不存在！");
			}else{
				$this->error("上传失败！");
			}
			
			
		}else{//更新原有的创意
			$fileStatus = $_POST['fileStatus'];
			if(2 == $fileStatus){//修改原有上传的文件
				if(!Common::removeOneFile($_POST['oldFile'],'OriginalityHome.student.'.$stuid))//删除指定文件
					$this->error('删除服务器中的文件失败！');
				$data['filepath'] = $_FILES ["file"] ["name"];
					
				//上传新的文件
				$uploadNewFileResult = Common::uploadFile('OriginalityHome.student.'.$stuid);//上传文件
				if("Invalidsize" == $uploadNewFileResult){
					$this->error("文件大小超过范围，上传失败！");
				}else if("nofile" == $uploadNewFileResult){
					$this->error("文件不存在！");
				}else if('error' == $uploadNewFileResult){
					$this->error("上传失败！");
				}//成功的情况则继续执行以下的内容
			}
			
			//更新数据库			
			if($originality->where("oid=$oid")->save($data)){
				$data['oid'] = $oid;
				if(1 == $fileStatus)//不更新上传文件
					$data['filepath'] = $_POST['oldFile'];
				$this->assign('myOriginality',$data);
				//$this->assign('functionBlock', 'studentOriginalityPage');//设置主模块显示的功能页面
					
				$this->success('更新成功！');
				//$this->display('page');
			}else{
				$this->error("更新失败！");
			}
		}
	}
	
	//下载学生创意文件
	public function downloadStuDeclaredTable(){
		R('Home/Authority/checkLogin');//表示调用Home分组下Authority模块的checkLogin方法
		
		$file_name = $_GET['tname'];
		$stuid = $_GET['tid'];
		$success = Common::downloadFile($file_name,'OriginalityHome.student.'.$stuid);
		if($success == "nofile")
				$this->error("找不到文件...");
	}
	
	//得到学生创意详细信息
	public function getOriginalityDetail($ispublic){
		R('Home/Authority/checkStudentAndTeacherLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		$urole = session(C('USER_ROLE'));
		$oid = $_GET['oid'];
		
		$originality = M('originality');
		$result = $originality->where("oid=$oid")->find();
		
		if(0 == $result['isopen'] && 1 != $result['ispublic'])//防止利用url漏洞访问未公开的创意
			if(2 == $urole)
				$this->error('非法访问未公开的创意！');
		
		//获得作者姓名
		$stu = M('student');
		$sname = $stu->where("sid=".$result['stuid'])->field('sname')->find();
		$result['sname'] = $sname['sname'];
		
		$result['urole'] = $urole;//当前用户身份
		
		
		//读取评论信息
		$ocomment = M('originalitycomment');
		$rescomment = $ocomment->where("originalityid=$oid")->select();
		
		
		if(2 == $urole){//学生
			//查找是否有被当前用户收藏
			$condition['stuid'] = session(C('USER_AUTH_KEY'));
			$condition['originalityid'] = $oid;
			$collection = M('collection');
			if($collection->where($condition)->find())//找到记录，说明已被收藏
				$result['isCollected'] = 1;
			else//未被收藏
				$result['isCollected'] = 0;
		}else{//老师
			$tid = session(C('USER_AUTH_KEY'));
			$oreview = M('originalityreview');
			$treview = $oreview->where("teacherid=$tid and originalityid=$oid")->find();
		}
		
		
		
		//左侧导航栏
		$modelname = "创意库："; //本模块名称
		if(2 == $urole)//学生
			$navlist = $this->getStuNavlist();//获得左侧导航菜单
		else
			$navlist = $this->getTeacherNavlist();//获得左侧导航菜单
			
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign('myOriginality',$result);
		$this->assign('ocomments',$rescomment);
		$this->assign('treview',$treview);
		if(1 == $ispublic)//本创意已经显示在”结果公示“中，可显示成绩
			$this->assign('functionBlock', 'studentOriginalityDetailPublic');//设置主模块显示的功能页面
		else if(1 == $urole)//老师
			$this->assign('functionBlock', 'studentOriginalityDetailReview');
		else//创意还未公示
			$this->assign('functionBlock', 'studentOriginalityDetail');//设置主模块显示的功能页面
		$this->display('page');
	}
	
	//下载创意申请表模板
	public function downloadODeclaredTableTmpl(){
		$file_name = $_GET['tname'];
		$success = Common::downloadFile($file_name,'OriginalityAdmin');
		if($success == "nofile")
				$this->error("找不到文件...");
	}
	
	//为创意添加评论
	public function addComment(){
		$oid = $_POST['originalityid'];
		$data['content'] = $_POST['comment'];
		$data['commentername'] = $_POST['commenter'];
		$data['originalityid'] = $oid;
		$ocomment = M('originalitycomment');
		
		$res = $ocomment->add($data);
		if($res){
			$this->success("评论成功");
		}else{
			$this->error("添加评论失败！");
		}
	}
	
	//收藏指定的创意
	public function doCollect(){
		$oid = $_GET['oid'];
		$stuid = session(C('USER_AUTH_KEY'));
		
		$data['originalityid'] = $oid;
		$data['stuid'] = $stuid;
		$collection = M('collection');
		if($collection->add($data)){
			//更新创意中的收藏次数
			$originality = M('originality');
			$ores = $originality->where("oid=$oid")->field('collectiontimes')->find();
			$ores['collectiontimes'] = $ores['collectiontimes'] + 1;
			$originality->where("oid=$oid")->save($ores);
			
			$this->ajaxReturn(1,"收藏成功！",1);
		}else
			$this->ajaxReturn(0,"收藏失败！",0);
	}
	
	//我的收藏-学生
	public function studentCollection(){
		$this->getOriginalityList(2);
	}
	
	//结果公示
	public function resultPublicity(){
		$this->getOriginalityList(3);
	}
	
	//获取某个已公布创意的详细信息
	public function getPublicOriginalityDetail(){
		$this->getOriginalityDetail(1);//1表示已经公示
	}
	
	//获取评审规则
	public function getReviewRule(){
		R('Home/Authority/checkTeacherLogin');//表示调用Home分组下Authority模块的checkStudentLogin方法
		//左侧导航栏
		$modelname = "创意库："; //本模块名称
		$navlist = $this->getTeacherNavlist();//获得左侧导航菜单
		
		$reviewRule = M('reviewrule');
		$result = $reviewRule->find(1);
		
		$this->assign('r',$result);
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign ( 'functionBlock', 'reviewRule');//设置主模块显示的功能页面
		
		$this->display("index");
	}
	
	//老师的创意列表
	public function getMyAssignedOList(){
		$this->getOriginalityList(4);//4表示老师的创意列表
	}
	
	public function updateOMark(){
		$oid = $_POST['originalityid'];
		$data['comment'] = $_POST['ocomment'];
		$data['mark'] = $_POST['omark'];
		$tid = session(C('USER_AUTH_KEY'));
		
		$oreview = M('originalityreview');
		if($oreview->where("teacherid=$tid and originalityid=$oid")->save($data))
			$this->success("提交成功！");
		else
			$this->error("提交失败！");
		
	}
	
	public function test(){
	}
}
?>
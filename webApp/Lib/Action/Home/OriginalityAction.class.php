<?php
import('webApp.Action.Admin.Common');
class OriginalityAction extends Action{

	public function index() {
		R('Home/Authority/checkLogin');//表示调用Admin分组下Authority模块的checkLogin方法
		$urole = session(C('USER_ROLE'));
		if(2 == $urole)//学生
		{
			$this->getOriginalityList();
		}else if (1 == $urole)
		{
			$this->test();
		}else
			$this->error('请用学生或老师的账号登录');
	}
	
	//学生的创意列表
	public function getOriginalityList(){
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		//左侧导航栏
		$modelname = "创意库："; //本模块名称
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/getOriginalityList', "title"=>'创意列表');
		$navlist [$navindex++] = array ("url" => '__URL__/studentOriginality', "title" => '我的创意' );
		$navlist [$navindex++] = array ("url" => '__URL__/studentCollection', "title" => '我的收藏' );
		//从数据库转存信息
		//$maincontent = null;
		
		$originality = M('originality');
		$list = $originality->where('isopen=1')->field('oid,subject,author,submittime,collectiontimes')->order('collectiontimes desc')->select();//指定字段查询
		
		//if($list){
		//}else{
			//$originalityList = null;
		//}
		
		//$originalityList[0] = array("title" => '智能商务', "author"=> '小明', "submitTime"=> '2012-10-09 12:30:30');
		//$originalityList[1] = array("title" => '情景智能', "author"=> '小红', "submitTime"=> '2012-10-19 12:30:31');
		//$originalityList[2] = array("title" => '持续智能', "author"=> '小张', "submitTime"=> '2012-11-29 12:30:32');
		
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		//$this->assign ( 'maincontent', $maincontent );
		
		//$this->assign ( 'originalityMode', 'student');
		$this->assign ( 'originalityList', $list);
		$this->assign ( 'functionBlock', 'originalityList');
		
		$this->display("index");
	}
	
	//学生创意之“我的创意”
	public function studentOriginality(){
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		$userId = session(C('USER_AUTH_KEY'));
		//左侧导航栏
		$modelname = "创意库："; //本模块名称
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/getOriginalityList', "title"=>'创意列表');
		$navlist [$navindex++] = array ("url" => '__URL__/studentOriginality', "title" => '我的创意' );
		$navlist [$navindex++] = array ("url" => '__URL__/studentCollection', "title" => '我的收藏' );
		
		$originality = M('originality');
		$result = $originality->where("stuid=$userId")->find();
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
	
	//下载文件
	public function downloadStuDeclaredTable(){
		R('Home/Authority/checkLogin');//表示调用Admin分组下Authority模块的checkLogin方法
		
		$file_name = $_GET['tname'];
		$stuid = $_GET['tid'];
		$success = Common::downloadFile($file_name,'OriginalityHome.student.'.$stuid);
		if($success == "nofile")
				$this->error("找不到文件...");
	}
	
	//得到学生创意详细信息
	public function getOriginalityDetail(){
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		$oid = $_GET['oid'];
		
		$originality = M('originality');
		$result = $originality->where("oid=$oid")->find();
		
		if(0 == $result['isopen'])//防止利用url漏洞访问未公开的创意
			$this->error('非法访问未公开的创意！');
		
		$stu = M('student');
		$sname = $stu->where("sid=".$result['stuid'])->field('sname')->find();
		$result['sname'] = $sname['sname'];
		
		//左侧导航栏
		$modelname = "创意库："; //本模块名称
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/getOriginalityList', "title"=>'创意列表');
		$navlist [$navindex++] = array ("url" => '__URL__/studentOriginality', "title" => '我的创意' );
		$navlist [$navindex++] = array ("url" => '__URL__/studentCollection', "title" => '我的收藏' );
		
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign('myOriginality',$result);
		$this->assign('functionBlock', 'studentOriginalityDetail');//设置主模块显示的功能页面
		$this->display('page');
	}
	
	public function test(){
	}
}
?>
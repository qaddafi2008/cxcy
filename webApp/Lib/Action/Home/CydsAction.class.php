<?php
import("@.Action.Admin.Common");
class CydsAction extends Action {
	private $selectmode = 1;//用于表示前端页面的选择模式，对于学生为1（选择导师模式）和非1；对于教师1（选择学生）,2(自己的学生),3（编辑个人教师信息）
	public function index() {
		AuthorityAction::checkLogin();
		if($_SESSION['urole'] == 2)
		{
			$this->cydsForStudent();
		}else if ($_SESSION['urole'] == 1)
		{
			$this->cydsForTeacher();
		}
		else{
			$this->error("请以学生或老师身份登陆！");
		}
	}

	/**
	 * 处理导师登陆后所有关于创业导师模块的动作
	 */
	public function cydsForTeacher($selectmode){
		AuthorityAction::checkTeacherLogin();
		//左侧导航栏
		$modelname = "创业导师："; //本模块名称
		$navlist [0] = array ("url" => '__URL__/selectstudent',"title" => "审批学生");
		$navlist [1] = array ("url" => '__URL__/mystudents',"title" => "我的学生");
		$navlist [2] = array ("url" => '__URL__/myprofile',"title" => "我的资料");

		$tsmodel = M('teacherselection');
		$stuff = M('stuff');
		$studentmodel = M('student');
		if($selectmode == 2){
			$maincontent[0]['title'] = "我的学生";
			$condition = "";
			$condition['teacherid'] = $_SESSION['uid'];
			$condition['selectionstatus'] = 2;
			$studentlist = $tsmodel->where($condition)->order("Intention desc")->select();
			for($i=0;$i<count($studentlist);$i++)
			{
				$tempstudent = $studentmodel->field('stuno,sname')->where("sid =' ".$studentlist[$i]['studentid']."'")->find();
				$studentlist[$i]['name'] = $tempstudent['sname'];
				$studentlist[$i]['stuno'] = $tempstudent['stuno'];
				$studentlist[$i]['filename'] = Common::removesuffix($studentlist[$i]['projectoutline']);
			}
			$this->assign("studentlist",$studentlist);
		}elseif($selectmode == 3){
			$maincontent[0]['title'] = "我的资料";
			$condition = "";
			$condition['stuffid'] = $_SESSION['uid'];
			$teacher = $stuff->where($condition)->find();
			$this->assign("teacher",$teacher);
		}else{
			$maincontent[0]['title'] = "选择学生";
			$condition = "";
			$condition['teacherid'] = $_SESSION['uid'];
			$condition['selectionstatus'] = 1;
			$studentlist = $tsmodel->where($condition)->order("Intention desc")->select();
			for($i=0;$i<count($studentlist);$i++)
			{
				$tempstudent = $studentmodel->field('stuno,sname')->where("sid =' ".$studentlist[$i]['studentid']."'")->find();
				$studentlist[$i]['name'] = $tempstudent['sname'];
				$studentlist[$i]['stuno'] = $tempstudent['stuno'];
				$studentlist[$i]['filename'] = Common::removesuffix($studentlist[$i]['projectoutline']);
			}
			$this->assign("studentlist",$studentlist);
		}

		$this->assign('selectmode',$selectmode);
		$this->assign('maincontent',$maincontent);//标题
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->display ("index");
	}

	/**
	 * 教师：审批学生的申请
	 */
	public function selectstudent(){
		$this->cydsForTeacher(1);
	}

	/**
	 * 教师：查看自己的学生
	 */
	public function mystudents(){
		$this->cydsForTeacher(2);
	}

	/**
	 * 教师：查看更新自己的资料
	 */
	public function myprofile(){
		$this->cydsForTeacher(3);
	}

	/**
	 * 教师：提交修改的个人资料
	 */
	public function submitprofile()
	{
		$stuffid = $_POST['stuffid'];
		if($stuffid == $_SESSION['uid'])
		{
			$condition = "";
			$condition['stuffid'] = $stuffid;
			$stuff = M('stuff');
			$data = "";
			$data['teachername'] = $_POST['teachername'];
			if($data['teachername']){
				$data['teachertitle'] = $_POST['teachertitle'];
				$data['major'] = $_POST['major'];
				$data['area'] = $_POST['area'];
				$data['teacherdescription'] = $_POST['teacherdescription'];
				$result = $stuff->where($condition)->save($data);
			}
			if($result){
				$this->success("更新成功！","myprofile");
				//$this->ajaxReturn($result,"更新成功！",1);
			}else{
				$this->success("未更新！","myprofile");
			}
		}else{
			$this->error("更新错误！","myprofile");
			//$this->ajaxReturn(0,"更新错误！",0);
		}
	}
	
	/**
	 * 老师：提交其选定的学生
	 */
	public function sssubmit()
	{
		AuthorityAction::checkTeacherLogin();
		$teacherid = $_SESSION['uid'];
		$studentid = $_POST['studentid'];
		if(count($studentid)>0){
			$tsmodel = M('teacherselection');
			$studentmodel = M('student');
			$condition = "";
			$condition['selectionstatus'] = 1;
			for($i=0;$i<count($studentid);$i++){
				$condition['studentid'] = $studentid[$i];
				$tsrecords = $tsmodel->where($condition)->select();
				for($j=0;$j<count($tsrecords);$j++)
				{
					$tempcon = "";
					$tempcon['studentid'] = $tsrecords[$j]['studentid'];
					$tempcon['teacherid'] = $tsrecords[$j]['teacherid'];
					if($tempcon['teacherid'] == $teacherid){
						$tsrecords[$j]['selectionstatus'] = 2;
						$tsmodel->where($tempcon)->save($tsrecords[$j]);
					}else{
						$tsmodel->where($tempcon)->delete();
					}
				}
			}
			$this->success("提交成功","mystudents");
		}
		else{
			$this->error("请选择学生","selectstudent");
		}
	}

	/**
	 * 处理学生登陆后所有关于创业导师模块的动作
	 */
	public function cydsForStudent(){
		AuthorityAction::checkStudentLogin();
		//左侧导航栏
		$selectmode = 0;//对于学生预置为非选择模式
		$modelname = "创业导师："; //本模块名称
		$studentid = $_SESSION['uid'];

		$tsmodel = M('teacherselection');
		$stuff = M('stuff');
		$condition = null;
		$condition['studentid'] = $studentid;
		$tsresult = $tsmodel->where($condition)->select();

		$maincontent = "";
		$selectmode = "";
		$titlelist = "";
		$majorlist = "";
		$arealist = "";

		if($tsresult){//数据库已有提交的结果
			$navlist [0] = array ("url" => '__URL__/mytutor',"title" => '我的导师');
			$titlelist = $stuff->query("select distinct teachertitle from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");
			$majorlist = $stuff->query("select distinct major from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");
			$arealist = $stuff->query("select distinct area from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");

			$firsttsresult = $tsresult[0];
			if($firsttsresult['selectionstatus'] == '1')
			{
				$maincontent[0] = array('title'=>'我的导师','content'=>'正在审批中...');

				for($i=0;$i<count($tsresult);$i++)
				{
					$temp = $tsresult[$i];
					$teacherlist[$i] = $stuff->field('stuffid,teachername,teachertitle,major,area')->where("stuffid='".$temp['teacherid']."'")->find();
					$teacherlist[$i]['intention'] = $temp['Intention'];
				}
			}
			else if($firsttsresult['selectionstatus'] == '2')
			{
				$maincontent[0] = array('title'=>"我的导师",'content'=>'已成功选择');
				$teacherlist = null;
				$teacherlist[0] = $stuff->field('stuffid,teachername,teachertitle,major,area')->where("stuffid='".$firsttsresult['teacherid']."'")->find();
				$teacherlist[0]['intention'] = $firsttsresult['Intention'];
			}
			else if($firsttsresult['selectionstatus'] == '3')//此处暂不取用
			{
				$maincontent[0] = array('title'=>"我的导师",'content'=>'已由管理员分配');
				$teacherlist = null;
				$teacherlist[0] = $stuff->field('stuffid,teachername,teachertitle,major,area')->where("stuffid='".$firsttsresult['teacherid']."'")->find();
				$teacherlist[0]['intention'] = $firsttsresult['Intention'];
			}
		}
		else{
			$navlist [0] = array ("url" => '__URL__/selecttutor',"title" => '选择导师');
			$selectmode = 1;
			$condition = null;
			$condition['role'] = 1;
			$condition['teachername'] = array("neq","");
			$condition['teachertitle'] = array("neq","");
			$condition['major'] = array("neq","");
			$condition['area'] = array("neq","");
			$teacherlist = $stuff->where($condition)->select();
			//$titlelist = $Model->query("SELECT * FROM think_user WHERE id=%d and username='%s' and xx='%f'",array($id,$username,$xx));
			$titlelist = $stuff->query("select distinct teachertitle from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");
			$majorlist = $stuff->query("select distinct major from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");
			$arealist = $stuff->query("select distinct area from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");
		}

		$this->assign('maincontent',$maincontent);//我的导师标题
		$this->assign('selectmode',$selectmode);//1代表正在选择导师，其它值未定义
		$this->assign('cydsmode','student');//创业导师模式，1表示学生模式
		$this->assign('teacherlist',$teacherlist);//要显示的老师列表
		sort($titlelist);
		$this->assign('titlelist',$titlelist);//可选择的职称列表
		sort($majorlist);
		$this->assign('majorlist',$majorlist);//可选择的研究方向列表
		sort($arealist);
		$this->assign('arealist',$arealist);//可选择的研究领域列表
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->display ("index");
	}

	/**
	 * 我的导师页面
	 */
	public function mytutor(){
		$this->cydsForStudent();
	}

	/**
	 * 选择导师页面
	 */
	public function selecttutor(){
		$this->cydsForStudent();
	}

	/**
	 * 学生提交所选择的老师ID号及意向值
	 */
	public function submit()
	{
		$teacherids = $_POST['teacherid'];
		$scores = $_POST['intentionscore'];
		$totalscore = 0;
		$ok = true;

		//检测当前登陆类型为学生
		if($_SESSION['urole']!=2)
		{
			$ok = false;
		}

		//检测传输过来的意向值的正确与否
		if($ok){
			for($i=0;$i<count($scores);$i++){
				if(intval($scores[$i])<=0) {
					$ok = false;
					break;
				}
				$totalscore+=intval($scores[$i]);
			}
		}
		if($ok&&!(count($teacherids)==count($scores)&&$totalscore==100)){
			$ok = false;
		}

		//检测提交的导师ID是否合法
		$stuff = M('stuff');
		if($ok){
			for($i=0;$i<count($teacherids);$i++)
			{
				$condition['stuffid'] = $teacherids[$i];
				$teacher = $stuff->where($condition)->find();
				//导师不存在，或非导师
				if(!$teacher||$teacher['role']!="1"){
					$ok = false;
					break;
				}
			}
		}

		//有不合法数据
		if(!$ok)
		{
			$this->error("填写有误，请重新填写！","index");
		}else if($ok){
			$studentid = $_SESSION['uid'];
			$tsmodel = M('teacherselection');
			$suffix = $studentid.".cyds".".student";
			$uploadsuccess = Common::upload($suffix);
			if($uploadsuccess==SUCCESS||$uploadsuccess=="nofile"){
				for($i=0;$i<count($teacherids);$i++)
				{
					$data['studentid'] = $studentid;
					$data['teacherid'] = $teacherids[$i];
					$data['Intention'] = $scores[$i];
					$data['selectionstatus'] = 1;
					if($uploadsuccess==SUCCESS){
						$data['projectoutline']=$_FILES['file']['name']."###".$suffix;
					}
					$tsmodel->add($data);
				}
				$this->success("提交成功！","index");
			}else{
				$this->error("信息提交失败，请修改重试！","index");
			}
		}
	}

	/**
	 * 通过id号来获取教师的描述信息
	 */
	public function getDescriptionById()
	{
		$condition['stuffid'] = $_GET['_URL_'][2];
		$stuff = M('stuff');
		$teacher = $stuff->where($condition)->field('teachername,teachertitle,major,area,teacherdescription')->find();
		//print $teacher['teacherdescription'];
		$this->ajaxReturn($teacher,"Success",1);
	}

	/**
	 * 下载本模块文件
	 */
	public function downfile()
	{
		try{
			$sid = $_GET['_URL_'][2];
			$filename = $_GET['_URL_'][3];
			$success = Common::downloadFile($filename,$sid.".cyds.student");
			if($success == "nofile")
				$this->error("找不到文件...");
		}catch(Exception $e){
			$this->error("未知错误");
		}
	}
}
?>
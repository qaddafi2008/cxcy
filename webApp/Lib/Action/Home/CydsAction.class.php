<?php

class CydsAction extends Action {
	public function index() {
		AuthorityAction::checkLogin();
		if($_SESSION['urole'] == 2)
		{
			$this->cydsForStudent();
		}else if ($_SESSION['urole'] == 1)
		{
			$this->cydsForTeacher();
		}

	}

	/**
	 * 处理导师登陆后所有关于创业导师模块的动作
	 */
	public function cydsForTeacher(){
		AuthorityAction::checkTeacherLogin();
		//左侧导航栏
		$modelname = "创业导师："; //本模块名称
		$navlist [0] = array ("url" => '__URL__/selectstudent',"title" => "审批学生");
		$navlist [1] = array ("url" => '__URL__/mystudents',"title" => "我的学生");
		$navlist [2] = array ("url" => '__URL__/myprofile',"title" => "我的资料");
		
		
		$this->assign('maincontent',$maincontent);//标题
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->display ("index");
	}

	/**
	 * 教师：审批学生的申请
	 */
	public function selectstudent(){
		$this->cydsForTeacher();
	}
	
	/**
	 * 教师：查看自己的学生
	 */
	public function mystudents(){
		$this->cydsForTeacher();
	}
	
	/**
	 * 教师：查看更新自己的资料
	 */
	public function myprofile(){
		$this->cydsForTeacher();
	}
	
	/**
	 * 处理学生登陆后所有关于创业导师模块的动作
	 */
	public function cydsForStudent(){
		AuthorityAction::checkStudentLogin();
		//左侧导航栏
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
			else if($firsttsresult['selectionstatus'] == '0')
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
		$this->assign('cydsmode',1);//创业导师模式，1表示学生模式
		$this->assign('teacherlist',$teacherlist);//要显示的老师列表
		$this->assign('titlelist',$titlelist);//可选择的职称列表
		$this->assign('majorlist',$majorlist);//可选择的研究方向列表
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
			for($i=0;$i<count($teacherids);$i++)
			{
				$data['studentid'] = $studentid;
				$data['teacherid'] = $teacherids[$i];
				$data['Intention'] = $scores[$i];
				$data['selectionstatus'] = 1;
				$tsmodel->add($data);
			}
			$this->success("提交成功！","index");
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
}
?>
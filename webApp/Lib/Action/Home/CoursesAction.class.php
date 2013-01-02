<?php
class CoursesAction extends Action{
	public function index() {
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		$this->getGuideAndProcess(1);
	}
	//获得学生角色的左侧导航菜单
	private function getStuNavlist(){
		$navindex = 0;
		$navlist [$navindex++] = array ("url" => '__URL__/getGuideAndProcess/type/1', "title"=>'选课流程');
		$navlist [$navindex++] = array ("url" => '__URL__/getGuideAndProcess/type/0', "title" => '选课指导' );
		$navlist [$navindex++] = array ("url" => '__URL__/coursesSelection', "title" => '课程选择' );
		$navlist [$navindex++] = array ("url" => '__URL__/getCoursesMark', "title" => '课程成绩' );
		return $navlist;
	}
	
	//选课指导或选课流程
	public function getGuideAndProcess($type){
		//左侧导航栏
		$modelname = "选修课程："; //本模块名称
		$navlist = $this->getStuNavlist();//获得左侧导航菜单
		
		if(null == $type)
			$type = $_GET['type'];
		$guidancepro = M('guidanceprocess');
		if(0 == $type){//选课指导
			$result = $guidancepro->where("type=0")->find();
		}else{//1 选课流程
			$result = $guidancepro->where("type=1")->find();
		}
		$this->assign('gp',$result);
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign ( 'functionBlock', 'guideAndProcess');//设置主模块显示的功能页面
		
		$this->display("index");
	}
	
	//课程选择页面
	public function coursesSelection(){
		//左侧导航栏
		$modelname = "选修课程："; //本模块名称
		$navlist = $this->getStuNavlist();//获得左侧导航菜单
		
		$stuid = session(C('USER_AUTH_KEY'));
		$queryStr = "SELECT cid,coursename,teacher,headcount,`status` from curriculum,courses WHERE stuid=$stuid and cid=courseid order by cid";
		$model = new Model();
	    $list = $model->query($queryStr);
		if($list){//已选择了课程
			$this->assign('coursesList',$list);
			$this->assign ( 'functionBlock', 'coursesListSelected');//设置主模块显示的功能页面
		}else{//尚未选择课程
			$courses = M('courses');
			$result = $courses->where('ispublic=1')->field('cid,coursename,teacher,headcount')->select();
		
			$this->assign('coursesList',$result);
			$this->assign ( 'functionBlock', 'coursesListSelecting');//设置主模块显示的功能页面
		}
		
		
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
				
		$this->display("index");
	}
	
	//获取课程详细信息
	public function getCourseDetail(){
		//左侧导航栏
		$modelname = "选修课程："; //本模块名称
		$navlist = $this->getStuNavlist();//获得左侧导航菜单
		
		$cid = $_GET['cid'];
		$courses = M('courses');
		$result = $courses->where("cid = $cid")->find();
		$this->assign('c',$result);
		$this->assign ( 'functionBlock', 'courseDetail');//设置主模块显示的功能页面
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		
		$this->display("index");
	}
	
	//选择课程
	public function doSelectCourses(){
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		
		$cids = $_POST['cids'];
		$stuid = session(C('USER_AUTH_KEY'));

		$data['stuid'] = $stuid;
		$data['status'] = '预选';
		
		$curriculum = M('curriculum');
		for($i=0;$i<count($cids);$i++){
			$data['courseid'] = $cids[$i];
			if(!$curriculum->add($data))
				$this->error('提交课程失败！');
		}
		$this->success('提交成功！','coursesSelection');
	}
	
	//获得课程成绩
	public function getCoursesMark(){
		R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
		
		//左侧导航栏
		$modelname = "选修课程："; //本模块名称
		$navlist = $this->getStuNavlist();//获得左侧导航菜单
		
		$stuid = session(C('USER_AUTH_KEY'));
		$queryStr = "SELECT cid,coursename,teacher,place,mark from curriculum,courses WHERE status='通过' and stuid=$stuid and cid=courseid order by cid";
		$model = new Model();
	    $list = $model->query($queryStr);
		$this->assign('coursesList',$list);
		$this->assign ( 'functionBlock', 'coursesMark');//设置主模块显示的功能页面
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		
		$this->display("index");
	}
}
?>
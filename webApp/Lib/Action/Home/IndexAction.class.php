<?php

class IndexAction extends Action {
	public function index() {
		//header("Content-Type:text/html; charset=utf-8");
		//echo '<div style="font-weight:normal;color:blue;float:left;width:345px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;font-size:14px;font-family:Tahoma">^_^ Hello,北京欢迎您！<span style="font-weight:bold;color:red">创新创业平台</span></div>';
		$this->display ();
	}
	
	//登录
	public function login() {
		//echo .'-'.$_POST[''].'-'.$_POST['usertype'];
		

		if ('teacher' == $_POST ['usertype']) {
			$condition ['usrname'] = $_POST ['username'];
			$condition ['password'] = md5 ( $_POST ['password'] );
			$condition ['role'] = 1;
			
			$stuff = M ( 'stuff' );
			$checkTeacher = $stuff->where ( $condition )->find ();
			if (! $checkTeacher) {
				$this->error ( "用户或密码错误！" );
			} else {
				session ( C ( 'USER_AUTH_KEY' ), $checkTeacher ['stuffid'] ); //USER_AUTH_KEY 为用户id
				session ( C ( 'USER_NAME' ), $checkTeacher ['usrname'] ); //USER_NAME为用户姓名
				session ( C ( 'USER_ROLE' ), $checkTeacher ['role'] ); //USER_ROLE为用户角色，0为管理员，1为评审老师，2为学生
				session ( C ( 'IS_SURVEYED' ), 0); //是否已填写调查问卷，-1为否，1为是，0为不需要填写（如老师和管理员）

				$this->success ( '登陆成功','index' );
			}
		} else //type is student
{
			$condition ['stuno'] = $_POST ['username'];
			$condition ['spassword'] = md5 ( $_POST ['password'] );
			
			$student = M ( 'student' );
			$checkStudent = $student->where ( $condition )->find ();
			if (! $checkStudent) {
				$this->error ( "用户或密码错误！" );
			} else {
				session ( C ( 'USER_AUTH_KEY' ), $checkStudent ['sid'] ); //USER_AUTH_KEY 为用户id
				session ( C ( 'USER_NAME' ), $checkStudent ['sname'] ); //USER_NAME为用户姓名
				session ( C ( 'USER_ROLE' ), 2 ); //USER_ROLE为用户角色，0为管理员，1为评审老师，2为学生
				session ( C ( 'IS_SURVEYED' ), $checkStudent['issurveyed']==null?-1:$checkStudent['issurveyed']); //是否已填写调查问卷，-1为否，1为是，0为不需要填写（如老师和管理员）

				$this->success ( '登陆成功','index');
			}
		}
	}
	
	//退出
	public function logout() {
		session ( null ); //清空当前的session
		$this->display ( 'index' );
	}
	
	//标记用户已填写调查问卷
	public function surveyIsDone(){
		$uid = session ( C ( 'USER_AUTH_KEY' ));
		
		$student = M('student');
		$data['issurveyed'] = 1;
		$student->where("sid = $uid")->save($data);
		session ( C ( 'IS_SURVEYED' ),1);//重新设置是否填写调查问卷的session值为是，即1
		
		echo 'Modify successfully!';
	}
	
	public function insert() {
		$Demo = new Model ( 'student' );
		$Demo->Create ();
		$result = $Demo->add ();
		$this->redirect ( 'user' );
	}
	
	public function page() {
		$maincontent [0] = array ('title' => '测试标题', 'content' => '测试内容测试内容测试内容测试内容测试内容测试内容' );
		$this->assign ( 'maincontent', $maincontent );
		$this->display ( "page" );
	}
	
	//新闻列表测试
	public function index3() {
		
		$list [0] = array ("url" => '__URL__/index', "title" => 'testtesttesttesttest', "time" => '2011年9月10日' );
		$list [1] = array ("url" => '', "title" => 'testtesttesttesttest' );
		$list [2] = array ("url" => '', "title" => 'testtesttesttesttest' );
		$list [3] = array ("url" => '', "title" => 'testtesttesttesttest' );
		
		$this->assign ( 'newslist', $list );
		$this->display ( "page" );
	}
	
	//腾飞创业模块
	public function tengfei() {
		unset ( $_GET ['_URL_'] );
		//var_dump($_GET);
		//左侧导航栏
		$modelname = "腾飞创业："; //本模块名称
		$navlist [0] = array ("url" => '__URL__/tengfei/rhtf/view', "title" => '如何腾飞' );
		$navlist [1] = array ("url" => '__URL__/tengfei/tfzw/view', "title" => '腾飞展望' );
		$navlist [1] ['subnav'] = array (
				"0" => array (
						"url" => 'javascript:forwardto(\'推介交流\')', 
						"title" => '推介交流' 
				), 
				"1" => array (
						"url" => 'javascript:forwardto(\'服务概述\')',
						"title" => '服务概述'
				),
				"2" => array (
						"url" => 'javascript:forwardto(\'团队义务\')',
						"title" => '团队义务' 
				) );
		
		//获取参数
		$type = null;
		if (isset ( $_GET ['rhtf'] )) {
			$type = 1; //如何腾飞
		} elseif (isset ( $_GET ['tfzw'] )) {
			$type = 2; //腾飞展望
		} else
			$type = 3; //本模块首页介绍

		//从数据库转存信息
		$num = 0;
		$maincontent = null;
		
		//数据库
		$incubator = M ( 'incubator' );
		$incubatormodules = M ( 'incubatormodules' );
		
		//查询incubator表
		$condition1 ['incubatorid'] = $type;
		$temp = $incubator->where ( $condition1 )->select ();
		foreach ( $temp as $one => $value ) {
			$maincontent [$num ++] = array (
					'title' => $value [incubatorname], 
					'content' => $value [incubatorcontent]
			);
		}
		
		//查询incubatormodules表
		$condition2 ['incubatorno'] = $type;
		$temp = $incubatormodules->where ( $condition2 )->select ();
		foreach ( $temp as $one => $value ) {
			$maincontent [$num ++] = array (
					'title' => $value [modulename], 
					'content' => $value [modulecontent]
			);
		}
		
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign ( 'maincontent', $maincontent );
		$this->display ( "page" );
	}
	
	public function user() {
		$demo = M ( 'student' );
		$list = $demo->select ();
		$this->assign ( 'list', $list );
		$this->display ( "index:user" );
	}
	
	public function cyk() {
		echo 'msg is: ' . $_GET ['msg'] . '<br/>secondmsg:' . $_GET ['secondmsg'];
	}

}
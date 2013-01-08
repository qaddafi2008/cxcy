<?php
	class XljzAction extends Action{
		public function index(){
			$this->getLectureList();
		}
		
		//获得学生角色的左侧导航菜单
		private function getNavlist(){
			$navindex = 0;
			$navlist [$navindex++] = array ("url" => '__URL__/getLectureList', "title"=>'讲座列表');
			return $navlist;
		}
		
		public function getLectureList(){
			//左侧导航栏
			$modelname = "系列讲座："; //本模块名称
			$navlist = $this->getNavlist();//获得左侧导航菜单
		
			$lecture = M('lecture');
			$res = $lecture->order("updatetime DESC")->select();
			
			$this->assign('lectureList',$res);
			$this->assign ( 'modelname', $modelname );
			$this->assign ( 'navlist', $navlist );
			$this->assign ( 'functionBlock', 'lectureList');//设置主模块显示的功能页面
			
			$this->display("index");
		}
		
		//获取讲座详细信息
		public function getLectureDetail(){		
			//左侧导航栏
			$modelname = "系列讲座："; //本模块名称
			$navlist = $this->getNavlist();//获得左侧导航菜单
			
			$lid = $_GET['lid'];
			$lecture = M('lecture');
			$l = $lecture->where("lid=$lid")->find();
			
			$lecturecomment = M('lecturecomment');
			$lcomments = $lecturecomment->where("lectureid=$lid")->select();
			
			$this->assign('lecture', $l);
			$this->assign('lcomments', $lcomments);
			
			$this->assign ( 'modelname', $modelname );
			$this->assign ( 'navlist', $navlist );
			$this->assign ( 'functionBlock', 'lectureDetailAndComments');//设置主模块显示的功能页面
			
			$this->display("index");
		}
		
		//为讲座添加评论
		public function addlComment(){
			R('Home/Authority/checkLogin');//表示调用Admin分组下Authority模块的checkLogin方法
			
			$lid = $_POST['lid'];
			$data['content'] = $_POST['comment'];
			$data['commenter'] = $_POST['commenter'];
			$data['lectureid'] = $lid;
			$lecturecomment = M('lecturecomment');
			
			$res = $lecturecomment->add($data);
			if($res){
				$this->success("评论成功");
			}else{
				$this->error("添加评论失败！");
			}
		}
		
		//获取讲座的参与名单
		public function getParticipationList(){
			//左侧导航栏
			$modelname = "系列讲座："; //本模块名称
			$navlist = $this->getNavlist();//获得左侧导航菜单
			
			$lid = $_GET['lid'];
			
			//获取参与名单
			$queryStr = "SELECT stuno,sname from participation,student WHERE lectureid=$lid and certificationstatus='已参与' and sid=stuid ORDER BY stuno";
			$model = new Model();
			$res = $model->query($queryStr);
			
			$stuid = session(C('USER_AUTH_KEY'));
			$urole = session(C('USER_ROLE'));
			if(2 == $urole){//学生
				$participation = M('participation');
				$vo = $participation->where("stuid=$stuid and lectureid=$lid")->find();
				if($vo){
					if('已参与'==$vo['certificationstatus'])
						$this->assign('isApply',2);//通过
					else
						$this->assign('isApply',1);//已申请
				}else{
						$this->assign('isApply',0);//尚未申请
				}
			
			}
			
			
			$this->assign('lname',$_GET['lname']);
			$this->assign('plist', $res);
			$this->assign('lid', $lid);

			$this->assign ( 'modelname', $modelname );
			$this->assign ( 'navlist', $navlist );
			$this->assign ( 'functionBlock', 'participationList');//设置主模块显示的功能页面
			
			$this->display("index");
		}
		
		//申请讲座的认证参与
		public function doApply(){
			R('Home/Authority/checkStudentLogin');//表示调用Admin分组下Authority模块的checkStudentLogin方法
			
			$lid = $_GET['lid'];
			$stuid = session(C('USER_AUTH_KEY'));
			$participation = M('participation');
			$data['lectureid'] = $lid;
			$data['stuid'] = $stuid;
			$data['certificationstatus'] = '待认证';
			if($participation->add($data))
				$this->ajaxReturn(1,"申请成功！",1);
			else
				$this->ajaxReturn(0,"申请失败！",0);
		}
		
	}
?>
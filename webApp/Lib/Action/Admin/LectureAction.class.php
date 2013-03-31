<?php
	class LectureAction extends Action{
		//进入创建讲座页面
		public function createLecture(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			$this->display("lectureDetail");
		}
		
		//创建/更新讲座信息
		public function doUpdateLecture(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			
			$lid = $_POST['lid'];
			$data['lname'] = $_POST['subject'];
			$data['lcontent'] = $_POST['content'];
			
			$lecture = M('lecture');
			if(null == $lid){//创建新讲座
				if($lecture->add($data))
					$this->success('创建讲座信息成功！','getLectureList');
				else
					$this->error('创建讲座信息失败！');
			}else{//更新已有讲座
				if($lecture->where("lid=$lid")->save($data))
					$this->success('修改讲座信息成功！');
				else
					$this->error('修改讲座信息失败！');
			}
		}
		
		//获得讲座列表
		public function getLectureList(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			
			$lecture = M('lecture');
			$res = $lecture->order("updatetime DESC")->select();
			
			$this->assign('lectures', $res);
			$this->display("lectureList");
		}
		
		//获取讲座详细信息
		public function getLectureDetail(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			
			$lid = $_GET['lid'];
			
			$lecture = M('lecture');
			$l = $lecture->where("lid=$lid")->find();
			
			$this->assign('l', $l);
			$this->display("lectureDetail");
		}
		
		//为做认证参与，获取讲座详细信息
		public function getLectureListForParticipation(){
			$lecture = M('lecture');
			$res = $lecture->order("updatetime DESC")->select();
			
			$this->assign('lectures', $res);
			$this->display("lectureListForParticipation");
		}
		
		//获得某个讲座的学生参与和认证参与的列表
		public function getParticipationList(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			
			$lid = $_GET['lid'];
			
			$queryStr = "SELECT pid,sname,certificationstatus from participation,student WHERE lectureid=$lid and sid=stuid ORDER BY sname";
			$model = new Model();
			$res = $model->query($queryStr);
			
			$this->assign('lname',$_GET['lname']);
			$this->assign('plist', $res);
			$this->assign('lid', $lid);
			$this->display("participationList");
		}
		
		//批量认证参与/未参与
		public function doPassOrRejectParticipation(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			
			$passOrReject = $_POST['passOrReject'];
			$pids = $_POST['pids'];
			
			$condition = 'pid='.$pids[0];
			for($i=1;$i<count($pids);$i++){
				$condition = $condition.' or pid='.$pids[$i];
			}
			
			$participation = M('participation');
			if($passOrReject){//批量认证参与
				$data['certificationstatus'] = '已参与';
				if(!$participation->where($condition)->save($data))
					$this->error('批量认证通过失败！');
				else
					$this->success('批量认证通过成功！');
			}else{//批量认证未参与
				if(!$participation->where($condition)->delete())
					$this->error('操作失败！');
				else
					$this->success('操作成功！');
			}
		}
		
		//获得学生名单，并跳转至添加已参与的页面
		public function addParticipatedStudents(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			
			$lname = $_GET['lname'];
			$lid = $_GET['lid'];
			
			$student = M('student');
			$stulist = $student->order('stuno')->select();
			
			$this->assign('lname', $lname);
			$this->assign('lid', $lid);
			$this->assign('stuList', $stulist);
			$this->display("addParticipatedStudents");
		}
		
		//添加已参与的学生到讲座的参与名单中
		public function doAddParticipatedStudents(){
			R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
			
			$sids = $_POST['sids'];
			$lid = $_POST['lid'];
			
			$data['certificationstatus'] = '已参与';
			$data['lectureid'] = $lid;
			$participation = M('participation');
			for($i=0;$i<count($sids);$i++){
				$data['stuid'] = $sids[$i];
				if(!$participation->where('lectureid='.$data['lectureid'].' and stuid='.$data['stuid'])->find()){//如果不存在，则进行添加
					if(!$participation->add($data))
						$this->error('批量添加失败！');
				}
			}
			$this->success('批量添加学生至参与名单成功！');
		}
	}
?>
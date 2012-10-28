<?php
import('webApp.Action.Admin.Common');
class TutorsAction extends Action{
	public function index(){
		var_dump($_GET);
	}
	public function assigntutor(){
		$htmltitle = "分配导师";
		$tsmodel = M('teacherselection');
		$stuff = M('stuff');
		$studentmodel = M('student');
		$tslist = "";
		$condition = "";
		$condition['selectionstatus'] = 1;
		$tslist = $tsmodel->where($condition)->order('studentid')->select();
		$studentlist = $studentmodel->select();
		$teacherlist = $stuff->where("role='1'")->select();

		for($i=0;$i<count($tslist);$i++){
			$tempstudent = $studentmodel->field("stuno,sname")->where("sid ='".$tslist[$i]['studentid']."'")->find();
			$tslist[$i]['stuno'] = $tempstudent['stuno'];
			$tslist[$i]['sname'] = $tempstudent['sname'];
			$tempteacher = $stuff->field("teachername")->where("stuffid ='".$tslist[$i]['teacherid']."'")->find();
			$tslist[$i]['teachername'] = $tempteacher['teachername'];
			$tslist[$i]['filename'] = Common::removesuffix($tslist[$i]['projectoutline']);
		}
		$this->assign("recordcounts",count($tslist));
		$this->assign("htmltitle",$htmltitle);
		//$tslist = array_merge($tslist,$tslist);
		$this->assign("tslist",$tslist);
		$this->display();
	}
	public function changetutor(){
		var_dump($_GET);
	}
	public function tsresults(){		
		$htmltitle = "分配导师";
		$tsmodel = M('teacherselection');
		$stuff = M('stuff');
		$studentmodel = M('student');
		$tslist = "";
		$condition = "";
		$condition['selectionstatus'] = 2;
		$tslist = $tsmodel->where($condition)->order('studentid')->select();
		$studentlist = $studentmodel->select();
		$teacherlist = $stuff->where("role='1'")->select();

		for($i=0;$i<count($tslist);$i++){
			$tempstudent = $studentmodel->field("stuno,sname")->where("sid ='".$tslist[$i]['studentid']."'")->find();
			$tslist[$i]['stuno'] = $tempstudent['stuno'];
			$tslist[$i]['sname'] = $tempstudent['sname'];
			$tempteacher = $stuff->field("teachername")->where("stuffid ='".$tslist[$i]['teacherid']."'")->find();
			$tslist[$i]['teachername'] = $tempteacher['teachername'];
			$tslist[$i]['filename'] = Common::removesuffix($tslist[$i]['projectoutline']);
		}
		$this->assign("recordcounts",count($tslist));
		$this->assign("htmltitle",$htmltitle);
		//$tslist = array_merge($tslist,$tslist);
		$this->assign("tslist",$tslist);
		$this->display();
	}

	/**
	 * 按学生id和教师id批准选择
	 */
	public function approveById(){
		if(isset($_POST['sid'])&&isset($_POST['tid'])){
			$condition = "";
			$condition['studentid'] = $_POST['sid'];
			$condition['selectionstatus'] = 1;
			$condition['teacherid'] = $_POST['tid'];
			$tsmodel = M('teacherselection');
			//$record = $tsmodel->where($condition)->find();
			$data['selectionstatus'] = 2;
			$data['adminid'] = $_SESSION['uid'];
			$result = $tsmodel->where($condition)->save($data);
			$condition = "";
			$condition['studentid'] = $_POST['sid'];
			$condition['selectionstatus'] = 1;
			$tsmodel->where($condition)->delete();
			if($result){
				$this->ajaxReturn($result,SUCCESS,1);
			}
			else {
				$this->ajaxReturn($result,"NOUPDATE",0);
			}
		}else{
			$this->ajaxReturn(0,ERROR,0);
		}

	}

	/**
	 * 按学生和教师id删除记录
	 */
	public function deleteById(){
		if(isset($_POST['sid'])&&isset($_POST['tid'])){
			$condition = "";
			$condition['studentid'] = $_POST['sid'];
			//$condition['selectionstatus'] = 1;
			$condition['teacherid'] = $_POST['tid'];
			$tsmodel = M('teacherselection');
			$result = $tsmodel->where($condition)->delete();
			if($result){
				$this->ajaxReturn($result,SUCCESS,1);
			}
			else {
				$this->ajaxReturn($result,"NOUPDATE",0);
			}
		}else{
			$this->ajaxReturn(0,ERROR,0);
		}
	}
	
	/**
	 * 通过id获取教师信息
	 */
	public function getTecherInfoById()
	{
		//var_dump($_GET);
		//echo $_GET['_URL_'][2];
		$condition['stuffid'] = $_GET['_URL_'][3];
		$stuff = M('stuff');
		$teacher = $stuff->where($condition)->field('teachername,teachertitle,major,area,teacherdescription')->find();
		//print $teacher['teacherdescription'];
		$this->ajaxReturn($teacher,"Success",1);
	}

	//通过文件和文件名获取文件
	public function downfile(){
		//var_dump($_GET['_URL_']);
		$sid = $_GET['_URL_'][3];
		$filename = $_GET['_URL_'][4];
		Common::downloadFile($filename, $sid.".cyds.student");
	}
}
?>
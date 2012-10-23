<?php

class CydsAction extends Action {
	public function index() {
		//左侧导航栏
		$modelname = "创业导师："; //本模块名称
		$navlist [0] = array ("url" => '__URL__/index', "title" => '选择导师' );

		$condition['teachername'] = array("neq","");
		$condition['teachertitle'] = array("neq","");
		$condition['major'] = array("neq","");
		$condition['area'] = array("neq","");

		$stuff = M('stuff');
		$teacherlist = $stuff->where($condition)->select();

		//$titlelist = $Model->query("SELECT * FROM think_user WHERE id=%d and username='%s' and xx='%f'",array($id,$username,$xx));
		$titlelist = $stuff->query("select distinct teachertitle from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");
		$majorlist = $stuff->query("select distinct major from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");
		$arealist = $stuff->query("select distinct area from __TABLE__ where role='1' and teachername <>'' and teachername <>'null'");

		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );

		$this->assign('teacherlist',$teacherlist);
		$this->assign('titlelist',$titlelist);
		$this->assign('majorlist',$majorlist);
		$this->assign('arealist',$arealist);
		$this->display ();
	}

	public function submit()
	{
		$teacherids = $_POST['teacherid'];
		$scores = $_POST['intentionscore'];
		$totalscore = 0;
		$ok = true;
		
		//检测当前登陆类型为学生
		if($_SESSION['role']!=2)
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
			echo "OK";
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
	
	public function getDescriptionById()
	{
		$condition['stuffid'] = $_GET['_URL_'][2];
		$stuff = M('stuff');
		$teacher = $stuff->where($condition)->find();
		print $teacher['teacherdescription'];
	}
}
?>
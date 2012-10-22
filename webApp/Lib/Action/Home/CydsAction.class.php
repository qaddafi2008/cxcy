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
		$titlelist = $stuff->query("select distinct teachertitle from __TABLE__ where teachername <>'' and teachername <>'null'");
		$majorlist = $stuff->query("select distinct major from __TABLE__ where teachername <>'' and teachername <>'null'");
		$arealist = $stuff->query("select distinct area from __TABLE__ where teachername <>'' and teachername <>'null'");
		
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		
		$this->assign('teacherlist',$teacherlist);
		$this->assign('titlelist',$titlelist);
		$this->assign('majorlist',$majorlist);
		$this->assign('arealist',$arealist);
		
		$this->display ();
	}
}
?>
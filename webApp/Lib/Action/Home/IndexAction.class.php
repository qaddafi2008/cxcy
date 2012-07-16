<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        header("Content-Type:text/html; charset=utf-8");
        echo '<div style="font-weight:normal;color:blue;float:left;width:345px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;font-size:14px;font-family:Tahoma">^_^ Hello,北京欢迎您！<span style="font-weight:bold;color:red">创新创业平台</span></div>';
    }
	
	public function insert(){
		$Demo = new Model('student');
		$Demo->Create();
		$result = $Demo->add();
		$this->redirect('user');
	}
	
	public function user(){
		 $demo = new Model('student');
		$list=$demo->select();
		$this->assign('list',$list);
		$this->display();
	}
	
}
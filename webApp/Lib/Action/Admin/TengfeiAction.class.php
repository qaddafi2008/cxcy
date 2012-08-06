<?php

class TengfeiAction extends Action {
	
    public function view($mid){
    	//var_dump($_GET['_URL_']);
    	$mid = null;
    	$submid = null;
    	$modulename = null;
    	$content = null;
    	if(isset($_GET['submid'])&&isset($_GET['mid']))
    	{
    		$mid=$_GET['mid'];
    		$submid=$_GET['submid'];
    		$condition = array(
    				'moduleid'=>$submid,
    				'incubatorno'=>$mid,
    		);
    		$incubatormodules = M ( 'incubatormodules' );
    		$temp = $incubatormodules->where ( $condition )->select ();
    		if($temp!=null)
    		{
    			$mid = $temp[0]['incubatorno'];
    			$submid = $temp[0]['moduleid'];
    			$modulename = $temp[0]['modulename'];
    			$content = $temp[0]['modulecontent'];
    		}
    	}
    	else if(isset($_GET['mid']))
    	{
    		$mid=$_GET['mid'];
    		$condition = array(
    				'incubatorid'=>$mid,
    		);
    		$incubator = M ( 'incubator' );
    		$temp = $incubator->where ( $condition )->select ();
    		if($temp!=null)
    		{
    			$mid = $temp[0]['incubatorid'];
    			$modulename = $temp[0]['incubatorname'];
    			$content = $temp[0]['incubatorcontent'];
    		}
    	}
    	
    	$this->assign("mid",$mid);
    	$this->assign("submid",$submid);
    	$this->assign("modulename",$modulename);
    	$this->assign("content",$content);
		$this->display();
    }
    public function submit()
    {
    	$mid = $_POST['mid'];
    	$submid = $_POST['submid'];
    	$content = $_POST['content'];
    	$result = false;
    	//更新的是子模块的内容
    	if($submid!=null&&$submid!="")
    	{
    		$incubatormodules = M ( 'incubatormodules' );
    		$data = array(
    			'moduleid'=>$submid,
    			'incubatorno'=>$mid,
    			'modulecontent'=>$content			
    		);
    		$result = $incubatormodules->save($data);	
    	}
    	//更新的是主模块的内容
    	else{
    		$incubator = M ( 'incubator' );
			$data = array ('incubatorid' => $mid, 'incubatorcontent' => $content );
			$result = $incubator->save ( $data );
    	}
    	if ($result){
    		// 成功后返回客户端新增的用户ID，并返回提示信息和操作状态
    		$this->ajaxReturn($result,"(更新成功！)",1);
    	}else{
    		// 错误后返回错误的操作状态和提示信息
    		$this->ajaxReturn(0,"(未更新！)",0);
    	}
    	//$this->display("view");
    	//redirect(U('/Admin/Tengfei/view/mid/3'), 5, '页面跳转中...');
    }
}
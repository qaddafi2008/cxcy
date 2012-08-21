<?php
class UserAction extends Action {
	public function createTeacher(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		$this->display();
	}
	//创建评委老师账号
	public function addTeacher(){
		$stuff = M('stuff');
		$condition['usrname']=$_POST['usrname'];
		$condition['role']=1;
		
		if( $stuff->where($condition)->find()){
			$this->error ( "该用户名已存在，请输入其他用户名！" );
		}else{
			$data['usrname'] = $_POST['usrname'];
			$data['password'] = md5($_POST['password']);
			$data['role'] = 1;
			
			$stuff->add($data);
			$this->success ( '创建老师账号成功!');
		}
	}
	
	public function secondPswdVerify(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		$this->display();
	}
	
	//验证二次密码
	public function doSecondPswdVerify(){
		$condition['secondpwd'] = md5($_POST['secpswd']);
		$condition['stuffid'] = session ( C ( 'USER_AUTH_KEY' ));
		
		$stuff = M('stuff');
		if( !$stuff->where($condition)->find()){
			$this->error ( "二次密码错误，请重新输入！" );
		}else{
			$this->display('createAdministrator');
		}
	}
	
	public function createAdministrator(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		$this->display();
	}
	
	//创建管理员账号
	public function addAdministrator(){
		$stuff = M('stuff');
		$condition['usrname']=$_POST['usrname'];
		$condition['role']=0;
		
		if( $stuff->where($condition)->find()){
			$this->error ( "该用户名已存在，请输入其他用户名！" ,"createAdministrator");
		}else{
			$data['usrname'] = $_POST['usrname'];
			$data['password'] = md5($_POST['password']);
			$data['secondpwd'] = md5($_POST['anotherPswd']);
			$data['role'] = 0;
			
			$stuff->add($data);
			$this->success ( '创建管理员账号成功!','createAdministrator');
		}
	}
	
	public function changePassword(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		if(0 == $_GET['type'])//修改密码
			$this->display();
		else 				  //修改二次密码
			$this->display("changeSecondPassword");
	}
	
	//修改密码或者二次密码
	public function doChangePassword(){
		$condition['stuffid'] = session ( C ( 'USER_AUTH_KEY' ));
		$stuff = M('stuff');
		if(0 == $_POST['type']){//修改密码
			$condition['password'] = md5($_POST['password']);
			if( !$stuff->where($condition)->find())
				$this->error ( "原密码错误，请重输入！" );
			else{
				$data['password'] = md5($_POST['newPassword']);
			}
		}else{					//修改二次密码
			$condition['secondpwd'] = md5($_POST['password']);
			if( !$stuff->where($condition)->find())
				$this->error ( "原二次密码错误，请重输入！" );
			else{
				$data['secondpwd'] = md5($_POST['newPassword']);
			}
		}
		
		if($stuff->where("stuffid = ".$condition['stuffid'])->save($data))
			$this->success("修改成功！");
		else
			$this->error("修改失败！");
	}
	
	//分页显示学生信息
	public function studentPage(){
		R('Admin/Authority/checkAdminLogin');//表示调用Admin分组下Authority模块的checkAdminLogin方法
		$student = M('student');
		$list = $student->order('sid')->page($_GET['p'].',5')->select();
		$this->assign('list',$list);
		import("ORG.Util.Page");
		$count = $student->count();
		$page = new Page($count,5);
		
		$page->setConfig('prev','<img src="__PUBLIC__/images/admin/images/back.gif" width="43" height="15" />');
		$page->setConfig('next','<img src="__PUBLIC__/images/admin/images/next.gif" width="43" height="15" />');
		$gotoPage = '<span style="position:relative; bottom:3px">转到第<input name="textfield" type="text" style="height:20px; width:30px;"/>页</span>'.
            '<a href="#"><img src="__PUBLIC__/images/admin/images/go.gif" width="37" height="15" /></a>';
		$page->setConfig('theme','<span style="float:left">共%totalRow%%header%，当前第%nowPage%/%totalPage%页，每页10条记录</span> <span style="float:right">%upPage% %downPage% %first% %prePage% %linkPage%'.$gotoPage.'</span>');
		
		$show = $page->show();
		$this->assign('page',$show);
		$this->display();
	}
	
	public function deleteStudent(){
		$condition['sid'] = $_GET['sid'];
		$student = M('student');
		
		if($student->where($condition)->delete())
			$this->success("删除学生账号成功！");
		else
			$this->error("删除失败！");
	}
	
	public function teacherList(){
		$stuff = M('stuff');
		$list = $stuff->where('role=1')->order('stuffid')->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	public function administratorList(){
		$stuff = M('stuff');
		$list = $stuff->where('role=0')->order('stuffid')->select();
		$this->assign('list',$list);
		$this->display();
	}
}
?>
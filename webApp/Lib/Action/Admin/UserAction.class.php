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
}
?>
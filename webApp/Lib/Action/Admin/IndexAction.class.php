<?php

class IndexAction extends Action {
	public function checkAdminLogin(){
		$urole = session(C('USER_ROLE'));
		if($urole == null || $urole!=0)
			$this->error(session(C('USER_ROLE')).'请先登录！','index');
	}
	
    public function index(){
        /*header("Content-Type:text/html; charset=utf-8");
        echo '<div style="font-weight:normal;color:blue;float:left;width:345px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;font-size:14px;font-family:Tahoma">您好，这里是后台管理平台<span style="font-weight:bold;color:red">创新创业平台</span></div>';*/
		
		$this->display();
    }
	
	public function login(){
		$stuff = M('stuff');
		$map['usrname'] = $_POST['user_name'];
		$map['password'] = md5($_POST['user_password']);
		$map['role'] = 0;//0为管理员
		
		$checkAdmin = $stuff->where($map)->find();
		if(!$checkAdmin){
			$this->error("用户或密码错误！");
		}else{
			session(C('USER_AUTH_KEY'),$checkAdmin['stuffid']);//USER_AUTH_KEY 为用户id
			session(C('USER_NAME'),$checkAdmin['usrname']);//USER_NAME为用户姓名
			session(C('USER_ROLE'),$checkAdmin['role']);//USER_ROLE为用户角色，0为管理员，1为评审老师，2为学生
			
			
			$this->success('登陆成功','mainpage');
			
		}
	}
	
	public function mainpage(){
		$this->checkAdminLogin();//如果没有登录，则不会进到下一行
		
		$this->display();
	}
	
	public function logout(){
		session(null);//清空当前的session
		$this->display('index');
		//echo " <script>top.location   =   '".__URL__. "/index'</script> ";
	}
}
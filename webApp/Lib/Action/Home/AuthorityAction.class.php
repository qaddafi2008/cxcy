<?php
class AuthorityAction extends Action {
	public function checkLogin(){//判断用户是否登录
		$urole = session(C('USER_ROLE'));
		if($urole == null)
			$this->error('请先登录！',__GROUP__);//__GROUP__.'/index/index'
	}
	
	public function checkAdminLogin(){//判断管理员是否登录
		$urole = session(C('USER_ROLE'));
		if($urole == null || $urole!=0)
			$this->error('请管理员先登录！',__GROUP__);//__GROUP__.'/index/index'
	}
	
	public function checkTeacherLogin(){//判断老师是否登录
		$urole = session(C('USER_ROLE'));
		if($urole == null || $urole!=1)
			$this->error('请老师先登录！',__GROUP__);
	}
	
	public function checkStudentLogin(){//判断学生是否登录
		$urole = session(C('USER_ROLE'));
		if($urole == null || $urole!=2)
			$this->error('请学生先登录！',__GROUP__);
	}
}
?>
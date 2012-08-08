<?php
class AuthorityAction extends Action {
	public function checkAdminLogin(){
		$urole = session(C('USER_ROLE'));
		if($urole == null || $urole!=0)
			$this->error('请管理员先登录！',__GROUP__);//__GROUP__.'/index/index'
	}
}
?>
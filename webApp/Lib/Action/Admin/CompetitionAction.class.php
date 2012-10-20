<?php
import('webApp.Action.Admin.Common');
class CompetitionAction extends Action {

	public function detail() {
		//var_dump($_GET);
		$module = $_GET ['_URL_'] [3];//主模块，是创新赛事，或者合河赛事
		$submodule = $_GET ['_URL_'] [4];//子模块，代表阶段设置
		if(!$submodule||$submodule==null||$submodule==""){//设置主模块，故子模块为空
			if ($module == "cxss") {
				$condition = array ('comtype' => 1 );
			}
			else if($module == "hhss"){
				$condition = array ('comtype' => 2 );
			}
			if($condition){
				$competitions = M ( 'competitions' );
				$temp = $competitions->where ( $condition )->find ();
				$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
				$this->assign ( "competition", $temp);
			}
			$this->display ();
		}
		else if($submodule=="proc"){
			if ($module == "cxss") {
				$condition = array ('agendaid' => 1 );
			}
			else if($module == "hhss"){
				$condition = array ('agendaid' => 2 );
			}
			if($condition){
				$comagendas = M ( 'comagenda' );
				$temp = $comagendas->where ( $condition )->find ();
				$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
				$this->assign ( "comagenda", $temp);
			}
			$this->display ("detailproc");
		}
	}
	//主赛事设置的提交，不区分创新创业赛事或者河合；由post过来的comid设置
	public function submit() {
		$module = ($_POST ["comtype"]=='1'?"cxss":"hhss");//所提交更新的模块
		$competition = array ('comid' => $_POST ["comid"], 'subject' => $_POST ["subject"], 'createtime' => $_POST ['createtime'], 'description' => $_POST ['description'] );
		if (! isset ( $_POST ['alreadyfile'] )||$_POST ['alreadyfile']==""||$_POST ['alreadyfile']==null) {
			Common::removefile($module);
			$competition ['attachmentpath'] = "";
		}
		$filestatus = Common::upload($module);
		if($filestatus == SUCCESS){
			$competition ['attachmentpath'] = $_FILES ["file"] ["name"]."###".$module;
		}
		$competitions = M ( 'competitions' );
		$result = $competitions->save ( $competition );
		/*
		 if ($result) {
		// 成功后返回客户端新增的用户ID，并返回提示信息和操作状态
		$this->ajaxReturn ( $result, "(更新成功！)", 1 );
		} else {
		// 错误后返回错误的操作状态和提示信息
		$this->ajaxReturn ( 0, "(未更新！)", 0 );
		}
		*/
		$operation = $_POST['operation'];
		if($operation==null)
		$url = "detail/".$module;//更新后的跳转地址
		else 
			$url = "__GROUP__/Competition/newslist/".$module;
		echo $url;
		if ($result) {
			$this->success('更新成功', $url);
		}else{
			if($filestatus=="nofile")
				$msg = "未设置附件或附件不合法！";
			else if($filestatus==ERROR)
				$msg = "附件上传错误!";
			else if($filestatus=="Invalidsize")
				$msg = "附件过大！";
			$this->error($msg);
		}
	}

	//赛事阶段的设置，不区别创新创业赛事或河合
	public function submitproc() {
		$module = ($_POST ["compid"]=='1'?"cxss":"hhss");
		$comagenda = array ('agendaid' => $_POST ["agendaid"], 'compid' => $_POST ["compid"],'status'=>$_POST ['status'], 'endtime' => $_POST ['endtime'], 'description' => $_POST ['description'] );
		if (! isset ( $_POST ['alreadyfile'] )||$_POST ['alreadyfile']==""||$_POST ['alreadyfile']==null) {
			Common::removefile($module."proc");
			$comagenda ['attachmentpath'] = "";
		}
		$filestatus = Common::upload($module."proc");
		if ($filestatus == SUCCESS) {
			$comagenda ['attachmentpath'] = $_FILES ["file"] ["name"]."###".$module."proc";
		}
		$comagendas = M ( 'comagenda' );
		$result = $comagendas->save ( $comagenda );
		$url = "detail/".$module."/proc";
		if ($result) {
			$this->success('更新成功', $url);
		}else{
			if($filestatus=="nofile")
				$msg = "未设置附件或附件不合法！";
			else if($filestatus==ERROR)
				$msg = "附件上传错误!";
			else if($filestatus=="Invalidsize")
				$msg = "附件过大！";
			$this->error($msg);
		}
	}


	public function newslist()
	{
		$module = $_GET ['_URL_'] [3];
		$newslist = null;
		if($module=="cxss")
		{
			$condition['comtype'] = 1;

		}else if($module=="hhss"){
			$condition['comtype'] = 2;
		}
		if($condition){
			$competitions = M ( 'competitions' );
			$temp = $competitions->where ( $condition )->select ();
			//var_dump($temp);
			$num = 0;
			foreach($temp as $news=>$value){
				$newslist[$num++] = array(
						'id'=>$value['comid'],
						'title'=>$value['subject'],
						'releasetime'=>$value['createtime']
				);
			}
			var_dump($newslist);
			$this->assign("module",$condition['comtype']);
			$this->assign ( "newslist", $newslist);
		}
		$this->display ();
	}

	public function news()
	{
		$operation = $_GET ['_URL_'] [3];
		if($operation=="add")
		{
			$condition['comtype'] = $_GET['_URL_'][4];
			echo $condition['comtype'];
			$this->assign('competition',$condition);
		}
		else if($operation!=null){
			$condition['comid'] = $_GET['_URL_'][4];
			if($condition!=null){
				$competitions = M ( 'competitions' );
				if($operation=="viewdetail"){
					$temp = $competitions->where ( $condition )->find ();
					$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
					$this->assign ( "competition", $temp);
				}else if($operation=="modify"){
					$temp = $competitions->where ( $condition )->find ();
					$temp['attachmentpath'] = substr($temp['attachmentpath'],0,stripos($temp['attachmentpath'], "###"));
					$this->assign ( "competition", $temp);
				}else if($operation=="delete"){
						
				}
			}
		}
		$this->assign('operation',$operation);
		$this->display();
	}

}
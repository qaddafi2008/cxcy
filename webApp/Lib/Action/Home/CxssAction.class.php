<?php

import('webApp.Action.Admin.Common');
class CxssAction extends Action {
	protected function _empty()
	{
		$this->index();
	}
	public function index() {//首页
		$this->showpage(0);
	}
	public function baoming(){//报名页面
		$this->showpage(1);
	}
	protected function showpage($type)
	{
		//左侧导航栏
		$modelname = "创新创业系列赛事："; //本模块名称
		$navlist [0] = array ("url" => '__URL__/jieshao', "title" => '赛事介绍' );
		$navlist [1] = array ("url" => '__URL__/baoming', "title" => '报名参加' );
		$navlist [2] = array ("url" => '__URL__/news', "title"=>'赛事新闻');
		//从数据库转存信息
		$maincontent = null;

		//数据库
		$competitions = M ( 'competitions' );
		$comagenda = M ( 'comagenda' );

		//查询competitions表
		$condition1 ['comid'] = 1;
		$temp = $competitions->where ( $condition1 )->select ();

		foreach ( $temp as $one => $value ) {
			$maincontent [$num ++] = array (
					'title' => $value ['subject'],
					'releasetime' => $value['createtime'],
					'content' => $value ['description'],
					'fileurl'=>'__URL__'."/download/"."cxss/".Common::removesuffix($value['attachmentpath']),
					'attachment'=>Common::removesuffix($value['attachmentpath'])
			);
		}
		//查询comagenda表
		$condition2 ['compid'] = $temp[0]['comid'];
		$temp = $comagenda->where ( $condition2 )->select ();
		foreach ( $temp as $one => $value ) {
			$maincontent [$num ++] = array (
					'title' => $value ['status'],
					'releasetime'=>$value['endtime'],
					'content' => $value ['description'],
					'fileurl'=>'__URL__'."/download/"."cxssproc/".Common::removesuffix($value['attachmentpath']),
					'attachment'=>Common::removesuffix($value['attachmentpath'])
			);
		}
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign ( 'maincontent', $maincontent );
		$this->display("index");
	}
	public function download()
	{

		$file_name = $_GET['_URL_'][3];
		$suffix = $_GET['_URL_'][2];
		Common::downloadFile($file_name, $suffix);
	}
}
?>
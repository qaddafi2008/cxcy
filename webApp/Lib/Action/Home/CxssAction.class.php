<?php

import('webApp.Action.Admin.Common');
class CxssAction extends Action {
	protected function _empty()
	{
		$this->index();
	}
	public function index() {//首页
		$this->showpage(1,0);
	}
	public function jinzhan(){//进展
		$this->showpage(1,0);
	}
	public function jieshao(){//介绍
		$this->showpage(1, 1);
	}
	public function baoming(){//报名页面
		$this->showpage(1,2);
	}
	public function zuoping(){//作品
		$this->showpage(1,3);
	}
	public function xinwen(){//新闻
		$this->showpage(1,4);
	}
	/**
	 * 显示创新创业的页面
	 * @param  $moduleid 模块id，1代表创新创业，2代表河合
	 * @param  $type 0表示首页和进展、1表示介绍、2表示报名、3表示作品、4表示新闻
	 */
	protected function showpage($moduleid,$type)
	{
		//左侧导航栏
		$modelname = "创新创业系列赛事："; //本模块名称
		$navlist [0] = array ("url" => '__URL__/jinzhan', "title" => '当前进展' );
		$navlist [1] = array ("url" => '__URL__/jieshao', "title" => '赛事介绍' );
		$navlist [2] = array ("url" => '__URL__/baoming', "title" => '报名参加' );
		$navlist [3] = array ("url" => '__URL__/zuoping', "title" => '提交作品' );
		$navlist [4] = array ("url" => '__URL__/xinwen', "title"=>'赛事新闻');
		//从数据库转存信息
		$maincontent = null;

		//数据库
		$competitions = M ( 'competitions' );
		$comagenda = M ( 'comagenda' );

		if($type==1)
		{
			//查询competitions表
			$condition1 ['comid'] = $moduleid;
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
		}
		else if($type==0)
		{
			//查询comagenda表
			$condition2 ['compid'] = $moduleid;
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
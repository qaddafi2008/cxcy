<?php

class TengfeiAction extends Action {
	public function showpage($type)
	{
		//左侧导航栏
		$modelname = "腾飞创业："; //本模块名称
		$navlist [0] = array ("url" => '__URL__/ruhe', "title" => '如何腾飞' );
		$navlist [1] = array ("url" => '__URL__/zhanwang', "title" => '腾飞展望' );
		$navlist [1] ['subnav'] = array (
				"0" => array (
						"url" => 'javascript:forwardto(\'推介交流\')',
						"title" => '推介交流'
				),
				"1" => array (
						"url" => 'javascript:forwardto(\'服务概述\')',
						"title" => '服务概述'
				),
				"2" => array (
						"url" => 'javascript:forwardto(\'团队义务\')',
						"title" => '团队义务'
				) );
	
		//从数据库转存信息
		$num = 0;
		$maincontent = null;
	
		//数据库
		$incubator = M ( 'incubator' );
		$incubatormodules = M ( 'incubatormodules' );
	
		//查询incubator表
		$condition1 ['incubatorid'] = $type;
		$temp = $incubator->where ( $condition1 )->select ();
		foreach ( $temp as $one => $value ) {
			$maincontent [$num ++] = array (
					'title' => $value [incubatorname],
					'content' => $value [incubatorcontent]
			);
		}
	
		//查询incubatormodules表
		$condition2 ['incubatorno'] = $type;
		$temp = $incubatormodules->where ( $condition2 )->select ();
		foreach ( $temp as $one => $value ) {
			$maincontent [$num ++] = array (
					'title' => $value [modulename],
					'content' => $value [modulecontent]
			);
		}
	
		$this->assign ( 'modelname', $modelname );
		$this->assign ( 'navlist', $navlist );
		$this->assign ( 'maincontent', $maincontent );
		$this->display("index");
	}
	protected function _empty()
	{
		$this->index();
	}
	public function index() {
		$this->showpage(3);
	}
	public function ruhe()
	{
		$this->showpage(1);
	}
	public function zhanwang()
	{
		$this->showpage(2);
	}
}
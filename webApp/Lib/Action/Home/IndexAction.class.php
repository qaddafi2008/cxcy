<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        //header("Content-Type:text/html; charset=utf-8");
        //echo '<div style="font-weight:normal;color:blue;float:left;width:345px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;font-size:14px;font-family:Tahoma">^_^ Hello,北京欢迎您！<span style="font-weight:bold;color:red">创新创业平台</span></div>';
		$this->display();
	}
	
	public function insert(){
		$Demo = new Model('student');
		$Demo->Create();
		$result = $Demo->add();
		$this->redirect('user');
	}
	
	
	public function page()
	{
		$maincontent[0]=array(
			'title'=>'测试标题',
			'content'=>'测试内容测试内容测试内容测试内容测试内容测试内容'
		);
		$this->assign('maincontent',$maincontent);
		
		$this->display("page");
	}
	
	
	//新闻列表测试
	public function index3()
	{
		
		$list[0] = array(
			"url"=>'__URL__/index',
			"title"=>'testtesttesttesttest',
			"time"=>'2011年9月10日'
		);
		$list[1] = array(
			"url"=>'',
			"title"=>'testtesttesttesttest'
		);
		$list[2] = array(
			"url"=>'',
			"title"=>'testtesttesttesttest'
		);
		$list[3] = array(
			"url"=>'',
			"title"=>'testtesttesttesttest'
		);
		
		$this->assign('newslist',$list);
		$this->display("page");
	}
	
	
	//腾飞创业模块
	public function tengfei()
	{	
		unset($_GET['_URL_']);
		
		//左侧导航栏
		$modelname = "腾飞创业：";//本模块名称
		$navlist[0] = array(
			"color"=>'color',
			"url"=>'__URL__/tengfei/type/1',
			"title"=>'如何腾飞',
		);
		$navlist[1] = array(
			"color"=>'',
			"url"=>'__URL__/tengfei/type/2',
			"title"=>'腾飞展望',
		);
		
		$maincontent = null;
		$condition = null;
		//获取参数
		$type = $_GET['type'];
		
		
		//从数据库转存信息
		$num = 0;
		if($type==1||$type==2)//如何腾飞和腾飞展望
		{
			//数据库
			$incubator = M('incubator');
			$incubatormodules = M('incubatormodules');
		
			//查询incubator表
			$condition1['incubatorid'] = $type;
			$temp = $incubator->where($condition1)->select();
			foreach($temp as $one=>$value)
			{
				$maincontent[$num++] = array(
					'title' => $value[incubatorname],
					'content' => $value[incubatorcontent],
				);
			}
			
			//查询incubatormodules表
			$condition2['incubatorno'] = $type;
			$temp = $incubatormodules->where($condition2)->select();
			foreach($temp as $one=>$value)
			{
				$maincontent[$num++] = array(
					'title' => $value[modulename],
					'content' => $value[modulecontent],
				);
			}
		}
		else//首页进来为该孵化器平台的简介
		{
			//数据库
			$incubator = M('incubator');
			$condition['incubatorid'] = '3';
			$temp = $incubator->where($condition)->select();
			foreach($temp as $one=>$value)
			{
				$maincontent[$num++] = array(
					'title' => $value[incubatorname],
					'content' => $value[incubatorcontent],
				);
			}
		}
		
		$this->assign('modelname',$modelname);
		$this->assign('navlist',$navlist);
		$this->assign('maincontent',$maincontent);
		$this->display("page");
	}
	
	public function user(){
		$demo = M('student');
		$list=$demo->select();
		$this->assign('list',$list);
		$this->display("index:user");
	}
	
	public function cyk(){
		echo 'msg is: '.$_GET['msg'].'<br/>secondmsg:'.$_GET['secondmsg'];
	}
	
}
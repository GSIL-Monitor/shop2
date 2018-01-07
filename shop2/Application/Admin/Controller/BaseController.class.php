<?php

namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller 
{

	public function __construct()
	{
		parent::__construct();

		//判断管理员 是否登录
		if (!session('admin:name')) {

			//进来的，肯定是没有登录
			$this->error('请登录！', U('Admin/Public/login'));
			exit;
		}

		//判断对某个url有没有权限
		// import('ORG.Util.Auth');	
		$auth = new \Think\Auth();
		$id = session('admin:id');
		if ($id != 1){
			$url = CONTROLLER_NAME.'/'.ACTION_NAME	;
			
			$bool = $auth->check($url, $id); 
			if (!$bool) {
				$this->error('你对此功能没有权限，请联系管理员！！', U('Index/home'));
				exit;
			}
		}
			
		

	
	   

		
		
	
		
		/*dump(MODULE_NAME);//当前访问模块名
		dump(CONTROLLER_NAME);//控制名
		dump(ACTION_NAME);*///方法名
		


		
	}
}
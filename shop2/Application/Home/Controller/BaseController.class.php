<?php

namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->redis = new \Redis();
		$this->redis->connect(C('REDIS_HOST'), C('REDIS_PORT'));


		if (session('user:data')) {
			
			$this->assign("user",session('user:data'));
		}else{
			$this->assign("logout",1);
		}
	}

	public function handlerLoginCartData()
	{
		if ($_SESSION) {

			//如果登录后将原有存在redis购物车数据跟换键名
			
		}
	}
}
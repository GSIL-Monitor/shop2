<?php

namespace Admin\Controller;

use Think\Controller;

 

class IndexController extends BaseController  
{

    public function home()
    {
        $ip = get_client_ip();
        $time= date("Y年m月d日  H时i分s秒");
        $this->assign('ip',$ip);
        
        $this->assign('time',$time);
        $this->display();
    }

    public function index()
    {
        $name = session('admin:name');
        $this->assign('name',$name);
        $this->display('index');
    }
}

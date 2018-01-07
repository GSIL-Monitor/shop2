<?php

namespace Home\Controller;

use Think\Controller;

class LayoutController extends Controller
{
    public function base() 
    {

        $datass = M('systems')->find();
        
        $this->assign('datass',$datass);
        // dump($datas);die;
       $this->display();
    }	

    public function base2() 
	{

        $datass = M('systems')->find();
        
        $this->assign('datas',$datass);
        // dump($datas);die;
       $this->display();
	}
}
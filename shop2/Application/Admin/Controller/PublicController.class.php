<?php

namespace Admin\Controller;



use Think\Controller;

class PublicController extends Controller 
{

    public function login()
    {
    	$this->display();
    }

    Public function handlerLogin()
    {
      
       
         
        $name = I('post.uname');

        $verify = new \Think\Verify();    
        $bool = $verify->check(I('post.code'));
         
            // if(!$bool){
            // $this->error('验证码错误');
            //   exit;
            // }
         //3.判断用户名是否存在
        $map['name']  = $name;
        $dat = M('admin')->where($map)->find();
        // dump(I('post.'));
        if (!$dat) {
          $this->error('该用户不存在');
          exit;
        }
        if(!password_verify(I('post.pass'),$dat['password'])) {
              $this->error('密码错误');
              exit;
        }
        session('admin:name',$name);
        session('admin:id',$dat['id']);
        $ss = M('login_data')->where(['name' => $name])->find();
        if (!$ss) {
            $arr['ip'] = get_client_ip();
            $arr['uid'] = $dat['id'];
            $arr['name'] = $dat['name'];
            $arr['phone'] = $dat['phone'];
            $src = M('login_data')->add($arr);
            if ($src) {
                $this->success('登录成功',U('Admin/Index/index'));
                
            }
            
        } else {
            $map['uid'] =  $dat['id'];
            $data['logintime'] = date("Y-m-d H:i:s");
            $src = M('login_data')->where($map)->save($data);
            $src2 = M('login_data')->where($map)->setInc('number');
            if ($src && $src2){
               
                $this->success('登录成功',U('Admin/Index/index'));
                
            }
            
        }


         
}   

     /**
     * 退出登录
     */
    public function logout()
    { 
        unset($_SESSION['admin:name']);  
        // echo $_SESSION['admin:name'];die;  
        $this->display('login');
    }

    public function makeCode()
    {
        $Verify = new \Think\Verify();
        $Verify->entry();
        
    }

  	
}
<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends BaseController 
{

	protected $user;

	public function __construct()            
	{
		parent::__construct();

		$this->user = D('user');
	}

    public function getVerify()
    {
        $config = array( 'fontSize' => 18,    // 验证码字体大小    
                'imageW'=>172,// 验证码位数    
                'imageH'=>36, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
 

    public function index()
    {
        if (session('user:data')) {
            $this->success('亲,您已经登录了','Index/index');
            exit;
        }
        $this->display('login');
    }

    public function findPwd()
    {
      
        $this->display('findpwd');
    }

    /**
     * 登录处理
     */
    public function getLogin()
    {

        $user = I('post.username');
        if (S($user) >= 2) {
            $verify = new \Think\Verify();    
            if (!$verify->check(I('post.verify'))) {
                echo json_encode([
                        'code'=>1404,
                        'msg'=>'验证码错误',
                        'num'=>S($user)
                    ]);
                exit;
            }
        }
        
    	// $user = '13838384388';

    	$password = I('post.password');
        if (strlen($password) < 6) {
            echo json_encode([
                    'code'=>1404,
                    'msg'=>'密码长度太短'
                ]);
            exit;
        }

    	$account = preg_match("/^[a-z|A-Z]\w{3,12}$/",$user);//判断是否是用户名登录

    	$email = preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/",$user);//判断是否是邮箱登录


    	$data = [];
    	if ($account) {
    		$data = $this->redis->hGetAll('data:user:'.$user);
    		if (!$data) {//redis不存在查找数据库
    			$data = $this->user->where(['account'=>$user])->find();
    		}
    	}elseif($email){
    		$data = $this->redis->hGetAll('data:user:email:'.$user);
    		if (!$data) {//redis不存在查找数据库
    			$data = $this->user->where(['email'=>$user])->find();
    		}
    	}
        
        // dump($data);exit;   
    	if (!$data) {
    		echo json_encode([
    				'code'=>1404,
    				'msg'=>'用户不存在,请注册'
    			]);
    	}else{
    		if (password_verify($password , $data['password'])){
    			// $data['password'] = null;//防止密码存入session
                // 密码存入session方便改密码
                if ($data['status'] == 2) {
                    echo json_encode([
                            'code'=>1404,
                            'msg'=>'账号已禁用'
                        ]);
                        exit;
                }
    			session('user:data',$data);//存入session
    			echo json_encode([
    				'code'=>1200,
    				'msg'=>'登录成功'
    			]);

    		} else {
                if (!S($user)) {
                    S($user,1,1800);//记录登录次数
                }else{
                    $num = S($user);
                    if ($num >= 3) {//登陆失败3次
                        echo json_encode([
                            'code'=>1404,
                            'msg'=>'账号操作繁忙,请歇息半小时',
                            'num'=>S($user)
                        ]);
                        exit;
                    }
                    $num += 1;//每次登陆失败自增1
                    S($user,$num,1800);
                }
    			echo json_encode([
    				'code'=>1404,
    				'msg'=>'密码错误',
                    'num'=>S($user)
    			]);
    		}
    		
    	}


    }

    /**
     * 注销
     */
    public function logout()
    {
        if (I('post.logout')) {
            session('user:data',null);
            echo json_encode([
                'code'=>1200,
                'msg'=>'退出登录'
            ]);
            exit;
        }
         echo json_encode([
                'code'=>1404,
                'msg'=>'非法访问'
            ]);
    }

    public function testSession()
    {
    	
        // session('user:data',null);
        dump(session('user:data'));exit;


    }

    //找回密码
    public function findPassword()
    {
        $ema = I('post.email');
        if (!$ema) {
            $this->error('请填写邮箱','javascript:history.back(-1);',1);
            exit;
        }
        $match_ema = preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/",$ema);
        if (!$match_ema) {
            $this->error('不是邮箱请从新填写','javascript:history.back(-1);',1);
            exit;
        }

        if (S('code:'.$ema) != I('post.yzm')) {
            $this->error('验证码错误','javascript:history.back(-1);',1);
            exit;
        }

        $this->assign('email',$ema);
        $this->display('findpwd2');

    }

    //设置新密码
    public function doFindPwd()
    {
        // dump(I('post.'));exit;
        $email = I('post.email');
        $password = I('post.new_password');
        $password = password_hash($password,PASSWORD_BCRYPT);
        $data = $this->redis->hGetAll('data:user:email:'.$email);
        if (!$data) {//redis不存在查找数据库
            $data = $this->user->where(['email'=>$email])->find();
            if ($data) {
                $arr['password'] = $password;
                $res = $this->user->where('id='.$data['id'])->save($arr);
                if ($res) {
                    $this->success('修改密码成功',U("Login/index"));
                }else{
                    $this->error('服务器异常,请稍后','javascript:history.back(-1);',1);
                }
            }
        }else{
            $account = $data['account'];
            $acData = $this->redis->hGetAll('data:user:'.$account);
            $eres = $this->redis->hSet('data:user:email:'.$email,'password',$password);//修改redis字段
            // echo 'email'.$eres;
            if ($acData) {
               $acres = $this->redis->hSet('data:user:'.$account,'password',$password);
               if ($eres === 0 && $acres === 0) {
                    $this->success('修改密码成功',U("Login/index"));
               }else{
                    $this->error('服务器异常,请稍后','javascript:history.back(-1);',1);
               }
            }

        }

    }
        

    public function testReids()
    {
        $res = $this->redis->hSet('vv','cc','aa');
        dump($res);
    }

}

    

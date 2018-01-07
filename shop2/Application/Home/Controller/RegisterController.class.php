<?php

namespace Home\Controller;

use Think\Controller;
use Lixunguan\Yuntongxun\Sdk as Yuntongxun;
use Common\Server\EmailServer;

class RegisterController extends BaseController 
{

	protected $user;
	public function __construct()
	{
		parent::__construct();
		$this->user = D('user');

	}
 
	/**
	 * 注册页面
	 */
    public function index()
    {

        $this->display('register');
    }

    /**
     * 验证码
     */
    public function getVerify()
    {

        $addr = I('post.email');
        // echo json_encode(I('post.'));exit;
        // $addr = 'xiaoale1@163.com';
        if (!$addr) {
            echo json_encode([
                    'code'=>1404,
                    'msg'=>'请填写邮箱'
                ]);
            exit;
        }

        $email = new EmailServer;
        // $addr = 'xiaoale1@163.com';
        $code = rand(100000,999999);
        $res = $email->sendEmail($addr,$code);//邮箱发送成功返回true
        // dump($res);exit;
        if ($res) {
            S('code:'.$addr,$code,70);
            echo json_encode([
                    'code'=>1200,
                    'msg'=>'验证码发送成功'
                ]);
            exit;
        }else{
            echo json_encode([
                    'code'=>1404,
                    'msg'=>'邮箱发送失败'
                ]);
            exit;
        }
    }

    /**
     * 注册验证
     */
    public function checkRegister()
    {

        // echo json_encode(I('post.'));exit;

        /*$verify = new \Think\Verify();    
        if (!$verify->check(I('post.verify'))) {
            echo json_encode([
                    'code'=>1404,
                    'msg'=>'验证码错误'
                ]);
            exit;
        }*/

    	$accountKey = I('post.account');
    	$email = I('post.email');

    	$acountRes = $this->redis->exists('data:user:'.$accountKey);
    	$emailRes = $this->redis->exists('data:user:email:'.$email);
        
        
    	if ($acountRes) {
    		echo json_encode([
    				'code'=>1404,
    				'msg'=>'用户名已经存在'
    			]);
    		exit;
    	}
    	if ($emailRes) {
    		echo json_encode([
    				'code'=>1404,
    				'msg'=>'邮箱已注册'
    			]);
    		exit;
    	}

        //检查数据是否已存在数据
    	if (!$this->user->create()) {
    		$this->error($user->getError());
    		echo json_encode([
    				'code'=>1404,
    				'msg'=>$this->user->getError()
    			]);
    		exit;
    	}

        //检测验证码是否正确
        if (!S('code:'.$email) || S('code:'.$email) != I('post.code')) {
            echo json_encode([
                    'code'=>1404,
                    'msg'=>'验证码错误,或未发送',
                    'verify'=>I('post.verify'),
                    'codes'=>S('code')
                ]);
            exit;
        }
		
	// $this->success('注册成功','/shop2/Home/Login');exit;
		$post = I('post.');
    	unset($post['conf_password']);
    	unset($post['code']);
    	unset($post['agreement']);
    	$post['status'] = 1;
    	$post['password'] = password_hash($post['password'],PASSWORD_BCRYPT);//hash加密密码
    	$post['role'] = 1;
        $post['id'] = $this->redis->incr('user:id');
    	// $momo['id'] = $post['id'];
		//data:user:phone:* redis存用户数据key
		//data:user:* redis存用户名数据key
        $momo['uid'] = $post['id'];
        // $qwe = M('user_detail')->add($momo);

    	$phoneBool = $this->redis->hMset('data:user:email:'.$post['email'],$post);
        $accountBool = $this->redis->hMset('data:user:'.$post['account'],$post);
    	$scoreBool = $this->redis->hMset('data:user:'.$post['id'],$momo);
    	if ($phoneBool && $accountBool) {
            $this->redis->lPush('user:data:queue',$post['account']);
            $this->redis->lPush('email:data:queue',$post['email']);
    		$this->redis->lPush('score:data:queue',$post['id']);
    		echo json_encode([
    				'code'=>1200,
    				'msg'=>'注册成功'
    			]);
    	}else{
            // dump($scoreBool);die;       
    		echo json_encode([
    				'code'=>1404,
    				'msg'=>'服务器繁忙,请稍后再试',
                    'data'=>$scoreBool
    			]);
    	}

    }

    /**
     * 检查用户名是否存在
     */
    public function checkaccount(){

        $accountKey = I('get.account');
    	// $accountKey = 'aabb';


        $acountRes = $this->redis->exists('data:user:'.$accountKey);

        if ($acountRes) {
            echo json_encode([
                    'code'=>1404,
                    'msg'=>'用户名已经存在'
                ]);
            exit;
        }else{
            $data = $this->user->where(['account'=>$accountKey])->find();
            if ($data) {
                echo json_encode([
                    'code'=>1404,
                    'msg'=>'用户名已经存在'
                ]);
                exit;
            }
            echo json_encode([
                    'code'=>1200,
                    'msg'=>'可以注册'
                ]);
        }

    }

    /**
     * 检查邮箱是否存在
     */
    
    public function checkphoneNum()
    {
        $email = I('get.email');

        // echo $phone;exit;

        $phoneRes = $this->redis->exists('data:user:email:'.$email);

        if ($phoneRes) {
            echo json_encode([
                    'code'=>1404,
                    'msg'=>'邮箱已注册'
                ]);
            exit;
        }else{
            $data = $this->user->where(['email'=>$email])->find();
            if ($data) {
                echo json_encode([
                    'code'=>1404,
                    'msg'=>'邮箱已注册'
                ]);
                exit;
            }
            echo json_encode([
                    'code'=>1200,
                    'msg'=>'可以注册'
                ]);
        }

    }
 
}

    

<?php

namespace Home\Controller;

use Think\Controller;

use Common\Server\CommonServer;

class PersonController extends BaseController  
{

    public function __construct()
    {
        parent::__construct();
        $this->user = D('user');
         if (!session('user:data')) { 
            $this->error('请先登录',U('Login/index'),1);
        }
    }

    public function index()
    {
        $datass = M('systems')->find();
         $user = session('user:data');     
         $uid = $user['id'];
         $account = $user['account'];
         $update = M('user')->field('score,email,account')->where("id = $uid")->find();
         if ($update) {
            $user = $update;
         }
         $userdetail = M('user_detail')->field('uid,name,birth,sex,phone')->where("uid = $uid")->find();

         if ($userdetail == []){
            $userData = $user;
         } else {

         $userData = array_merge($user,$userdetail);
         }

        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $this->assign("user", $userData);
        $this->assign('datas',$datass);
        $this->display('index');

    }

 

    /**
     * 显示地址管理页面
     */
    public function address()
    {
        // $uid = $_SESSION['user:data']['id'];

        $user = session('user:data');
        $uid = $user['id'];

        $account = $user['account']; 
   
        $map['uid'] = $uid;
        $map['status'] = 1;
        $datas = D('district')->getAllAddress($map);
        // dump($uid);die;
        $datass = M('systems')->find();
        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();

        $this->assign('datass',$datas);
        $this->assign('uid',$uid);
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $this->assign('datas',$datass);
        $this->display();

    }

    public function getAddressData()
    {

       $upid = @$_GET['upid']+0; 

       $map['upid'] = $upid;
       $data = D('district')-> getAddressDatas($map);
        if ($data) {

            echo json_encode([
                'code' => 1200,
                'msg'  => 'get city info success',
                
                'data' => $data
            ]);
            exit;
        }

        echo json_encode([ 
            'code' => 1400,
                // 'msg'  => 'get city info success',
            'msg'  => '失败',
        ]);
        exit;

    }

    public function addAddress()
    {
        $map['id'] = ['in',I('post.pro').','.I('post.city').','.I('post.area')];
        $data = D('district')->getAreaData($map);
        $arr['address'] = $data[0]['name'].I('post.streets');
        $arr['uid'] = I('post.uid');
        $arr['name'] = I('post.name');
        $arr['phone'] = I('post.phone');
        // dump($arr);die;
        $getInsertId = D('district')->addAddress($arr);
        if ($getInsertId) {
            $this->success('添加成功');
        } else {
            $this->error('添加失败');
        }
    }

    public function editAddressState()
    {
        if (empty(I('post.'))) { 

            $this->error('非法访问', U('Index/index'));
            exit;
        }
        $uid = I('post.uid');
        $id = I('post.id');
        $address = M('address');
        $datas = $address->field('id')->where("uid = $uid")->select();
        $num = count($datas);
        $qwe =  $address->where("id=$id")->setField('state','1'); 
        if ($num == 1) {

            if ($qwe) {

                echo json_encode([
                        'code' => 1200,
                        'msg'  => 'change successfully'
                    ]);
                    exit;
            }
        } else {
            $papa = $address->where("id<>$id and state=1 and uid = $uid")->select();
            if (!empty($papa)) {

                $arr2= $address->where("id<>$id and uid=$uid")->setField('state','2');
                if($qwe && $arr2){
                    echo json_encode([
                            'code' => 1200,
                            'msg'  => 'change successfully' 
                        ]);
                        exit;
                    
                }
            } 
            //找不到就直接返回
            echo json_encode([
                            'code' => 1200,
                            'msg'  => 'change successfully' 
                        ]);
                        exit;
        }  



    }

    /**
     * 删除地址
     * @return [type] [description]
     */
    public function delAddressData()
    {
        if (empty(I('post.'))) { 

            $this->error('非法访问', U('Index/index'));
            exit;
        }
        $id = I('post.id');
        $qwe = M('address')->where("id=$id")->setField('status','2');
        if ($qwe) {
            echo json_encode([
                    'code' => 1200,
                    'msg'  => 'change successfully' 
                ]);
                exit;
            
        }
        //找不到就直接返回
        echo json_encode([
                    'code' => 1404,
                    'msg'  => 'change fail'
                ]);
                exit;
  


    }

    public function showScoreView()
    {
        $datass = M('systems')->find();
        $user = session('user:data');
        $uid = $user['id'];
        $datas = M('user_score u')->field('s.desc,s.score,u.addtime')->join('think_score s on s.id = u.sid')->where("state = 1 and uid = $uid")->order('u.addtime desc')->select();
        $score = M('user')->field('score')->where("id = $uid")->find();

        $pp = M('user_score')->field('desc,score,addtime')->where("uid = $uid and state = 2")->order('addtime desc')->select();
 
        $dat = array_merge($datas,$pp);

        // dump($dat);
        $arr1 = array_map(create_function('$n', 'return $n["addtime"];'), $dat);
        array_multisort($arr1,SORT_DESC,$dat);// 
    
        // dump($dat);die;
        $account = $user['account'];  
        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
        $this->assign('uid',$uid);
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $this->assign('score',$score['score']);   
        $this->assign('da',$datas);
        $this->assign('pp',$pp);
        $this->assign('datas',$datass);
        $this->assign('dat',$dat);
        $this->display('score');
    }

    
    /**
     * 修改密码
     */
    public function changePassword()
    {
        $id = session('data:user');
        if (empty($id)) {
            $this->error('非法访问', U('Index/index'));
            exit;
        }
        $this->assign('user',session('data:user'));
        display('setPassword');
    
    }
   
    /**
     * [showOrderView 显示订单列表信息]
     * @author    欧阳学
     * @DateTime  2017-12-22
     * @return    [type]      [description]
     */
    public function showOrderView()
    {
        $datass = M('systems')->find();
        $user = session('user:data');
        $uid = $user['id'];    
        $account = $user['account'];  

        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();

        if (I('get.status')) {

            switch (I('get.status')) {
                case 1:
                    $status = ['state' => 1, 'uid' => $_SESSION['user:data']['id'], 
                               'status' => 1,
                               'uid' => $_SESSION['user:data']['id'],
                              ];
                    break;
                case 2:
                    $status = ['state' => 1, 'uid' => $_SESSION['user:data']['id'], 
                               'status' => 3,
                               'uid' => $_SESSION['user:data']['id'],
                              ];
                    break;
                case 3:
                    $status = ['state' => 1, 'uid' => $_SESSION['user:data']['id'], 
                               'status' => 4,
                               'uid' => $_SESSION['user:data']['id'],
                              ];
                    break;
            }
        } else {
            $status = ['state' => 1, 'uid' => $_SESSION['user:data']['id']];
        }

        $orderInfo = D('orders')->getOrderData($status);

        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $this->assign('btn', $orderInfo[0]);
        $this->assign('orderInfo', $orderInfo[1]);
        $this->assign('datas',$datass);
        $this->display('order2');
    }

    // 处理支付
    public function handlerDelOrders()
    {
        if (empty(I('post.id'))) {

            //跳到首页
        }

        // $getTotal = D('orders')->gerTotalData(I('post.id'));

        $delData = D('orders')->updateOrderDataState(I('post.id'), I('post.spot'));

        if ($delData) {

            echo json_encode([
                'code' => 1200,
                'msg'  => '删除成功',
            ]);
            exit;
        } else {

            echo json_encode([
                'code' => 1200,
                'msg'  => '系统有误，请尽快联系程序员。。。',
            ]);
        }
    }

    // 显示支付成功页面
    public function showOrderDetailView()
    {
        $detailData = D('orders')->getOrderDetailData(I('get.id'));

        $dataField = 'id, total, message, linkman, address, phone, status, addtime';

        $ordersData = D('orders')->getAddressData(I('get.id'), $dataField);

        $this->assign('address', $ordersData);
        $this->assign('detail', $detailData);
        $this->display('order_detail');
    }

    // 显示评论页
    public function showCommentsView()
    {
        
        $datass = M('systems')->find();
        $user = session('user:data');
        $uid = $user['id'];
        
        $account = $user['account'];  
        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();

        $this->assign('uid',$uid);
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   

        $this->assign('datas',$datass);
        $this->display('comments');
    }

    // 处理评论信息
    public function handlerCommentData()
    {
        $data = I('post.');

        for ($i=0; $i<$data['arr_num']; $i++) {

            $dataInfo['content'] = $data[$i.'content'];
            $dataInfo['level'] = $data[$i.'level'];
            $dataInfo['color'] = $data[$i.'color'];
            $dataInfo['size'] = $data[$i.'size'];
            $dataInfo['uid'] = $data[$i.'uid'];
            $dataInfo['gid'] = $data[$i.'gid'];

            // print_r($dataInfo);
            $info = D('orders')->addCommentData($dataInfo);
        }

        if (!$info) {

            echo json_encode([
                'code' => 1505,
                '系统有误，请尽快联系程序员。。。',
            ]);
            exit;
        }

        $statusInfo = D('orders')->updateOrderDataState($data['oid'], $data['spot']);

        if ($statusInfo) {

            echo json_encode([

                'code' => 1200,
                'msg'  => '评论成功',
            ]);
            exit;
        } else {

            echo json_encode([
                'code' => 1404,
                'msg'  => '系统有误，请尽快联系程序员。。。',
            ]);
        }
    }
    
    public function setPassword()
    {
        $user = session('user:data');
        $uid = $user['id'];
        
        $account = $user['account'];  
        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
        $datass = M('systems')->find();
        
        $this->assign('datas',$datass);
        $this->assign('uid',$uid);
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        if (session('user:data')) {
             $this->display('password');
        }else{
            $this->error('请先登录',U('Login/index'),1);
        }
       
    }
     /**
     * 响应修改密码
     */
    public function doChangePassword()
    {

        // dump(I('post.'));
        // dump(session('user:data'));exit;
        

        $password = I('post.old_password');

        $newPwd = I('post.new_password');
        //confirm_password
        $confirm_password = I('post.confirm_password');
        if ($newPwd != $confirm_password) {
            $this->error('两次密码不一致');
            exit;
        }

        $user = session('user:data');
        if(!password_verify($password , $user['password'])){
            $this->error('密码错误');
            exit;
        }
        $email = $user['email'];
        $newPwd = password_hash($newPwd,PASSWORD_BCRYPT);
        $data = $this->redis->hGetAll('data:user:email:'.$email);
        if (!$data) {//redis不存在查找数据库
            // $earr['email'] = $email;
            $data = $this->user->where(['email'=>$email])->find();
            if ($data) {
                $arr['password'] = $newPwd;
                $res = $this->user->where('id='.$data['id'])->save($arr);
                if ($res) {
                    session('user:data',null);
                    $this->success('修改密码成功',U("Login/index"));//修改成功后调到主页
                }else{
                    $this->error('服务器异常,请稍后','javascript:history.back(-1);',1);
                }
            }
        }else{//修改redis数据
            $account = $data['account'];
            $acData = $this->redis->hGetAll('data:user:'.$account);
            $eres = $this->redis->hSet('data:user:email:'.$email,'password',$newPwd);//修改redis字段
            // echo 'email'.$eres;
            if ($acData) {
               $acres = $this->redis->hSet('data:user:'.$account,'password',$newPwd);
               if ($eres === 0 && $acres === 0) {
                    session('user:data',null);
                    $this->success('修改密码成功',U("Login/index"));//修改成功后调到主页
               }else{
                    $this->error('服务器异常,请稍后','javascript:history.back(-1);',1);
               }
            }

        }


    }


    public function setPersonal()
    {
       

        if (IS_GET) {

            $datass = M('systems')->find();
            $user = session('user:data');
            $uid = $user['id'];
            $account = $user['account'];

            $userdetail = M('user_detail')->field('uid,name,birth,sex,phone')->where("uid = $uid")->find();

            $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();

            $this->assign('uid',$uid);
            $this->assign('picc',$datai['pic']);
            $this->assign('username',$datai['name']);
            $this->assign('account',$account); 
            $this->assign("user",  $userdetail);
            $this->assign('datas',$datass);
            $this->display('personal');

        } else {
            
            if (!empty(I('post.name'))) {

                $name = I('post.name');
                if(!preg_match("/^[A-Za-z\x{4e00}-\x{9fa5}]+$/u", $name)){
                    $this->error('您输入的昵称不合法');
                }
            }

            if (!empty(I('post.phone'))) {

                $phone = I('post.phone');
                if(!preg_match("/^(1[358]\d|147|17[789])\d{8}$/", $phone)) {
                    $this->error('您输入的手机号码格式有误');
                }
            }

            if (!empty(I('post.sex'))) {

                $sex = I('post.sex');
            }

            if (!empty(I('post.birth'))) {

                $birth = I('post.birth');
            }
     
            $uid = I('post.uid');
            $data = I('post.');
            // unset( $data['uid']);
            // 
            $wqe = M('user_detail')->where("uid=$uid")->find();
      
            if ($wqe) {
              
            $affectRow = M('user_detail')->where("uid = $uid")->save($data);
            } else {
                $affectRow = M('user_detail')->add($data);

            }

            
            if ($affectRow) {
                $this->success('操作成功');

            } else {
                 $this->error('操作失败');
            }

        }
    }     

    public function setAvatar()
    {
        if (IS_GET) {

            $datass = M('systems')->find();
            $user = session('user:data');
            $uid = $user['id'];
            $account = $user['account'];

            $pic = M('user_detail')->field('pic')->where("uid = $uid")->find();

            // $userdetail = M('user_detail')->field('uid,name,birth,sex,phone')->where("uid = $uid")->find();

            $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
            // dump($pic);die;
         
            $this->assign('uid',$uid);
            $this->assign('picc',$datai['pic']);
            $this->assign('username',$datai['name']);
            $this->assign('account',$account); 
            // $this->assign("user",  $userdetail);
            $this->assign('datas',$datass);


            $this->assign('pic',$pic['pic']);
            $this->display('avatar');
            
        } else {  
       
            $objUpload = new CommonServer();
            $arr = $objUpload->handlerUploads();

            if ($arr['code'] == 1404) {

                //表示文件上传失败则提示返回
                $this->error($arr['msg']);
                exit;
            }

            $uid = I('post.uid');
  
            $data['pic'] = $arr[0];   // 从$arr返回值中获取字段logo的值
          
            //数据审核成功则存放到数据库
            $lastDataId = M('user_detail')->where("uid = $uid")->save($data);

            if ($lastDataId) {

                //数据插入成功
                $this->success('操作成功');
            } else {

                $this->error('系统有误, 请尽快联系程序员..');
            }
        }
    }
        


    public function changeMail()
    {
       
        $datass = M('systems')->find();
        $this->assign('datas',$datass);

        $this->display('changemail');
    }    


    public function newMail()
    {
        $datass = M('systems')->find();
        
        $this->assign('datas',$datass);
        $this->display('newmail');
    } 

    public function signIn()
    {
        if (empty(I('post.cate'))) {
            $this->error('非法访问', U('Person/index'));
            exit;
        }
        // = 5;
        $uid = I('post.cate');

        $row = M('signing')->field('last_signing_time time')->where("uid = $uid")->find();

        if (empty($row['time'])) { //第一次签到
            $data['uid'] = $uid;
            $data['last_signing_time'] = time();
            $m=M('signing');//或者是M();
            $m2=M('user');
            $m3 = M('user_score');
            $m->startTrans();//在第一个模型里启用就可以了，或者第二个也行
            $pp = $m->add($data);
            $aa = $m2->where("id = $uid")->setInc('score',5);
            $we['uid'] = $uid; 
            $we['sid'] = 2; 
            $tt = $m3->add($we);
            if($pp && $aa && $tt){
                $m->commit();//成功则提交
                echo json_encode([
                    'code' => 1200,
                    'msg'  => '签到成功',
                ]);
                exit;
            
            } else {
                $ll[] = $pp;
                $ll[] = $aa;
                $ll[] = $tt;
                $m->rollback();//不成功，则回滚
                echo json_encode([
                    'code' => 1400,
                    'msg'  => '签到失败',
                    'data' => $ll
                ]);
                exit;
           
            }

        } else {
            $zero1=date('Y-m-d H:i:s');   
            $date = date('Y-m-d',time());
            $zero2="$date 23:59:59";
            $zero1 = strtotime($zero1);
            $zero2 = strtotime($zero2);
            $zero3 = $zero2 - $zero1;
            $zero4 = $zero1 - $row['time'];
            if ($zero4 >= $zero3) {
                $data['uid'] = $uid;
                $data['last_signing_time'] = time();
                $m=M('signing');//或者是M();
                $m2=M('user');
                $m3 = M('user_score');
                $m->startTrans();//在第一个模型里启用就可以了，或者第二个也行
                $pp = $m->where("uid = $uid")->setField('last_signing_time',$zero1); 
                $wqa = $m->getLastSql();
                $aa = $m2->where("id = $uid")->setInc('score',5);
                $we['uid'] = $uid; 
                $we['sid'] = 2; 
                $tt = $m3->add($we);
                if($pp && $aa && $tt){
                    $m->commit();//成功则提交
                    echo json_encode([
                        'code' => 1200,
                        'msg'  => '签到成功',
                    ]);
                    exit;
                
                } else {
                    $m->rollback();//不成功，则回滚
                    $ll[] = $zero1;
                    $ll[] = $zero2;
                    $ll[] = $zero3;
                    $ll[] = $zero4;
                    $ll[] = $pp;
                    $ll[] = $wqa;
                    $ll[] = $row['time'];
                    $m->rollback();//不成功，则回滚
                    echo json_encode([
                        'code' => 1400,
                        'msg'  => '签到失败',
                        'data' => $ll
                    ]);
                    exit;

           
                }


            } else {
                echo json_encode([
                        'code' => 1404,
                        'msg'  => '您今天已签到',
                    ]);
                    exit;
            }

        }
   



    }


          


}

    

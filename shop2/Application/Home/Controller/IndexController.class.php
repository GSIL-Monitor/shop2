<?php

namespace Home\Controller;

use Think\Controller;

use Home\Server\TypesServer;

use Home\Server\CartServer;

use Home\Server\PhotosServer;

class IndexController extends BaseController  
{

    public function index() 
    {
       
        // 判断用户登录时购物车有无未登录时的集合键
        if (!empty($_SESSION['user:data']['id'])) { 
             ////判断SESSION中的用户ID

            $cartObj = new CartServer;

            $info = $cartObj->loginModifyRedisData();
        }

        if (!empty(session('user:data'))) {
            $user = session('user:data');
            $uid = $user['id'];
            $role = $user['role'];
            $account = $user['account'];
            $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
            $account = M('user')->where("id=$uid")->getField('account');
            if ($account) {

                $this->assign('uid',$uid);
                $this->assign('role',$role);     
            }
        }

        $photoSer = new PhotosServer;
        //检查广告在不在缓存
        $key1 = 'photos:data:ad';

        $arr = $photoSer->checkAdDataExists($key1);

        if ($arr['code'] == PhotosServer::FOUND_PHOTO_CODE ) {

            $ad = $arr['data'];

        } else {

            $map['role'] = 2;
            $map['status'] = 1;

            $ad = M('photos')->field('pic,link')->where($map)->find();

            S($key1,$ad);           
        }

        // 检查轮播图在不在缓存
        $key2 = 'photos:data:lunbotu';

        $arr = $photoSer->checkLbtDataExists($key2);

        if ($arr['code'] == PhotosServer::FOUND_PHOTO_CODE ) {

            $momo = $arr['data'];
 
        } else {
            
            $map['role'] = 1;
            $map['status'] = 1;

            $momo = M('photos')->field('pic,link')->where($map)->limit(4)->select();

            S($key2,$momo);              
        }

        //检查一级分类名是否存在
        $typeSer = new TypesServer;

        $key = "pid = 0";

        $arr = $typeSer->checkTypesDataExists($key);

        if ($arr['code'] == TypesServer::FOUND_TYPE_CODE ) {

           $types = $arr['data'];

        } else {

            $types = D('types')->getFatherTypesData();

            $K = 'types:data:'.$key;

            S($K,$types);
        }

         //检查求出三种二级分类名
        $some = D('types')->getSomeTypesData(); 
        foreach ($some as $v) {
            if ($v['pid'] == 1) {

                $arr1[] = $v;
            }
             if ($v['pid'] == 2) {

                $arr2[] = $v;
            }
             if ($v['pid'] == 3) {

                $arr3[] = $v;
            }
        }

        $datass = M('systems')->find();
        // dump($datass);die;
        $this->assign('datas',$datass);

        //四件促销商品
        $data = M('goods')->field('id,name,price,pic,saletime')->where('status= 4')->select();
        
        $ids = array_column($data,'id');
                  
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $this->assign('cuxiaoID',$ids);
        $this->assign('cuxiaoData',$data);
        $this->assign('arr1',$arr1);
        $this->assign('arr2',$arr2);
        $this->assign('arr3',$arr3);
        $this->assign('types',$types);
        $this->assign('ad',$ad);
        $this->assign('momo',$momo);
        $this->display();




    }

    /**
     * ajax通过父类id得到子类数据
     * @return [type] [description]
     */
    public function getSonType()
    {
        if (empty(I('post.cate_id'))) { 

          // echo I('post.');   
            $this->error('非法访问', U('index'));
            exit;
        }
        $id = I('post.cate_id');

        $typeSer = new TypesServer;

        $key = "pid = ".$id;

        //看看在不在缓存
        $arr = $typeSer->checkTypesDataExists($key);

        if ($arr['code'] == TypesServer::FOUND_TYPE_CODE ) {

            $datas = $arr['data'];

            echo json_encode([
                'code' => 1200,
                'msg'  => 'user Found',
                'data' => $datas
            ]);
            exit;
    
        } else {

            $datas = D('types')->getSonTypeData($id);

            if ($datas) {

                //存进缓存
                $K = 'types:data:'.$key;

                S($K,$datas);

                echo json_encode([
                    'code' => 1200,
                    'msg'  => 'sontypedata Found',
                    'data' => $datas
                ]);
                exit;
            }
        
            echo json_encode([
                'code' => 1404,
                'msg'  => 'sontypedata Not Found'
            ]);
            exit;
         
        }


    }

    /**
     * 通过首页绑定滚动事件 ajax拿热销商品数据
     * @return array 热销商品数据
     */
    public function getHotGoods()
    {
        $id = (int)I('post.id');

        $data = D('types')->getSonTypeId($id);

        $map['tid'] = ['in',$data[0][id]];
        $map['status'] = 2;

        $data = D('goods')->getHotGoodsIds($map);  
        foreach ($data as $v) {
            $id = $v['id'];
            $key = 'hotgoods:data:'.$id;
            if (S($key) == false) {
                 $mad['id'] = $v['id'];
                 $data = D('goods')->getHotGoodsData($mad);
                 S($key,$data,600);
   
            
            } else {

                 $data = S($key);
            }

                 $arr[] = $data[0]; 

        }
    
        // foreach ($data as $v) {
        //     $id = $v['id'];
        //          $mad['id'] = $id;
        //          $data = D('goods')->getHotGoodsData($mad);
        //          $arr[] = $data[0];
        // }

        sleep(1);  //睡一秒
        echo json_encode([
                    'code' => 1200,
                    'msg'  => 'hotGoodsData Found',
                    'data' => $arr
                ]);
                exit;    

    }

    public function getRelatedQuery()
    {
        if (empty(I('post.val'))) { 

            $this->error('非法访问', U('index'));
            exit;
        }
        $val = I('post.val');
        // $val = 'sy';
        vendor('xunsearch.lib.XS');
        $xs = new \XS('shop2');
        $search = $xs->search;
        $words = $search->getCorrectedQuery($val, 5);

        echo json_encode([
                    'code' => 1200,
                    'msg'  => 'data Found',
                    'data' => $words
                ]);
                exit;
    }


    public function oodex()
    {
        if (!empty(session('user:data'))) {
            $user = session('user:data');
            $uid = $user['id'];
            $role = $user['role'];
            $account = $user['account'];
            $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
            $account = M('user')->where("id=$uid")->getField('account');
            if ($account) {

                $this->assign('uid',$uid);
                $this->assign('role',$role);     
            }
        }
                    
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $datass = M('systems')->find();
        $this->assign('datas',$datass);
         
        $this->display();

    }

    public function beVip()
    {
        if (empty(I('post.'))) {    
            $this->error('非法访问', U('index'));
            exit;
        }
        $level = I('post.role');
        $user = session('user:data');
        $uid = $user['id'];
        $role = $user['role'];

        if ($role == 3) {

            echo json_encode([
                    'code' => 1200,
                    'row'  => '您已经是终生VIP,不需再办理'
                ]);
                exit;

        } elseif ($role ==2) {

            if ($level == 2) {

                echo json_encode([
                    'code' => 1200,
                    'row'  => '办理成功，已为您再续一年VIP优惠'
                ]);
                exit;

            } else {

                $user = session('user:data');
                session('user:data',null);
                $user['role'] = 3;
                session('user:data',$user);
                $row =M('user')->where("id=$uid")->setField('role',3);
                if ($row) {

                    echo json_encode([
                        'code' => 1200,
                        'row'  => '办理成功，恭喜您成为钻石用户'
                    ]);
                    exit;
                    
                } else {

                     echo json_encode([
                        'code' => 1404,
                        'row'  => '办理失败，服务器繁忙，请晚点办理'
                    ]);
                    exit;


                }




            }
        } else {

             if ($level == 2) {

            
                $user = session('user:data');
                session('user:data',null);
                $user['role'] = 2;
                session('user:data',$user);
                $row =M('user')->where("id=$uid")->setField('role',2);
                if ($row) {

                    echo json_encode([
                        'code' => 1200,
                        'row'  => '办理成功，恭喜您成为vip用户'
                    ]);
                    exit;
                    
                } else {

                     echo json_encode([
                        'code' => 1404,
                        'row'  => '办理失败，服务器繁忙，请晚点办理'
                    ]);
                    exit;


                }

            } else {

                $user = session('user:data');
                session('user:data',null);
                $user['role'] = 3;
                session('user:data',$user);
                $row =M('user')->where("uid=$uid")->setField('role',3);
                if ($row) {

                    echo json_encode([
                        'code' => 1200,
                        'row'  => '办理成功，恭喜您成为钻石用户'
                    ]);
                    exit;
                    
                } else {

                     echo json_encode([
                        'code' => 1404,
                        'row'  => '办理失败，服务器繁忙，请晚点办理'
                    ]);
                    exit;


                }

            }

        }


        
    }


}

    

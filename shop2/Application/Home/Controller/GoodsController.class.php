<?php

namespace Home\Controller;

use Think\Controller;

use Home\Server\GoodsServer;

class GoodsController extends BaseController 
{
    /**
     * showDetailView 显示商品详情页面
     * @Author    林泽钦
     * @DateTime  2017-12-16
     * 先判断商品是否是热销商品，是热销商品去Memache缓存中拿数据，否则去数据库取数据，并将数据放到缓存中。查询数据库得到数组信息加载到模板里
     */
    public function showDetailView()
    {
        if (empty(I('get.id'))) {

          $this->error('Index/index');
          exit;
        }

        if (!empty(session('user:data'))) {
        $user = session('user:data');
        $uid = $user['id'];
        $account = $user['account'];

        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
       
        } 
        
        
        
        $id  = I('get.id');
        $res = M('goods')->where('id='.$id)->setInc('clicknum');
        $pid = M('goods_types t')->field('pid')->join('think_goods g on g.tid = t.id')->where($id)->find();
        $map['pid'] = $pid['pid'];
        $tid = M('goods_types')->field('group_concat(id) id')->where($map)->select();

        $mat['tid'] = ['in',$tid[0]['id']];

                             

        $ids =  M('goods')->field('id')
                          ->order('buynum desc')
                          ->limit(3)
                          ->where($mat)
                          ->select();

                         

        $a = array_map('current', $ids);
    

        if (!in_array($id, $a)) {

            $base = M('goods')->field('id,name,price,pic,buynum')->where()->find($id);

            $other = M('goods_color c')
                    ->field('c.id,c.color,s.size,s.num,g.price')
                    ->join('think_goods_size s on s.cid = c.id')
                    ->join('think_goods g on g.id = c.gid')
                    ->where("g.id =".$id)
                    ->select();

          

            $colors = array_column($other,'color','id');

            // dump($colors);exit;

            $size = array_unique(array_column($other,'size'));
            $goodsData = $base;

            // dump($other);


        } else {
            
            $GoodsSer = new GoodsServer;

            $goodsData = $GoodsSer->getDetailDatas($id);

            $colors = array_column($goodsData['data'][1],'color','id');
           
            $size =  array_unique(array_column($goodsData['data'][1],'size'));
            $goodsData = $goodsData['data'][0];
      
            // dump($colors);exit;
            // dump($size);exit;
        }

            


        $size = array_unique($size); 


        if ($goodsData['code'] == GoodsServer::NOT_FOUND_GOODS_CODE) {

            $this->error('Index/index');
            exit;
        }
        $datass = M('systems')->find();

        $datass['title'] = $goodsData['name'].'-'.$datass['title'];

        $this->assign('datas',$datass);


        
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $this->assign('color',$colors);
        $this->assign('size',$size);
        $this->assign('goodsBaseData',$goodsData);


        $this->display('Goods/detail');
    }

    /**
     * [showwSalesDetailView 显示促销商品详情页面]
     * @Author    林泽钦
     * @DateTime  2017-12-16
     * 去数据库取数据。查询数据库得到数组信息加载到模板里
     */
    public function showwSalesDetailView()
    {
        $id  = I('get.id');

        $res = M('goods')->where('id='.$id)->setInc('clicknum');

        $saletime = strtotime(urldecode(I('get.saletime')));

        $nowtime = time();

        $time = $saletime-$nowtime;
        
        $base = M('goods')->field('id,name,price,pic,buynum')->where()->find($id);


        $other = M('goods_color c')
                ->field('c.id,c.color,s.size,s.num,g.price')
                ->join('think_goods_size s on s.cid = c.id')
                ->join('think_goods g on g.id = c.gid')
                ->where("g.id =".$id)
                ->select();
        // dump($other);
        // dump($base);
        
        $colors = array_column($other,'color','id');

        // dump($colors);

        $size = array_unique(array_column($other,'size'));

        $size = array_unique($size);

        $goodsData = $base;
        $datass = M('systems')->find();

        // $count = M('goods_assess')->where('gid='.$id)->count('gid');

        // echo M('goods')->getLastSql();exit;
        
        $this->assign('datas',$datass);

        $this->assign('count',$count);
         

        $this->assign('size',$size);

        $this->assign('saletime',$time);

        $this->assign('color',$colors); 

        $this->assign('goodsBaseData',$goodsData);

        $this->display('Goods/salesdetail');
    }

    /**
     * [handlerAjaxComment 通过ajax异步加载商品的评价信息]
     *  @Author    林泽钦
     * @DateTime  2017-12-16
     * @return [json] 如果有对应的商品评价信息，返回['code'=>1200,'msg'=>'GET COMMENT success', 'data'=>$commentData,]);没有则返回['code'=>1404,'msg'=>'NOT GET COMMENT Data',]);
     */
    public function handlerAjaxComment()
    {
        $gid = I('post.gid');
        $commentData = M('goods_assess')
                       ->field('think_goods_assess.uid,think_goods_assess.gid,size,color,think_goods_assess.content,time,level,think_user.account account,think_goods_reply.content content1')
                       ->join('LEFT JOIN __USER__ on __GOODS_ASSESS__.uid = __USER__.id')
                       ->join('LEFT JOIN __GOODS_REPLY__ on __GOODS_ASSESS__.id = __GOODS_REPLY__.aid')
                       ->where([
                        'think_goods_assess.gid'=>$gid,
                        'think_goods_assess.status'=>1
                        ])
                       ->select();
        
        if ($commentData) {
            echo json_encode([
                'code'=>1200,
                'msg'=>'GET COMMENT success',
                'data'=>$commentData,
            ]);
            exit;
        }

             echo json_encode([
                    'code'=>1404,
                    'msg'=>'NOT GET COMMENT Data',
                ]);
                exit;

    }

    /**
     * [handlerAjaxBuynum 通过ajax判断商品的对应的库存]
     * @Author    林泽钦
     * @DateTime  2017-12-16
     * @return [json] 商品对应的库存$num
     */
    public function handlerAjaxBuynum()
    {

        $colorid =I('post.color');

        $size =I('post.size');

        $num = M('goods_size')->field('num')
                              ->where([
                                'cid'=>$colorid,
                                'size'=>$size,])
                              ->select();
        // dump($num);

        echo json_encode([
            'num'=>$num,
         ]);
    }

    /**
     * [handlerAjaxSize 通过ajax得到商品颜色有的尺码
     * @Author    林泽钦
     * @DateTime  2017-12-16
     * @return [json]   商品对应的尺码$size
     */
    public function handlerAjaxSize()
    {
        $colorid = I('post.color');

        $size = M('goods_size')->field('think_goods_size.size')
                               ->where(['cid'=>$colorid])
                               ->select();


        echo json_encode([
            'size'=>$size,
        ]);
    }

    /**
     * [handlerAjaxPic ajax拿到商品颜色对应的图片]
     * @Author    林泽钦
     * @DateTime  2017-12-16
     * @return [json]   商品对应的图片$pic
     */
    public function handlerAjaxPic()
    {
        $colorid = I('post.color');


        $pic = M('goods_color')->field('pic')
                               ->where(['id'=>$colorid])
                               ->select();
        
        echo json_encode([
            'pic'=>$pic,
        ]);
    }

    /**
     * [handlerAjaxPhoto ajax拿到商品对应的图片集
     * @Author    林泽钦
     * @DateTime  2017-12-16
     * @return [json]   如果有商品图片集，返回['code'=>1200,'photos'=>$photos]);
     *没有则返回['code'=>1404,]);
     */
    public function handlerAjaxPhoto()
    {
        $gid = I('post.gid');

        $map['gid'] = $gid;

        $photos = M('goods_photo')->where($map)->select();

        // echo M('goods_photo')->getLastSql();exit;

        if ($photos) {
            echo json_encode([
                'code'=>1200,
                'photos'=>$photos
            ]);
            exit;
        }
        
         echo json_encode([
                'code'=>1404,
            ]);
            exit;
    }

    /**
     * handlerCuXiaoGoodsData ajax处理促销商品超卖问题
     *  @Author    林泽钦
     * @DateTime  2017-12-20
     * @return 没登录返回['code'=>1404,'msg'=>'没登录'],抢购失败返回['code'=>1606,'msg'=>抢购失败],抢购成功返回['code'=>]
     */
    public function handlerCuXiaoGoodsData()
    {
        if (empty($_SESSION['user:data']['id'])) {

            echo json_encode([
                'code' => 1404,
                'msg'  => '没登录',
            ]);
            exit;
        }

        $buynum = I('get.buynum');

        $stock = I('get.stock');

        $color = I('get.cid');

        $size = I('get.sid');

        if ($stock == 0) {
             echo json_encode([
                'code' => 1606,
                'msg'  => '秒杀结束',
            ]);
            exit;
        }

        $res = new GoodsServer;

        $redisStock = $res->handlerStock($stock);

        $redis = new \redis();

        $redis->connect(C('REDIS_HOST'), C('REDIS_PORT'));

        $count=$redis->rpop('goods_store');
        if (!$count) {
            echo json_encode([
                'code' => 1606,
                'msg'  => '秒杀结束',
            ]);
            exit;
        }
        $data['num'] = $stock - 1;

        $num = M('goods_size')->where([
                                'cid'=>$color,
                                'size'=>$size,])
                              ->save($data);

        if ($num) {
            echo json_encode([
                'code' => 1200,
                'msg'  => '抢购成功',
            ]);
            exit;
        } else {
            echo json_encode([
                'code' => 1606,
                'msg'  => '抢购失败',
            ]);
            exit;
        }

    }

    //ajax处理收藏
    public function handlerCollectAjax()
    {

        if (empty($_SESSION['user:data']['id'])) {

            echo json_encode([
                'code' => 1404,
                'msg'  => '没登录',
            ]);
            exit;
        }

        $data['user_id'] = $_SESSION['user:data']['id'];

        $data['goods_id'] = I('get.gid');

        $affectedRow = M('goods_collect')->add($data);

        if ($affectedRow) {
            echo json_encode([
                'code' => 1200,
                'msg'  => '收藏成功',
            ]);
            exit;  
        } else {
            echo json_encode([
                'code' => 1606,
                'msg'  => '收藏失败',
            ]);
            exit;
        }


    }

}
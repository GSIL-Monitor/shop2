<?php

namespace Home\Controller;

use Think\Controller;

use Common\Server\Search;

class ListController extends BaseController
{
	public function index() 
	{  
        if (!empty(session('user:data'))) {
        $user = session('user:data');
        $uid = $user['id'];
        $account = $user['account'];

        $datai = M('user_detail')->field('pic,uid,name')->where("uid=$uid")->find();
       
        } else {
            $datai['pic'] = [];
            $datai['name'] = [];
            $account = [];
        }

        //列表面包屑的id和名字
        $lid = I('get.id');
        $bqname = I('get.bqname');
        
        // dump( $bqname);die;
        //接受上一个页面
        $onUrl = $_SERVER["HTTP_REFERER"];
        $onUrl = urldecode($onUrl);
           
        //如果标签有值传递
        if($bqname){

            //如果标签传值里id为空
            if ($lid == 'color') {
         
                //处理网址
                $dell = "/color/{$bqname}";
                $delUrl = str_replace($dell,"",$onUrl);
            
                //跳转网址
                redirect($delUrl);

            }
   
             //传过来的值进行搜索
            $typeA = M('goods_types')->field('id,name')->where("id = $lid and name = '$bqname' ")->select();
            $brandB = M('goods_brand')->field('id,name')->where("id = $lid and name = '$bqname' ")->select();

            //如果分类数组有值
            if($typeA){

                //处理网址
                $dell = "/tid/{$lid}";
                $delUrl = str_replace($dell,"",$onUrl);
         
                //跳转网址
                redirect($delUrl);

            }

            //如果品牌数组有值
            if($brandB){

                //处理网址
                $dell = "/bid/{$lid}";
                $delUrl = str_replace($dell,"",$onUrl);

     
                //跳转网址
                redirect($delUrl);

            }

        }

        //判断搜索框有没有传来值
        if (strlen(trim(I('get.keyword'))) > 0) {

            $search = new Search('shop2');

            $keyword = I('get.keyword');

            $result = $search->find('name:'.$keyword);

            $zx = array_column($result,'id');

            $result1 = join(',',$zx);

            $mat['id'] = ['in',$result1];
        
        }


        $order = urldecode(I('get.order'));  

        $order = empty($order) ? 'addtime':$order;

        //拿出已有的品牌以及颜色数据
        $brandShow = M('goods_brand')->field('name,logo,id')->where('status=1')->limit(6)->order('addtime desc')->select();

        $fenlei = [];

        if (!empty( I('get.tid'))) {
            
            $id = I('get.tid');

            $typedatas = M('goods_types')->field('id,name,pid')->where("id=$id")->select(); 
        
            if ($typedatas[0]['pid'] == 0) { 

                $map['pid'] = $id;

                $typedatas = M('goods_types')->field("id,name")->where($map)->select();

                $id= join(',',array_column($typedatas,'id'));
                
            }   else {

                $fenlei = array_merge($typedatas,$fenlei);
                $typedatas = [];
            }

        } else {

            $typedatas = M('goods_types')->field('id,name,pid')->where("pid <> 0")->select(); 
        } 

        if (!empty(I('get.bid'))) {

            $mat['bid'] = I('get.bid');
            $brandid = I('get.bid');

            $brand = M('goods_brand')->field('id,name')->where("id = $brandid")->find();

            $fenlei[] = $brand; 
            $brandShow = [];

        }

        if (!empty( I('get.tid'))) {

            $mat['tid']  = array('in',$id);
        }

        if (!empty( I('get.num1')) || !empty( I('get.num2'))) {

            $num1 = I('get.num1');
            $num2 = I('get.num2');

            if (!empty($num1) && !empty($num2) ) {
                $mat['price'] = ['between',[$num1,$num2]];
            }  
            if (empty($num1)) {
                $mat['price'] = ['lt',$num2];
            }  
            if ( empty($num2) ) {
                $mat['price'] = ['gt',$num1];
            }
            
        }

        if (!empty(I('get.color'))) {    
            $mii = I('get.color');    
            $map['color'] = $mii;
            $cid = M('goods_color')->field('group_concat(gid) gid')->where($map)->find();
            if (!empty($zx)) {
                $arr2 = explode(',',$cid['gid']);
                $zx = array_intersect($zx,$arr2);
                $aaz = join(',',$zx);
                $mat['id'] = ['in',$aaz];
    
            } else {

                $mat['id'] = ['in',$cid['gid']];
            }

            $fenlei[] = ['name'=>I('get.color'),'id'=>'color']; 
       
           
        }
        $mat['status'] = 2;
        
         if(strlen(trim(I('get.keyword'))) > 0){

            if (empty($zx)) {
                $goods = [];
            } 
         }


        $goods = D('goods')->getGoodsDatas($mat,$order); 
        $vid = join(',',array_column($goods,'id'));
        $man['gid'] = ['in',$vid];
        $colors = D('goods')->getGoodsColor($man);

        if (!empty(I('get.color'))) {   
            $colors = [];
        }
        $total = count($goods);

        $Page = new \Think\Page($total, 5);

        $list = array_slice($goods, $Page->firstRow, $Page->listRows);


        $Page_show = $Page->show();

        $datass = M('systems')->find();
        
        $this->assign('datas',$datass);
        $this->assign('picc',$datai['pic']);
        $this->assign('username',$datai['name']);
        $this->assign('account',$account);   
        $this->assign('page_show',$Page_show);
        $this->assign("list",$list);
        $this->assign("total",$total);
        $this->assign("fenlei",$fenlei);
        $this->assign("typedatas",$typedatas);
        $this->assign("colors",$colors);
        $this->assign("keyword",I('get.keyword'));
        $this->assign("brandShow",$brandShow);
        $this->assign("id",I('get.tid'));
        $this->assign("bid",I('get.bid'));
        $this->assign("color",I('get.color'));
        $this->assign("num1",I('get.num1'));
        $this->assign("num2",I('get.num2'));

		$this->display();

	}





}
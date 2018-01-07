<?php

namespace Admin\Controller;

use Think\Controller;
use Common\Server\CommonServer;
use Common\Server\Search;
/**
 * 商品管理类
 */
class GoodsController extends BaseController 
{

    protected $goods;
    public function __construct()
    {
        parent::__construct();
        $this->goods = D('goods');
    }

    /**
     * 显示商品列表
     */
    public function index()
    {
         if (IS_POST) {
           
            $bid = I('post.shop_brand');
            $like = I('post.search');
            if ($like) {
              $mad['name'] = ['like','%'.$like.'%'];  
              $this->assign('goodsname',$like);
            } 
            if ($bid) {
                $mad['bid'] = $bid;
                $this->assign('bid',$bid);
            } 

       
        } 

        $data = $this->goods->getGoodsList($mad); 

        $num = count($data);
        $page = new \Think\Page($num, 3);

        $list = array_slice($data, $page->firstRow, $page->listRows);  

        $pageBtn = $page->show();
        $brand = D('Brand');


        $dataBrand = $brand->getAllBrandData(); 

        $this->assign('data',$list);
        $this->assign('brand',$dataBrand);
        // $this->assign('dataType',$dataType);
        $this->assign('pageBtn',$pageBtn);
        $this->assign('count',$num);
        // dump($data[0]);
        $this->display('showgoods');
    }

  



    /**
     * 商品添加
     */
    public function addgoods()
    { 
        if (IS_GET) {

            $brand = D('Brand');
            $data = $brand->getAllBrandData(); 
            $dataType = M('goods_types')->where('pid=0')->getField('id, pid, name');      
            $this->assign('data',$data);
            $this->assign('dataType',$dataType);
            $this->display('addgoods');
            
        } else {

            $upload = new CommonServer;

            $info = $upload->handlerUploads();

            if ($info['code'] == 1404) {
                echo json_encode([
                        'code'=>1404,
                        'msg'=>$info['msg'],
                    ]);
                    exit;
            } else {
                $map['id'] = I('post.shop_brand');
                $tname = M('goods_brand')->where($map)->getField('name');
                $data = [
                    'name'=>'【'.$tname.'】'.I('post.shop_name'),
                    'tid'=>I('post.shop_type'),
                    'bid'=>I('post.shop_brand'),
                    'price'=>number_format(I('post.price'), 2),
                    'pic'=>$info[0],
                    'status'=>I('post.status'),
                    'status'=>I('post.status'),
                    'saletime'=>str_replace('T',' ',I('post.saletime')).':00',
                 ];
            }

            $result = $this->goods->uploadDate($data);
            
            $search = new Search('shop2');
            $tete['id'] = $result;
            $tete['name'] = $data['name'];
            //将商品数据查到讯搜
            $search->addDocumentData($tete);
            // $search->delDocumentData(['1','2']);
            if ($result) {
                // $this->success('新增成功', 'index');
                echo json_encode([
                        'code'=>1200,
                        'msg'=>'Uploaded Success',
                    ]);
                //上传图片到数据库
                $photos = [];
                foreach ($info as $value) {
                    $photos[] = [
                        'gid'=>$result,
                        'photo'=>$value
                    ];
                }
                $photo = M('goods_photo');
                $photo->addAll($photos);
            }else{
                echo json_encode([
                        'code'=>1404,
                        'msg'=>$info['msg'],
                    ]);
            }

            
        }


    }

    /**
     * 修改商品
     */
    public function editGoods()
    {
        if (IS_GET) {

            $id = I('get.id');

            $info = $this->goods->where('id='.$id)->find();
            // dump($info);
            // exit;
            $dataType = M('goods_types')->where('pid=0')->getField('id, pid, name');
            // exit;
            $brand = D('Brand');
            $data = $brand->getAllBrandData();
            // dump($data);
            $this->assign('dataType',$dataType);
            $this->assign('data',$data);
            $this->assign('info',$info);
            $this->display('editgoods');
          
        } else {
            
            $upload = new CommonServer;

            $info = $upload->handlerUploads();

            $data = [];

            if ($info['code'] == 1200) {
                $data = [
                    'name'=>I('post.shop_name'),
                    'tid'=>I('post.shop_type'),
                    'bid'=>I('post.shop_brand'),
                    'price'=>number_format(I('post.price'), 2),
                    'pic'=>$info['data'],
                    'sorce'=>I('post.sorce'),
                    'status'=>I('post.status'),
                    'saletime'=>str_replace('T',' ',I('post.saletime')).':00',
                ];

            } else {
                $data = [
                    'name'=>I('post.shop_name'), 
                    'tid'=>I('post.shop_type'),
                    'bid'=>I('post.shop_brand'),
                    'price'=>number_format(I('post.price'), 2),
                    'sorce'=>I('post.sorce'),
                    'status'=>I('post.status'),
                    'saletime'=>str_replace('T',' ',I('post.saletime')).':00',
                ];
            }

            $result = $this->goods->updateDate(I('post.id'),$data);
            // echo json_encode($this->goods->getLastSql());exit;
            if ($result) {

                $momo['id'] = I('post.id');
                $momo['name'] = $data['name'];
                $search = new Search('shop2');
                //将讯搜商品数据修改
                $search->editDocumentData($momo);
                echo json_encode([
                        'code'=>1200,
                        'msg'=>'Uploaded Success',
                    ]);
            }else{
                // echo json_encode($result);exit;
                echo json_encode([
                        'code'=>1404,
                        'msg'=>'修改失败或与原来数据一致',
                    ]);
            }
        }

    }



    /**
     * 删除商品
     */
    public function deleteGoodsData()
    {
        $id = I('get.id');

        // echo $id;
        $res = $this->goods->delGoods($id);

        if ($res) {

            $search = new Search('shop2');
            //将讯搜商品数据修改
            $search->delDocumentData($id);
        }
        if ($res) {
            echo json_encode([
                'code'=>1200,
            ]);
        }else{
            echo json_encode([
                'code'=>1404,
            ]);
        }

    }


    /**
     * 显示商品属性
     */
    public function attr()
    {
        $id = I('get.id');
        if (!$id) {
            $this->error('无商品编号');
            exit;
        }
        $color = M('goods_color');

        $info = $color->where('gid='.$id)->select(); 

        $this->assign('gid',$id);
        $this->assign('info',$info);
        $this->display();
    }

    /**
     * 添加属性页
     */
    public function addAttr()
    {
        if (IS_GET) {

            $id = I('get.id');  

            $this->assign('id',$id);
            $this->display('addattr');
        } else {

            $upload = new CommonServer;

            $file = $upload->handlerUploads();//上传图片颜色

            // dump($file);exit;

             if ($file['code'] == 1404) {
                
                $this->error($file['msg']);//图片未上传成功,返回
                exit;
            }

            if (empty(I('post.color'))) {
               $this->error('未选择颜色');
            }
            if (!(I('post.size1') || 
                I('post.size2') || 
                I('post.size3'))) {
                $this->error('至少选择一种尺寸');//判断选了几个尺寸
            }
            //判断是否选相同尺寸
            $res1 = false;
            if (I('post.size1') == I('post.size2')) {
                $res1 = true;
            }
            $res2 = false;
            if (I('post.size1') == I('post.size3')) {
                $res2 = true;
            }
            $res3 = false;
            if (I('post.size2') == I('post.size3')) {
                $res3 = true;
            }

            $cData = [
                'gid'=>I('post.id'),
                'color'=>I('post.color'),
                'pic'=>$file[0],
            ];

            $mColor = M('goods_color');

            $mColor->startTrans();//开启事务,commit()提交,rollback()回滚

            $cid = $mColor->add($cData);
            $sData = [];
            if ($cid) {

                if (I('post.size1')) {
                    if (I('post.num1') ) {
                       $sData[] = [
                         'cid'=>$cid,
                         'size'=>I('post.size1'),
                         'num'=>I('post.num1')
                        ]; 
                    }else{
                        $sData[] = [
                         'cid'=>$cid,
                         'size'=>I('post.size1'),
                         'num'=>0 //未填写数字默认0
                        ];
                    }
                }
             
                if (I('post.size2') && !$res1) {
                    if (I('post.num2')) {
                       $sData[] = [
                         'cid'=>$cid,
                         'size'=>I('post.size2'),
                         'num'=>I('post.num2')
                        ]; 
                    }else{
                        $sData[] = [
                         'cid'=>$cid,
                         'size'=>I('post.size2'),
                         'num'=>0//未填写数字默认0
                        ];
                    }
                }

                if (I('post.size3') && !$res2 && !$res3) {
                    if (I('post.num3')) {
                       $sData[] = [
                         'cid'=>$cid,
                         'size'=>I('post.size3'),
                         'num'=>I('post.num3')
                        ]; 
                    }else{
                        $sData[] = [
                         'cid'=>$cid,
                         'size'=>I('post.size3'),
                         'num'=>0//未填写数字默认0
                        ];
                    }
                }
                $mSize = M('goods_size');

                $sid = $mSize->addAll($sData); //添加属性

                if ($sid) {
                    $this->success('新增成功', 'index');
                    $mColor->commit();
                }else{
                    $this->error('添加失败');
                    $mColor->rollback();
                }

            }

            
        }

    }


    /**
     * 显示修改属性页
     * @return [type] [description]
     */
    public function editSize()
    {
        if (IS_GET) {

            $id = I('get.id');

            $size = M('goods_size');

            $info = $size->where('id='.$id)->field('id,size,num')->find();

            // dump($info);exit;
            $this->assign('info',$info);
            $this->display('editsize');
        } else {
            
            // dump(I('post.'));
            $size = M('goods_size');
            
            $result = $size->save(I('post.'));

            if ($result) {
                $this->success('修改成功','index');
            }else{
               $this->error('修改失败或数据未改变');
            }
        }
    }




    /**
     * 删除颜色属性
     */
    public function delColorAttr()
    {

        // echo 1111;
        // echo I('get.id');exit;
        $id = I('get.id');

        $photo = M('goods_color');

        $res = $photo->where('id='.$id)->delete();
        // $info = $photo->where('gid=1')->select();

        if ($res) {
            echo json_encode([
                'code'=>1200,
            ]);
        }else{
            echo json_encode([
                'code'=>1404,
            ]);
        }
    }


}

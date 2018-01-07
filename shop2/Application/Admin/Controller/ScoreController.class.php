<?php

namespace Admin\Controller;

use Think\Controller;


class ScoreController extends BaseController 
{
    public function index()
    {
        if (!empty(I('get.names'))) {
            $name = I('get.names');
            $map['account'] = ['like',"%$name%"];
            $map['status'] = 1;
            $this->assign('name',$name);  

        } else {
            $map['status'] = 1;
    
        }
        $user = D('user')->getUserScoreData($map);
        $total = count($user);

        $this->assign('total',$total);  
        $this->assign('user',$user);  

        $this->display();
    }



    public function getScoreDetail()
    {
        if (empty(I('get.uid')) || empty(I('get.name'))) { 

            $this->error('非法访问', U('Index/index'));
            exit;
        }
        // I('post.uid') = 5;  
      
        $uid = I('get.uid');
        // $uid = 5;
        // dump($uid);
   
        $datas = M('user_score u')->field('s.desc,s.score,u.addtime')->join('think_score s on s.id = u.sid')->where("state = 1 and uid = $uid")->select();
        // $datass = M('user_score')->getLastSql();

        $pp = M('user_score')->field('desc,score,addtime')->where("uid = $uid and state = 2")->select();
        $datas = array_merge($datas,$pp);
        // dump($pp);
        $arr1 = array_map(create_function('$n', 'return $n["addtime"];'), $datas);
        array_multisort($arr1,SORT_DESC,$datas);//

        $data = [];
        $user = ['uid'=>I('get.uid'),'aname'=>I('get.name')];
        // $user = ['id'=>5,'name'=>'xiaoqiuo'];
        foreach ($datas as $value) {
            $data[] = array_merge($user,$value);        
        }
        $this->assign('data',$data);
        $this->display('detail');

       
    }

    public function rule()
    {
        $datas = M('score')->field('id,desc,score,content')->select();
        $total = count($datas);
        $this->assign('total',$total); 
        $this->assign('datas',$datas);

        // dump($datas);die;   
        $this->display();
    }

    public function doAddScoreRule()
    {
       
        $data['desc'] = I('post.desc'); 
        $data['score'] = I('post.score'); 
        if (!empty(I('post.content'))) {
            $data['content'] = I('post.content'); 
            
        }
        $row = M('score')->add($data);
        if ($row) {
            $this->success('添加成功');
        }
    }

    public function editRule()
    {
        if (IS_GET) {

            $id = I('get.id');

            $data = M('score')->field('id,desc,score,content')->where("id = $id")->find();

            $this->assign('data',$data);
            $this->assign('id',$id);
            $this->display('editrule');
        } else {
            $id = I('post.id');
            $data['desc'] = I('post.desc'); 
            $data['score'] = I('post.score'); 
            if (!empty(I('post.content'))) {
                $data['content'] = I('post.content'); 
                
            }

            $row = M('score')->where("id=$id")->save($data);
            if ($row) {
                $this->success('修改成功','rule');
            } else {
                $this->error('修改失败');
            }

        }
    }

    public function delScoreRule()
    {
    
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }
        $id = I('post.id');
        $map['id']  = $id;
        $affectedRow = M('score')->where($map)->delete();
        $map = [];
        $map['sid']  = array('in',$id);
        $tt = M('user_score')->where($map)->select();
        if ($tt) {
            $affectedRow2 = M('user_score')->where($map)->delete();
            if ($affectedRow && $affectedRow2) {
                    echo json_encode([
                        'code' => 1200,
                        'msg'  => '删除成功',
                    ]);                                                       
                    exit;
                
            }
        } elseif ($affectedRow) {
            echo json_encode([
                    'code' => 1200,
                    'msg'  => '删除成功',
                ]);                                                       
                exit;
        }
        echo json_encode([
            'code' => 1404,
            'msg'  => '删除失败',
        ]);

    }  




}
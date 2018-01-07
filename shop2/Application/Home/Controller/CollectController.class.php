<?php

namespace Home\Controller;

use Think\Controller;

class CollectController extends BaseController 
{

	protected $collect;//sql对象

	public function __construct()            
	{
		parent::__construct();

		$this->collect = M('goods_collect');    
        if (!session('user:data')) {
            $this->error('请先登录',U('Login/index'));
            exit;
        }
	}
 

    public function index()
    {

        $count = $this->collect->where(['user_id'=>session('user:data')['id']])->count();

        //得到分页对象
        $page = new \Think\Page($count, 4);

        //拿到分页样式
        $show = $page->show();

        $data = $this->collect->where(['user_id'=>session('user:data')['id']])//用户id,正式使用改成传递的id值
        ->limit($page->firstRow,$page->listRows)->order('id desc')
        ->select();
        $this->assign('pageBtn',$show);
        $this->assign('count',$count);
        $this->assign('data',$data);
        $this->display('mylike');
    }

    /** 删除收藏单条 */
    public function delCollect()
    {

        $cid = I('get.cid');

        $res = $this->collect->where('id='.$cid)->delete();
        
        if ($res) {
            echo json_encode([
                'code'=>1200,
                'msg'=>'删除成功'
                ]);
        }else{
            echo json_encode([
                'code'=>1404,
                'msg'=>'服务器异常,请重试'
                ]);
        }
    }

}


    

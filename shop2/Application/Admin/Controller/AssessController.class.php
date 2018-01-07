<?php

namespace Admin\Controller;

use Think\Controller;


class AssessController extends BaseController 
{
	/**
     * [index 显示评论列表页面]
     * @Author    林泽钦
     * @DateTime  2017-12-20
     * 通过D('user')查询数据库得到数组信息加载到模板里
     */
    public function index()
    {
        $assessDatas =  D('assess')->getAssesss($str);

        //将变量$userDatas分配到模板中
        $this->assign('assesss', $assessDatas['data']);

        $this->assign('pagebtn', $assessDatas['pageBtn']);

        $this->assign('count', $assessDatas['count']);

        $this->display('index');
    }

    /**
     * [doReply 显示商家回复评论页面
     * @Author    林泽钦
     * @DateTime  2017-12-20
     * 将通过GET方式获得的数据分配到页面
     */
    public function doReply()
    {
        $aid = I('get.aid');

        $this->assign('aid',$aid);

        $this->display('reply');
    }

    /**
     * [addReply 处理商家回复
     * @Author    林泽钦
     * @DateTime  2017-12-20
     * 将通过post方式提交的数据添加到goods_reply表中，如果添加成功，提示评论成功并返回商家回复列表页面，失败则提示评论失败并返回商家评论页面
     */
    public function addReply()
    {
        $data['aid'] = I('post.aid');
        $data['content'] = I('post.content');

        $affectedRow = M('goods_reply')->add($data);

        if ($affectedRow) {
            $this->success('评论成功',U('showReply'));
        } else {
            $this->error('评论失败',U('reply'));
        }

    }

    /**
     * showReply  显示商家评论列表页面
     * @Author    林泽钦
     * @DateTime  2017-12-20
     * 通过D('assess')查询出来的数据分配到showReply页面
     */
    public function showReply()
    {
        $datas = D('assess')->getReplys();

        // dump($datas['data']);

        $this->assign('reply',$datas['data']);

        $this->assign('pagebtn', $datas['pageBtn']);

        $this->assign('count', $datas['count']);


        $this->display('showReply');
    }

    /**
     * editAssessStatus ajax处理修改评论状态为通过或屏蔽
     * @Author    林泽钦
     * @DateTime  2017-12-20
     * @return json 修改成功返回['code' => 1200,'msg'  => '修改成功',]，修改失败返回['code' => 1404,'msg'  => '修改失败',]
     */
    public function editAssessStatus()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }

        $id = I('post.id');
        $status = I('post.status')==1?2:1;

        $affectedRow = D('assess')->handlerAssessStatus($id, $status);

        if ($affectedRow <= 0) {

            //修改失败
            echo json_encode([
                'code' => 1404,
                'msg'  => '修改失败',
            ]);
            exit;
        }

        echo json_encode([
            'code' => 1200,
            'msg'  => '修改成功',
        ]);
        exit;
    }

    /**
     * delAssessData ajax处理删除买家评论
     * @Author    林泽钦
     * @DateTime  2017-12-20
     * @return json 修改成功返回['code' => 1200,'msg'  => '删除成功',]，修改失败返回['code' => 1404,'msg'  => '删除失败',]
     */
    public function delAssessData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }
        $id = I('post.id');
        $map['id']  = $id;
        $affectedRow = M('goods_assess')->where($map)->delete();
        if ($affectedRow ) {
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

    /**
     * delAssessData ajax处理删除商家评论
     * @Author    林泽钦
     * @DateTime  2017-12-20
     * @return json 修改成功返回['code' => 1200,'msg'  => '删除成功',]，修改失败返回['code' => 1404,'msg'  => '删除失败',]
     */
    public function delReplyData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('showReply'));
            exit;
        }
        $id = I('post.id');
        $map['id']  = $id;
        $affectedRow = M('goods_reply')->where($map)->delete();

        if ($affectedRow) {
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

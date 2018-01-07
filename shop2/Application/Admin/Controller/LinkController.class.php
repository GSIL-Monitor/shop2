<?php

namespace Admin\Controller;

use Think\Controller;
use Common\Server\CommonServer;

class LinkController extends BaseController 
{
	/**
     * [index 显示链接列表页面]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * 通过D('linK')查询数据库得到数组信息加载到模板里
     */
    public function index()
    {
        $name = I('get.name');

        $str = '1=1';
        $name = isset($name) ? $name : '';
        //处理搜索条件
        if ($name !== '') {
            $str .= " and name like '%{$name}%'";
        }

        $linkDatas = D('link')->getLinks($str);

        //将变量$linkDatas分配到模板中
        $this->assign('links', $linkDatas['data']);

        $this->assign('pagebtn', $linkDatas['pageBtn']);

        $this->assign('count', $linkDatas['count']);

        $this->display('index');
    }

     /**
     * [addLink 显示添加链接页面和处理编辑信息]
     * @Author    林泽钦
     * @DateTime  2017-12-06
     * @return    [系统提示信息]
     * 如果是get方式访问则显示编辑页, 否则则处理post过来的数据;
     * 处理数据通过, 则返回成功信息, 否则返回失败。 
     */
    public function addLink()
    {
        if (IS_POST) {
            $LinkModel = D('link');

            if ($LinkModel->create() === false ) {

                //验证没有通过则提示返回
                $this->error($LinkModel->getError());
                exit;
            }

            $obj = new CommonServer();
            $arr = $obj->handlerUploads();


            if ($arr['code'] == 1404) {

                //文件上传失败则提示错误信息并返回
                $this->error($arr['msg'], U('Link/addLink'));
                exit;
            }

            $data = I('post.');
            $data['pic'] = $arr[0];

            $affectedRow = $LinkModel->handlerInsertLink($data);

            if ($affectedRow <= 0) {

                // 插入数据库失败
                $this->error('系统有误, 请尽快联系程序员..', U('Link/addLink'));
            } else {

                //数据插入成功
                $this->success('链接添加成功', U('Link/index'));
            }
        } else {
                $this->display('add');
            }
        
    }
     /**
     * [editLink 显示编辑链接页面和处理编辑信息]
     * @Author    林泽钦
     * @DateTime  2017-12-06
     * @return    [系统提示信息]
     * 如果是get方式访问则显示编辑页, 否则则处理post过来的数据;
     * 处理数据通过, 则返回成功信息, 否则返回失败。 
     */
    public function editLink()
    {
        if (IS_GET) {
            $id = I('get.id');

            if ($id <= 0) {

                $this->error('系统似乎出问题，请联系程序员!');
                exit;
            }

            $linkData = D('link')->getLinkById($id);

            
            $this->assign('link', $linkData);

            $this->display('Link/edit');
        } else {
            $objModel = D('link');

            if ($objModel->create() === false ) {

                //验证没有通过则提示返回
                $this->error($objModel->getError());
                exit;
            }

            $data = I('post.');
            
            if (!$_FILES['pic']['error'] == 4) {

                //如果有上传新的图片走这里
                $obj = new CommonServer();
                $arr = $obj->handlerUploads();

                if ($arr['code'] == 1404) {

                    //文件上传失败则提示返回
                    $this->error($arr['msg'], U('Link/editLink'));
                    exit;
                }

                $data['pic'] = $arr[0];
            } else {
                //没有上传新的图片走这里，读取数据库数据，追加pic字段到$data中
                $id = I('get.id');

                $LinkData = D('link')->getLinkById($id);

                $data['pic'] = $LinkData['pic'];
            }
            // dump($data);exit;
            //修改数据
            $res = D('link')->handlerLinkEdit($data);



            if ($res) {
                $this->success('修改成功', U('index'));
            } else {
                $this->success('你什么也没有改到', U('index'));
            }
        }
    }

     /**
     * [delLink 处理通过ajax提交的数据实现删除链接]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * 用ajax传过来的id通过D('link')删除数据库链接表的数据
     * [系统提示信息]  修改成功或失败返回json_encode信息
     */
    public function delLink()
    {
        $id = I('post.id');


        if ($id <= 0) {

            $this->error('非法ID');
            exit;
        }

        $res = D('link')->delLink($id);

        if (!$res) {

            //删除失败
            echo json_encode([
                'code' => 1404,
                'status' => $status,
                'msg'  => '删除失败',
            ]);
            exit;
        }
            //删除成功
            echo json_encode([
                'code' => 1200,
                'msg'  => '删除成功',
            ]);                           
    }

    /**
     * [handlerStatusData 通过ajax提交处理状态数据]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * 根据post.ment判断禁用或启用, 用ajax传过来的id通过D('link')修改状态;
     * 修改成功或失败都返回json_encode信息
     */
    public function handlerStatusData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }

        $id = I('post.id');
        $status = I('post.status')==1?2:1;

        $affectedRow = D('link')->handlerAjaxStatus($id, $status);

        if ($affectedRow <= 0) {

            //修改失败
            echo json_encode([
                'code' => 1404,
                'msg'  => '修改失败',
            ]);
            exit;
        }
            //修改成功
            echo json_encode([
                'code' => 1200,
                'msg'  => '修改成功',
            ]);
            exit;
    }

    //ajax判断处理链接名是否存在
    public function handlerLinkExist()
    {
        $linkname = I('post.linkname');
        $res = M('link')->where('name='.'"'.$linkname.'"')->find();
        if ($res) {
            echo json_encode([
                'code'=>1200,
                'msg'=>'Linkname FOUND',
            ]);
            exit;
        }
         echo json_encode([
                'code'=>1404,
                'msg'=>'Linkname NOT FOUND',
            ]);
            exit;
    }
}

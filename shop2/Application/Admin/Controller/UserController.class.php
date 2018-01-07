<?php

namespace Admin\Controller;

use Think\Controller;


class UserController extends BaseController 
{
	/**
     * [index 显示用户列表页面]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * 通过D('user')查询数据库得到数组信息加载到模板里
     */
    public function index()
    {
        $name = I('get.name');

        $str = '1=1';
        $name = isset($name) ? $name : '';
        //处理搜索条件
        if ($name !== '') {
            $str .= " and account like '%{$name}%'";
        }

        $userDatas =  D('user')->getUsers($str);

        // dump($userDatas);

        //将变量$userDatas分配到模板中
        $this->assign('users', $userDatas['data']);

        $this->assign('pagebtn', $userDatas['pageBtn']);

        $this->assign('count', $userDatas['count']);

        $this->display('index');
    }


     /**
     * [editUser 显示编辑用户和处理编辑信息
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * @return    [系统提示信息]
     * 如果是get方式访问则显示编辑页, 否则则处理post过来的数据;
     * 处理数据通过, 则返回成功信息, 否则返回失败。 
     */
    public function editUser()
    {
        if (IS_GET) {
            $id = I('get.id');

            if ($id <= 0) {

                $this->error('系统似乎出问题，请联系程序员!');
                exit;
            }

            $userData = D('user')->getUserById($id);


            $this->assign('user', $userData);
            $this->display('edit');
        } else {

            $objModel = D('user');

            if ($objModel->create() === false ) {

                //表示验证没有通过则提示返回
                $this->error($objModel->getError());
                exit;
            }


            //修改数据
            $res = D('user')->handlerUserEdit(I('post.'));

            // dump($res);exit;

            if ($res['0'] || $res['1']) {
                $this->success('修改成功', U('index'));
            } else {
                $this->error('修改失败',U('edit'));
            }
        }
    }

    /**
     * [delUser 处理通过ajax提交的数据实现删除用户]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * 用ajax传过来的id通过D('user')删除数据库链接表的数据
     * [系统提示信息]  修改成功或失败返回json_encode信息
     */
    public function delUser()
    {
        $id = I('post.id');

        if ($id <= 0) {

            $this->error('非法ID');
            exit;
        }

        $res = D('user')->delUser($id);

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
     * 根据post.ment判断禁用或启用, 用ajax传过来的id通过D('user')修改状态;
     * 修改成功或失败都返回json_encode信息
     */
    public function handlerStatusData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }

        $id = I('post.id');
        $email = I('post.email');
        $status = I('post.status')==1?2:1;

        $affectedRow = D('user')->handlerAjaxStatus($id, $status,$email);

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



    //显示添加用户页面
    public function addUser()
    {
        $this->display('add');
    }


    /**
     * [showGradingView 显示用户等级页面]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * 通过D('user')查询数据库得到数组信息加载到模板里
     */
    public function showGradingView()
    {
        $datas = D('user')->doEditGrading();

         //将变量$userDatas分配到模板中
        $this->assign('users', $datas['data']);

        $this->assign('pagebtn', $datas['pageBtn']);

        $this->assign('count', $datas['count']);

        $this->assign('commonUserNum', $datas['commonUserNum']);

        $this->assign('vipUserNum', $datas['vipUserNum']);

        $this->assign('diamondUserNum', $datas['diamondUserNum']);


    	$this->display('grading');
    }

    /**
     * [index 显示用户等级折扣页面]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * 通过M('user_discount')查询数据库得到数组信息加载到模板里
     */
    public function showDiscountView()
    {
        $disCountData = M('user_discount')->select();

        $this->assign('disCount', $disCountData);
        $this->display('showdiscount');
    }

     /**
     * [editDiscount 显示编辑用户对应折扣和处理编辑信息]
     * @Author    林泽钦
     * @DateTime  2017-12-05
     * @return    [系统提示信息]
     * 如果是get方式访问则显示编辑页, 否则则处理post过来的数据;
     * 处理数据通过, 则返回成功信息, 否则返回失败。 
     */
    public function editDiscount()
    {
        if (IS_GET) {
            $role = I('get.role');

            if ($role <= 0) {

                $this->error('系统似乎出问题，请联系程序员!');
                exit;
            }

                $disCountData = M('user_discount')->where(['role'=>$role])->find();

                $this->assign('disCountData', $disCountData);

                $this->display('editdiscount');
            } else {
                $role = I('post.role');

                $discount = I('post.discount');

                // dump(is_number($discount));
                // if (!is_number($discount))

                //修改数据
                $res = M('user_discount')->where('role='.$role)->save(['discount'=>$discount]);

                if ($res) {
                    $this->success('修改成功', U('User/showDiscountView'));
                } else {
                    $this->error('修改失败');
                }
            }
    }
}

<?php

namespace Admin\Controller;

use Think\Controller;
use Common\Server\CommonServer;

class BrandController extends BaseController 
{
    /**
     * [showBrand 显示品牌分类页面]
     * @Author    欧阳学
     * @DateTime  2017-12-04
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * 通过D('Brand')查询数据库得到数组信息加载到模板里
     */
    public function showBrandView()
    {
        $obj = D('Brand');

        $pageData = $obj->handlerPage();

        $this->assign('pageBtn', $pageData['0']);
        $this->assign('pageData', $pageData['1']);
        $this->assign('count', $pageData['2']);
        $this->assign('showCount', $pageData['3']);
        $this->display('brand');
    }

    /**
     * [handlerAddAlsoShowAddView 显示添加页面和处理添加信息]
     * @Author    Hybrid
     * @DateTime  2017-12-04
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [系统提示信息]   
     * 如果是get访问就显示添加品牌页面, 否则则处理post传过来的信息,
     * 如果添加处理信息通过, 则返回成功信息, 否则提示失败           
     */
    public function handlerAddAlsoShowAddView()
    {   
        if (IS_GET) {

    	   $this->display('addbrand');
        } else {

            $objModel = D('Brand');
            if ($objModel->create() === false ) {

                //表示验证没有通过则提示返回
                $this->error($objModel->getError());
                exit;
            }

            $objUpload = new CommonServer();
            $arr = $objUpload->handlerUploads();

            if ($arr['code'] == 1404) {

                //表示文件上传失败则提示返回
                $this->error($arr['msg'], U('Brand/handlerAddAlsoShowAddView'));
                exit;
            }

            $data = I('post.');
            $data['logo'] = $arr[0];   // 从$arr返回值中获取字段logo的值

            //数据审核成功则存放到数据库
            $lastDataId = $objModel->handlerInsertBrand($data);

            if ($lastDataId) {

                //数据插入成功
                $this->success('品牌添加成功', U('Brand/showBrandView'));
            } else {

                $this->error('系统有误, 请尽快联系程序员..', U('Brand/handlerAddAlsoShowAddView'));
            }
        }
    }

    /**
     * [showAlsoHandlerEdit 显示编辑页面和处理编辑信息]
     * @Author    欧阳学
     * @DateTime  2017-12-04
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [系统提示信息]
     * 如果是get方式访问则显示编辑页, 否则则处理post过来的数据;
     * 处理数据通过, 则返回成功信息, 否则返回失败。 
     */
    public function showAlsoHandlerEdit()
    {
        if (IS_GET) {

            $id = I('get.id');

            if (empty($id)) {

                $this->error('非法访问', U('index'));
                exit;
            }

            // 根据ID查询数据
            $brandData = D('Brand')->getEditBrandData($id);

            $this->assign('brandData', $brandData);
            $this->display('edit_brand');  
        } else {

            $objModel = D('Brand');

            // 自动验证
            if ($objModel->create() === false ) {

                // 验证没有通过则提示返回
                $this->error($objModel->getError());
                exit;
            }
            
            $data = I('post.');

            // 判断是否替换了图片
            if (!$_FILES['pic']['error'] == 4) {

                $objUpload = new CommonServer();
                $arr = $objUpload->handlerUploads();

                if ($arr['code'] == 1404) {

                    //表示文件上传失败则提示返回
                    $this->error($arr['msg'], U('Brand/showAlsoHandlerEdit', ['id'=>$data['id']]));
                    exit;
                }

                // 获取字段logo的值
                $data['logo'] = $arr[0];
            }

            //数据审核成功则存放到数据库
            $affectedRow = $objModel->handlerEditBrand($data);

            if ($affectedRow) {

                //数据插入成功
                $this->success('品牌修改成功', U('Brand/showBrandView'));
            } else {

                $this->error('系统有误, 请尽快联系程序员..', U('Brand/showAlsoHandlerEdit', ['id'=>$data['id']]));
            }
        }
    }

    /**
     * [handlerStatusData 通过ajax提交处理状态数据]
     * @Author    欧阳学
     * @DateTime  2017-12-04
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * 根据post.ment判断启用或禁用, 用ajax传过来的id通过D('Brand')修改状态;
     * 修改成功或失败都调用revision方法返回json_encode信息
     */
    public function handlerStatusData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }

        $id = I('post.id');

        // 判断启用或禁用
        if (I('post.ment') == '2') {

            $data['status'] = I('post.status')==1?2:1;
        } else {
            
            $data['status'] = I('post.status')==2?1:2;
        }

        // 根据ID修改状态
        $affectedRow = D('Brand')->handlerAjaxStatus($id, $data);

        $this->revision($affectedRow);
    }

    /**
     * [delBrandData 通过ajax处理删除品牌信息]
     * @Author    欧阳学
     * @DateTime  2017-12-04
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * 根据ajax传过来的id通过D('Brand')删除信息;
     * 删除成功或失败都调用revision方法返回json_encode信息
     */
    public function delBrandData()
    {
        $id = I('post.id');

        // 根据ID删除品牌
        $affectedRow = D('Brand')->handlerDelBrandData($id);

        $this->revision($affectedRow);
    }

    /**
     * [revision  被调用返回json_encode数据]
     * @Author    欧阳学
     * @DateTime  2017-12-04
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @param     bool 或 int    $affected  为真的话走真区间, 否则走假区间
     * @return    json_encode数据
     */
    public function revision($affected)
    {
        if ($affected) {

            // 真语句走这里
            echo json_encode([
                'code' => 1200,
            ]); 
            exit;
        }

        echo json_encode([
            'code' => 1404
        ]);
        exit;
    }
}

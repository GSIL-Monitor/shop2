<?php

namespace Admin\Controller;

use Think\Controller;

use Common\Server\CommonServer;

class TypesController extends BaseController 
{
    /**
     * [showGoodsTypeView 商品分类列表页]
     * @Author    欧阳学
     * @DateTime  2017-12-07
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     *
     * 得到商品分类的信息, 并显示分类信息
     */
    public function showGoodsTypeView()
    {
        $typeDatas = D('Types')->getTypes();
        
        $this->assign('typeDatas', $typeDatas[0]);
        $this->assign('count', $typeDatas[1]);

    	$this->display('Goods/typesshow');
    }

    /**
     * [showTypeViewAlsoHandlerAdd 显示添加分类页与分类的添加操作]
     * @author    欧阳学
     * @DateTime  2017-12-07
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     *
     * GET请求显示分类添加页; 
     * POST请求处理添加数据, 成功返回分类主页, 失败则信息提示
     */
    public function showTypeViewAlsoHandlerAdd()
    {
        if (IS_GET) {

            $id = I('get.id');

            if (!empty($id)) {

                // 根据id查询要添加到那个分类
                $typeData = D('Types')->getTypesById($id);

                $this->assign('typeData', $typeData);
            }

            $this->display('Goods/goods_types_add');

        } elseif (IS_POST) {

            $data = I('post.');

            $stmt = D('Types')->typesAdd($data);

            if ($stmt) {

                $this->success('分类添加成功', U('Types/showGoodsTypeView'));
            } else {

                $this->error('分类添加失败', U(
                    'Types/showTypeViewAlsoHandlerAdd',
                    ['id' => I('post.id')]
                ));
            }
        }

    }

    /**
     * [showEditTypeAlsoHandlerEditData 显示修改分类页与处理修改数据]
     * @author    欧阳学
     * @DateTime  2017-12-07
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * GET请求显示分类编辑页; 
     * POST请求处理编辑数据, 成功返回分类主页, 失败则信息提示
     */
    public function showEditTypeAlsoHandlerEditData()
    {
        if (IS_GET) {

            $id = I('get.id');

            if (empty($id)) {

                $this->error('非法访问', U('Index/home'));
                exit;
            }

            $typeData = D('Types')->getOneTypeDataById($id);

            $stmt = $this->assign('typeData', $typeData);

            $this->display('Goods/goods_types_edit');

        } elseif (IS_POST) {

            if (empty(I('post.id'))) {

                $this->error('非法访问', U('Index/home'));
                exit;
            }

            $affectedRow = D('Types')->typeEdit(I('post.'));

            if ($affectedRow) {

                $this->success('编辑成功', U('Types/showGoodsTypeView'));
            } else {

                $this->error('编辑失败', U('Types/showEditTypeAlsoHandlerEditData'));
            }
        }
    }

    /**
     * [delGoodsTypeData 通过ajax删除商品类型的数据]
     * @author    欧阳学
     * @DateTime  2017-12-07
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    json数据     
     *
     * 同过ajax传过来的id删除对应的数据, 如果该id含有子类, 则错误提示返回
     * 若没有则删除该id的信息, 成功与失败都返回对应的json数据
     */
    public function delGoodsTypeData()
    {
        $id = I('post.id');

        if (D('Types')->getTypesByPid($id)) {
            
            echo json_encode([
                'code' => 1404,
                'msg'  => '请先删除子类',
            ]);
            exit;
        }

        $affectedRow = D('Types')->typeDelById($id);

        if ($affectedRow) {

            echo json_encode([
                'code' => 1200,
                'msg'  => '删除成功',
            ]);
            exit;
        }

        echo json_encode([
            'code' => 1500,
            'msg'  => '删除失败',
        ]);
        exit;
    }
}

<?php

namespace Admin\Model;

use Think\Model;

class BrandModel extends Model
{
    protected $tableName = 'goods_brand';

    // 验证规则
    protected $_validate = [
        ['name', 'require', '品牌名称必填'],
        ['name', '', '品牌名称已存在', 1, 'unique'],
        ['name', '/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u', '用户名不符合'],
        ['desc', 'require', '品牌描述必填'],
        ['desc', '/^[\x{4e00}-\x{9fa5}A-Za-z0-9\!\-\,\;\:\'\"\、\。]{8,50}$/u', '描述填写有误, 字数未够或含特殊符号'],
    ];

    // 根据ID获取编辑品牌信息
    public function getEditBrandData($id)
    {
        return $this->where("id={$id}")
                    ->getField('id, name, logo, desc, status');
    }

    // 添加品牌信息
    public function handlerInsertBrand($data)
    {
        return $this->add($data);
    }

    // 修改品牌信息
    public function handlerEditBrand($data)
    {
        return $affectRow = $this->where("id={$data['id']}")->save($data);
    }

    // 获取品牌信息
    public function getAllBrandData()
    {
        return  $this->where('status = 1')
                     ->getField('id, name, logo, addtime');
    }

    /**
     * [handlerPage 获取分页信息]
     * @Author    欧阳学
     * @DateTime  2017-12-05
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [array]
     * 获取数据总数, 分页按钮与数据
     */
    public function handlerPage()
    {
        // 统计总条数
        $count = $this->count();

        // 统计状态为1 的品牌条数
        $showCount = $this->where('status=1')->count();

        // 实例化分页类并以C('COUNT_NUM')条分页
        $Page = new \Think\Page($count, C('COUNT_NUM'));

        // 分页显示输出
        $show = $Page->show();

        //获取分页数据
        $list = $this->order('id desc')
                     ->limit($Page->firstRow.','.$Page->listRows)
                     ->select();

        return [$show, $list, $count, $showCount];
    }

    // 修改品牌的状态
    public function handlerAjaxStatus($id, $data)
    {
        return $this->where("id={$id}")->save($data); 
    }

    // 根据ID删除品牌信息
    public function handlerDelBrandData($id)
    {
        return $this->delete($id);
    }
}

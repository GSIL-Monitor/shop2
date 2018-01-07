<?php

namespace Admin\Model;

use Think\Model;

class OrdersModel extends Model
{
	public function getOrdersDataPage($data)
    {
        // 统计总条数
        $count = $this->where($data)->count();

        // 统计状态为1 的品牌条数
        $showCount[] = $this->where(['status'=> 1, 'state' => 1])->count();
        $showCount[] = $this->where(['status'=> 2, 'state' => 1])->count();
        $showCount[] = $this->where(['status'=> 3, 'state' => 1])->count();
        $showCount[] = $this->where(['status'=> 4, 'state' => 1])->count();
        $showCount[] = $this->where(['status'=> 5, 'state' => 1])->count();
        $showCount[] = $this->where(['status'=> 6, 'state' => 1])->count();
        $showCount[] = $this->where(['state' => 1])->count();

        // 实例化分页类并以C('COUNT_NUM')条分页
        $Page = new \Think\Page($count, C('COUNT_NUM'));

        // 分页显示输出
        $show = $Page->show();

        //获取分页数据
        $list = $this->field('id, total, status, addtime')
                     ->where($data)
                     ->order(['status', 'id' => 'desc'])
                     ->limit($Page->firstRow.','.$Page->listRows)
                     ->select();

        return [$show, $list, $count, $showCount];
    }

    public function getOrderDetailData($orderId)
    {
        $orderData = M('order_detail')->field('pic, name, price, num, size, color')
                         ->where(['oid' => $orderId])
                         ->select();

        return $orderData;
    }

    public function getAddressData($orderId)
    {
        $ressData = $this->field('id, linkman, address, phone, status, addtime, total')
                         ->where(['id' => $orderId])
                         ->find();

        return $ressData;
    }

    public function updateOrderDataState($orderId, $spot)
    {
        switch ($spot) {
            case 1:
                $data = ['state' => 2];
                break;
            case 2:
                $data = ['status' => 3];
                break;
        }

        return $this->where(['id' => $orderId])->save($data); 
    }
}
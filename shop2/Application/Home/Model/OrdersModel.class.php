<?php

namespace Home\Model;

use Think\Model;

class OrdersModel extends Model
{	
	/**
	 * [insertOrderDetailData 将数据查入订单详情表]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     array      $data [商品ID数据]
	 * @param     int        $oid  [订单的最后一个ID]
	 * @return    array      1200：数据插入成功  1404：插入失败
	 *
	 * 数据的插入：1、startTrans() 开启事务；$spot 是判断事务的唯一标准
	 *             2、遍历购物车中的商品数据
	 *             3、减库存 $updateInfo
	 *             4、插入数据 $affectedRow
	 *             5、成功 $model->commit()
	 *                失败 $model->rollback()
	 */
	public function insertOrderDetailData($data, $oid)
	{
		$model = M('order_detail');
		$model->startTrans();
		$spot = true;

		foreach ($data as $v) {

			$dataArr['oid'] = $oid;
			$dataArr['gid'] = $v['gid'];
			$dataArr['sid'] = $v['sid'];
			$dataArr['name'] = $v['name'];
			$dataArr['pic'] = $v['pic'];
			$dataArr['price'] = $v['price'];
			$dataArr['num'] = $v['number'];
			$dataArr['size'] = $v['size'];
			$dataArr['color'] = $v['color'];

			$updateInfo = M('goods_size')->where(['id' => $v['sid']])
			            				 ->setDec('num', $v['number']); 
			            				 
			if (!$updateInfo) {
				$spot = false;
			}

			$updateBuyNum = M('goods')->where(['id' => $v['gid']])
			                          ->setInc('buynum', $v['number']);

			if (!$updateBuyNum) {
				$spot = false;
			}

			$affectedRow = $model->add($dataArr);
			if (!$affectedRow) {
				$spot = false;
			}
		}

		if ($spot == true) {

			$model->commit();
			return ['code' => 1200];
			exit;
		} else {

			$model->rollback();
			return ['code' => 1404];
		}
	}

	// 将传过来的数据插入数据库，生成订单
	public function insertOrdersModData($data)
	{
		return $this->add($data);
	}

	// 根据$data中的cid、sid查出该商品的库存并进行比较
	public function setDataNum($data)
	{
		$sizeData = M('goods_size')
				  ->where(['cid' => $data['cid'], 'size' => $data['sid']])
				  ->getField('num');

		if ($sizeData < $data['number']) {

			return ['code' => 1404];
		}
	}

	// 获取立即购买商品的信息
	public function getOneGoodsData($data)
	{	
		// 获取sid
		$sizeData = M('goods_size')
				  ->where(['cid' => $data[1], 'size' => $data[2]])
				  ->getField('id');

		// 获取商品的其他数据	
		$goodsData = $this->field('g.price, g.name, c.pic, c.color')
				   ->table([
				   		'think_goods_color' => 'c', 'think_goods_size' 
				   	    => 's', 'think_goods' => 'g'
				   	 ])
				   ->where(['g.id' => $data[0], 'c.id' => $data[1], 's.id' => $sizeData])
				   ->select();

		$goodsData[0]['gid'] = $data[0];
		$goodsData[0]['cid'] = $data[1];
		$goodsData[0]['size'] = $data[2];
		$goodsData[0]['number'] = $data[3];
		$goodsData[0]['sid'] = $sizeData;
		$goodsData[0]['spot'] = $data[3];

		return $goodsData;
	}

	// 获取立即购买商品的详情数据
	public function getOrderOneData($dataId)
	{
		$goodsData = $this->field('g.price, g.name, c.pic, s.size, c.color')
						  ->table([
						   		'think_goods_color' => 'c', 'think_goods_size' 
						   		=> 's', 'think_goods' => 'g'
						   	])
						  ->where([
						   		'g.id' => $dataId['gid'], 
						   		'c.id' => $dataId['cid'], 
						   		's.id' => $dataId['sid']
						   	])
						  ->select();
		
		return $goodsData[0];
	}

	/**
	 * [insertOrderDetailOneData 立即购买操作]
	 * @author    欧阳学
	 * @DateTime  2017-12-22
	 * @param     array      $data 商品信息
	 * @return    array            成功：1200  失败：1404
	 */
	public function insertOrderDetailOneData($data)
	{
		$model = M('goods_size');
		$model->startTrans();
		$spot = true;

		$updateNum = $model->where(['id' => $data['sid']])->setDec('num', $data['num']); 

		if (!$updateNum) {
			$spot = false;
		}

		$updateBuyNum = M('goods')->where(['id' => $data['gid']])->setInc('buynum', $data['num']);

		if (!$updateBuyNum) {
			$spot = false;
		}

		$dataId = M('order_detail')->add($data);

		if (!$dataId) {
			$spot = false;
		}

		if ($spot == true) {

			$model->commit();
			return ['code' => 1200];
			exit;
		} else {

			$model->rollback();
			return ['code' => 1404];
		}
	}

	/**
	 * [getOrderData 获取订单页的信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-22
	 * @param     array      $status  查询的条件
	 * @return    array               订单的数据
	 */
	public function getOrderData($status)
	{
		// 统计总条数
        $count = $this->where($status)->count();

        // 实例化分页类并以C('COUNT_NUM')条分页
        $Page = new \Think\Page($count, C('COUNT_NUM'));

        // 分页显示输出
        $show = $Page->show();

        //获取分页数据
        $list = $this->order(['status', 'id' => 'desc'])
        			 ->field('id, status, addtime')
                     ->where($status)
                     ->limit($Page->firstRow.','.$Page->listRows)
                     ->select();

        return [$show, $list];
	}

	// 获取订单详情数据
	public function getOrderDetailData($orderId)
    {
        return $orderData = M('order_detail')->field('pic, name, price, num, size, color')
				                             ->where(['oid' => $orderId])
				                             ->select();
    }

    // 获取订单数据
    public function getAddressData($orderId, $dataField)
    {
        return $ressData = $this->field($dataField)
	                            ->where(['id' => $orderId])
	                            ->find();
    }

    // 修改订单状态
    public function updateOrderDataState($orderId, $spot)
    {
    	switch ($spot) {
    		case 1:
    			$data = ['state' => 2];
    			break;
    		case 3:
    			$data = ['status' => 4];
    			break;
    		case 4: 
    			$data = ['status' => 6];
    			break;
    		default:
    			$data = ['status' => 2, 'total' => $spot];
    			break;
    	}

        return $this->where(['id' => $orderId])->save($data); 
    }

    // 获取订单总价
    public function getTotalPriceData($orderId)
    {
    	return $this->where(['id' => $orderId])->getField('total');
    }

    // 插入商品评论
    public function addCommentData($data)
    {
    	return M('goods_assess')->add($data);
    }

    // 获取订单金额
    // public function gerTotalData($dataId)
    // {
    // 	$totalArr = M('order_detail')->field('price, num')
				//     		         ->where(['oid' => $dataId])
				//     		         ->select();

    // 	for ($i=0; $i<count($totalArr); $i++) {

    // 		$total += $totalArr[$i]['price']*$totalArr[$i]['num'];
    // 	}
    	
    // 	return $total;
    // }
}
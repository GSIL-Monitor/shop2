<?php

namespace Admin\Controller;

use Think\Controller;

class OrderController extends BaseController
{
	public function showTransactionView()
	{
		$this->display('transaction');
	}

	public function showOrderBoardView()
	{	
		switch (I('get.status')) {
			case '':
				$data = ['state' => 1];
				break;
			case 1:
				$data = ['state' => 1, 'status' => 1];
				break;
			case 2:
				$data = ['state' => 1, 'status' => 2];
				break;
			case 3:
				$data = ['state' => 1, 'status' => 3];
				break;
			case 4:
				$data = ['state' => 1, 'status' => 4];
				break;
			case 5:
				$data = ['state' => 1, 'status' => 5];
				break;
			case 6:
				$data = ['state' => 1, 'status' => 6];
				break;
		}

		$info = D('orders')->getOrdersDataPage($data);

		$this->assign('btn', $info[0]);
		$this->assign('data', $info[1]);
		$this->assign('count', $info[2]);
		$this->assign('counts', $info[3]);
		$this->display('orderform');
	}

	public function showOrderDetailView()
	{
		if (empty(I('get.id'))) {

			$this->error('非法访问', U('Index/home'));
			exit;
		}
		$orderInfo = D('orders')->getOrderDetailData(I('get.id'));
		$orderRessData = D('orders')->getAddressData(I('get.id'));

		$this->assign('orderData', $orderInfo);
		$this->assign('ressData', $orderRessData);
		$this->display('order_detailed');
	}

	public function handlerDelOrder()
	{
		if (empty(I('post.id'))) {

			$this->error('非法访问', U('Index/home'));
			exit;
		}

		$spot = 1;
		$dataInfo = D('orders')->updateOrderDataState(I('post.id'), $spot);

		if ($dataInfo) {

			echo json_encode([
				'code' => 1200,
				'msg'  => '修改成功',
			]);
			exit;
		} else {

			echo json_encode([
				'code' => 1404,
				'msg'  => '系统有误，请尽快联系程序员。。',
			]);
		}
	}

	public function handlerShipperData()
	{
		$spot = 2;
		$dataInfo = D('orders')->updateOrderDataState(I('post.id'), $spot);

		if ($dataInfo) {

			echo json_encode([
				'code' => 1200,
				'msg'  => '发货成功',
			]);
			exit;
		} else {

			echo json_encode([
				'code' => 1404,
				'msg'  => '系统有误，请尽快联系程序员。。',
			]);
		}
	}
}
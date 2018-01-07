<?php

namespace Home\Controller;

use Think\Controller;

use Home\Server\CartServer;

class CartController extends BaseController 
{	
	/**
	 * [showMyCartView 显示未登录和已登录的购物车信息] 
	 * @author 	  欧阳学
	 * @DateTime  2017-12-15
	 * @return    array      购物车信息
	 *
	 * 显示购物信息：1、未登录：通过 getAllRedisData 方法获取购物信息
	 *               2、已登录：通过 loginGetAllUserCartData 方法获取用户购物信息
	 */
	public function showMyCartView()
	{
		$redisObj = new CartServer;

		// 用户未登录时的购物车信息
		if (empty($_SESSION['user:data']['id'])) {

			$cartData = $redisObj->getAllRedisData();
		} else {

			$cartData = $redisObj->loginGetAllUserCartData();
		}

		$this->assign('cartData', $cartData);
		$this->display('mycart');
	}

	/**
	 * [addMyCart 处理用户登录与未登录时的数据存放]
	 * @author 	  欧阳学
	 * @DateTime  2017-12-11
	 *
	 * 存放redis：1、判断是否非法访问
	 *            2、未登录时：通过 handlerAddToCart 方法将数据存放到redis中
	 *               已登陆后：通过 handlerLoginCartData 方法将数据存到redis中
	 *            3、通过 handlerReturnAjaxData 判断是否存入成功
	 *            	    1200：表示成功  1404：表示存入失败
	 */
	public function addMyCart()
	{
		if (empty(I('post.'))) {

			echo json_encode([
				'msg' => '非法访问',
			]);
			exit;
		}

		$data = I('post.');

		$data['sid'] = M('goods_size')->where(['cid' => $data['cid'], 'size' => $data['size']])->getField('id');

		$redisObj = new CartServer;

		// 未登录时
		if (empty($_SESSION['user:data']['id'])) {

			$info = $redisObj->handlerAddToCart($data);
		} else {

			$info = $redisObj->handlerLoginCartData($data);
		}

		$this->handlerReturnAjaxData($info);
	}

	/**
	 * [handlerCartNumber 处理购物车修改购买量操作]
	 * @author    欧阳学
	 * @DateTime  2017-12-15
	 * @return    json_encode      成功前台接收1200数据, 失败接收1606数据
	 *
	 * 处理购买量：1、未登录时（$data['spot'] = 2）
	 * 				  已登录后（$data['spot'] = 1） 
	 * 				    都是调用 loginHandlerCutAndAddCartNum 方法来处理数据
	 * 			   2、返回相应的json数据，并将实际库存返回
	 */
	public function handlerCartNumber()
	{
		$data['uid'] = I('post.uid');
		$data['cid'] = I('post.cid');
		$data['sid'] = I('post.sid');
		$data['number'] = I('post.number');

		$redisObj = new CartServer;

		// 判断是否已登录
		if (empty($_SESSION['user:data']['id'])) {

			$data['spot'] = 2;

			$info = $redisObj->loginHandlerCutAndAddCartNum($data);
		} else {

			$data['spot'] = 1;

			$info = $redisObj->loginHandlerCutAndAddCartNum($data);
		}

		// 判断数据是否通过验证
		if ($info['code'] == 1200) {

			echo json_encode([
				'code' => 1200,
				'msg'  => '修改成功',
				'goodsNum' => $info['goodsNum'],
			]);
			exit;
		} elseif ($info['code'] == 1606) {
			
			echo json_encode([
				'code' => 1606,
				'msg'  => '超库存',
				'goodsNum' => $info['goodsNum'],
			]);
			exit;
		}
	}

	/**
	 * [deleteCartData 处理前台购物车单条删除商品时的操作]
	 * @author    欧阳学
	 * @DateTime  2017-12-15
	 * @return    json_encode      成功返回1200, 失败返回1404
	 *
	 * 处理删除数据：1、未登录时（$data['spot'] = 2）
	 * 				    已登录后（$data['spot'] = 1） 
	 * 				      都是调用 handlerDelCartData 方法来删除数据
	 * 			     2、调用 handlerReturnAjaxData 方法返回相应的json数据
	 */
	public function deleteCartData()
	{
		$data['uid'] = I('post.uid');
		$data['cid'] = I('post.cid');
		$data['sid'] = I('post.sid');

		$redisObj = new CartServer;

		if (empty($_SESSION['user:data']['id'])) {

			$data['spot'] = 2;
			$info = $redisObj->handlerDelCartData($data);
		} else {

			$data['spot'] = 1;
			$info = $redisObj->handlerDelCartData($data);
		}

		$this->handlerReturnAjaxData($info);
	}

	/**
	 * [delAllCartData 删除用户多选的商品信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-15
	 * @return    json_encode     成功返回1200, 失败返回1404
	 * 
	 * 处理多条删除数据：1、未登录时（$data['spot'] = 2）
	 * 				        已登录后（$data['spot'] = 1） 
	 * 				          都是调用 handlerDelAllCartData 方法来删除数据
	 * 			         2、调用 handlerReturnAjaxData 方法返回相应的json数据
	 */
	public function delAllCartData()
	{
		$data = I('post.data');

		$redisObj = new CartServer;

		if (empty($_SESSION['user:data']['id'])) {

			$data['spot'] = 2;
			$info = $redisObj->handlerDelAllCartData($data);
		} else {

			$data['spot'] = 1;
			$info = $redisObj->handlerDelAllCartData($data);
		}

		$this->handlerReturnAjaxData($info);
	}

	// 负责被调用返回给前台相应的json信息
	public function handlerReturnAjaxData($info)
	{
		if ($info['code'] == 1200) {

			echo json_encode([
				'code' => 1200,
			]);
			exit;
		} else {

			echo json_encode([
				'code' => 1404,
				'系统有误, 请尽快修复!!!',
			]);
		}
	}
}
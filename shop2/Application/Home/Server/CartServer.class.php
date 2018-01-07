<?php

namespace Home\Server;

use Home\Model\GoodsModel;

class CartServer
{
	// 得到redis对象
	public function __construct()
	{
		$this->redis = new \Redis();
		$this->redis->connect(C('REDIS_HOST'), C('REDIS_PORT'));
	}

	/**
	 * [handlerAddToCart 处理未登录与登录后的用户的购物车信息存到redis]
	 * @author    欧阳学
	 * @DateTime  2017-12-09
	 * @param     array      $data [商品详情传过来的数据信息]
	 * @return     array      返回错误与正确的信息提示
	 *
	 * redis插入：1、通过 getCartGoodsData 方法获取商品信息
	 */
	public function handlerAddToCart($data)
	{
		$goodsId = $data['gid'];
		$colorId = $data['cid'];
		$sizeId  = $data['sid'];
		$buyNumber = $data['number'];

		$res = new GoodsModel();
		$goodsData = $res->getCartGoodsData($goodsId, $colorId, $sizeId);

		// hash键名
		$key = 'cart:'.session_id().':'.$goodsId.':'.$colorId.':'.$sizeId;

		// 集合键名
		$keyId = 'cart:ids:set:'.session_id();

		$info = $this->redis->exists($key);

		if (!$info) {

			$goodsData['number'] = $buyNumber;

			// 插入redis(hash)
			$insertData = $this->redis->hmset($key, $goodsData);  // 此处应有错误记录

			// 设置有效时间
			$this->redis->expire($key, 3600*24*7);

			$dataId = $goodsId.':'.$colorId.':'.$sizeId;

			// 插入队列
			$insertMuster = $this->redis->lPush($keyId, $dataId);

			// 设置有效时间
			$this->redis->expire($keyId, 3600*24*7);
			$this->redis->expire($insertMuster, 3600*24*7);

			// 设置cookie_id的有效时间
			$this->modifySessionIdTime();

			// 判断插入是否成功
			return $this->handlerInsertMusterInfo($insertMuster); exit;
		} else {

			$originNum = $this->redis->hget($key, 'number');

			$newNum = $originNum + $buyNumber;

			// 判断插入是否成功
			$modifyData = $this->redis->hset($key, 'number', $newNum);

			// 修改redis中hash与集合的有效时间
			$this->redis->expire($key, 3600*24*7);
			$this->redis->expire($keyId, 3600*24*7);

			// 设置cookie_id的有效时间
			$this->modifySessionIdTime();

			// 判断是否修改成功
			return $this->handlermodifyDataInfo($modifyData); exit;
		}
	}

	/**
	 * [handlerLoginCartData  处理登录后用户加入购物车的信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-11
	 * @param     array      $data [商品详情传过来的数据信息]
	 * @return    array            返回成功或失败的信息
	 *
	 * 加入购物车：1、通过 getCartGoodsData 方法获取商品信息
	 *             2、通过判断 $userHashKey 是否是之前加入过购物车的商品
	 */
	public function handlerLoginCartData($data)
	{
		$goodsId = $data['gid'];
		$colorId = $data['cid'];
		$sizeId  = $data['sid'];
		$buyNumber = $data['number'];

		$res = new GoodsModel();
		$goodsData = $res->getCartGoodsData($goodsId, $colorId, $sizeId);

		$keyId = 'cart:'.$_SESSION['user:data']['id'];
		$userKey = $keyId.':'.$goodsId.':'.$colorId.':'.$sizeId;

		$userHashKey = $this->redis->exists($userKey);

		// 存在之前存的redis键
		if ($userHashKey) {

			$originNum = $this->redis->hget($userKey, 'number');

			$newNum = $originNum + $buyNumber;

			$modifyData = $this->redis->hset($userKey, 'number', $newNum);

			// 修改redis中hash与集合的有效时间
			$this->redis->expire($userKey, 3600*24*7);
			$this->redis->expire($keyId, 3600*24*7);

			// 返回json相应的提示信息
			return $this->handlermodifyDataInfo($modifyData); exit;
		} else {

			$goodsData['number'] = $buyNumber;

			$insertData = $this->redis->hmset($userKey, $goodsData);   // 此处应有错误记录

			$dataId = $goodsId.':'.$colorId.':'.$sizeId;

			$insertMuster = $this->redis->lPush($keyId, $dataId);

			// 设置hash键的有效时间
			$this->redis->expire($userKey, 3600*24*7);
			$this->redis->expire($keyId, 3600*24*7);

			// 返回json相应的提示信息
			return $this->handlerInsertMusterInfo($insertMuster, $dataId);
		}
	}

	/**
	 * [loginModifyRedisData 在首页判断用户登录时检查是否存在未登录之前的集合键]
	 * @author    欧阳学
	 * @DateTime  2017-12-11
	 *
	 * 如果存在之前的键, 则修改为以用户ID来作为唯一键名标准
	 */
	public function loginModifyRedisData()
	{
		$musterKey = 'cart:ids:set:'.session_id();

		$musterKeyData = $this->redis->exists($musterKey);

		if ($musterKeyData) {

	        $newMusterKey = 'cart:'.$_SESSION['user:data']['id'];

	        // 查看队列的长度
	        $idArr =  $this->redis->lLen($musterKey);

	        for ($i=0; $i<$idArr; $i++) {

	        	$dataId = $this->redis->lIndex($musterKey, $i);

	        	$key = 'cart:'.session_id().':'.$dataId;

	        	$data = $this->redis->exists($key);

	        	if ($data) {

	        		$loginListKey = $newMusterKey.':'.$dataId;

	            	$this->redis->rename($key, $loginListKey);

	        		$this->redis->hset($loginListKey, 'uid', $_SESSION['user:data']['id']);

	        		$this->handlerInsertMusterId($dataId);

	            	// 重新设置有效时间
	            	$this->redis->expire($loginListKey, 3600*24*7);
	        	} else {
	        		continue;
	        	}
	        }

	        // 修改队列的键名
	        $modifyMusterKey = $this->redis->rename($musterKey, $newMusterKey);
	        $this->redis->expire($newMusterKey, 3600*24*7);
	    }
	}

	/**
	 * [loginHandlerCutAndAddCartNum 处理修改购物车的购买量]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     array      $data [商品的ID数据]
	 * @return    array      1505：修改失败   1200：修改成功  1606：超库存
	 *
	 * 修改购买量：1、通过 checkCartNum 方法查询数据库，
	 *                得到商品的实际库存$goodsNumber，若超过库存返回1606
	 *             2、已登录（$data['spot'] == 1）
	 *                未登录（$data['spot'] == 2）
	 *             3、通过 $modifyData 修改redis中的购买量
	 *             4、通过 handlermodifyDataInfo 方法将实际库存与相应的判断数据返回
	 */
	public function loginHandlerCutAndAddCartNum($data)
	{
		$modelObj = new GoodsModel;

		$info = $modelObj->checkCartNum($data);

		if ($info['code'] == 1404) {

			return [
				'code' => 1606, 
				'goodsNum' => $info['goodsNum'],
			];
			exit;
		}

		$goodsNumber = $info['goodsNum'];
		$dataID = $data['uid'].':'.$data['cid'].':'.$data['sid'];

		if ($data['spot'] == 1) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$dataID;
		} elseif ($data['spot'] == 2) {

			$key = 'cart:'.session_id().':'.$dataID;
		}

		$modifyData = $this->redis->hset($key, 'number', $data['number']);

		return $this->handlermodifyDataInfo($modifyData, $goodsNumber);
	}

	/**
	 * [handlerDelCartData 处理单条删除redis购物车的数据]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     array      $data [商品ID数组]
	 * @return    array      1200：删除成功  1404：删除失败
	 *
	 * 未登录：（$data['spot'] == 2）
	 * 已登录：（$data['spot'] == 1）
	 *     1、$delInfo 删除redis中商品的键
	 *     2、$delMuster 删除redis集合中的元素
	 *     3、调用 handlerInsertMusterInfo 方法返回相应的提示信息
	 */
	public function handlerDelCartData($data)
	{
		$member = $data['uid'].':'.$data['cid'].':'.$data['sid'];

		if ($data['spot'] == 2) {

			$key = 'cart:'.session_id().':'.$member;
			$musterKey = 'cart:ids:set:'.session_id();
		} elseif ($data['spot'] == 1) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$member;
			$musterKey = 'cart:'.$_SESSION['user:data']['id'];
		}

		$delInfo = $this->redis->del($key);                  // 此处应有错误记录
		$delMuster = $this->redis->lRem($musterKey, $member, 0);

		return $this->handlerInsertMusterInfo($delMuster);
	}

	/**
	 * [handlerDelCartData 处理多条删除redis购物车的数据]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     array      $data [商品ID数组]
	 * @return    array      1200：删除成功  1404：删除失败
	 *
	 * 未登录：（$data['spot'] == 2）
	 * 已登录：（$data['spot'] == 1）
	 *     1、$delInfo 删除redis中商品的键
	 *     2、$delMuster 删除redis集合中的元素
	 *     3、调用 handlerInsertMusterInfo 方法返回相应的提示信息
	 */
	public function handlerDelAllCartData($data)
	{	
		$spot = 123;
		if ($data['spot'] == 2) {

			$musterKey = 'cart:ids:set:'.session_id();

			foreach ($data as $v) {

				$key = 'cart:'.session_id().':'.$v;

				$delInfo = $this->redis->del($key);          // 此处应该记录错误信息

				$delMuster = $this->redis->lRem($musterKey, $v, 0);
			}
		} elseif ($data['spot'] == 1) {

			$musterKey = 'cart:'.$_SESSION['user:data']['id'];

			foreach ($data as $v) {

				$key = 'cart:'.$_SESSION['user:data']['id'].':'.$v;

				$delInfo = $this->redis->del($key);          // 此处应该记录错误信息

				$delMuster = $this->redis->lRem($musterKey, $v, 0);
			}
		}
		
		if (!$delMuster) {
			return ['code' => 1200];exit;
		} else {
			return ['code' => 1404];exit;
		}
	}

	/**
	 * [getAllRedisData 获取未登录时购物车redis中的全部信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-11
	 * @return    array       redis中的购物车信息
	 */
	public function getAllRedisData()
	{
		$musterKey = 'cart:ids:set:'.session_id();

		// 先根据集合拿到商品ID
        $idArr =  $this->redis->lLen($musterKey);

        for ($i=0; $i<$idArr; $i++) {  

        	$dataId = $this->redis->lIndex($musterKey, $i);
  
            $key = 'cart:'.session_id().':'.$dataId;

            $data = $this->redis->exists($key);

            // 空信息跳过此次循环
            if (!$data) {
            	 continue;
            }

            $list[] = $this->redis->hGetAll($key);  
        }  

        return $list;
	}

	/**
	 * [loginGetAllUserCartData 获取登录后redis中的购物车信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @return    array      redis中的购物车信息
	 */
	public function loginGetAllUserCartData()
	{
		$musterKey = 'cart:'.$_SESSION['user:data']['id'];

		// 查看队列中的长度
        $idArr =  $this->redis->lLen($musterKey);

		for ($i=0; $i<$idArr; $i++) {

			$dataId = $this->redis->lIndex($musterKey, $i);

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$dataId;

			$data = $this->redis->exists($key);

            if (!$data) {
            	 continue;
            }

            $list[] = $this->redis->hGetAll($key);
		}

		return $list;
	}

	/**
	 * [handlerOrderData 处理用户结算页的数据]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     array      $data  ajax提交的商品id信息
	 * @return    array      1200：表示数据处理成功  1606：表示库存为0，并返回库存为0的id
	 */
	public function handlerOrderData($data)
	{
		$GoodsMod = new GoodsModel;

		// 得到商品信息
		$info = $GoodsMod->getOrderGoodsData($data);

		// 循环遍历并修改数据
		foreach ($info as $v) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$v['id'];
			$arr = $this->redis->hmget($key, ['price', 'pic', 'number']);

			// 更新价格
			if ($v['price'] != $arr['price']) {
				$this->redis->hset($key, 'price', $v['price']);
			}

			// 判断库存
			if ($v['num'] < $arr['number']) {
				$this->redis->hset($key, 'number', $v['num']);
			}

			if ($v['num'] == 0) {

				return [
					'code' => 1606,
					'id'   => $v['id'],
				];
				exit;
			}
		}

		return [
			'code' => 1200,
		];
	}

	/**
	 * [getOrderData 获取redis中的商品结算数据]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     array      $data [商品ID数据]
	 * @return    array      得到的商品数据
	 */
	public function getOrderData($data)
	{
		for ($i=0; $i<count($data); $i++) {

			$key = 'cart:'.$_SESSION['user:data']['id'].':'.$data[$i];

			$keyInfo = $this->redis->exists($key);

            if (!$keyInfo) {
            	 continue;
            }

			$list[] = $this->redis->hGetAll($key);
		}

		return $list;
	}

	public function getCartCount()
	{
		return $this->redis->lLen('cart:'.$_SESSION['user:data']['id']);
	}

	// 返回判断插入集合的信息
	public function handlerInsertMusterInfo($insertMuster, $dataId = '')
	{
		if ($insertMuster) {

			$this->handlerInsertMusterId($dataId);

			return [
				'code' => 1200,
			];
			exit;
		} else {

			return [
				'code' => 1404,
			];
		}
	}

	// 返回修改购物量信息
	public function handlermodifyDataInfo($modifyData, $goodsNumber = '')
	{
		if ($modifyData != 0) {

			return [
				'code' => 1505,
				'msg'  => '购买量修改失败',
			];
			exit;
		} else {

			return [
				'code' => 1200,
				'msg'  => '修改成功',
				'goodsNum' => $goodsNumber,
			];
		}
	}

	// 设置cookie_id的有效时间
	public function modifySessionIdTime()
	{
		setcookie(session_name(), session_id(), time()+3600*24*7, '/');
	}


	public function handlerInsertMusterId($dataId)
	{
		if ($_SESSION['user:data']['id']) {

			$goodsId = $_SESSION['user:data']['id'].':'.$dataId;

			$info = $this->redis->sIsMember('set:cart', $goodsId);

			if (!$info) {

				$this->redis->sAdd('set:cart', $goodsId);
			}
		}
	}
}
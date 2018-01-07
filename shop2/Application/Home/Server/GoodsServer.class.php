<?php

namespace Home\Server;

class GoodsServer
{
	//商品数据存在
	const FOUND_GOODS_CODE = 1302;

	//商品数据不存在
	const NOT_FOUND_GOODS_CODE = 1304;


	/**
	 * [getDetailDatas     查询得到商品详情数据
	 * @param  int     $id 要查询详情的商品id
	 * @return array        如果缓存，数据库中有对应的商品数据，返回['code' => self::FOUND_GOODS_CODE,'msg'  => 'Goods Found','data' => $goodsData];没有则返回['code' => self::NOT_FOUND_GOODS_CODE,'msg'  => 'Goods Not Found'];
	 */
	public function getDetailDatas($id)
	{
		$key = 'hotgoods:data:'.$id;
		 // S('hotgoods:data:'.$id,NULL);
		$goodsData = S('hotgoods:data:'.$id);

		if ($goodsData) {

			//缓存中有商品数据
			return [
				'code' => self::FOUND_GOODS_CODE,
				'msg'  => 'Goods Found',
				'data' => $goodsData
			];
		}

		
		$goodsData = D('goods')->getGoodsById($id);

		if ($goodsData) {

			S('hotgoods:data:'.$id, $goodsData);
			return [
				'code' => self::FOUND_GOODS_CODE,
				'msg'  => 'Goods Found',
				'data' => $goodsData
			];

		}

			return [
				'code' => self::NOT_FOUND_GOODS_CODE,
				'msg'  => 'Goods Not Found'
			];


	}

	/**
	 * [handlerStock 将商品库存依次放入队列
	 * @param  int   $stock 商品对应的库存
	 * @return int          队列中键goods_store的长度
	 */
	public function handlerStock($stock)
	{
		$redis = new \redis();

		$redis->connect(C('REDIS_HOST'), C('REDIS_PORT'));

		$res = $redis->llen('goods_store');

		if ($stock >= $res) {

			$stock = $stock - $res;
		} else if($stock < $res) {

			$redis->del('good_store');
		}
		
		for ($i=0; $i<$stock; $i++) {

			$redis->lpush('goods_store',1);
		}

		$num = $redis->llen('goods_store');

		return $num;
	}
}
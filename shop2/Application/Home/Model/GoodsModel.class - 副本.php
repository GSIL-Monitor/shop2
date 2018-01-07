<?php

namespace Home\Model;

use Think\Model;

class GoodsModel extends Model
{
	protected $tableName = 'goods';

	public function getCartGoodsData($goodsId, $colorId, $sizeId)
	{
		$goodsData = $this->field('name, price')
						   ->where(['id' => $goodsId])
						   ->find();

		$goodsColorData = M('goods_color')
						->field('color, pic')
					    ->where(['id' => $colorId])
					    ->find();

		$goodsSizeData = M('goods_size')->field('size')
										->where(['id' => $sizeId])
										->find();
										
		$data['id'] = $goodsId;
		$data['cid'] = $colorId;
		$data['sid'] = $sizeId;
		$data['name'] = $goodsData['name'];
		$data['price'] = $goodsData['price'];
		$data['color'] = $goodsColorData['color'];
		$data['pic'] = $goodsColorData['pic'];	
		$data['size'] = $goodsSizeData['size'];

		return $data;
	}

	//根据商品id从数据库查数据
	public function getGoodsById($gid)
	{
		$datas = $this
		->field('think_goods.id,name,price,buynum,think_goods.status,group_concat(distinct(think_goods_color.color)) color,group_concat(distinct(think_goods_color.pic
			)) pic,group_concat(distinct(think_goods_size.size)) size,think_goods_size.num store,group_concat(distinct(think_goods_photo.photo)) photo')
		->join('__GOODS_COLOR__ on __GOODS__.id=__GOODS_COLOR__.gid')
		->join('__GOODS_SIZE__ on __GOODS_SIZE__.cid=__GOODS_COLOR__.id')
		->join('__GOODS_PHOTO__ on __GOODS__.id=__GOODS_PHOTO__.gid')
		->where('think_goods.id ='.$gid)
		->select();

		return $datas;
	}

	public function test()
	{
		echo 113;
	}
}
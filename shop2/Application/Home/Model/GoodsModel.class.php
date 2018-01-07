<?php

namespace Home\Model;

use Think\Model;

class GoodsModel extends Model
{
	protected $tableName = 'goods';

	/**
	 * [getCartGoodsData 获取商品信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     int      $goodsId [商品ID]
	 * @param     int      $colorId [商品颜色ID]
	 * @param     int      $sizeId  [商品尺寸ID]
	 * @return    array    商品数据
	 */
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
		$data['gid'] = $goodsId;
		$data['cid'] = $colorId;
		$data['sid'] = $sizeId;
		$data['name'] = $goodsData['name'];
		$data['price'] = $goodsData['price'];
		$data['color'] = $goodsColorData['color'];
		$data['pic'] = $goodsColorData['pic'];	
		$data['size'] = $goodsSizeData['size'];
		if ($_SESSION['user:data']['id']) {

			$data['uid'] = $_SESSION['user:data']['id'];
		}

		return $data;
	}

	/**
	 * [getOrderGoodsData 获取购物车结算商品信息]
	 * @author    欧阳学
	 * @DateTime  2017-12-18
	 * @param     array      $data  商品的ID
	 * @return    array      得到的商品数据
	 */
	public function getOrderGoodsData($data)
	{
		for ($i=0; $i<count($data); $i++) {

			$goodsData = $this->field('price')
						      ->where(['id' => $data[$i][0]])
						      ->find();	

			$goodsSizeData = M('goods_size')->field('num')
										    ->where(['id' => $data[$i][2]])
										    ->find();

			$getData['price'] = $goodsData['price'];
			$getData['num'] = $goodsSizeData['num'];
			$getData['id']  = $data[$i][0].':'.$data[$i][1].':'.$data[$i][2];

			$list[] = $getData;
		}

		return $list;
	}

	/**
	 * [checkCartNum 查看库存]
	 * @author    欧阳学
	 * @DateTime  2017-12-22
	 * @param     int      $data    商品的尺寸ID
	 * @return    array             1404：超出库存    1200：正常
	 */
	public function checkCartNum($data)
	{
		$getNum = M('goods_size')->field('num')
								 ->where(['id' => $data['sid']])
								 ->find();
		
		if ($getNum['num'] < $data['number']) {

			return [
				'code' => 1404,
				'goodsNum'=>$getNum['num'],
			];
			exit;
		} else {

			return [
				'code' => 1200,
				'goodsNum'=>$getNum['num'],
			];
		}
	}

	/**
	 * [getGoodsById      根据商品id从数据库查数据
	 * @author    林泽钦
	 * @DateTime  2017-12-17
	 * @param  int   $id  查询商品对应的id
	 * @return array      商品数据 
	 */
	public function getGoodsById($id)
	{
		$map['id'] = $id;
		$base = M('goods')->field('id,name,price,pic,buynum')->where($map)->find();

		// $id = $map['id'];

		$other = M('goods_color c')
				->field('c.id,c.color,s.size,s.num,g.price')
				->join('think_goods_size s on s.cid = c.id')
				->join('think_goods g on g.id = c.gid')
				->where("g.id =".$id)
				->select();

		$arr[] = $base;
		$arr[] = $other;
		return $arr;

	}

	 /**
     * 查询每一个一级分类名的热销商品id
     * @param  array $map  状态为在售中以及同个一级分类的二级分类名的几个id
     * @return [type]      [description]
     */
    public function getHotGoodsIds($map) 
    {
         $id = $this->field('id')->where($map)->order('buynum desc')->limit(3)->select();
        return $id;
    }


    //搜索每一个热销商品的相关数据（用来存到缓存）
    public function getHotGoodsData($map)
    {
            $base = $this->field('id,name,price,pic,buynum')->where($map)->find();
            $id = $map['id'];
            $other = M('goods_color c')
                ->field('c.id,c.color,s.size,s.num,g.price')
                ->join('think_goods_size s on s.cid = c.id')
                ->join('think_goods g on g.id = c.gid')
                ->where("g.id = $id")
                ->select();
            $arr[] = $base;
            $arr[] = $other; 
            return $arr;
    }

    /**
     * 通过商品列表的要求得到其中的商品的数据使其遍历出来
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getGoodsDatas($map,$order)
	{	
		$datas = $this->field('id,name,pic,price')->where($map)->order($order)->select();
        // $data = $this->getLastSql();
		return $datas;
	}

    public function getGoodsColor($map)
    {
          $colors = M('goods_color')->field('distinct(color)')->where($map)->select();
          return $colors;
    }
}
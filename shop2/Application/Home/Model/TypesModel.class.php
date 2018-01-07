<?php

namespace Home\Model;

use Think\Model;

class TypesModel extends Model
{
	protected $tableName = 'goods_types';

	//查询一级分类数据
	public function getFatherTypesData()
	{
		$data = $this->field('id,name')->where('pid=0')->select();


		return $data;
	}

	/**
	 * 根据父类id查出子类的数据
	 * @param  int $id 父类的id
	 * @return [type]     [description]
	 */
	public function getSonTypeData($id)
	{
		$map['pid'] = $id;
		$data = $this->field('id,name')->where($map)->select();
		return $data;

	}



	public function getSonTypeId($id)
	{
		$map['pid'] = $id;
		$str = $this->field('group_concat(id) id')->where($map)->select();
		return $str;
	}



	
	public function getSomeTypesData()
	{
		$map['pid'] = ['in',[1,2,3]];
		return $this
		->field('pid,id,name')

		->where($map)
		->select();	
	}

	
}
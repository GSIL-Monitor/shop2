<?php

namespace Admin\Model;

use Think\Model;

class TypesModel extends Model
{
	protected $tableName = 'goods_types';

	//查询所有的分类数据
	public function getTypes()
	{
		$list = $this->order('concat(path,id)')->select();
		$count = $this->where('pid=0')->count();

		return [$list, $count];
	}

	//根据ID查询分类数据
	public function getTypesById($id)
	{
		return $this->where(['id' => $id])->find();
	}

	// 根据id查询分类的名称与id
	public function getOneTypeDataById($id)
	{
		return $this->where(['id' => $id])->getField('name, id');
	}

	//根据PID查询分类数据
	public function getTypesByPid($id)
	{
		return $this->where(['pid' => $id])->getField('id');
	}


	public function typesAdd($data)
	{
		return $this->add($data);
	}

	//根据ID删除数据
	public function typeDelById($id)
	{
		return $this->delete($id);
	}

	//根据ID修改数据
	public function typeEdit(array $typeData)
	{
		return $this->where(['id' => $typeData['id']])
			 		->save(['name' => $typeData['name']]);
	}

	//取出一级分类数据
	public function getFatherDatas()
	{
		$map['pid'] = 0;
		return $this->field('id,name')->where($map)->select();
	}
}
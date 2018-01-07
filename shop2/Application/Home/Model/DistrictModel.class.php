<?php

namespace Home\Model;

use Think\Model;

class DistrictModel extends Model
{
	protected $tableName = 'district';

    /**
     * 拿出所有省市数据
     * @param  int $map upid
     * @return array      所有省市数据
     */
    public function getAddressDatas($map)
    {
        return $this->field('id,name,level,upid')
                    ->where($map)
                    ->select();
    }

    /**
     * 根据id拿出收件人省市数据并拼接
     * @param  int $map id
     * @return array     
     */
    public function getAreaData($map)
    {
         return $this->field('group_concat(name) name')->where($map)->select();
    }

    /**
     * 新添收货地址到地址表
     * @param array $arr [description]
     */
    public function addAddress($arr)
    {
        return M('address')->add($arr);
    }
	
    public function getAllAddress($map)
    {
        return M('address')->field('id,phone,address,name,state')
                           ->where($map)
                           // ->order(['state', 'id' => 'desc'])
                           ->select();
    }

	
	
	
}
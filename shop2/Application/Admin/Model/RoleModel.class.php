<?php

namespace Admin\Model;

use Think\Model;

class RoleModel extends Model
{

	//当模型名与表名不一样时才需要写
	protected $tableName = 'auth_group';

	//查询所有的用户数据
	public function getGroupDatas()
	{
		$arr1 = $this->field('desc,title,rules,id')->where('status=1')->order('id')->select();
		$ii = $this->getLastSql();
	

	
		return $arr1;
	}

    public function getGroupDetail()
    {
        $tt = M('auth_group g')->field('g.id,g.title,count(a.uid) num')->join('left join think_auth_group_access a  on a.group_id = g.id')->group('g.id')->select();

        return $tt;
    }

   


	public function getAdminNameData()
	{
		return $this->field('id,name')->where('status=1')->order('id')->select();
	}

   

	//根据uid拿到对应的用户数据
	public function getUserById($id, $field = 'id,name')
	{

		//select * from user where id = $id;
		return $this->field($field)->where([
			'id' => $id,
		])->find();

		
	}

	//$userDatas 前面的array限定了$userDatas只能是一个数组
	public function handlerUserEdit(array $userDatas)
	{

		// dump($userDatas);
		



		//update user set uid = 9, uname='123' where id = 9;
		return $this->where([
			'id' => $userDatas['uid'],
		])->save([
			'name' => $userDatas['uname'],
			'pass' => $userDatas['pass'],
		]);

		// echo $this->getLastSql();
		// exit;
	}

	// public function handlerDelRoleData($id)
 //    {
 //        return $this->delete($id);
 //    }
    public function getRules()
    {
    	$rule = M('auth_rule');
    	// $list = $rule->order('concat(path,id),id')->select();
    	$types = $rule->where('pid=0')->select();  //一级类名
        $son=$rule->where("pid!=0")->select();  //二三类
     
        $arr = [];
        foreach ($son as $v) {
           $num = substr_count($v['path'],',');
           if($num==3){
          
            $arr[] =[$v['id'],$v['pid']=>$v['title']];
           }
        }
		$count = $rule->where('pid=0')->count();

		return [$types, $son, $arr];
    }

    public function getAllRules()
    {
    	$rule = M('auth_rule');
		$list = $rule->order('concat(path,id),id')->select();
		return $list;

    }

    public function addGroup($arr)
    {
    	$num = M('auth_group')->add($arr);
    	return $num;
    }

    public function addAccessData($arr2)
    {
    	$src = M('auth_group_access')->addAll($arr2);
    	// $li = M('auth_group_access')->getLastSql();
    	return $src;
    }

    public function getGroupDataById($id)
    {
    	$data = M('auth_group')->find($id);
    	return $data;

    }

    public function editGroupData($data,$id)
    {
    	$num = M('auth_group')->where("id=$id")->save($data);
    	return $num;

    }

    public function editAccessData($data,$id)
    {

     	$ani =  M('auth_group_access');
    	$num = $ani->where("group_id=$id")->delete();
    	if ($num) {
    		$src = $ani->addAll($data);
    		if ($src) {
    			return $src;
    		}
    	}

    }
}
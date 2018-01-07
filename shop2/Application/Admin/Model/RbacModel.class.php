<?php

namespace Admin\Model;

use Think\Model;

//每一个模型对应一张表，
//比如你有UserModel模型，对应user表
class RbacModel extends Model
{

	//当模型名与表名不一样时才需要写
	protected $tableName = 'admin'; 

	


	public function getAdminNameData()
	{
		return $this->field('id,name')->where('status=1')->order('id')->select();
	}

    public function getOneAdminData($name)
    {
        $src =  $this->field('id,name,sex,addtime,phone')->where(['name' => $name])->select();
        // $src1 = $this->getLastSql();
        return $src;
    }

    public function editAdminData($arr,$id)
    {
      
        $dar = $this->where("id=$id")->save($arr);
        $darr = $this->getLastSql();
        return $dar;

    }

	//根据uid拿到对应的用户数据
	public function getPasswordById($id, $field = 'id,name,password')
	{

		//select * from user where id = $id;
		return $this->field($field)->where([
			'id' => $id,
		])->find();

		
	}

    public function addAdmin($arr)
    {
        return $this->add($arr);
    }



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

    public function getAllAdminData($map = 1) 
    {
        
        $arr1 = M('admin u')->field('u.id,name,u.phone,u.addtime,u.sex,u.status,group_concat(g.title) title')->join('left join think_auth_group_access a on a.uid = u.id')->join('left join think_auth_group g on g.id = a.group_id')->group('u.id')->order('u.id')->where($map)->select();
        $arr = M('admin u')->getLastSql();
        return $arr1;
    }

    public function countRoles()
    {
        $num = M('auth_group_access')->field('count(distinct uid) nums')->select();
        return $num;
    }
}
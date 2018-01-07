<?php

namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{

	//验证规则
    protected $_validate = [
        ['account', 'require', '用户账号不能为空'],
        ['account','/^[a-z|A-Z]\w{3,12}$/','用户名必须字母开头,且不能有特殊符号,4~12位'],
        ['name', 'require', '用户昵称不能为空'],
        ['name', '/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,6}$/u', '用户昵称为2-6位的字母,数字,下划线或中文组成'],
        ['phone', 'require', '手机不能为空'],
        ['phone', '/^1(3\d|47|5[012356789]|77|8\d)\d{8}$/u', '手机格式不正确'],
        ['email', 'require', '邮箱不能为空'],
        ['email', '/^\w+@\w+\.(com|cn|net)$/u', '邮箱格式不正确'],
        ['score', 'require', '积分数据不能为空'],
        
    ];


	/**
	 * 查询所有的用户数据
	 * @param  string  $field [查询结果所包含的字段的信息]
	 * @param  integer $limit [控制每页显示的条数]
	 * @return [array]        [返回分页样式和数据库中用户的全部数据还有用户总条数]
	 */
	public function getUsers($str,$field ='think_user.id,score,account,email,addtime,status,role,think_user_detail.sex,phone', $limit = 2)
	{

		//拿到总条数
		$count = $this->where($str)->count();

		//得到分页对象
		$page = new \Think\Page($count, $limit);

		//拿到分页样式
		$show = $page->show();

		$datas = $this
		->field($field)
		->join('LEFT JOIN __USER_DETAIL__ on __USER__.id=__USER_DETAIL__.uid')
		->order('id')
		->where($str)
		->limit($page->firstRow.','.$page->listRows)
		->select();

		return [
			'pageBtn' => $show,
			'data'    => $datas,
			'count'   => $count,
		];
	}

	/**
	 * 根据uid拿到对应的用户数据
	 * @param  int    $id    [要查询用户对应的ID值]
	 * @param  string $field [需查询的用户的字段信息]
	 * @return array         [返回该id对应的用户数据]
	 */
	public function getUserById($id, $field = 'think_user.id,score,account,phone,status,role,think_user_detail.name,sex,email,birth')
	{
		return $this
		->field($field)
		->join('LEFT JOIN __USER_DETAIL__ on __USER__.id=__USER_DETAIL__.uid')
		->order('id')
		->where('think_user.id='.$id)
		->limit($page->firstRow.','.$page->listRows)
		->find();

		
	}

	/**
	 * 处理用户编辑操作
	 * @param  array  $userDatas [要编辑的用户的相关数据]
	 * @return array             [返回受影响行数]
	 */
	public function handlerUserEdit(array $userDatas)
	{

		$res1 =  $this
		->where([
			'id' => $userDatas['uid'],
		])
		->save([
			'account' => $userDatas['account'],
			'email' => $userDatas['email'],
			'status' => $userDatas['status'],
			'role' => $userDatas['role'],
			'score' => $userDatas['score'],
		]);

		$uids = M('user_detail')->field('uid')->select();

		$a = array_map('current', $uids);

		if (in_array($userDatas['uid'],$a)) {
			$res2 = M('user_detail')
				->where([
					'uid' =>$userDatas['uid'],
				])
				->save([
					'name' => $userDatas['name'],
					'birth' => $userDatas['birth'],
					'phone' => $userDatas['phone'],
					'sex' => $userDatas['sex'],
				]);
			} else {
  				$res2 = M('user_detail')
				->add([
					'uid' =>$userDatas['uid'],
					'name' => $userDatas['name'],
					'birth' => $userDatas['birth'],
					'phone' => $userDatas['phone'],
					'sex' => $userDatas['sex'],
				]);
			}

		

		return [$res1, $res2];
	}

	/**
	 * 处理删除用户数据
	 * @param  int    $id [要删除的用户对应的id]
	 * @return boolen     [返回true代表删除成功，返回false代表删除失败]
	 */
	public function delUser($id)
	{

		$flag = true;
		$res1 =  $this
		->where([
			'id' => $id,
		])
		->delete();


		if (!$res1) {
			$flag = false;
		}

		$res2 = M('user_detail')
				->where([
					'uid' =>$id,
				])
				->delete();

		if (!$res2) {
			$flag = false;
		}

		return $flag;
	}

	 /**
	 * 修改用户的状态
	 * @param  int $id     [要启用或者禁用的用户的id]
	 * @param  int $status [要启用或者禁用的用户的状态]
	 * @return int         [返回受影响行数,0代表修改成功，1代表修改失败]
	 */
    public function handlerAjaxStatus($id, $status)
    {
        $data['status'] = $status;
        return $this->where("id={$id}")->save($data);
        
    }

    public function doEditGrading($field ='think_user.id,score,account,phone,addtime,status,role,think_user_detail.sex,email', $limit = 5)
    {
    	//拿到总条数
		$count = $this->count();

		//得到分页对象
		$page = new \Think\Page($count, $limit);

		//拿到分页样式
		$show = $page->show();

		$datas = $this
		->field($field)
		->join('__USER_DETAIL__ on __USER__.id=__USER_DETAIL__.uid')
		->order('id')
		->limit($page->firstRow.','.$page->listRows)
		->select();

		$commonUserNum = $this->where(['role'=>1])->count();

		$vipUserNum = $this->where(['role'=>2])->count();

		$diamondUserNum = $this->where(['role'=>3])->count();

		return [
			'pageBtn' => $show,
			'data'    => $datas,
			'count'   => $count,
			'commonUserNum' =>$commonUserNum,
			'vipUserNum' =>$vipUserNum,
			'diamondUserNum' =>$diamondUserNum,
		];
    }

    public function getUserScoreData($map)
    {
    	 $user = $this->field('id,account,score')->where($map)->select();
    	 return $user;
    }

}
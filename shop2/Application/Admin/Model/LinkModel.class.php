<?php

namespace Admin\Model;

use Think\Model;

class LinkModel extends Model
{

	//验证规则
    protected $_validate = [
        ['name', 'require', '链接名不能为空'],
        ['name', '/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,6}$/u', '链接昵称为2-6位的字母,数字,下划线或中文组成'],
        ['url', 'require', '链接地址不能为空'],
        ['url', '/^(?=^.{3,255}$)(http(s)?:\/\/)?(www\.)?[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+(:\d+)*(\/\w+\.\w+)*$/', '链接格式不正确'],
        ['brief', 'require', '链接简介不能为空'],
        
    ];

	/**
	 * 查询所有的链接数据
	 * @param  string  $field [查询结果所包含的字段的信息]
	 * @param  integer $limit [控制每页显示的条数]
	 * @return [array]        [返回分页样式和数据库中链接表thibk_link中的全部数据]
	 */
	public function getLinks($str,$field ='id,name,url,pic,brief,status,addtime', $limit = 2)
	{

		//拿到总条数
		$count = $this->where($str)->count();

		//得到分页对象
		$page = new \Think\Page($count, $limit);

		//拿到分页样式
		$show = $page->show();

		$datas = $this
		->field($field)
		->order('id')
		->where($str)
		->limit($page->firstRow.','.$page->listRows)
		->select();

		return [
			'pageBtn' => $show,
			'data'    => $datas,
			'count'   =>$count,
		];
	}

	/**
	 * 根据uid拿到对应的链接数据
	 * @param  int    $id    [要查询链接对应的ID值]
	 * @param  string $field [需查询的链接的字段信息]
	 * @return array         [返回该id对应的链接数据]
	 */
	public function getLinkById($id, $field = 'id,name,url,pic,brief,status')
	{

		return $this->field($field)->where([
			'id' => $id,
		])->find();
	}

	/**
	 * 处理链接编辑操作
	 * @param  array  $userDatas [要编辑的链接的相关数据]
	 * @return array             [编辑后的链接的相关数据]
	 */
	public function handlerLinkEdit(array $userDatas)
	{

		return $this->where([
			'id' => $userDatas['uid'],
		])->save([
			'name' => $userDatas['name'],
			'url' => $userDatas['url'],
			'pic' => $userDatas['pic'],
			'brief' => $userDatas['brief'],
			'status' => $userDatas['status'],
		]);
	}

	/**
	 * 处理添加链接操作
	 * @param  array $data  [要添加链接的相关数据]
	 * @return int          [返回受影响行数,0代表添加成功，1代表添加失败]
	 */
    public function handlerInsertLink($data)
    {
        return $this->add($data);
    }

	

	/**
	 * 处理删除链接数据
	 * @param  int    $id [要删除的链接对应的id]
	 * @return int        [返回受影响行数,0代表删除成功，1代表删除失败]
	 */
	public function delLink($id)
	{
		 return  $this->where(['id'=>$id])->delete();
	}

	/**
	 * 修改链接的状态
	 * @param  int $id     [要启用或者禁用的链接的id]
	 * @param  int $status [要启用或者禁用的链接的状态]
	 * @return int         [返回受影响行数,0代表修改成功，1代表修改失败]
	 */
    public function handlerAjaxStatus($id, $status)
    {
        $data['status'] = $status;
        return $this->where("id={$id}")->save($data); 
    }

}
<?php

namespace Admin\Model;

use Think\Model;

class AssessModel extends Model
{

	protected $tableName = 'goods_assess';
	/**
	 * 查询所有的买家评论数据
	 * @param  string  $field [查询结果所包含的字段的信息]
	 * @param  integer $limit [控制每页显示的条数]
	 * @return [array]        [返回分页样式和数据库中买家评论的全部数据还有评论总条数]
	 */
	public function getAssesss($str,$field ='think_goods_assess.id,color,content,time,think_goods_assess.status,level,think_user.account,think_goods.name', $limit = 2)
	{

		//拿到总条数
		$count = $this->where($str)->count();

		//得到分页对象
		$page = new \Think\Page($count, $limit);

		//拿到分页样式
		$show = $page->show();

		$datas = $this
		->field($field)
		->join('__USER__ on __USER__.id=__GOODS_ASSESS__.uid')
		->join('__GOODS__ on __GOODS__.id=__GOODS_ASSESS__.gid')
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
	 * 查询所有的商家评论数据
	 * @param  string  $field [查询结果所包含的字段的信息]
	 * @param  integer $limit [控制每页显示的条数]
	 * @return [array]        [返回分页样式和数据库中商家评论的全部数据还有评论总条数]
	 */
	public function getReplys($str,$field='think_goods_assess.content,think_goods_reply.id,aid,think_goods_reply.content content1,addtime',$limit=2)
	{
		//拿到总条数
		$count = M('goods_reply')->where($str)->count();

		//得到分页对象
		$page = new \Think\Page($count, $limit);

		//拿到分页样式
		$show = $page->show();

		$datas = $this->field($field)
					  ->JOIN('__GOODS_REPLY__ on __GOODS_REPLY__.aid = __GOODS_ASSESS__.id')
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
	 * 修改买家评论的状态
	 * @param  int $id     [要启用或者禁用的用户的id]
	 * @param  int $status [要启用或者禁用的用户的状态]
	 * @return int         [返回受影响行数]
	 */
    public function handlerAssessStatus($id, $status)
    {
        $data['status'] = $status;
        return $this->where("id={$id}")->save($data); 
    }

}
<?php

namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model 
{

    Public function getGoodsList($where=[],$field = 'id,tid,bid,name,price,pic,buynum,clicknum,status,sorce,addtime',$limit = 5)
    {

  //   	$count = $this->where($where)->count();

  //   	//得到分页对象
		// $page = new \Think\Page($count, $limit);

		// //拿到分页样式
		// $show = $page->show();

       	$data = $this->field($field)->order('addtime desc')->where($where)->select();
     

       	return $data;
    }

    /**
     * 上传商品数据
     * @return [type] [description]
     */
    public function uploadDate($data = array())
    {
    	if (empty($data)) {
    		return 0;
    	}
    	return $this->data($data)->add();
    }

    public function updateDate($id = 0,$data = array()){
        if (empty($id) && empty($data)) {
            return 0;
        }

        return $this->where('id='.$id)->save($data);
    }

    /**
     * 修改商品状态
     */
    public function changeStatus($id = 0,$status)
    {
        if (!$id && !$status) {
            return 0;
        }
    

        $data = ['status',$status];

        return $this->where('id='.$id)->setField('status',$status);
    }

    /**
     * 删除商品
     */
    public function delGoods($id = 0)
    {
        if (!$id) {
            return '不删除';
        }else{

            

        }


        // return '删除';
        return $this->where('id='.$id)->delete();
    }
}

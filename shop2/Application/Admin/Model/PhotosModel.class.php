<?php

namespace Admin\Model;

use Think\Model;

class PhotosModel extends Model
{

   
    public function getAllPhotoData()
    {
    	return M('photos')->field('id,title,link,addtime,role,pic,status')->order('addtime desc')->select();
    }

    public function addPhoto($data)
    {
    	return $this->add($data);
    }



}
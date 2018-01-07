<?php

namespace Common\Server;

use Think\Upload;

class CommonServer
{
	//上传文件
	public function handlerUploads(

		$config = [
			'maxSize' => 3145728,
			'exts'    => array('jpg', 'gif', 'png', 'jpeg'),
		]
	)
	{
		$upload = new Upload();

		$upload->maxSize   =     C('PIC_MAXSIZE') ;// 设置附件上传大小

		$upload->exts      =     C('PIC_TYPE');// 设置附件上传类型

		$upload->rootPath  =     C('PIC_ROOTPATH'); // 设置附件上传目录

		$info   =   $upload->upload();

		$photoArr = [];
		foreach ($info as $value) {
			 
			 $photoArr[] = $value['savepath'].$value['savename'];
		}

		if(!$photoArr) {

			// 上传错误提示错误信息        
			return [
				'code' => 1404,
				'msg'  => $upload->getError(),
			];
			exit;

		}else{

			return $photoArr;
		}
	}
}

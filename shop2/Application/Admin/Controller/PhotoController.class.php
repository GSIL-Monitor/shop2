<?php

namespace Admin\Controller;

use Think\Controller;

use Common\Server\CommonServer;

class PhotoController extends BaseController 
{
 
    /**
     * 显示图片列表
     */
    public function showAdView()
    {
        $types = D('types')->getFatherDatas();
        $datas = D('photos')->getAllPhotoData(); 
        $num = count($datas);
        $page = new \Think\Page($num, 3);

        $list = array_slice($datas, $page->firstRow, $page->listRows); 

        $pageBtn = $page->show();

        $this->assign('pageBtn', $pageBtn);

        $this->assign('types',$types);
        $this->assign('datas',$list);
        $this->assign('num',$num);
        
        $this->display('advertising');
    }

    /**
     * 添加图片
     */
    public function doAddPhoto()
    {   
        if (IS_GET) {

    	   $this->display('showAdView');
        } else {
            // dump(I('post.'));die;
            $data = I('post.');
            if ($data['role']==1) {
                $data['link'] = $data['goods'];
            } else {

                $link = $data['link'];
                if(!preg_match('/^(?=^.{3,255}$)(http(s)?:\/\/)?(www\.)?[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+(:\d+)*(\/\w+\.\w+)*$/', $link)) {
                    $this->error('添加失败，您输入的链接不合法');
                }

            }
            unset($data['goods']);
 
            $objUpload = new CommonServer();
            $arr = $objUpload->handlerUploads();

            if ($arr['code'] == 1404) {

                //表示文件上传失败则提示返回
                $this->error($arr['msg'], U('showAdView')); 
                exit;
            }

            $data['pic'] = $arr[0];   // 从$arr返回值中获取字段logo的值
          
            //数据审核成功则存放到数据库
            $lastDataId = D('photos')->addPhoto($data);

            if ($lastDataId) {

                //数据插入成功
                $this->success('添加成功', U('showAdView'));
            } else {

                $this->error('系统有误, 请尽快联系程序员..', U('showAdView'));
            }
        }
    }

     /**
     * 改变图片的状态（正常/禁用）
     */
    public function editPhotoStatus()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('showAdView'));
            exit;
        }
        $id = I('post.id');
        $pp = I('post.pp');
        $papa = $pp==1 ? 2 : 1 ;

        $affectedRow = M('photos')->where("id=$id")->setField('status',$papa);
        $src = M('photos')->getLastSql();
        if ($affectedRow) {
            echo json_encode([
                    'code' => 1200,
                    'msg'  => '修改成功',
                ]);                                                       
                exit;
        }
        echo json_encode([
            'code' => 1404,
            'msg'  => $src,

        ]);
    }

    /**
     * 删除图片
     */
    public function delPhotoData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }
        $id = I('post.id');
        $map['id']  = $id;
        $affectedRow = M('photos')->where($map)->delete();
        if ($affectedRow ) {
                    echo json_encode([
                        'code' => 1200,
                        'msg'  => '删除成功',
                    ]);                                                       
                    exit;
                
        }
      
        
        echo json_encode([
            'code' => 1404,
            'msg'  => '删除失败',
        ]);

    }  






}

<?php

namespace Admin\Controller;

use Think\Controller;

use Common\Server\CommonServer;

 

class SystemsController extends BaseController  
{


    public function index()
    {
        $datas = M('systems')->find();
        // dump($datas);die;
        $this->assign('datas',$datas);
        $this->display('index');
    }

    public function handlerSystemData()
    {

        if (IS_GET) {

           $this->display('index');
        } else {
            // dump(I('post.'));die;
            $data = M('systems')->find();
            if (!empty($data)) {

            $upload = new CommonServer;

            $info = $upload->handlerUploads();

            $data = [];

            if ($info['code'] == 1200) {
                $data = [
                    'title'=>I('post.title'),
                    'icon'=>$info[0],
                    'keywords'=>I('post.keywords'),
                    'copyright'=>I('post.copyright'),
                    'desc'=>I('post.desc'),
                    'record'=>I('post.record'),
                
                ];

            } else {
                $data = [
                    'title'=>I('post.title'),
                    'keywords'=>I('post.keywords'),
                    'copyright'=>I('post.copyright'),
                    'desc'=>I('post.desc'),
                    'record'=>I('post.record'),
                   
                ];
            }

            $id = I('post.id');
            $row = M('systems')->where("id=$id")->save($data);
            if ($row) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');

            }

            } else {

                $objUpload = new CommonServer();
                $arr = $objUpload->handlerUploads(); 

                if ($arr['code'] == 1404) {

                    //表示文件上传失败则提示返回
                    $this->error($arr['msg'], U('showAdView'));
                    exit;
                }

                $data = I('post.');
                $data['icon'] = $arr[0];
                $lastDataId = M('systems')->add($data);

                if ($lastDataId) {

                    //数据插入成功
                    $this->success('添加成功', U('index'));
                } else {

                    $this->error('系统有误, 请尽快联系程序员..', U('index'));
                }
            }
            
        }
        
    }
}

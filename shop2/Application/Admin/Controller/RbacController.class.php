<?php

namespace Admin\Controller;

use Admin\Controller\BaseController;

class RbacController extends BaseController
{
    /**
     * 显示管理员个人页面
     */
    public function index() 
    {   
        $name = session('admin:name');
        $id = session('admin:id');
        $data = D('rbac')->getOneAdminData($name);
      
  
        $arr = M('login_data')->field('uid,name,phone,ip,logintime,number')->order('logintime desc')->select();
        $auth = new \Think\Auth;
        $gi = $auth->getGroups($id);
        $gid = count($gi);
        if ($gid) { 
            $str = join(',',array_column($gi,'title'));
        }
        $this->assign('role',$str);
        $this->assign('arr',$arr);
        $this->assign('data',$data[0]);
        $this->display(); 
    }

    /**
     * 用ajax修改管理员密码
     * @return [type] [description]
     */
    public function changePassword()
    {
        $id = I('post.id');
        if (!empty(I('post.pass'))) {
            $pass = I('post.pass');
            $data = D('rbac')->getPasswordById($id);

            if(!password_verify($pass,$data['password'])) {
                echo json_encode([
                    'code' => 1404,
                    'msg'  => 'wrong password'
                ]);
                exit;
            } else {
                echo json_encode([
                    'code' => 1200,
                    'msg'  => 'correct password'
                ]);
                exit;

            }
        }
        
        if (!empty(I('post.newpass'))) {
            $pass = I('post.newpass');

            $arr['password'] = password_hash($pass,PASSWORD_DEFAULT);
            $data = D('rbac')->editAdminData($arr,$id);
            if ($data) {
                echo json_encode([
                    'code' => 1200,
                    'msg'  => 'edit success'
                ]);
                exit;
            } else {
                echo json_encode([
                    'code' => 1404,
                    'msg'  => 'wrong edit'
                ]);
                exit;

            }

        }

    }

    /**
     * 显示管理员列表页面
     */
    public function admins()
    {   
      
        $tt = D('rbac')->countRoles();
        $tt = $tt[0]['nums']; 
          if (!empty(I('get.name'))) {

            $mama = I('get.name');
            $map['name'] = ['like',"%$mama%"];
            $datas = D('rbac')->getAllAdminData($map);
            $mm = count($datas);

        } else {

            $datas = D('rbac')->getAllAdminData($map);
            $mm = $tt;   
        }

        $page = new \Think\Page($mm, 3);

        $list = array_slice($datas, $page->firstRow, $page->listRows); 

        $pageBtn = $page->show();

        $this->assign('pageBtn', $pageBtn);

        $pp = D('role')->getGroupDetail();
      
        $this->assign('datas',$datas); 
        $this->assign('pp',$pp); 
        $this->assign('mm',$mm); 
        $this->assign('tt',$tt);   
        $this->display('admins'); 
    }

    /**
     * 显示添加管理员页面及添加操作
     */
    public function addAdmin()
    {
        if (IS_GET) {

            $group = D('role')->getGroupDatas();

            $this->assign('group',$group);
            $this->display('addadmin');    

        } else {

            if (empty(I('post.group'))) {
                $this->error('请选择所属部门');
            }    

            if (empty(I('post.sex'))) {
                $this->error('请选择性别');
            }


            if (!empty(I('post.name'))) {

                $name = I('post.name');
                if(!preg_match("/^[A-Za-z\x{4e00}-\x{9fa5}]+$/u", $name)){
                    $this->error('添加失败，您输入的名字不合法');
                }
            } else {

                $this->error('添加失败，名字不能为空哦');

            }

            if (!empty(I('post.phone'))) {

                $phone = I('post.phone');
                if(!preg_match("/^(1[358]\d|147|17[789])\d{8}$/", $phone)) {
                    $this->error('添加失败，您输入的手机号码格式有误');
                }
            } else {

                $this->error('添加失败，名字不能为空哦');

            }

            if(!empty($_POST['password']) && !empty($_POST['password2'])) {
    
                if ($_POST['password'] != $_POST['password2']) {

                    $this->error('添加失败，您输入的两次密码不一致');  

                } else {

                    if (!preg_match("/^[\S]{3,}$/", $_POST['password'])) {

                        $this->error('添加失败，您输入的密码格式有误');
                    }
                }
            } else {
               $this->error('密码不能为空哦');
            }

            $arr['name'] = I('post.name');
            $arr['phone'] = I('post.phone');
            $arr['sex'] = I('post.sex');
            $arr['password'] = password_hash(I('post.password'),PASSWORD_DEFAULT);

            $getInsertId = D('rbac')->addAdmin($arr);

            foreach (I('post.group') as $v) {
                $arr2[] = ['uid'=>$getInsertId,'group_id'=>$v];
            }     

            $result = D('rbac')->addAccessData($arr2);

            if ($result) {
                $this->success('添加成功',U('Rbac/admins'));
            }

        }
    }

    /**
     * 判断管理员用户名是否存在
     */
    public function checkAdminExist()
    {   
        if (empty(I('post.name'))) { 

            $this->error('非法访问', U('index'));
            exit;
        }
        $name = I('post.name');
        // echo $name;die;
        $oneUserData = D('rbac')->getOneAdminData($name);
        if ($oneUserData) {
            //已经存在
            echo json_encode([
                'code' => 1200,
                'msg'  => 'user Found'
            ]);
            exit;
        }
        //不存在
        echo json_encode([
            'code' => 1404,
            'msg'  => 'user Not Found'
        ]);
        exit;
    }

    
    /**
     * 编辑管理员基本信息的操作
     */
    public function editAdminData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }
        $arr['name'] = I('post.name');
        $arr['sex'] = I('post.sex');
        $id= I('post.id');
        $arr['phone'] = I('post.phone');
        // dump($arr);die;
        $affectedRow = D('rbac')->editAdminData($arr,$id);
        // dump($affectedRow);die;
        if ($affectedRow) {
                $this->success('修改成功','index');
        } else {       
                $this->error('修改失败','index');
        }
       
    }

    /**
     * 编辑每个管理员所属的（哪些）角色（部门）
     */
    public function editAdmin()
    {   
        if (IS_POST) {
            $id = I('post.id');
            $map['uid']=$id;
            $role = I('post.role');
            $access = M('auth_group_access');
            $src =  $access->where($map)->find();
            if ($src) {
               $del = $access->where($map)->delete();
            } 
            if (empty($role)) {
               $this->success('修改成功',U('admins'));
            }
            foreach ($role as $v) {
                $arr2[] = ['uid'=>$id,'group_id'=>$v];
            }
            $result = D('rbac')->addAccessData($arr2);
            if ($result) {
                $this->success('修改成功',U('Rbac/admins'));
            } else {
                $this->error('修改失败',U('admins'));
            }

        } else {
            $id = I('get.id');
            $name = I('get.name');
            $allRoles = D('role')->getGroupDatas();
            $auth = new \Think\Auth;
            $gi = $auth->getGroups($id);
            $gid = count($gi);
            if ($gid) {
                $str = join(',',array_column($gi,'group_id'));
            }
            $this->assign('groups',$str);
            $this->assign('name',$name);
            $this->assign('id',$id);
            $this->assign('allRoles',$allRoles);
            $this->display('editadmin'); 
            
        }
    }

    /**
     * 改变管理员的状态（正常/禁用）
     */
    public function editAdminStatus()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }
        $id = I('post.id');
        $pp = I('post.pp');
        $papa = $pp==1 ? 2 : 1 ;
        $affectedRow = M('admin')->where("id=$id")->setField('status',$papa);
        $src = M('admin')->getLastSql();
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
     * 删除积分规则
     */
    public function delAdminData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }
        $id = I('post.id');
        $map['id']  = array('in',$id);
        $affectedRow = M('admin')->where($map)->delete();
        $map = [];
        $map['uid']  = array('in',$id);
        $tt = M('auth_group_access')->where($map)->select();
        if ($tt) {
            $affectedRow2 = M('auth_group_access')->where($map)->delete();
            if ($affectedRow && $affectedRow2) {
                    echo json_encode([
                        'code' => 1200,
                        'msg'  => '删除成功',
                    ]);                                                       
                    exit;
                
            }
        } elseif ($affectedRow) {
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

    /**
     * 显示角色列表页面
     */
    public function role()
    {   
        $arr = D('role')->getGroupDatas();  
        $num = count($arr);      
        $this->assign('data',$arr);
        $this->assign('num',$num);
        $this->display(); 
    }  


    /**
     * 添加角色（部门）
     */
    public function addRole()
    {
        if (IS_GET) {
            $arr = D('rbac')->getAdminNameData();
            $ruleDatas = D('rbac')->getRules();
            $one = $ruleDatas[0];
            $two = $ruleDatas[1];
            $three = $ruleDatas[2];  
           
            $this->assign('one', $one);
            $this->assign('two', $two);
            $this->assign('three',$three);
            $this->assign('data',$arr);
            $this->display('addrole');
        } else {
            $arr['title'] = I('post.title');
            $arr['desc'] = I('post.desc');
            $arr['rules'] = join(',',I('post.rule'));
            $getInsertId = D('rbac')->addGroup($arr);
            if ($getInsertId) {
                $this->success('添加成功',U('Rbac/role'));
            }
     
        } 
            
        
    }

    /**
     * 删除角色（用户组）
     */
    public function delRoleData()
    {
        if (empty(I('post.id'))) {

            $this->error('非法访问', U('index'));
            exit;
        }
        $id = I('post.id');
        $map['id']  = array('in',$id);
        $affectedRow = M('auth_group')->where($map)->delete();
        // $aa = M('auth_group')->getLastSql();
        $map = [];
        $map['group_id']  = array('in',$id);

        $tt = M('auth_group_access')->where($map)->select();
        if ($tt) {
            $affectedRow2 = M('auth_group_access')->where($map)->delete();
            if ($affectedRow && $affectedRow2) {
                    echo json_encode([
                        'code' => 1200,
                        'msg'  => '删除成功',
                    ]);                                                       
                    exit;
                
            }
        } elseif ($affectedRow) {
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
 
    /**
     * 编辑角色（部门）的基本信息
     */
    public function editRoleData()
    {
        if (IS_GET) {
            $rules = I('get.rules');
            $id = I('get.id');
            $allRules = D('rbac')->getAllRules();
            $getGroupData = D('rbac')->getGroupDataById($id);
            $this->assign('id',$id);
            $this->assign('groupData',$getGroupData);
            $this->assign('rules', $rules);
            $this->assign('allRules', $allRules);
            $this->display('editrole');
            
        } else {
            $arr['title'] = I('post.title');
            $arr['desc'] = I('post.desc');
            $id = I('post.id');
            $arr['rules'] = join(',',I('post.rule'));
            $num = D('rbac')->editGroupData($arr,$id);
            if ($num) {
                $this->success('修改成功',U('role'));
            } else {
                $this->error('修改失败',U('role')); 

            }

        }

    
    }



}

<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Common;
class Admin extends Common
{


    public function add()//管理员添加
    {
        if(request()->isPost()){
            // $res=db('admin')->insert(input('post.'));
            $admin=new AdminModel;
            $res=$admin->addadmin(input('post.'));
            if($res){
                $this->success('添加管理员成功！',url('lst'));
            }else{
                $this->error('添加管理员失败！');
            }
            return;
        }
        return view();
    }


    public function edit($id)//管理员编辑
    {
        $admins=db('admin')->find($id);  

        if(request()->isPost()){
            $data=input('post.');
            $admin=new AdminModel();
            $savenum=$admin->saveadmin($data,$admins);
            if($savenum == '2'){
                $this->error('管理员用户名不得为空！');
            }
            if($savenum!=false){
                $this->success('修改成功！',url('lst'));
            }else{
                $this->error('修改失败！');
            }
            return;
        }
            
        if(!$admins){
            $this->error('该管理员不存在！');
        }  

        $this->assign('admin',$admins);         //分配到模板中 
        return view();
    }

    public function lst()                       //管理员列表
    {
        $admin=new AdminModel();  
        $adminres=$admin->getadmin();
        $this->assign('adminres',$adminres);    //分配到模板当中
        return view();
    }

    public function del($id){
        $admin=new AdminModel();
        $delnum=$admin->deladmin($id);
        if($delnum == '1'){
            $this->success('删除管理员成功！',url('lst'));
        }else{
            $this->error('删除管理员失败！');
        }
    }

    public function logout(){
        session(null);
        $this->success('退出系统成功！',url('login/index'));

    }


}

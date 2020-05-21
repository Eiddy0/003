<?php
namespace app\admin\model;                      //模型层处理数据
use think\Model;
class Admin extends Model
{
    public function addadmin($data){            //模型层添加
        if(empty($data) || !is_array($data)){
            return false;
        }
         if($data['password']){
            $data['password']=md5( $data['password']);
        }
        if($this->save($data)){
            return true;
        }else{
            return false;
        }
    }

    public function getadmin(){                //模型层分页列表
        return $this::paginate(5);
    } 

    public function saveadmin($data,$admins){
        if(!$data['name']){
            return 2;//管理员用户名为空
        }
        if(!$data['password']){
            $data['password']=$admins['password'];
        }else{
            $data['password']=md5($data['password']);
        }
        return $this::update(['name'=>$data['name'],'password'=>$data['password']],['id'=>$data['id']]);
    
    }

    public function deladmin($id){
        if($this::destroy($id)){
            return 1;
        }else{
            return 2;
        }
    }

    public function login($data){
        $admin=Admin::getByName($data['name']);
        if($admin){
            if($admin['password'] == md5($data['password'])){
                session('id',$admin['id']);
                session('name',$admin['name']);
                return 2;//用户名和密码正确
            }else{
                return 3;//密码错误
            }
        }else{
            return 1;//用户不存在
        }
    }


}

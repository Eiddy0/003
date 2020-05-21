<?php
namespace app\admin\controller;
use app\admin\controller\Common;
class Lunbo extends Common
{
    public function lst()
    {
    	$lunbo=db('lunbo')->select();
    	$this->assign('lunbo',$lunbo);
        return view();
    }

    public function add()
    {
    	if(request()->isPost()){
    		$data=input('post.');
    		if($_FILES['img']['tmp_name']){
                $file = request()->file('img');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb='/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $data['img']=$thumb;
                }
            }
    		$res=db('lunbo')->insert($data);
    		if($res){
    			$this->success('添加轮播图成功！',url('lst'));
    		}else{
    			$this->error('添加轮播图失败！');
    		}
    	}
    	return view();
    }

    public function edit($id)
    {
    	$admins=db('lunbo')->find($id);
    	if(request()->isPost()){
    		$data=input('post.');
    		if($_FILES['img']['tmp_name']){
                $file = request()->file('img');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb='/btl/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $data['img']=$thumb;
                }
            }
            $res=db('lunbo')->where('id',$admins['id'])->update(['name'=>$data['name'],'img'=>$data['img']]);
            if($res !=false){
            	$this->success('修改成功！',url('lst'));
            }else{
            	$this->error('修改失败！');
            }
    	}
    	$lunboo=db('lunbo')->select();
    	$this->assign('lunboo',$lunboo);
        return view();
    }

    public function del()
    {
        $del=db('lunbo')->delete(input('id'));
        if($del){
            $this->success('删除栏目成功！',url('lst'));
        }else{
            $this->error('删除栏目失败！');
        }
    }
}

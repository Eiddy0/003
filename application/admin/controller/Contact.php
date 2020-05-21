<?php
namespace app\admin\controller;
use app\admin\controller\Common;
class Contact extends Common
{       
    public function lst(){
    $contactes=db('contact')->select();
    $this->assign('contactes',$contactes);
    return view();
    }

    public function del(){
        $del=db('contact')->delete(input('id'));
        if($del){
            $this->success('删除成功！',url('lst'));
        }else{
            $this->error('删除失败！');
        }
    }
}

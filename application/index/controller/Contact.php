<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
class Contact extends Common
{
    public function index()
    {

        $rest = input('post.');
    	if(request()->isPost()){
            $data=[
            	'name'=>$rest['name'],
            	'email'=>$rest['email'],
            	'subject'=>$rest['subject'],
            	'message'=>$rest['message'],
            ];
            $add=db('contact')->insert($data);
            if($add){
                $this->success('成功！',url('contact/index'));
            }else{
                $this->error('失败！');
            }
            return;
       }
        return view('contact');
    }
}

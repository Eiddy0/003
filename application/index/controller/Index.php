<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
    	$min = db('article')->min('id'); 
    	$max = db('article')->max('id'); 
    	$rundom = rand($min,$max);
    	$rundom1 = rand($min,$max);
        $rundom2 = rand($min,$max);
        $rundom3 = rand($min,$max);
    	$list = db('article')->where('id',$rundom)->where('nac','1')->find();
    	$list1 = db('article')->where('id',$rundom1)->where('nac','1')->find();
        $list2 = db('article')->where('id',$rundom2)->where('nac','1')->find();
        $list3 = db('article')->where('id',$rundom3)->where('nac','1')->find();
    	$img=db('lunbo')->select();
    	$this->assign('list',$list);
    	$this->assign('list1',$list1);
        $this->assign('list2',$list2);
        $this->assign('list3',$list3);
    	$this->assign('img',$img);
        return view();
    }
}

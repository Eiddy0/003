<?php
namespace app\index\controller;
use app\index\model\Article;
class Artlist1 extends Common
{
    public function index()
    {
    	$id=input('cateid');
    	$arte=db('cate')->where('id', $id)->find();
    	$artes=db('cate')->where('pid',$arte['id'])->select();
    	$this->assign('arte',$arte['cate_name']);
    	$this->assign('artes',$artes);
        return view('artlist1');
    }
}

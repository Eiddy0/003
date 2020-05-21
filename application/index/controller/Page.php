<?php
namespace app\index\controller;

class Page extends Common
{
    public function index()
    {
    	$cates=db('cate')->find(input('cateid'));
    	$cate=new \app\index\model\Cate();
        $cateid = input('cateid');
        $posarr=$cate->getparents($cateid);
        $caterow=db('cate')->where('pid',$posarr[0]['id'])->select();
        $this->assign(array(
        	'cates'=>$cates,
        	'cates'=>$cates,
        	'parentcate'=>$posarr[0],	
    ));
        return view('page');
    }
}

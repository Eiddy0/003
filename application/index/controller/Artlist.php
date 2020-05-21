<?php
namespace app\index\controller;
use app\index\model\Article;
class Artlist extends Common
{
    public function index()
    {
        $id=input('cateid');
    	$article=new Article();
    	$artres=$article->getallarticles(input('cateid'));
        $artee=db('cate')->where('id', $id)->find();
    	$cate=new \app\index\model\Cate();
    	$cateid = input('cateid');
    	$posarr=$cate->getparents($cateid);
 		$caterow=db('cate')->where('pid',$posarr[0]['id'])->select();
    	$this->assign(array(
    		'artres'=>$artres,
    		'caterow' => $caterow,
            'parentcate'=>$posarr[0],
    	));
        $this->assign('artee',$artee['cate_name']);
        return view('artlist');
    }
}

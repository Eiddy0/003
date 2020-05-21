<?php
namespace app\index\controller;
use app\index\model\Article;
class Search extends Common
{
    public function index()
    {
   //  	$article=new Article();
   //  	$artres=$article->getallarticles(input('cateid'));
   //  	$cate=new \app\index\model\Cate();
   //  	$cateid = input('cateid');
   //  	$posarr=$cate->getparents($cateid);
 		// $caterow=db('cate')->where('pid',$posarr[0]['id'])->select();
   //  	$this->assign(array(
   //  		'artres'=>$artres,
   //  		'caterow' => $caterow,
   //          'parentcate'=>$posarr[0],
   //  	));
        $keywords=input('keywords');
        $seres=db('article')->order('id desc')->where('title','like','%'.$keywords.'%')->paginate(4);
        $this->assign('seres',$seres);
        return view('search');
    }
}

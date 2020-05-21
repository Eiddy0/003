<?php
namespace app\index\controller;

class Article extends Common
{
    public function index()
    {
 		$artid=input('artid');
    	db('article')->where(array('id'=>$artid));
    	$articles=db('article')->find($artid);
    	$artice=db('article')->where('cateid',$articles['id'])->select();
    	$this->assign('artice',$artice);
    	$this->assign('articles',$articles);
        return view('article');
    }
}

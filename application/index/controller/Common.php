<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
	public function _initialize(){
        if(input('cateid')){
            $this->getPos(input('cateid'));
        }
        if(input('artid')){
            $articles=db('article')->field('cateid')->find(input('artid'));
            $cateid=$articles['cateid'];
            $this->getPos($cateid);
        }
		$this->getNavCates();
	}

    public function getNavCates(){
    	$cateres=db('cate')->where(array('pid'=>0))->select();
    	foreach ($cateres as $k => $v) {
    		$children=db('cate')->where(array('pid'=>$v['id']))->select();
    		if($children){
                $cateres[$k]['children']=$children;
            }else{
                $cateres[$k]['children']=0;
            }          
    	}
        $this->assign('cateres',$cateres);
    }

    public function getPos($cateid){
        $cate= new \app\index\model\Cate();
        $posarr=$cate->getparents($cateid);
        $this->assign('posarr',$posarr);
    }
}

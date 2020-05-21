<?php
namespace app\index\model;
use think\Model;
use app\index\model\Cate;
class Article extends Model
{
	public function getallarticles($cateid){
		$cate=new Cate();
		$allcateid=$cate->getchilrenid($cateid);
		$artres=db('article')->where("cateid IN($allcateid)")->paginate(8);
		return $artres;
	}
    
}

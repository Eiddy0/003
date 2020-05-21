<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
use app\admin\controller\Common;
class Cate extends Common
{
       protected $beforeActionList = [
        'delsoncate'  =>  ['only'=>'del'],
    ];

    public function lst(){
      $cate=new CateModel();
      $cateres=$cate->catetree();
      $this->assign('cateres',$cateres);
      return view();  
    }

    public function add(){
        $cate=new CateModel();
        if(request()->isPost()){
            $data=input('post.');
            if($_FILES['cate_img']['tmp_name']){
                $file = request()->file('cate_img');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb='/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $data['cate_img']=$thumb;
                }
            }
            $add=$cate->save($data);
            if($add){
                $this->success('添加栏目成功！',url('lst'));
            }else{
                $this->error('添加栏目失败！');
            }
       }
       $cateres=$cate->catetree();
       $this->assign('cateres',$cateres);
       return view();
    }

    public function del(){
        $del=db('cate')->delete(input('id'));
        if($del){
            $this->success('删除栏目成功！',url('lst'));
        }else{
            $this->error('删除栏目失败！');
        }
    }

    public function delsoncate(){
        $cateid=input('id'); //要删除的当前栏目的id
        $cate=new CateModel();
        $sonids=$cate->getchilrenid($cateid);
        $allcateid=$sonids;
        $allcateid[]=$cateid;
        foreach ($allcateid as $k=>$v) {
            $article=new ArticleModel;
            $article->where(array('cateid'=>$v))->delete();
        }
        if($sonids){
        db('cate')->delete($sonids);
        }
    }

    public function edit(){
        $cate=new CateModel();
        if(request()->isPost()){
            $data=input('post.');
            if($_FILES['cate_img']['tmp_name']){
                $file = request()->file('cate_img');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb='/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $data['cate_img']=$thumb;
                }
            }
            $save=$cate->save($data,['id'=>$data['id']]);
            if($save !== false){
                $this->success('修改栏目成功！',url('lst'));
            }else{
                $this->error('修改栏目失败！');
            }
            return;
        }
        $cates=$cate->find(input('id'));
        $cateres=$cate->catetree();
        $this->assign(array(
            'cateres'=>$cateres,
            'cates'=>$cates,
            ));
        return view();
    }
  
    





}

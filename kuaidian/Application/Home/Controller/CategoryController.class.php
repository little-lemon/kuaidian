<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class CategoryController extends IndexController
{
	public function lst()
	{
// 		$id = session('store_id');
		$categoryModel = D('Category');
		$data = $categoryModel->search();
		//$categoryData = $categoryModel->where($id)->select();
		$this->assign(array(
			'data' => $data['data'],
			'page' => $data['page']
		));
		$this->display();
	}
	
	public function add()
	{
		if(IS_POST)
		{
			$catModel = D('Home/Category');
			$data = $catModel->create(I('post.'),1);
			if($data)
			{
				$data['storeid'] = session('store_id');
				//var_dump($data);die;
				if($id = $catModel->data($data)->add() )
				{
// 					$this->success('添加成功！',U('lst?p='.I('get.p',1)));
// 					exit;
					$this->ajaxReturn(array('code'=>0, 'msg'=>'添加成功'));
				}else {
					$msg = $catModel->getError();
					$this->ajaxReturn(array('code'=>1, 'msg'=>$msg));
				}
			}else {
				$msg = $catModel->getError();
				$this->ajaxReturn(array('code'=>2, 'msg'=>$msg));
			}
		}
		$this->display();
	}
	
	public function edit()
	{
		$id = I('get.id');
		$catData = M('Category')->field('id,name')->where(array('id'=>array('eq',$id)))->find();
		$this->assign('catData',$catData);
		if(IS_POST)
		{
// 			$data = I('post.');
// 			echo json_encode($data);
			$model = D('Home/Category');
			if($model->create(I('post.'),2))
			{
				if($model->save() !== FALSE)
				{
// 					$this->success('修改成功！',U('lst',array('p' =>I('get.p',1))));
// 					exit;
					$this->ajaxReturn(array('code'=>0, 'msg'=>'修改成功'));
				}
			}else {
				$msg = $model->getError();
				$this->ajaxReturn(array('code'=>1, 'msg'=>$msg));
			}
		}
		$this->display();
	}
	//ajax删除设置
	public function ajaxCatDel()
	{
		$catids = I('get.catids');
		if($catids){
			$ids = explode(',',$catids);
			array_pop($ids);
		}
		M('Category')->where(array('id'=>array('in',$ids)))->delete();
		//echo json_encode($data);
		//echo $catids;
	}
	
}
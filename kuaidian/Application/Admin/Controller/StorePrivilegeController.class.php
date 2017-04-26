<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class StorePrivilegeController extends IndexController
{
	public function lst()
	{
		$model = D('Admin/StorePrivilege');
		$data = $model->getTree();
		$this->assign(array(
			'data' => $data,
		));
		$this->display();
	}
	
	public function add()
	{
		if(IS_POST)
		{
			$model = D('Admin/StorePrivilege');
			if($model->create(I('post.'),1))
			{
				if($id = $model->add())
				{
					$this->success('添加成功！', U('lst'));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$parentModel = D('Admin/StorePrivilege');
		$parentData = $parentModel->getTree();
		$this->assign('parentData',$parentData);
		
		$this->display();
	}
	
	public function edit()
	{
		$id = I('get.id');
		if(IS_POST)
		{
			$model = D('Admin/StorePrivilege');
			if($model->create(I('post.'),2))
			{
				if($model->save() !==FALSE)
				{
					$this->success('修改成功！',U('lst'));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$model = M('StorePrivilege');
		$data = $model->find($id);
		$this->assign('data',$data);
		$parentModel = D('Admin/StorePrivilege');
		$parentData = $parentModel->getTree();
		$children = $parentModel->getChildren($id);
		$this->assign(array(
			'parentData' => $parentData,
			'children' => $children,
		));
		$this->display();
	}
	
	public function delete()
	{
		$model = D('Admin/StorePrivilege');
		if($model->delete(I('get.id',0)) !== FALSE)
		{
			$this->success('删除成功！',U('lst'));
			exit;
		}
		else 
		{
			$this->error($model->getError());
		}
		$this->display();
	}
	
}
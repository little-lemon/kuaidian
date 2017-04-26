<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class AdminController extends IndexController
{
	//管理员列表
	public function lst()
	{
		$model = D('Admin/Admin');
		$data = $model->search();
		$this->assign(array(
				'data' => $data['data'],
				'page' => $data['page'],
		));
		$this->display();
	}
	
	//添加管理员
	public function add()
	{
		if (IS_POST)
		{
			$model = D('Admin/Admin');
			if($model->create(I('post.'),1))
			{
				if($id = $model->add())
				{
					$this->success('添加成功！',U('lst'));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$roleModel = M('Role');
		$roleData = $roleModel->select();
		$this->assign('roleData',$roleData);
		$this->display();
	}
	
	//修改管理员信息
	public function edit()
	{
		$id = I('get.id');
		//判断是否有权修改
		$adminId = session('admin_id');
		//如果是普通管理员要修改其它管理员的信息提示无权
		if($adminId > 1 && $adminId != $id)
			$this->error('无权修改！');
		if(IS_POST)
		{
			$model = D('Admin/Admin');
			if($model->create(I('post.'),2))
			{
				if($model->save() !== FALSE)
				{
					$this->success('修改成功！',U('lst',array('p' =>I('get.p',1))));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$model = M('Admin');
		$data = $model->find($id);
		$this->assign('data',$data);
		//取出所有角色
		$roleModel = M('Role');
		$roleData = $roleModel->select();
		$this->assign('roleData',$roleData);
		//取出当前管理员所在的角色ID
		$arModel = M('AdminRole');
		$rid = $arModel->field('GROUP_CONCAT(role_id) role_id')->where(array('admin_id'=>array('eq',$id)))->find();
		$this->assign('rid',$rid['role_id']);
		$this->display();
	}
	
	public function delete()
	{
		$model = D('Admin/Admin');
		if($model->delete(I('get.id',0)) !== FALSE)
		{
			$this->success('删除成功',U('lst',array('p' => I('get.p', 1))));
			exit;
		}
		else
		{
			$this->error($model->getError());
		}
	}
	//ajax启用设置
	public function ajaxEnable()
	{
		$userid = I('get.userid');
		M('Admin')->where(array('id'=>array('eq',$userid)))->save(array('status'=>1));
	}
	
	
	//ajax禁用设置
	public function ajaxDisable()
	{
		$userids = I('get.userids');
		if($userids)
		{
			$ids = explode(',',$userids);
			array_pop($ids);
		}
		M('Admin')->where(array('id'=>array('in',$ids)))->save(array('status'=>0));
	}
	
}
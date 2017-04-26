<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class StoreController extends IndexController 
{
	public function info()
	{
		$username = session('store_username');
		$this->assign('username',$username);
		$id = session('store_id');
		$model = M('Store');
		$admin =$model->where(array('id' =>array('eq',$id),))->find();
		$this->assign('admin',$admin);
		$this->display();
	}
	
	//店铺管理员信息修改
	public function edit()
	{
		$id = session('store_id');
		$model = D('Store');
		$admin = $model->where(array('id' =>array('eq',$id),))->find();
		$this->assign('admin',$admin);
		if(IS_POST)
		{
			if($data = $model->validate($model->_edit_validate)->create(I('post.'),2))
			{
				if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
				{
					$ret = uploadOne('logo','Home',array(
							array(150,150,2),
					));
					if($ret['ok'] == 1)
					{
						$data['logo'] = $ret['images'][0];
						$data['sm_logo'] = $ret['images'][1];
						$delimg[] = $admin['logo'];
						$delimg[] = $admin['sm_logo'];
					}
					else
					{
						$this->error = $ret['error'];
						return false;
					}
				}
				if(empty($data['password']))
				{
					$data['password'] = $admin['password'];
				}
				if($model->save($data) !== FALSE)
				{
					deleteImage($delimg);
					$this->success('修改成功' , U('info'));
					exit;
				}
			}
			$this->error($model->getError());
		}
		$this->display();
	}
	
}
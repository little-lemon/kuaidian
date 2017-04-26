<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class UserController extends IndexController
{
	public function lst()
	{
		$model = D('Admin/User');
		$data = $model->search();
		$this->assign(array(
				'data'  => $data['data'],
				'page' => $data['page'],
		));
		$this->display();
	}
	
	//ajax启用设置
	public function ajaxEnable()
	{
		$userid = I('get.userid');
		M('User')->where(array('id'=>array('eq',$userid)))->save(array('status'=>1));
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
		M('User')->where(array('id'=>array('in',$ids)))->save(array('status'=>0));
	}
}
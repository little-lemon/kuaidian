<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class StoreController extends IndexController
{
	public function lst()
	{
		$model = D('Admin/Store');
		$data = $model->search();
// 		var_dump($data); 
		$this->assign(array(
			'data'  => $data['data'],
			'page' => $data['page'],
		));
		$this->display();
	}
	
	public function edit()
	{
		$ids =$_POST['ids'];
		// trim(I('post.ids','') , ',');
		var_dump($ids);
		echo 123;die;
		//$this->display();
	}
	
	//ajax设置启用
	public function ajaxEnable()
	{
		$storeid = I('get.storeid');
// 		$ischeck = M('Store')->field('ischeck')->where(array('id'=>array('eq',$storeid)))->select();
// 		if($storeid )
// 		{
			M('Store')->where(array('id'=>array('eq',$storeid)))->save(array('status'=>1));
// 		}
// 		else 
// 		{
// 			$this->ajaxReturn(array('code'=>'1', 'msg'=>'参数错误'));
// 		}
	}
	
	//ajax审核设置
	public function ajaxIscheck()
	{
		$storeid = I('get.storeid');
		M('Store')->where(array('id'=>array('eq',$storeid)))->save(array('ischeck'=>1));
	}
	
	//ajax禁用设置
	public function ajaxDisable()
	{
		$storeids = I('get.storeids');
		if($storeids)
		{
			//$ids = substr($storeids,0,strlen($storeids)-1); 
			$ids = explode(',',$storeids);
			array_pop($ids);
			//$ids = ','.$storeids;
		}
		M('Store')->where(array('id'=>array('in',$ids)))->save(array('status'=>0));
		//M('Store')->where("','.id.',' in ($ids)")->save(array('status'=>0));  //方法二
	}
}
<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller
{
	public function __construct()
	{
		//先调用父类的构造函数
		parent::__construct();
		//获取当前管理员的ID
		$adminId = session('admin_id');
		//验证登录
		if(!$adminId)
			redirect(U('Admin/Login/login'));
		//验证当前管理员是否有权限访问这个页面
		//1、先获取当前管理员将要访问的页面 - TP框架带三个常量
// 		$url = MDULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
		//查询数据库判断当前管理员有没有访问这个页面的权限
		$where = 'module_name="'.MODULE_NAME.'" AND controller_name="'.CONTROLLER_NAME.'" AND action_name="'.ACTION_NAME.'"';
		//任何人只要登录了就可以进入后台
		if(CONTROLLER_NAME == 'Index')
			return TRUE;
		if($adminId == 1)
			$sql = 'SELECT COUNT(*) has FROM kuaidian_privilege WHERE '.$where;
		else
			$sql = 'SELECT COUNT(*) has
	                FROM kuaidian_role_privilege a
	                LEFT JOIN kuaidian_privilege b ON a.pri_id=b.id
	                LEFT JOIN kuaidian_admin_role c ON a.role_id=c.role_id
	                WHERE c.admin_id='.$adminId.' AND '.$where;
		$db = M();
		$pri = $db->query($sql);
		if($pri[0]['has'] < 1)
			$this->error('无权访问！');
			
	}
	public function index()
	{
		$this->display();
	}
	public function menu()
	{
		$adminId = session('admin_id');
		if($adminId == 1)
			$sql = 'SELECT * FROM kuaidian_privilege';
		else 
			$sql = 'SELECT * FROM kuaidian_role_privilege a
					LEFT JOIN kuaidian_privilege b ON a.pri_id = b.id
					LEFT JOIN kuaidian_admin_role c ON a.role_id = c.role_id
					WHERE c.admin_id='.$adminId;
		$db = M();
		$pri = $db->query($sql);
		$btn = array(); //放前两级的权限
		//从所有的权限中取出前两级权限
		foreach ($pri as $k => $v)
		{
			//
			if($v['parent_id'] == 0)
			{
				//
				foreach ($pri as $k1 => $v1)
				{
					if($v1['parent_id'] == $v['id'])
					{
						$v['children'][] =$v1;
					}
				}
				$btn[]=$v;
			}
		}
		$this->assign('btn',$btn);
		$this->display();
	}
	public function main()
	{
		$this->display();
	}
	public function top()
	{
		$adminId = session('admin_id');
		$model = M('Admin');
		$data= $model->field('username')->where(array('id'=>array('eq',$adminId)))->find();
		$adminName = $data['username'];
		$this->assign('adminName', $adminName);
		$this->display();
	}
}
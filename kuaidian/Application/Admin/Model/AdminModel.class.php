<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model
{
	protected $insertFields = array('username','password','cpassword','status');
	protected $updateFields = array('id','username','password','cpassword','status');
	//登入时的验证规则
	public $_login_validate = array(
			array('username','require','用户名不能为空',1),  
			array('password','require','密码不能为空',1),  
// 			array('chkcode','require','验证码不能为空',1),
// 			array('chkcode','chk_chkcode','验证码不正确！',1,'callback'),
	);
	
	//添加和修改管理员时的规则
	protected $_validate = array(
			array('username', 'require', '账号不能为空！', 1, 'regex', 3),
			array('username', '1,30', '账号的值最长不能超过 30 个字符！', 1, 'length', 3),
			//下面的规则只有添加时生效，修改时不生效，第六个参数代表什么时候验证:1-新增数据时候验证 ,2-编辑数据时候验证 ,3-全部情况下验证
			array('password', 'require', '密码不能为空！', 1, 'regex', 1),
			array('cpassword', 'password', '两次密码输入不一致！', 1, 'confirm', 3),
			array('status', 'number', '是否启用 1：启用0：禁用必须是一个整数！', 2, 'regex', 3),
			array('username', '', '账号已经存在！', 1, 'unique', 3),
	);
	
	public function chk_chkcode($code)
	{
		$verify = new \Think\Verify();
		return $verify->check($code);
	}
	
	public function login()
	{
		//获取表单中的用户名和密码
		$username = $this->username;
		$password = $this->password;
		//先查询数据库有没有这个账号
		$user = $this->where(array(
				'username' => array('eq',$username),
		))->find();
		//判断有没有账号
		if($user)
		{
			//判断是否启用(超级管理员不能禁用)
			if($user[id] == 1 || $user['status'] ==1 )
			{
				//判断密码
				if($user['password'] == md5($password.C('MD5_KEY')))
				{
					//把ID和用户名存到session中
					session('admin_id',$user['id']);
					return TRUE;
				}
				else 
				{
					$this->error = '密码不正确！';
					return FALSE;
				}
			}
			else 
			{
				$this->error = '账号被禁用！';
				return FALSE;
			}
		}
		else 
		{
			$this->error = '用户名不存在！';
			return FALSE;
		}
	}
	
	public function search($pageSize = 5)
	{
		/******************* 搜索 ************************/
		$where = array();
		if($username = I('get.username'))
			$where['username'] = array('like',"%$username%");
		if($status = I('get.status'))
			$where['status'] = array('eq',$status);
		$count = $this->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		//设置翻页的样式
		$page->setConfig('header', '条数据');
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/****************** 取数据 *********************/
		$data['data'] = $this->field('*')->where($where)->order('status asc, id asc')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	
	// 插入数据前的回调方法
    protected function _before_insert(&$data,$options) {
    	$data['addtime'] = time();
    	$data['password'] = md5($data['password'].C('MD5_KEY'));
    }
    
    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
    	$roleId = I('post.role_id');
    	if($roleId)
    	{
    		$arModel = M('AdminRole');
    		foreach($roleId as $v)
    		{
    			$arModel->add(array(
    				'admin_id' => $data['id'],
    				'role_id' => $v,
    			));
    		}
    	}
    }
    
    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) {
    	//如果是超级管理员必须是启用的
    	if ($options['where']['id'] == 1)
    		$data['status'] = 1;
    	$roleId = I('post.role_id');
    	//先清除原来的数据
    	$arModel = M('AdminRole');
    	$arModel->where(array('admin_id'=>array('eq',$options['where']['id'])))->delete();
    	if($roleId)
    	{
    		foreach($roleId as $v)
    		{
    			$arModel->add(array(
    				'admin_id' => $options['where']['id'],
    				'role_id' => $v,
    			));
    		}
    	}
    	//判断密码为空就不修改这个字段
    	if(empty($data['password']))
    		unset($data['password']);
    	else 
    		$data['password']=md5($data['password'].C('MD5_KEY'));
    }
    
	// 删除数据前的回调方法
    protected function _before_delete($options) {
    	if($options['where']['id' == 1])
    	{
    		$this->error = '超级管理员不能被删除！';
    		return FALSE;
    	}
    	$arModel = M('AdminRole');
    	$arModel->where(array('admin_id'=>array('eq',$options['where']['id'])))->delete();
    }   
}
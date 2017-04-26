<?php
namespace Home\Model;
use Think\Model;
class StoreModel extends Model
{
	//注册时表单允许提交的字符
	protected $insertFields = array('username','password','cpassword','truename','tel','storename','province','city','area','addr',
			'detailedaddress','storeaddress','storedesc','chkcode','mustclick');
	//修改时表单允许更改的字段
	protected $updateFields = array('id','password','tel','logo','sm_logo');
	//登入时的验证规则
	public $_login_validate = array(
			array('username','require','用户名不能为空',1),
			array('password','require','密码不能为空',1),
			array('chkcode','require','验证码不能为空',1),
			array('chkcode','chk_chkcode','验证码不正确！',1,'callback'),
	);
	//注册时的表单验证
	protected $_register_validate = array(
		array('mustclick', 'require', '必须同意注册协议才能注册！', 1),
		array('username','require','用户名不能为空',1),
		array('username', '', '用户名已经注册！', 1, 'unique'),
		array('password','require','密码不能为空',1),
		array('password','6,20','密码必须是6-20位的字符',1,'length'),
		array('cpassword', 'password', '两次密码输入不一致！', 1, 'confirm'),
		array('chkcode', 'require', '验证码不能为空！', 1),
		array('chkcode', 'chk_chkcode', '验证码不正确！', 1, 'callback'),
		array('tel','require','联系方式不能为空',1),
		array('tel','/^1[3|4|5|7|8][0-9]{9}$/','电话号码格式不正确',1,'regex'),
		array('storename','require','店铺名称不能为空不能为空',1),
		array('province', 'chk_province', '请选择省份！', 1, 'callback'),
		array('city', 'chk_city', '请选择城市！', 1, 'callback'),
		array('area', 'chk_area', '请选择地区！', 1, 'callback'),
		array('detailedaddress', 'chk_detailedaddress', '详细地址不能为空！', 1, 'callback'),
	);
	//更改时的表单验证
	public $_edit_validate = array(
			//array('password','require','密码不能为空',1),
	);
	
	//验证码
	public function chk_chkcode($code)
	{
		$verify = new \Think\Verify();
		return $verify->check($code);
	}
	
	//省份验证
	public function chk_province($province)
	{
		if($province == '0')
			return false;
		else
			return true;
	}
	
	//城市验证
	public function chk_city($city)
	{
		if($city == '0')
			return false;
		else
			return true;
	}
	
	//地区验证
	public function chk_area($area)
	{
		if($area == '0')
			return false;
		else
			return true;
	}
	
	//详细地址验证
	public function chk_detailedaddress($detailedaddress)
	{
		if($detailedaddress == '')
			return false;
		else
			return true;
	}
	
	//把地址拼成一个字符串
	public function storeaddress()
	{
		$data = I('post.');
		$addr= $data[addr];
		$detailedaddress=$data[detailedaddress];
		$data[storeaddress] =  $addr.",".$detailedaddress;
		return $data;
 		//var_dump($data);die;
	}
	
	public function login()
	{
		//获取表单的用户名和密码
		$username = $this->username;
		$password = $this->password;
		//查询数据库有没有这个用户
		$user = $this->where(array(
			'username' =>array('eq',$username),
		))->find();
		//判断用户的状态及密码是否正确
		if($user)
		{
			//判断是用户的状态
			if($user[ischeck] == 0)
			{
				$this->error = '该账号正在审核中...';
				return false;
			}
			elseif($user[status] == 0)
			{
				$this->error = '该账号已被禁用，请联系管理员！';
				return false;
			}
			else
			{
				if($password == $user[password])
				{
					session('store_id',$user[id]);
					return true;
				}
				else 
				{
					$this->error = '密码不正确！';
					return false;
				}
			}
		}
	}
	

	protected function _before_insert(&$data, $option)
	{
		$data['addtime']=time();
		$data['status'] = 0;
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
		{
			$ret = uploadOne('logo','Home',array(
				array(150,150,2),
			));
			if($ret['ok'] == 1)
			{
				$data['logo'] = $ret['images'][0];
				$data['sm_logo'] = $ret['images'][1];
			}
			else
			{
				$this->error = $ret['error'];
				return false;
			}
		}
	}
	
 	protected function _before_update(&$data, $options)
 	{
// 		$data['ischeck']= 0 ;
// 		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
// 		{
// 			$ret = uploadOne('logo','Home',array(
// 				array(150,150,2),
// 			));
// 			if($ret['ok'] == 1)
// 			{
// 				$data['logo'] = $ret['images'][0];
// 				$data['sm_logo'] = $ret['images'][1];
// 			}
// 			else 
// 			{
// 				$this->error = $ret['error'];
// 				return false;
// 			}
// 			deleteImage(array(
// 				I('post.old_logo'),
// 				I('post.old_sm_logo'),
// 			));
// 		}
	}
}
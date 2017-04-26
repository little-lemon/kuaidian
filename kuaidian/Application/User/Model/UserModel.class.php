<?php
namespace User\Model;
use Think\Model;
class UserModel extends Model{
	//注册时表单允许提交的字符
// 	protected $insertFields = array('username','password','cpassword','chkcode','mustclick');
	
	//注册时的表单验证
	protected $_validate = array(
// 			array('mustclick', 'require', '必须同意注册协议才能注册！', 1),
// 			array('username','require','用户名不能为空',1),
// 			array('username', '', '用户名已经注册！', 1, 'unique'),
// 			array('password','require','密码不能为空',1),
// 			array('password','6,20','密码必须是6-20位的字符',1,'length'),
// 			array('cpassword', 'password', '两次密码输入不一致！', 1, 'confirm'),
// 			array('chkcode', 'require', '验证码不能为空！', 1),
// 			array('chkcode', 'chk_chkcode', '验证码不正确！', 1, 'callback'),
		//-1电话格式不正确
		array('username','8,11','-1',self::EXISTS_VALIDATE,'length'),
		//-2用户以存在
		array('username','','-2',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
		//-3密码长度不合法
		array('password','6,30','-3',self::EXISTS_VALIDATE,'length'),
		//-4验证码错误
		array('verify','check_verify','-4',self::EXISTS_VALIDATE,'function'),
	);
	
	//验证码
// 	public function chk_chkcode($code)
// 	{
// 		$verify = new \Think\Verify();
// 		return $verify->check($code);
// 	}
	
	//插入前增加 addtime 和 status 字段
	protected function _before_insert(&$data,$options) {
		$data['addtime']=time();
		$data['status'] = 1;
	}
	
	//验证占用字段
	public function checkField($field,$type)
	{
		$data = array();
		switch($type){
			case 'username':
				$data['usernames']=$field; //用户名
				break;
			case 'verify':
				$data['verify']=$field;
				break;
			default:
				return 0;
		}
		return $this->create($data) ? 1 : $this->getError();
	}
	//登入用户
	public function login($username,$password){
		$data = array(
			'username' => $username,
			'password' => $password,
		);
		$map['username']=$username;
		$map['password']=$password;
		$user=$this->field('id,username,status')->where($map)->find();
		if(!empty($user['id'] )&& $user['status']==1){
 			session('username',$user['username']);
 			session('user_id',$user['id']);
			cookie('username',$user['username']); 
			return $user['id'];
		}
		else{
			return '-1';
		}
	}
	
	//用户注册
	public function register($username,$password){
		$data=array(
			'username'=>$username,
			'password'=>$password,
		);
		if($this->create($data)){
			$uid=$this->add();
			if($uid){
				session('username',$data['username']);
				cookie('username',$data['username']);
				return $uid?$uid:0;
			}
			//return $uid?$uid:0;
		}else{
			return $this->getError();
		}
	}
	
}
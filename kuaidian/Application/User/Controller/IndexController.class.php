<?php
namespace User\Controller;
use Think\Controller;
class IndexController extends Controller
{
	//系统首页
	public function index(){
		$storeData = M('Store')->where('status=1 AND ischeck=1')->select();
		//var_dump($storeData);
		$this->assign('storeData',$storeData);
		$this->display();
	}
	
	//系统首页
	public function login()
	{
		$this->display();
	}
	
	public function loginAction()
	{
		if(IS_AJAX){
			$userModel = D('User/User');
			$uid = $userModel->login(I('post.username'),I('post.password'));
			echo $uid;
		}
		else{
			$this->error('您好，请登录...');
		}
	}
	
	//系统首页
	public function register()
	{
		$this->display();
	}
	
	public function registerAction()
	{
			$userModel = D('User/User');
			$uid = $userModel->register(I('post.username'),I('post.password'));
			echo $uid;
	}
	
	//生成验证码的图片
	public function chkcode()
	{
		$config = array(
				'fontSize'  =>  20,         // 验证码字体大小
				'length'     =>  4,           // 验证码位数
				'useNoise' =>  TRUE,    // 关闭验证码杂点
				'imageW'  => 150,
				'imageH'   => 40,
				'useCurve' =>true,      //是否使用混淆曲线 默认为true
		);
		$Verify = new \Think\Verify($config);
		$Verify->entry();
		//session('verify',$Verify);
	}
	
	//判断input框中输入的验证码是否正确
// 	public function ajaxCheckCode()
// 	{
// 		$code =  I('get.code');
// 		$verify = session('verify');
// 		$state = $verify->check($code);
// 		//echo $state;
// 				if(!$state){
// 					echo json_encode(array(
// 							'ok' => 0,
// 							'error' => '验证码错误',
// 							'verify' => $verify,
// 					));
// 					exit;
// 				}
// 				else {
// 					echo json_encode(array(
// 							'ok' => 1,
// 							'msg' => '验证码正确',
// 					));
// 				}
// 	}
	
	public function checkVerify()
	{
		if(IS_AJAX){
			$userModel = D('User/User');
			$uid = $userModel->checkField(I('post.verify'),'verify');
			//echo $uid == '-4' ?'false':'true';//返回值必须为ture和false
			echo $uid==''?'true':'false'; //返回值必须为ture和false
		}
		else
		{
			$this->error('非法访问');
		}
	}
	
	//退出登录
	public function logout(){
		//清理session
		session(null);
		//清除自动登录的cookie
		cookie('username',null);
		//跳转到正确跳转页面
		$this->redirect('Index/index');
	}
}
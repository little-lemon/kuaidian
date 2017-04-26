<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{
	//店铺管理员登入
	public function login()
	{
		if(IS_POST)
		{
			$model = D('Store');
			// 使用validate方法来指定使用模型中的哪个数组做为验证规则，默认是使用$_validate
			if($model->validate($model->_login_validate)->create())
			{
				if(true === $model->login())
					redirect(U('Home/Index/index')); //直接跳转可以不提示信息
			}
			$this->error($model->getError());
		}
		$this->display();
	}
	
	//退出登录
	public function logout()
	{
		session_unset();
		redirect(U('Home/Index/index'));
		//redirect('/');
		//redirect(U('Home/Login/login'));		
	}
	
	//店铺管理员注册
	public function register()
	{
		if(IS_POST)
		{
			// 			if ($_FILES[logo][name] != "")
				// 			{
				// 				var_dump($_FILES['logo']);
				// 			}
			$model = D('Store');
			//$data = I('post.');var_dump($data);
			$model->validate($model->_register_validate);
			$data = $model->storeaddress();
			//    		var_dump($data);die;
			if( $model->create($data, 1) )
			{
				// 				$data = $model->create($data, 1);
				// 				var_dump($data);die;
				if($model->add())
				{
					$this->success('注册成功，请等待审核，审核通过后管理员会通知您');
					exit;
				}
			}
			$this->error($model->getError());
		}
		$this->display();
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
	}
	
}
<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller
{
	//后台管理员登入
	public function login()
	{
		if(IS_POST)
		{
			$model = D('Admin');
			// 使用validate方法来指定使用模型中的哪个数组做为验证规则，默认是使用$_validate
			if($model->validate($model->_login_validate)->create())
			{
				if(TRUE === $model->login())
					redirect(U('Admin/Index/index'));  //直接跳转可以不提示信息
			}
			$this->error($model->getError());
		}
		$this->display();
	}
	
	//后台管理员注册
	public function register()
	{
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
<?php
namespace User\Controller;
use Think\Controller;
class LoginController extends Controller
{
	//前台普通用户登录
	public function login()
	{
		$this->display();
	}
	
	//前台普通用户注册
	public function register()
	{
		if(IS_POST)
		{
			$model = D('User');
			if( $model->create($data, 1) )
			{
				if($model->add())
				{
					$this->success('注册成功');
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
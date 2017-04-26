<?php
namespace User\Controller;
use Think\Controller;
class PickController extends Controller
{
	public function lst()
	{
// 		$user_id = $_SESSION['user_id'];
		$orderData = M('Order')->order('add_times desc')->where(array('pick_status'=>array('eq',1)))->select();
		foreach($orderData as $k => $v)
		{
			/*根据store_id,取出店铺名称*/
			$storeId = $orderData["$k"]["store_id"];
			$orderData["$k"]["storename"] =M('Store')->field('storename')->where(array('id' => array('eq',$storeId)))->find()['storename'];
			$orderData["$k"]["storeaddress"] =M('Store')->field('storeaddress')->where(array('id' => array('eq',$storeId)))->find()['storeaddress'];
			/*将取出的具体的订单信息中的add_times字段的时间戳转换成具体的时间格式*/
			$orderData["$k"]["add_times"] = date("Y-m-d H:i",$orderData["$k"]["add_times"]);
		}
		$this->assign(array(
				"orderData" => $orderData
		));
		$this->display();
	}
	
	public function pick_confirm(){
		$orderNumber= I('get.order_number');
		$this->assign('orderNumber',$orderNumber);
		$this->display();
	}
	
	public function ajaxPickSubmit(){
		if( empty($_SESSION['user_id']) ){
			$this->ajaxReturn(array('code'=>1, 'msg'=>'请先登录'));
		}
		if(IS_POST)
		{
			$order_number = I('post.order_number');
			if($order_number)
			{
				$result = M('Order')->where(array('order_number'=>array('eq',$order_number)))->setField('pick_status', 3);
				if($result)
				{
					$this->ajaxReturn(array('code'=>0, 'msg'=>''));
				}
				else
				{
					$this->ajaxReturn(array('code'=>2, 'msg'=>'摘单出错，请重试!'));
				}
			}
		}
	}
	
	
}
<?php
namespace User\Controller;
use Think\Controller;
class OrderController extends Controller 
{
	public function lst()
	{
		$user_id = $_SESSION['user_id'];
		$myOrderData = M('Order')->order('post_status asc,add_times desc')->where(array('user_id' => array('eq',$user_id)))->select();
		foreach($myOrderData as $k => $v)
		{
			/*根据store_id,取出店铺名称*/
			 $storeId = $myOrderData["$k"]["store_id"];
			$myOrderData["$k"]["storename"] =M('Store')->field('storename')->where(array('id' => array('eq',$storeId)))->find()['storename'];
			/*将取出的具体的订单信息中的add_times字段的时间戳转换成具体的时间格式*/
			$myOrderData["$k"]["add_times"] = date("Y-m-d H:i",$myOrderData["$k"]["add_times"]);
			/*根据kuaidian_order表中的订单号（order_number）取出订单的具体菜品*/
			$orderNumber = $myOrderData["$k"]["order_number"];
			$goods =  M("OrderGoods")->field('goods_id,goods_price,goods_number')->where(array('order_number' => array('eq',$orderNumber)))->select();
			foreach($goods as $k1 => $v1)
			{
				$goods["$k1"]['goods_name'] = M('Goods')->field('goods_name')->where(array('id' => array('eq',$goods["$k1"]['goods_id'])))->find()['goods_name'];
			}
			$myOrderData["$k"]["goods"] =$goods;
		}
		$this->assign(array(
				"myOrderData" => $myOrderData
		));
		$this->display();
	}
} 
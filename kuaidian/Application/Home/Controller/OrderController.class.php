<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class OrderController extends IndexController
{
	public function lst()
	{
		$storeId = session("store_id");
		$orderData = M('Order')->where(array('store_id' => array('eq',$storeId)))->select();
		foreach($orderData as $k => $v)
		{
			if($orderData["$k"]["room_time"] != 0 )
			{
				$orderData["$k"]["room_time"] = date("H:i",$orderData["$k"]["room_time"]);
			}
			$orderData["$k"]["add_times"] = date("Y-m-d H:i:s",$orderData["$k"]["add_times"]);
			$orderNumber = $orderData["$k"]["order_number"];
			$goods =  M("OrderGoods")->field('goods_id,goods_price,goods_number')->where(array('order_number' => array('eq',$orderNumber)))->select();
			foreach($goods as $k1 => $v1)
			{
				$goods["$k1"]["goods_name"] = M('Goods')->field('goods_name')->where(array('id' => array('eq',$goods["$k1"]['goods_id'])))->find()['goods_name'];
			}
			$orderData["$k"]["goods"] = $goods;
		}
		$this->assign('orderData',$orderData);
		$this->display();
	}
}
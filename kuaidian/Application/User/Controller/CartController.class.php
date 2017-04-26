<?php
namespace User\Controller;
use Think\Controller;
class CartController extends Controller 
{
	//展示购物车
	public function lst()
	{
// 		$cartModel = D('User/Cart');
// 		$data = $cartModel->cartList();
		$storeId = I('get.storeId');
		$cart_storeId = 'cart_'.$storeId;
		$storeInfo = M('Store')->field('id,storename,sm_logo')->where(array('id' => array('eq',$storeId) ))->select();
		$_cart_ =isset($_COOKIE["$cart_storeId"]) ? unserialize($_COOKIE["$cart_storeId"]) : array();
 		$allGoodsId  = M('Goods')->field('id')->where(array('store_id'=>array('eq',$storeId)))->select();
		//$goodsIdStr = '';
		if($_cart_ ){
			foreach($_cart_ as $key => $value){
				//$goodsIdStr = $goodsIdStr.','.$key;
				$goodsIdArr[] = $key;
			}
			//$goodsIdStr =  ltrim($goodsIdStr, ",");
			//$goodsData  = M('Goods')->field('id,store_id,goods_name,goods_price')->where(array('id'=>array('in',$goodsIdArr)))->select();
			$goodsData  = M('Goods')->where(array('id'=>array('in',$goodsIdArr)))->select();
			foreach($goodsData as $key => $value){
				$cartGoodsId = $goodsData["$key"]['id'];
				if(in_array($cartGoodsId, $goodsIdArr)){
					$goodsData["$key"]['goods_count'] = $_cart_["$cartGoodsId"];
				}
			}
		}
		$this->assign(array(
				'storeInfo' =>  $storeInfo,
				'goodsData'  => $goodsData
		));
// 		$sql = 'select id from kuaidian_goods where store_id='.$storeId;
// 		$allGoodsId = M('Goods')->query($sql);
		$this->display();
/* 		var_dump($_cart_);
 		var_dump($allGoodsId); */
		var_dump($goodsData);
		//var_dump($storeInfo);
		
		
		
	}
	
	//提交订单
	public function ajaxOrderSubmit()
	{
		if( empty($_SESSION['user_id']) ){
			$this->ajaxReturn(array('code'=>1, 'msg'=>'请先登录'));
		}
		if(IS_POST)
		{
			$orderModel = D('User/Order');
			$data = I('post.');
			$time = time();
			$data['add_times'] = $time;
			$data['order_number'] = $time.rand(111111, 999999);
			$data['user_id'] = session('user_id');
			if($data['room_time'] != '0'){
				$data['room_time'] = strtotime($data['room_time']);
			}
			$data = $orderModel->create($data,1);
			if($data)
			{
				if($id = $orderModel->data($data)->add() )
				{
					$this->ajaxReturn(array('code'=>0, 'msg'=>''));
				}
				else
				{
					$this->ajaxReturn(array('code'=>2, 'msg'=>'下单出错，请重试!'));
				}
			}
		}
	}

	
	
}
<?php
namespace User\Controller;
use Think\Controller;
class GoodsController extends Controller 
{
	//店铺详情页
	public function goods()
	{
		$storeId = I('get.store_id');
		$goodsData = M('Goods')->where(array('store_id'=>array('eq',$storeId)))->select();
		//$this->assign('goodsData',$goodsData);
		$this->assign(array(
				'storeId' => $storeId,
				'goodsData' => $goodsData
		));
		//var_dump($goodsData);
		$this->display();
	}
	
    //ajax加入购物车
	public function ajaxAddToCart()
	{
		$goodsModel = D('User/Goods');
		$goodsData= I('get.storeId_goodsId_count');
		$store_id = $goodsData[0];
		//$cart_storeId = 'cart_'.$store_id;
 		$goods_id = $goodsData[2];
 		$expr = $goodsData[4];
  		$goods_count =$goodsData[6];
		if($goodsData){
			$goodsModel->addToCart($store_id,$goods_id,$expr,$goods_count);
		}
		//测试
// 		$_cart_ = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
// 		echo $_cart_;
	}
	
}
<?php
namespace User\Model;
use Think\Model;
class GoodsModel extends Model{
	//加入购物车
	/*public function addToCart($store_id,$goods_id,$expr,$goods_count)
	{
		//先从COOKIE中取出购物车的数组
		$cart[$store_id] = isset($_COOKIE['cart['.$store_id.']']) ? unserialize($_COOKIE['cart['.$store_id.']']) : array();
		if($expr == '+'){
			if(isset($cart[$store_id][$goods_id]))
				$cart[$store_id][$goods_id] += $goods_count;
			else 
				$cart[$store_id][$goods_id] = $goods_count + 0;
		}
		elseif($expr == '-'){
			$cart[$store_id][$goods_id] -= $goods_count;
		}
		//把数组存回到cookie
		$oneDay = 1 * 86400;
		setcookie('cart['.$store_id.']', serialize($cart[$store_id]), time()+$oneDay, '/', '');
	}*/
	
	public function addToCart($store_id,$goods_id,$expr,$goods_count)
	{
		//先从COOKIE中取出购物车的数组
		$cart_storeId = 'cart_'.$store_id;
		$cart = isset($_COOKIE["$cart_storeId"]) ? unserialize($_COOKIE["$cart_storeId"]) : array();
		if($expr == '+'){
			if(isset($cart[$goods_id]))
				$cart[$goods_id] += $goods_count;
			else
				$cart[$goods_id] = $goods_count + 0;
		}
		elseif($expr == '-'){
			$cart[$goods_id] -= $goods_count;
		}
		//把数组存回到cookie
		$oneDay = 1 * 86400;
		setcookie("$cart_storeId", serialize($cart), time()+$oneDay, '/', '');
	}
}
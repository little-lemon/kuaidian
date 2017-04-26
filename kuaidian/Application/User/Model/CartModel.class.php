<?php
namespace User\Model;
use Think\Model;
class CartModel extends Model{
	public function cartList()
	{
		$_cart_ = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
		return $_cart_ ;
	}
	
}
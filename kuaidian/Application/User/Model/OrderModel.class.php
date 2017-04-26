<?php
namespace User\Model;
use Think\Model;
class OrderModel extends Model{
	//添加时表单允许提交的字段
	protected $insertFields = array('user_id','store_id','total_price','scr_name','scr_tel','scr_address','room_time','payment_method','mark','add_times',
			'order_number','pay_status','post_status');
	//插入时的验证规则
	public $_validate = array(
			array('scr_name','require','收餐人不能为空',self::MUST_VALIDATE),
			array('scr_tel','require','收餐电话不能为空',self::MUST_VALIDATE),
			array('scr_address','require','收餐地址不能为空',self::MUST_VALIDATE),
			array('room_time', 'require', '送餐时间', self::MUST_VALIDATE)
	);
	
/* 	public function insertOrder($data)
	{
		$data['add_times'] = time();
		$data['order_number'] = $time.rand(111111, 999999);
		$data['user_id'] = session('user_id');
		$data['pay_status'] = 0;
		$data['post_status'] = 0;
		//$data = $this->create($data,1);
		if($this->create($data,1))
		{
			if($id = $this->add())
			{
				return $id;
			}
		}
		return $data;
	} */
	
    // 插入成功后的回调方法  订单的具体goods信息存入kuaidian_order_goods表中
    protected function _after_insert($data,$options) {
    	$cart_storeId = 'cart_'.$data['store_id'];
    	$_cart_ =isset($_COOKIE["$cart_storeId"]) ? unserialize($_COOKIE["$cart_storeId"]) : array();
    	$i = 0;
    	foreach($_cart_  as $key => $value )
    	{
    		$order_goods[$i]['order_number'] = $data['order_number'];
    		$order_goods[$i]['store_id'] = $data['store_id'];
    		$order_goods[$i]['user_id'] = session('user_id');
    		$order_goods[$i]['goods_id'] = $key;
    		$order_goods[$i]['goods_number'] =$value;
    		$order_goods[$i]['goods_price'] = M('Goods')->field('goods_price')->where(array('id' => array('eq',$key) ))->find()['goods_price'];
    		$i +=1;
    	}
    	M('OrderGoods')->addAll($order_goods);
    	//清空COOKIE中的数据
    	//$cart_storeId = 'cart_'.$data['store_id'];
    	setcookie("$cart_storeId",'',time()-1,'/','');
    	//setcookie('cart','',time()-1,'/','');
    }
    
}
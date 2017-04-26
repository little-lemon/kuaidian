<?php
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model
{
	//添加时表单允许提交的字段
	protected $insertFields = array('store_id','goods_name','cat_id','goods_price','is_recommend');
	//插入时的验证规则
	public $_validate = array(
			array('goods_name','require','菜品名称不能为空',self::MUST_VALIDATE),
			array('cat_id','require','所属分类不能为空',self::MUST_VALIDATE),
			array('goods_price','require','菜品价格不能为空',self::MUST_VALIDATE),
			array('goods_name', '', '菜品名称已存在', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH)
	);
	//添加菜品是允许自动插入的字段
	protected $_auto = array (
			array('addtime','time',self::MODEL_INSERT,'function'), //新增的时候插入addtime字段的时间戳
	);
	// 插入数据前的回调方法
	protected function _before_insert(&$data,$options) 
	{
		if(isset($_FILES['goods_pic']) && $_FILES['goods_pic']['error'] == 0)
		{
			$ret = uploadOne('goods_pic','Home',array(
					array(150,150,2),
			));
			if($ret['ok'] == 1)
			{
				$data['goods_pic'] = $ret['images'][0];
				$data['goods_sm_pic'] = $ret['images'][1];
			}
			else
			{
				$this->error = $ret['error'];
				return false;
			}
		}
	}
	
    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) 
    {
    	 if(isset($_FILES['goods_pic']) && $_FILES['goods_pic']['error'] == 0)
    	{
    		$ret = uploadOne('goods_pic', 'Home',array(
    				array(150,150,2),
    		));
    		if($ret['ok'] == 1)
    		{
    			$data['goods_pic'] = $ret['images'][0];
    			$data['goods_sm_pic'] = $ret['images'][1];
    		}else {
    			$this->error = $ret['error'];
    			return FALSE;
    		}
    		//取出要删除的图片地址
    		$oldData = $this->field('goods_pic,goods_sm_pic')->where($options['where'])->find();
//     		var_dump($oldData);
    		deleteImage($oldData);
    	}
    }
    
    // 删除数据前的回调方法
//     protected function _before_delete($options)
//     {
//     	if(is_array($option['where']['id']))
//     	{
//     		$this->error = '不支持批量删除';
//     		return FALSE;
//     		echo $this->error;
//     	}
//     	var_dump($options);
//     	$images = $this->field('goods_pic,goods_sm_pic')->find($option['where']['id']);
//     	deleteImage($images);
//     }    
	
	public function search($pageSize = 5)
	{
		/******************* 搜索 ************************/
		$where = array();
		$storeid = session('store_id');
		$where['store_id'] = array('eq',$storeid);
		if($goods_name = I('get.goods_name'))
			$where['goods_name'] = array('like',"%$goods_name%");
		$count = $this->where($where)->count();		
		$page = new \Think\Page($count, $pageSize);
		//设置翻页的样式
		$page->setConfig('header', '条数据');
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/****************** 取数据 *********************/
		$data['goods'] = $this->field('*')->where($where)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		/*count函数有两个参数：0(或COUNT_NORMAL)为默认,不检测多维数组(数组中的数组);1(或COUNT_RECURSIVE)为检测多维数组，*/
		$len = count($data['goods'],COUNT_NORMAL);
		//获取分类id对应的分类名称，合并到data['goods]数组
		for( $i=0; $i<$len; $i++)
		{
				$cat_id = $data['goods'][$i]['cat_id'];
				$cat_name = M('Category')->field('name')->where(array('id'=>array('eq',$cat_id)))->find();
				$data['goods'][$i]['cat_name'] = $cat_name['name'];
		}
		return $data;
	}
}
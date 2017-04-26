<?php
namespace Admin\Model;
use Think\Model;
class StoreModel extends Model
{
	public function search($pageSize = 3)
	{
		/*******************搜索***************************/
		if ($store_name = I('get.store_name') )
			$where['storename'] = array('like', "%$store_name%");
		/******************* 翻页 *************************/
		$count = $this->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		//设置翻页的样式
		$page->setConfig('header', '条数据');
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/****************** 取数据 *********************/
		 $data['data'] = $this->field('*')->where($where)->order('ischeck asc,status asc, id desc')->limit($page->firstRow.','.$page->listRows)->select();
		 return $data;
	}
}
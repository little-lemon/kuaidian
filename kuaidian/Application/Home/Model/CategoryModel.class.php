<?php
namespace Home\Model;
use Think\Model;
class CategoryModel extends Model
{
	//添加分类是允许自动插入的字段
	protected $_auto = array (
			array('status','1',self::MODEL_INSERT),  // 新增的时候把status字段设置为1
			array('caddtime','time',self::MODEL_INSERT,'function'), //新增的时候插入caddtime字段的时间戳
	);
	protected $_validate = array(
			array('name', 'require', '分类名称不能为空！', self::MUST_VALIDATE ),
			array('name', '1,30', '角色名称的值最长不能超过 30 个字符！', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
			//array('name', '', '分类名称已存在', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH)
	);
	protected $insertFields = array('name');
	protected $updateFields = array('id','name');
	
	public function search($pageSize = 5)
	{
		/******************* 搜索 ************************/
		$where = array();
		$id = session('store_id');
		$where['storeid'] = $id;
		$where['status'] = 1;
		if($catname = I('get.catname'))
			$where['name'] = array('like',"%$catname%");
		$count = $this->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		//设置翻页的样式
		$page->setConfig('header', '条数据');
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/****************** 取数据 *********************/
		$data['data'] = $this->field('*')->where($where)->order('status asc, id desc')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
}
<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model
{
	protected $insertFields = array('role_name');
	protected $updateFields = array('id','role_name');
	protected $_validate = array(
			array('role_name', 'require', '角色名称不能为空！', 1, 'regex', 3),
			array('role_name', '1,30', '角色名称的值最长不能超过 30 个字符！', 1, 'length', 3),
			array('role_name', '', '角色名称已经存在', 1, 'unique', 3),
	);
	//列表搜索
	public function search($pageSize = 3)
	{
		$where = array();
		if($role_name = I('get.role_name'))
			$where['role_name'] = array('like',"%role_name%");
		$count = $this->where($where)->count();
		$page = new \Think\Page($count,$pageSize);
		//设置翻页的样式
		$page->setConfig('header', '条数据');
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		$data['data'] = $this->field('a.*,GROUP_CONCAT(c.pri_name) pri_name')->alias('a')
		->join('LEFT JOIN kuaidian_role_privilege b ON a.id = b.role_id LEFT JOIN kuaidian_privilege c ON b.pri_id = c.id')->where($where)
		->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	
    // 插入成功后的回调方法
    protected function _after_insert($data,$options) {
    	$priId = I('post.pri_id');
    	if($priId)
    	{
    		$rpModel = M('RolePrivilege');
    		foreach($priId as $k => $v)
    		{
    			$rpModel->add(array(
    				'pri_id' => $v,
    				'role_id' => $data['id'],
    			));
    		}
    	}
    }
    
    // 更新数据前的回调方法
    protected function _before_update(&$data,$options) {
    	$rpModel = M('RolePrivilege');
    	$rpModel->where(array('role_id'=>array('eq',$options['where']['id'])))->delete();
    	//接收表单时重新添加一遍
    	$priId = I('post.pri_id');
    	if($priId )
    	{
    		foreach($priId as $k => $v)
    		{
    			$rpModel->add(array(
    				'pri_id' => $v,
    				'role_id' => $options['where']['id'],
    			));
    		}
    	}
    }
    
    // 删除数据前的回调方法
    protected function _before_delete($options) {
    	//先判断有没有管理员属性这个角色-要读管理员角色表
    	$arModel = M('AdminRole');
    	$has = $arModel->where(array('role_id'=>array('eq',$options['where']['id'])))->count();
    	if($has > 0 )
    	{
    		$this->error = '有管理员属于这个角色，无法删除！';
    		return FALSE;
    	}
    	//把这个角色所拥有的权限的数据也一起删除
    	$rpModel = M('RolePrivilege');
    	$rpModel->where(array('role_id'=>array('eq',$options['where']['id'])))->delete();
    }    
}
<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class GoodsController extends IndexController 
{
	public function add()
	{
		$storeid = session('store_id');
		$cat = M('Category')->field('id,name')->where(array('storeid'=>array('eq',$storeid)))->select();
		$this->assign('cat',$cat);
		if(IS_POST)
		{
			$data = I('post.');
			$data['store_id'] = $storeid;
			$goodsModel = D('Goods');
			if($goodsModel->create($data,1))
			{
				if($goodsModel->add())
				{
// 					$this->success('添加成功',U('lst'));
// 					exit;
// 					$this->ajaxReturn(array('code'=>0, 'msg'=>'添加成功'));
 					echo "<script>parent.art.dialog({id:'add_dialog'}).close()</script>;";
 					exit;
// 					echo "<script>f('');</script>";
// 					exit;
				}
				else{
					$msg = $goodsModel->getError();
					echo "<script>alert('".$msg."');</script>";
// 					echo "<script>f('".$msg."');</script>";
// 					$this->ajaxReturn(array('code'=>1, 'msg'=>$msg));
				}
			}else{
				$msg = $goodsModel->getError();
				echo "<script>alert('".$msg."');</script>";
// 				echo "<script>f('".$msg."');</script>";
// 				$this->ajaxReturn(array('code'=>2, 'msg'=>$msg));
			}
		}
		$this->display();
	}
	
	public function lst()
	{
		$goodsModel = D('Goods');
		$data = $goodsModel->search();
		$this->assign(array(
				'goodsData' => $data['goods'],
				'page' => $data['page']
		));
		$this->display();
	}
	
	public function edit()
	{
		$id = I('get.id');
		if(IS_POST)
		{
			$goodsModel = D('Goods');
			if($data = $goodsModel->create(I('post.'),2))
			{
				if($goodsModel->save($data) !== FALSE)
				{
					$this->success('修改成功',U('lst'));
					exit;
				}
			}
			$this->error($goodsModel->getError());
		}
		//取出当前商品的属性，及当前店铺所对应的所有分类
		$goodsData = M('Goods')->find($id);
		$cat = M('Category')->field('id,name')->select();
		$this->assign(array(
				'cat' => $cat,
				'goodsData' => $goodsData,
		));
		$this->display();
	}
	
	public function ajaxGoodsDel()
	{
		$goods_ids = I('get.goods_ids');
		if($goods_ids){
			$ids = explode(',',$goods_ids);
			array_pop($ids);
		}
		$goodsModel = M('Goods');
		$imgData = $goodsModel->field('goods_pic,goods_sm_pic')->where(array('id'=>array('in',$ids)))->select();
		//echo json_encode($imgData);
		
		/*count函数有两个参数：0(或COUNT_NORMAL)为默认,不检测多维数组(数组中的数组);1(或COUNT_RECURSIVE)为检测多维数组，*/
		$len = count($imgData,COUNT_NORMAL);
		$state = $goodsModel->where(array('id'=>array('in',$ids)))->delete();
		if($state !== FALSE)
		{
			for($i=0; $i<$len; $i++)
			{
				$images['goods_pic'] = $imgData[$i]['goods_pic'];
				$images['goods_sm_pic'] = $imgData[$i]['goods_sm_pic'];
				deleteImage($images);
			}
		}
		$this->error($goodsModel->getError());
	}
	
}
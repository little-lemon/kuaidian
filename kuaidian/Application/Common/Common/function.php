<?php
function uploadOne($imgName,$dirName,$thumb = array())
{
	//上传LOGO
	if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0)
	{
		$rootPath = C('IMG_rootPath');
		$upload = new \Think\Upload(array(
			'rootPath' => $rootPath,
		));//实例化上传类
		$upload->maxSize = (int)C('IMG_maxSize')*1024*1024;  //设置附件上传大小
		$upload->exts = C('IMG_exts'); //设置附件上传类型
		$upload->savePath = $dirName.'/';  // 图片二级目录的名称
		//上传文件
		// 上传时指定一个要上传的图片的名称，否则会把表单中所有的图片都处理，之后再想其他图片时就再找不到图片了
		$info = $upload->upload(array($imgName=>$_FILES[$imgName]));
		if(!$info)
		{
			return array(
				'ok' => 0,
				'error' => $upload->getError(),
			);
		}
		else 
		{
			$ret['ok'] = 1;
			$ret['images'][0] = $logoName = $info[$imgName]['savepath'].$info[$imgName]['savename'];
			//判断是否生成缩略图
			if($thumb)
			{
				$image = new \Think\Image(); 
				//循环生成缩略图
				foreach($thumb as $k => $v)
				{
					$ret['images'][$k+1] =  $info[$imgName]['savepath'].'thumb_'.$k.'_'.$info[$imgName]['savename'];
					//打开要处理的图片
					$image->open($rootPath.$logoName);
					// 按照原图的比例生成一个最大为x*y的缩略图
					$image->thumb($v[0],$v[1])->save($rootPath.$ret['images'][$k+1]);
				}
			}
			return $ret;
		}
		
	}
}

//显示图片
function showImage($url, $width='', $height='')
{
	$url = C('IMG_URL').$url;
	if($width)
		$width = "width='$width'";
	if($height)
		$height = "height='$height'";
	echo "<img src='$url' $width $height /sss>";
}

// 删除图片：参数：一维数组：所有要删除的图片的路径
function deleteImage($images)
{
	//先取出图片所在目录
	$rp = C('IMG_rootPath');
	foreach($images as $v)
	{
		// @错误抵制符：忽略掉错误,一般在删除文件时都添加上这个
		@unlink($rp . $v);
	}
}

//分页设置
/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $m 模型，引用传递
 * @param $where 查询条件
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage(&$m,$where,$pagesize=10){
	$m1=clone $m;//浅复制一个模型
	$count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
	$m=$m1;//为保持在为定的连惯操作，浅复制一个模型
	$p=new Think\Page($count,$pagesize);
	$p->lastSuffix=false;
	$p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>%LIST_ROW%</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	$p->setConfig('prev','上一页');
	$p->setConfig('next','下一页');
	$p->setConfig('last','末页');
	$p->setConfig('first','首页');
	$p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

	$p->parameter=I('get.');

	$m->limit($p->firstRow,$p->listRows);

	return $p;
}
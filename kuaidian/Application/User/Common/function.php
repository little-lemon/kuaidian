<?php
/**
 * 前台公共库文件
 * 主要定义前台公共函数库
 */

function check_verify($code){
	$verify = new \Think\Verify();
	$verify->reset=false;
 	return $verify->check($code);
}
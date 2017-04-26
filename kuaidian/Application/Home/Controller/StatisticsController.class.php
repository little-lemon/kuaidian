<?php
namespace Home\Controller;
use Home\Controller\IndexController;
class StatisticsController extends IndexController
{
	//已完成订单统计报表
	public function lst()
	{
		$date = array();
		if (IS_POST){
			$fromDate = empty($_POST['from-date']) ? strtotime('2017-01-01') : strtotime($_POST['from-date']);
			$toDate = empty($_POST['to-date']) ?  time() : strtotime($_POST['to-date']);
			$start =mktime(0,0,0,date("m",$fromDate),date("d",$fromDate),date("Y",$fromDate));
			$end = mktime(23,59,59,date("m",$toDate),date("d",$toDate),date("Y",$toDate));
			$date['from'] = $_POST['from-date'];
			$date['to'] = $_POST['to-date'];
		} else {
			$start = strtotime('2017-01-01');
			$end = time();
			$date['from'] = '';
			$date['to'] = '';
		}
		$storeId = session("store_id");
		$sql ='SELECT a.add_times, a.post_status, b.goods_id, b.goods_price, b.goods_number, c.goods_name, SUM( b.goods_number ) counts, SUM( b.goods_price ) total'
				.' FROM kuaidian_order a'
				.' INNER JOIN kuaidian_order_goods b'
				.' INNER JOIN kuaidian_goods c ON a.order_number = b.order_number'
				.' AND '.$start.' <= a.add_times AND a.add_times <= '.$end
				.' AND b.goods_id = c.id'
				.' AND a.store_id ='.$storeId
// 				.' AND a.post_status = 2'
				.' GROUP BY b.goods_id, b.goods_price'
				.' ORDER BY goods_id';
		$data = M()->query($sql);
		$totalNum = 0;
		$toalPrice = 0;
		foreach ($data as $key => $value)
		{
			$totalNum += $value['counts'];
			$toalPrice += $value['counts'] * $value['goods_price'];
		}
		//小数点后补2个零
		$toalPrice = sprintf("%01.2f",$toalPrice);
		$this->assign(array(
				'data' => $data,
				'totalNum' => $totalNum,
				'toalPrice' => $toalPrice,
				'date' => $date,
// 				'toDate' => $date2
		));
		$this->display();
// 		var_dump($data);
// 		var_dump($totalNum);
// 		var_dump($toalPrice);
	}
	
	//导出报表
	public function exportExcel(){
		if($_GET['from-date'] || $_GET['to-date'] ){
			$fromDate = empty($_GET['from-date']) ? strtotime('2017-01-01') : strtotime($_GET['from-date']);
			$toDate = empty($_GET['to-date']) ?  time() : strtotime($_GET['to-date']);
			$start =mktime(0,0,0,date("m",$fromDate),date("d",$fromDate),date("Y",$fromDate));
			$end = mktime(23,59,59,date("m",$toDate),date("d",$toDate),date("Y",$toDate));
			if($_GET['from-date'] == $_GET['to-date']){
				$msg = $_GET['from-date'];
			} else{
				$msg = date("Ymd",$start).' - '.date("Ymd",$end);
			}
			
		} else if( empty($_GET['from-date'])  &&  empty($_GET['from-date']) ){
			$fromDate = strtotime('2017-01-01');
			$toDate = time();
			$start =mktime(0,0,0,date("m",$fromDate),date("d",$fromDate),date("Y",$fromDate));
			$end = mktime(0,0,0,date("m",$toDate),date("d",$toDate),date("Y",$toDate));
			$msg = '全部';
		}
		
		$storeId = session("store_id");
		$storeName = M('Store')->field('storename')->where(array('is' => array('eq',$storeId)))->find()['storename'];
		$sql ='SELECT a.add_times, a.post_status, b.goods_id, b.goods_price, b.goods_number, c.goods_name, SUM( b.goods_number ) counts, SUM( b.goods_price ) total'
				.' FROM kuaidian_order a'
				.' INNER JOIN kuaidian_order_goods b'
				.' INNER JOIN kuaidian_goods c ON a.order_number = b.order_number'
				.' AND '.$start.' <= a.add_times AND a.add_times <= '.$end
				.' AND b.goods_id = c.id'
				.' AND a.store_id ='.$storeId
// 				.' AND a.post_status = 2'
				.' GROUP BY b.goods_id, b.goods_price'
				.' ORDER BY goods_id';
		$sale = M()->query($sql);
		$len = count($sale,COUNT_NORMAL) + 3;    //最后一行的位置
		$toalPrice = 0;
		$totalNum = 0;
		
		vendor('PHPExcel.PHPExcel');
		vendor('PHPExcel.PHPExcel.IOFactory');
		vendor('PHPExcel.PHPExcel.Reader.Excel5');
		$objPHPExcel = new \PHPExcel();
		//设置宽度
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		//set font size bold
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A$len")->getFont()->setBold(true)->getColor()->setARGB('#CC0000');
		//合并cell
		$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
		$objPHPExcel->getActiveSheet()->mergeCells("A$len:C$len");
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle("A$len")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		//set table header content
		$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A2','菜品名称')
							->setCellValue('B2','菜品价格')
							->setCellValue('C2','销量');
		$objPHPExcel->getActiveSheet(0)->setCellValue('A1',$storeName.'('.$msg.')报表');
		foreach ($sale as $k => $v)
		{
			$objPHPExcel->getActiveSheet(0)->setCellValue('A'.($k+3),$v['goods_name']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('B'.($k+3),$v['goods_price']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('C'.($k+3),$v['goods_number']);
			$toalPrice += $v['goods_price'] * $v['counts'];
			$totalNum += $v['counts'];
		}
		$toalPrice = sprintf("%01.2f",$toalPrice);  //保留两位小数
		$objPHPExcel->getActiveSheet(0)->setCellValue("A$len",'总销量：'.$totalNum.' 件----总收入：'.$toalPrice.' 元');
		//sheet命名
		$objPHPExcel->getActiveSheet()->setTitle($storeName.'('.$msg.')报表');
		//Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		ob_end_clean();
		//excel头参数
		header('content-Type:application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$storeName.'('.$msg.')报表'.'.xls"');  //日期为文件名后缀
		header('Cache-Control: max-age=0');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
	}
	
	public function statisticalChart()
	{
		$storeId = session("store_id");
		$sql ='SELECT a.add_times, a.post_status, b.goods_id, b.goods_price, c.goods_name, SUM( b.goods_number ) counts, SUM( b.goods_price ) total'
				.' FROM kuaidian_order a'
				.' INNER JOIN kuaidian_order_goods b'
				.' INNER JOIN kuaidian_goods c ON a.order_number = b.order_number'
				//.' AND '.$start.' <= a.add_times AND a.add_times <= '.$end
				.' AND b.goods_id = c.id'
				.' AND a.store_id ='.$storeId
				//.' AND a.post_status = 2'
				.' GROUP BY b.goods_id, b.goods_price'
				.' ORDER BY goods_id';
		$data = M()->query($sql);
		//var_dump($data);
		//$data = json_encode($data);
		$this->assign('data',$data);
		$this->display();
		//echo $data;
	}
	
}
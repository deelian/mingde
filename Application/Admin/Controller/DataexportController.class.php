<?php 
namespace Admin\Controller;

use Think\Controller;
use Admin\Controller\PhpExcelController as PHPExcel;


/**
* 数据导出操作
*/
class DataexportController extends Controller
{
	protected $objPHPExcel;

	function _initialize()
	{
		Vendor('Excel.PHPExcel');
		$this->objPHPExcel = new \PHPExcel();
	}

	public function export($value='')
	{
		p($this->objPHPExcel);
	}
}

 ?>
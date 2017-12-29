<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    function _initialize()
    {

    }

    public function welcome()
    {
        $this->display();
    }

    public function index()
    {
        $this->display();
    }

    public function getUserInfo(){
        $user   = M('user');
        $res    = $user->where('user_id <= 2 ')->getField('user_id,name,real_name,sex,mobile');
        foreach($res as $resK => $resV){
            switch ($resV['sex']) {
                case '0':
                    $res[$resK]['sex'] = '女';
                    break;

                case '1':
                    $res[$resK]['sex'] = '男';
                    break;

                default:
                    $res[$resK]['sex'] = '保密';
                    break;
            }
        }
        p('action!');
        $headArr    = ['编号', '昵称','真实姓名', '性别', '手机号'];

        $filename="userInfo";

        $this->getExcel($filename,$headArr,$res);
//        p($headArr);
    }

    private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
//        import("Org.Util.PHPExcel");
        Vendor('Excel.PHPExcel');
//        import("Org.Util.PHPExcel.Writer.Excel5");
        Vendor('Excel.PHPExcel.Writer.Excel5');
//        import("Org.Util.PHPExcel.IOFactory.php");
        Vendor('Excel.PHPExcel.IOFactory');

//        $date = date("Y_m_d",time());
        $date = time();
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("C");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }

    public function dataExport($data)
    {

//        p($objPHPExcel);
//        return $objPHPExcel->createSheet($data);
//        p($objExcel);
//        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
//
//        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
//        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
//        for($i=0;$i<$cellNum;$i++){
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
//        }
//        // Miscellaneous glyphs, UTF-8
//        for($i=0;$i<$dataNum;$i++){
//            for($j=0;$j<$cellNum;$j++){
//                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
//            }
//        }
//
//        header('pragma:public');
//        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
//        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//        $objWriter->save('php://output');
//        exit;
    }
    /**
     *
     * 导出Excel
     */
    function expUser(){//导出Excel
        $xlsName  = "User";
        $xlsCell  = array(
            array('id','账号序列'),
            array('truename','名字'),
            array('sex','性别'),
            array('res_id','院系'),
            array('sp_id','专业'),
            array('class','班级'),
            array('year','毕业时间'),
            array('city','所在地'),
            array('company','单位'),
            array('zhicheng','职称'),
            array('zhiwu','职务'),
            array('jibie','级别'),
            array('tel','电话'),
            array('qq','qq'),
            array('email','邮箱'),
            array('honor','荣誉'),
            array('remark','备注')
        );
        $xlsModel = M('Member');

        $xlsData  = $xlsModel->Field('id,truename,sex,res_id,sp_id,class,year,city,company,zhicheng,zhiwu,jibie,tel,qq,email,honor,remark')->select();
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['sex']=$v['sex']==1?'男':'女';
        }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
    }


}
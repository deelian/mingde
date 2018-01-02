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
        $condition      = array(
            'name'   => array(
                'like',
                '%小%'
            )
        );
//        p($condition,1);
        $res    = $user->where($condition)->order('mobile asc')->getField('user_id,name,real_name,sex,mobile');
//        p($res);
        p($user->getLastSql());
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
//        Vendor('Excel.PHPExcel.Writer.Excel5');
//        import("Org.Util.PHPExcel.IOFactory.php");
//        Vendor('Excel.PHPExcel.IOFactory');

//        $date = date("Y_m_d",time());
        $date = time();
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
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


}
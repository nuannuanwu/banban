<?php
/**
 * PHPExcelHelper
 *
 * @category   PHPExcelHelper
 * @package    PHPExcelHelper
 */
class PHPExcelHelper
{
    public static function exportExcel( $excel_content, $excel_file, $excel_props=array('creator'=>'GGBOUND', 'title'=>'EXPORT EXCEL', 'subject'=>'EXPORT EXCEL', 'desc'=>'EXPORT EXCEL', 'keywords'=>'EXPORT EXCEL', 'category'=>'EXPORT EXCEL')){
        if (!is_array($excel_content)){
            return FALSE;
        }
        // //PHPEXCEL包路径
        // $phpExcelPath=Yii::app() -> request -> baseUrl.'/protected/extensions/';
        spl_autoload_unregister(array('YiiBase','autoload'));//取消YII自动加载
        include('PHPExcel.php');//引入PHPEXCEL类
        //设置文档基本属性
        $objPHPExcel = new PHPExcel();
        $objProps = $objPHPExcel -> getProperties();
        $objProps->setCreator($excel_props['creator']);
        $objProps->setLastModifiedBy($excel_props['creator']);
        $objProps->setTitle($excel_props['title']);
        $objProps->setSubject($excel_props['subject']);
        $objProps->setDescription($excel_props['desc']);
        $objProps->setKeywords($excel_props['keywords']);
        $objProps->setCategory($excel_props['category']);
        //开始执行EXCEL数据导出
        for ($i=0;$i<count($excel_content);$i++){
            $each_sheet_content = $excel_content[$i];
            if ($i==0){
                //默认会创建一个sheet页，故不需在创建
                $objPHPExcel -> setActiveSheetIndex(intval(0));
                $current_sheet = $objPHPExcel -> getActiveSheet();
            }else{
                //创建sheet
                $objPHPExcel -> createSheet();
                $current_sheet = $objPHPExcel -> getSheet($i);
            }
            //设置sheet title
            $current_sheet -> setTitle( $each_sheet_content['sheet_name'] );
            //设置sheet当前页的标题
            if (array_key_exists('sheet_title', $each_sheet_content) && !empty($each_sheet_content['sheet_title'])){
                for($j=0; $j<count($each_sheet_content['sheet_title']); $j++){
                    $current_sheet->setCellValueByColumnAndRow($j, 1, $each_sheet_content['sheet_title'][$j]);
                }
            }
            //写入sheet页面内容
            if(array_key_exists('ceils', $each_sheet_content) && !empty($each_sheet_content['ceils'])){
                for($k=0; $k<count($each_sheet_content['ceils']); $k++){
                    for($l=0; $l<count($each_sheet_content['ceils'][$k]); $l++){
                        $current_sheet->setCellValueByColumnAndRow($l, $k+2, $each_sheet_content['ceils'][$k][$l]);
                    }
                }
            }
            if(isset($each_sheet_content['sheet_head']) && $each_sheet_content['sheet_head']){

            }

            //设置隐藏列
            if(isset($each_sheet_content['hide_column']) && count($each_sheet_content['hide_column'])){
                foreach($each_sheet_content['hide_column'] as $column)
                $current_sheet->getColumnDimension($column)->setVisible(false);
            }
            // $current_sheet->insertNewRowBefore(1, 1);
            // $current_sheet->setCellValueByColumnAndRow(0,1,$each_sheet_content['sheet_head']);
        }


        //生成EXCEL并下载
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
            // header('Content-Disposition: attachment;filename="'.$excel_file.'-'.date('Y-m-d-H-i-s').'.xls"');
        header('Content-Disposition: attachment;filename="'.iconv('utf-8', 'gb2312', $excel_file).'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');//自动下载
        Yii::app()->end();
        //恢复Yii自动加载功能
        spl_autoload_register(array('YiiBase','autoload'));
    }

    /*
     * 发布成线时的特殊处理
     */
    public static function exportExamExcel( $excel_content, $excel_file, $len=0,$excel_props=array('creator'=>'GGBOUND', 'title'=>'EXPORT EXCEL', 'subject'=>'EXPORT EXCEL', 'desc'=>'EXPORT EXCEL', 'keywords'=>'EXPORT EXCEL', 'category'=>'EXPORT EXCEL')){
        if (!is_array($excel_content)){
            return FALSE;
        }
        // //PHPEXCEL包路径
        // $phpExcelPath=Yii::app() -> request -> baseUrl.'/protected/extensions/';
        spl_autoload_unregister(array('YiiBase','autoload'));//取消YII自动加载
        include('PHPExcel.php');//引入PHPEXCEL类
        //设置文档基本属性
        $objPHPExcel = new PHPExcel();
        $objProps = $objPHPExcel -> getProperties();
        $objProps->setCreator($excel_props['creator']);
        $objProps->setLastModifiedBy($excel_props['creator']);
        $objProps->setTitle($excel_props['title']);
        $objProps->setSubject($excel_props['subject']);
        $objProps->setDescription($excel_props['desc']);
        $objProps->setKeywords($excel_props['keywords']);
        $objProps->setCategory($excel_props['category']);
        //开始执行EXCEL数据导出
        for ($i=0;$i<count($excel_content);$i++){
            $each_sheet_content = $excel_content[$i];
            if ($i==0){
                //默认会创建一个sheet页，故不需在创建
                $objPHPExcel -> setActiveSheetIndex(intval(0));
                $current_sheet = $objPHPExcel -> getActiveSheet();
            }else{
                //创建sheet
                $objPHPExcel -> createSheet();
                $current_sheet = $objPHPExcel -> getSheet($i);
            }
            //设置sheet title
            $current_sheet -> setTitle( $each_sheet_content['sheet_name'] );
            //设置sheet当前页的标题
            if (array_key_exists('sheet_title', $each_sheet_content) && !empty($each_sheet_content['sheet_title'])){
                for($j=0; $j<count($each_sheet_content['sheet_title']); $j++){
                    $current_sheet->setCellValueByColumnAndRow($j, 1, $each_sheet_content['sheet_title'][$j]);
                }
            }
            //写入sheet页面内容
            if(array_key_exists('ceils', $each_sheet_content) && !empty($each_sheet_content['ceils'])){
                for($k=0; $k<count($each_sheet_content['ceils']); $k++){
                    for($l=0; $l<count($each_sheet_content['ceils'][$k]); $l++){
                        $current_sheet->setCellValueByColumnAndRow($l, $k+2, $each_sheet_content['ceils'][$k][$l]);
                    }
                }
            }
            if(isset($each_sheet_content['sheet_head']) && $each_sheet_content['sheet_head']){

            }

            //设置隐藏列
            if(isset($each_sheet_content['hide_column']) && count($each_sheet_content['hide_column'])){
                foreach($each_sheet_content['hide_column'] as $column)
                    $current_sheet->getColumnDimension($column)->setVisible(false);
            }
            // $current_sheet->insertNewRowBefore(1, 1);
            // $current_sheet->setCellValueByColumnAndRow(0,1,$each_sheet_content['sheet_head']);
        }

       // $current_sheet->getColumnDimension('A')->setVisible(false);
        $current_sheet->getRowDimension('1')->setRowHeight(30);
        $current_sheet->getColumnDimension('A')->setWidth(20);
        $current_sheet->getColumnDimension('B')->setWidth(80);
       // $current_sheet->getRowDimension('2')->setRowHeight(130);
        if($len>24) $len=24;//最多26个英文字母;
        $maxColumn=chr(ord('B')+$len);
       // for($i='B'; $i<=$maxColumn;$i++){
           // $current_sheet->getColumnDimension($i)->setWidth(30);
       // }

        //$current_sheet->getColumnDimension('A')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //$current_sheet->getColumnDimension('B')->setWidth(30);
        $styleArray1 = array(
            'font' => array(
                'bold' => true,
                'color'=>array(
                    'argb' => 'F90',
                ),
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
      //  $current_sheet->getStyle( "B1:{$maxColumn}1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
       // $current_sheet->getStyle( "B1:{$maxColumn}1")->getFill()->getStartColor()->setRGB('FCD5B4');
      //  $current_sheet->getStyle("B1:{$maxColumn}1")->applyFromArray($styleArray1);

//        $current_sheet->getStyle('B')->getNumberFormat()
//            ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
//        $current_sheet->getStyle('A')->getNumberFormat()
//            ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
//        $objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()
//            ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        //D($excel_content);
        $styleArray2 = array(
            'font' => array(
                'bold' => false,
                'color'=>array(
                    'argb' => 'F90',
                ),
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $len=count($excel_content[0]['ceils'])+1;
        for($kk=1;$kk<=$len;$kk++){
            $objPHPExcel->getActiveSheet()->getStyle('B'.$kk)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$kk)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $current_sheet->getStyle("A$kk")->applyFromArray($styleArray2);
            $current_sheet->getStyle("B$kk")->applyFromArray($styleArray2);
        }
       // $objPHPExcel->getActiveSheet()->getStyle('B2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

       //
        for($i='A';$i<=$maxColumn;$i++){
            $current_sheet->getStyle( "{$i}1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
            $current_sheet->getStyle("{$i}1")->applyFromArray($styleArray1);
        }

        //$current_sheet->getStyle( 'B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
       // $current_sheet->getStyle( 'C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
       // $current_sheet->getStyle( 'D1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
       // $current_sheet->getStyle( 'F1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
       // $current_sheet->getStyle( 'E1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
       // $current_sheet->getStyle( 'G1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);       //垂直方向上中间居中
        //生成EXCEL并下载
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
        // header('Content-Disposition: attachment;filename="'.$excel_file.'-'.date('Y-m-d-H-i-s').'.xls"');
        header('Content-Disposition: attachment;filename="'.mb_convert_encoding($excel_file,'gb2312','auto').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');//自动下载
        Yii::app()->end();
        //恢复Yii自动加载功能
        spl_autoload_register(array('YiiBase','autoload'));
    }

    /** 
    * @todo 针对YII 查询输出带有数据库表字段名键名进行优化EXCEL表格输出 
    * @todo 替换键名为0、1、2... 
    * @param array $data 
    * @return array('excel_title'=array(),'excel_ceils'=array()); 
    */  
    public function excelDataFormat($data){  
        for ($i=0;$i<count($data);$i++){  
            $each_arr=$data[$i];  
            $new_arr[]=array_values($each_arr); //返回所有键值  
        }  
        $new_key[]=array_keys($data[0]); //返回所有索引值  

        return array('excel_title'=>$new_key[0],'excel_ceils'=>$new_arr);  
    }  
}

<?php

class Download
{
    /**
     *  导出项目报价pdf
     * @return string
     */
    public function quotation_pdf(){
        $key_id =   req('key_id');
        if(!$key_id){
            throw new Exception(code::PARAMETER_ERROR);
        }
        require_once (dirname(__FILE__,3).'/vendor/autoload.php'); // 导入TCPDF库，这个路径需要根据你实际的路径而定
        require_once (dirname(__FILE__,2).'/model/quotation.php'); // 导入数据处理类
        $html   =   htmlspecialchars_decode(file_get_contents((dirname(__FILE__,2).'/pdf/quotation.html')));//导入模版文件

        $details    =   Get_details($key_id,'title');
        $upload_dir = dirname(__FILE__,3) . '/upfiles/pdf/'.date('Ymd',time()).'/';
        if (is_dir($upload_dir) == false) {
            if(!mkdir($upload_dir, 0777,true)){
                throw new Exception(code::SYSTEM_ERROR);
            }
        }
        $file_name  =   '/upfiles/pdf/'.date('Ymd',time()).'/'.time().rand(111111,999999).".pdf";
        $pdf_name   =   dirname(__FILE__,3).$file_name;

        $quotation  =   new quotation();
        $quotation->key_id  =   $key_id;
        $quotation_data     =   $quotation->quotation();
        $supplement         =   $quotation->supplement();
        $Const              =   $quotation->Const();
        $PaidItems          =   $quotation->PaidItems();
        $NotIncluded        =   $quotation->NotIncluded();
        $quotation_list     =   $quotation->GetQuotation($quotation_data);
        $Const_list         =   $quotation->GetIllustrate($Const);
        $NotIncluded_list   =   $quotation->GetNotIncluded($NotIncluded);
        $PaidItems_list     =   $quotation->GetPaidItems($PaidItems);
        $data   =   str_replace('{{title}}',$details['title'],$html);
        $data   =   str_replace('{{quotation}}',$quotation_list,$data);
        $data   =   str_replace('{{illustrate}}',$Const_list,$data);
        $data   =   str_replace('{{not_included}}',$NotIncluded_list,$data);
        $data   =   str_replace('{{Paiditems}}',$PaidItems_list,$data);
        $data   =   str_replace('{{content}}',$supplement['content'],$data);

        $mpdf = new Mpdf\Mpdf();
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->WriteHTML($data);
        //输出到页面
        $mpdf->Output($pdf_name);
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'file'=>$file_name],code::OPERATION_SUCCESSFUL);
    }


    /**
     *  导出行程单 -pdf
     * @return string
     */
    public function Itinerary_pdf(){
        $key_id =   req('key_id');
        if(!$key_id){
            throw new Exception(code::PARAMETER_ERROR);
        }
        require_once (dirname(__FILE__,3).'/vendor/autoload.php'); // 导入TCPDF库，这个路径需要根据你实际的路径而定
        require_once (dirname(__FILE__,2).'/model/Itinerary.php'); // 导入数据处理类
        $html   =   htmlspecialchars_decode(file_get_contents((dirname(__FILE__,2).'/pdf/Itinerary.html')));//导入模版文件

        $details    =   Get_details($key_id,'title,start_time,end_time');
        $city   =  GetProjectCity($key_id);

        $upload_dir = dirname(__FILE__,3) . '/upfiles/pdf/'.date('Ymd',time()).'/';
        if (is_dir($upload_dir) == false) {
            if(!mkdir($upload_dir, 0777,true)){
                throw new Exception(code::SYSTEM_ERROR);
            }
        }
        $file_name  =   '/upfiles/pdf/'.date('Ymd',time()).'/'.time().rand(111111,999999).".pdf";
        $pdf_name   =   dirname(__FILE__,3).$file_name;

        $Itinerary  =   new Itinerary();
        $Itinerary->key_id  =   $key_id;
        $content     =   $Itinerary->GetContent();
        $start_time   =   date('Y-m-d',$details['start_time']);
        $end_time   =   date('Y-m-d',$details['end_time']);
        $data   =   str_replace('{{title}}',$details['title'],$html);
        $data   =   str_replace('{{city}}',$city,$data);
        $data   =   str_replace('{{time}}',$start_time.'~'.$end_time,$data);
        $data   =   str_replace('{{content}}',$content,$data);
//        echo $data;exit();
        $mpdf = new Mpdf\Mpdf();
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->WriteHTML($data);
        //输出到页面
//        $mpdf->Output();
        $mpdf->Output($pdf_name);
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'file'=>$file_name],code::OPERATION_SUCCESSFUL);
    }





    /**
     *  导出路线图 -pdf
     * @return string
     */
    public function Project_pdf(){
        $key_id =   req('key_id');
        if(!$key_id){
            throw new Exception(code::PARAMETER_ERROR);
        }
        require_once (dirname(__FILE__,3).'/vendor/autoload.php'); // 导入TCPDF库，这个路径需要根据你实际的路径而定
        require_once (dirname(__FILE__,2).'/model/Project.php'); // 导入数据处理类
        $html   =   htmlspecialchars_decode(file_get_contents((dirname(__FILE__,2).'/pdf/project.html')));//导入模版文件

        $details    =   Get_details($key_id,'title,url,start_time,end_time');
        $city   =  GetProjectCity($key_id);

        $upload_dir = dirname(__FILE__,3) . '/upfiles/pdf/'.date('Ymd',time()).'/';
        if (is_dir($upload_dir) == false) {
            if(!mkdir($upload_dir, 0777,true)){
                throw new Exception(code::SYSTEM_ERROR);
            }
        }
        $file_name  =   '/upfiles/pdf/'.date('Ymd',time()).'/'.time().rand(111111,999999).".pdf";
        $pdf_name   =   dirname(__FILE__,3).$file_name;

        $Project  =   new Project();
        $Project->key_id  =   $key_id;
        $code   =   $Project->TravelRoute();
        $content     =   $Project->GetContent($code);
        $start_time   =   date('Y-m-d',$details['start_time']);
        $end_time   =   date('Y-m-d',$details['end_time']);
        $data   =   str_replace('{{title}}',$details['title'],$html);
        $data   =   str_replace('{{time}}',$start_time.'~'.$end_time,$data);
        $data   =   str_replace('{{day_list}}',$content['day_list'],$data);
        $data   =   str_replace('{{schedule}}',$content['schedule'],$data);
//        echo $data;exit();
        $mpdf = new Mpdf\Mpdf();
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->WriteHTML($data);
        //输出到页面
//        $mpdf->Output();
        //去除生成的地图图片
        foreach ($content['img_list'] as $item){
            unlink($item);
        }
        $mpdf->Output($pdf_name);
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'file'=>$file_name],code::OPERATION_SUCCESSFUL);
    }










}



$data       =   new Download();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'pdf';
    $list_code  =   array('pdf','quotation_pdf','Itinerary_pdf','Project_pdf');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();
} catch (Exception $e){
    $data->mysql->rollback();
    echo error('错误信息：'.$e->getMessage());
}
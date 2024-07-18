<?php

class label
{

    public function label_add($type,$label){
        global $g_account;
        $code   =   [
            'label'           =>  $label,//标签
            'account_id'        =>  $g_account['account_id'],//用户id
            'type'             =>  $type,//类型
        ];
        $key_id =   req('key_id');
        $mysql_resources_name   =   GetTableName('t_label');

        $resources_id    =   Get_picture($key_id,$mysql_resources_name);
        if($resources_id == 0){
            $resources_id    =   add_detail($code,$mysql_resources_name);
        }else{
            unset($code['account_id'],$code['type']);
            $resources_id    =   updata_detail($code,$mysql_resources_name,$resources_id);
        }
        if(!$resources_id){
            throw new Exception(code::SYSTEM_ERROR);
        }else{
            return success(['time'  =>   date('Y-m-d H:i:s',time()),'key_id'=>$resources_id,'value'=>$label],code::ADDED_SUCCESSFULLY);
        }
    }




}


try{
    $type       =   req('type');
    $label      = req('label');

    $verification   =   [
        [$type,code::PLEASE_SELECT_A_LABEL_TYPE,'required'],
        [$label,code::PLEASE_ENTER_A_LABEL,'required'],
    ];
    (new check())->set_code($verification);

    if(!in_array($type,array(1,2,3,4))){
        throw new Exception(code::INCORRECT_LABEL_TYPE);
    }
    $data       =   new label();
    echo $data->label_add($type,$label);
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


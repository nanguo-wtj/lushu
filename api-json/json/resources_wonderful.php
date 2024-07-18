<?php

class resources_wonderful
{
    /**
     *  添加亮点内容  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function wonderful():string{
        global $g_siteid,$g_account;
        $key_id   =   req('key_id');
        $title   =   req('title');
        $address   =   req('address_code');
        $association  =   req('association');
        $notes  =   req('content');
        $picture   =   req('picture');
        $verification   =   [
            [$title,code::PLEASE_FILL_IN_THE_NOTE_TITLE,'required'],
            [$notes,code::PLEASE_FILL_IN_THE_NOTE_CONTENT,'required'],
            [$picture,code::THE_UPLOADED_FILE_IS_EMPTY_PLEASE_TRY_AGAIN,'required'],
        ];
        (new check())->set_code($verification);
        $association        =   Get_list_flied($association);
        $address =   Get_list_flied($address);
        $code   =   [
            'title'             =>      $title,//标题
            'time'              =>      time(),//上传时间
            'association_id'    =>      implode(',',$association),//关联PIO  用 ， 分割
            'destination'       =>      implode(',',$address),//目的地信息
            'notes'             =>      $notes,//详细介绍
            'site_id'           =>      $g_siteid,//
            'update_time'        =>      time(),//
            'account_id'        =>      $g_account['account_id'],//
            'url'               =>      $picture,//
        ];
        $mysql_name   =   GetTableName('t_resources_wonderful');
        if($key_id){
            $key_id    =   Get_picture((int)$key_id,$mysql_name);
        }
        if(!$key_id){
            add_detail($code,$mysql_name);
            return success(['time'  =>   date('Y-m-d H:i:s',time())],code::ADDED_SUCCESSFULLY);
        }else{
            unset($code['time'],$code['site_id'],$code['account_id']);
            updata_detail($code,$mysql_name,$key_id);
            return success(['time'  =>   date('Y-m-d H:i:s',time())],code::OPERATION_SUCCESSFUL);
        }


    }

}


$data       =   new resources_wonderful();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'wonderful';
    $list_code  =   array('wonderful');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


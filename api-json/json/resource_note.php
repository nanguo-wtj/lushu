<?php

class resource_note
{
    /**
     *  添加笔记内容  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function note():string{
        global $g_siteid,$g_account,$g_http;
        $key_id   =   req('key_id');
        $title   =   req('title');
        $address_code   =   req('address_code');
        $association  =   req('association');
        $notes  =   req('content');
        $label  =   req('label');
        $picture   =   req('picture');
        $hotel   =   req('hotel');
        $verification   =   [
            [$title,code::PLEASE_FILL_IN_THE_NOTE_TITLE,'required'],
            [$notes,code::PLEASE_FILL_IN_THE_NOTE_CONTENT,'required'],
        ];
        (new check())->set_code($verification);
        $address        =   Get_list_flied($address_code);
        $association_id =   Get_list_flied($association);
        $label_id =   Get_list_flied($label);
        $hotel_id =   Get_list_flied($hotel);
        $code   =   [
            'title'             =>      $title,//标题
            'time'              =>      time(),//上传时间
            'association_id'    =>      implode(',',$association_id),//关联PIO  用 ， 分割
            'hotel_id'          =>      implode(',',$hotel_id),//关联PIO  用 ， 分割
            'destination'       =>      implode(',',$address),//目的地信息
            'notes'             =>      $notes,//详细介绍
            'type'              =>      0,//
            'site_id'           =>      $g_siteid,//
            'label'             =>      implode(',',$label_id),//
            'update_time'        =>      time(),//
            'account_id'        =>      $g_account['account_id'],//
            'picture'           =>      $picture,//
        ];
        $mysql_name   =   GetTableName('t_resources_note');
        if($key_id){
            $key_id    =   Get_picture((int)$key_id,$mysql_name);
        }
        if(!$key_id){
            $key_id =   add_detail($code,$mysql_name);
        }else{
            unset($code['time'],$code['type'],$code['site_id'],$code['account_id']);
            updata_detail($code,$mysql_name,$key_id);
        }
        return success(['key_id'=>$key_id,'title'=>$title,'url'=>$g_http.$_SERVER['HTTP_HOST'].$picture,'user'=>Get_userdata_id('account',$g_account['account_id'])['account'],'time'  =>   date('Y-m-d H:i:s',time())],code::ADDED_SUCCESSFULLY);

    }

    /**
     *  删除笔记内容  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function delNote():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'state'           =>      1,
            'update_time'           =>      time(),
        ];
        $mysql_name   =   GetTableName('t_resources_note');

        updata_detail($code,$mysql_name,$key_id);

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }
}


$data       =   new resource_note();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'note';
    $list_code  =   array('note','delNote');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


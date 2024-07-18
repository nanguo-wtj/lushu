<?php

class resource_img
{

    /**
     *  上传图片库接口
     * @return string
     * @throws Exception
     */
    public function picture():string{
        global $g_siteid,$g_account;
        $key_id   =   req('key_id');
        $address_code   =   req('address_code');
        $association  =   req('association');
        $notes  =   req('content');
        $picture   =   req('picture');
        $hotel   =   req('hotel');
        $verification   =   [
            [$picture,code::THE_UPLOADED_FILE_IS_EMPTY_PLEASE_TRY_AGAIN,'required'],
        ];
        (new check())->set_code($verification);

        $address        =   Get_list_flied($address_code);
        $association_id =   Get_list_flied($association);
        $hotel_id =   Get_list_flied($hotel);

        $code   =   [
            'url'       =>      $picture,//图片地址
            'time'      =>      time(),//上传时间
            'update_time'            =>      time(),//
            'association_id'        =>      implode(',',$association_id),//关联PIO  用 ， 分割
            'hotel_id'        =>      implode(',',$hotel_id),//关联PIO  用 ， 分割
            'destination'       =>      implode(',',$address),//目的地信息
            'notes'     =>      $notes,//详细介绍
            'type'      =>      0,//
            'site_id'       =>      $g_siteid,//
            'account_id'        =>      $g_account['account_id'],//
        ];
        $mysql_name   =   GetTableName('t_resources_img');
        if($key_id){
            $key_id    =   Get_picture((int)$key_id,$mysql_name);
        }
        if(!$key_id){
            $key_id =   add_detail($code,$mysql_name);
        }else{
            unset($code['time'],$code['type'],$code['site_id'],$code['account_id']);
            updata_detail($code,$mysql_name,$key_id);
        }

        return success(['key_id'=>$key_id,'title'=>$notes,'url'=>$picture,'time'  =>   date('Y-m-d H:i:s',time())],code::ADDED_SUCCESSFULLY);

    }


    /**
     *  poi 设置poi默认图片
     * @return string
     * @throws Exception
     */
    public function default():string{
        $key_id   =   req('key_id');
        $picture   =   req('picture_id');
        $verification   =   [
            [$picture,code::THE_UPLOADED_FILE_IS_EMPTY_PLEASE_TRY_AGAIN,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'update_time'            =>      time(),//
            'picture_id'            =>      $picture
        ];
        $mysql_resources_name =   't_resources';
        updata_detail($code,$mysql_resources_name,$key_id);

        return success(['key_id'=>$key_id,'time'  =>   date('Y-m-d H:i:s',time())],code::SUCCESSFULLY_SET);

    }


    /**
     *  设置酒店默认图片
     * @return string
     * @throws Exception
     */
    public function default_hotel():string{
        $key_id   =   req('key_id');
        $picture   =   req('picture_id');
        $verification   =   [
            [$picture,code::THE_UPLOADED_FILE_IS_EMPTY_PLEASE_TRY_AGAIN,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'update_time'            =>      time(),//
            'picture_id'            =>      $picture
        ];
        $mysql_resources_name =   't_resources_hotel';
        updata_detail($code,$mysql_resources_name,$key_id);

        return success(['key_id'=>$key_id,'time'  =>   date('Y-m-d H:i:s',time())],code::SUCCESSFULLY_SET);

    }
    /**
     *  去除默认图片
     * @return string
     * @throws Exception
     */
    public function DelPicture():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'update_time'           =>      time(),
            'state'           =>      1,
        ];
        $mysql_name   =   GetTableName('t_resources_img');

        updata_detail($code,$mysql_name,$key_id);

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }

}


$data       =   new resource_img();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'picture';
    $list_code  =   array('picture','default','default_hotel','DelPicture');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


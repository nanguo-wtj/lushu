<?php

class resource_city
{
    /**
     *  添加城市信息
     * @return string
     * @throws Exception
     */
    public function city():string{
        global $g_siteid,$g_account;
        $key_id     =   req('key_id');
        $name       =   req('region_name');
        $en_name    =   req('en_name');
        $coordinate =   req('coordinate');
        $address    =   req('address');
        $parent_id  =   req('parent_id');

        $verification   =   [
            [$name,code::PLEASE_ENTER_THE_CHINESE_NAME_OF_THE_CITY,'required'],
//            [$coordinate,code::PLEASE_LOCATE_THE_CITY_ON_THE_MAP,'required'],
        ];
        if($coordinate){
            $coordinate_list    =   explode(',',$coordinate);
        }else{
            $coordinate_list    =   ['',''];
        }
        (new check())->set_code($verification);
        $code   =   [
            'region_name'           =>      $name,//
            'site_id'               =>      $g_siteid,//
            'coordinate'            =>      $coordinate,//
            'en_name'               =>      $en_name,//
            'address'               =>      $address,//
            'lng'                   =>      $coordinate_list[0],//
            'lat'                   =>      $coordinate_list[1],//
            'add_time'              =>      time(),//
            'update_time'           =>      time(),//
            'parent_id'             =>       $parent_id,//
            'account_id'            =>      $g_account['account_id'],//
        ];
        $mysql_name   =   GetTableName('t_resources_city');
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


$data       =   new resource_city();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'city';
    $list_code  =   array('city');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


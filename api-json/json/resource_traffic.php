<?php

class resource_traffic
{
    /**
     *  添加交通内容  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function traffic():string{
        global $g_siteid,$g_account;
        $key_id             =   req('key_id');
        $type               =   req('type');
        $classes            =   req('classes');
        $departure          =   req('departure');
        $reach              =   req('reach');
        $place_departure    =   req('place_departure');
        $place_reach        =   req('place_reach');
        $departime          =   req('departime');
        $arrivaltime        =   req('arrivaltime');
        $consuming_h        =   req('consuming_h');
        $consuming_i        =   req('consuming_i');
        $reference_list          =   req('reference');
        $max_price  =   0;
        $min_price  =   0;
        if($reference_list){
            $reference  =   json_encode($reference_list);
            foreach ($reference_list as $item){
                if($max_price < $item['money']){
                    $max_price  =   $item['money'];
                }
                if($item['money'] < $min_price || $min_price == 0){
                    $min_price  =   $item['money'];
                }
            }
        }


        $verification   =   [
            [$type,code::PLEASE_CHOOSE_THE_MODE_OF_TRANSPORTATION,'required'],
            [$classes,code::PLEASE_ENTER_THE_SHIFT_NUMBER,'required'],
            [$departure,code::PLEASE_ENTER_THE_DEPARTURE_CITY,'required'],
            [$reach,code::PLEASE_ENTER_THE_DESTINATION_CITY,'required'],
            [$place_departure,code::PLEASE_ENTER_THE_DEPARTURE_LOCATION,'required'],
            [$place_reach,code::PLEASE_ENTER_THE_ARRIVAL_LOCATION,'required'],
        ];

        (new check())->set_code($verification);
        $code   =   [
            'type'                  =>  $type,//	1 飞机 2 火车 3 渡船 4 巴士
            'classes'               =>  $classes,//	班次
            'departure'             =>  $departure,//	出发地id  关联城市表
            'place_departure'       =>  $place_departure,//	出发地点
            'reach'                 =>  $reach,//	到达地id  关联城市表
            'place_reach'           =>  $place_reach,//	到达地点
            'departime'             =>  $departime,//	出发时间  H:i
            'arrivaltime'           =>  $arrivaltime,//	到达时间  H:i
            'consuming_h'           =>  $consuming_h,//	耗时：H
            'consuming_i'           =>  $consuming_i,//	耗时：I
            'reference'             =>  $reference,//	参考价格 json格式
            'max_price'             =>  $max_price,//	最高价
            'min_price'             =>  $min_price,//	最低价
            'site_id'               =>  $g_siteid,//
            'account_id'            =>  $g_account['account_id'],//
            'add_time'              =>  time(),//
            'updata_time'           =>  time(),//
        ];
        $mysql_name   =   GetTableName('t_resources_traffic');
        if($key_id){
            $key_id    =   Get_picture((int)$key_id,$mysql_name);
        }
        if(!$key_id){
            add_detail($code,$mysql_name);
        }else{
            unset($code['add_time'],$code['site_id'],$code['account_id']);
            updata_detail($code,$mysql_name,$key_id);
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::ADDED_SUCCESSFULLY);

    }

}


$data       =   new resource_traffic();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'traffic';
    $list_code  =   array('traffic');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


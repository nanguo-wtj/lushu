<?php

class resource_activities
{
    /**
     *  添加活动信息
     * @return string
     * @throws Exception
     */
    public function activities():string{
        global $g_siteid,$g_account;
        $key_id         =   req('key_id');
        $title          =   req('title');
        $label          =   req('label') ?? [];
        $picture        =   req('picture') ?? [];
        $location       =   req('location') ?? [];
        $destination    =   req('destination') ?? [];
        $notice         =   req('notice');
        $introduce      =   req('introduce');
        $notes          =   req('notes') ?? [];
        $reference_list          =   req('reference');


        $max_price  =   0;
        $min_price  =   0;
        $reference  =   '';
        if($reference_list){
            $reference  =   json_encode($reference_list);
            foreach ($reference_list as $item){
                if($max_price < $item['value']){
                    $max_price  =   $item['value'];
                }
                if($item['value'] < $min_price || $min_price == 0){
                    $min_price  =   $item['value'];
                }
            }
        }

        $verification   =   [
            [$title,code::PLEASE_ENTER_ACTIVITY_AND_SERVICE_NAMES,'required'],
            [$destination,code::PLEASE_SELECT_A_LOCATION,'required'],
        ];

        (new check())->set_code($verification);
        $code   =   [
            'title'         =>      $title,//	活动与服务名称
            'label'         =>      implode(',',$label),//	标签
            'picture'       =>      implode(',',$picture),//	图片id集合
            'location'      =>      implode(',',$location),//	位置id集合
            'destination'   =>      implode(',',$destination),//	目的地id集合
            'reference'     =>      $reference,//	参考价格 json格式
            'max_price'     =>      $max_price,//	最高价
            'min_price'     =>      $min_price,//	最低价
            'notice'        =>      $notice,//	须知
            'introduce'     =>      $introduce,//	介绍
            'notes'         =>      implode(',',$notes),//	笔记id集合
            'site_id'       =>      $g_siteid,//
            'account_id'    =>      $g_account['account_id'],//
            'add_time'      =>      time(),//
            'updata_time'   =>      time(),//
        ];
        $mysql_name   =   GetTableName('t_resources_activities');
        if($key_id){
            $key_id    =   Get_picture((int)$key_id,$mysql_name);
        }
        if(!$key_id){
            add_detail($code,$mysql_name);
            $msg    =   code::ADDED_SUCCESSFULLY;
        }else{
            unset($code['add_time'],$code['site_id'],$code['account_id']);
            updata_detail($code,$mysql_name,$key_id);
            $msg    =   code::MODIFIED_SUCCESSFULLY;
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time())],$msg);

    }

    /**
     *  查询活动列表   分页  PAGED
     * @return string
     * @throws Exception
     *
     */
    public function activities_list():string{
        global $g_http,$g_account;
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','notes']],
            'destination'   =>  ['in_set',req('address')],
            'account_id'     =>  $g_account['account_id'],
            'label'   =>  ['in_set',req('label')],
        ];
        $where['state']  =    0;

        $mysql_name   =   GetTableName('t_resources_activities');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id desc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $address_code_list    =   Get_cityname_array(explode(',',$item['destination']));
            $label    =   Get_label_array(explode(',',$item['label']));
            $time   =   Get_day_time($item['updata_time']);
            $picture_name   =   GetTableName('t_resources_img');
            $picture_list   =   explode(',',$item['picture']);
            $picture    =   $picture_list[0];
            $list[] = [
                'id'    =>  $item['id'],
                'title' =>  $item['title'],
                'address' =>  $address_code_list,
                'notes' =>  htmlspecialchars_decode($item['notes']),
                'label' =>  $label,
                'time' =>  $time,
                'url'   =>  Get_details_value($picture,'url',$picture_name),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  查询活动列表  -数据页数  分页  PAGED
     * @return string
     * @throws Exception
     *
     */
    public function activities_number():string{
        global $g_http,$g_account;
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','notes']],
            'destination'   =>  ['in_set',req('address')],
            'account_id'     =>  $g_account['account_id'],
            'label'   =>  ['in_set',req('label')],
        ];
        $where['state']  =    0;

        $mysql_name   =   GetTableName('t_resources_activities');
        $page = req('page');
        $list  =    Get_Count($where,$mysql_name,$page);

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }



}


$data       =   new resource_activities();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'activities';
    $list_code  =   array('activities','activities_list','activities_number');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


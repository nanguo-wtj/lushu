<?php

class resource_details
{
    public $key_id  =   0;
    /**
     *  查询poi详情
     * @return string
     * @throws Exception
     */
    public function resource():string{

        $felid  =   '*';
        $details    =   Get_details_all($this->key_id,$felid,'t_resources');
        $address    =   Get_cityname_array(explode(',',$details['address_code']));
        $address_code_list    =   Get_cityname_array(explode(',',$details['address_code']),false);
        $label    =   Get_label(explode(',',$details['label']));
        $time   =   Get_day_time($details['update_time']);
        $price_list =   Get_price_list($this->key_id);
        $picture_name   =   GetTableName('t_resources_img');

        $price_lists    =   [];
        foreach ($price_list as $item){
            $price_lists[]  =   [
                'title' =>  $item['title'],
                'value' =>  $item['price']
            ];
        }
        $price_lists[]    =   [
            'title' =>  '',
            'value' =>  ''
        ];
        $map_address    =   ['',''];
        if($details['map_address']){
            $map_address    =   explode(',',$details['map_address']);
        }
        $guide  =   '';
        if($details['guide']){
            $guide  =   htmlspecialchars_decode($details['guide']);
        }

        $str  =   [
            'id'            =>  $details['id'],
            'title'         =>  $details['title'],
            'en_title'      =>  $details['en_title'],
            'other_title'   =>  $details['other_title'],
            'address_code'  =>  $address,
            'map_address'   =>  $details['map_address'],
            'lng'   =>  $map_address[0],
            'lat'   =>  $map_address[1],
            'address'       =>  $details['address'],
            'type'          =>  Get_type(1,$details['type']),
            'type_id'          =>  $details['type'],
            'phone'         =>  $details['phone'],
            'official_web'         =>  $details['official_web'],
            'opening_hours'         =>  $details['opening_hours'],
            'consumption'         =>  $details['consumption'],
            'traffic'         =>  $details['traffic'],
            'time_reference'         =>  $details['time_reference'],
            'introduction'         =>  $details['introduction'],
            'guide'         =>  $guide,
            'label'         =>  $label,
            'img'           =>  '',
            'superior_id'           =>  $details['superior_id'],
            'user'          =>  Get_userdata_id('account',$details['account_id'])['account'],
            'time'          =>  $time,
            'address_code_list' =>  $address_code_list,
            'price_list' =>  $price_lists,
            'picture_id'    =>  $details['picture_id'],
            'picture'       =>  Get_details_value($details['picture_id'],'url',$picture_name),
            'default'    =>  $details['default']
        ];
        return success($str,code::REQUEST_SUCCESSFUL);

    }
    /**
     *  查询酒店详情
     * @return string
     * @throws Exception
     */
    public function hotel():string{

        $felid  =   '*';
        $details    =   Get_details($this->key_id,$felid,'t_resources_hotel');
        $address    =   Get_cityname_array(explode(',',$details['address_code']));
        $address_code_list    =   Get_cityname_array(explode(',',$details['address_code']),false);
        $label    =   Get_label(explode(',',$details['label']));
        $time   =   Get_day_time($details['update_time']);
        $price_list =   Get_price_hotel_list($this->key_id);
        $picture_name   =   GetTableName('t_resources_img');

        $price_lists    =   [];
        foreach ($price_list as $item){
            $price_lists[]  =   [
                'title' =>  $item['title'],
                'value' =>  $item['price']
            ];
        }
        $price_lists[]    =   [
            'title' =>  '',
            'value' =>  ''
        ];
        $map_address    =   ['',''];
        if($details['map_address']){
            $map_address    =   explode(',',$details['map_address']);
        }
        $guide  =   '';
        if($details['guide']){
            $guide  =   htmlspecialchars_decode($details['guide']);
        }
        $str  =   [
            'id'            =>  $details['id'],
            'title'         =>  $details['title'],
            'en_title'      =>  $details['en_title'],
            'other_title'   =>  $details['other_title'],
            'address_code'  =>  $address,
            'map_address'   =>  $details['map_address'],
            'lng'   =>  $map_address[0],
            'lat'   =>  $map_address[1],
            'address'       =>  $details['address'],
            'type'          =>  Get_type(1,$details['type']),
            'type_id'          =>  $details['type'],
            'phone'         =>  $details['phone'],
            'official_web'         =>  $details['official_web'],
            'opening_hours'         =>  $details['opening_hours'],
            'consumption'         =>  $details['consumption'],
            'traffic'         =>  $details['traffic'],
            'time_reference'         =>  $details['time_reference'],
            'introduction'         =>  $details['introduction'],
            'guide'         =>  $guide,
            'label'         =>  $label,
            'img'           =>  '',
            'superior_id'           =>  $details['superior_id'],
            'user'          =>  Get_userdata_id('account',$details['account_id'])['account'],
            'time'          =>  $time,
            'address_code_list' =>  $address_code_list,
            'price_list' =>  $price_lists,
            'picture_id'    =>  $details['picture_id'],
            'picture'       =>  Get_details_value($details['picture_id'],'url',$picture_name),
            'default'    =>  $details['default'],
            'rating'    =>  $details['rating'],
            'facilities'    =>  explode(',',$details['facilities']),
            'policy'    =>  $details['policy'],
        ];
        return success($str,code::REQUEST_SUCCESSFUL);

    }
    /**
     *  查询图片详情
     * @return string
     * @throws Exception
     */
    public function picture():string{

        $felid  =   '*';
        $picture_name   =   GetTableName('t_resources_img');
        $details    =   Get_details($this->key_id,$felid,$picture_name);
        $address_code_list    =   Get_cityname_array(explode(',',$details['destination']),false);
        $association_list    =   Get_association_array(explode(',',$details['association_id']),'t_resources','title');
        $time   =   Get_day_time($details['update_time']);

        $str  =   [
            'id'            =>  $details['id'],
            'title'         =>  '图片详情',
            'content'         =>  htmlspecialchars_decode($details['notes']),
            'association_id'         =>  explode(',',$details['association_id']),
            'association'         =>  $association_list,
            'user'          =>  Get_userdata_id('account',$details['account_id'])['account'],
            'add_time'          =>  date('Y-m-d',$details['time']),
            'time'          =>  $time,
            'address_code_list' =>  $address_code_list,
            'picture'       =>  $details['url'],
        ];
        return success($str,code::REQUEST_SUCCESSFUL);

    }
    /**
     *  查询笔记详情
     * @return string
     * @throws Exception
     */
    public function note():string{

        $felid  =   '*';
        $picture_name   =   GetTableName('t_resources_note');
        $details    =   Get_details($this->key_id,$felid,$picture_name);
        $address_code    =   Get_cityname_array(explode(',',$details['destination']));
        $address_code_list    =   Get_cityname_array(explode(',',$details['destination']),false);
        $association_list    =   Get_association_array(explode(',',$details['association_id']),'t_resources','title');
        $time   =   Get_day_time($details['update_time']);
        $label    =   Get_label(explode(',',$details['label']));

        $str  =   [
            'id'            =>  $details['id'],
            'title'         =>  '笔记详情',
            'name'         =>  $details['title'],
            'content'         =>  htmlspecialchars_decode($details['notes']),
            'association_id'         =>  explode(',',$details['association_id']),
            'association'         =>  $association_list,
            'user'          =>  Get_userdata_id('account',$details['account_id'])['account'],
            'add_time'          =>  date('Y-m-d',$details['time']),
            'time'          =>  $time,
            'label'          =>  $label,
            'address_code_list' =>  $address_code_list,
            'address' =>  $address_code,
            'picture'       =>  $details['picture'],
        ];
        return success($str,code::REQUEST_SUCCESSFUL);

    }
    /**
     *  查询城市名称详情
     * @return string
     * @throws Exception
     */
    public function city():string{

        $felid  =   '*';
        $picture_name   =   GetTableName('t_resources_city');
        $details    =   Get_details($this->key_id,$felid,$picture_name);
        $time   =   Get_day_time($details['update_time']);

        $str  =   [
            'id'            =>  $details['id'],
            'title'         =>  '城市详情',
            'name'         =>  $details['region_name'],
            'en_name'         =>  $details['en_name'],
            'parent_id'         =>  $details['parent_id'],
            'parent_name'         =>  Get_cityname($details['parent_id'],false),
            'coordinate'         =>  $details['coordinate'],
            'address'         =>  $details['address'],
            'lng'         =>  $details['lng'],
            'lat'         =>  $details['lat'],
            'user'          =>  Get_userdata_id('account',$details['account_id'])['account'],
            'add_time'          =>  date('Y-m-d',$details['add_time']),
            'time'          =>  $time,

        ];
        return success($str,code::REQUEST_SUCCESSFUL);

    }
    /**
     *  查询亮点详情
     * @return string
     * @throws Exception
     */
    public function trip():string{

        $felid  =   '*';
        $picture_name   =   GetTableName('t_resources_wonderful');
        $details    =   Get_details($this->key_id,$felid,$picture_name);
        $address_code    =   Get_cityname_array(explode(',',$details['destination']),false);
        $address_code_list    =   Get_cityname_array(explode(',',$details['destination']));
        $time   =   Get_day_time($details['update_time']);
        $association_list    =   Get_association_array(explode(',',$details['association_id']),'t_resources','title');

        $str  =   [
            'id'            =>  $details['id'],
            'title'         =>  '亮点详情',
            'name'          =>  $details['title'],
            'notes'         =>  $details['notes'],
            'picture'           =>  $details['url'],
            'address'       =>  $address_code,
            'address_list'       =>  $address_code_list,
            'association'   =>  $association_list,
            'user'          =>  Get_userdata_id('account',$details['account_id'])['account'],
            'add_time'      =>  date('Y-m-d',$details['time']),
            'time'          =>  $time,

        ];
        return success($str,code::REQUEST_SUCCESSFUL);

    }
    /**
     *  查询活动详情
     * @return string
     * @throws Exception
     */
    public function activities():string{
        $felid  =   '*';
        $picture_name   =   GetTableName('t_resources_activities');
        $details    =   Get_details($this->key_id,$felid,$picture_name);
        $picture_list    =   Get_resources_img(explode(',',$details['picture']));
        $notes_list    =   Get_notes(explode(',',$details['notes']));
        $label    =   Get_label(explode(',',$details['label']));
        $address_code_list    =   Get_cityname_array(explode(',',$details['destination']),false);
        $association_list    =   Get_association_array(explode(',',$details['location']),'t_resources','title');
        $time   =   Get_day_time($details['updata_time']);

        $code = [
            'title'             =>      $details['title'],
            'imgList'           =>      $picture_list,
            'association'       =>      $association_list,
            'address_code'      =>      $address_code_list,
            'label'             =>      $label,
            'price'             =>      json_decode($details['reference']),
            'notice'            =>      $details['notice'],
            'service'           =>      $details['introduce'],
            'notes'             =>      $notes_list,
            'time'              =>      $time,
            'user'              =>      Get_userdata_id('username',$details['account_id'])['username'],
        ];
        return success($code,code::REQUEST_SUCCESSFUL);

    }


}

$data       =   new resource_details();
$data->mysql    =   $db;
try{
    $key_id     =   req('key_id');
    $list       =   req('list') ?? 'resource';
    $list_code  =   array('resource','picture','note','city','activities');
    $verification   =   [
        [$key_id,code::PARAMETER_ERROR,'required'],
    ];
    (new check())->set_code($verification);
    $data->key_id   =   $key_id;
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


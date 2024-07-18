<?php

/**
 *  资源操作 接口
 *
 */

class resource_list
{

    /**
     *  POI库列表   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function resource():string{
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','en_title']],
            'address_code'   =>  ['in_set',req('address')],
            'type'      =>  req('type'),
            'label'     =>  ['in_set',req('label')],
        ];
        $where['state']  =    0;

        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$where['type'],code::PARAMETER_ERROR,'numeric'],
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);
        $pages  =   ($page-1)*NUMBER_PAGES;
        $felid  =   ['id','title','en_title','other_title','address','type','label','update_time','address_code','picture_id'];
        $list   =   Get_Resources_list($where,$felid,'t_resources','update_time desc ',$pages);
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  POI库列表-统计页数   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function resource_number():string{
        global $g_account;
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','en_title']],
            'address_code'   =>  ['in_set',req('address')],
            'type'      =>  req('type'),
            'label'     =>  ['in_set',req('label')],
        ];
        $where['state']  =    0;

        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$where['type'],code::PARAMETER_ERROR,'numeric'],
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);
        $where['account_id']    =   $g_account['account_id'];

        $list  =    Get_Count($where,'t_resources',$page);

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  图片库列表   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function picture():string{
        global $db,$g_account;
        $where  =   [
            'notes'     =>  ['like',req('title')],
            'destination'   =>  ['in_set',req('address')],
            'association_id'   =>  ['in_set',req('association_id')],
            'hotel_id'   =>  ['in_set',req('hotel_id')],
        ];
        $where['state']  =    0;
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);
        $pages  =   ($page-1)*NUMBER_PAGES;
        $where['account_id']    =   $g_account['account_id'];
        asort($where);
        $sql_where  =   Get_Where($where);
        $mysql_name   =   GetTableName('t_resources_img');
        $felid   =   'id,url,notes';
        $desc   =   ' id desc';
        $sql = "SELECT ".$felid."  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc."  LIMIT ".$pages.",".NUMBER_PAGES;
        $code   =   $db->get_all($sql);
        $list   =   [];
        foreach ($code as $index=>$item){
            $list[] = [
                'id'    =>  $item['id'],
                'title' =>  $item['notes'],
                'url'   =>  $item['url']
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  图片库列表-统计页数   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function picture_number():string{
        global $db,$g_account;
        $where  =   [
            'notes'     =>  ['like',req('title')],
            'destination'   =>  ['in_set',req('address')],
            'association_id'   =>  ['in_set',req('association_id')],
            'hotel_id'   =>  ['in_set',req('hotel_id')],
        ];
        $where['state']  =    0;
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);
        $pages  =   ($page-1)*NUMBER_PAGES;
        $where['account_id']    =   $g_account['account_id'];
        $mysql_name   =   GetTableName('t_resources_img');

        $list  =    Get_Count($where,$mysql_name,$page);
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  标签列表   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function label():string{
        global $db,$g_account;
        $where  =   [
            'type'     =>  req('type'),
        ];

        $where['account_id']    =   $g_account['account_id'];
        asort($where);
        $sql_where  =   Get_Where($where);
        $mysql_name   =   GetTableName('t_label');
        $felid   =   'id,label';
        $desc   =   ' id desc';
        $sql = "SELECT ".$felid."  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc." ;";
        $code   =   $db->get_all($sql);
        $list   =   [];
        foreach ($code as $index=>$item){
            $list[] = [
                'id'    =>  $item['id'],
                'label' =>  $item['label'],
                'status' =>  false,
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  笔记   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function note():string{
        global $g_http,$g_account;
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','notes']],
            'account_id'     =>  $g_account['account_id'],
            'association_id'   =>  ['in_set',req('association_id')],
            'hotel_id'   =>  ['in_set',req('hotel_id')],
            'destination'   =>  ['in_set',req('address')],
            'label'   =>  ['in_set',req('label')],
        ];
        $where['state']  =    0;

        $mysql_name   =   GetTableName('t_resources_note');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }

        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id desc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $picture    =   $item['picture'] ? $item['picture']:'/lushu/static/images/noimg.jpg';
            $address_code_list    =   Get_cityname_array(explode(',',$item['destination']));
            $label    =   Get_label_array(explode(',',$item['label']));
            $time   =   Get_day_time($item['update_time']);

            $list[] = [
                'id'    =>  $item['id'],
                'title' =>  $item['title'],
                'address' =>  $address_code_list,
                'notes' =>  htmlspecialchars_decode($item['notes']),
                'label' =>  $label,
                'time' =>  $time,
                'url'   =>  $g_http.$_SERVER['HTTP_HOST'].$picture,
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  笔记-统计页数   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function note_number():string{
        global $g_http,$g_account;
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','notes']],
            'account_id'     =>  $g_account['account_id'],
            'association_id'   =>  ['in_set',req('association_id')],
            'hotel_id'   =>  ['in_set',req('hotel_id')],
            'destination'   =>  ['in_set',req('address')],
            'label'   =>  ['in_set',req('label')],
        ];
        $where['state']  =    0;

        $mysql_name   =   GetTableName('t_resources_note');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }

        $list  =    Get_Count($where,$mysql_name,$page);

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  酒店库列表   分页  PAGED
     * @return string
     * @throws Exception

     */
    public function hotel():string{
        global $g_account;
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','en_title']],
            'address'   =>  ['in_set',req('address')],
            'rating'      =>  req('rating'),
            'label'     =>  ['in_set',req('label')],
            'account_id'     =>  $g_account['account_id'],
        ];
        $where['state']  =    0;
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);
        $pages  =   ($page-1)*NUMBER_PAGES;
        $felid  =   ['id','title','label','update_time','rating','picture_id','min_money'];
        $code   =   Get_data_list($where,$felid,'t_resources_hotel','update_time desc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $label    =   Get_label(explode(',',$item['label']));
            $time   =   Get_day_time($item['update_time']);
            $picture_name   =   GetTableName('t_resources_img');
            $list[]  =   [
                'id'            =>  $item['id'],
                'title'         =>  $item['title'],
                'label'         =>  $label,
                'img'           =>  '',
                'user'          =>  Get_userdata_id('account',$g_account['account_id'])['account'],
                'time'          =>  $time,
                'picture_id'    =>  $item['picture_id'],
                'rating'        =>  (int)$item['rating'],
                'min_money'        =>  $item['min_money'],
                'picture'       =>  Get_details_value($item['picture_id'],'url',$picture_name)
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  酒店库列表-统计页数   分页  PAGED
     * @return string
     * @throws Exception

     */
    public function hotel_number():string{
        global $g_account;
        $where  =   [
            'title'     =>  ['or',[req('title'),'like','en_title']],
            'address'   =>  ['in_set',req('address')],
            'rating'      =>  req('rating'),
            'label'     =>  ['in_set',req('label')],
            'account_id'     =>  $g_account['account_id'],
        ];
        $where['state']  =    0;
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);

        $list  =    Get_Count($where,'t_resources_hotel',$page);

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  poi关联图片列表   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function template():string{
        global $g_http,$g_account;
        $where  =   [
            'account_id'     =>  $g_account['account_id'],
            'superior_id'    =>  req('superior_id'),
        ];
        $mysql_name   =   GetTableName('t_resources_template');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id asc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $picture_name   =   GetTableName('t_resources_img');

            $list[] = [
                'id'            =>      $item['id'],//
                'name'         =>      $item['name'],//
                'title'         =>      $item['title'],//
                'type'          =>      Get_type(1,$item['type']),//
                'picture'       =>      Get_picture_list($item['picture'],$picture_name,'id,url as value'),//
                'introduction'  =>      $item['introduction'],//
                'information'   =>      json_decode($item['information'],true),//
                'details'       =>      $item['details'],//
                'note'          =>      $item['note'],//
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  酒店关联图片列表   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function template_hotel():string{
        global $g_http,$g_account;
        $where  =   [
            'account_id'     =>  $g_account['account_id'],
            'superior_id'    =>  req('superior_id'),
        ];
        $mysql_name   =   GetTableName('t_resources_hotel_template');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id asc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $picture_name   =   GetTableName('t_resources_img');

            $list[] = [
                'id'            =>      $item['id'],//
                'name'         =>      $item['name'],//
                'title'         =>      $item['title'],//
                'type'          =>      Get_type(1,$item['type']),//
                'picture'       =>      Get_picture_list($item['picture'],$picture_name,'id,url as value'),//
                'introduction'  =>      $item['introduction'],//
                'information'   =>      json_decode($item['information'],true),//
                'details'       =>      $item['details'],//
                'note'          =>      $item['note'],//
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  城市名称列表   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function city():string{
        global $g_http,$g_account;
        $where  =   [
            'account_id'     =>  $g_account['account_id'],
            'region_name'     =>  ['or',[req('title'),'like','en_name']],
        ];
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $where['state']  =    0;
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);

        $mysql_name   =   GetTableName('t_resources_city');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id desc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $time   =   Get_day_time($item['update_time']);
            $list[] = [
                'id'                    =>      $item['id'],//
                'region_name'           =>      $item['region_name'],//
                'coordinate'            =>      $item['coordinate'],//
                'en_name'               =>      $item['en_name'],//
                'user'                  =>      Get_userdata_id('account',$g_account['account_id'])['account'],
                'time'                  =>      $time,
                'parent_city'                  =>      Get_cityname($item['parent_id'],false),

            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  城市名称列表 -数据分页   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function city_number():string{
        global $g_http,$g_account;
        $where  =   [
            'account_id'     =>  $g_account['account_id'],
            'region_name'     =>  ['or',[req('title'),'like','en_name']],
        ];
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $where['state']  =    0;
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);

        $mysql_name   =   GetTableName('t_resources_city');
        $page = req('page');

        $list  =    Get_Count($where,$mysql_name,$page);

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  城市名称列表--可以查不是自已的   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function city_all():string{
        global $g_http,$g_account;
        $where  =   [
            'level'     =>  2,
            'region_name'     =>  ['or',[req('title'),'like','en_name']],
        ];
        $page = req('page');
        $project_id = req('project_id');
        if( $project_id){
            $city   =   [];
            $details    =   Get_data_listall(['project_id' =>  $project_id],'id,city','t_project_remarks_day','day asc');
            foreach ($details as $item){
                if($item['city']){
                    $citys =   explode(',',$item['city']);
                }else{
                    $citys  =   [];
                }
                $city   =   array_merge($city,$citys);
            }
            $city   =   array_unique($city);
        }

        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);

        $mysql_name   =   't_city';
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id asc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $status =   false;
            if( $project_id){
                if(in_array($item['id'],$city)){
                    $status =   true;
                }
            }
            $list[] = [
                'id'                    =>      $item['id'],//
                'region_name'           =>      $item['region_name'],//
                'en_name'               =>      $item['en_name'],//
                'lng'                   =>      $item['lng'],
                'lat'                   =>      $item['lat'],
                'status'                =>      $status
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  查看项目城市名称列表  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function project_city():string{
        global $g_http,$g_account;

        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PARAMETER_ERROR.'1','required'],
        ];
        (new check())->set_code($verification);
        $city_paths =   [];
        $map_list =   [];
        $details    =   Get_data_listall(['project_id' =>  $key_id],'id,city','t_project_remarks_day','day asc');
        foreach ($details as $item){
            if($item['city']){
                foreach (explode(',',$item['city']) as $a){
                    $where = ['id' => $a];
                    $data = Get_details_whereno($where, 'id,lng,lat,region_name', 't_city','');
                    if($data){
                        $city_paths[]   =   array($data['lng'],$data['lat']);
                        $map_list[]   =     [
                            'name'      =>  $data['region_name'],
                            'lng'       =>  $data['lng'],
                            'lat'       =>  $data['lat'],
                        ];
                    }
                }

            }
        }
        if($city_paths){
            $city_paths[]   =   $city_paths[0];
        }
        return success(['city'=>$city_paths,'map_list'=>$map_list,'time'  =>   date('Y-m-d H:i:s',time())],code::OPERATION_SUCCESSFUL);


    }

    /**
     *  查看行程路线库/导出项目城市名称列表  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function project_city_export():string{
        global $g_http,$g_account;

        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PARAMETER_ERROR.'1','required'],
        ];
        (new check())->set_code($verification);
        $city_paths =   [];
        $map_list =   [];
        $details    =   Get_data_listall(['project_id' =>  $key_id],'id,city','t_export_project_remarks_day','day asc');
        foreach ($details as $item){
            if($item['city']){
                foreach (explode(',',$item['city']) as $a){
                    $where = ['id' => $a];
                    $data = Get_details_whereno($where, 'id,lng,lat,region_name', 't_city','');
                    $city_paths[]   =   array($data['lng'],$data['lat']);
                    $map_list[]   =     [
                        'name'      =>  $data['region_name'],
                        'lng'       =>  $data['lng'],
                        'lat'       =>  $data['lat'],
                    ];
                }

            }
        }
        if($city_paths){
            $city_paths[]   =   $city_paths[0];
        }
        return success(['city'=>$city_paths,'map_list'=>$map_list,'time'  =>   date('Y-m-d H:i:s',time())],code::OPERATION_SUCCESSFUL);


    }


    /**
     *  亮點列表  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function trip():string{
        global $g_http,$g_account;
        $where  =   [
            'account_id'     =>  $g_account['account_id'],
            'title'     =>  ['or',[req('title'),'like','notes']],
            'destination'   =>  ['in_set',req('address')],
            'association_id'   =>  ['in_set',req('association')],
        ];
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $where['state']  =    0;

        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);

        $mysql_name   =   GetTableName('t_resources_wonderful');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id desc',$pages);
        $list   =   [];

        foreach ($code as $index=>$item){
            $list[] = [
                'id'            =>      $item['id'],//
                'title'         =>      $item['title'],//
                'notes'         =>      $item['notes'],//
                'picture'       =>      $item['url']//
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);

    }
    /**
     *  亮點列表  - 数据分页  PAGED
     * @return string
     * @throws Exception
     */
    public function trip_number():string{
        global $g_http,$g_account;
        $where  =   [
            'account_id'     =>  $g_account['account_id'],
            'title'     =>  ['or',[req('title'),'like','notes']],
            'destination'   =>  ['in_set',req('address')],
            'association_id'   =>  ['in_set',req('association')],
        ];
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $where['state']  =    0;

        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);

        $mysql_name   =   GetTableName('t_resources_wonderful');
        $list  =    Get_Count($where,$mysql_name,$page);

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);

    }
    /**
     *  查询poi/酒店列表-全部（本身加后台管理员编辑的）  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function allResource():string{
        global $g_http,$g_account;
        $where  =   [
            'title'     =>  ['like',req('title')],
            'address_code'   =>  ['in_set',req('address')],
        ];

        $page = req('page');
        $type = req('type')  ?? 'poi';
        if(!$page){
            $page   =   1;
        }
        $verification   =   [
            [$page,code::PARAMETER_ERROR,'numeric'],
        ];
        (new check())->set_code($verification);

        if($type == 'activity'){
            return  $this->GetActivity($where,$page);
        }

        switch ($type){
            case 'hotel':
                $mysql_name   =   't_resources_hotel';
                $felid  =   'id,title,map_address,picture_id,en_title,type';
                $where['account_id']  =    ['in',$g_account['account_id'].',0,1'];
                break;
            default:
                $mysql_name   =   't_resources';
                $where['account_id']  =    ['in',$g_account['account_id'].',0,1'];
                $felid  =   'id,title,map_address,picture_id,en_title,type';
                break;

        }
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,$felid,$mysql_name,'id desc',$pages);
        $list   =   [];

        foreach ($code as $index=>$item){
            $map_address    =   ['',''];
            if(isset($item['map_address']) && $item['map_address']){
                $map_address    =   explode(',',$item['map_address']);
                if(count($map_address) !=   2){
                    $map_address    =   ['',''];
                }
            }
            $picture_name   =   GetTableName('t_resources_img');
            $list[] = [
                'id'            =>      $item['id'],//
                'title'         =>      $item['title'],//
                'en_title'         =>      $item['en_title'],//
                'type'         =>      $item['type'],//
                'lng'           =>  $map_address[0],
                'lat'           =>  $map_address[1],
                'picture'       =>  Get_details_value($item['picture_id'],'url',$picture_name)
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);

    }
    /**
     *  活动服务列表  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function GetActivity($where  =   array(),$page   =   1):string{
        $mysql_name   =   GetTableName('t_resources_activities');
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        if(isset($where['address_code'])){
            $where['destination']   =   $where['address_code'];
            unset($where['address_code']);
        }

        $pages  =   ($page-1)*NUMBER_PAGES;
        $code   =   Get_data_list($where,'*',$mysql_name,'id desc',$pages);
        $list   =   [];
        foreach ($code as $index=>$item){
            $picture_name   =   GetTableName('t_resources_img');
            $picture_list   =   explode(',',$item['picture']);
            $picture    =   $picture_list[0];
            $list[] = [
                'id'            =>      $item['id'],//
                'title'         =>      $item['title'],//
                'type'         =>      7,//
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'picture'       =>  Get_details_value($picture,'url',$picture_name)
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $list],code::REQUEST_SUCCESSFUL);

    }






}


$data       =   new resource_list();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'resource';
    $list_code  =   array('resource','picture','label','note','template','hotel','template_hotel','city','trip','city_all',
        'project_city','allResource','project_city_export','note_number','resource_number','picture_number','hotel_number',
        'city_number','trip_number');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();
} catch (Exception $e){
    $data->mysql->rollback();
    echo error('错误信息：'.$e->getMessage());
}


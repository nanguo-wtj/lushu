<?php

/**
 *  项目基本信息 接口
 *
 */
class open_view
{



    /**
     *  添加项目詳細信息  -  根据项目key查询费用核算
     * @throws Exception
     * @return string
     */
    public function Cost():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($key_id) !=1){
            return error_no( '',code::PROCESS_ERROR);;
        }

        $details    =   Get_details_all($key_id,'start_time,end_time,day','t_project');

        $code   =   [];
        $mysql_project_traffic_name   =   GetTableName('t_project_traffic',$key_id);
        $mysql_project_cost_name   =   GetTableName('t_project_cost',$key_id);

        $hotel  =   [];
        $Traffic  =   [];
        $schedule  =   [];
        $Traffic_money  =   0;
        $hotel_money  =   0;
        $schedule_money  =   0;
        $firt_day   =   [0,0];
        for ($i=0;$i<$details['day'];$i++){
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>($i+1)],'id,hotel,traffic,hotel_time,hotel_day','t_project_remarks_day');
            if(!$details_day){
                continue;
            }
            $time   =   $details['start_time']+(86400*$i);
            $work   =   Get_work($time);
            $time_yH    =  date('m-d',$time);
            // 交通列表
            $Traffic_day_cost   =   [];
            $Traffic_data   =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'*',$mysql_project_traffic_name,'traffic_sort asc',);
            foreach ($Traffic_data as   $index=>$item){
                if(!$item['traffic']){
                    continue;
                }
                $Traffic_cost_list   =   Get_data_listall(['type'=>1,'project_id'=>$key_id,'day'=>($i+1),'class_id'=>$item['id']],'*',$mysql_project_cost_name);
                $Traffic_cost   =   [];
                foreach ($Traffic_cost_list as $a){
                    $Traffic_cost[] =   [
                        'name'  =>  $a['name'],
                        'option'  =>  $a['option'],
                        'price'  =>  $a['price'],
                        'money'  =>  $a['money'],
                        'number'  =>  $a['number'],
                    ];
                    $Traffic_money  =   $Traffic_money+$a['money'];
                }
                $Traffic_day_cost[]   =   [
                    'id'  =>  $item['id'],
                    'startingPoint'    =>  ['id'    =>  $item['starting_id'],'region_name'  =>  Get_cityname($item['starting_id'],false)],
                    'destination'   =>  ['id'    =>  $item['destination_id'],'region_name'  =>  Get_cityname($item['destination_id'],false)],
                    'cost'  =>  $Traffic_cost,
                    'cost_number'   =>  count($Traffic_cost),
                    'Traffic'   =>  $item['traffic'],
                    'Traffic_value' =>  Get_traffic($item['traffic'],'暂未选择')
                ];
            }
            if($Traffic_day_cost){
                $Traffic[$i]    =   [
                    'day'   =>  $i+1,
                    'work'  =>  $work,
                    'time'  =>  $time_yH,
                    'list'  =>  $Traffic_day_cost,
                    'list_number'   =>  count($Traffic_day_cost)
                ];
            }


            // 酒店列表
            if($details_day['hotel']){
                if( ($i+1) < $firt_day[0] || ($i+1) >  $firt_day[1]){
                    $hotel_cost_list   =   Get_data_list(['type'=>2,'project_id'=>$key_id,'day'=>($i+1),'class_id'=>$details_day['hotel']],'*',$mysql_project_cost_name);
                    $hotel_cost   =   [];
                    foreach ($hotel_cost_list as $a){
                        $hotel_cost[] =   [
                            'name'  =>  $a['name'],
                            'option'  =>  $a['option'],
                            'price'  =>  $a['price'],
                            'money'  =>  $a['money'],
                            'number'  =>  $a['number'],
                        ];
                        $hotel_money    =   $hotel_money+$a['money'];
                    }
                    $firt_day   =   explode(',',$details_day['hotel_day']);
                    $hotel_time   =   $details['start_time']+(86400*($firt_day[1]-$firt_day[0]+1)-1);
                    $hotel_work   =   Get_work($hotel_time);
                    $hotel_time_yH    =  date('m-d',$hotel_time);

                    $hotel[] = [
                        'day'   =>  $i+1,
                        'hotel_time'  =>  "D".$firt_day[0]." ~ D".$firt_day[1]." (".($firt_day[1]-$firt_day[0]+1)."天)",
                        'work'  =>  $work.'~'.$hotel_work,
                        'time'  =>  $time_yH.'~'.$hotel_time_yH,
                        'id'  =>   $details_day['hotel'],
                        'name' => Get_details_where(['id' => $details_day['hotel']], 'title,en_title', 't_resources_hotel'),
                        'cost'  =>  $hotel_cost,
                        'cost_number'   =>  count($hotel_cost)
                    ];
                }

            }

            //POI列表
            $schedule_day_cost  =   [];
            $schedule_list    =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'id,poi_sort,schedule,day,type,poi_sort,traffic','t_project_day_schedule','poi_sort asc');
            foreach ($schedule_list as   $index=>$item) {
                $schedule_cost_list = Get_data_list(['type' => 4, 'project_id' => $key_id, 'day' => ($i + 1), 'class_id' => $item['id']], '*', $mysql_project_cost_name);
                $schedule_cost = [];
                if ($item['type'] != 7) {
                    $resources = Get_details_where(['id' => $item['schedule']], 'title', 't_resources');
                    foreach ($schedule_cost_list as $a) {
                        $schedule_cost[] = [
                            'name' => $a['name'],
                            'option' => $a['option'],
                            'price' => $a['price'],
                            'money' => $a['money'],
                            'number' => $a['number'],
                        ];
                        $schedule_money = $schedule_money + $a['money'];
                    }
                    $schedule_day_cost[] = [
                        'day' => $i + 1,
                        'work' => $work,
                        'time' => $time_yH,
                        'title' => $resources['title'],
                        'id' => $item['id'],
                        'cost' => $schedule_cost,
                        'cost_number' => count($schedule_cost)
                    ];
                }
                if ($schedule_day_cost) {
                    $schedule[$i] = [
                        'day' => $i + 1,
                        'work' => $work,
                        'time' => $time_yH,
                        'list' => $schedule_day_cost,
                        'list_number' => count($schedule_day_cost)

                    ];
                }
            }




        }
        $code   =   [
            'Traffic'  =>  $Traffic,
            'Traffic_money'  =>  $Traffic_money,
            'hotel'  =>  $hotel,
            'hotel_money'  =>  $hotel_money,
            'schedule'  =>  $schedule,
            'schedule_money'  =>  $schedule_money,
        ];
        return success( $code,code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  获取项目行程报价
     * @throws Exception
     * @return string
     */
    public function quotation():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>5],'*',$mysql_name,'id asc');

        $code   =  [];
        foreach ($list as $item){
            $code[]   =   [
                'addtime'   =>  date('Y-m-d H:i:s',$item['addtime']),
                'id'    =>  $item['id'],
                'project_id'    =>  $item['project_id'],
                'content'   =>  json_decode($item['content']),
                'type'  =>  $item['type'],
                'class_type'    =>  $item['class_type'],
                'class_view'    =>  explode(',',$item['class_view']),
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  获取项目行程报价列表
     * @return string
     * @throws Exception
     */
    public function Const_quotation():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>1],'*',$mysql_name,'id asc');
        $code   =  [];

        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'title'    =>  $item['title'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  根据项目key查询项目报价费用不包括
     * @return string
     * @throws Exception
     */
    public function NotIncluded():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>2],'*',$mysql_name,'id asc');
        $code   =  [];
        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  根据项目key查询项目报价可选付费项目
     * @return string
     * @throws Exception
     */
    public function PaidItems():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>3],'*',$mysql_name,'id asc');
        $code   =  [];

        foreach ($list as $item){
            $code[]   =   [
                'id'    =>  $item['id'],
                'title'    =>  $item['title'],
                'content'   =>  $item['content'],
                'status'  =>  false,
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }



    /**
     *  项目  获取项目行程报价分类
     * @return string
     * @throws Exception
     */
    public function quotation_type():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_quotation_subterm',$key_id);
        $list   =   Get_data_listall(['project_id'=>$key_id,'type'=>5],'class_type,class_view',$mysql_name);
        $code   =  [];
        $class_type =   [];
        $class_view =   [];
        $class_type_user =   [];
        foreach ($list as $item){
            $class_view =   explode(',',$item['class_view']);
            if(in_array($item['class_type'],array('经济','奢华'))){
                $class_type[]   =   $item['class_type'];
            }else{
                if($item['class_type'] !=  '标准'){
                    $class_type_user[]   =   $item['class_type'];

                }
            }
        }
        foreach ($class_view as $index=>$item){
            $class_view[$index] =   (int)$item;
        }
        $code   =   [
            'class_type'    =>  $class_type,
            'class_type_user'    =>  $class_type_user,
            'class_view'    =>  $class_view,
        ];

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  项目  根据项目key查询项目报价补充说明
     * @return string
     * @throws Exception
     */
    public function supplement():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_quotation_subterm',$key_id);
        $details   =   Get_details_whereno(['project_id'=>$key_id,'type'=>4],'*',$mysql_name);
        if(!$details){
            $code   =   [
                'addtime'   =>  time(),
                'project_id'    =>  $key_id,
                'content'   =>  '',
                'type'  =>  4,
            ];
            $class_id   =   add_detail($code,$mysql_name);
            $code['id'] =   $class_id;
        }else{
            $code   =   [
                'id'    =>  $details['id'],
                'project_id'    =>  $details['project_id'],
                'content'   =>  $details['content'],
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  获取项目基本信息
     * @return string
     * @throws Exception
     */
    public function Project_data(): string
    {

        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        $project_data   =   Get_details_all($key_id,'*');
        if($project_data['is_delete'] == 1){
            return error_role(code::PARAMETER_ERROR);
        }
        $code   =   [];
        $code['title']  =   $project_data['title'];
        $code['user']   =   Get_userdata_id('username',$project_data['account_id'])['username'];
        $code['time']   =   date('Y-m-d',$project_data['start_time']);
        $code['start_time']   =   date('Y-m-d',$project_data['start_time']);
        $code['end_time']   =   date('Y-m-d',$project_data['end_time']);
        $code['update_time']   =   date('Y-m-d H:i:s',$project_data['update_time']);
        $code['departure']   =  Get_cityname($project_data['departure'],false);
        $code['url']   =  $project_data['url'];
        $code['is_sale']   =  (int)$project_data['is_sale'];
        $code['day']    =  $project_data['day'];
        $code['city']   =  GetProjectCity($key_id);


        return success( $code,code::REQUEST_SUCCESSFUL);
    }


    /**
     *  获取项目全部天数的 景点 酒店  交通 相关城市
     * @return string
     * @throws Exception
     */
    public function Project_day():string{
        $key_id   =   req('key_id');
        $day   =   req('day');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($key_id) !=1){
            return error_no( '',code::PROCESS_ERROR);;
        }


        $details    =   Get_details_all($key_id,'start_time,end_time,day');
        $code   =   [];

        $code['start_time'] =   date('Y-m-d',$details['start_time']);
        $code['end_time']   =   date('Y-m-d',$details['end_time']);
        $code['time']       =   date('Y-m-d',time());
        $code['day']        =   [];
        $code['traffic']        =   [];
        $mysql_name   =   GetTableName('t_project_traffic',$key_id);

        for ($i=0;$i<$details['day'];$i++){
            $is_status  =   '';
            $time   =   $details['start_time']+(86400*$i);
            if($day == ($i+1)){
                $is_status =   1;
            }

            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>($i+1)],'id,hotel,traffic','t_project_remarks_day');
            if(!$details_day){
                continue;
            }

            $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'id,schedule,type,poi_sort,traffic','t_project_day_schedule','poi_sort asc');
            $schedule   =   [];

            foreach ($list as $item){
                $traffic    =   Get_traffic($item['traffic']);
                if($item['type'] != 7){
                    $resources =   Get_details_where(['id'=>$item['schedule']],'title,map_address','t_resources');

                    $map_address    =   ['',''];
                    if($resources['map_address']){
                        $map_address    =   explode(',',$resources['map_address']);
                        if(count($map_address) != 2){
                            $map_address    =   ['',''];
                        }
                    }
                    $schedule[]   =   [
                        'schedule'  =>  $item['schedule'],
                        'day'       =>  $i+1,
                        'type'      =>  $item['type'],
                        'poi_sort'  =>  $item['poi_sort'],
                        'lng'       =>      $map_address[0],
                        'lat'       =>      $map_address[1],
                        'title'     =>  $resources['title'],
                        'id'        =>  $item['id'],
                        'traffic'   =>  $traffic
                    ];
                }

            }


            $traffic_code    =   [];
            $Traffic_list   =   Get_data_list(['project_id'=>$key_id,'day'=>($i+1)],'*',$mysql_name,'traffic_sort asc',);
            foreach ($Traffic_list as $item){
                if($item['traffic']){
                    $traffic_code[] =[
                        'startingPoint'    =>  ['id'    =>  $item['starting_id'],'region_name'  =>  Get_cityname($item['starting_id'],false)],
                        'destination'   =>  ['id'    =>  $item['destination_id'],'region_name'  =>  Get_cityname($item['destination_id'],false)],
                        'id'   =>  $item['id'],
                        'Traffic'   =>  $item['traffic'],
                        'Traffic_value' =>  Get_traffic($item['traffic'],'暂未选择')
                    ];
                }

            }
            $work   =   Get_work($time);
            $time_yH    =  date('m-d',$time);
            foreach ($traffic_code as $a){
                $traffic_data   =   $a;
                $traffic_data['day']  =   $i+1;
                $traffic_data['work']  =   $work;
                $traffic_data['time']  =   $time_yH;
                $code['traffic'][] = $traffic_data;
            }




            $code['day'][]  =   [
                'day'   =>  $i+1,
                'work'  =>  $work,
                'time'  =>  $time_yH,
                'status'  =>  $is_status,
                'schedule'  =>  $schedule,
                'hotel'  =>  Get_details_value($details_day['hotel'],'title','t_resources_hotel'),
                'traffic'  =>  $traffic_code,
                'city'  =>  Get_project_day_city($key_id,$i+1)
            ];
        }


        return success( $code,code::REQUEST_SUCCESSFUL);;
    }
    /**
     *  获取项目基础信息 亮点 行程介绍 定制师笔记
     * @return string
     * @throws Exception
     */
    public function GetItinerary(): string
    {

        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);


        $project_data   =   Get_details_all($key_id,'title,account_id,id,is_status');
        //判断修改数据是否存在
        if(isset($project_data['id']) && !$project_data['id']){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if($project_data['is_status'] !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }


        $details    =   Get_details_where(['project_id' =>  $key_id],'Highlights,content,note','t_project_remarks');
        $code   =   [];
        $code['title']        =   $project_data['title'];
        $code['content']        =   htmlspecialchars_decode($details['content']);
        $code['Highlights']     =   [];
        $code['note']           =   [];
        $Highlights =   explode(',',$details['Highlights']);
        $note       =   explode(',',$details['note']);
        $code['Highlights_id']     =   $Highlights;
        $code['note_id']           =   $note;
        $mysql_name   =   GetTableName('t_resources_wonderful',$project_data['account_id']);
        foreach ($Highlights as $item){
            $data   =   Get_details_all($item,'id,url,title,notes',$mysql_name);
            if($data){
                $code['Highlights'][] =   [
                    'id'        =>  $data['id'],
                    'url'       =>  $data['url'],
                    'title'     =>  $data['title'],
                    'content'   =>  $data['notes']
                ];
            }
        }
        $mysql_name   =   GetTableName('t_resources_note',$project_data['account_id']);
        foreach ($note as $item){
            $data   =   Get_details_all($item,'id,picture,title,account_id',$mysql_name);
            if($data){
                $code['note'][] =   [
                    'id'        =>  $data['id'],
                    'url'       =>  $data['picture'],
                    'title'     =>  $data['title'],
                    'user'      =>  Get_userdata_id('account',$data['account_id'])['account']
                ];
            }

        }

        return success( $code,code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目詳細信息  -  根据项目key获取项目日期内全部信息
     * @return string
     * @throws Exception
     */
    public function TravelRoute():string{
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($key_id) !=1){
            return error_no( '',code::PROCESS_ERROR);;
        }



        $details    =   Get_details_all($key_id,'start_time,end_time,day,account_id');
        $code   =   [];
        for ($i=0;$i<$details['day'];$i++){
            $time   =   $details['start_time']+(86400*$i);
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>($i+1)],'id,hotel,traffic,breakfast,lunch,dinner,content,note,hotel_time','t_project_remarks_day');
            if(!$details_day){
                continue;
            }
            $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'id,schedule,type,poi_sort,traffic','t_project_day_schedule','poi_sort asc');
            $schedule   =   [];
            foreach ($list as $item){
                if($item['type'] != 7){
                    $traffic    =   Get_traffic($item['traffic'],'未选择交通工具');
                    $picture_name   =   GetTableName('t_resources_img',$details['account_id']);

                    $resources =   Get_details_whereno(['id'=>$item['schedule']],'title,introduction,picture_id','t_resources');
                    if($resources){
                        $schedule[]   =   [
                            'schedule'  =>  $item['schedule'],
                            'day'       =>  $i+1,
                            'type'      =>  $item['type'],
                            'poi_sort'  =>  $item['poi_sort'],
                            'title'     =>  $resources['title'],
                            'introduction'     =>  $resources['introduction'],
                            'picture'       =>  Get_details_value($resources['picture_id'],'url',$picture_name),
                            'id'        =>  $item['id'],
                            'traffic'   =>  $traffic
                        ];
                    }

                }

            }
            $Restaurant =   [
                'breakfast' =>  $details_day['breakfast'],
                'lunch' =>  $details_day['lunch'],
                'dinner' =>  $details_day['dinner'],
            ];
            $note       =   explode(',',$details_day['note']);
            $note_list  =   [];
            $mysql_name   =   GetTableName('t_resources_note',$details['account_id']);

            foreach ($note as $item){
                $data   =   Get_details_all($item,'id,picture,title,account_id',$mysql_name);
                if($data){
                    $note_list[] =   [
                        'id'        =>  $data['id'],
                        'url'       =>  $data['picture'],
                        'title'     =>  $data['title'],
                        'user'      =>  Get_userdata_id('account',$data['account_id'])['account']
                    ];
                }

            }
            $hotel  =   [];
            if($details_day['hotel']) {
                $hotel = [
                    'id' => $details_day['hotel'],
                    'name' => Get_details_where(['id' => $details_day['hotel']], 'title,en_title', 't_resources_hotel'),
                    'time' => $details_day['hotel_time'],
                ];
            }

            $work   =   Get_work($time);
            $time_yH    =  date('m-d',$time);

            $code[]  =   [
                'day'   =>  $i+1,
                'work'  =>  $work,
                'time'  =>  $time_yH,
                'restaurant'  =>  $Restaurant,
                'hotel'  =>  $hotel,
                'schedule'  =>  $schedule,
                'note'  =>  $note_list,
                'content'  =>  htmlspecialchars_decode($details_day['content']),
//                'hotel'  =>  Get_details_value($details_day['hotel'],'title','t_resources_hotel'),
                'traffic'  =>  json_decode($details_day['traffic']),
                'city'  =>  Get_project_day_city($key_id,$i+1)
            ];
        }


        return success( $code,code::REQUEST_SUCCESSFUL);;
    }

    /**
     *  项目詳細信息  -  根据项目key获取项目内全部日期酒店信息
     * @return string
     * @throws Exception
     */
    public function Getbooking():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($key_id) !=1){
            return error_no( '',code::PROCESS_ERROR);;
        }
        $project_data    =   Get_details_all($key_id,'start_time,end_time,day,account_id');

        $code   =   [];
        $details_day    =   Get_data_listall(['project_id'=>$key_id],'id,day,hotel,hotel_day,hotel_time','t_project_remarks_day');
        $in_day =   [0,0];
        $mysql_name   =   GetTableName('t_resources_img',$project_data['account_id']);
        foreach ($details_day as    $item){
            if($item['hotel']){
                if($item['day'] <  $in_day[0] || $item['day'] >  $in_day[1]){
                    $in_day =   explode(',',$item['hotel_day']);
                    $hotel  =   Get_details_where(['id' => $item['hotel']], 'title,en_title,picture_id', 't_resources_hotel');
                    $code[] = [
                        'id' => $item['hotel'],
                        'name' => $hotel['title'],
                        'en_name' => $hotel['en_title'],
                        'time' => $item['hotel_time'],
                        'day' => $in_day,
                        'url'   =>  Get_details_value($hotel['picture_id'],'url',$mysql_name)
                    ];
                }
            }
        }


        return success( $code,code::REQUEST_SUCCESSFUL);;
    }

    /**
     *  获取笔记详情
     * @return string
     * @throws Exception
     */
    public function note():string{
        $project_id   =   req('project_id');
        $key_id   =   req('key_id');
        $verification   =   [
            [$project_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        //判断修改数据是否存在
        if(Get_status_project($project_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($project_id) !=1){
            return error_no( '',code::PROCESS_ERROR);;
        }

        $project_data    =   Get_details_all($project_id,'start_time,end_time,day,account_id');

        $felid  =   '*';
        $picture_name   =   GetTableName('t_resources_note',$project_data['account_id']);
        $details    =   Get_details_all($key_id,$felid,$picture_name);
        $address_code    =   Get_cityname_array(explode(',',$details['destination']));
        $address_code_list    =   Get_cityname_array(explode(',',$details['destination']),false);
        $association_list    =   Get_association_array(explode(',',$details['association_id']),'t_resources','title');
        $time   =   Get_day_time($details['update_time']);
        $label    =   Get_label(explode(',',$details['label']),$project_data['account_id']);

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
     *  获取笔记详情
     * @return string
     * @throws Exception
     */
    public function resource():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $felid  =   '*';
        $details    =   Get_details_all($key_id,$felid,'t_resources');
        $address    =   Get_cityname_array(explode(',',$details['address_code']),true,$details['account_id']);
        $address_code_list    =   Get_cityname_array(explode(',',$details['address_code']),false,$details['account_id']);
        $label    =   Get_label(explode(',',$details['label']),$details['account_id']);
        $time   =   Get_day_time($details['update_time']);
        $price_list =   Get_price_list($key_id,$details['account_id']);
        $picture_name   =   GetTableName('t_resources_img',$details['account_id']);

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
     *  获取亮点详情
     * @return string
     * @throws Exception
     */
    public function trip():string{
        $project_id   =   req('project_id');
        $key_id   =   req('key_id');
        $verification   =   [
            [$project_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        //判断修改数据是否存在
        if(Get_status_project($project_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($project_id) !=1){
            return error_no( '',code::PROCESS_ERROR);;
        }
        $project_data    =   Get_details_all($project_id,'start_time,end_time,day,account_id');
        $felid  =   '*';
        $picture_name   =   GetTableName('t_resources_wonderful',$project_data['account_id']);
        $details    =   Get_details_all($key_id,$felid,$picture_name);
        $address_code    =   Get_cityname_array(explode(',',$details['destination']),false,$project_data['account_id']);
        $address_code_list    =   Get_cityname_array(explode(',',$details['destination']),true,$project_data['account_id']);
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
     *  项目  添加poi  无需登录
     * @return string
     * @throws Exception
     */
    public function GetProjectPoi():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>$day],'id,poi_sort,schedule,day,type,poi_sort,traffic','t_project_day_schedule','poi_sort asc');
        $code   =   [];
        foreach ($list as $item){
            if($item['type'] == 7) {
                $traffic    =   Get_traffic($item['traffic']);
                $mysql_name   =   GetTableName('t_resources_activities');

                $resources =   Get_details_where(['id'=>$item['schedule']],'title',$mysql_name);

                $code[]   =   [
                    'schedule'  =>  $item['schedule'],
                    'day'       =>  $item['day'],
                    'type'      =>  $item['type'],
                    'poi_sort'  =>  $item['poi_sort'],
                    'lng'                   =>      '',
                    'lat'                   =>      '',
                    'title'     =>  $resources['title'],
                    'id'        =>  $item['id'],
                    'traffic'   =>  $traffic
                ];
            }else{
                $traffic    =   Get_traffic($item['traffic']);
                $resources =   Get_details_where(['id'=>$item['schedule']],'title,map_address','t_resources');
                $map_address    =   ['',''];
                if($resources['map_address']){
                    $map_address    =   explode(',',$resources['map_address']);

                    if(count($map_address) != 2){
                        $map_address    =   ['',''];
                    }
                }
                $code[]   =   [
                    'schedule'  =>  $item['schedule'],
                    'day'       =>  $item['day'],
                    'type'      =>  $item['type'],
                    'poi_sort'  =>  $item['poi_sort'],
                    'lng'                   =>      $map_address[0],
                    'lat'                   =>      $map_address[1],
                    'title'     =>  $resources['title'],
                    'id'        =>  $item['id'],
                    'traffic'   =>  $traffic
                ];
            }




        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }

}



$data       =   new open_view();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'Export';
    $list_code  =   array('Export','project','Project_data','Project_day','TravelRoute','GetItinerary','Cost',
        'quotation','Const_quotation','NotIncluded','PaidItems','quotation_type','supplement','DelExportPorject','ExportCopy',
        'GetDay','import','GetItinerary_day','add_project_day','GetItinerary_notes','Project_datas','Getbooking',
        'editProject','Copy','trip','note','resource','GetProjectPoi');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


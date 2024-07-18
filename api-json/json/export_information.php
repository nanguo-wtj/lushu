<?php

/**
 *  项目基本信息 接口
 *
 */
class export_information
{

    /**
     *  项目詳細信息  -  根据项目key查询项目需求
     * @return string
     * @throws Exception
     */
    public function demand():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        $details = Get_details_where(['id' => $key_id], '*','t_export_project');
        $details_demand    =   Get_details_whereno(['project_id' =>  $key_id],'*','t_export_project_demand');
        if(!$details_demand){
            $this->Add_remarks_demand($key_id);
            $details_demand    =   Get_details_whereno(['project_id' =>  $key_id],'*','t_export_project_demand');
        }
        $number =   '';
        if($details_demand['children']){$number .=   '   儿童*'.$details_demand['children'];}
        if($details_demand['adult']){$number .=   '   成人*'.$details_demand['adult'];}
        if($details_demand['old']){$number .=   '   老人*'.$details_demand['old'];}


        $code   =   [
            'basicTableList'    =>  [
                ['key'  =>  'destination','title'   =>  code::MAIN_DESTINATION,'value'   =>  $details_demand['city']],
                ['key'  =>  'destination','title'   =>  code::TRAVEL_DATE,'value'   =>  date('Y-m-d',$details['start_time'])],
                ['key'  =>  'destination','title'   =>  code::DAYS_OF_PLAY,'value'   =>  $details['day']],
                ['key'  =>  'destination','title'   =>  code::TRAVEL_TYPE,'value'   =>  Get_array_data($details_demand['type'],['1'=>'旅游度假','2'=>'研学','3'=>'商务'])],
                ['key'  =>  'destination','title'   =>  code::ATTRACTIONS_AND_ACTIVITIES,'value'   =>  $details_demand['activity']],
                ['key'  =>  'destination','title'   =>  code::NUMBER_OF_TRAVELERS,'value'   =>  $number],
                ['key'  =>  'destination','title'   =>  code::BUDGET_AMOUNT,'value'   =>  $details_demand['money']],
                ['key'  =>  'destination','title'   =>  code::DEPARTURE,'value'   =>  Get_cityname($details['departure'],false)],
                ['key'  =>  'destination','title'   =>  code::WHEN_TO_CONTACT_CUSTOMERS,'value'   =>  date('Y-m-d',$details_demand['contact_time'])],
            ],
            'customizeTableList'    =>  [
                ['key'  =>  'destination','title'   =>  code::HOTEL_REQUIREMENTS,'value'   =>  Get_array_data($details_demand['hotel'],['无要求','经济型','舒适型','豪华型'])],
                ['key'  =>  'destination','title'   =>  code::CABIN_REQUIREMENTS,'value'   =>  Get_array_data($details_demand['position'],['无要求','经济仓','商务舱','头等舱'])],
                ['key'  =>  'destination','title'   =>  code::MEAL_REQUIREMENTS,'value'   =>  Get_array_data($details_demand['dining'],['无要求','本地特色餐','中餐','西餐'])],
                ['key'  =>  'destination','title'   =>  code::VEHICLE_REQUIREMENTS,'value'   =>  Get_array_data($details_demand['car'],['无要求','舒适','经济','商务','豪华'])],
                ['key'  =>  'destination','title'   =>  code::TOUR_GUIDE_REQUIREMENTS,'value'   =>  Get_array_data($details_demand['guide'],['无要求','当地导游','华人导游'])],
                ['key'  =>  'destination','title'   =>  code::TEAM_LEADER_REQUIREMENTS,'value'   =>  Get_array_data($details_demand['leader'],['无要求','当地领队','华人领队'])],
                ['key'  =>  'destination','title'   =>  code::OTHER_REQUIREMENTS,'value'   =>  $details_demand['other']],
            ],
            'peopleList'    =>  [
                ['name' =>  $details_demand['user']]
            ],
            'project_code'  =>  [
                'type'  =>  $details_demand['type'],
                'activity'  =>  $details_demand['activity'],
                'children'  =>  $details_demand['children'],
                'adult'  =>  $details_demand['adult'],
                'old'  =>  $details_demand['old'],
                'money'  =>  $details_demand['money'],
                'contact_time'  =>  date('Y-m-d H:i:s',$details_demand['contact_time']),
                'hotel'  =>  $details_demand['hotel'],
                'position'  =>  $details_demand['position'],
                'dining'  =>  $details_demand['dining'],
                'other'  =>  $details_demand['other'],
                'car'   =>  $details_demand['car'],
                'guide'   =>  $details_demand['guide'],
                'leader'   =>  $details_demand['leader'],
                'city'   =>  $details_demand['city'],
                'user'   =>  explode(',',$details_demand['user']),

            ]
        ];
        return success($code,code::REQUEST_SUCCESSFUL);
    }


    /**
     *  项目詳細信息  -  根据项目key编辑项目需求
     * @return string
     * @throws Exception
     */
    public function EditDemand():string{
        $key_id   =   req('key_id');
        $data   =   req('data');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
            [$data,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        $details_demand    =   Get_details_where(['project_id' =>  $key_id],'*','t_export_project_demand');
        $contact_time   =   explode('T',$data['contact_time']);

        $code  =  [
            'type'      =>  $data['type'],
            'activity'  =>  $data['activity'],
            'children'  =>  $data['children'],
            'adult'     =>  $data['adult'],
            'old'       =>  $data['old'],
            'money'     =>  $data['money'],
            'contact_time'  =>  strtotime($contact_time[0]),
            'hotel'     =>  $data['hotel'],
            'position'  =>  $data['position'],
            'dining'    =>  $data['dining'],
            'car'       =>  $data['car'],
            'guide'     =>  $data['guide'],
            'leader'    =>  $data['leader'],
            'other'     =>  $data['other'],
            'city'      =>  $data['city'],
            'user'      =>  implode(',',$data['user']),
        ];
        updata_detail($code, 't_export_project_demand', $details_demand['id']);
        return success($code,code::REQUEST_SUCCESSFUL);
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
        if(Get_status_project_export($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status_export($key_id) !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }



        $details    =   Get_details($key_id,'start_time,end_time,day,account_id');
        $code   =   [];
        for ($i=0;$i<$details['day'];$i++){
            $time   =   $details['start_time']+(86400*$i);
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>($i+1)],'id,hotel,traffic,breakfast,lunch,dinner,content,note,hotel_time','t_export_project_remarks_day');
            if(!$details_day){
                continue;
            }
            $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'id,schedule,type,poi_sort,traffic','t_export_project_day_schedule','poi_sort asc');
            $schedule   =   [];
            foreach ($list as $item){
                if($item['type'] != 7){
                    $traffic    =   Get_traffic($item['traffic']);
                    $resources =   Get_details_where(['id'=>$item['schedule']],'title','t_resources');
                    $schedule[]   =   [
                        'schedule'  =>  $item['schedule'],
                        'day'       =>  $i+1,
                        'type'      =>  $item['type'],
                        'poi_sort'  =>  $item['poi_sort'],
                        'title'     =>  $resources['title'],
                        'id'        =>  $item['id'],
                        'traffic'   =>  $traffic
                    ];
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
                $data   =   Get_details($item,'id,picture,title,account_id',$mysql_name);
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
                'city'  =>  Get_project_day_city_export($key_id,$i+1)
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
        if(Get_status_project_export($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status_export($key_id) !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }
        $code   =   [];
        $details_day    =   Get_data_listall(['project_id'=>$key_id],'id,day,hotel,hotel_day,hotel_time','t_export_project_remarks_day');
        $in_day =   [0,0];
        $mysql_name   =   GetTableName('t_resources_img');
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
        if(Get_status_project_export($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status_export($key_id) !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }
        $details    =   Get_details($key_id,'start_time,end_time,day','t_export_project');

        $code   =   [];
        $mysql_project_traffic_name   =   GetTableName('t_export_project_traffic',$key_id);
        $mysql_project_cost_name   =   GetTableName('t_export_project_cost',$key_id);
        $hotel  =   [];
        $Traffic  =   [];
        $schedule  =   [];
        $Traffic_money  =   0;
        $hotel_money  =   0;
        $schedule_money  =   0;
        $firt_day   =   [0,0];
        for ($i=0;$i<$details['day'];$i++){
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>($i+1)],'id,hotel,traffic,hotel_time,hotel_day','t_export_project_remarks_day');
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
                    $hotel_cost_list   =   Get_data_listall(['type'=>2,'project_id'=>$key_id,'day'=>($i+1),'class_id'=>$details_day['hotel']],'*',$mysql_project_cost_name);
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
            $schedule_list    =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'id,poi_sort,schedule,day,type,poi_sort,traffic','t_export_project_day_schedule','poi_sort asc');
            foreach ($schedule_list as   $index=>$item){

                $schedule_cost_list   =   Get_data_list(['type'=>4,'project_id'=>$key_id,'day'=>($i+1),'class_id'=>$item['id']],'*',$mysql_project_cost_name);
                $schedule_cost   =   [];
                if($item['type'] != 7){
                    $resources =   Get_details_where(['id'=>$item['schedule']],'title','t_resources');
                    foreach ($schedule_cost_list as $a){
                        $schedule_cost[] =   [
                            'name'  =>  $a['name'],
                            'option'  =>  $a['option'],
                            'price'  =>  $a['price'],
                            'money'  =>  $a['money'],
                            'number'  =>  $a['number'],
                        ];
                        $schedule_money =   $schedule_money+$a['money'];
                    }
                    $schedule_day_cost[]   =   [
                        'day'   =>  $i+1,
                        'work'  =>  $work,
                        'time'  =>  $time_yH,
                        'title'     =>  $resources['title'],
                        'id'     =>  $item['id'],
                        'cost'  =>  $schedule_cost,
                        'cost_number'   =>  count($schedule_cost)
                    ];
                }

            }
            if($schedule_day_cost){
                $schedule[$i]    =   [
                    'day'   =>  $i+1,
                    'work'  =>  $work,
                    'time'  =>  $time_yH,
                    'list'  =>  $schedule_day_cost,
                    'list_number'   =>  count($schedule_day_cost)

                ];
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
     *  添加项目詳細信息  -  根据项目key查询费用核算
     * @throws Exception
     * @return string
     */
    public function GetDayClassCost():string{
        $key_id   =   req('key_id');
        $key   =   req('key');
        $day   =   req('day');
        $type   =   req('type');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],
            [$type,code::PARAMETER_ERROR,'required']
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        //判断修改数据是否存在
        if(Get_status_project_export($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status_export($key_id) !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }
        $mysql_project_cost_name   =   GetTableName('t_export_project_cost',$key_id);
        $cost_list   =   Get_data_list(['project_id'=>$key_id,'day'=>$day,'class_id'=>$key,'type'=>$type],'*',$mysql_project_cost_name);
        $code   =   [];
        foreach ($cost_list as $a){
            $code[] =   [
                'name'  =>  $a['name'],
                'price'  =>  $a['price'],
                'number'  =>  $a['number'],
            ];
        }
        return success( $code,code::REQUEST_SUCCESSFUL);
    }


    /**
     *  添加项目詳細信息  -  根据项目key查询费用核算
     * @throws Exception
     * @return string
     */
    public function AddDayClassCost():string{
        $key_id   =   req('key_id');
        $key   =   req('key');
        $day   =   req('day');
        $type   =   req('type');
        $data   =   req('data');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],
            [$type,code::PARAMETER_ERROR,'required'],
            [$data,code::PARAMETER_ERROR,'required']
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        //判断修改数据是否存在
        if(Get_status_project_export($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status_export($key_id) !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }
        $mysql_project_cost_name   =   GetTableName('t_export_project_cost',$key_id);
        Del_where(['project_id'=>$key_id,'day'=>$day,'class_id'=>$key,'type'=>$type],$mysql_project_cost_name);
        foreach ($data as $item){
            if($item['name'] || $item['price'] || $item['number']){
                $verification   =   [
                    [$item['price'],code::PARAMETER_ERROR,'numeric'],
                    [$item['number'],code::PARAMETER_ERROR,'numeric'],
                ];
                (new check())->set_code($verification);
                $code   =   [
                    'project_id'    =>  $key_id,
                    'day'    =>  $day,
                    'class_id'    =>  $key,
                    'type'    =>  $type,
                    'name'  =>  $item['name'],
                    'price'  =>  $item['price'],
                    'number'  =>  $item['number'],
                    'money'  =>  round($item['number']*$item['price'],2),
                ];
                add_detail($code,$mysql_project_cost_name);
            }
        }

        return success($code,code::REQUEST_SUCCESSFUL);
    }




    /**
     *  添加项目詳細信息  -  根据项目key添加费用记录
     * @param string $data
     * @param string $key_id
     * @throws Exception
     */
    private function AddProjectCost($key_id =   0,$day  =   0,$class_id =   0,$msql_name    =   '')
    {
        $sql = "INSERT INTO `".$msql_name."`( `project_id`,`class_id`,`day`) VALUES ( ".$key_id.",".$class_id.",".$day.");";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }
    }

    /**
     *  添加项目詳細信息  -  根据项目key添加需求记录
     * @param string $data
     * @param string $key_id
     * @throws Exception
     */
    private function Add_remarks_demand($key_id =   0)
    {
        $sql = "INSERT INTO `t_export_project_demand`( `project_id`) VALUES ( ".$key_id.");";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }
    }




}



$data       =   new export_information();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'index';
    $list_code  =   array('index','demand','EditDemand','TravelRoute','Getbooking','Cost','GetDayClassCost','AddDayClassCost');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


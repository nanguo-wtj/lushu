<?php



/**
 *  项目操作 接口
 *
 */

class project
{
    public $mysql;
    /**
     *   默认项目名称访问   返回格式案例  2023/10/30-12:00 **创建
     * @return string
     */
    public function default_name(){
        global $g_account;
        $code   =   date('Y/m/d-H:i',time()).'  '.$g_account['username'].code::CREATE;


        return success(['name'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *   第一步：添加项目名称  项目协作人员
     * @return string
     * @throws Exception
     */
    public function name(): string
    {
        global $g_account;
        $project_name   =   req('name');
        $collaborate   =   req('collaborate');


        if(empty($project_name)){
            $project_name   =   date('Y/m/d-H:i',time()).'  '.$g_account['username'].code::CREATE;
        }
        if(empty($collaborate['controller'])){$collaborate['controller'][]  =   $g_account['account_id'];}
        if(empty($collaborate['demand'])){$collaborate['demand'][]  =   $g_account['account_id'];}
        if(empty($collaborate['make'])){$collaborate['make'][]  =   $g_account['account_id'];}
        if(empty($collaborate['calculate'])){$collaborate['calculate'][]  =   $g_account['account_id'];}
        if(empty($collaborate['quotation'])){$collaborate['quotation'][]  =   $g_account['account_id'];}



        //添加项目
        $project_code   =   GetString();
        $key    =   $this->Add_project_name($project_name,$project_code);
        //添加权限
        $this->Add_permission($collaborate,$key);
        $this->Add_remarks($collaborate,$key);
        $this->Add_remarks_notes($key);


        if($key){
            SetProjectLog($key,'{user}创建了该项目。{user}担任项目管理者、{user}担任项目需求编辑者、{user}担任行程制作编辑者、{user}担任费用核算编辑者、{user}担任行程报价编辑者');
            return success(['key' => Set_data_rsa($key),'name'=>$project_name,'time'  =>   date('Y-m-d H:i:s',time())],code::ADDED_SUCCESSFULLY);
        }else{
            throw new Exception(code::SYSTEM_ERROR);
        }
    }
    /**
     *   第二步： 添加项目详细信息
     * @return string
     * @throws Exception
     */
    public function detail(): string
    {

        $key   =   req('key');
        $title   =   req('title');
        $start_time   =   req('start_time');
        $end_time   =   req('end_time');
        $project_code   =   req('project_code');
        $departure  =   req('departure');
        $return_to  =   req('return_to');

        $verification   =   [
            [$key,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
            [$title,code::PROJECT_TITLE,'required'],
            [$start_time,code::TIME_ON,'required'],
            [$end_time,code::END_TIME,'required'],
            [$project_code,code::PROJECT_NO,'required'],
            [$departure,code::STARTING_CITY,'required'],
            [$return_to,code::RETURN_TO_CITY,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key);

        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){

            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($key_id) !=0){
            return error_no( '',code::PROCESS_ERROR);;
        }

        $is_status  =   1;
        SetProjectLog($key,'{user}在{project}中创建了行程规划');
        if($this->add_detail($title,strtotime($start_time),strtotime($end_time),$project_code,$departure,$return_to,$key_id,$is_status) == false){
            throw new Exception(code::SYSTEM_ERROR);
        }else{
            update_project_member($key_id);
            return success(['key' => Set_data_rsa($key_id),'time'  =>   date('Y-m-d H:i:s',time())],code::ADDED_SUCCESSFULLY);
        }
    }

    /**
     *  获取项目日期的相关信息  周几 日期 城市
     * @return string
     * @throws Exception
     */
    public function GetDay(): string
    {

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


        $details    =   Get_details($key_id,'start_time,end_time,day','t_project');
        $code   =   [];
        $code['start_time'] =   date('Y-m-d',$details['start_time']);
        $code['end_time']   =   date('Y-m-d',$details['end_time']);
        $code['time']       =   date('Y-m-d',time());
        $code['day']        =   [];
        for ($i=0;$i<$details['day'];$i++){
            $is_status  =   '';
            $time   =   $details['start_time']+(86400*$i);
            if($day == ($i+1)){
                $is_status =   1;
            }
            $code['day'][]  =   [
                'day'   =>  $i+1,
                'work'  =>  Get_work($time),
                'time'  =>  date('m-d',$time),
                'status'  =>  $is_status,
                'city'  =>  Get_project_day_city($key_id,$i+1)
            ];
        }

        return success( $code,code::REQUEST_SUCCESSFUL);
    }
    /**
     *  获取项目基础 亮点 行程介绍 定制师笔记
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


        $project_data   =   Get_details($key_id,'title,account_id,id,is_status');
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
            $data   =   Get_details($item,'id,url,title,notes',$mysql_name);
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
            $data   =   Get_details($item,'id,picture,title,account_id',$mysql_name);
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
     *  获取项目备注基础信息  行程介绍 定制师笔记
     * @return string
     * @throws Exception
     */
    public function GetItinerary_notes(): string
    {

        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);


        $project_data   =   Get_details($key_id,'title,account_id,id,is_status');
        //判断修改数据是否存在
        if(isset($project_data['id']) && !$project_data['id']){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if($project_data['is_status'] !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }


        $details    =   Get_details_whereno(['project_id' =>  $key_id],'Highlights,content,note','t_project_remarks_notes');
        if(!$details){
            $this->Add_remarks_notes($key_id);
            $details    =   [
                'Highlights'    =>  '',
                'content'    =>  '',
                'note'    =>  '',
            ];
        }

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
            $data   =   Get_details($item,'id,url,title,notes',$mysql_name);
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
            $data   =   Get_details($item,'id,picture,title,account_id',$mysql_name);
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
     *  获取项目对应天数基础信息  景点 行程介绍 定制师笔记
     * @return string
     * @throws Exception
     */
    public function GetItinerary_day(): string
    {

        $key_id     =   req('key_id');
        $day        =   req('day');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
            [$day,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);


        $project_data   =   Get_details($key_id,'account_id,id,is_status,title');

        //判断修改数据是否存在
        if(isset($project_data['id']) && !$project_data['id']){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if($project_data['is_status'] !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }

        $code   =   [];
        $details    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$day],'schedule,content,note,hotel,hotel_time,breakfast,lunch,dinner','t_project_remarks_day');
        $code['title']        =   $project_data['title'];
        if($details){
            $code['content']        =   htmlspecialchars_decode($details['content']);
            $code['schedule']     =   [];
            $code['note']           =   [];
            $schedule =   explode(',',$details['schedule']);
            $note       =   explode(',',$details['note']);
            $code['schedule_id']     =   $schedule;
            $code['note_id']           =   $note;
            if($details['hotel']) {
                $code['hotel'][] = [
                    'id' => $details['hotel'],
                    'name' => Get_details_where(['id' => $details['hotel']], 'title,en_title', 't_resources_hotel'),
                    'time' => $details['hotel_time'],
                ];
            }
            $status =false;
            if($details['breakfast'] || $details['lunch'] ||$details['dinner']){
                $status =   true;
            }
            $code['eatingMsg'] = [
                'breakfast' => $details['breakfast'],
                'lunch' => $details['lunch'],
                'dinner' => $details['dinner'],
                'status' => $status,
            ];
            $mysql_name   =   GetTableName('t_resources_note',$project_data['account_id']);
            foreach ($note as $item){
                $data   =   Get_details($item,'id,picture,title,account_id',$mysql_name);
                if($data){
                    $code['note'][] =   [
                        'id'        =>  $data['id'],
                        'url'       =>  $data['picture'],
                        'title'     =>  $data['title'],
                        'user'      =>  Get_userdata_id('account',$data['account_id'])['account']
                    ];
                }

            }
        }else{
            $this->Add_remarks_day($key_id,$day);
            $code['content']        =   '';
            $code['schedule']     =   [];
            $code['note']           =   [];
            $code['schedule_id']     =   [];
            $code['note_id']           =   [];
            $code['hotel']           =   [];
            $code['eatingMsg']           =   [];
        }



        return success( $code,code::REQUEST_SUCCESSFUL);
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
        $project_data   =   Get_details($key_id,'*');
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


        $details    =   Get_details($key_id,'start_time,end_time,day');
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
                    $resources =   Get_details_whereno(['id'=>$item['schedule']],'title,map_address','t_resources');
                    if($resources){
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
     *  获取项目日志信息
     * @return string
     * @throws Exception
     */
    public function Project_log():string{
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
        $details    =   Get_details($key_id,'title');

        $mysql_name =   GetTableName('t_project_log',$key_id);

        $list    =   Get_data_listall(['project_id'=>$key_id],'id,msg_log,notes,time,account_id',$mysql_name);

        $code   =   [];
        foreach ($list as $item){
            $user_name  =   Get_userdata_id('username',$item['account_id'])['username'];
            $data   =   str_replace('{user}',$user_name,$item['msg_log']);
            $data   =   str_replace('{project}',$details['title'],$data);
            $code[] =   [
                'id'    =>  $item['id'],
                'user'  =>  $user_name,
                'data'  =>  $data,
                'msg'   =>  $item['notes'],
                'time'  =>  date('Y-m-d H:i',$item['time'])
            ];
        }
        return success($code,code::REQUEST_SUCCESSFUL);;
    }


    /**
     *  获取项目基本信息 - 对应接口使用（有些接口不需要返回一些值）
     * @return string
     * @throws Exception
     */
    public function Project_datas(): string
    {

        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        $project_data   =   Get_details($key_id,'title,start_time,day,departure,return_to,introduce,number,url');
        $code   =   [
            'title'             =>      $project_data['title'],
            'startTime'         =>      date('Y-m-d',$project_data['start_time']),
            'dayNum'            =>       $project_data['day'],
            'startCity'         =>       $project_data['departure'],
            'startCity_value'   =>       Get_cityname($project_data['departure'],false),
            'endCity'           =>       $project_data['return_to'],
            'endCity_value'     =>       Get_cityname($project_data['return_to'],false),
            'content'             =>       $project_data['introduce'],
            'IDCard'            =>       $project_data['number'],
            'url'               =>       $project_data['url']
        ];
        return success( $code,code::REQUEST_SUCCESSFUL);
    }

    /**
     *  设置项目基本信息  （后期修改接口   头像等）
     * @return string
     * @throws Exception
     */
    public function editProject():string{
        $key_id   =   req('key_id');
        $startTime   =   req('startTime');
        $dayNum   =   req('dayNum');
        $startCity   =   req('startCity');
        $endCity   =   req('endCity');
        $content   =   req('content');
        $IDCard   =   req('IDCard');
        $title   =   req('title');
        $url   =   req('url');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
            [$title,code::PROJECT_TITLE,'required'],
            [$startTime,code::TIME_ON,'required'],
            [$IDCard,code::PROJECT_NO,'required'],
            [$startCity,code::STARTING_CITY,'required'],
            [$endCity,code::RETURN_TO_CITY,'required'],
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
        $details = Get_details_where(['id' => $key_id], '*');

        $code   =   [
            'title'     =>  $title,
            'departure' =>  $startCity,
            'return_to' =>  $endCity,
            'number'    =>  $IDCard,
        ];
        $startTime  =   strtotime($startTime);
        //时间变化
        if($startTime != $details['start_time']){
            $code['start_time'] =   $startTime;
            if($details['day']  !=   $dayNum){
                $code['day'] =   $dayNum;
            }
            $code['end_time'] =   $startTime+(86400*$dayNum);
        }else{
            if($details['day']  !=   $dayNum){
                $code['day'] =   $dayNum;
                $code['end_time'] =   $startTime+(86400*$dayNum);
            }
        }

        if($details['day']  !=   $dayNum){
            if($details['day'] > $dayNum){
                Del_where(['project_id'=>$key_id,'day'=>['>',$dayNum]],'t_project_remarks_day');
                Del_where(['project_id'=>$key_id,'day'=>['>',$dayNum]],'t_project_day_schedule');
            }
        }

        if($content){
            $code['introduce']  =   $content;
        }
        if($url){
            $code['url']  =   $url;
        }


        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);

    }


    /*     操作方法-----开始线---------     */

    /**
     *  添加项目  -  根据项目名称 新建项目
     * @param string $project_name
     * @param string $project_code
     * @return int
     */
    private function Add_project_name( $project_name  =   '', $project_code    =   ''):int
    {
        global $g_siteid,$g_account;
        $sql = "INSERT INTO `t_project`(`project_name`,`project_code`, `site_id`, `account_id`,`update_time`,`add_time` )".
            "VALUES".
            " ('".$project_name."','".$project_code."', '".$g_siteid."', '".$g_account['account_id']."','".time()."','".time()."');";
        $add_id =   $this->mysql->query($sql);
        return $add_id;
    }



    /**
     *  添加项目詳細信息  -  根据项目key 编辑项目
     * @param string $title
     * @param string $start_time
     * @param string $end_time
     * @param string $number
     * @param string $departure
     * @param string $return_to
     * @param string $key_id
     * @return bool
     */
    private function add_detail($title   =   '',$start_time  =   '',$end_time    =   '',$number  =   '',$departure   =   '',$return_to   =   '',$key_id  =   '',$is_status  =   ''):bool
    {
        global $g_siteid,$g_account;

        $day    =   ($end_time-$start_time)/86400+1;

        $sql = "UPDATE `t_project` SET `title`='".$title."', `start_time`='".$start_time."',`end_time` = '".$end_time."',`number` = '".$number."' ,`departure` = '".$departure."',`return_to` = '".$return_to."',`is_status` = '".$is_status."',`day`   =   '".$day."',`update_time` = '".time()."' WHERE `id`='$key_id' AND `account_id`='" . $g_account['account_id'] . "'";
        if(!$this->mysql->query($sql)){
            return  false;
        }
        return  true;
    }

    /**
     *  添加项目詳細信息  -  根据项目key 编辑项目
     * @param string $data
     * @param string $key_id
     * @throws Exception
     */
    private function Add_permission($data   =   array(),$key_id =   0)
    {
        global $g_account;
        $controller =   $data['controller'];
        $demand =   $data['demand'];
        $make =   $data['make'];
        $calculate =   $data['calculate'];
        $quotation =   $data['quotation'];
        $account_ids    =   array_merge($controller,$demand,$make,$calculate,$quotation);
        $account_ids    =   array_unique($account_ids);
        foreach ($account_ids as $item){
            $code   =   [];
            $code['controller'] =  Get_in_array($item,$controller,1,0);
            $code['demand'] =  Get_in_array($item,$demand,1,0);
            $code['make'] =  Get_in_array($item,$make,1,0);
            $code['calculate'] =  Get_in_array($item,$calculate,1,0);
            $code['quotation'] =  Get_in_array($item,$quotation,1,0);
            $number =   $code['controller']+$code['demand']+$code['make']+$code['calculate']+$code['quotation'];
            $sql = "INSERT INTO `t_project_member`".
                "(`account_id`, `project_id`, `controller`, `demand`, `make`, `calculate`, `quotation`, `number`, `time`,`update_time`)".
                " VALUES ('".$item."','".$key_id."','".$code['controller']."','".$code['demand']."','".$code['make']."','".$code['calculate']."','".$code['quotation']."','".$number."','".time()."','".time()."');";
            $add_id =   $this->mysql->query($sql);
            if(empty($add_id)){
                throw new Exception(code::SYSTEM_ERROR);
            }
        }

    }


    /**
     *  添加项目詳細信息  -  根据项目key 编辑项目
     * @param string $data
     * @param string $key_id
     * @throws Exception
     */
    private function Add_remarks($data   =   array(),$key_id =   0)
    {

        $sql = "INSERT INTO `t_project_remarks`( `project_id`, `Highlights`, `content`, `note`) VALUES ( ".$key_id.", '', '', '');";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }

    }

    /**
     *  添加项目詳細信息  -  根据项目key 编辑项目备注
     * @param string $data
     * @param string $key_id
     * @throws Exception
     */
    private function Add_remarks_notes($key_id =   0)
    {

        $sql = "INSERT INTO `t_project_remarks_notes`( `project_id`, `Highlights`, `content`, `note`) VALUES ( ".$key_id.", '', '', '');";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }

    }


    /**
     *  添加项目詳細信息  -  根据项目key 编辑项目
     * @param string $data
     * @param string $key_id
     * @throws Exception
     */
    private function Add_remarks_day($key_id =   0,$day =   0)
    {

        $sql = "INSERT INTO `t_project_remarks_day`( `project_id`, `schedule`, `content`, `note`,`day`) VALUES ( ".$key_id.", '', '', '','".$day."');";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }

    }

    /**
     *  设置项目制作中
     * @throws Exception
     * @return string
     */
    public function Restore():string{
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
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
        $details = Get_details_where(['id' => $key_id], '*');

        $code   =   [
            'is_sale'     =>  0,
        ];
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中设置项目制作中');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);

    }
    /**
     *  设置项目已完成
     * @throws Exception
     * @return string
     */
    public function Complete():string{
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
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
        $details = Get_details_where(['id' => $key_id], '*');

        $code   =   [
            'is_sale'     =>  1,
        ];
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中设置项目已完成');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);

    }

    /**
     *  设置项目已关闭
     * @throws Exception
     * @return string
     */
    public function Close():string{
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
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
        $details = Get_details_where(['id' => $key_id], '*');

        $code   =   [
            'is_sale'     =>  2,
        ];
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中设置项目已关闭');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);

    }
    /**
     *  设置项目已删除
     * @throws Exception
     * @return string
     */
    public function Delete():string{
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }

        $details = Get_details_where(['id' => $key_id], '*');

        $code   =   [
            'is_delete'     =>  1,
        ];
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中设置项目已删除');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::DELETE_SUCCESSFUL);

    }
    /**
     *  设置项目恢复正常项目内容
     * @throws Exception
     * @return string
     */
    public function Restore_s():string{
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
      
        $details = Get_details_where(['id' => $key_id], '*');

        $code   =   [
            'is_delete'     =>  0,
        ];
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中恢复项目内容');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::RECOVERY_WAS_SUCCESSFUL);

    }

    /**
     *  设置项目为星标项目
     * @throws Exception
     * @return string
     */
    public function Collect():string{
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }

        $details = Get_details_where(['id' => $key_id], '*');
        if($details['is_collect'] == 1){
            $is_collect =   0;
            $msg=   code::CANCEL_COLLECTION_SUCCESSFUL;
        }else{
            $is_collect =   1;
            $msg=   code::SUCCESSFULLY_SET_FAVORITES;
        }
        $code   =   [
            'is_collect'     =>  $is_collect,
        ];
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中设置项目为星标项目');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], $msg);

    }

    /**
     *  彻底删除项目数据
     * @throws Exception
     * @return string
     */
    public function Completely(){
        $key_id   =   req('key_id');

        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);
        //判断修改数据是否存在
        if(Get_status_project($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }

        $details = Get_details_where(['id' => $key_id], '*');
        $mysql_project_export   =   't_project';
        $mysql_export_project_member   =   't_project_member';
        $mysql_project_export_remarks   =   't_project_remarks';
        $mysql_project_export_remarks_day   =   't_project_remarks_day';
        $mysql_project_project_demandy   =   't_project_demand';
        $mysql_project_export_schedule   =   't_project_day_schedule';
        $mysql_project_export_remarks_notes   =   't_project_remarks_notes';
        $mysql_Traffic_name   =   GetTableName('t_project_traffic',$key_id);
        $mysql_project_cost   =   GetTableName('t_project_cost',$key_id);
        $mysql_quotation_subterm   =   GetTableName('t_quotation_subterm',$key_id);
        $mysql_export_quotation   =   't_quotation';
        $mysql_export_quotation_subterm   =   GetTableName('t_quotation_subterm',$key_id);
        Del_where(['id'=>$details['id']],$mysql_project_export);
        $mysql_name_log =   GetTableName('t_project_log',$key_id);

        Del_where(['project_id'=>$details['id']],$mysql_export_project_member);
        Del_where(['project_id'=>$details['id']],$mysql_project_export_remarks);
        Del_where(['project_id'=>$details['id']],$mysql_project_export_remarks_day);
        Del_where(['project_id'=>$details['id']],$mysql_project_project_demandy);
        Del_where(['project_id'=>$details['id']],$mysql_project_export_schedule);
        Del_where(['project_id'=>$details['id']],$mysql_project_export_remarks_notes);
        Del_where(['project_id'=>$details['id']],$mysql_Traffic_name);
        Del_where(['project_id'=>$details['id']],$mysql_project_cost);
        Del_where(['project_id'=>$details['id']],$mysql_quotation_subterm);
        Del_where(['project_id'=>$details['id']],$mysql_export_quotation);
        Del_where(['project_id'=>$details['id']],$mysql_export_quotation_subterm);
        Del_where(['project_id'=>$details['id']],$mysql_name_log);
        return success([ 'time' => date('Y-m-d H:i:s', time())], code::DELETE_SUCCESSFUL);

    }


}

$data       =   new project();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'name';
    $list_code  =   array('name','default_name','detail','GetDay','GetItinerary',
        'GetItinerary_day','Project_data','Project_day','Project_log','Delete','Close','Project_datas','editProject',
        'GetItinerary_notes','Complete','Restore','Collect','Restore_s','Completely');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


<?php

/**
 *  项目基本信息 接口
 *
 */
class project_export
{

    /**
     *  项目詳細信息  -  根据项目key导出项目数据
     * 推荐后续使用消息队列来处理  接口直接返回成功会比较卡
     * @throws Exception
     * @return string
     */
    public function Export():string{
        $key_id   =   req('key_id');
        $title   =   req('title');
        $itinerary   =   req('itinerary');
        $notes   =   req('notes');
        $quotation   =   req('quotation');
        $tage   =   req('tage');
        $day   =   req('day');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
            [$title,code::PARAMETER_ERROR,'required'],
            [$day,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_project_export   =   't_export_project';
        $mysql_export_project_member   =   't_export_project_member';
        $mysql_project_export_remarks   =   't_export_project_remarks';
        $mysql_project_export_remarks_day   =   't_export_project_remarks_day';
        $mysql_project_export_schedule   =   't_export_project_day_schedule';
        $mysql_project_export_remarks_notes   =   't_export_project_remarks_notes';
        $mysql_Traffic_name   =   GetTableName('t_project_traffic',$key_id);
        $mysql_project_cost   =   GetTableName('t_project_cost',$key_id);
        $mysql_quotation_subterm   =   GetTableName('t_quotation_subterm',$key_id);

        $details    =   Get_details($key_id,'*');

        $member_details    =   Get_details_where(['project_id'=>$key_id],'*','t_project_member');

        unset($details['id'],$details['socre_status']);
        $details['day'] =   count($day);
        $details['project_name'] =   $title;
        $details['title'] =   $title;
        $details['start_time'] =   0;
        $details['update_time'] =   time();
        $details['end_time'] =   0;
        $details['number'] =   0;
        $export_type    =   [];
        if($itinerary == true){$export_type[]    =  1;}
        if($day == true){$export_type[]    =  2;}
        if($notes == true){$export_type[]    =  3;}
        if($quotation == true){$export_type[]    =  4;}
        //添加项目基础数据
        $details['export_type']    =   implode(',',$export_type);
        $new_project_id =   add_detail($details,$mysql_project_export);
        $mysql_export_Traffic_name   =   GetTableName('t_export_project_traffic',$new_project_id);
        $mysql_export_project_cost   =   GetTableName('t_export_project_cost',$new_project_id);
        $mysql_export_quotation_subterm   =   GetTableName('t_export_quotation_subterm',$new_project_id);
        unset($member_details['id']);
        $member_details['project_id']   =   $new_project_id;
         add_detail($member_details,$mysql_export_project_member);

        /*  添加项目行程总览数据   */
        if($itinerary == true){
            $project_remarks_details    =   Get_details_where(['project_id' =>  $key_id],'*','t_project_remarks');
            unset($project_remarks_details['id']);
            $project_remarks_details['project_id']  =   $new_project_id;
            add_detail($project_remarks_details,$mysql_project_export_remarks);
        }
        /*  添加项目行程总览数据结束   */
        /*  添加项目天数数据数据   */
        $class_id   =   [];//新添加报价的key值，需要跟下面报价联动
        $scheduleClass_id   =   [];//新添加报价的key值，需要跟下面报价联动
        foreach ($day as $index=>$item){
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>$item],'*','t_project_remarks_day');
            $schedule_list    =   Get_data_listall(['project_id'=>$key_id,'day'=>$item],'*','t_project_day_schedule','poi_sort asc');
            $Traffic_list   =   Get_data_list(['project_id'=>$key_id,'day'=>$item],'*',$mysql_Traffic_name,'traffic_sort asc',);
            unset($details_day['id']);
            $details_day['project_id']  =   $new_project_id;
            $details_day['day']  =   ($index+1);
            //添加项目天数基础数据
            if(!$details_day){
                $this->Add_remarks_day($new_project_id,($index+1));
            }else{
                add_detail($details_day,$mysql_project_export_remarks_day);
            }
            //添加项目天数日程安排数据
            $schedule_id    =   0;
            foreach ($schedule_list as $b=>$a){
                $schedule_id    =  $a['id'];
                unset($a['id']);
                $a['project_id']  =   $new_project_id;
                $a['day']  =   ($index+1);
                $new_schedule_id  = add_detail($a,$mysql_project_export_schedule);
                $scheduleClass_id[$schedule_id]  =   $new_schedule_id;

            }
            //添加项目天数日程安排数据
            $Traffic_id =   0;
            foreach ($Traffic_list as $d=>$c){
                $Traffic_id =   $c['id'];
                unset($c['id']);
                $c['project_id']  =   $new_project_id;
                $c['day']  =   ($index+1);
                $new_Traffic_id =   add_detail($c,$mysql_export_Traffic_name);
                $class_id[$Traffic_id]  =   $new_Traffic_id;
            }
        }
        /*  添加项目天数数据数据结束   */
        /*  添加项目行程备注数据   */
        if($notes == true){
            $notes_details    =   Get_details_whereno(['project_id' =>  $key_id],'*','t_project_remarks_notes');
            unset($notes_details['id']);
            $notes_details['project_id']  =   $new_project_id;
            add_detail($notes_details,$mysql_project_export_remarks_notes);
        }
        /*  添加项目行程备注数据结束   */
        /*  添加项目报价   */

        if($quotation == true){
            foreach ($day as $index=>$item) {
                $Traffic_cost_list = Get_data_list(['project_id' => $key_id, 'day' => $item], '*', $mysql_project_cost);
                foreach ($Traffic_cost_list as $b=>$a){
                    unset($a['id']);
                    $a['project_id']  =   $new_project_id;
                    if($a['type'] == 1){
                        $a['class_id']  =   $class_id[$a['class_id']];
                    }elseif ($a['type'] == 4){
                        $a['class_id']  =   $scheduleClass_id[$a['class_id']];
                    }
                    $a['day']  =   ($index+1);
                    add_detail($a,$mysql_export_project_cost);
                }
            }
            $subterm_list   =   Get_data_listall(['project_id'=>$key_id],'*',$mysql_quotation_subterm);
            foreach ($subterm_list as $item)
            {
                unset($item['id']);
                $item['project_id']  =   $new_project_id;
                add_detail($item,$mysql_export_quotation_subterm);
            }
        }
        /*  添加项目报价结束   */

        return success([],code::EXPORT_SUCCESSFUL);
    }
    /**
     *  项目詳細信息  -  根据项目key复制项目数据
     * 推荐后续使用消息队列来处理  接口直接返回成功会比较卡
     * @throws Exception
     */
    public function Copy():string{
        $key_id   =   req('key_id');
        $title   =   req('title');
        $demand   =   req('demand');
        $make   =   req('make');
        $cost   =   req('cost');
        $quotation   =   req('quotation');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
            [$title,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_project_export   =   't_project';
        $mysql_export_project_member   =   't_project_member';
        $mysql_project_export_remarks   =   't_project_remarks';
        $mysql_project_export_remarks_day   =   't_project_remarks_day';
        $mysql_project_export_schedule   =   't_project_day_schedule';
        $mysql_project_export_remarks_notes   =   't_project_remarks_notes';
        $mysql_Traffic_name   =   GetTableName('t_project_traffic',$key_id);
        $mysql_project_cost   =   GetTableName('t_project_cost',$key_id);
        $mysql_quotation_subterm   =   GetTableName('t_quotation_subterm',$key_id);

        $details    =   Get_details($key_id,'*');
        $day    =   [];
        for ($i=1;$i<=$details['day'];$i++){
            $day[]   =   $i;

        }

        $member_details    =   Get_details_where(['project_id'=>$key_id],'*','t_project_member');

        unset($details['id']);
        $details['day'] =   count($day);
        $details['project_name'] =   $title;
        $details['title'] =   $title;
        $details['update_time'] =   time();

        //添加项目基础数据
        $new_project_id =   add_detail($details,$mysql_project_export);
        $mysql_export_Traffic_name   =   GetTableName('t_project_traffic',$new_project_id);
        $mysql_export_project_cost   =   GetTableName('t_project_cost',$new_project_id);
        $mysql_export_quotation_subterm   =   GetTableName('t_quotation_subterm',$new_project_id);
        unset($member_details['id']);
        $member_details['project_id']   =   $new_project_id;
        $member_details['update_time']   =   time();
        add_detail($member_details,$mysql_export_project_member);

        if($demand == 'true'){
            $details_demand    =   Get_details_whereno(['project_id' =>  $key_id],'*','t_project_demand');
            unset($details_demand['id']);
            $details_demand['project_id'] = $new_project_id;
            add_detail($details_demand, 't_project_demand');

        }

        $project_remarks_details = Get_details_where(['project_id' => $key_id], '*', 't_project_remarks');
        unset($project_remarks_details['id']);
        $project_remarks_details['project_id'] = $new_project_id;
        add_detail($project_remarks_details, $mysql_project_export_remarks);
        /*  复制项目制作数据   */
        if($make == 'true') {


            $class_id = [];//新添加报价的key值，需要跟下面报价联动
            $scheduleClass_id = [];//新添加报价的key值，需要跟下面报价联动
            foreach ($day as $index => $item) {
                $details_day = Get_details_whereno(['project_id' => $key_id, 'day' => $item], '*', 't_project_remarks_day');
                $schedule_list = Get_data_listall(['project_id' => $key_id, 'day' => $item], '*', 't_project_day_schedule', 'poi_sort asc');
                $Traffic_list = Get_data_list(['project_id' => $key_id, 'day' => $item], '*', $mysql_Traffic_name, 'traffic_sort asc',);
                unset($details_day['id']);
                $details_day['project_id'] = $new_project_id;
                $details_day['day'] = ($index + 1);
                //添加项目天数基础数据
                if (!$details_day) {
                    $this->Add_remarks_day($new_project_id, ($index + 1));
                } else {
                    add_detail($details_day, $mysql_project_export_remarks_day);
                }
                //添加项目天数日程安排数据
                $schedule_id = 0;
                foreach ($schedule_list as $b => $a) {
                    $schedule_id = $a['id'];
                    unset($a['id']);
                    $a['project_id'] = $new_project_id;
                    $a['day'] = ($index + 1);
                    $new_schedule_id = add_detail($a, $mysql_project_export_schedule);
                    $scheduleClass_id[$schedule_id] = $new_schedule_id;

                }
                //添加项目天数日程安排数据
                $Traffic_id = 0;
                foreach ($Traffic_list as $d => $c) {
                    $Traffic_id = $c['id'];
                    unset($c['id']);
                    $c['project_id'] = $new_project_id;
                    $c['day'] = ($index + 1);
                    $new_Traffic_id = add_detail($c, $mysql_export_Traffic_name);
                    $class_id[$Traffic_id] = $new_Traffic_id;
                }
            }

            $notes_details    =   Get_details_whereno(['project_id' =>  $key_id],'*','t_project_remarks_notes');
            unset($notes_details['id']);
            $notes_details['project_id']  =   $new_project_id;
            add_detail($notes_details,$mysql_project_export_remarks_notes);
        }
        /*  复制项目制作数据结束   */

        /*  添加项目报价   */

        if($cost == 'true'){
            foreach ($day as $index=>$item) {
                $Traffic_cost_list = Get_data_list(['project_id' => $key_id, 'day' => $item], '*', $mysql_project_cost);
                foreach ($Traffic_cost_list as $b=>$a){
                    unset($a['id']);
                    $a['project_id']  =   $new_project_id;
                    if($a['type'] == 1){
                        $a['class_id']  =   $class_id[$a['class_id']];
                    }elseif ($a['type'] == 4){
                        $a['class_id']  =   $scheduleClass_id[$a['class_id']];
                    }
                    $a['day']  =   ($index+1);
                    add_detail($a,$mysql_export_project_cost);
                }
            }
        }
        if($quotation == 'true'){

            $subterm_list   =   Get_data_listall(['project_id'=>$key_id],'*',$mysql_quotation_subterm);
            foreach ($subterm_list as $item)
            {
                unset($item['id']);
                $item['project_id']  =   $new_project_id;
                add_detail($item,$mysql_export_quotation_subterm);
            }
        }
        /*  添加项目报价结束   */

        return success([],code::REPLICATING_SUCCESS);
    }
    /**
     *  行程路线库列表
     * @return string
     * @throws Exception
     */
    public function project(): string
    {
        global $g_account;
        $is_sale   =   req('asterisk');
        $sort   =   req('sort');
        $deso = 'update_time';
        if($sort == 'travel'){
            $deso   =   'is_collect';
        }
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;

        $day    =   req('day');
        $time    =   req('time_key');
        $association    =   req('association');
        $collect    =   req('collect');
        $start_time    =   req('start_time');

        $where  =   [
            'project_name'     =>  ['or',[req('title'),'like','title']],
            'departure'   =>  req('address'),
            'is_delete'   =>  0,
        ];

        if($day){
            $number1    =   $day['number1'] ?? 0;
            $number2    =   $day['number2'];
            $where['day']   =  ['BETWEEN',array($number1,$number2)];

        }



        if($association){

            $porject_list   =   Get_data_listall(['account_id'  =>  $g_account['account_id']],'id','t_export_project');
            $in_porject_list    =   [];
            foreach ($porject_list as $item){
                $in_porject_list[]  =   $item['id'];
            }
            $poi_where  =   [
                'project_id'  =>  ['in',implode(',',$in_porject_list)],
                'schedule'  =>  $association,
            ];
            $list_poi   =   Get_data_listall($poi_where,'project_id','t_export_project_day_schedule');
            $in_list_poi    =   [];
            foreach ($list_poi as $item){
                $in_list_poi[]  =   $item['project_id'];
            }
            if(!$in_list_poi){
                $in_list_poi[]  =   -1;
            }
            $where['id']    =   ['in',implode(',',$in_list_poi)];
        }




        $list  =    Get_export_Project_list($where,'t_export_project',$deso.' desc',$pages);
        return success(['data'=>$list,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);


    }
    /**
     *  行程路线库列表分页数据
     * @return string
     * @throws Exception
     */
    public function project_number(): string
    {
        global $g_account;
        $is_sale   =   req('asterisk');
        $sort   =   req('sort');
        $deso = 'update_time';
        if($sort == 'travel'){
            $deso   =   'is_collect';
        }
        $page = req('page');
        if(!$page){
            $page   =   1;
        }
        $pages  =   ($page-1)*NUMBER_PAGES;

        $day    =   req('day');
        $time    =   req('time_key');
        $association    =   req('association');
        $collect    =   req('collect');
        $start_time    =   req('start_time');

        $where  =   [
            'project_name'     =>  ['or',[req('title'),'like','title']],
            'departure'   =>  req('address'),
            'is_delete'   =>  0,
        ];

        if($day){
            $number1    =   $day['number1'] ?? 0;
            $number2    =   $day['number2'];
            $where['day']   =  ['BETWEEN',array($number1,$number2)];

        }



        if($association){

            $porject_list   =   Get_data_listall(['account_id'  =>  $g_account['account_id']],'id','t_export_project');
            $in_porject_list    =   [];
            foreach ($porject_list as $item){
                $in_porject_list[]  =   $item['id'];
            }
            $poi_where  =   [
                'project_id'  =>  ['in',implode(',',$in_porject_list)],
                'schedule'  =>  $association,
            ];
            $list_poi   =   Get_data_listall($poi_where,'project_id','t_export_project_day_schedule');
            $in_list_poi    =   [];
            foreach ($list_poi as $item){
                $in_list_poi[]  =   $item['project_id'];
            }
            if(!$in_list_poi){
                $in_list_poi[]  =   -1;
            }
            $where['id']    =   ['in',implode(',',$in_list_poi)];
        }

        $list  =    Get_Count($where,'t_export_project_member',$page);
        return success(['data'=>$list,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);


    }
    /**
     *  获取导出项目基本信息
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
        $project_data   =   Get_details($key_id,'*','t_export_project');
        $code   =   [];
        $export_type    =   explode(',',$project_data['export_type']);
        $export_type_status =   false;
        if(in_array(4,$export_type)){
            $export_type_status =   true;
        }
        $code['title']  =   $project_data['title'];
        $code['user']   =   Get_userdata_id('username',$project_data['account_id'])['username'];
        $code['update_time']   =   date('Y-m-d',$project_data['update_time']);
        $code['time']   =   date('Y-m-d',$project_data['start_time']);
        $code['start_time']   =   date('Y-m-d',$project_data['start_time']);
        $code['end_time']   =   date('Y-m-d',$project_data['end_time']);
        $code['departure']   =  Get_cityname($project_data['departure'],false);
        $code['url']   =  $project_data['url'];
        $code['day']    =  $project_data['day'];
        $code['export_type']    =  $export_type_status;
        $code['city']   =  GetProjectCityExport($key_id);


        return success( $code,code::REQUEST_SUCCESSFUL);
    }

    /**
     *  行程路线库全部天数的 景点 酒店  交通 相关城市/获取导出项目全部天数的 景点 酒店  交通 相关城市
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
        if(Get_status_project_export($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status_export($key_id) !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }


        $details    =   Get_details($key_id,'start_time,end_time,day','t_export_project');
        $code   =   [];
        $code['start_time'] =   date('Y-m-d',$details['start_time']);
        $code['end_time']   =   date('Y-m-d',$details['end_time']);
        $code['time']       =   date('Y-m-d',time());
        $code['day']        =   [];
        $code['traffic']        =   [];
        $mysql_name   =   GetTableName('t_export_project_traffic',$key_id);

        for ($i=0;$i<$details['day'];$i++){
            $is_status  =   '';
            $time   =   $details['start_time']+(86400*$i);
            if($day == ($i+1)){
                $is_status =   1;
            }
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>($i+1)],'id,hotel,traffic','t_export_project_remarks_day');
            if(!$details_day){
                continue;
            }
            $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'id,schedule,type,poi_sort,traffic','t_export_project_day_schedule','poi_sort asc');
            $schedule   =   [];
            foreach ($list as $item){
                $traffic    =   Get_traffic($item['traffic']);
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
                'city'  =>  Get_project_day_city_export($key_id,$i+1)
            ];
        }


        return success( $code,code::REQUEST_SUCCESSFUL);;
    }


    /**
     *  项目詳細信息  -根据行程路线库/导出项目key获取项目日期内全部信息
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


        $details    =   Get_details($key_id,'start_time,end_time,day,account_id','t_export_project');
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
     *  获取行程路线库/导出项目基础信息 亮点 行程介绍 定制师笔记
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


        $project_data   =   Get_details($key_id,'title,account_id,id,is_status','t_export_project');
        //判断修改数据是否存在
        if(isset($project_data['id']) && !$project_data['id']){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if($project_data['is_status'] !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }


        $details    =   Get_details_where(['project_id' =>  $key_id],'Highlights,content,note','t_export_project_remarks');
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
     *  添加项目詳細信息  -  根据项目key查询行程路线库/导出项目费用核算
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
            $schedule_list    =   Get_data_listall(['project_id'=>$key_id,'day'=>($i+1)],'id,poi_sort,schedule,day,type,poi_sort,traffic','t_export_project_day_schedule','poi_sort asc');
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
     *  项目  获取行程路线库/导出项目行程报价
     * @return string
     * @throws Exception
     */
    public function quotation():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
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
     *  项目   获取行程路线库/导出项目行程报价列表
     * @return string
     * @throws Exception
     */
    public function Const_quotation():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
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
     *  项目  根据行程路线库/导出项目key查询项目报价费用不包括
     * @return string
     * @throws Exception
     */
    public function NotIncluded():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
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
     *  项目  根据行程路线库/导出项目key查询项目报价可选付费项目
     * @return string
     * @throws Exception
     */
    public function PaidItems():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
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
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
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
     *  项目  根据行程路线库/导出项目key查询项目报价补充说明
     * @return string
     * @throws Exception
     */
    public function supplement():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_quotation_subterm',$key_id);
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
     *  项目  删除内容
     * @return string
     */
//    public function DelExportPorject(){
//        $key_id     =   req('key_id');
//        $verification   =   [
//            [$key_id,code::PARAMETER_ERROR,'required'],
//        ];
//        (new check())->set_code($verification);
//        $mysql_project_export   =   't_export_project';
//        $mysql_export_project_member   =   't_export_project_member';
//        $mysql_project_export_remarks   =   't_export_project_remarks';
//        $mysql_project_export_remarks_day   =   't_export_project_remarks_day';
//        $mysql_project_export_schedule   =   't_export_project_day_schedule';
//        $mysql_project_export_remarks_notes   =   't_export_project_remarks_notes';
//        $mysql_export_Traffic_name   =   GetTableName('t_export_project_traffic',$key_id);
//        $mysql_export_project_cost   =   GetTableName('t_export_project_cost',$key_id);
//        $mysql_export_quotation_subterm   =   GetTableName('t_export_quotation_subterm',$key_id);
//        Del_where(['id'=>$key_id],$mysql_project_export);
//        Del_where(['project_id'=>$key_id],$mysql_export_project_member);
//        Del_where(['project_id'=>$key_id],$mysql_project_export_remarks);
//        Del_where(['project_id'=>$key_id],$mysql_project_export_remarks_day);
//        Del_where(['project_id'=>$key_id],$mysql_project_export_schedule);
//        Del_where(['project_id'=>$key_id],$mysql_project_export_remarks_notes);
//        Del_where(['project_id'=>$key_id],$mysql_export_Traffic_name);
//        Del_where(['project_id'=>$key_id],$mysql_export_project_cost);
//        Del_where(['project_id'=>$key_id],$mysql_export_quotation_subterm);
//        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);
//    }


    /**
     *  项目  删除内容-伪删除
     * @throws Exception
     * @return string
     */
    public function DelExportPorject():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'update_time'           =>      time(),
            'is_delete'           =>      1,
        ];
        $mysql_project_export   =   't_export_project';

        updata_detail($code,$mysql_project_export,$key_id);
        updata_detail_codeall($code,'t_export_project_member',['project_id'=>$key_id]);

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }



    /**
     *  项目詳細信息  -  根据项目key复制项目数据
     * 推荐后续使用消息队列来处理  接口直接返回成功会比较卡
     * @throws Exception
     * @return string
     */
    public function ExportCopy():string{
        $key_id   =   req('key_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
        ];
        (new check())->set_code($verification);
        $mysql_project_export   =   't_export_project';
        $mysql_export_project_member   =   't_export_project_member';
        $mysql_project_export_remarks   =   't_export_project_remarks';
        $mysql_project_export_remarks_day   =   't_export_project_remarks_day';
        $mysql_project_export_schedule   =   't_export_project_day_schedule';
        $mysql_project_export_remarks_notes   =   't_export_project_remarks_notes';
        $mysql_Traffic_name   =   GetTableName('t_export_project_traffic',$key_id);
        $mysql_project_cost   =   GetTableName('t_export_project_cost',$key_id);
        $mysql_quotation_subterm   =   GetTableName('t_export_quotation_subterm',$key_id);

        $details    =   Get_details($key_id,'*','t_export_project');

        $member_details    =   Get_details_where(['project_id'=>$key_id],'*','t_export_project_member');

        unset($details['id']);
        $details['start_time'] =   0;
        $details['update_time'] =   time();
        $details['end_time'] =   0;
        $details['number'] =   0;
        $day    =   [];
        for ($i=1;$i<=$details['day'];$i++){
            $day[]  =   $i;
        }
        $new_project_id =   add_detail($details,$mysql_project_export);
        $mysql_export_Traffic_name   =   GetTableName('t_export_project_traffic',$new_project_id);
        $mysql_export_project_cost   =   GetTableName('t_export_project_cost',$new_project_id);
        $mysql_export_quotation_subterm   =   GetTableName('t_export_quotation_subterm',$new_project_id);
        unset($member_details['id']);
        $member_details['project_id']   =   $new_project_id;
        add_detail($member_details,$mysql_export_project_member);

        /*  添加项目行程总览数据   */
        $project_remarks_details    =   Get_details_where(['project_id' =>  $key_id],'*','t_export_project_remarks');
        unset($project_remarks_details['id']);
        $project_remarks_details['project_id']  =   $new_project_id;
        add_detail($project_remarks_details,$mysql_project_export_remarks);
        /*  添加项目行程总览数据结束   */
        /*  添加项目天数数据数据   */
        $class_id   =   [];//新添加报价的key值，需要跟下面报价联动
        $scheduleClass_id   =   [];//新添加报价的key值，需要跟下面报价联动
        foreach ($day as $index=>$item){
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>$item],'*','t_export_project_remarks_day');
            $schedule_list    =   Get_data_listall(['project_id'=>$key_id,'day'=>$item],'*','t_export_project_day_schedule','poi_sort asc');
            $Traffic_list   =   Get_data_list(['project_id'=>$key_id,'day'=>$item],'*',$mysql_Traffic_name,'traffic_sort asc',);
            unset($details_day['id']);
            $details_day['project_id']  =   $new_project_id;
            //添加项目天数基础数据
            add_detail($details_day,$mysql_project_export_remarks_day);
            //添加项目天数日程安排数据
            $schedule_id    =   0;
            foreach ($schedule_list as $b=>$a){
                $schedule_id    =  $a['id'];
                unset($a['id']);
                $a['project_id']  =   $new_project_id;
                $a['day']  =   ($index+1);
                $new_schedule_id  = add_detail($a,$mysql_project_export_schedule);
                $scheduleClass_id[$schedule_id]  =   $new_schedule_id;

            }
            //添加项目天数日程安排数据
            $Traffic_id =   0;
            foreach ($Traffic_list as $d=>$c){
                $Traffic_id =   $c['id'];
                unset($c['id']);
                $c['project_id']  =   $new_project_id;
                $c['day']  =   ($index+1);
                $new_Traffic_id =   add_detail($c,$mysql_export_Traffic_name);
                $class_id[$Traffic_id]  =   $new_Traffic_id;
            }
        }
        /*  添加项目天数数据数据结束   */
        /*  添加项目行程备注数据   */
        $notes_details    =   Get_details_whereno(['project_id' =>  $key_id],'*','t_export_project_remarks_notes');
        unset($notes_details['id']);
        $notes_details['project_id']  =   $new_project_id;
        add_detail($notes_details,$mysql_project_export_remarks_notes);
        /*  添加项目行程备注数据结束   */
        /*  添加项目报价   */

        foreach ($day as $index=>$item) {
            $Traffic_cost_list = Get_data_list(['project_id' => $key_id, 'day' => $item], '*', $mysql_project_cost);
            foreach ($Traffic_cost_list as $b=>$a){
                unset($a['id']);
                $a['project_id']  =   $new_project_id;
                if($a['type'] == 1){
                    $a['class_id']  =   $class_id[$a['class_id']];
                }elseif ($a['type'] == 4){
                    $a['class_id']  =   $scheduleClass_id[$a['class_id']];
                }
                $a['day']  =   ($index+1);
                add_detail($a,$mysql_export_project_cost);
            }
        }
        $subterm_list   =   Get_data_listall(['project_id'=>$key_id],'*',$mysql_quotation_subterm);
        foreach ($subterm_list as $item)
        {
            unset($item['id']);
            $item['project_id']  =   $new_project_id;
            add_detail($item,$mysql_export_quotation_subterm);
        }
        /*  添加项目报价结束   */

        return success([],code::REPLICATING_SUCCESS);
    }



    /**
     *  获取行程路线库/导出项目日期的相关信息  周几 日期 城市
     * @return string
     * @throws Exception
     */
    public function GetDay(): string
    {
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
        $code['day']        =   [];
        for ($i=0;$i<$details['day'];$i++){
            $time   =   $details['start_time']+(86400*$i);

            $code['day'][]  =   [
                'day'   =>  $i+1,
                'status'  =>  false,
                'city'  =>  Get_project_day_city_export($key_id,$i+1)
            ];
        }

        return success( $code,code::REQUEST_SUCCESSFUL);
    }

    /**
     *  获取行程路线库/导出项目对应天数基础信息  景点 行程介绍 定制师笔记
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


        $project_data   =   Get_details($key_id,'account_id,id,is_status,title','t_export_project');

        //判断修改数据是否存在
        if(isset($project_data['id']) && !$project_data['id']){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if($project_data['is_status'] !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }

        $code   =   [];
        $details    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$day],'schedule,content,note,hotel,hotel_time,breakfast,lunch,dinner','t_export_project_remarks_day');
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
     *  获取行程路线库/导出项目备注基础信息  行程介绍 定制师笔记
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


        $project_data   =   Get_details($key_id,'title,account_id,id,is_status','t_export_project');
        //判断修改数据是否存在
        if(isset($project_data['id']) && !$project_data['id']){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if($project_data['is_status'] !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }


        $details    =   Get_details_whereno(['project_id' =>  $key_id],'Highlights,content,note','t_export_project_remarks_notes');
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
     *  將行程路线库/导出项目导入现有的项目中  会覆盖原项目数据
     * @return string
     * @throws Exception
     */
    public function import(): string
    {

        $key_id   =   req('key_id');
        $key   =   req('key');
        $itinerary   =   req('itinerary');
        $notes   =   req('notes');
        $quotation   =   req('quotation');
        $day   =   req('day');
        if(!$day){
            $day = [];
        }
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
            [$key,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required|numeric'],
        ];
        (new check())->set_code($verification);
        $mysql_project_export_remarks   =   't_export_project_remarks';
        $mysql_project_export_remarks_day   =   't_export_project_remarks_day';
        $mysql_project_export_schedule   =   't_export_project_day_schedule';
        $mysql_project_export_remarks_notes   =   't_export_project_remarks_notes';
        $mysql_export_Traffic_name   =   GetTableName('t_export_project_traffic',$key_id);
        $mysql_export_project_cost   =   GetTableName('t_export_project_cost',$key_id);
        $mysql_export_quotation_subterm   =   GetTableName('t_export_quotation_subterm',$key_id);
        $mysql_Traffic_name   =   GetTableName('t_project_traffic',$key);
        $mysql_project_cost   =   GetTableName('t_project_cost',$key);
        $mysql_quotation_subterm   =   GetTableName('t_quotation_subterm',$key);

        /*  添加项目行程总览数据   */
        if($itinerary == true){
            $project_remarks_details    =   Get_details_where(['project_id' =>  $key_id],'*',$mysql_project_export_remarks);
            unset($project_remarks_details['id']);
            $project_remarks_details['project_id']  =   $key;
            Del_where(['project_id'=>$key],'t_project_remarks');
            add_detail($project_remarks_details,'t_project_remarks');
        }
        /*  添加项目行程总览数据结束   */
        /*  添加项目天数数据数据   */
        $class_id   =   [];//新添加报价的key值，需要跟下面报价联动
        $scheduleClass_id   =   [];//新添加报价的key值，需要跟下面报价联动
        foreach ($day as $index=>$item){
            $details_day    =   Get_details_whereno(['project_id'=>$key_id,'day'=>$item],'*',$mysql_project_export_remarks_day);
            $schedule_list    =   Get_data_listall(['project_id'=>$key_id,'day'=>$item],'*',$mysql_project_export_schedule,'poi_sort asc');
            $Traffic_list   =   Get_data_list(['project_id'=>$key_id,'day'=>$item],'*',$mysql_export_Traffic_name,'traffic_sort asc',);
            unset($details_day['id']);
            Del_where(['project_id'=>$key,'day'=>$item],'t_project_remarks_day');
            Del_where(['project_id'=>$key,'day'=>$item],'t_project_day_schedule');
            Del_where(['project_id'=>$key,'day'=>$item],$mysql_Traffic_name);

            $details_day['project_id']  =   $key;
            $details_day['day']  =   $item;
            //添加项目天数基础数据
            add_detail($details_day,'t_project_remarks_day');
            //添加项目天数日程安排数据
            $schedule_id    =   0;
            foreach ($schedule_list as $b=>$a){
                $schedule_id    =  $a['id'];
                unset($a['id']);
                $a['project_id']  =   $key;
                $a['day']  =   $item;
                $new_schedule_id  = add_detail($a,'t_project_day_schedule');
                $scheduleClass_id[$schedule_id]  =   $new_schedule_id;

            }
            //添加项目天数日程安排数据
            $Traffic_id =   0;
            foreach ($Traffic_list as $d=>$c){
                $Traffic_id =   $c['id'];
                unset($c['id']);
                $c['project_id']  =   $key;
                $c['day']  =   $item;
                $new_Traffic_id =   add_detail($c,$mysql_Traffic_name);
                $class_id[$Traffic_id]  =   $new_Traffic_id;
            }
        }
        /*  添加项目天数数据数据结束   */
        /*  添加项目行程备注数据   */
        if($notes == true){
            $notes_details    =   Get_details_whereno(['project_id' =>  $key_id],'*',$mysql_project_export_remarks_notes);
            Del_where(['project_id'=>$key],'t_project_remarks_notes');

            unset($notes_details['id']);
            $notes_details['project_id']  =   $key;
            add_detail($notes_details,'t_project_remarks_notes');
        }
        /*  添加项目行程备注数据结束   */
        /*  添加项目报价   */

        if($quotation == true){
            foreach ($day as $index=>$item) {
                $Traffic_cost_list = Get_data_list(['project_id' => $key_id, 'day' => $item], '*',$mysql_export_project_cost );
                Del_where(['project_id'=>$key, 'day' => $item],$mysql_project_cost);

                foreach ($Traffic_cost_list as $b=>$a){

                    unset($a['id']);
                    $a['project_id']  =   $key;
                    if($a['type'] == 1){
                        $a['class_id']  =   $class_id[$a['class_id']];
                    }elseif ($a['type'] == 4){
                        $a['class_id']  =   $scheduleClass_id[$a['class_id']];
                    }
                    $a['day']  =   $item;
                    add_detail($a,$mysql_project_cost);
                }
            }
            $subterm_list   =   Get_data_listall(['project_id'=>$key_id],'*',$mysql_export_quotation_subterm);
            Del_where(['project_id'=>$key],$mysql_quotation_subterm);

            foreach ($subterm_list as $item)
            {
                unset($item['id']);
                $item['project_id']  =   $key;
                add_detail($item,$mysql_quotation_subterm);
            }
        }
        /*  添加项目报价结束   */

        return success( [],code::IMPORT_WAS_SUCCESSFUL);
    }



    /**
     *  添加项目詳細信息  -  根据项目key 编辑项目
     * @param string $data
     * @param string $key_id
     * @throws Exception
     */
    private function Add_remarks_day($key_id =   0,$day =   0)
    {

        $sql = "INSERT INTO `t_export_project_remarks_day`( `project_id`, `schedule`, `content`, `note`,`day`) VALUES ( ".$key_id.", '', '', '','".$day."');";
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

        $sql = "INSERT INTO `t_export_project_remarks_notes`( `project_id`, `Highlights`, `content`, `note`) VALUES ( ".$key_id.", '', '', '');";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }

    }


    /**
     *  获取行程路线库/导出项目基本信息 - 对应接口使用（有些接口不需要返回一些值）
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
        $project_data   =   Get_details($key_id,'title,start_time,day,departure,return_to,introduce,number,url','t_export_project');
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
     *  设置行程路线库/导出项目基本信息  （后期修改接口   头像等）
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
        if(Get_status_project_export($key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status_export($key_id) !=1){
            throw new Exception(code::PROCESS_ERROR.'02');
        }
        $details = Get_details_where(['id' => $key_id], '*','t_export_project');

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


        updata_detail($code, 't_export_project', $details['id']);
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);

    }


    /**
     *  项目  添加行程路线库/导出项目项目天数
     * @return string
     * @throws Exception
     */
    public function add_project_day():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],

        ];
        (new check())->set_code($verification);
        $details = Get_details_where(['id' => $key_id], 'id,day,start_time','t_export_project');
        $code   =   [];
        $code['day'] =   $details['day']+1;
        $code['end_time'] =   $details['start_time']+(86400*$details['day']+1);
        updata_detail($code, 't_export_project', $details['id']);
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  去除行程路线库/导出项目项目天数
     * @return string
     * @throws Exception
     */
    public function del_project_day():string{
        $key_id     =   req('key_id');
        $day     =   req('day');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$day,code::PARAMETER_ERROR,'required'],

        ];
        (new check())->set_code($verification);
        $details = Get_details_where(['id' => $key_id], 'id,day,start_time','t_export_project');
        $code   =   [];
        $code['day'] =   $details['day']-1;
        $code['end_time'] =   $details['start_time']+(86400*$details['day']-1);
        Del_where(['project_id'=>$key_id,'day'=>$day],'t_export_project_day_schedule');
        Del_where(['project_id'=>$key_id,'day'=>$day],'t_export_project_remarks_day');
        updata_detail_all(" `day` =  day-1  ",'t_export_project_day_schedule',['project_id'=>$key_id,'day'=>['>',$day]]);
        updata_detail_all(" `day` =  day-1  ",'t_export_project_remarks_day',['project_id'=>$key_id,'day'=>['>',$day]]);
        updata_detail($code, 't_export_project', $details['id']);
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

}



$data       =   new project_export();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'Export';
    $list_code  =   array('Export','project','Project_data','Project_day','TravelRoute','GetItinerary','Cost',
        'quotation','Const_quotation','NotIncluded','PaidItems','quotation_type','supplement','DelExportPorject','ExportCopy',
        'GetDay','import','GetItinerary_day','add_project_day','GetItinerary_notes','Project_datas',
        'editProject','Copy','project_number');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


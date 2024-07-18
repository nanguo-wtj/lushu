<?php

class export
{
    /**
     *  添加项目詳細信息  -  添加亮点行程总览
     * @throws Exception
     * @return string
     */
    public function add_trip():string
    {
        $key_id = req('key_id');
        $trip_id = req('trip_id');
        $verification = [
            [$key_id, code::PARAMETER_ERROR, 'required'],
            [$trip_id, code::PARAMETER_ERROR, 'required'],
        ];
        (new check())->set_code($verification);
        $details = Get_details_where(['project_id' => $key_id], 'id,Highlights', 't_export_project_remarks');
        $mysql_resources_name = 't_export_project_remarks';
        $Highlights = explode(',', $details['Highlights']);
        $add_status = false;
        foreach ($Highlights as $index => $item) {
            if (!$item) {
                unset($Highlights[$index]);
            }
            if ($item != $trip_id) {
                $add_status = true;
            }
        }
        if ($add_status == false) {
            return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::SUCCESSFULLY_SET);
        }
        $Highlights[] = $trip_id;
        $code = [
            'Highlights' => implode(',', $Highlights),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::ADDED_SUCCESSFULLY);
    }

    /**
     *  去除项目詳細信息  -  去除亮点行程总览
     * @return string
     * @throws Exception
     */
    public function del_trip():string
    {
        $key_id = req('key_id');
        $trip_id = req('trip_id');
        $verification = [
            [$key_id, code::PARAMETER_ERROR, 'required'],
            [$trip_id, code::PARAMETER_ERROR, 'required'],
        ];
        (new check())->set_code($verification);
        $details = Get_details_where(['project_id' => $key_id], 'id,Highlights', 't_export_project_remarks');
        $mysql_resources_name = 't_export_project_remarks';
        $Highlights = explode(',', $details['Highlights']);
        $add_status = false;
        foreach ($Highlights as $index => $item) {
            if ($item == $trip_id) {
                $add_status = true;
                unset($Highlights[$index]);
            }
        }
        if ($add_status == false) {
            return error(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::PARAMETER_ERROR);
        }
        $code = [
            'Highlights' => implode(',', $Highlights),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }

    /**
     *  添加项目詳細信息  -  添加笔记总览
     * @return string
     * @throws Exception
     */
    public function add_note():string
    {
        $key_id = req('key_id');
        $note_id = req('note_id');
        $day = req('day');
        $verification = [
            [$key_id, code::PARAMETER_ERROR, 'required'],
            [$note_id, code::PARAMETER_ERROR, 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_export_project_remarks';
        $where = ['project_id' => $key_id];
        if ($day) {
            $mysql_resources_name = 't_export_project_remarks_day';
            $where['day'] = $day;
        }
        $details = Get_details_where($where, 'id,note', $mysql_resources_name);
        $Note = explode(',', $details['note']);
        $add_status = false;
        foreach ($Note as $index => $item) {
            if (!$item) {
                unset($Note[$index]);
            }
            if ($item != $note_id) {
                $add_status = true;
            }
        }
        if ($add_status == false) {
            return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::SUCCESSFULLY_SET);
        }
        $Note[] = $note_id;
        $code = [
            'note' => implode(',', $Note),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::ADDED_SUCCESSFULLY);
    }
    /**
     *  添加项目詳細信息  -  添加笔记总览
     * @return string
     * @throws Exception
     */
    public function add_note_notes():string
    {
        $key_id = req('key_id');
        $note_id = req('note_id');
        $day = req('day');
        $verification = [
            [$key_id, code::PARAMETER_ERROR, 'required'],
            [$note_id, code::PARAMETER_ERROR, 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_export_project_remarks_notes';
        $where = ['project_id' => $key_id];

        $details = Get_details_where($where, 'id,note', $mysql_resources_name);
        $Note = explode(',', $details['note']);
        $add_status = false;
        foreach ($Note as $index => $item) {
            if (!$item) {
                unset($Note[$index]);
            }
            if ($item != $note_id) {
                $add_status = true;
            }
        }
        if ($add_status == false) {
            return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::SUCCESSFULLY_SET);
        }
        $Note[] = $note_id;
        $code = [
            'note' => implode(',', $Note),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::ADDED_SUCCESSFULLY);
    }

    /**
     *  去除项目詳細信息  -  去除亮点行程总览
     * @return string
     * @throws Exception
     */
    public function del_note():string
    {
        $key_id = req('key_id');
        $note_id = req('note_id');
        $verification = [
            [$key_id, code::PARAMETER_ERROR, 'required'],
            [$note_id, code::PARAMETER_ERROR, 'required'],
        ];
        (new check())->set_code($verification);
        $details = Get_details_where(['project_id' => $key_id], 'id,note', 't_export_project_remarks');
        $mysql_resources_name = 't_export_project_remarks';
        $Note = explode(',', $details['note']);
        $add_status = false;
        foreach ($Note as $index => $item) {
            if ($item == $note_id) {
                $add_status = true;
                unset($Note[$index]);
            }
        }
        if ($add_status == false) {
            return error(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::PARAMETER_ERROR);
        }
        $code = [
            'note' => implode(',', $Note),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }

    /**
     *  去除项目詳細信息  -  去除亮点行程总览
     * @return string
     * @throws Exception
     */
    public function del_note_notes():string
    {
        $key_id = req('key_id');
        $note_id = req('note_id');
        $verification = [
            [$key_id, code::PARAMETER_ERROR, 'required'],
            [$note_id, code::PARAMETER_ERROR, 'required'],
        ];
        (new check())->set_code($verification);
        $details = Get_details_where(['project_id' => $key_id], 'id,note', 't_export_project_remarks_notes');
        $mysql_resources_name = 't_export_project_remarks_notes';
        $Note = explode(',', $details['note']);
        $add_status = false;
        foreach ($Note as $index => $item) {
            if ($item == $note_id) {
                $add_status = true;
                unset($Note[$index]);
            }
        }
        if ($add_status == false) {
            return error(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::PARAMETER_ERROR);
        }
        $code = [
            'note' => implode(',', $Note),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }

    /**
     *  添加项目詳細信息  -  添加城市信息
     * @throws Exception
     * @return string
     */
    public function add_day_city():string
    {
        $key_id = req('key_id');
        $city_id = req('city_id');
        $day = req('day');
        $number = req('number');

        $verification = [
            [$key_id, code::PARAMETER_ERROR . '1', 'required'],
            [$city_id, code::PARAMETER_ERROR . '2', 'required'],
            [$day, code::PARAMETER_ERROR . '3', 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_export_project_remarks_day';
        $project = Get_details_whereno(['id' => $key_id], 'id,day', 't_export_project');
        $end_day    =   0;
        $code   =   [];
        for ($i = $day; $i <= ($day + $number); $i++) {
            if($i<=$project['day']){
                $details = Get_details_whereno(['project_id' => $key_id, 'day' => $i], 'id,city', 't_export_project_remarks_day');
                if (!$details) {
                    $details['id']  =   $this->addProjectDay($key_id,$i);
                    $city_code   =   [];
                    $city   =   [];
                }else{
                    $city = explode(',', $details['city']);
                    $city_code   =   array_filter($city);
                }
                $final_city   =   0;
                $status =   true;
                if($i == ($day+$number)){
                    if($city){
                        $final_city =   $city[0];
                    }
                    array_unshift($city_code,$city_id);
                    $StartingCity   =   $city_id;
                    $ArrivingCity   =   $final_city;
                    $status =   false;
                }else{
                    $final_city =   end($city);
                    $city_code[] = $city_id;
                    $StartingCity   =   $final_city;
                    $ArrivingCity   =   $city_id;
                }

                $this->AddTraffic($StartingCity,$ArrivingCity,$key_id,$i,$status);
                $code = [
                    'city' => implode(',', $city_code),//
                ];
                updata_detail($code, $mysql_resources_name, $details['id']);
            }

        }

        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }



    /**
     *  添加项目詳細信息  -  添加城市信息
     * @return string
     * @throws Exception
     */
    public function del_day_city():string
    {
        $key_id = req('key_id');
        $city_id = req('city_id');
        $day = req('day');
        $key = req('key');

        $verification = [
            [$key_id, code::PARAMETER_ERROR . '1', 'required'],
            [$city_id, code::PARAMETER_ERROR . '2', 'required'],
            [$day, code::PARAMETER_ERROR . '3', 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_export_project_remarks_day';
        $details = Get_details_where(['project_id' => $key_id, 'day' => $day], 'id,city', 't_export_project_remarks_day');
        $city = explode(',', $details['city']);
        $city   =   array_filter($city);

        $mysql_name   =   GetTableName('t_export_project_traffic',$key_id);

        foreach ($city as $index=>$item){
            if($key == $index&& $item == $city_id){
                $details_traffic = Get_details_desc(['project_id' => $key_id, 'day' => $day,'traffic_sort'  =>  $key], 'id,traffic_sort', $mysql_name,'traffic_sort desc');
                if($key > 0){
                    Del_where(['project_id'=>$key_id,'day' => $day,'starting_id'=>$city[($index-1)],'destination_id'=>$item],$mysql_name);
                }
                if(isset($city[($index+1)])){
                    Del_where(['project_id'=>$key_id,'day' => $day,'starting_id'=>$item,'destination_id'=>$city[($index+1)]],$mysql_name);
                }
                if($index != 0 ){
                    $this->AddTraffic($city[($index-1)],$city[($index+1)],$key_id,$day,true,$details_traffic['traffic_sort']);
                }

                unset($city[$index]);

            }
        }
        $code = [
            'city' => implode(',', $city),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }


    /**
     *  添加项目詳細信息  -  添加交通信息
     * @param int $StartingCity
     * @param int $ArrivingCity
     * @param int $key_id
     * @param int $day
     * @param bool $status
     * @throws Exception
     */
    public  function AddTraffic($StartingCity   =   0,$ArrivingCity =   0,$key_id   =   0,$day  =   0,$status   =   true,$traffic_sort  =   0){
        if(!$StartingCity|| !$ArrivingCity){
            return false;
        }
        $mysql_name   =   GetTableName('t_export_project_traffic',$key_id);
        $details = Get_details_desc(['project_id' => $key_id, 'day' => $day], 'id,traffic_sort', $mysql_name,'traffic_sort desc');
        if(!$details){
            $details['traffic_sort']    =   0;
        }
        if($traffic_sort){
            $details['traffic_sort']    =   $traffic_sort;
        }
        if($status  ==  false){
            updata_detail_all(" `traffic_sort` =  traffic_sort+1  ",$mysql_name,['project_id'=>$key_id,'day' => $day]);
            $traffic_sort   =   1;
        }else{
            $traffic_sort   =   $details['traffic_sort']+1;
        }

        $code   =   [
            'project_id'    =>  $key_id,
            'day'    =>  $day,
            'starting_id'    =>  $StartingCity,
            'destination_id'    =>  $ArrivingCity,
            'traffic_sort'    =>  $traffic_sort,
        ];
        add_detail($code,$mysql_name);
    }




    /**
     *  添加项目詳細信息  -  添加项目介绍内容

     * @throws Exception
     */
    public function add_project_content()
    {
        $key_id = req('key_id');
        $content = req('content');
        $day = req('day');
        $verification = [
            [$key_id, code::PARAMETER_ERROR . '1', 'required'],
            [$content, code::PARAMETER_ERROR . '2', 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_export_project_remarks';
        if($day){
            $mysql_resources_name = 't_export_project_remarks_day';
        }
        $details = Get_details_where(['project_id' => $key_id,'day'=>$day], 'id', $mysql_resources_name);
        $code = [
            'content' => $content,//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }

    /**
     *  项目  获取项目日期对应的景点信息
     * @throws Exception
     * @return string
     */
    public function GetProjectPoi():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>$day],'id,poi_sort,schedule,day,type,poi_sort,traffic','t_export_project_day_schedule','poi_sort asc');
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

    /**
     *  添加项目詳細信息  -  添加项目备注介绍
     * @throws Exception
     * @return string
     */
    public function add_project_content_notes()
    {
        $key_id = req('key_id');
        $content = req('content');
        $day = req('day');
        $verification = [
            [$key_id, code::PARAMETER_ERROR . '1', 'required'],
            [$content, code::PARAMETER_ERROR . '2', 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_export_project_remarks_notes';

        $details = Get_details_where(['project_id' => $key_id,'day'=>$day], 'id', $mysql_resources_name);
        $code = [
            'content' => $content,//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }




    private function addProjectDay($key_id  =   0,$day  =   0){
        $sql = "INSERT INTO `t_export_project_remarks_day`( `project_id`, `schedule`, `content`, `note`,`day`) VALUES ( ".$key_id.", '', '', '','".$day."');";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }
        return $add_id;
    }

    /**
     *  项目  添加项目日程安排中的poi信息
     * @return string
     * @throws Exception
     */
    public function AddProjectPoi():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $poi        =   req('poi');
        $type        =   req('type');
        $name        =   req('title');
        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$poi,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);

        if(!in_array($type,array(1,2,3,4,6))){
            throw new Exception(code::PARAMETER_ERROR);
        }

        $poi_sort   =   1;
        $details    =   Get_details_desc(['project_id'=>$key_id,'day'=>$day],'poi_sort','t_export_project_day_schedule');
        if($details){
            $poi_sort   =   $details['poi_sort']+1;
        }
        $code   =   [
            'project_id'    =>  $key_id,
            'schedule'  =>  $poi,
            'day'  =>  $day,
            'type'  =>  $type,
            'poi_sort'  =>  $poi_sort
        ];

        $id =   add_detail($code,'t_export_project_day_schedule');
        unset($code['project_id']);
        $code['title']  =   $name;
        $code['id']     =   $id;
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  去除项目日程安排中的poi信息
     * @return string
     * @throws Exception
     */
    public function DelProjectPoi():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $poi        =   req('poi');

        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$poi,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);

        $details    =   Get_details_whereno(['id'=>$poi,'project_id'=>$key_id],'poi_sort','t_export_project_day_schedule');
        Del_where(['id'=>$poi],'t_project_day_schedule');
        $updata_status    =   Get_details_whereno(['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['>',$details['poi_sort']]],'id','t_export_project_day_schedule');
        if($updata_status){
            updata_detail_all(" `poi_sort` =  poi_sort-1  ",'t_export_project_day_schedule',['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['>',$details['poi_sort']]]);
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  去除poi
     * @return string
     * @throws Exception
     */
    public function GetProjectTraffic():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $key        =   req('key');

        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);

        $details    =   Get_details_whereno(['id'=>$key,'project_id'=>$key_id],'id,schedule,poi_sort,traffic','t_export_project_day_schedule');
        $details_next    =   Get_details_whereno(['project_id'=>$key_id,'day'=>$day,'poi_sort'  =>  ($details['poi_sort']+1)],'schedule','t_export_project_day_schedule');
        $code   =   [
            'starting'  =>  Get_details_value($details['schedule'],'title','t_resources'),
            'end'  =>  Get_details_value($details_next['schedule'],'title','t_resources'),
            'traffic'   =>  $details['traffic'],
            'id'   =>  $details['id'],
        ];
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'code'=>$code],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  项目中日程安排顺序更改
     * @return string
     * @throws Exception
     */
    public function editProjectPoisort():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $key        =   req('key');
        $poi_sort        =   req('poi_sort');
        $newpoi_sort        =   req('newpoi_sort');

        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],
            [$poi_sort,code::PARAMETER_ERROR,'required'],
            [$newpoi_sort,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        if($poi_sort > $newpoi_sort){
            $edit_poi_sort  =   $newpoi_sort;
            $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['>',($newpoi_sort-1)]],'id,poi_sort','t_export_project_day_schedule','poi_sort asc');
            foreach ($list as $item){
                $newpoi_sort++;
                updata_detail_custom(['poi_sort'=>$newpoi_sort],'t_export_project_day_schedule',[['id',$item['id']]]);
            }
            updata_detail_custom(['poi_sort'=>$edit_poi_sort],'t_export_project_day_schedule',[['id',$key]]);

        }else{
            updata_detail_all(" `poi_sort` =  poi_sort-1  ",'t_export_project_day_schedule',['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['>',$poi_sort]]);
            updata_detail_custom(['poi_sort'=>$newpoi_sort],'t_export_project_day_schedule',[['id',$key]]);

        }

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  poi乘车顺序
     * @return string
     * @throws Exception
     */
    public function editProjectTraffic():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $key        =   req('key');
        $traffic        =   req('traffic');


        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],

        ];
        (new check())->set_code($verification);
        updata_detail_custom(['traffic'=>$traffic],'t_export_project_day_schedule',[['id',$key]]);
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目日期出行方案
     * @return string
     * @throws Exception
     */
    public function projectDayTraffic():string{
        global $g_account;

        $day   =   req('day');
        $key_id   =   req('key_id');


        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_project_traffic',$key_id);

        $Traffic_list   =   Get_data_list(['project_id'=>$key_id,'day'=>$day],'*',$mysql_name,'traffic_sort asc',);
        foreach ($Traffic_list as $item){
            $code[] =[
                'startingPoint'    =>  ['id'    =>  $item['starting_id'],'region_name'  =>  Get_cityname($item['starting_id'],false)],
                'destination'   =>  ['id'    =>  $item['destination_id'],'region_name'  =>  Get_cityname($item['destination_id'],false)],
                'id'   =>  $item['id'],
                'Traffic'   =>  $item['traffic'],
                'Traffic_value' =>  Get_traffic($item['traffic'],'暂未选择')
            ];
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $code],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目中某天交通乘车顺序
     * @return string
     * @throws Exception
     */
    public function editprojectDayTraffic():string{
        global $g_account;

        $day   =   req('day');
        $key_id   =   req('key_id');
        $key   =   req('key');
        $Traffic   =   req('Traffic');
        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$Traffic,code::PARAMETER_ERROR,'required'],
            [$key,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_export_project_traffic',$key_id);
        updata_detail(['Traffic'=>$Traffic], $mysql_name, $key);
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  获取项目每天时间
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
                'city'  =>  Get_project_day_city_export($key_id,$i+1)
            ];
        }

        return success( $code,code::REQUEST_SUCCESSFUL);
    }
}


$data       =   new export();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'add_trip';
    $list_code  =   array('add_trip','del_trip','add_note','del_note','add_day_city','del_day_city','add_project_content','add_project_content_notes',
        'del_note_notes','add_note_notes','GetProjectPoi','AddProjectPoi','DelProjectPoi','GetProjectTraffic','editProjectPoisort',
        'projectDayTraffic','editprojectDayTraffic','GetDay');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


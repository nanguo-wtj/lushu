<?php

class resource_edit
{
    /**
     *  添加项目詳細信息  -  添加編輯亮点行程总览
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
        $details = Get_details_where(['project_id' => $key_id], 'id,Highlights', 't_project_remarks');
        $mysql_resources_name = 't_project_remarks';
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
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::ADDED_SUCCESSFULLY);
    }

    /**
     *  去除项目詳細信息  -  去除亮点行程总览
     * @throws Exception
     * @return string
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
        $details = Get_details_where(['project_id' => $key_id], 'id,Highlights', 't_project_remarks');
        $mysql_resources_name = 't_project_remarks';
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
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
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
        $mysql_resources_name = 't_project_remarks';
        $where = ['project_id' => $key_id];
        if ($day) {
            $mysql_resources_name = 't_project_remarks_day';
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
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
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
        $mysql_resources_name = 't_project_remarks_notes';
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
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
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
        $details = Get_details_where(['project_id' => $key_id], 'id,note', 't_project_remarks');
        $mysql_resources_name = 't_project_remarks';
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
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
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
        $details = Get_details_where(['project_id' => $key_id], 'id,note', 't_project_remarks_notes');
        $mysql_resources_name = 't_project_remarks_notes';
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
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['key_id' => $key_id, 'time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }

    /**
     *  添加项目詳細信息  -  添加城市信息
     * @return string
     * @throws Exception
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
        $mysql_resources_name = 't_project_remarks_day';
        $project = Get_details_whereno(['id' => $key_id], 'id,day', );
        $end_day    =   0;
        $code   =   [];
        for ($i = $day; $i <= ($day + $number); $i++) {
            if($i<=$project['day']){
                $details = Get_details_whereno(['project_id' => $key_id, 'day' => $i], 'id,city', 't_project_remarks_day');
                if (!$details) {
                    $details['id']  =   $this->addProjectDay($key_id,$i);
                    $city_code   =   [];
                    $city   =   [];
                }else{
                    if($details['city']){
                        $city = explode(',', $details['city']);

                    }else{
                        $city   =   [];
                    }
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

        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }



    /**
     *  添加项目詳細信息  -  去除项目城市信息
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
        $mysql_resources_name = 't_project_remarks_day';
        $details = Get_details_where(['project_id' => $key_id, 'day' => $day], 'id,city', 't_project_remarks_day');
        $city = explode(',', $details['city']);
        $city   =   array_filter($city);

        $mysql_name   =   GetTableName('t_project_traffic',$key_id);

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
                    if(is_array($city) && count($city) > 1){
                        $this->AddTraffic($city[($index-1)],$city[($index+1)],$key_id,$day,true,$details_traffic['traffic_sort']);
                    }
                }

                unset($city[$index]);

            }
        }





        $code = [
            'city' => implode(',', $city),//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }


    /**
     *  添加项目詳細信息  -  添加城市信息
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
        $mysql_name   =   GetTableName('t_project_traffic',$key_id);
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
     *  添加项目詳細信息  -  添加项目行程介绍
     * @return string
     * @throws Exception
     */
    public function add_project_content():string
    {
        $key_id = req('key_id');
        $content = req('content');
        $day = req('day');
        $verification = [
            [$key_id, code::PARAMETER_ERROR . '1', 'required'],
            [$content, code::PARAMETER_ERROR . '2', 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_project_remarks';
        if($day){
            $mysql_resources_name = 't_project_remarks_day';
        }
        $details = Get_details_where(['project_id' => $key_id,'day'=>$day], 'id', $mysql_resources_name);
        $code = [
            'content' => $content,//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }

    /**
     *  添加项目詳細信息  -  添加项目备注行程介绍
     * @return string
     * @throws Exception
     */
    public function add_project_content_notes():string
    {
        $key_id = req('key_id');
        $content = req('content');
        $day = req('day');
        $verification = [
            [$key_id, code::PARAMETER_ERROR . '1', 'required'],
            [$content, code::PARAMETER_ERROR . '2', 'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name = 't_project_remarks_notes';

        $details = Get_details_where(['project_id' => $key_id,'day'=>$day], 'id', $mysql_resources_name);
        $code = [
            'content' => $content,//
        ];
        updata_detail($code, $mysql_resources_name, $details['id']);
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['time' => date('Y-m-d H:i:s', time())], code::OPERATION_SUCCESSFUL);
    }

    private function addProjectDay($key_id  =   0,$day  =   0){
        $sql = "INSERT INTO `t_project_remarks_day`( `project_id`, `schedule`, `content`, `note`,`day`) VALUES ( ".$key_id.", '', '', '','".$day."');";
        $add_id =   $this->mysql->query($sql);
        if(empty($add_id)){
            throw new Exception(code::SYSTEM_ERROR);
        }
        return $add_id;
    }
}


$data       =   new resource_edit();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'add_trip';
    $list_code  =   array('add_trip','del_trip','add_note','del_note','add_day_city','del_day_city','add_project_content','add_project_content_notes','del_note_notes','add_note_notes');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


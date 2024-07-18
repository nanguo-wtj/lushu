<?php

class tool
{

    /**
     *  根据城市关键字搜索对应城市信息  分页  PAGED
     * @return string
     * @throws Exception
     */
    public function address():string{
        global $g_siteid,$g_account;
        $address   =   req('address');
        $verification   =   [
            [$address,code::RESOURCE_NAME,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_name   =   GetTableName('t_resources_city');

        $address_default    =   Get_address($address,'t_city');
        if($address_default){
            foreach ($address_default as $index=>$item){
                $address_default[$index]['parent']   = Get_parent_name($item['parent_id'],'t_city');
                unset($address_default[$index]['parent_id']);
            }
        }
        $address_user       =   Get_address_user($address,$mysql_name,false);
        if($address_user){
            foreach ($address_user as $index=>$item){
                $user_data  =   Get_userdata_id('username,account',$item['account_id']);
                unset($address_user[$index]['account_id']);
                $address_user[$index]['user']   = [
                    'account'   =>  $user_data['account'],
                    'username'   =>  $user_data['username'],
                ];
                $address_user[$index]['id']   =   Getaddress_id($address_user[$index]['id']);
                $address_user[$index]['parent']   = Get_parent_name($item['parent_id'],'t_city');

            }
        }
        return success(['default'   =>  $address_default,'user' =>  $address_user,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);

    }


    /**
     *  全局上传文件接口
     * @return string
     * @throws Exception
     */
    public function picture():string{
        global $g_siteid,$g_http,$g_account;
        $file   =   $_FILES['file'];
        if(($file['size']/1024) > (1024*5)){
            return error(code::UPLOAD_FILE_SIZE_NOT_EXCEEDING_5MB,['size'=>$file['size'],'max_size'=>(1024*5)]);
        }
        $file_type = explode('.', $file['name']);
        $file_type = $file_type[sizeof($file_type)-1];
        $upfile_path = time().rand(111111,999999).'-'.date('Ymd').'.'.$file_type;
        $UploadAddress  =   $this->SetCurrentUserFolder(true);
        if(!$UploadAddress){
            return error(code::SYSTEM_ERROR);
        }
        move_uploaded_file($file['tmp_name'], $UploadAddress . $upfile_path);
        return success(['url'   =>   '/upfiles/'.$g_account['account_id'].'/'.date('Ymd',time()).'/'.$upfile_path,'time'  =>   date('Y-m-d H:i:s',time())],code::UPLOAD_SUCCESSFUL);
    }


    /**
     *  全局上传文件接口
     * @return string
     * @throws Exception
     */
    public function file():string{
        global $g_siteid,$g_http,$g_account;
        $file   =   $_FILES['file'];
        if(($file['size']/1024) > (1024*5)){
            return error(code::UPLOAD_FILE_SIZE_NOT_EXCEEDING_5MB,['size'=>$file['size'],'max_size'=>(1024*5)]);
        }
        $temp_arrays = explode(".", $file['name']);
        $data_type = $temp_arrays[sizeof($temp_arrays) - 1];
        $file_type = strtolower($data_type);

        $upfile_path = time().rand(111111,999999).'-'.date('Ymd').'.'.$file_type;
        $UploadAddress  =   $this->SetCurrentUserFolder(true);
        if(!$UploadAddress){
            return error(code::SYSTEM_ERROR);
        }
        move_uploaded_file($file['tmp_name'], $UploadAddress . $upfile_path);
        return success_file( '/upfiles/'.$g_account['account_id'].'/'.date('Ymd',time()).'/'.$upfile_path,code::UPLOAD_SUCCESSFUL);
    }



    /**
     *  搜索poi   分页  PAGED
     * @return string
     * @throws Exception
     */
    public function search_poi():string{
        global $g_account;
        $where  =   [
            'title'     =>  ['like',req('title')],
            'account_id'     =>  $g_account['account_id'],
        ];
        $type   =   req('type');
        if(isset($type)){
            $where['account_id']  =    ['in',$g_account['account_id'].',1'];
        }

        $verification   =   [
            [req('title'),code::RESOURCE_NAME,'required'],
        ];
        (new check())->set_code($verification);
        $felid  =   ['id','title','address','map_address'];
        $list   =   Get_data_listNumber($where,$felid,'t_resources','id desc');
        $code   =   [];
        foreach ($list as $index=>$item){
            $map_address    =   ['',''];
            if($item['map_address']){
                $map_address    =   explode(',',$item['map_address']);
                if(count($map_address) != 2){
                    continue;
                }
            }
            $code[] =   [
                'id'    =>  $item['id'],
                'title'    =>  $item['title'],
                'address'    =>  $item['address'],
                'map_address'    =>  $item['id'],
                'lng'                   =>      $map_address[0],
                'lat'                   =>      $map_address[1],
            ];
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $code],code::REQUEST_SUCCESSFUL);
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
        $mysql_name   =   GetTableName('t_project_traffic',$key_id);
        $code   =   [];
        $Traffic_list   =   Get_data_list(['project_id'=>$key_id,'day'=>$day],'*',$mysql_name,'traffic_sort asc');
        if($Traffic_list){
            foreach ($Traffic_list as $item){
                $code[] =[
                    'startingPoint'    =>  ['id'    =>  $item['starting_id'],'region_name'  =>  Get_cityname($item['starting_id'],false)],
                    'destination'   =>  ['id'    =>  $item['destination_id'],'region_name'  =>  Get_cityname($item['destination_id'],false)],
                    'id'   =>  $item['id'],
                    'Traffic'   =>  $item['traffic'],
                    'Traffic_value' =>  Get_traffic($item['traffic'],'暂未选择')
                ];
            }
        }


        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'  =>  $code],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  编辑项目日期出行方案
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
        $mysql_name   =   GetTableName('t_project_traffic',$key_id);
        updata_detail(['Traffic'=>$Traffic], $mysql_name, $key);
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  编辑项目日期的餐饮情况
     * @return string
     * @throws Exception
     */
    public function AddDining():string{
        global $g_account;

        $day   =   req('day');
        $key_id   =   req('key_id');
        $Dining   =   req('Dining');


        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$Dining,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $details    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$day],'id','t_project_remarks_day');

        $code = [
            'breakfast'  =>  $Dining['breakfast'],
            'lunch'  =>  $Dining['lunch'],
            'dinner'  =>  $Dining['dinner'],
        ];
        updata_detail($code, 't_project_remarks_day', $details['id']);
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  编辑项目日期  酒店预定
     * @return string
     * @throws Exception
     */
    public function projectDayHotel():string{
        $day        =   req('day');
        $key_id     =   req('key_id');
        $time     =   req('time');


        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
            [$time,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $error  =   false;
        $code   =   [];
        for ($i=$time['enter'];$i<=$time['outer'];$i++){
            $details    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$i],'id,hotel','t_project_remarks_day');
            if($details['hotel']){
                $error = true;
            }else{
                $code[] =   [
                    'id'    =>  $details['id'],
                    'hotel' =>  $time['hotel_id'],
                    'hotel_day' =>  $time['enter'].','.$time['outer'],
                    'hotel_time' =>  'D'.$time['enter'].'(入住)- D'.($time['outer']+1).'(离店)',
                ];
            }
        }
        if($error == true){
            throw new Exception(code::THE_ROOM_HAS_BEEN_BOOKED_AT_THE_CURRENT_TIME);
        }


        foreach ($code as $item){
            $id =   $item['id'];
            unset($item['id']);
            updata_detail($item, 't_project_remarks_day', $id);

        }

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  去除项目日期的酒店预定
     * @return string
     * @throws Exception
     */
    public function DelprojectDayhotel():string{
        $day        =   req('day');
        $key_id     =   req('key_id');



        $verification   =   [
            [$day,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $error  =   false;
        $code   =   [];
        $details    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$day],'id,hotel,hotel_day','t_project_remarks_day');
        $time   =   explode(',',$details['hotel_day']);
        for ($i=$time[0];$i<=$time[1];$i++){
            $day_data    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$i],'id,hotel','t_project_remarks_day');
            if($day_data['hotel'] !=    $details['hotel']){
                $error = true;
            }else{
                $code[]   =   [
                    'id'            =>  $day_data['id'],
                    'hotel'         =>  '',
                    'hotel_day'     =>  '',
                    'hotel_time'    =>  '',
                ];
            }
        }
        if($error == true){
            throw new Exception(code::THE_ROOM_HAS_BEEN_BOOKED_AT_THE_CURRENT_TIME);
        }


        foreach ($code as $item){
            $id =   $item['id'];
            unset($item['id']);
            updata_detail($item, 't_project_remarks_day', $id);

        }

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  添加poi
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
                if($resources){
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
                }

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
                if($resources) {

                    $code[] = [
                        'schedule' => $item['schedule'],
                        'day' => $item['day'],
                        'type' => $item['type'],
                        'poi_sort' => $item['poi_sort'],
                        'lng' => $map_address[0],
                        'lat' => $map_address[1],
                        'title' => $resources['title'],
                        'id' => $item['id'],
                        'traffic' => $traffic
                    ];
                }
            }




        }

        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  添加项目日期的日程安排poi信息
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

        if(!in_array($type,array(1,2,3,4,6,7))){
            throw new Exception(code::PARAMETER_ERROR);
        }

        $poi_sort   =   1;
        $details    =   Get_details_desc(['project_id'=>$key_id,'day'=>$day],'poi_sort','t_project_day_schedule','poi_sort desc');
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

        $id =   add_detail($code,'t_project_day_schedule');
        unset($code['project_id']);
        $code['title']  =   $name;
        $code['id']     =   $id;
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$code],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  去除项目日期的日程安排poi信息
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

        $details    =   Get_details_whereno(['id'=>$poi,'project_id'=>$key_id],'poi_sort','t_project_day_schedule');
        Del_where(['id'=>$poi],'t_project_day_schedule');
        $updata_status    =   Get_details_whereno(['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['>',$details['poi_sort']]],'id','t_project_day_schedule');
        if($updata_status){
            updata_detail_all(" `poi_sort` =  poi_sort-1  ",'t_project_day_schedule',['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['>',$details['poi_sort']]]);
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  获取项目日期的交通信息
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

        $details    =   Get_details_whereno(['id'=>$key,'project_id'=>$key_id],'id,schedule,poi_sort,traffic','t_project_day_schedule');
        $details_next    =   Get_details_whereno(['project_id'=>$key_id,'day'=>$day,'poi_sort'  =>  ($details['poi_sort']+1)],'schedule','t_project_day_schedule');
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
//            $list    =   Get_data_listall(['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['>',($newpoi_sort-1)]],'id,poi_sort','t_project_day_schedule','poi_sort asc');
//            foreach ($list as $item){
//                $newpoi_sort++;
//                updata_detail_custom(['poi_sort'=>$newpoi_sort],'t_project_day_schedule',[['id',$item['id']]]);
//            }
            updata_detail_all(" `poi_sort` =  poi_sort+1  ",'t_project_day_schedule',['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['BETWEEN',[$newpoi_sort,$poi_sort]]]);

            updata_detail_custom(['poi_sort'=>$edit_poi_sort],'t_project_day_schedule',[['id',$key]]);

        }else{
            updata_detail_all(" `poi_sort` =  poi_sort-1  ",'t_project_day_schedule',['project_id'=>$key_id,'day'=>$day,'poi_sort'=>['BETWEEN',[$poi_sort,$newpoi_sort]]]);
            updata_detail_custom(['poi_sort'=>$newpoi_sort],'t_project_day_schedule',[['id',$key]]);
        }

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  项目交通乘车顺序
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
        updata_detail_custom(['traffic'=>$traffic],'t_project_day_schedule',[['id',$key]]);
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }
    /**
     *  项目  添加项目项目天数
     * @return string
     * @throws Exception
     */
    public function add_project_day():string{
        $key_id     =   req('key_id');
        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],

        ];
        (new check())->set_code($verification);
        $details = Get_details_where(['id' => $key_id], 'id,day,start_time');
        $code   =   [];
        $code['day'] =   $details['day']+1;
        $code['end_time'] =   $details['start_time']+(86400*$details['day']+1);
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

   /**
     *  项目  去除项目项目天数
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
        $details = Get_details_where(['id' => $key_id], 'id,day,start_time');
        $code   =   [];
        $code['day'] =   $details['day']-1;
        $code['end_time'] =   $details['start_time']+(86400*$details['day']-1);
        Del_where(['project_id'=>$key_id,'day'=>$day],'t_project_day_schedule');
        Del_where(['project_id'=>$key_id,'day'=>$day],'t_project_remarks_day');
        updata_detail_all(" `day` =  day-1  ",'t_project_day_schedule',['project_id'=>$key_id,'day'=>['>',$day]]);
        updata_detail_all(" `day` =  day-1  ",'t_project_remarks_day',['project_id'=>$key_id,'day'=>['>',$day]]);
        updata_detail($code, 't_project', $details['id']);
        SetProjectLog($key_id,'{user}在{project}中编辑了行程规划');
        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  根据坐标点返回poi  当前范围为5000米
     * @return string
     * @throws Exception
     */
    public function GetCoordinatePoints():string{
        $lng     =   req('lng');
        $lat     =   req('lat');
        $verification   =   [
            [$lng,code::PARAMETER_ERROR,'required'],
            [$lat,code::PARAMETER_ERROR,'required'],

        ];
        (new check())->set_code($verification);

        $code = Get_coordinate_max($lng,$lat,5000);

        $where  =   [
            'lng'   =>  ['BETWEEN',array($code['minLon'],$code['maxLon'])],
            'lat'   =>  ['BETWEEN',array($code['minLat'],$code['maxLat'])],
        ];
        $list   =   Get_data_listNumber($where,'id,title,map_address,lng,lat,type,picture_id','t_resources','id desc','100');
        $picture_name   =   GetTableName('t_resources_img');
        foreach ($list as $index=>$item){
            $list[$index]['picture']       =  Get_details_value($item['picture_id'],'url',$picture_name);
        }
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$list],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  项目  根据坐标点返回酒店 当前范围为5000米
     * @return string
     * @throws Exception
     */
    public function GetCoordinatePointsHotel():string{
        $lng     =   req('lng');
        $lat     =   req('lat');
        $verification   =   [
            [$lng,code::PARAMETER_ERROR,'required'],
            [$lat,code::PARAMETER_ERROR,'required'],

        ];
        (new check())->set_code($verification);

        $code = Get_coordinate_max($lng,$lat,5000);
        $where  =   [
            'lng'   =>  ['BETWEEN',array($code['minLon'],$code['maxLon'])],
            'lat'   =>  ['BETWEEN',array($code['minLat'],$code['maxLat'])],
        ];
        $list   =   Get_data_listNumber($where,'id,title,map_address,lng,lat,type','t_resources_hotel','id desc','100');
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$list],code::REQUEST_SUCCESSFUL);
    }


    /**
     *  项目  旅游局信息列表
     * @return string
     * @throws Exception
     */
    public function Gettourism():string{
        $list   =   Get_data_listNumber([],'*','t_tourism','id desc','10000000');
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$list],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  项目  旅行资源中心
     * @return string
     * @throws Exception
     */
    public function GetResourcesAll():string{
        $list   =   Get_data_listNumber([],'*','t_resources_all','id desc','10000000');
        return success(['time'  =>   date('Y-m-d H:i:s',time()),'list'=>$list],code::REQUEST_SUCCESSFUL);
    }



    private function SetCurrentUserFolder($status   =   false){
        global $g_siteid,$g_account;
        $upload_dir = dirname(__FILE__,3) . '/upfiles/'.$g_account['account_id'].'/'.date('Ymd',time()).'/';
        if (is_dir($upload_dir) == false) {
            if(mkdir($upload_dir, 0777,true)){
                return $upload_dir;
            }
            return  '';
        }
        return $upload_dir;
    }

    /**
     *  项目  去除标签
     * @return string
     * @throws Exception
     */
    public function label_del():string{

        $key_id =   req('key_id');
        $mysql_resources_name   =   GetTableName('t_label');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);

        Del_where(['id'=>$key_id],$mysql_resources_name);

        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);
    }


    /**
     *  项目  生成二维码
     * @throws Exception
     */
    public function GetQRcode(){
        include(dirname(__FILE__,3) . '/libs/qr/phpqrcode.php');

        $value =   req('v');

        if($value=='') {
            throw new Exception(code::PARAMETER_ERROR);
        }

        $errorCorrectionLevel = 'L';

        if(isset($_GET['l'])&&$_GET['l']!=''){
            $matrixPointSize = $_GET['l'];
        } else {
            $matrixPointSize = 4;
        }

        QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
    }

}


$data       =   new tool();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'address';
    $list_code  =   array('address','picture','search_poi','projectDayTraffic','editprojectDayTraffic','AddDining','projectDayHotel',
        'DelprojectDayhotel','AddProjectPoi','GetProjectPoi','DelProjectPoi','editProjectPoisort','GetProjectTraffic','editProjectTraffic','add_project_day',
        'del_project_day','GetCoordinatePoints','GetCoordinatePointsHotel','label_del','GetQRcode','Gettourism','GetCity','GetResourcesAll','file');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


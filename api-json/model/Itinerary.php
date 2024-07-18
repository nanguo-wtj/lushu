<?php

class Itinerary
{
    public int $key_id = 0;

    /**
     *  项目詳細信息  -  根据项目key获取项目日期内全部信息
     * @throws Exception
     * @return array
     */
    public function TravelRoute():array{


        //判断修改数据是否存在
        if(Get_status_project($this->key_id) == false){
            throw new Exception(code::PARAMETER_ERROR);
        }
        if(Get_status($this->key_id) !=1){
            return error_no( '',code::PROCESS_ERROR);;
        }



        $details    =   Get_details_all($this->key_id,'start_time,end_time,day,account_id');
        $code   =   [];
        for ($i=0;$i<$details['day'];$i++){
            $time   =   $details['start_time']+(86400*$i);
            $details_day    =   Get_details_whereno(['project_id'=>$this->key_id,'day'=>($i+1)],'id,hotel,traffic,breakfast,lunch,dinner,content,note,hotel_time','t_project_remarks_day');
            if(!$details_day){
                continue;
            }
            $list    =   Get_data_listall(['project_id'=>$this->key_id,'day'=>($i+1)],'id,schedule,type,poi_sort,traffic','t_project_day_schedule','poi_sort asc');
            $schedule   =   [];
            foreach ($list as $item){
                if($item['type'] != 7){
                    $traffic    =   Get_traffic($item['traffic'],'未选择交通工具');
                    $picture_name   =   GetTableName('t_resources_img',$details['account_id']);

                    $resources =   Get_details_where(['id'=>$item['schedule']],'title,introduction,picture_id','t_resources');
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
                'city'  =>  Get_project_day_city($this->key_id,$i+1)
            ];
        }


        return $code;
    }


    /**
     *  项目詳細信息  -  根据传递值 设置模版中的html值
     * @throws Exception
     * @return string
     */
    public function GetContent(){
        $code   =   $this->TravelRoute();
        $str    =   '';
        foreach ($code as $item){
            $str    .=   "<tr class=\"td\">
                                <td >
                                    <div class=\"tdInner\">
                                        <h3 class=\"day\" style='color: #00A4A8;'>D".$item['day']."</h3>
                                        <div class=\"date\">".$item['time']."</div>
                                        <div class=\"weekDay\">".$item['work']."</div>";
            foreach ($item['city'] as $a){
                $str    .=  "<div class=\"weekDay codes\">".$a['value']."</div>";
            }
            $str    .=  "
                        </div>
                    </td>
                    <td >
                        <div class=\"tdInner\">";
            foreach ($item['schedule'] as $b=>$c) {
                $str .= "
                                <div class=\"weekDay \">
                                    ".($b+1).$c['title']." 
                                </div>";
            }
            $str    .=  "
                        </div>
                    </td>
                    <td>
                        <div class=\"tdInner\">
                            <div class=\"weekDay \">
                                <i class=\"icon-tag-2-hotel\"></i>
                                ".$item['hotel']['name']['title']."
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class=\"tdInner\">";
            if($item['traffic']){
                foreach ($item['traffic'] as $d=>$e) {
                    $str .= "
                               <div class=\"weekDay \">
                                    ".$e->startingPoint->region_name.'~'.$e->destination->region_name."<br>
                                    ".$e->Traffic_value."
                                </div>";
                }
            }
            $str    .=  "
                           
                        </div>
                    </td>
                </tr>";
        }
        return $str;
    }

}
<?php

class Project
{

    public int $key_id = 0;

    /**
     *  项目詳細信息  -  根据项目key获取项目日期内全部信息
     * @return array
     * @throws Exception
     */
    public function TravelRoute():array{
        global $_Home_url;
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

                    $resources =   Get_details_whereno(['id'=>$item['schedule']],'title,introduction,picture_id,map_address','t_resources');
                    if($resources){
                        $picture    =   '';
                        if($resources['picture_id']){
                            $picture    =   $_Home_url.Get_details_value($resources['picture_id'],'url',$picture_name);
                        }
                        $schedule[]   =   [
                            'schedule'  =>  $item['schedule'],
                            'day'       =>  $i+1,
                            'type'      =>  $item['type'],
                            'poi_sort'  =>  $item['poi_sort'],
                            'map_address'  =>  $resources['map_address'],
                            'title'     =>  $resources['title'],
                            'introduction'     =>  $resources['introduction'],
                            'picture'       =>  $picture,
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
                        'url'       =>  $_Home_url.$data['picture'],
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
                'traffic'  =>  json_decode($details_day['traffic']),
                'city'  =>  Get_project_day_city($this->key_id,$i+1)
            ];
        }


        return $code;
    }


    public function GetContent($data  =   array()){
        global $g_account;
        $str    =   [
            'day_list'  =>  '',
            'schedule'  =>  '',
            'img_list'  =>  [],
        ];
        foreach ($data as $item){

            $city   =   [];
            foreach ($item['city'] as $a){
                $city[]   =  $a['value'];
            }

            $str['day_list']    .=  "<tr>
                        <td>
                            <div class=\"cell\">
                                <span class=\"day\" style=\"text-align: center;\">D".$item['day']."</span>
                                <span>".$item['time']." / ".$item['work']."</span>
                            </div>
                        </td>
                        <td>
                            <div class=\"cell\">
                                <span>".implode(',',$city)."</span>
                            </div>
                        </td>
                    </tr>";




            $str['schedule']    .=   "<div style='margin-top: 2rem'>
            <div style=\"width: 100%; margin: 10px 0px 15px;float: unset;height: auto\">
                <div style=\"margin-left: 0px;float: left;width: 29%\">
                    <span style=\"color: rgb(0, 164, 168); font-size: 20px; margin-right: 10px;\">D".$item['day']."</span>
                    <span style=\"color: rgb(148,148,148);\">".$item['time']."</span>
                </div>
                <div style=\"margin-right: 0px;float: right;width: 70%;text-align: right\">".implode('--',$city)."</div>
            </div>

            <div style=\"width: 100%;text-align: center;line-height: 35px;color: #737373\">
                ".$item['content']."
            </div>";


            $schedule   =   '';
            $map_list   =   [];
            foreach ($item['schedule'] as $b){
                if($b['map_address']){
                    $map_list[]   =  $b['map_address'];
                }

                if($b['picture']){
                    $schedule    .=    "<div class=\"day_class\">
                    <div class=\"class_body\">
                        <div class=\"class_left\">
                            <div class=\"class_title\">
                                <div class=\"class_text\">".$b['title']."</div>
                            </div>
                            <div class=\"class_content\">
                                ".$b['introduction']."
                            </div>
                        </div>
                        <div class=\"class_right\">
                            <div class=\"class_img\">
                                <img src=".$b['picture']." style=\"    width: 100%;max-height: 200px;\">
                            </div>
                        </div>
                    </div>
                </div>";
                }else {
                    $schedule    .=    "<div class=\"day_class\">
                    <div class=\"class_body\">
                        <div class=\"class_auto\">
                            <div class=\"class_title\" style=\"color: #aea27a\">
                                <div class=\"class_text\">".$b['title']."</div>

                            </div>
                            <div class=\"class_content\">
                              ".$b['introduction']."
                            </div>
                        </div>
                    </div>
                </div>";
                }

            }
            if($map_list){
                $map_list_data  =   'A:'.implode(';',$map_list);
                $url    =   "https://restapi.amap.com/v3/staticmap?size=800*500&markers=large,0xFF0000,".$map_list_data."&key=".MAP_PDF_KEY."&paths=2,0x0000ff,1,,:".implode(';',$map_list);
                $img_data   =   file_get_contents($url);
                $upfile_path = time().rand(111111,999999).'-'.date('Ymd').'.png';
                $UploadAddress  =   $this->SetCurrentUserFolder(true);
                file_put_contents($UploadAddress . $upfile_path,$img_data);
                $str['img_list'][]    =   $UploadAddress . $upfile_path;
                $str['schedule']    .=     "<div class=\"map\" style='height: 500px;background-color: white;'>
                <img style=\"height: 500px;\" src=\"".'/upfiles/'.$g_account['account_id'].'/'.date('Ymd',time()).'/'.$upfile_path."\">
            </div>
            <div class=\"day_body\">";
            }else {
                $str['schedule'] .= "<div class=\"day_body\">";
            }


            $str['schedule']    .=  $schedule;
         $str['schedule']   .=   "</div>
        </div>";





        }

        return $str;
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





}
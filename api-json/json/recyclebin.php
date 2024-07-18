<?php

class recyclebin
{
    public function recyclebinList(){
        $type     =   req('type');
        $verification   =   [
            [$type,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [];
        switch ($type){
            case 1:
                $code = $this->getProject();
                break;
            case 2:
                $code = $this->getPoi();
                break;
            case 3:
                $code = $this->getImg();
                break;
            case 4:
                $code = $this->getNotes();
                break;
            case 5:
                $code = $this->getHotel();
                break;
            case 6:
                $code = $this->getActivities();
                break;
            case 7:
                $code = $this->getTrip();
                break;
        }
        return success($code,code::REQUEST_SUCCESSFUL);

    }

    private function getProject(){
        global $g_account;
        $where = [
            'is_delete' =>  1,
            'account_id'    =>  $g_account['account_id']
        ];
        $list   =   Get_data_listall($where,['project_name','account_id','id','update_time'],'t_export_project');
        $code = [];
        foreach ($list as $item){
            $code[] =   [
                'time' => date('Y-m-d H:i:s',$item['update_time']),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'title'  =>  $item['project_name'],
                'id'  =>  $item['id'],

            ];
        }
        return $code;
    }


    private function getPoi(){
        global $g_account;
        $where = [
            'state' =>  1,
            'account_id'    =>  $g_account['account_id']
        ];
        $list   =   Get_data_listall($where,['title','id','account_id','update_time'],'t_resources');
        $code = [];
        foreach ($list as $item){
            $code[] =   [
                'time' => date('Y-m-d H:i:s',$item['update_time']),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'title'  =>  $item['title'],
                'id'  =>  $item['id'],

            ];
        }
        return $code;
    }


    private function getHotel(){
        global $g_account;
        $where = [
            'state' =>  1,
            'account_id'    =>  $g_account['account_id']
        ];
        $list   =   Get_data_listall($where,['title','account_id','id','update_time'],'t_resources_hotel');
        $code = [];
        foreach ($list as $item){
            $code[] =   [
                'time' => date('Y-m-d H:i:s',$item['update_time']),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'title'  =>  $item['title'],
                'id'  =>  $item['id'],

            ];
        }
        return $code;
    }



    private function getImg(){
        global $g_account;
        $where = [
            'state' =>  1,
            'account_id'    =>  $g_account['account_id']
        ];
        $mysql_name   =   GetTableName('t_resources_img');

        $list   =   Get_data_listall($where,['notes','account_id','id','update_time'],$mysql_name);
        $code = [];
        foreach ($list as $item){
            $code[] =   [
                'time' => date('Y-m-d H:i:s',$item['update_time']),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'title'  =>  $item['notes'],
                'id'  =>  $item['id'],

            ];
        }
        return $code;
    }



    private function getNotes(){
        global $g_account;
        $where = [
            'state' =>  1,
            'account_id'    =>  $g_account['account_id']
        ];
        $mysql_name   =   GetTableName('t_resources_note');

        $list   =   Get_data_listall($where,['title','id','account_id','update_time'],$mysql_name);
        $code = [];
        foreach ($list as $item){
            $code[] =   [
                'time' => date('Y-m-d H:i:s',$item['update_time']),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'title'  =>  $item['title'],
                'id'  =>  $item['id'],

            ];
        }
        return $code;
    }
    private function getActivities(){
        global $g_account;
        $where = [
            'state' =>  1,
            'account_id'    =>  $g_account['account_id']
        ];
        $mysql_name   =   GetTableName('t_resources_activities');

        $list   =   Get_data_listall($where,['title','id','account_id','updata_time'],$mysql_name);
        $code = [];
        foreach ($list as $item){
            $code[] =   [
                'time' => date('Y-m-d H:i:s',$item['updata_time']),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'title'  =>  $item['title'],
                'id'  =>  $item['id'],
            ];
        }
        return $code;
    }
    private function getTrip(){
        global $g_account;
        $where = [
            'state' =>  1,
            'account_id'    =>  $g_account['account_id']
        ];
        $mysql_name   =   GetTableName('t_resources_wonderful');

        $list   =   Get_data_listall($where,['title','id','account_id','update_time'],$mysql_name);
        $code = [];
        foreach ($list as $item){
            $code[] =   [
                'time' => date('Y-m-d H:i:s',$item['update_time']),
                'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
                'title'  =>  $item['title'],
                'id'  =>  $item['id'],

            ];
        }
        return $code;
    }

    public function restore(){
        $type     =   req('type');
        $key_id     =   req('key_id');
        $verification   =   [
            [$type,code::PARAMETER_ERROR,'required'],
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [];
        switch ($type){
            case 1:
                $this->restoreProject($key_id);
                break;
            case 2:
                $this->restorePoi($key_id);
                break;
            case 3:
                $this->restoreImg($key_id);
                break;
            case 4:
                $this->restoreNotes($key_id);
                break;
            case 5:
                $this->restorevHotel($key_id);
                break;
            case 6:
                $this->restoreActivities($key_id);
                break;
            case 7:
                $this->restoreTrip($key_id);
                break;
        }
        return success('',code::RECOVERY_WAS_SUCCESSFUL);
    }




    private function restoreProject($key_id = 0){
        $code   =   [
            'update_time'           =>      time(),
            'is_delete'           =>      0,
        ];
        $mysql_project_export   =   't_export_project';

        updata_detail($code,$mysql_project_export,$key_id);
        updata_detail_codeall($code,'t_export_project_member',['project_id'=>$key_id]);
    }

    private function restorePoi($key_id = 0){
        $code   =   [
            'update_time'           =>      time(),
            'state'           =>      0,
        ];
        $mysql_name   =   't_resources';

        updata_detail($code,$mysql_name,$key_id);
    }
    private function restorevHotel($key_id = 0){
        $code   =   [
            'update_time'           =>      time(),
            'state'           =>      0,
        ];
        $mysql_name   =   't_resources_hotel';

        updata_detail($code,$mysql_name,$key_id);
    }
    private function restoreImg($key_id = 0){
        $code   =   [
            'update_time'           =>      time(),
            'state'           =>      0,
        ];
        $mysql_name   =   GetTableName('t_resources_img');

        updata_detail($code,$mysql_name,$key_id);
    }
    private function restoreNotes($key_id = 0){
        $code   =   [
            'update_time'           =>      time(),
            'state'           =>      0,
        ];
        $mysql_name   =   GetTableName('t_resources_note');

        updata_detail($code,$mysql_name,$key_id);
    }

    private function restoreActivities($key_id = 0){
        $code   =   [
            'updata_time'           =>      time(),
            'state'           =>      0,
        ];
        $mysql_name   =   GetTableName('t_resources_activities');

        updata_detail($code,$mysql_name,$key_id);
    }


    private function restoreTrip($key_id = 0){
        $code   =   [
            'update_time'           =>      time(),
            'state'           =>      0,
        ];
        $mysql_name   =   GetTableName('t_resources_wonderful');
        updata_detail($code,$mysql_name,$key_id);
    }






}

$data       =   new recyclebin();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'recyclebinList';
    $list_code  =   array('recyclebinList','restore');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


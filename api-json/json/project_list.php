<?php



/**
 *  项目操作 接口
 *
 */

class project_list
{
    public $mysql;

    /**
     *  出行项目列表
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
        $felid  =   ['project_id'];
        $where['is_delete']    =   0;

        $list  =    Get_Project_list($where,'t_project',$deso.' desc',$pages);
        return success(['data'=>$list,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);


    }
    /**
     *  出行项目列表
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
        ];

        if($day){
            $number1    =   $day['number1'] ?? 0;
            $number2    =   $day['number2'];
            $where['day']   =  ['BETWEEN',array($number1,$number2)];

        }

        if($start_time){
            $start    =   $day['number1'];
            $end    =   $day['number2'];
            if($start && $end){
                $where['start_time']   =  ['BETWEEN',array($start,$end)];
            }

        }

        if($collect){
            $where['is_collect']   =  $collect;

        }

        if($association){

            $porject_list   =   Get_data_listall(['account_id'  =>  $g_account['account_id']],'id','t_project');
            $in_porject_list    =   [];
            foreach ($porject_list as $item){
                $in_porject_list[]  =   $item['id'];
            }
            $poi_where  =   [
                'project_id'  =>  ['in',implode(',',$in_porject_list)],
                'schedule'  =>  $association,
            ];
            $list_poi   =   Get_data_listall($poi_where,'project_id','t_project_day_schedule');
            $in_list_poi    =   [];
            foreach ($list_poi as $item){
                $in_list_poi[]  =   $item['project_id'];
            }
            $where['id']    =   ['in',implode(',',$in_list_poi)];
        }







        $where['is_delete']    =   0;

        $list  =    Get_Count($where,'t_project',$page);

        return success(['data'=>$list,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);


    }



    /**
     *  出行项目列表
     * @return string
     * @throws Exception
     */
    public function project_list(): string
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
        ];

        if($day){
            $number1    =   $day['number1'] ?? 0;
            $number2    =   $day['number2'];
            $where['day']   =  ['BETWEEN',array($number1,$number2)];

        }

        if($start_time){
            $start    =   $day['number1'];
            $end    =   $day['number2'];
            if($start && $end){
                $where['start_time']   =  ['BETWEEN',array($start,$end)];
            }

        }

        if($collect){
            $where['is_collect']   =  $collect;

        }

        if($association){

            $porject_list   =   Get_data_listall(['account_id'  =>  $g_account['account_id']],'id','t_project');
            $in_porject_list    =   [];
            foreach ($porject_list as $item){
                $in_porject_list[]  =   $item['id'];
            }
            $poi_where  =   [
                'project_id'  =>  ['in',implode(',',$in_porject_list)],
                'schedule'  =>  $association,
            ];
            $list_poi   =   Get_data_listall($poi_where,'project_id','t_project_day_schedule');
            $in_list_poi    =   [];
            foreach ($list_poi as $item){
                $in_list_poi[]  =   $item['project_id'];
            }
            if(!$in_list_poi){
                $in_list_poi[]  =   -1;
            }
                $where['id']    =   ['in',implode(',',$in_list_poi)];

        }







        $where['is_delete']    =   0;
        $list  =    Get_Project_list($where,'t_project',$deso.' desc',$pages);
        return success(['data'=>$list,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);


    }


    /**
     *  已删除出行项目列表
     * @return string
     * @throws Exception
     */
    public function project_del(): string
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
        $felid  =   ['project_id'];
        $where['is_delete']    =   1;
        $list  =    Get_Project_list($where,'t_project',$deso.' desc',$pages);
        return success(['data'=>$list,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }



    /**
     *  出行项目列表
     * @return string
     * @throws Exception
     */
    public function project_list_del(): string
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

        $where  =   [
            'project_name'     =>  ['or',[req('title'),'like','title']],
            'departure'   =>  req('address'),
            'start_time'   =>  ['BETWEEN',array(strtotime($time['start']),strtotime($time['end']))],
        ];

        if($day){
            $number1    =   $day['number1'] ?? 0;
            $number2    =   $day['number2'];
            $where['day']   =  ['BETWEEN',array($number1,$number2)];

        }

        if($collect){
            $where['is_collect']   =  $collect;

        }

        if($association){

            $porject_list   =   Get_data_listall(['account_id'  =>  $g_account['account_id']],'id','t_project');
            $in_porject_list    =   [];
            foreach ($porject_list as $item){
                $in_porject_list[]  =   $item['id'];
            }
            $poi_where  =   [
                'project_id'  =>  ['in',implode(',',$in_porject_list)],
                'schedule'  =>  $association,
            ];
            $list_poi   =   Get_data_listall($poi_where,'project_id','t_project_day_schedule');
            $in_list_poi    =   [];
            foreach ($list_poi as $item){
                $in_list_poi[]  =   $item['project_id'];
            }
            $where['id']    =   ['in',implode(',',$in_list_poi)];
        }

        $where['is_delete']    =   1;
        $list  =    Get_Project_list($where,'t_project',$deso.' desc',$pages);
        return success(['data'=>$list,'time'  =>   date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);


    }







}

$data       =   new project_list();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'project';
    $list_code  =   array('project','project_list','project_del','project_list_del','project_number');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


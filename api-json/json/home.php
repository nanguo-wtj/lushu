<?php
/**
 *  用户注册 接口
 *
 *@return array 注册信息
 */


class home
{

    /**
     * 首页统计数量 接口
     * @return string
     */
    public function statistics():string
    {
        $code   =   Get_project_count();
        $data   =   [
            'title' =>  code::PROJECT_STATISTICS,
            'count'    => [
                ['number'   =>  0,'prompt' =>  code::PROJECT_PRODUCTION_IN_PROGRESS],
                ['number'   =>  0,'prompt' =>  code::PROJECT_COMPLETED]
            ],
        ];
        foreach ($code as $index => $item){
            if($item['is_sale'] == 0){
                $data['count'][0]['number']   =   $item['number'];
            }elseif($item['is_sale'] == 1){
                $data['count'][1]['number']    =   $item['number'];
            }
        }
        return success($data,code::REQUEST_SUCCESSFUL);
    }

    /**
     * 首页统计数量 接口
     * @return string
     */
    public function statisticsDay():string
    {
        $Day_list    =   GetDay7();
        $data   =   [
            'production'    =>  [],
            'completed'    =>  [],
        ];
        foreach ($Day_list as $index => $item){
            $time1 = strtotime($item);
            $time2 = $time1+86400-1;
            $code   =   Get_project_count_day($time1,$time2);
            $data['production'][$index]   =   0;
            $data['completed'][$index]    =   0;
                foreach ($code as  $a){
                    if($a['is_sale'] == 0){
                        $data['production'][$index]   =   $a['number'];
                    }else if($a['is_sale'] == 1){
                        $data['completed'][$index]    =   $a['number'];
                    }
                }
        }

        return success($data,code::REQUEST_SUCCESSFUL);
    }



}

try{
    $list       =   req('list') ?? 'statistics';
    $list_code  =   array('statistics','statisticsDay');
    if(!in_array($list,$list_code)){

        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    $data       =   new home();
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


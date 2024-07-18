<?php



/**
 *  项目操作 接口
 *
 */

class project_auxiliary
{
    public $mysql;

    /**
     *   修改项目日志备注
     * @return string
     * @throws Exception
     */
    public function project_log(): string
    {
        $key_id   =   req('key_id');
        $data   =   req('data');
        $project_id   =   req('project_id');
        $verification   =   [
            [$key_id,code::PROJECT_KEY.'|'.code::PARAMETER_ERROR,'required'],
            [$project_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $key_id =   Get_data_rsa($key_id);

        EditProjectLog($project_id,$key_id,$data);

        return success([],code::SUCCESSFULLY_SET);
    }



}

$data       =   new project_auxiliary();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'project_log';
    $list_code  =   array('project_log');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();
    echo error('错误信息：'.$e->getMessage());
}


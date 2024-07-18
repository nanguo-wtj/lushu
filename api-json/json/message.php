<?php

class message
{
    /**
     *  消息列表    长轮询查询  后期优化目标   即时通讯
     * @throws Exception
     * @return string
     */
    public function MessageNumber():string{
        global $g_account;
        $where  =   [
            'user_id'     =>  $g_account['account_id'],
            'status'    =>  0,
        ];
        $code   =   Get_details_whereno($where,'count(*) as number','t_receive','id desc');
        return success(['number'   =>  $code['number']],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  消息列表
     * @throws Exception
     * @return string
     */
    public function MessageList():string{
        global $g_account;
        $where  =   [
            'user_id'     =>  $g_account['account_id'],
            'add_time'    =>  ['>',time()-(86400*30)],
        ];
        $code   =   Get_data_listall($where,'*','t_receive','id desc');
        $message_list = [];
        foreach ($code as $item){
            $message_data   =   Get_details_whereno(['id'=>$item['message_id']],'*','t_message','id desc');
            if($message_data){
                $message_list[] =   [
                    'id'     =>  $item['message_id'],
                    'title'     =>  $message_data['title'],
                    'time'     =>   date('Y-m-d H:i:s',$message_data['add_time']),
                    'user'      =>  Get_userdata_id('username',$message_data['account_id'])['username'],
                    'status'      =>  $item['status']
                ];
            }

        }
        return success(['list'   =>  $message_list,'time'=>date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }

    /**
     *  消息内容
     * @throws Exception
     */
    public function MessageData(){
        global $g_account;
        $key_id   =   req('key_id');


        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $message_code   =   [];
        $message_user_data   =   Get_details_whereno(['message_id'=>$key_id,'user_id'=>$g_account['account_id']],'*','t_receive');
        if(!$message_user_data){
            throw new Exception(code::PARAMETER_ERROR);
        }
        $message_data   =   Get_details_whereno(['id'=>$key_id],'*','t_message');
        if($message_data){
            $content    =   [];
            if($message_data['content']){
                $content  =   htmlspecialchars_decode($message_data['content']);
            }
            $message_code =   [
                'title'     =>  $message_data['title'],
                'content'   =>  $content,
                'time'      =>   date('Y-m-d H:i:s',$message_data['add_time']),
                'user'      =>  Get_userdata_id('username',$message_data['account_id'])['username'],
            ];
            updata_detail(['status'=>1],'t_receive',$message_user_data['id']);
        }
        return success(['list'   =>  $message_code,'time'=>date('Y-m-d H:i:s',time())],code::REQUEST_SUCCESSFUL);
    }











}



$data       =   new message();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'MessageNumber';
    $list_code  =   array('MessageNumber','MessageList','MessageData');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();

} catch (Exception $e){
    $data->mysql->rollback();

    echo error('错误信息：'.$e->getMessage());
}


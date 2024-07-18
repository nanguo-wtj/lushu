<?php

class user
{
    /**
     *  获取用户信息
     * @throws Exception
     * @return string
     */
    public function GetUser():string
    {
        global $g_account;
        $code   =   [
            'username'  =>  $g_account['username'],
            'mailbox'   =>  $g_account['email'],
            'phone'     =>  $g_account['mobile'],
            'password'  =>  '******',
            'sculpture'  =>  $g_account['avatar'],
        ];
        return success($code, code::OPERATION_SUCCESSFUL);
    }

    /**
     *  上传用户头像
     * @throws Exception
     * @return string
     */
    public function Setusersculpture():string
    {
        global $g_account;
        $sculpture = req('sculpture');


        $verification = [
            [$sculpture, code::PARAMETER_ERROR , 'required'],

        ];
        (new check())->set_code($verification);

        $code = [
            'avatar' => $sculpture,//
            'edittime' => time(),//
        ];
        $mysql_resources_name = 't_admin';
        $where  =   [
            ['account_id',$g_account['account_id']]
        ];
        updata_detail_custom($code, $mysql_resources_name,$where);
        return success($code, code::OPERATION_SUCCESSFUL);
    }


    /**
     *  编辑用户信息
     * @throws Exception
     * @return string
     */
    public function SetUserData():string
    {
        global $g_account;
        $type = req('type');
        $data = req('data');
        $verification = [
            [$type, code::PARAMETER_ERROR , 'required'],
            [$data, code::PARAMETER_ERROR , 'required'],
        ];
        (new check())->set_code($verification);
        if(!in_array($type,array('username','mailbox','phone','password'))){
            throw new Exception(code::SYSTEM_ERROR);
        }
        if($type    ==  'password'){
            if($g_account['password'] != md5($data['OriginalPassword'])){
                throw new Exception(code::USER_PASSWORD_ERROR);
            }
            if($data['NewPassword'] != $data['NewPasswords']){
                throw new Exception(code::PARAMETER_ERROR);
            }
            $password_status    =   CheckPasswordStrength($data['NewPassword']);
            if(!in_array(1,$password_status)){
                throw new Exception(code::THE_CURRENT_PASSWORD_LENGTH_IS_INSUFFICIENT);
            }
            if(!in_array(2,$password_status)){
                throw new Exception(code::PLEASE_INCLUDE_SPECIAL_SYMBOLS);
            }

            $code = [
                'password' => md5($data['NewPassword']),//
                'edittime' => time(),//
            ];
        }else{
            if(!in_array($type,array('username','mailbox','phone','password'))){
                throw new Exception(code::SYSTEM_ERROR);
            }
            switch ($type){
                case 'mailbox':
                    $type_key   =   'email';
                    break;
                case 'phone':
                    $type_key   =   'mobile';
                    break;
                default:
                    $type_key   =   'username';
                    break;
            }
            $code = [
                $type_key => $data,//
                'edittime' => time(),//
            ];
        }


        $mysql_resources_name = 't_admin';
        $where  =   [
            ['account_id',$g_account['account_id']]
        ];
        updata_detail_custom($code, $mysql_resources_name,$where);
        return success($code, code::SUCCESSFULLY_SET);
    }



}



$data       =   new user();
$data->mysql    =   $db;
try{
    $list       =   req('list') ?? 'GetUser';
    $list_code  =   array('GetUser','Setusersculpture','SetUserData');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


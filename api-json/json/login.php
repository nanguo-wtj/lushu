<?
/**
 *  用户登录 接口
 *
 *@param string $user_name 用户账号
 *@param string $password 用户密码
 *@param string $hash 用户注册秘钥   样式：strtoupper（md5 （ ‘CLOOTA_ADMIN’.'YYMMDD'））
 *@return array 登录信息
 */
class login{
    /**
     * 登录用户主要接口
     * @param mixed $username string 用户账号
     * @param mixed $password string 用户密码
     * @return string
     * @throws Exception
     */
    public function logins($username    =   '',$password    =   ''):string
    {
        $user_data  =   Get_userdata('account_id,password,role',$username);
        if(empty($user_data)){
            throw new Exception(code::USER_PASSWORD_ERROR);
        }

        if($user_data['password'] != md5($password)){
            throw new Exception(code::USER_PASSWORD_ERROR);
        }
        $status =   update_login_user($user_data['account_id']);
        if($status == false){
            throw new Exception(code::SYSTEM_ERROR);
        }
        setcookies("CLOOTA_ADMIN_UUID", $status);
        if($user_data['role'] != 3){
            //后台用户key
            setcookies("CLOOTA_ADMIN_BACKGROUND_UUID", $status);
        }

        return success(['sso_key'   =>  $status,'time'  =>  date('Y-m-d H:i:s',time()),'role'=>$user_data['role']],code::LOGIN_SUCCEEDED);
    }
}

try{
    $hash       =   req('hash');
    $account = req('account');
    $password = req('password');
    $this_hash = strtoupper(md5('CLOOTA_ADMIN' . date('Ymd')));
    $verification   =   [
        [$hash,code::SORRY_FOR_SYSTEM_ERROR_PLEASE_LOG_IN_AGAIN,'required'],
        [$account,code::PLEASE_FILL_IN_THE_USER_ACCOUNT,'required'],
        [$password,code::PLEASE_FILL_IN_THE_USER_PASSWORD,'required']
    ];
    (new check())->set_code($verification);

    if ($hash != $this_hash) {
        throw new Exception(code::SORRY_FOR_SYSTEM_ERROR_PLEASE_LOG_IN_AGAIN);
    }
    $data       =   new login();
    echo $data->logins($account,$password);
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}




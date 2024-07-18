<?
/**
 *  退出用户 接口
 *
 *@param string $user_name 用户账号
 *@param string $password 用户密码
 *@param string $hash 用户注册秘钥   样式：strtoupper（md5 （ ‘CLOOTA_ADMIN’.'YYMMDD'））
 *@return array 登录信息
 */
class logout{
    /**
     * 退出用户主要接口
     * @param mixed $username string 用户账号
     * @param mixed $password string 用户密码
     * @return string
     * @throws Exception
     */
    public function index($username    =   '',$password    =   ''):string
    {
        clearcookies("CLOOTA_ADMIN_UUID");
        return success(['time'  =>  date('Y-m-d H:i:s',time())],code::EXIT_SUCCESSFULLY);
    }
}

try{
    $data       =   new logout();
    echo $data->index();
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}




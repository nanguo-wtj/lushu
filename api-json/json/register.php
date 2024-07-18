<?php
/**
 *  用户注册 接口
 *
 *@param string $user_name 用户昵称
 *@param string $email 用户邮箱 - 账户
 *@param string $password 用户密码 -  系统生成
 *@return array 注册信息
 */


class register
{
    private $user_name  =   '';
    private $email      =   '';
    private $password   =   '';

    /**
     * 注册用户主要接口
     * @param mixed $name string 用户名称
     * @param mixed $mailbox string 用户邮箱地址
     * @return string
     * @throws Exception
     */
    public function registers($name = '',$mailbox   =   ''): string
    {
        $this->user_name    =   $name;
        $this->email    =   $mailbox;
        $this->password =   GetString('8');
        //判断用户是否重复
        if(Get_userdata('account_id',$this->email)){
            throw new Exception(code::ERROR_CURRENT_ACCOUNT_ALREADY_EXISTS);
        }
        //发送邮件  返回false 后报错
        if(get_smtp($this->email,$this->user_name,'注册账号',$this->set_body()) == false){
            throw new Exception(code::SENDING_EMAIL_ERROR);
        }
        //添加用户信息  返回空 后报错
        if(Add_user($this->email,$this->password,$this->user_name)){
            return success(['user_name' =>  $this->user_name,'mailbox'  =>  $this->email],code::ACCOUNT_REGISTRATION_SUCCESSFUL);
        }else{
            throw new Exception(code::SYSTEM_ERROR);
        }
    }

    /**
     * 用户注册返回的邮件html内容
     * @return string
     */
    private function set_body(): string
    {
        $data   =   file_get_contents(dirname(__FILE__, 2) .'/static/html.txt');//邮件内容所在文件地址
        $data   =   str_replace('{$name}','测试站点',$data);//  站点名称
        $data   =   str_replace('{$email}',$this->email,$data); //
        $data   =   str_replace('{$password}',$this->password,$data); //
        $data   =   str_replace('{$url}','http://www.lushus.com/',$data);//
        $data   =   str_replace('{$qq}','2498827617',$data);//
        return trim($data);
    }


}

try{
    $name       =   req('username');
    $mailbox    =   req('mailbox');
    $verification   =   [
        [$name,code::PLEASE_FILL_IN_THE_USER_NICKNAME,'required'],
        [$mailbox,code::PLEASE_FILL_IN_THE_USERS_EMAIL_ADDRESS.'|'.code::EMAIL_FORMAT_ERROR,'required|email']
    ];
    (new check())->set_code($verification);

    $data       =   new register();
    echo $data->registers($name,$mailbox);
} catch (Exception $e){
    echo error('错误信息：'.$e->getMessage());
}


<?php

class check
{
    private $code   =   array();//校验的集合
    public function set_code($code){
        $this->code =   $code;
        return $this->verification();
    }

    private function verification(){
        $code   =   ['code' =>  true,'msg'  =>  '操作成功'];
        foreach ($this->code as $index=>$item){
            $key    =   $item[0];
            $msg    =   $item[1];
            $msg   =   explode('|',$msg);
            $type   =   $item[2]??'required';
            $type   =   explode('|',$type);
            foreach ($type as $a=>$b){
                $status =   $this->open($key,$msg[$a],$b);
                if($status['code']  ==   false){
                    throw new \Exception($status['msg']);
                }
            }

        }
        return $code;
    }

    private function open($data =   '',$msg =   '',$type    =   'required'){
        $code   =   ['code' =>  true,'msg'  =>  '操作成功'];
        switch ($type){
            case 'required':
                if(empty($data)){
                    $code   =    ['code'  =>  false,'msg' =>  $msg];
                }
                break;
            case 'email':
                if(!filter_var($data, FILTER_VALIDATE_EMAIL)&&$data){
                    $code   =    ['code'  =>  false,'msg' =>  $msg];
                }
                break;
            case 'numeric':
                if(!is_numeric($data)&&$data){
                    $code   =    ['code'  =>  false,'msg' =>  $msg];
                }
                break;
        }
        return $code;
    }
}
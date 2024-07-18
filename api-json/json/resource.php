<?php

/**
 *  资源操作 接口
 *
 */

class resource
{
    public $mysql;
    /**
     *  添加新的资源信息
     * @return string
     * @throws Exception
     */
    public function add(): string
    {
        global $g_siteid,$g_account;
        $title   =   req('title');
        $address   =   req('address');
        $label   =   req('label');
        $map_address  =   req('map_address');
//        $map_address    =   0;
        $address_code    =   req('address_code');
        $type  =   req('type');
        $key_id  =   req('key_id');
        $verification   =   [
            [$title,code::RESOURCE_NAME,'required'],
            [$address,code::RESOURCE_ADDRESS,'required'],
            [$address_code,code::RESOURCE_ADDRESS,'required'],
            [$map_address,code::RESOURCE_ADDRESS.'02','required'],
            [$type,code::NATURAL_RESOURCES.'|'.code::NATURAL_PARAMETER_ERROR,'required|numeric'],
        ];

        (new check())->set_code($verification);
        $label_id   =   [];
        foreach ($label as $item){
            $label_id[] =   $item['id'];
        }
        $address_id   =   [];
        foreach ($address_code as $item){
            $address_id[] =   $item['id'];
        }


        $map_address_code = explode(',',$map_address);

        $code   =   [
            'site_id'           =>  $g_siteid,//权限者id
            'account_id'        =>  $g_account['account_id'],//用户id
            'title'             =>  $title,//资源名称
            'en_title'          =>  req('en_title'),//资源英文名称
            'other_title'       =>  req('other_title'),//资源其他名称
            'map_address'       =>  $map_address,//坐标点
            'address'           =>  $address,//地址详细信息
            'address_code'      =>  Get_implode($address_id),//地址详细信息
            'city'              =>  req('city'),//市
            'type'              =>  $type,//资源类型：1 餐饮 2 游览（景点） 3 购物 4 娱乐
            'label'             =>  Get_implode($label_id),//标签 用 ,分割
            'phone'             =>  req('phone'),//联系号码
            'official_web'      =>  req('official_web'),//官网
            'opening_hours'     =>  req('opening_hours'),//开放时间
            'consumption'       =>  req('consumption'),//消费详情
            'traffic'           =>  req('traffic'),//交通信息
            'time_reference'    =>  req('time_reference'),//交通耗时
            'introduction'      =>  req('introduction'),//简介
            'guide'             =>  req('guide'),//资源指南
            'update_time'       =>  time(),//添加时间
            'addtime'           =>  time(),//添加时间
            'heat'              =>  0,//热度
            'number'            =>  0,//引入次数
            'status'            =>  1,//用户上传
            'superior_id'       =>  req('superior_id'),//更替id
            'lng'       =>  $map_address_code[0],//更替id
            'lat'       =>  $map_address_code[1],//更替id
        ];
        $mysql_resources_name =   't_resources';
        $mysql_resources_price_name =   GetTableName('t_resources_user_price');
        $price_list =   req('price_list');
        $resources_id    =   Get_picture($key_id,$mysql_resources_name);
        if($resources_id == 0){
            $resources_id    =   add_detail($code,'t_resources');
        }else{
            unset($code['addtime'],$code['heat'],$code['number'],$code['status'],$code['superior_id'],$code['site_id'],$code['account_id']);
            $resources_id    =   updata_detail($code,$mysql_resources_name,$resources_id);
        }
        if(!$resources_id){
            throw new Exception(code::SYSTEM_ERROR);
        }else{

            if($price_list){
                $price  =   $this->add_price_list($price_list,$resources_id,$mysql_resources_price_name);
                $this->edit_price($price,$resources_id,$mysql_resources_name);
            }
            return success(['time'  =>   date('Y-m-d H:i:s',time()),'key_id'=>$resources_id,'code'=>$code],code::OPERATION_SUCCESSFUL);
        }

    }

    /**
     *  编辑之前的数据  不覆盖原始数据
     * @return string
     * @throws Exception
     */
    public function template(){
        global $g_siteid,$g_account;
        $default   =   req('default');
        $resources_id   =   req('key_id');
        $verification   =   [
            [$resources_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name =   't_resources';
        $code   =   [
            'default'           =>  $default,
            'update_time'       =>  time(),//添加时间
        ];
        $resources_id    =   Get_picture($resources_id,$mysql_resources_name);
        if(!$resources_id){
            return error(code::PARAMETER_ERROR);

        }
        $resources_id    =   updata_detail($code,$mysql_resources_name,$resources_id);

        if(!$resources_id){
            throw new Exception(code::SYSTEM_ERROR);
        }else{
            return success(['time'  =>   date('Y-m-d H:i:s',time())],code::SUCCESSFULLY_SET);
        }

    }


    /**
     *  新增模版信息
     * @return string
     * @throws Exception
     */
    public function template_add(){
        global $g_siteid,$g_account;
        $name   =   req('name');
        $title   =   req('title');
        $resources_id   =   req('superior_id');
        $verification   =   [
            [$name,code::PARAMETER_ERROR,'required'],
            [$resources_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'site_id'           =>      $g_siteid,
            'account_id'        =>      $g_account['account_id'],
            'status'            =>      0,
            'superior_id'       =>      $resources_id,
            'name'              =>      $name,
            'title'              =>      $title,
            'update_time'       =>      time(),//添加时间
        ];
        $mysql_name   =   GetTableName('t_resources_template');

        $resources_id    =   add_detail($code,$mysql_name);

        if(!$resources_id){
            throw new Exception(code::SYSTEM_ERROR);
        }else{
            return success(['key_id'=>$resources_id,'time'  =>   date('Y-m-d H:i:s',time())],code::SUCCESSFULLY_SET);
        }

    }

    /**
     *  添加新的资源信息
     * @return string
     * @throws Exception
     */
    public function hotel_add(): string
    {
        global $g_siteid,$g_account;
        $title   =   req('title');
        $address   =   req('address');
        $label   =   req('label');
        $map_address  =   req('map_address');
//        $map_address    =   0;
        $address_code    =   req('address_code');
        $facilities    =   req('facilities_s');
        $type  =   req('type');
        $key_id  =   req('key_id');
        $verification   =   [
            [$title,code::RESOURCE_NAME,'required'],
            [$address,code::RESOURCE_ADDRESS,'required'],
            [$address_code,code::RESOURCE_ADDRESS,'required'],
//            [$map_address,code::RESOURCE_ADDRESS.'02','required'],
            [$type,code::NATURAL_RESOURCES.'|'.code::NATURAL_PARAMETER_ERROR,'required|numeric'],
        ];

        (new check())->set_code($verification);
        $label_id   =   Get_list_flied($label);
        $address_id   =   Get_list_flied($address_code);

        $code   =   [
            'site_id'           =>  $g_siteid,//权限者id
            'account_id'        =>  $g_account['account_id'],//用户id
            'title'             =>  $title,//资源名称
            'en_title'          =>  req('en_title'),//资源英文名称
            'other_title'       =>  req('other_title'),//资源其他名称
            'map_address'       =>  $map_address,//坐标点
            'address'           =>  $address,//地址详细信息
            'address_code'      =>  Get_implode($address_id),//地址详细信息
            'city'              =>  req('city'),//市
            'type'              =>  $type,//资源类型：1 餐饮 2 游览（景点） 3 购物 4 娱乐
            'label'             =>  Get_implode($label_id),//标签 用 ,分割
            'phone'             =>  req('phone'),//联系号码
            'official_web'      =>  req('official_web'),//官网
            'opening_hours'     =>  req('opening_hours'),//开放时间
            'consumption'       =>  req('consumption'),//消费详情
            'traffic'           =>  req('traffic'),//交通信息
            'time_reference'    =>  req('time_reference'),//交通耗时
            'introduction'      =>  req('introduction'),//简介
            'guide'             =>  req('guide'),//资源指南
            'update_time'       =>  time(),//添加时间
            'addtime'           =>  time(),//添加时间
            'heat'              =>  0,//热度
            'number'            =>  0,//引入次数
            'status'            =>  1,//用户上传
            'superior_id'       =>  req('superior_id'),//更替id
            'rating'            =>  req('rating'),//评级
            'facilities'        =>  Get_implode($facilities),//shechi
            'policy'            =>  req('policy'),//政策
        ];
        $mysql_resources_name =   't_resources_hotel';
        $mysql_resources_price_name =   GetTableName('t_resources_hotel_user_price');
        $price_list =   req('price_list');
        $resources_id    =   Get_picture($key_id,$mysql_resources_name);
        if($resources_id == 0){
            $resources_id    =   add_detail($code,$mysql_resources_name);
        }else{
            unset($code['addtime'],$code['heat'],$code['number'],$code['status'],$code['superior_id'],$code['site_id'],$code['account_id']);
            $resources_id    =   updata_detail($code,$mysql_resources_name,$resources_id);
        }
        if(!$resources_id){
            throw new Exception(code::SYSTEM_ERROR);
        }else{


            if($price_list){
                $min_money  =   0;
                $price_list_min =   array_column($price_list,'value');
                $price_list_min   =   array_filter($price_list_min);
                if($price_list_min){
                    $min_money  =   min($price_list_min);
                }
                $price  =   $this->add_price_list($price_list,$resources_id,$mysql_resources_price_name);
                $this->edit_price($price,$resources_id,$mysql_resources_name,", `min_money` =   '".$min_money."'");
            }
            return success(['time'  =>   date('Y-m-d H:i:s',time()),'key_id'=>$resources_id],code::OPERATION_SUCCESSFUL);
        }

    }


    /**
     *  编辑之前的数据  不覆盖原始数据
     * @return string
     * @throws Exception
     */
    public function template_hotel(){
        global $g_siteid,$g_account;
        $default   =   req('default');
        $resources_id   =   req('key_id');
        $verification   =   [
            [$resources_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $mysql_resources_name =   't_resources_hotel';
        $code   =   [
            'default'           =>  $default,
            'update_time'       =>  time(),//添加时间
        ];
        $resources_id    =   Get_picture($resources_id,$mysql_resources_name);
        if(!$resources_id){
            return error(code::PARAMETER_ERROR);

        }
        $resources_id    =   updata_detail($code,$mysql_resources_name,$resources_id);

        if(!$resources_id){
            throw new Exception(code::SYSTEM_ERROR);
        }else{
            return success(['time'  =>   date('Y-m-d H:i:s',time())],code::SUCCESSFULLY_SET);
        }

    }


    /**
     *  新增模版信息
     * @return string
     * @throws Exception
     */
    public function template_hotel_add(){
        global $g_siteid,$g_account;
        $name   =   req('name');
        $title   =   req('title');
        $resources_id   =   req('superior_id');
        $verification   =   [
            [$name,code::PARAMETER_ERROR,'required'],
            [$resources_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'site_id'           =>      $g_siteid,
            'account_id'        =>      $g_account['account_id'],
            'status'            =>      0,
            'superior_id'       =>      $resources_id,
            'name'              =>      $name,
            'title'              =>      $title,
            'update_time'       =>      time(),//添加时间
        ];
        $mysql_name   =   GetTableName('t_resources_hotel_template');

        $resources_id    =   add_detail($code,$mysql_name);

        if(!$resources_id){
            throw new Exception(code::SYSTEM_ERROR);
        }else{
            return success(['key_id'=>$resources_id,'time'  =>   date('Y-m-d H:i:s',time())],code::SUCCESSFULLY_SET);
        }

    }

    /**
     *  删除poi信息
     * @return string
     * @throws Exception
     */
    public function DelResource():string{
        global $g_siteid,$g_account;
        $key_id  =   req('key_id');

        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'state'           =>      1,
            'update_time'           =>      time(),
        ];
        $mysql_resources_name =   't_resources';


        updata_detail($code,$mysql_resources_name,$key_id);


        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }

    /**
     *  删除酒店信息
     * @return string
     * @throws Exception
     */
    public function Delhotel():string{
        global $g_siteid,$g_account;
        $key_id  =   req('key_id');

        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'state'           =>      1,
            'update_time'           =>      time(),
        ];
        $mysql_resources_name =   't_resources_hotel';


        updata_detail($code,$mysql_resources_name,$key_id);


        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }
    /**
     *  删除活动信息
     * @return string
     * @throws Exception
     */
    public function DelActivities():string{
        global $g_siteid,$g_account;
        $key_id  =   req('key_id');

        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'state'           =>      1,
            'updata_time'           =>      time(),
        ];
        $mysql_name   =   GetTableName('t_resources_activities');


        updata_detail($code,$mysql_name,$key_id);


        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }
    /**
     *  删除城市名称
     * @return string
     * @throws Exception
     */
    public function DelCity():string{
        global $g_siteid,$g_account;
        $key_id  =   req('key_id');

        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'state'           =>      1,
            'update_time'           =>      time(),
        ];
        $mysql_name   =   GetTableName('t_resources_city');


        updata_detail($code,$mysql_name,$key_id);


        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }
    /**
     *  删除亮点信息
     * @return string
     * @throws Exception
     */
    public function DelTrip():string{
        global $g_siteid,$g_account;
        $key_id  =   req('key_id');

        $verification   =   [
            [$key_id,code::PARAMETER_ERROR,'required'],
        ];
        (new check())->set_code($verification);
        $code   =   [
            'state'           =>      1,
            'update_time'           =>      time(),
        ];
        $mysql_name   =   GetTableName('t_resources_wonderful');
        updata_detail($code,$mysql_name,$key_id);


        return success(['time'  =>   date('Y-m-d H:i:s',time())],code::DELETE_SUCCESSFUL);

    }

    /*     操作方法-----开始线---------     */




    /**
     *  添加资源消费信息
     * @param array $data
     * @param int $key_id
     * @return float
     */
    private function add_price_list($data   =   array(),$key_id =   0,$key  =   ''):float
    {
        $price  =   0;

        $del_sql = " DELETE FROM `".$key."` WHERE resources_id = '".$key_id."'";
        $this->mysql->query($del_sql);
        foreach ($data as $item){
            if($item['title']){
                if(!$item['value']){
                    $item['value']  =   0;
                }
                $price  =   $price+(float)$item['value'];
                $sql    =   "INSERT INTO `".$key."`( `title`, `price`, `resources_id`) VALUES ('".$item['title']."', ".(float)$item['value'].", ".$key_id.");";
                $this->mysql->query($sql);
            }
        }
        return $price;
    }

    /**
     *  修改资源总消费信息
     * @param float $data
     * @param int $key_id
     * @return bool
     */
    private function edit_price($price  =   0.00,$key_id =   0,$key = '',$additional    =   ''):bool
    {
        $sql    =   "UPDATE `".$key."` SET `price` = '".$price."' ".$additional." WHERE `id` = '".$key_id."';";
        return $this->mysql->query($sql);
    }

}


$data       =   new resource();
$data->mysql    =   $db;
$data->mysql->startTrans();

try{
    $list       =   req('list') ?? 'name';
    $list_code  =   array('add','template','template_add','hotel_add','hotel_updata_add','template_hotel_add','template_hotel','DelResource','Delhotel','DelActivities',
        'DelCity','DelTrip');
    if(!in_array($list,$list_code)){
        throw new Exception(code::INTERFACE_ADDRESS_ERROR);
    }
    echo $data->$list();
    $data->mysql->commit();
} catch (Exception $e){
    $data->mysql->rollback();
    echo error('错误信息：'.$e->getMessage());
}


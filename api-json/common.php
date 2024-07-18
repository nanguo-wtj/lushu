<?



 
function upload_image($fn, $upload_dir='', $fname=''){
    global $g_site_root;
	$img = $fn;
	if($img!=""){
		$img_temp = $img['tmp_name'];

        $this_file_size = filesize($img_temp) / 1024;

        if ($this_file_size > 2000) {
            echo error('单个图片/附件不得超过2000KB');
            return ;
        }
        //获取后缀
        $img_type = pathinfo($img['name'], PATHINFO_EXTENSION);

		if($img_type == "jpg" || $img_type == "jpeg" || $img_type == "swf" || $img_type == "gif" || $img_type == "png"){
			if($fname==''){
                $upfile_path = date('Ymdhis') . mt_rand(10000, 99999) . "." . $img_type;
			} else {
				$upfile_path = $fname;
			}


			if(file_exists($upload_dir)==false){
                mkdir($upload_dir, 0777,true);
			}

			move_uploaded_file($img_temp, $upload_dir.$upfile_path);  

		} else {
            echo error('图片格式不正确');
		}
	}  
	return $upfile_path;
}

function get_ym_upfile($field_name){

    global $g_site_root, $g_siteid, $yyyymm;

    $upload_dir = "$g_site_root/upfiles/$g_siteid/$yyyymm/";

    $image_path = upload_image($field_name, $upload_dir);

    if($image_path!=''){
        $image_path = "$yyyymm/$image_path";
    }

    return $image_path;
}
/**
 * 随机16位字符串
 * @param mixed $num int 随机的字符数量
 * @author  wtj
 * @return string
 */
function GetString($num    =   16):string
{
    $chars ="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $str ="";
    for ($i = 0; $i < $num; $i++) {
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    return $str;
}
/**
 * 数字前使用0补位
 * https://www.php.cn/php-ask-493540.html
 * @param mixed $num int 需要补足的数字
 * @param mixed $key int 补足至多少位
 * @author  未知
 * @return int
 */
function Complement($num    =   0,$key   =   2):string
{
    $b  =   str_pad($num,$key,"0",STR_PAD_LEFT);
    return $b;
}
/**
 * 获取用户信息
 * @param mixed $flied string 查询的字段
 * @param mixed $user_name string 查询的用户账号
 * @return array
 */
function Get_userdata($flied    =   'account_id',$user_name =   ''):array
{
    global $g_siteid,$db;
    $sql = "SELECT ".$flied." FROM `t_admin` WHERE `site_id`='$g_siteid'  AND `account`='".$user_name."' ";
    $code   =   $db->get_one($sql);
    if(!$code){
        $code   =   [];
    }
    return $code;
}
/**
 * 根据用户id获取用户信息
 * @param mixed $flied string 查询的字段
 * @param mixed $user_name string 查询的用户账号
 * @return array
 */
function Get_userdata_id($flied    =   'account_id',$account_id =   ''):array
{
    global $g_siteid,$db;
    if($account_id == 0){
        $sql = "SELECT ".$flied." FROM `t_admin` WHERE `site_id`='$g_siteid'  AND `account_id`= 1 ";
        $code   =   $db->get_one($sql);
    }else{
        $sql = "SELECT ".$flied." FROM `t_admin` WHERE `site_id`='$g_siteid'  AND `account_id`='".$account_id."' ";
        $code   =   $db->get_one($sql);
    }

    return $code;
}
/**
 * 添加用户
 * @param mixed $account string 用户账号
 * @param mixed $password string 密码
 * @param mixed $name string 用户名称
 * @return int
 */
function Add_user($account  =   '',$password    =   '',$name    =   ''):int
{
    global $db,$g_siteid,$ymdhis;
    $password   =   md5($password);
    $sql = "INSERT INTO `t_admin` ".
        "(`site_id`, `account`, `password`, `username`, `email` , `role`, `state`, `addtime` , `is_admin`)".
        " VALUES ".
        "('$g_siteid', '$account', '$password', '$name', '$account', '1', '1', '$ymdhis', '0')";
    $add_id =   $db->query($sql);
    return $add_id;
}

/**
 * 添加用户
 * @param mixed $account string 用户账号
 * @param mixed $password string 密码
 * @param mixed $name string 用户名称
 * @return string
 */
function update_login_user($account_id  =   ''):string
{
    global $db,$g_siteid,$ymdhis;
//    $ymdhis = date('Y-m-d H:i:s');
    $ymdhis = time();
    $sso_key = md5('CLOOTA_ADMIN'.$ymdhis. $account_id);

    if(PROGRAM_ENCRYPTION == true) {
        $sso_key = Set_data_rsa($account_id);
    }
    $sql = "UPDATE `t_admin` SET `sso_key`='$sso_key', `sso_time`='$ymdhis' WHERE `site_id`='$g_siteid' AND `account_id`='" . $account_id . "'";
    if(!$db->query($sql)){
        return  false;
    }
    return  $sso_key;
}

/**
 * 权限判断
 * $Unrestricted     不受限接口地址
 * $constrained      需要登录的接口
 * @param mixed $url string 提交的接口地址
 * @return bool
 */
function Verify_Permissions($url    =   ''):bool
{
    global $g_account;
    $Unrestricted   =   array('login','register','open_view');
    $constrained    =   array(
        'home','project','resource','resource_img','resource_note','resource_city',
        'resources_wonderful','tool','resource_traffic','resource_activities',
        'resource_list','Logout','project_list','label','resource_details',
        'resource_edit','project_auxiliary','user','project_information','project_quotation','Download',
        'project_export','export','export_information','export_quotation','recyclebin','message'
    );
    $array_list =   array_merge($Unrestricted,$constrained);
    if(!in_array($url,$array_list)){
        return false;
    }
    if(in_array($url,$constrained)){
        if(!$g_account){
            return  false;
        }
    }

    return  true;
}


/**
 * 权限判断  查看接口是否存在

 * @param mixed $url string 提交的接口地址
 * @param mixed $key string 接口地址总和
 * @return bool
 */
function Get_in_interface($url    =   '',$key   =   array()):bool
{
    if(!in_array($url,$key)){
        return false;
    }
    return  true;
}
/**
 *  获取项目数量
 *  根据是否完成分组
 * @return array
 */
function Get_project_count():array
{
    global $g_siteid,$db,$g_account;
    $sql = "SELECT count(*) as number,`is_sale` FROM `t_project` WHERE `account_id`='".$g_account['account_id']."'  and  `is_delete` = 0 GROUP BY is_sale";
//    echo $sql;
    $code   =   $db->get_all($sql);
    return $code;
}
/**
 *  获取项目数量
 *  根据是否完成分组
 * @return array
 */
function Get_project_count_day($time1   =   0,$time2    =   0):array
{
    global $g_siteid,$db,$g_account;
    $sql = "SELECT count(*) as number,`is_sale` FROM `t_project` WHERE `account_id`='".$g_account['account_id']."'  and  `is_delete` = 0 and update_time BETWEEN  ".$time1." and ".$time2." GROUP BY is_sale";
    $code   =   $db->get_all($sql);
    if(!$code){
        return [];
    }
    return $code;
}

/**
 *  获取数据是否存在数组中
 * @return string
 */
function Get_in_array($data =   '',$key_array   =   [],$msg =   1,$nomsg   =   0):int
{
    if(in_array($data,$key_array)){
        return  $msg;
    }
   return $nomsg;
}

/**
 * 返回当前时间前7天时间
 * @return array
 */
function  GetDay7():array
{
    $time = time();
    $Day    =   [];
    for ($i=6;$i>=1;$i--){
        $Day[]  =   date('Y-m-d',($time-(86400*$i)-1));
    }
    $Day[]    =   date('Y-m-d',$time);

    return  $Day;
}


/**
 *  添加项目  -  根据项目名称 新建项目
 * @return int
 */
function Add_project_detail($project_name =   ''):int
{
    global $g_siteid,$db,$g_account;
    $sql = "INSERT INTO `edu_lushu`.`t_project`(`project_name`, `site_id`, `account_id`)".
        "VALUES".
        " ('".$project_name."', '".$g_siteid."', '".$g_account['account_id']."');";
    $add_id =   $db->query($sql);
    return $add_id;
}




/**
 *  加密内容  -  根据键值加密  rsa加密
 * @return string
 */
function Set_data_rsa($data =   ''):string
{
    global $Rsa;
    if(PROGRAM_ENCRYPTION == true){
        $Rsa->OperationalData   =   $data;
        $code   =   $Rsa->encryption();
    }else{
        $code   =   trim($data);
    }
    return $code;
}



/**
 *  获取加密内容  -  根据秘钥解析内容  rsa加密
 * @return string
 */
function Get_data_rsa($data =   ''):string
{
    global $Rsa;
    if(PROGRAM_ENCRYPTION == true){
        $Rsa->OperationalData   =   $data;
        $code   =   $Rsa->decrypt();
    }else{
        $code   =   trim($data);
    }
    return $code;
}





/**
 *  查询项目是否存在
 * @param int $key_id
 * @return bool
 */
 function Get_status_project($key_id =   0):bool
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT id  FROM `t_project` WHERE `id` = '".$key_id."' and  `site_id`='$g_siteid'  ";
    $code   =   $db->get_one($sql);
    if($code){
        return  true;
    }
    return false;
}


/**
 *  查询项目是否存在
 * @param int $key_id
 * @return bool
 */
function Get_status_project_export($key_id =   0):bool
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT id  FROM `t_export_project` WHERE `id` = '".$key_id."' and  `site_id`='$g_siteid'  ";
    $code   =   $db->get_one($sql);
    if($code){
        return  true;
    }
    return false;
}

/**
 *  查询项目第几步流程
 * @param int $key_id
 * @return int
 */
 function Get_status($key_id =   0):int
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT is_status  FROM `t_project` WHERE `id` = '".$key_id."' and  `site_id`='$g_siteid'   ";
    $code   =   $db->get_value($sql);

    return $code;
}
/**
 *  查询项目第几步流程
 * @param int $key_id
 * @return int
 */
 function Get_status_export($key_id =   0):int
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT is_status  FROM `t_export_project` WHERE `id` = '".$key_id."' and  `site_id`='$g_siteid'   ";
    $code   =   $db->get_value($sql);

    return $code;
}




/**
 *  查询项目第几步流程
 * @param int $key_id
 * @return array
 */
function Get_project($key_id =   0,$felid   =   'is_status'):array
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT ".$felid."  FROM `t_project` WHERE `id` = '".$key_id."' and  `site_id`='$g_siteid' and `is_delete` = 0   ";
    $code   =   $db->get_one($sql);
    if(!$code){
        return [];
    }
    return $code;
}



/**
 *  查询项目第几步流程
 * @param int $key_id
 * @return array
 */
function Get_project_export($key_id =   0,$felid   =   'is_status'):array
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT ".$felid."  FROM `t_export_project` WHERE `id` = '".$key_id."' and  `site_id`='$g_siteid'   ";
    $code   =   $db->get_one($sql);
    return $code;
}



/**
 *  查询资源是否被重置
 * @param int $key_id
 * @return int
 */
function Get_resource($key_id =   0,$key    =   't_resources_user'):int
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT id  FROM `".$key."` WHERE `superior_id` = '".$key_id."'  and `account_id` =  '".$g_account['account_id']."'";
    $code   =   $db->get_one($sql);
    if($code){
        return  $code['id'];
    }
    return 0;
}
/**
 *  查询资源是否存在
 * @param int $key_id
 * @return int
 */
function Get_picture($key_id =   0,$key    =   't_resources_user'):int
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT id  FROM `".$key."` WHERE `id` = '".$key_id."'  and `account_id` =  '".$g_account['account_id']."'";
    $code   =   $db->get_one($sql);
    if($code){
        return  $code['id'];
    }
    return 0;
}


/**
 *  查询资源是否被重置
 * @param int $key_id
 * @return int
 */
function Get_resource_hotel($key_id =   0):int
{
    global $db,$g_siteid,$g_account;
    $sql = "SELECT id  FROM `t_resources_hotel_user` WHERE `superior_id` = '".$key_id."'  and `account_id` =  '".$g_account['account_id']."'";
    $code   =   $db->get_one($sql);
    if($code){
        return  $code['id'];
    }
    return 0;
}
/**
 *  添加资源詳細信息
 * @param array $data
 * @return int
 */
 function add_detail($data   =   array(),$key    =   ''):int
{
    global $g_siteid,$g_account,$db;
    $key_list   =   [];
    $value_list =   [];
    foreach ($data as $idnex=>$item){
        $key_list[] =   '`'.$idnex.'`';
        $value_list[] =   "'".trim($item)."'";
    }
    $sql = "INSERT INTO `".$key."`".
        "(".implode(',',$key_list).")".
        " VALUES ".
        "(".implode(',',$value_list).");";
    $add_id =   $db->query($sql);
    return $add_id;
}
/**
 *  修改资源詳細信息
 * @param array $data
 * @return int
 */
 function updata_detail($data   =   array(),$key    =   '',$key_id   =   0):int
{
    global $g_siteid,$g_account,$db;
    $sql = "UPDATE `".$key."` SET ";
    $code   =   [];
    foreach ($data as $idnex=>$item){
        $code[] = " `".$idnex."` = '" . trim($item) . "'" ;
    }
    $sql .= implode(',',$code);
    $sql .=   " WHERE `id` = '".$key_id."';";
    $db->query($sql);
    return $key_id;
}
/**
 *  修改资源詳細信息  可自定义修改依据
 * @param array $data
 * @return int
 */
function updata_detail_custom($data   =   array(),$key    =   '',$key_id   =   0):int
{
    global $g_siteid,$g_account,$db;
    $sql = "UPDATE `".$key."` SET ";
    $code   =   [];
    foreach ($data as $idnex=>$item){
        $code[] = " `".$idnex."` = '" . trim($item) . "'" ;
    }
    $sql .= implode(',',$code);
    $mysql_key  =   [];
    foreach ($key_id as $item){
        $mysql_key[]  =   "`".$item[0]."` =  '".$item[1]."'";
    }
    $sql .=   " WHERE ".implode(' and ',$mysql_key);
    $db->query($sql);
    return 1;
}

/**
 *  修改资源詳細信息  可自定义修改依据
 * @param string $data
 * @return int
 */
function updata_detail_all($data   =   '',$key    =   '',$where   =   0):int
{
    global $g_siteid,$g_account,$db;
    $sql = "UPDATE `".$key."` SET ";
    $sql .= $data;
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql .=   $sql_where;
    $db->query($sql);
    return 1;
}

/**
 *  修改资源詳細信息
 * @param array $data
 * @return int
 */
function updata_detail_codeall($data   =   array(),$key    =   '',$where   =   array()):int
{
    global $g_siteid,$g_account,$db;
    $sql = "UPDATE `".$key."` SET ";
    $code   =   [];
    foreach ($data as $idnex=>$item){
        $code[] = " `".$idnex."` = '" . trim($item) . "'" ;
    }
    $sql .= implode(',',$code);
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql .=   $sql_where;
    $db->query($sql);
    return 1;
}

/**
 *  修改资源詳細信息
 * @param array $data
 * @return string
 */
function GetTableName($key    =   '',$type  =   0):string
{
    global $g_account;
    if(WHETHER_TO_DIVIDE_THE_TABLE == true){
        if($type > 0){
            $user_key   =   $type%3+1;
        }else{
            $user_key   =   $g_account['account_id']%3+1;
        }
        if($user_key ==  1){
            $user_key   =   $key;
        }else{
            $user_key   =   $key.'_'.$user_key;
        }
    }else{
        $user_key   =   $key;
    }
    return $user_key;
}
/**
 *  修改资源詳細信息
 * @param array $data
 * @return string
 */
function Getaddress_id($key    =   ''):string
{
    global $g_account;
    if(WHETHER_TO_DIVIDE_THE_TABLE == true){
        $user_key   =   $key.'_1';
    }else{
        $user_key   =   $key;
    }
    return $user_key;
}



/**
 *  根据地址名称搜索地址信息
 * @param array $address
 * @return array
 */
function Get_address($address    =   '',$sql_name   =   '',$key =   true):array
{
    global $g_siteid,$db;
    $fileld =   '';
    if($key == false){
        $fileld =   ',`account_id`';
    }
    $sql = "SELECT `id`,`region_name`,`en_name`,`coordinate`,`parent_id`,`lng`,`lat`".$fileld."  FROM `".$sql_name."` WHERE `site_id` = '".$g_siteid."' and  level = 2 and (region_name like '%".$address."%'  or  en_name like '%".$address."%') LIMIT 0,10";
    $code   =   $db->get_all($sql);
    if(!$code){
        return  [];
    }
    return $code;
}

/**
 *  根据地址名称搜索地址信息
 * @param array $address
 * @return array
 */
function Get_address_user($address    =   '',$sql_name   =   '',$key =   true):array
{
    global $g_account,$db;
    $fileld =   '';
    if($key == false){
        $fileld =   ',`account_id`';
    }
    $sql = "SELECT `id`,`region_name`,`en_name`,`coordinate`,`parent_id`,`lng`,`lat`".$fileld."  FROM `".$sql_name."` WHERE `account_id` = '".$g_account['account_id']."' and (region_name like '%".$address."%'  or  en_name like '%".$address."%') LIMIT 0,10";
    $code   =   $db->get_all($sql);
    if(!$code){
        return  [];
    }
    return $code;
}





/**
 *  根据地址名称搜索地址信息
 * @param array $address
 * @return array
 */
function Get_parent_name($id    =   '',$sql_name   =   '',$key =   true):array
{
    global $g_siteid,$db;
    $fileld =   '';

    $sql = "SELECT `region_name`,`en_name`  FROM `".$sql_name."` WHERE id = '".$id."' and `site_id` = '".$g_siteid."' ";
    $code   =   $db->get_one($sql);
    if(!$code){
        return  [];
    }
    return $code;
}


/**
 *  PIO分库
 * @param array $where  搜索条件
 * @return array
 */
function Get_Resources_list($where   =   array(),$felid =   array(),$mysql_name =   't_resources',$desc =   'id desc',$page = 0):array
{
    global $db,$g_account;
    $felid  =   implode(',',$felid);
    $where['account_id']    =   $g_account['account_id'];
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc."  LIMIT ".$page.",".NUMBER_PAGES;
    $code   =   $db->get_all($sql);

    $str    =   [];
    foreach ($code as $item){
        $address    =   Get_cityname_array(explode(',',$item['address_code']));
        $label    =   Get_label(explode(',',$item['label']));
        $time   =   Get_day_time($item['update_time']);
        $picture_name   =   GetTableName('t_resources_img');
        $str[]  =   [
            'id'            =>  $item['id'],
            'title'         =>  $item['title'],
            'en_title'      =>  $item['en_title'],
            'other_title'   =>  $item['other_title'],
            'address'       =>  $address,
            'type'          =>  Get_type(1,$item['type']),
            'label'         =>  $label,
            'img'           =>  '',
            'user'          =>  Get_userdata_id('account',$g_account['account_id'])['account'],
            'time'          =>  $time,
            'picture_id'    =>  $item['picture_id'],
            'picture'       =>  Get_details_value($item['picture_id'],'url',$picture_name)
        ];
    }

    return $str;
}
/**
 *  PIO分库
 * @param array $where  搜索条件
 * @return array
 */
function Get_Resources_list_join($where   =   array(),$felid =   array(),$mysql_name =   't_resources',$desc =   'id desc',$page = 0):array
{
    global $db,$g_account;
    $felid  =   implode(',',$felid);
    $where['account_id']    =   $g_account['account_id'];
    $address    =   $where['b.address'];
    $label      =   $where['c.label'];
    $sql_where  =   Get_Where($where);
    $sql    = "SELECT a.id,a.title,a.en_title,a.other_title,a.address,a.type,a.label,a.update_time FROM `t_resources`  as a ";
    if($address){
        $sql    .=  " LEFT JOIN t_address as b on b.resources_id = a.id";
    }
    if($label){
        $sql    .=  " LEFT JOIN t_labels as c on c.resources_id = a.id";
    }
    $sql    .=  "   ".$sql_where." ORDER BY	a.update_time DESC LIMIT 0,24";

    $code   =   $db->get_all($sql);
    $str    =   [];
    foreach ($code as $item){
        $str[]  =   [
            'id'            =>  $item['id'],
            'title'         =>  $item['title'],
            'en_title'      =>  $item['en_title'],
            'other_title'   =>  $item['other_title'],
            'address'       =>  explode(',',$item['address']),
            'type'          =>  Get_type(1,$item['type']),
            'label'         =>  explode(',',$item['label']),
            'user'          =>  Get_userdata_id('account',$g_account['account_id'])['account'],
            'time'          =>  date('Y-m-d H:i:s',$item['update_time'])
        ];
    }

    return $str;
}

/**
 *  获取资源类型
 * @param array $type  搜索条件
 * @return string
*/
function Get_type($type =   0,$id   =   0):string
{
    global $db;
//    $sql = "SELECT `transportation`  FROM `t_transportation` WHERE   `id` =  '".$id."' and `type` =  '".$type."'";
//    $code   =   $db->get_value($sql);
    $code   =   '';
    switch ($id){
        case 1:
            $code   =   '餐饮';
            break;
        case 2:
            $code   =   '游览';
            break;
        case 3:
            $code   =   '购物';
            break;
        case 4:
            $code   =   '娱乐';
            break;
        case 5:
            $code   =   '住宿';
            break;
        case 6:
            $code   =   '交通';
            break;

    }
    return $code;
}
/**
 *  搜索条件转换
 * @param array $where  搜索条件
 * @return string
 */
function Get_Resources_ids($key =   't_resources',$felid   =   'superior_id'):string
{
    global $db,$g_account;
    $mysql_name =   GetTableName($key);

    $sql = "SELECT `".$felid."`  FROM `".$mysql_name."` WHERE   `account_id` =  '".$g_account['account_id']."'";
    $code   =   $db->get_all($sql);
    $str    =   [];
    foreach ($code as $item){
        $str[]  =   $item['superior_id'];
    }
    return implode(',',$str);
}


/**
 *  搜索条件转换
 * @param array $where  搜索条件
 * @return string
 */
function Get_Where($where   =   array(),$debug  =   true):string
{
    $str    =   [];
    foreach ($where as $index=>$item){
        if($debug == false){
            var_dump($item);
        }
        if(!is_array($item)){
            if(is_null($item)){
                continue;
            }
            $str[]    =  " `".$index."` = '".$item."'";
        }else{
            $type   =   $item[0];
            $data   =   $item[1];


            if(!$data){
                continue;
            }
            if(is_array($data)){
                if(!$data[0] && $type != 'BETWEEN'){
                    continue;
                }
            }

            switch ($type){
                case 'or':
                    if(is_array($data)){
                        if($data[1] == 'like'){
                            $str[]    =  " (`".$index."` like '%".$data[0]."%'  or  `".$data[2]."`  =  '%".$data[0]."%' )";
                        }else{
                            $str[]    =  " (`".$index."` = '".$data[0]."'  or  `".$data[2]."`  =  '".$data[0]."')";
                        }
                    }
                    break;
                case 'in_set':
                     if(is_array($data)){
                         $str[]    =  " find_in_set('".$data['0']."',".$index.")";
                     }else{

                         $str[]    =  " find_in_set('".$data."',".$index.")";
                     }
                     break;
                case 'like':
                    $str[]    =  " `".$index."` like '%".$data."%'";
                    break;
                case 'in':
                    $str[]    =  " `".$index."` in  (".$data.")";
                    break;
                case '>':
                    $str[]    =  " `".$index."` >  '".$data."'";
                    break;
                case '<':
                    $str[]    =  " `".$index."` <  '".$data."'";
                    break;
                case 'BETWEEN':
                    if($data[1]){
                        $str[]    =  " ( `".$index."` BETWEEN  ".$data[0]."  and ".$data[1]." ) ";
                    }
                    break;
            }
        }
    }

    $code   =   '';
    if($str){
        $code    =   ' WHERE '.implode(' and ',$str);
    }
    return $code;
}



function Add_address($list  =   array()){

}

function Get_cityname_array($list =   '',$status    =   true,$key_id    =   0){
    global $db;
    $code   =   [];
    $list   =   array_filter($list);
    if($status == true){
        foreach ($list as $item){
            $code[]   =   Get_cityname($item,$status,$key_id);
        }
    }else{
        if($list){
            foreach ($list as $index=>$item){
                $code[$index]['id']   =   $item;
                $code[$index]['value']   =   Get_cityname($item,$status,$key_id);
            }
        }

    }
    return $code;
}

function Get_cityname($key_id = 0,$status   =   true,$type    =   0){
    global $db;
    if(!$key_id){
        return  '';
    }
    if(is_numeric($key_id)){
        $sql = "SELECT `id`,`region_name`,`parent_id`  FROM `t_city` WHERE   `id` =  '".$key_id."' ";
        $code   =   $db->get_one($sql);
    }else{
        $key_id =   substr_replace($key_id, '', 0,2);
        $mysql_name   =   GetTableName('t_resources_city',$type);
        $sql = "SELECT `id`,`region_name`,`parent_id`  FROM `".$mysql_name."` WHERE   `id` =  '".$key_id."' ";
        $code   =   $db->get_one($sql);
    }
    $parentName =   '';
    if($code['parent_id'] && $status == true){
        $parentName =   Get_cityname($code['parent_id']).'>';
    }
    return $parentName.$code['region_name'];
}


function Get_association_array($list =   '',$sql_name    =   '',$filed  =   'title'){
    global $db;
    $list   =   array_filter($list);
    $code   =   [];
    foreach ($list as $item){
        $str   =   Get_association_name($item,$sql_name,$filed);
        if($str){
            $code[] =   $str;
        }
    }

    return $code;
}

function Get_association_name($key_id = 0,$sql_name   =   '',$filed  =   'title'){
    global $db;
    $sql = "SELECT ".$filed."  FROM `".$sql_name."` WHERE   `id` =  '".$key_id."' ";
    $code   =   $db->get_one($sql);
    $list   =   [];
    if($code){
        $list =   [
            'id'    =>  $key_id,
            'value' =>  $code[$filed]
        ];
    }
    return $list;
}


function Get_cityname_noParent($key_id = 0){
    global $db;
    if(is_numeric($key_id)){
        $sql = "SELECT `region_name`,`parent_id`  FROM `t_city` WHERE   `id` =  '".$key_id."' ";
        $code   =   $db->get_one($sql);
    }else{
        $key_id =   substr_replace($key_id, '', 0,2);
        $mysql_name   =   GetTableName('t_resources_city');
        $sql = "SELECT `region_name`,`parent_id`  FROM `".$mysql_name."` WHERE   `id` =  '".$key_id."' ";
        $code   =   $db->get_one($sql);
    }

    return $code['region_name'];
}


function Get_label($list = array(),$key_id = 0){
    global $db;
    $code   =   [];
    $list   =   array_filter($list);
    $mysql_resources_name   =   GetTableName('t_label',$key_id);

    foreach ($list as $item){
        if(trim($item)){
            $sql = "SELECT `id`,`label`  FROM `".$mysql_resources_name."` WHERE   `id` =  '".$item."' ";
            $data   =   $db->get_one($sql);
            if($data){
                $code[] =   $data;
            }
        }
    }
    return $code;
}

function Get_resources_img($data = array()){
    $where  =   [];
    if(count($data) > 1){
        $where['id']  =    ['in',implode(',',$data)];
    }else{
        $where['id']  =    $data[0];
    }
    $picture_mysql_name   =   GetTableName('t_resources_img');
    $list   =   Get_data_listall($where,'id,notes,url',$picture_mysql_name,'id desc');
    $picture_list   =   [];
    foreach ($list as $index=>$item){
        if($index == 0){
           $status  =   true;
        }else{
            $status  =   false;
        }
        $picture_list[] = [
            'id'    =>  $item['id'],
            'title' =>  $item['notes'],
            'url'   =>  $item['url'],
            'status'   =>  $status,
        ];
    }
    return $picture_list;
}

function Get_notes($data = array()){
    global $g_http;
    $where  =   [];
    if(count($data) > 1){
        $where['id']  =    ['in',implode(',',$data)];
    }else{
        $where['id']  =    $data[0];
    }
    $picture_mysql_name   =   GetTableName('t_resources_note');
    $list   =   Get_data_listall($where,'id,title,picture,account_id',$picture_mysql_name,'id desc');
    $picture_list   =   [];
    foreach ($list as $item){
        $picture    =   $item['picture'] ? $item['picture']:'/lushu/static/images/noimg.jpg';

        $picture_list[] = [
            'id'    =>  $item['id'],
            'title' =>  $item['title'],
            'user'  =>  Get_userdata_id('username',$item['account_id'])['username'],
            'url'   =>  $picture,

        ];
    }
    return $picture_list;
}

function Get_label_array($list = array()){
    global $db;
    $code   =   [];
    $list   =   array_filter($list);

    foreach ($list as $item){
        $mysql_resources_name   =   GetTableName('t_label');
        $sql = "SELECT `id`,`label`  FROM `".$mysql_resources_name."` WHERE   `id` =  '".$item."' ";
        $str   =   $db->get_one($sql);
        if($str){
            $code[]   =   $str;
        }
    }
    return $code;
}

/**
 * 添加用户
 * @param mixed $account string 用户账号
 * @param mixed $password string 密码
 * @param mixed $name string 用户名称
 * @return string
 */
function update_project_member($project_id  =   ''):string
{
    global $db,$g_siteid,$ymdhis;

    $sql = "UPDATE `t_project_member` SET `update_time`='".time()."' WHERE  `project_id`='" . $project_id . "'";
    if(!$db->query($sql)){
        return  false;
    }
    return  true;
}

/**
 *  出行项目列表
 * @param array $address
 * @return array
 */
function Get_Project_list($where   =   array(),$mysql_name =   't_project',$desc =   'update_time desc',$page = 0):array
{
    global $db,$g_account;
    $mysql_name =   't_project';
    $where['account_id']    =   $g_account['account_id'];
//    asort($where);
    $sql_where  =   Get_Where($where);
//    var_dump($sql_where);
    $sql = "SELECT id,is_sale,project_name,account_id,start_time,departure,day,update_time,is_collect,is_status,url  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc."  LIMIT ".$page.",".NUMBER_PAGES;
    $code   =   $db->get_all($sql);
//    echo $sql;
    $str    =   [];
    foreach ($code as $item){

            if($item['departure']){
                $address    =   Get_cityname_noParent($item['departure']).'出发';
            }else{
                $address    =   '出发地点待定';

            }
            $setout =   [
                'time'  =>  $item['start_time']? date('Y-m-d',$item['start_time']):'出发时间待定',
                'adress'  =>  $address,
                'duration'  =>  $item['day']
            ];
            if($setout['duration'] == 0){
                $setout['duration'] =   '时长待定';
            }else{
                $setout['duration'] =   '共'.$setout['duration'].'天';
            }
            $user_data  =   Get_userdata_id('username',$item['account_id']);
            $trip   =   '行程待定';
            if($item['update_time']){
                $update_time    =   date('Y-m-d H:i:s',$item['update_time']);
            }else{
                $update_time    =   '--';
            }


            $str[]  =   [
                'id'            =>  $item['id'],
                'title'         =>  $item['project_name'],
                'time'          =>  $update_time ?? '--',
                'setout'        =>  $setout,
                'trip'          =>  GetProjectCity($item['id']),
                'url'           =>  $item['url'],
                'is_sale'           =>  (int)$item['is_sale'],
                'travel'        =>  $item['is_collect'],
                'is_status'     =>  $item['is_status'],
                'user'          =>  ['name' =>  $user_data['username']]
            ];


    }

    return $str;
}




/**
 *  出行项目列表
 * @param array $address
 * @return array
 */
function Get_export_Project_list($where   =   array(),$mysql_name =   't_project',$desc =   'update_time desc',$page = 0):array
{
    global $db,$g_account;
    $where['account_id']    =   $g_account['account_id'];
//    asort($where);
    $sql_where  =   Get_Where($where);
//    var_dump($sql_where);
    $sql = "SELECT id,is_sale,project_name,account_id,start_time,departure,day,update_time,is_collect,is_status,url  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc."  LIMIT ".$page.",".NUMBER_PAGES;
    $code   =   $db->get_all($sql);
//    echo $sql;
    $str    =   [];
    foreach ($code as $item){

        if($item['departure']){
            $address    =   Get_cityname_noParent($item['departure']).'出发';
        }else{
            $address    =   '出发地点待定';

        }
        $setout =   [
            'time'  =>  $item['start_time']? date('Y-m-d',$item['start_time']):'出发时间待定',
            'adress'  =>  $address,
            'duration'  =>  $item['day']
        ];
        if($setout['duration'] == 0){
            $setout['duration'] =   '时长待定';
        }else{
            $setout['duration'] =   '共'.$setout['duration'].'天';
        }
        $user_data  =   Get_userdata_id('username',$item['account_id']);
        $trip   =   '行程待定';
        if($item['update_time']){
            $update_time    =   date('Y-m-d H:i:s',$item['update_time']);
        }else{
            $update_time    =   '--';
        }


        $str[]  =   [
            'id'            =>  $item['id'],
            'title'         =>  $item['project_name'],
            'time'          =>  $update_time ?? '--',
            'setout'        =>  $setout,
            'trip'          =>  GetProjectCity($item['id']),
            'url'           =>  $item['url'],
            'is_sale'           =>  $item['is_sale'],
            'travel'        =>  $item['is_collect'],
            'is_status'     =>  $item['is_status'],
            'user'          =>  ['name' =>  $user_data['username']]
        ];


    }

    return $str;
}


/**
 *  出行导出项目列表
 * @param array $address
 * @return array
 */
function Get_Project_list_export($where   =   array(),$felid =   array(),$mysql_name =   't_project_member',$desc =   'update_time desc',$page = 0):array
{
    global $db,$g_account;
    $felid  =   implode(',',$felid);
    $where['account_id']    =   $g_account['account_id'];
    $where['is_delete']    =   0;
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc."  LIMIT ".$page.",".NUMBER_PAGES;
    $code   =   $db->get_all($sql);
    $str    =   [];
    foreach ($code as $item){
        $project_data    =   Get_project_export($item['project_id'],'id,project_name,account_id,start_time,departure,day,update_time,is_collect,is_status,url');

        if($project_data['departure']){
            $address    =   Get_cityname_noParent($project_data['departure']).'出发';
        }else{
            $address    =   '出发地点待定';

        }
        $setout =   [
            'time'  =>  $project_data['start_time']? date('Y-m-d',$project_data['start_time']):'出发时间待定',
            'adress'  =>  $address,
            'duration'  =>  $project_data['day'],
        ];
        if($setout['duration'] == 0){
            $setout['duration'] =   '时长待定';
        }else{
            $setout['duration'] =   '共'.$setout['duration'].'天';
        }
        $user_data  =   Get_userdata_id('username',$project_data['account_id']);
        $trip   =   '行程待定';
        if($project_data['update_time']){
            $update_time   =   Get_day_time($project_data['update_time']);

        }else{
            $update_time    =   '--';
        }

        $str[]  =   [
            'id'            =>  $project_data['id'],
            'title'         =>  $project_data['project_name'],
            'time'          =>  $update_time ?? '--',
            'day'           =>  $project_data['day'],
            'setout'        =>  $setout,
            'trip'          =>  $trip,
            'travel'        =>  $project_data['is_collect'],
            'is_status'     =>  $project_data['is_status'],
            'url'           =>  $project_data['url'],
            'city'           =>  GetProjectCityExport($item['project_id']),
            'user'          =>  ['name' =>  $user_data['username']]
        ];
    }

    return $str;
}

/**
 *  查询详情
 * @param int $key_id
 * @return array
 */
function Get_details($key_id =   0,$felid   =   'is_status',$sql_name   =   't_project',$where  =   []):array
{
    global $db,$g_siteid,$g_account;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
    if(!$key_id){
        return [];
    }
    $where['id']    =   $key_id;
    $where['account_id']    =   $g_account['account_id'];
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$sql_name."`  ".$sql_where."   ";
    $code   =   $db->get_one($sql);
    if(!$code){
        echo error_role(code::PARAMETER_ERROR);exit();
    }
    return $code;
}


/**
 *  查询详情
 * @param int $key_id
 */
function Get_details_all($key_id =   0,$felid   =   'is_status',$sql_name   =   't_project',$where  =   [])
{
    global $db;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
    if(!$key_id){
        return [];
    }
    $where['id']    =   $key_id;
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$sql_name."`  ".$sql_where."   ";
    $code   =   $db->get_one($sql);
    if(!$code){
        echo error_role(code::PARAMETER_ERROR);exit();
    }
    return $code;
}



/**
 *  查询详情
 * @param int $key_id
 * @return array
 */
function Get_details_where($where =   [],$felid   =   'is_status',$sql_name   =   't_project',$debug    =   true):array
{
    global $db;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
//    asort($where);
    $sql_where  =   Get_Where($where,$debug);
    $sql = "SELECT ".$felid."  FROM `".$sql_name."`  ".$sql_where."   ";
    if($debug == false){
        echo $sql;
    }
    $code   =   $db->get_one($sql);
    if(!$code){
        echo $sql;
        echo error_role(code::PARAMETER_ERROR);exit();
    }
    return $code;
}


/**
 *  查询详情
 * @param int $key_id
 */
function Del_where($where =   [],$sql_name   =   't_project')
{
    global $db;

    $sql_where  =   Get_Where($where);
    $del_sql = " DELETE FROM `".$sql_name."` ".$sql_where;
    $code   =   $db->query($del_sql);
    if(!$code){
        echo error_role(code::PARAMETER_ERROR);exit();
    }
    return $code;
}

/**
 *  查询详情  无需权限
 * @param int $key_id
 * @return array
 */
function Get_details_whereno($where =   [],$felid   =   'is_status',$sql_name   =   't_project'):array
{
    global $db;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
//    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$sql_name."`  ".$sql_where."   ";
    $code   =   $db->get_one($sql);
    if(!$code){
        $code   =   [];
    }
    return $code;
}
/**
 *  查询详情  无需权限  可加排序
 * @param int $key_id
 * @return array
 */
function Get_details_desc($where =   [],$felid   =   'is_status',$sql_name   =   't_project',$desc  =   'id desc'):array
{
    global $db;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
//    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$sql_name."`  ".$sql_where."    ORDER BY  ".$desc." ";
    $code   =   $db->get_one($sql);
    if(!$code){
        $code   =   [];
    }
    return $code;
}
/**
 *  根据id 查询内容
 * @param int $key_id
 * @return string
 */
function Get_details_value($key_id =   0,$felid =   'id',$sql_name  =   ''):string
{
    global $db;
    if(!$key_id){
        return  '';
    }
    $sql = "SELECT ".$felid."  FROM `".$sql_name."` WHERE `id` = '".$key_id."'   ";
    $code   =   $db->get_value($sql);
    if(!$code){
        return  '';
    }
    return $code;
}
/**
 *  查询详情
 * @param int $key_id
 * @return array
 */
function Get_price_list($key_id =   0,$type = 0):array
{
    global $db;

    $sql_name =   GetTableName('t_resources_user_price',$type);
    $where['resources_id']    =   $key_id;
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT *  FROM `".$sql_name."`  ".$sql_where."   ";
    $code   =   $db->get_all($sql);
    if(!$code){
        return  [];
    }
    return $code;
}

/**
 *  查询详情
 * @param int $key_id
 * @return array
 */
function Get_price_hotel_list($key_id =   0):array
{
    global $db;

    $sql_name =   GetTableName('t_resources_hotel_user_price');
    $where['resources_id']    =   $key_id;
    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT *  FROM `".$sql_name."`  ".$sql_where."   ";
    $code   =   $db->get_all($sql);
    if(!$code){
        return  [];
    }
    return $code;
}


/**
 *  获取时间戳距离当前时差
 * @param int $address
 * @return string
 */
function Get_day_time($time = 0):string
{
    $times   =   time();
    $day_time   =   $times-86400;
    $just_time   =   $times-60;
    $hours_time   =   $times-(60*60);

    if($time > $day_time){
        if($time > $just_time){
            $str    =   '刚刚';
        }elseif($time > $hours_time){
            $str    =   (int)((($times-$time)/60)).'分钟前';
        }else{
            $str    =   ((int)(($times-$time)/(60*60))).'小时前';
        }
    }else{
        $str    =   date('Y-m-d',$time);
    }

    return $str;
}


/**
 *  PIO分库
 * @param array $where  搜索条件
 * @return array
 */
function Get_data_list($where   =   array(),$felid =   array(),$mysql_name =   't_resources',$desc =   'id desc',$page = 0):array
{
    global $db,$g_account;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc."  LIMIT ".$page.",".NUMBER_PAGES;

    $code   =   $db->get_all($sql);
    if(!$code){
        return  [];
    }
    return $code;
}

/**
 *  PIO分库
 * @param array $where  搜索条件
 * @return array
 */
function Get_data_listall($where   =   array(),$felid =   array(),$mysql_name =   't_resources',$desc =   'id desc'):array
{
    global $db,$g_account;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc;
//    if($mysql_name == 't_project_day_schedule'){
//        echo $sql;
//    }
    $code   =   $db->get_all($sql);
    if(!$code){
        return  [];
    }
    return $code;
}

/**
 *  PIO分库
 * @param array $where  搜索条件
 * @return array
 */
function Get_data_listNumber($where   =   array(),$felid =   array(),$mysql_name =   't_resources',$desc =   'id desc',$number  =   1000):array
{
    global $db,$g_account;
    if(is_array($felid)){
        $felid  =   implode(',',$felid);
    }
    $sql_where  =   Get_Where($where);
    $sql = "SELECT ".$felid."  FROM `".$mysql_name."`   ".$sql_where."   ORDER BY  ".$desc."  LIMIT 0,".$number;
//    echo $sql;
    $code   =   $db->get_all($sql);
    if(!$code){
        return  [];
    }
    return $code;
}

/**
 *  查询资源集合
 * @param string $key_id
 * @param string $key
 * @param string $felid
 * @return array
 */
function Get_picture_list($key_id =   '',$key    =   't_resources_user',$felid  =   'id'):array
{
    global $db,$g_siteid,$g_account;

    $key_id =   explode(',',$key_id);
    $list   =   [];
    foreach ($key_id as $item){
        $sql = "SELECT ".$felid."  FROM `".$key."` WHERE `id` = '".$item."'  and `account_id` =  '".$g_account['account_id']."'";
        $code   =   $db->get_one($sql);
        if($code){
            $list[] =   $code;
        }
    }
    return $list;
}

/**
 *  返回坐标点 方圆最大四个点坐标
 * @param string $lng
 * @param string $lat
 * @param int $distance   距离米
 * @return array
 */
function Get_coordinate_max($lng =   '',$lat    =   '',$distance  =   0):array
{
    $PI = 3.14159265;

    $longitude = $lng;

    $latitude = $lat;

    $degree = (24901*1609)/360.0;

    $raidusMile = $distance;

    $dpmLat = 1/$degree;

    $radiusLat = $dpmLat*$raidusMile;

    $minLat = $latitude - $radiusLat; //拿到最小纬度

    $maxLat = $latitude + $radiusLat; //拿到最大纬度

    $mpdLng = $degree*cos($latitude * ($PI/180));

    $dpmLng = 1 / $mpdLng;

    $radiusLng = $dpmLng*$raidusMile;

    $minLng = $longitude - $radiusLng; //拿到最小经度

    $maxLng = $longitude + $radiusLng; //拿到最大经度

    $range = array(

        'minLat' => $minLat,

        'maxLat' => $maxLat,

        'minLon' => $minLng,

        'maxLon' => $maxLng

    );

    return $range;
}


function Get_list_flied($data  =   array(),$fleid  =   'id'){
    if(!$data){
        return [];
    }
    $str    =   [];
    foreach ($data as $item){
        $str[] =   $item[$fleid];
    }
    return  $str;
}

function Get_implode($data  =   array()):string
{
    if(!$data){
        return '';
    }
    return implode(',',$data);
}


/**
 *  获取时间所属星期几
 * @param int $time   时间戳
 * @return string
 */
function Get_work($time =   0):string
{
    if(!$time){
        return  '';
    }
    $week_array=array("周日","周一","周二","周三","周四","周五","周六");
    $week=date("w",$time);
    return  $week_array[$week];
}
/**
 *  获取时间包含地点
 * @param int $key_id   项目id
 * @param int $time   时间戳
 * @return array
 */
function Get_project_day_city($key_id   =   0,$time =   0):array
{
    if(!$key_id){
        return  [['id'=>0,'value'=>'未设置城市']];
    }

    $details    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$time],'id,city','t_project_remarks_day');
    if(!isset($details)||!isset($details['city']) || !$details['city']){
        return  [['id'=>0,'value'=>'未设置城市']];
    }
    $city   =   explode(',',$details['city']);
    $map_list   =   [];
    foreach ($city as $item){
        $where = ['id' => $item];
        $data = Get_details_whereno($where, 'id,lng,lat,region_name', 't_city','');
        $map_list[]   =     [
            'id'      =>  $data['id'],
            'value'       =>  $data['region_name'],
            'lng'       =>  $data['lng'],
            'lat'       =>  $data['lat'],
        ];
    }


    return  $map_list;
}
/**
 *  获取时间包含地点
 * @param int $key_id   项目id
 * @param int $time   时间戳
 * @return array
 */
function Get_project_day_city_export($key_id   =   0,$time =   0):array
{
    if(!$key_id){
        return  [['id'=>0,'value'=>'未设置城市']];
    }

    $details    =   Get_details_whereno(['project_id' =>  $key_id,'day'=>$time],'id,city','t_export_project_remarks_day');
    if(!isset($details)||!isset($details['city']) || !$details['city']){
        return  [['id'=>0,'value'=>'未设置城市']];
    }
    $city   =   explode(',',$details['city']);
    $map_list   =   [];
    foreach ($city as $item){
        $where = ['id' => $item];
        $data = Get_details_whereno($where, 'id,lng,lat,region_name', 't_city','');
        $map_list[]   =     [
            'id'      =>  $data['id'],
            'value'       =>  $data['region_name'],
            'lng'       =>  $data['lng'],
            'lat'       =>  $data['lat'],
        ];
    }


    return  $map_list;
}


function GetProjectCity($key_id =   0){
    $city   =   [];
    $details    =   Get_data_listall(['project_id' =>  $key_id],'id,city','t_project_remarks_day','day asc');
    foreach ($details as $item){
        if($item['city']){
            $citys =   explode(',',$item['city']);
            $city   =   array_merge($city,$citys);
        }
    }
    $city   =   array_unique($city);
    $city   =   array_filter($city);
    if(!$city){
      return '行程目的地待定';
    }
    $where = ['id' => ['in',implode(',',$city)]];
    $data = Get_data_listall($where, 'id,region_name', 't_city');
    $code   =   [];
    foreach ($data as $item){
        $code[]   = $item['region_name'];
    }

    return implode(' / ',$code);
}


function GetProjectCityExport($key_id =   0){
    $city   =   [];
    $details    =   Get_data_listall(['project_id' =>  $key_id],'id,city','t_export_project_remarks_day','day asc');
    foreach ($details as $item){
        if($item['city']){
            $citys =   explode(',',$item['city']);
            $city   =   array_merge($city,$citys);
        }
    }
    $city   =   array_unique($city);
    $city   =   array_filter($city);
    if(!$city){
      return '行程目的地待定';
    }
    $where = ['id' => ['in',implode(',',$city)]];
    $data = Get_data_listall($where, 'id,region_name', 't_city');
    $code   =   [];
    foreach ($data as $item){
        $code[]   = $item['region_name'];
    }

    return implode(' / ',$code);
}

/**
 *  设置用户操作项目日志
 * @param int $key_id   项目id
 * @param int $User_id   用户id
 * @param string $data   操作说明
 * @param string $msg   备注
 * @return array
 */
function SetProjectLog($key_id  =   0,$data =   '',$msg =   '',$status  =   true){
    global $db,$g_account;
    if(!is_numeric($key_id)){
        echo error_role(code::PARAMETER_ERROR);exit();
    }
    if($status == true){
        $code   =   [
            'update_time'   =>  time()
        ];
        updata_detail($code, 't_project',$key_id);
    }
    $mysql_name =   GetTableName('t_project_log',$key_id);
    $sql    =   "INSERT INTO `".$mysql_name."`(`account_id`, `project_id`, `msg_log`, `notes`, `time`) VALUES ('".$g_account['account_id']."', '".$key_id."','".$data."', '".$msg."','".time()."');";
    $code   =   $db->query($sql);
    return true;
}
/**
 *  设置用户操作项目日志备注
 * @param int $key_id   项目id
 * @param int $User_id   用户id
 * @param string $data   操作说明
 * @param string $msg   备注
 * @return array
 */
function EditProjectLog($project_id =   0,$key_id  =   0,$data =   '',$msg =   ''){
    global $db,$g_account;
    if(!is_numeric($project_id)){
        echo error_role(code::PARAMETER_ERROR);exit();
    }
    $mysql_name =   GetTableName('t_project_log',$project_id);
    $sql    =   "UPDATE `".$mysql_name."` SET  `notes` = '".$data."' WHERE `id` = ".$key_id.";";
    $code   =   $db->query($sql);
    return true;
}

/**
 *  检测密码难易程度
 * @param int $key_id   项目id
 * @param int $User_id   用户id
 * @param string $data   操作说明
 * @param string $msg   备注
 * @return array
 */
function CheckPasswordStrength($password    =   '') {
    $strength = [];

    // 检测密码长度
    $length = strlen($password);
    if ($length >= 8) {
        $strength[] = 1;
    }

    // 检测是否包含字母、数字和特殊字符
    if (preg_match('/[a-zA-Z0-9]/', $password)) {
        $strength[] = 2;
    }

    return $strength;
}

/**
 *  检测密码难易程度
 * @param int $key   交通方式类型id
 * @return string
 */
function Get_traffic($key   =   0,$desc =   '添加交通方式'):string{
    $code   =   [
        '1' =>  '飞机',
        '2' =>  '火车',
        '3' =>  '渡船',
        '4' =>  '巴士',
        '5' =>  '其他',
    ];
    if(in_array($key,array(1,2,3,4,5))){
        return  $code[$key];
    }else{
        return $desc;
    }

}
/**
 *  根据下标获取数据值
 * @param int $key   交通方式类型id
 * @return string
 */
function Get_array_data($key   =   0,$code  =   array()):string{

    if(in_array($key,array(1,2,3,4,5))){
        return  $code[$key];
    }else{
        return '--';
    }

}



/**
 *  获取数据库数量
 * @param array $address
 * @return array
 */
function Get_Count($where   =   array(),$mysql_name =   't_project_member',$page = 0):array
{
    global $db,$g_account;

    asort($where);
    $sql_where  =   Get_Where($where);
    $sql = "SELECT count(*) as number  FROM `".$mysql_name."`   ".$sql_where;
    $code   =   $db->get_one($sql);
    $number =   $code['number'];
    if($page < 1){
        $page   =   1;
    }
    $pages  =   ceil($number/NUMBER_PAGES);
    $page_length =   $pages-$page;
    $start  =   $page-2;
    $end  =   $page+2;

    if($end > $pages){$end = $pages;$start  =   $pages-4;}//最终页大于总页数的

    if($pages < 5){  $end    =  $pages;}//初始页不足五页
    if($page < 5){  $start = 1;   $end  =   5;  }//  当前页不超过五页前  不进行新页数展示
    if($start < 1){
        $start  =   1;
    }
    if($end > $pages){
        $end    =   $pages;
    }


    $previous   =   true;
    $next       =   true;
    if($page  <= 1){
        $previous   =   false;
    }
    if($page  >= $pages){
        $next   =   false;
    }
    $page_list = [];
    $page_list['previous'] =   $previous;
    $page_list['next'] =   $next;

    for ($i=$start;$i<=$end;$i++){
        $status =   false;
        if($page == $i){ $status = true;}
        $page_list['body'][]    =   [
            'page'  =>  $i,
            'status'    =>  $status
        ];
    }




    return $page_list;
}


?>
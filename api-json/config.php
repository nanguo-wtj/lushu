<?php
date_default_timezone_set('Asia/Shanghai');

header('Access-Control-Allow-Origin:http://127.0.0.1:5502');
//header('Access-Control-Allow-Headers:appversion,authorization,content-type,deviceid');
header('Access-Control-Allow-Credentials:true');

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$g_site_root = dirname(dirname(__FILE__));

/// 全局库文件 ///
include($g_site_root . '/config/cfg.php');
include($g_site_root . '/libs/mysqli_class.php');


/// 系统安全认证 ///
if (isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS'] == "on") {
    $g_http = "https://";
} else {
    $g_http = "http://";
}


/// 系统当前域名 ///
$g_http_host = $_SERVER['HTTP_HOST'];
$g_domain = $g_http . $g_http_host;

/// 连接到数据库
$db = new db_mysqli($g_db_conf);

/// 系统配置文件 ///
$config_sql = "SELECT * FROM `t_site_config` WHERE `site_domain`='$g_http_host' LIMIT 0,1";
$g_config = $db->get_one($config_sql);

// 站点不存在
if ($g_config['site_id'] == '') {
    die("<h1>对不起，系统不可用！</h1>");
}

// 站点状态
if ($g_config['state'] != '1') {
    die("<h1>对不起，系统不可用！</h1>");
}

// 站点过期
if (date('Ymd', strtotime($g_config['end_date'])) < date('Ymd')) {
    die("<h1>对不起，软件服务过期！</h1>");
}

//全局参数
$g_account  =   [];

$g_siteid = $g_config['site_id'] ;
$g_sso_key = getcookies('CLOOTA_ADMIN_UUID');
if($g_sso_key){
    $sql = "SELECT * FROM `t_admin` WHERE  `state`='1' AND `sso_key`='$g_sso_key' ";
    $g_account = $db->get_one($sql);
}
//分页设置
define('NUMBER_PAGES', 24);//每页分页展示数量

// 是否开启 rsa加密登录返回信息
define('PROGRAM_ENCRYPTION', false);
define('WHETHER_TO_DIVIDE_THE_TABLE', true);//是否分库
$Rsa    =   '';
if(PROGRAM_ENCRYPTION == true){
    $g_dir = dirname(__FILE__,2);
    include_once($g_dir . '/libs/jwt/token/RsaToken.php');
    $Rsa    =   new jwt\token\RsaToken();

}

// ----结束-------



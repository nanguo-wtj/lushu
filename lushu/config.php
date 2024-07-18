<?
/// 配置文件 /// 

header("Content-type: text/html; charset=utf-8");

ini_set('display_errors',1);            //错误信息
ini_set('display_startup_errors',1);    //php启动错误信息
error_reporting(-1);                    //打印出所有的 错误信息
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //将出错信息输出到一个文本文件
$g_dir = dirname(__FILE__,2);


include(dirname(__FILE__,2).'/config/cfg.php');

include(dirname(__FILE__,2).'/libs/mysqli_class.php');
ini_set('display_errors',0);

/// 连接到数据库
$db = new db_mysqli($g_db_conf);
include($g_dir . '/dataconfig.php');
include(dirname(__FILE__) . '/function.php');
include(dirname(__FILE__) . '/lang.php');
// ----结束-------

//查看登录信息
$UserData =   GetAdminDataCookies();
/// 系统信息
$g_config =   GetSiteConfigHttp();

if(!$g_config){
    header("Location:/error/website.html");
    exit();
}
$g_http =   GetSiteHttp($g_config['is_https']);
if(isset($UserData['data'])){
    CreateFolder($g_dir,$UserData['data']['account_id']);
}



<?
include(dirname(__FILE__) . '/config.php');
define('IN_CLOOTA', true);

$time_start = microtime_float();

$cmd    =   req('cmd');
$_static    =   '';
if(!$cmd){
    $cmd    =   'index';
}
if($cmd ==  'top'){
    $_static    =   'lushu/';
    $cmd    =   'index';

}
SetLog();
//if($cmd !=  'login' && $cmd !=  'index'){
//    $cmd = base64_decode(req('cmd'));
//}
//接口验证
if(Verify_Permissions($cmd) ==  false){
    header("Location:/error/404.html");
    exit();
}





$ApplicationName    =   $g_config['seotitle'];
$seo_title  =   $g_config['seokeywords'];
$seo_content  =   $g_config['seodescription'];
$_static    .=   'static';
$_Post_url  =   $g_http.$_SERVER['HTTP_HOST'].'/api-json/';
$_Home_url  =   $g_http.$_SERVER['HTTP_HOST'];
$model_file = dirname(__FILE__) . '/model/' . $cmd.'.php';

$view_file = dirname(__FILE__) . '/view/' . $cmd.'.php';
$foot_file = dirname(__FILE__) . '/view/foot.php';

$js_file = dirname(__FILE__) . '/js/' . $cmd.'.php';

$key_id =   req('key_id');
if($cmd==''){
    header("Location:/error/404.html");
    exit();
}else {
    if (is_file($view_file) == true) {
        if (is_file($model_file) == true) {
            include($model_file);
        }
        include($view_file);
        include($foot_file);
        if (is_file($js_file) == true) {
            include($js_file);
        }

    }else{
        header("Location:/error/404.html");
        exit();
    }
}



?>
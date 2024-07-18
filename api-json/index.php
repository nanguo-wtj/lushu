<?

header('Access-Control-Allow-Origin:http://127.0.0.1:5502');
header('Access-Control-Allow-Methods:OPTIONS, GET, POST'); // 允许option，get，post请求
header('Access-Control-Allow-Headers:x-requested-with'); // 允许x-requested-with请求头acc
header('Access-Control-Allow-Headers:appversion,authorization,content-type,deviceid');
header('Access-Control-Allow-Credentials:true');

ini_set('display_errors',1);            //错误信息
ini_set('display_startup_errors',1);    //php启动错误信息
error_reporting(1);                    //打印出所有的 错误信息
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //将出错信息输出到一个文本文件

include(dirname(__FILE__) . '/config.php');
include(dirname(__FILE__) . '/common.php');
include(dirname(__FILE__) . '/check.php');
$cmd = req('cmd');

SetLog();
//接口验证
if(Verify_Permissions($cmd) ==  false){
    echo error_login('接口地址错误或未登录！请重试');exit();
}


$ymdhis = date('y-m-d H:i:s');
$yyyymm = date('Ym');
$_Home_url  =   'http://'.$_SERVER['HTTP_HOST'];

$json_file = dirname(__FILE__) . '/json/' . $cmd . '.php';

if (is_file($json_file)) {
    include($json_file);
    exit;
}
;
echo json_encode('ERROR CMD');
//成功返回
function success($data = [], $success = 'success', $type = 'json')
{
    $result = [
        'code' => 200,
        'msg' => $success,
        'data' => $data,
    ];
    if (isset($type) && $type == 'json') {
        return json_encode($result);
    } else {
        return $result;
    }

}
//成功返回
function success_file($data = [], $success = 'success', $type = 'json')
{
    $result   =   [
        'errno' =>  0,
        'data'  =>  [
            'url'   =>  $data,
            'alt'   =>  '上传文件',
            'href'   =>  $data,
        ],
    ];
    if (isset($type) && $type == 'json') {
        return json_encode($result);
    } else {
        return $result;
    }

}

//失败返回
function error($msg = 'error', $redirect = '', $type = 'json')
{

    $result = [
        'code' => 201,
        'msg' => $msg,
        'data' => $redirect,
    ];

    if (isset($type) && $type == 'json') {
        return json_encode($result);
    } else {
        return $result;
    }
}

//失败返回
function error_no($msg = 'error', $redirect = '', $type = 'json')
{

    $result = [
        'code' => 202,
        'msg' => $msg,
        'data' => $redirect,
    ];

    if (isset($type) && $type == 'json') {
        return json_encode($result);
    } else {
        return $result;
    }
}

//失败返回
function error_login($msg = 'error', $redirect = '', $type = 'json')
{

    $result = [
        'code' => 203,
        'msg' => $msg,
        'data' => $redirect,
    ];

    if (isset($type) && $type == 'json') {
        return json_encode($result);
    } else {
        return $result;
    }
}
//失败越权返回
function error_role($msg = 'error', $redirect = '', $type = 'json')
{

    $result = [
        'code' => 405,
        'msg' => $msg,
        'data' => $redirect,
    ];

    if (isset($type) && $type == 'json') {
        return json_encode($result);
    } else {
        return $result;
    }
}

//请求话术
function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    return $result;
}

function http_curl_get($url, $type = 1)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_TIMEOUT, 5000);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_URL, $url);
    if ($type == 1) {
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    }
    $res = curl_exec($curl);
    if ($res) {
        curl_close($curl);
        return $res;
    } else {
        $error = curl_errno($curl);
        curl_close($curl);
        return $error;
    }
}



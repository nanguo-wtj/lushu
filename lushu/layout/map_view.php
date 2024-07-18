<?php include(dirname(__FILE__,3).'/config/cfg.php'); ?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />
    <link rel="stylesheet" type="text/css" href="https://a.amap.com/jsapi_demos/static/demo-center/css/prety-json.css">
    <style>
        html,
        body,
        #container {
            width: 100%;
            height: 100%;
        }
    </style>
    <title>获取输入提示信息</title>
</head>

<body>
<div id="container"></div>
<script type="text/javascript">
    window._AMapSecurityConfig = {
        serviceHost: "/_AMapService",
    };
</script>
<script src="https://webapi.amap.com/maps?v=1.4.15&key=<?=MAP_VIEW_KEY?>&plugin=AMap.Autocomplete"></script>
<script type="text/javascript" src="https://a.amap.com/jsapi_demos/static/demo-center/js/jquery-1.11.1.min.js" ></script>

<script>
    //初始化地图
    var map = new AMap.Map('container', {
        center: [116.395577, 39.892257],
        zoom: 14, //初始地图级别
    });

    // 获取输入提示信息
    function autoInput(keywords){
        return new Promise((resolve, reject) => {
            AMap.plugin('AMap.Autocomplete', function(){
                // 实例化Autocomplete
                var autoOptions = {
                    city: '全国'
                }
                var autoComplete = new AMap.Autocomplete(autoOptions);
                autoComplete.search(keywords, function(status, result) {
                    // 搜索成功时，result即是对应的匹配数据
                    console.log({'请求状态':status})
                    console.log({'数据':result})
                    resolve(result);
                })
            })
        });

    }


    function set_poi_maker(e,lng,lat) {
        let text = new AMap.Text({
            position: new AMap.LngLat(lng,lat),
            anchor: 'bottom-center',
            draggable: false, //是否可拖拽
            text: '*',
            style: {'background-color':'#00b1b3','padding': '5px 12px 5px 12px','color': 'white','border-radius':'20px'},
        });
        map.setCenter([lng, lat]);
        map.add(text);
        return text;
    }

    <?
        if(isset($_GET['lng']) && isset($_GET['lat'])){
        $lng    =   $_GET['lng'];
        $lat    =   $_GET['lat'];
    if($lng  &&  $lat){?>
        Set_Center('<?=$lng?>','<?=$lat?>')
    set_poi_maker('','<?=$lng?>','<?=$lat?>')
    <? }

    }
        ?>

    function get_adderss_number(item){
        return item.getPosition();
    }

    function Set_Center(lng,lat) {
        map.setCenter([lng, lat]);
    }

</script>
</body>

</html>
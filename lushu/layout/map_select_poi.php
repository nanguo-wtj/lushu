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
        .poi_body{
            padding: 15px;
            background-color: rgb(255, 255, 255);
            border-radius: 5px;
            min-width: 320px;
            max-width: 320px;
            text-align: center;
            overflow: hidden;
        }
        .poiTitle{
            font-size: 21px;
            font-weight: 500;
        }
        .poiAddress{
            font-size: 16px;
            color: #5b5b5b;
        }
        .btnAddRed{
            background-color: #f9574b;
            color: white;
            font-size: 18px;
            width: 250px;
            height: 40px;
            line-height: 40px;
            margin: 0 auto;
            border-radius: 7px;
            margin-top: 5px;
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
<!--<script src="https://webapi.amap.com/maps?v=1.4.15&key=866a0193931b4d79825c15ea89327e66&plugin=AMap.Autocomplete"></script>-->
<script src="https://webapi.amap.com/maps?v=1.4.15&key=<?=MAP_VIEW_KEY?>&plugin=AMap.Autocomplete"></script>
<script type="text/javascript" src="https://a.amap.com/jsapi_demos/static/demo-center/js/jquery-1.11.1.min.js" ></script>

<script>
    //初始化地图
    var map = new AMap.Map('container', {
        center: [116.395577, 39.892257],
        zoom: 14, //初始地图级别
    });


    function openInfo(e) {
        //构建信息窗体中显示的内容
        var info = [];

        info.push("<div class='poi_body'>");
        info.push("<div class=\"poiTitle\">"+e.name+"</div>");
        info.push("<div class=\"poiAddress\">"+e.address+"</div>");
        info.push("<div class=\"btnAddRed addPoi\" onclick=\"window.parent.Add_POI("+e.id+",'"+e.name+"');\">添加POI</div>");
        info.push("</div>");

        infoWindow = new AMap.InfoWindow({
            content: info.join("")  //使用默认信息窗体框样式，显示信息内容
        });

        infoWindow.open(map, [e.lng,e.lat]);
        return infoWindow;
    }

    function closeInfo(e) {
        e.close();
    }


    function set_poi_maker(e,lng,lat) {
        let text = new AMap.Text({
            position: new AMap.LngLat(lng,lat),
            anchor: 'bottom-center',
            draggable: false, //是否可拖拽
            text: '1',
            style: {'background-color':'#00b1b3','padding': '5px 12px 5px 12px','color': 'white','border-radius':'20px'},
        });
        map.setCenter([lng, lat]);
        map.add(text);
        return text;
    }


    function Set_Center(lng,lat) {
        map.setCenter([lng, lat]);
    }

</script>
</body>

</html>
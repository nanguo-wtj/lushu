<?php include(dirname(__FILE__,3).'/config/cfg.php'); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <style>
        html,
        body,
        #container {
            width: 100%;
            height: 100%;
        }
    </style>
    <title>折线的绘制和编辑</title>
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />
<!--    <script src="https://webapi.amap.com/maps?v=2.0&key=a97f830fcb8a9debee615a2d26a30b0d&plugin=AMap.PolylineEditor"></script>-->
    <script src="https://webapi.amap.com/maps?v=2.0&key=<?=MAP_EDIT_KEY?>&plugin=AMap.PolylineEditor"></script>
    <script src="https://a.amap.com/jsapi_demos/static/demo-center/js/demoutils.js"></script>
</head>
<style>
    .amap-icon {
        width: 30px;
        height: 30px;
        border-radius: 20px;
        background-color: #00b1b3;
    }
    .amap-icon img {
        width: 100%;
        height: 100%;
    }
    .poi_body{
        /*padding: 15px;*/
        background-color: rgb(255, 255, 255);
        border-radius: 5px;
        min-width: 180px;
        max-width: 180px;
        text-align: center;
        overflow: hidden;
    }
    .poiimg{
        width: 100%;
        height: 90%;
    }
    .poiimg img {
        width: 100%;
        height: 100%;
    }
    .poiTitle{
        font-size: 16px;
        font-weight: 200;
        float: left;
        width: 80%;
    }
    .btnAddRed button{
        background-color: #00b2b4;
        border: 1px solid #ffffff;
        border-radius: 6px;
        width: 35px;
        height: 30px;
    }

</style>
<body>
<div id="container"></div>
<script type="text/javascript">
    var map = new AMap.Map("container", {
        zoom: 12
    });

    function get_city(e) {
        console.log('构建折线')

        let code = [];
        e.forEach(function(item, index) {
            code.push(item)
        });
        return  new AMap.Polyline({
            path: code,
            isOutline: true,
            outlineColor: '#737272',
            borderWeight: 1,
            strokeColor: "#6b6b6b",
            strokeOpacity: 0.2,
            strokeWeight: 3,
            // 折线样式还支持 'dashed'
            strokeStyle: "solid",
            // strokeStyle是dashed时有效
            strokeDasharray: [10, 5],
            lineJoin: 'round',
            lineCap: 'round',
            zIndex: 50,
        })
    }
    function set_city(e) {
        map.add([e]);
        map.setFitView();
    }
    function Refresh() {
        location.reload()
    }
    function del_city(item) {
        map.remove(item);
    }
    function set_city_list(e) {
        console.log('构建自定义点坐标')
        let code    =   [];
        e.forEach(function(item, index, arr) {
            let text = new AMap.Text({
                position: new AMap.LngLat(item.lng, item.lat),
                anchor: 'bottom-center',
                text: item.name,
                style: {'background-color':'#00b1b3','padding': '2px 16px 2px 16px','color': 'white','border-radius':'5px'},
            });
            code.push(text);
            map.add(text);
        });
        return code
    }
    function set_city_list_circular(e) {
        console.log('构建自定义点坐标')
        let code    =   [];
        e.forEach(function(item, index, arr) {
            let text = new AMap.Text({
                position: new AMap.LngLat(item.lng, item.lat),
                anchor: 'bottom-center',
                text: item.name,
                style: {'background-color':'#00b1b3','padding': '5px 12px 5px 12px','color': 'white','border-radius':'20px'},
            });
            code.push(text);
            map.add(text);
        });
        return code
    }


    function Set_city_icon(e) {
        console.log('构建自定义点坐标')
        let code    =   [];
        e.forEach(function(item, index, arr) {
            // 将 Icon 实例添加到 marker 上:
            //创建 AMap.Icon 实例：
            const icon = new AMap.Icon({
                size: new AMap.Size(25, 25), //图标尺寸
                image: item.icon, //Icon 的图像
                imageSize: new AMap.Size(25, 25), //根据所设置的大小拉伸或压缩图片
            });
            const marker = new AMap.Marker({
                position: new AMap.LngLat(item.lng,  item.lat), //点标记的位置
                icon: icon, //添加 Icon 实例
                title: item.name,
                zooms: [5, 15], //点标记显示的层级范围，超过范围不显示

            });
            code.push(marker);
            map.add(marker);
            marker.on('mouseover', function() {//拖动坐标获取新坐标
                window.parent.Add_POI_Day(item);
            });
        });
        return code
    }


    function openInfo(e) {
        console.log('构建信息窗体')

        //构建信息窗体中显示的内容
        var info = [];

        info.push("<div class='poi_body'>");
        info.push("<div class=\"poiimg\"> <img src='"+e.img+"' ></div>");
        info.push("<div class=\"poiTitle\">"+e.name+"</div>");
        // info.push("<div class=\"poiAddress\">"+e.address+"</div>");
        info.push("<div class=\"btnAddRed \" onclick=\"window.parent.Add_POI("+e.id+",'"+e.name+"','"+e.type+"');\">" +
            "<button type=\"button\"><img src=\"/lushu/static/svg/icon-52.svg\" style=\"width: 1rem; height: 1rem;\"></button>" +
            "</div>");
        info.push("</div>");

        infoWindow = new AMap.InfoWindow({
            content: info.join("")  //使用默认信息窗体框样式，显示信息内容
        });

        infoWindow.open(map, [e.lng,e.lat]);
        return infoWindow;
    }

    function Set_Center(lng,lat) {
        console.log('中心点变动')
        map.setCenter([lng, lat]);
    }

    function Set_Zoom(e) {
        console.log('地图级别变动')
        map.setZoom(e);
    }


    function MonitoringCenterPoint() {
        console.log('监听地图中心带你坐标')
        map.on("moveend", function () {
            var currentCenter = map.getCenter().toJSON(); //获取地图中心点
            window.parent.MonitoringCenter(currentCenter);
        });
    }


</script>
</body>
</html>
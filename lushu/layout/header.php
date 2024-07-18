<?php include(dirname(__FILE__,2) . '/layout/checking.php');?>
<!doctype html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?=$seo_title?></title>
    <meta name="description" content="<?=$seo_content?>">
    <link href="<?=$_static?>/user/logo.ico" type="image/x-icon" rel="Shortcut Icon">
    <link href="<?=$_static?>/user/logo.ico" type="image/x-icon" rel="Bookmark">
    <link href="<?=$_static?>/user/logo.ico" type="image/x-icon" rel="icon">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/editor.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/trip_generic_style.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/lushuwidgets.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/library_generic_style.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/search-city.css">

    <link href="<?=$_static?>/css/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/tos_workbench_style.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/tos_account_style.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/tos_library_style.css">
    <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/sider-style.css">

    <script src="<?=$_static?>/js/jquery-1.8.3.min.js"></script>
    <script src="<?=$_static?>/components-js/common.js"></script>
    <script src="<?=$_static?>/js/md5.js"></script>
    <script src="<?=$_static?>/js/sider.jquery.js"></script>



    <link rel="stylesheet" href="<?=$_static?>/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="<?=$_static?>/layuiadmin/style/admin.css" media="all">
    <script src="<?=$_static?>/layuiadmin/layui/layui202311.js?t=1"></script>
    <script src="<?=$_static?>/vue/vue.js"></script>
    <script src="<?=$_static?>/vue/axios.js"></script>
    <script src="<?=$_static?>/user/open.js"></script>

    <link href="<?=$_static?>/user/open.css" rel="stylesheet"></link>
    <? if($cmd == 'staging_trip'){?>
        <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>
    <? }?>
    <? if(in_array($cmd,array('resources_poi_material','project_trip','project','project_edit_export','project_quotation_edit_export','project_edit_notes_export','project_edit_day_export','resources_activities_details','resources_activities','resources_note','project_quotation_edit','resources_note_details','project_demand','resources_hotel_material','project_edit','project_edit_day','project_edit_notes'
    ,'resources_poi','resources_poi_details','resources_hotel','resources_hotel_details','index'))){?>
        <!--<script type="text/template" id="globalCSSTemplate"></script>-->
        <script src="<?=$_static?>/js/wangeditor.js"></script>
        <link href="<?=$_static?>/css/normalize.css" rel="stylesheet">
        <link href="<?=$_static?>/css/init.css" rel="stylesheet">
        <script src="<?=$_static?>/element-ui/index.js"></script>
        <link href="<?=$_static?>/element-ui/index.css" rel="stylesheet">
    <? }?>
    <? if(in_array($cmd,array('project_edit','project_edit_day','project_edit_notes','project_edit_notes_export','project_edit_export','project_edit_day_export'))){?>
        <link rel="stylesheet" type="text/css" href="<?=$_static?>/css/planner_style.css">
        <link rel="stylesheet" href="<?=$_static?>/css/main.css">
    <? }?>

    <? if(in_array($cmd,array('index'))){?>
        <script src="<?=$_static?>/js/echarts.min.js"></script>
        <script src="<?=$_static?>/user/echarts.js"></script>
    <? }?>
    <? if(in_array($cmd,array('Itinerary_view'))){?>
        <link rel="stylesheet" type="text/css" href="<?=$_static?>/user/itinerary.css">
        <link rel="stylesheet" type="text/css" href="<?=$_static?>/user/icon.css">
    <? }?>
</head>
<style>
    .ant-table-row:hover .ant-popover-hidden{
        display: unset;
    }
    .ant-popover-open:hover .ant-popover-hidden{
        display: unset;
    }
    <? if(!in_array($cmd,array('recovery'))){?>

    .ant-table-row:hover .projectLibrary__avatarContainer___2UXHC{
        display: none;
    }

    <? }else{ ?>
    .project_list:hover  .ant-dropdown-menu{
        display: unset!important;

    }
    <? }?>
    .ant-dropdown-trigger:hover .project-operations{
        display: unset;
    }
    .project-operations{
        display:none;
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
    }
    #div4{
        height: 63vh;
    }
    #webMain{
        display: none;
    }
    .layoutSide__active___1nyoZ img{
        position: relative;
        transform: translateX(-80px);
        filter: drop-shadow(#ffffff 80px 0);
        border-left: 4px solid transparent; //防止drop-shadow主体超出视线隐藏后阴影消失
    border-right: 4px solid transparent;
    }
    .LOADING{
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: #fbfcfc;
        opacity:0.5;
        z-index: 99999;
        display: flex; /* 设置容器为flex布局 */
        justify-content: center; /* 水平居中对齐内容 */
        align-items: center; /* 垂直居中对齐内容 */
        overflow-y: hidden;
    }
    #wangEditor_content {
        margin-top: 100px
    }
    ::-webkit-scrollbar {
        display: none; /* Chrome Safari */
    }
    .loading-view{
        border: 1px solid #0088f8;
        z-index: 9999;
        position: relative;
        width: 100%;
        margin: 0 auto;
        animation: change 3s;
        animation-iteration-count:infinite;
    }

    @keyframes change {
        0% {
            width: 100%;
        }
        50% {
            width: 0%;
        }
        51% {
            width: 0%;
        }
        100% {
            width: 100%;
        }
    }
</style>
<div class="loading-view"></div>
<div class="LOADING">
    <img src="<?=$_static?>/gif/2.gif" style="width:10rem;height: 10rem">
</div>

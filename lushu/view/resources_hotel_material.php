<!-- 导入顶部数据  -->
<?php
$key_id =   req('key_id');
include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    /* reset */
    html,body,h1,h2,h3,h4,h5,h6,div,dl,dt,dd,ul,ol,li,p,blockquote,pre,hr,figure,table,caption,th,td,form,fieldset,legend,input,button,textarea,menu{margin:0;padding:0;}
    ul,li{list-style-type: none}
    h1{font-size: 26px;}
    p{font-size: 14px; margin-top: 10px;}
    h2{font-size: 20px;margin-top: 20px;}
    .case{margin-top: 15px;}
    #callback{float: left;margin-left: 12px;height:33px;line-height: 33px;border:1px solid #d7d7d7;padding:0 10px;}
    .inputDuration__popover___2DN4h {
        padding: 0px 16px 12px;
    }
</style>
<body class="appName-library">

<div id="webMain" ref="pageTop">
    <div>
        <div class="">
            <div id="pageWrap" class="basicLayout__basicLayout___3_npk">
                <div class="transitIndicator__transitIndicator___3m8Gd">
                    <div class="transitIndicator__transitBar___2q3uc"></div>
                </div>

                <!-- 导入导航栏目  -->
                <?php include(dirname(__FILE__,2) . '/layout/menu.php');?>



                <div class="basicLayout__layoutMain___1NUHo">

                    <div class="pageTopBar basicLayout__pageTopBar___3r1fF">
                        <!-- 导入顶部栏目  -->
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top_details.php');?>
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top_hotel.php');?>

                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="poiMaterialLibrary__container___3-f10">
                            <div class="ant-row" style="margin-left:-8px;margin-right:-8px">
                                <div style="padding-left:8px;padding-right:8px" class="ant-col-12">
                                    <div class="poiMaterialLibrary__leftElt___1SCq5">
                                        <div class="poiMaterialLibrary__header___2XyMZ">
                                            <h2>笔记</h2>
                                            <button type="button" onclick="$('.addNode').css('display','block')" class="ant-btn ant-btn-primary">
                                                <span>新建笔记</span>
                                            </button>
                                        </div>
                                        <div class="poiMaterialLibrary__cardList___1vGo1">
                                            <div style="padding-left:8px;padding-right:8px" class="ant-col-24" v-for="item in project_note" :key="item.id" v-on:click="get_note_details(item.id)">
                                                <div class="note__noteBox___UhFwo note__dark___ZrySZ">
                                                    <div class="note__noteCover___3XJg6">
                                                        <span :style="'background-image:url('+item.url+')'" class="widgets__lushuBackgroundImage___3XMmZ"></span>
                                                    </div>
                                                    <div class="note__noteCont___2WJA_">
                                                        <h4>{{item.title}}</h4>
                                                        {{item.user}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div style="padding-left:8px;padding-right:8px" class="ant-col-12">
                                    <div class="poiMaterialLibrary__rightElt___3U6Pu">
                                        <div class="poiMaterialLibrary__header___2XyMZ">
                                            <h2>图片</h2>
                                            <button type="button" class="ant-btn ant-btn-primary" onclick="$('.add-poi').css('display','block')">
                                                <span>新建图片</span>
                                            </button>
                                        </div>
                                        <div class="poiMaterialLibrary__pictureList___vEBab">
                                            <div class="picture__pictureContainer___1P5uK poiMaterialLibrary__picture___1EWbj" v-for="item in project_picture" :key="item.id"  v-on:click="get_picture_details(item.id)">
                                                <div class="picture__image___21sux" :style="'background-image:url('+item.url+');width:240px;height:132px'">
                                                    <span class="picture__poiCover___19eWE" v-if="item.id == resources_data.picture_id">POI封面</span>
                                                    <span class="picture__btnSetCover___9D4Z8" v-if="item.id != resources_data.picture_id" v-on:click="post_picture_default(item)">设为POI封面</span>
                                                </div>
                                                <div class="picture__textContainer___3XsD0">
                                                    <div class="picture__subtitle___TIN1m"></div>
                                                    <div class="picture__creator___1FUlz">
                                                        {{item.title}}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
        </div>
    </div>


    <!-- 新建笔记 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_note.php');?>
    <!-- 新增图片 -->
    <?php $map_status = 1; include(dirname(__FILE__,2) . '/layout/project_img.php');?>
    <!-- 地图 -->
    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_del.php');?>




</div>


</body>

</html>
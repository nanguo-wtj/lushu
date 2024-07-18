<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    /* reset */
    html,body,h1,h2,h3,h4,h5,h6,div,dl,dt,dd,ul,ol,li,p,blockquote,pre,hr,figure,table,caption,th,td,form,fieldset,legend,input,button,textarea,menu{margin:0;padding:0;}
    ul,li{list-style-type: none}
    h1{font-size: 26px;}
    p{font-size: 14px; margin-top: 10px;}
    pre{background:#eee;border:1px solid #ddd;border-left:4px solid #f60;padding:15px;margin-top: 15px;}
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
                        <?php include(dirname(__FILE__,2) . '/layout/top.php');?>
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top.php');?>


                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="keypointLibrary__keypointContainer___3mKqZ">
                            <?php include(dirname(__FILE__,2) . '/search/resources_trip.php');?>


                            <div class="pagePanel pagePanel__pagePanel___3fszW keypointList__fitHeight___1dVIA">
                                <div class="keypointList__keypointList___1ip30">
                                    <div  v-for="item in project_trip" :key="item.id" v-on:click="get_details(item.id)" class="keypoint__keypoint___3G0v5 keypointList__keypoint___ze37F" style="width: 240px; height: 332px;">
                                        <div class="keypoint__img___1LiBX" :style="'background-image: url('+item.picture+'); width: 240px; height: 240px;'">
                                        </div>
                                        <div class="keypoint__title___8ICRY">{{item.title}}</div>
                                        <div class="keypoint__desc___3lmTU">{{item.notes}}</div>
                                    </div>

                                </div>
                                <div class="widgets__empty___8_50e widgets__large___1ny40" v-if="project_trip.length < 1">
                                    <div class="widgets__header___3RBY_">
                                        暂无数据
                                    </div>
                                    <div class="widgets__description___3PlNA"></div>
                                </div>
                                <?php include(dirname(__FILE__,2) . '/layout/page_list.php');?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- 多页面共用弹出页面 -->
    <?php include(dirname(__FILE__,2) . '/layout/foot.php');?>
    <!-- 新增城市 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_trip.php');?>
</div>


</body>
</html>
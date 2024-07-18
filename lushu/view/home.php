<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
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
                    <div class="pageTopBar basicLayout__pageTopBar___3r1fF"></div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="resourceHome__resourceHome___3aYzJ">
                            <div class="resourceHome__headerBackground___1xFWi">
                                <div class="resourceHome__bgImage___1Rzr9" style="background-image:url(<?=$_static?>/images/resource_bg_trip.jpeg);opacity:1"></div>
                                <div class="resourceHome__bgImage___1Rzr9" style="background-image:url(<?=$_static?>/images/resource_bg_poi.jpeg);opacity:0"></div>
                                <div class="resourceHome__bgImage___1Rzr9" style="background-image:url(<?=$_static?>/images/resource_bg_picture.jpeg);opacity:0"></div>
                                <div class="resourceHome__bgImage___1Rzr9" style="background-image:url(<?=$_static?>/images/resource_bg_card.jpeg);opacity:0"></div>
                                <div class="resourceHome__bgCover___2O4TO"></div>
                            </div>
                            <div class="resourceHome__searchBar___YXU6z">


                            </div>
                            <div class="resourceHome__channelPanel___2NlVC">
                                <div class="resourceHome__channelSection___YO0nz">
                                    <div class="resourceHome__sectionHeader___3djk6">
                                        <span class="resourceHome__sectionTitle___3jRYd">资源链接</span>

                                    </div>
                                    <div class="resourceHome__sectionContent___1aDxR resourceHome__collapsed___3Bf0K _1 aotuHeight">


                                        <div v-for="(item,index) in tourism_list" :key="index" class="resourceHome__channelBtn___1t_Zv" >
                                            <a :href="item.url"  target="_blank">
                                                <div class="resourceHome__channelLogo___2vE50" :style="'background-image:url('+item.img+')'"></div>
                                                <div class="resourceHome__channelName___15CJF">
                                                    <span>{{item.title}}</span>
                                                </div>
                                            </a>

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
    <script src="<?=$_static?>/js/__APP_STATE_HOME.js"></script>
</div>
<!-- 通知 -->
<div class="notice" style="display: none;">

</div>

</body>


</html>
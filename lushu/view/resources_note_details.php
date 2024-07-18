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
                        <?php
                        $add_status =   true;
                        $add_type =   'addNode';
                        $superior_name  =   '笔记库';
                        $superior_url   =   'resources_note';
                        include(dirname(__FILE__,2) . '/layout/resources_top_details.php');?>
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="pagePanel__pagePanelContainer___3FpIY">
                            <div class="pagePanel pagePanel__pagePanel___3fszW pagePanel__auto___1xn2A">
                                <div class="cardDetail__leftElt___1J_Se">
                                    <div class="cardDetail__title___1QGJ2">
                                        {{resources_data.name}}
                                    </div>
                                    <div>
                                        <div class="widgets__globalParagraph___2aU6y">
                                            <div v-html="resources_data.content"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pagePanel pagePanel__pagePanel___3fszW pagePanel__sider___3KzU1" style="flex:0 0 320px;max-width:320px;min-width:320px;width:320px">
                                <div class="cardDetail__rightElt___1INL0">
                                    <div class="relatePois__pois___3SUgw">
                                        <div class="relatePois__title___MokFL">相关地点</div>
                                        <div class="relatePois__poiItem___3Mu7X" v-for="item in resources_data.association" :key="item.id">
                                            <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4 relatePois__poiIcon___N8gWA">
                                                <img  src="/lushu/static/svg/icon-29.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                            <span> {{item.value}}</span>
                                        </div>
                                    </div>
                                    <div class="sideTags__tagsContainer___1A0zO">
                                        <div class="sideTags__title___31b98">标签</div>
                                        <div class="materialFilterTags__container___Dj1ek">
                                            <div class="materialFilterTags__wrapped___GA1ii">
                                                <span class="materialFilterTags__tag___1x6Ei" v-for="item in resources_data.label" :key="item.id">{{item.label}}</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="cardDetail__section___2NA3K">
                                        <div class="cardDetail__subHeader___2dwFz">
                                            笔记封面
                                        </div>
                                        <div class="cardDetail__image___2N3AU" v-if="resources_data.picture">
                                            <span :style="'background-image:url('+resources_data.picture+')'" class="cardDetail__roundCorner___1twNK widgets__lushuBackgroundImage___3XMmZ"></span>
                                        </div>
                                    </div>
                                    <div class="relateDestinations__destinationContainer___1kzC4" v-if="resources_data.address">
                                        <div class="relateDestinations__title___YuZMc">相关目的地</div>
                                        <div class="relateDestinations__destText___Huluv">
                                            <div v-for="(item,index) in resources_data.address" :key="index"  class="destinationListText__destinationListText___3ly9q" style="justify-content: start;">
                                                <div class="destinationListText__item___3FMZT">
<!--                                                    <span class="destinationListText__country___GMItw">中国</span>-->
                                                    <span>{{item}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="versionInfo__container___3jWaV">
                                        <div class="versionInfo__title___2Vm_j">
                                            版本信息
                                        </div>
                                        <div class="versionInfo__content___1VljP">
                                            <div>
                                                <div>
                                                    最后编辑时间:
                                                </div>
                                                <div>
                                                    {{resources_data.time}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="versionInfo__content___1VljP">
                                            <div>
                                                <div>
                                                    创建人:
                                                </div>
                                                <div>
                                                    {{resources_data.user}}
                                                    {{resources_data.add_time}}

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
    </div>

    <!-- 新建poi -->
    <?php include(dirname(__FILE__,2) . '/layout/project_note.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_del.php');?>

</div>

</body>

</html>
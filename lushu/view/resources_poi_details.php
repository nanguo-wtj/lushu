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
                        <?php include(dirname(__FILE__,2) . '/layout/resources_top_poi.php');?>
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="pagePanel__pagePanelContainer___3FpIY
                                poiBasicInfo__fitHeight___20wjw">
                            <div class="pagePanel
                                    pagePanel__pagePanel___3fszW
                                    pagePanel__auto___1xn2A">
                                <div class="poiBasicInfo__leftElt___LuZys">
                                    <div class="poiBasicInfo__header___1ghKY">
                                        <div class="poiBasicInfo__poiTitle___2lHgy">{{resources_data.title}}</div>
                                        <button v-on:click="Poi_add()" type="button" class="ant-btn poiBasicInfo__editButton___3-iPI ant-btn-primary">
                                            <span>编辑</span>
                                        </button>
                                    </div>
                                    <div class="poiBasicInfo__leftContent___1GiUF">
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.en_title">
                                            <div class="keyValueDivider__key___3-UHy">英文名称</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.en_title}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.en_title"> </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.other_title">
                                            <div class="keyValueDivider__key___3-UHy">其他名称</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.other_title}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.type"> </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.type">
                                            <div class="keyValueDivider__key___3-UHy">POI类型</div>
                                            <span class="keyValueDivider__poiType___1V6YH">
                                                <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4">
                                                    <svg viewBox="64 64 896 896" class="" data-icon="poi-method-4" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                        <path d="M827.2
                                                                                    674.8H197.3c-26.5
                                                                                    0-50.9-13.2-65.5-35.3a78.2
                                                                                    78.2 0 0
                                                                                    1-6.5-74.1l155.6-361.3a77.8
                                                                                    77.8 0 0 1
                                                                                    60.5-46.5c27-4
                                                                                    53.7 6 71.4
                                                                                    26.9l151 178.5
                                                                                    72-59.7a78.47
                                                                                    78.47 0 0 1
                                                                                    63-17 78.22
                                                                                    78.22 0 0 1 54
                                                                                    36.6l141.3
                                                                                    232.7a78.3 78.3
                                                                                    0 0 1 1.3 79.1
                                                                                    78.01 78.01 0 0
                                                                                    1-68.2 40.1zM353
                                                                                    233.6h-.4c-.9.1-1.1.5-1.2
                                                                                    1L195.8
                                                                                    595.8c-.2.4-.3.8.1
                                                                                    1.5.5.7.9.7
                                                                                    1.3.7h629.9c.5 0
                                                                                    .9 0
                                                                                    1.4-.8s.2-1.2
                                                                                    0-1.6L687.2
                                                                                    362.9c-.1-.2-.4-.6-1.1-.7-.7-.1-1.1.2-1.3.3l-101.2
                                                                                    83.9a38.4 38.4 0
                                                                                    0
                                                                                    1-53.8-4.8L354.1
                                                                                    234.2c-.2-.3-.5-.6-1.1-.6zm307.3
                                                                                    99.3zm135.1
                                                                                    444.5H226.5c-18.9
                                                                                    0-34.1-15.3-34.1-34.1s15.3-34.1
                                                                                    34.1-34.1h568.9c18.9
                                                                                    0 34.1 15.3 34.1
                                                                                    34.1s-15.2
                                                                                    34.1-34.1
                                                                                    34.1zM737.6
                                                                                    870H284.4c-18.9
                                                                                    0-34.1-15.3-34.1-34.1s15.3-34.1
                                                                                    34.1-34.1h453.2c18.9
                                                                                    0 34.1 15.3 34.1
                                                                                    34.1S756.4 870
                                                                                    737.6 870z">
                                                        </path>
                                                    </svg>
                                                </i>
                                                <span class="keyValueDivider__poiType___1V6YH">
                                                    {{resources_data.type}}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.type"> </div>

                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.phone">
                                            <div class="keyValueDivider__key___3-UHy">电话</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.phone}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.phone">
                                        </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.official_web">
                                            <div class="keyValueDivider__key___3-UHy">网址</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.official_web}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.official_web"> </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.opening_hours">
                                            <div class="keyValueDivider__key___3-UHy">开放时间</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.opening_hours}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.opening_hours">
                                        </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.consumption">
                                            <div class="keyValueDivider__key___3-UHy">消费</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.consumption}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.consumption">
                                        </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.traffic">
                                            <div class="keyValueDivider__key___3-UHy">交通</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.traffic}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.traffic">
                                        </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.time_reference">
                                            <div class="keyValueDivider__key___3-UHy">用时参考</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.time_reference}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.time_reference">
                                        </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.introduction">
                                            <div class="keyValueDivider__key___3-UHy">地点简介</div>
                                            <div class="keyValueDivider__value___2TZgL">{{resources_data.introduction}}</div>
                                        </div>
                                        <div class="poiBasicInfo__divider___35Vw5 ant-divider ant-divider-horizontal" v-if="resources_data.introduction">
                                        </div>
                                        <div class="keyValueDivider__container___3EuXB" v-if="resources_data.guide">
                                            <div class="keyValueDivider__key___3-UHy">实用指南</div>
                                            <div class="keyValueDivider__value___2TZgL" v-html="resources_data.guide"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pagePanel
                                    pagePanel__pagePanel___3fszW
                                    pagePanel__sider___3KzU1" style="flex: 0 0 320px; max-width: 320px;
                                    min-width: 320px; width: 320px;">
                                <div class="poiBasicInfo__rightElt___NFJ6d">
                                    <div class="poiBasicInfo__section___kf9rl">
                                        <div class="poiBasicInfo__subHeader___3SUzN">地理位置</div>
                                        <div class="poiBasicInfo__poiLocation___32BHD" >
                                            <iframe v-if="project_data.lng && project_data.lat" :src="'layout/map_view.php?lng='+project_data.lng+'&lat='+project_data.lat" width="100%" height="100%"></iframe>
                                            <div class="poiBasicInfo__showMapBar___1oQnK">点击展开地图查看</div>
                                        </div>
                                        <div class="poiBasicInfo__address___1abUi">{{resources_data.address}}</div>
                                    </div>
                                    <div class="relateDestinations__destinationContainer___1kzC4">
                                        <div class="relateDestinations__title___YuZMc">相关目的地</div>
                                        <div class="relateDestinations__destText___Huluv">
                                            <div class="destinationListText__destinationListText___3ly9q" style="justify-content:
                                                    start;">
                                                <div class="destinationListText__item___3FMZT" v-for="(item,index) in resources_data.address_code" :key="index">
<!--                                                    <span class="destinationListText__country___GMItw">德国</span>-->
                                                    <span>{{item}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="versionInfo__container___3jWaV">
                                        <div class="versionInfo__title___2Vm_j">版本信息</div>
                                        <div class="versionInfo__content___1VljP">
                                            <div>
                                                <div>最后编辑时间:</div>
                                                <div>{{resources_data.time}}</div>
                                            </div>
                                        </div>
                                        <div class="versionInfo__content___1VljP">
                                            <div>
                                                <div>创建人:</div>
                                                <div>{{resources_data.user}} </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slideDownMap poiLocationMap
                                tosProjectCssMarker">
                            <div class="mapContent">
                                <a href="javascript:void(0)" class="closeMapBtn">
                                    <i class="icon-close"></i>
                                </a>
                            </div>
                            <div>
                                <div class="showMapTransition"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
        </div>
    </div>

    <!-- 新建poi -->
    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_add.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_del.php');?>
</div>

</body>

</html>
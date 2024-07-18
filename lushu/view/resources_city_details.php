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
                        $add_type =   'add';
                        $superior_name  =   '城市名称库';
                        $superior_url   =   'resources_city';
                        include(dirname(__FILE__,2) . '/layout/resources_top_details.php');?>
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="pagePanel__pagePanelContainer___3FpIY">
                            <div class="pagePanel pagePanel__pagePanel___3fszW cityDetail__leftElt___fH15w pagePanel__auto___1xn2A">
                                <div class="cityDetail__item___zjFE8">
                                    <div class="cityDetail__key___2hJ7z">
                                        城市中文名称:
                                    </div>
                                    <div class="cityDetail__value___1JX2Z">
                                        {{resources_data.name}}
                                    </div>
                                    <div class="ant-divider ant-divider-horizontal"></div>
                                </div>
                                <div class="cityDetail__item___zjFE8">
                                    <div class="cityDetail__key___2hJ7z">
                                        城市英文名称:
                                    </div>
                                    <div class="cityDetail__value___1JX2Z">
                                        {{resources_data.en_name}}
                                    </div>
                                    <div class="ant-divider ant-divider-horizontal"></div>
                                </div>
                                <div class="cityDetail__item___zjFE8">
                                    <div class="cityDetail__key___2hJ7z">
                                        国家/地区:
                                    </div>
                                    <div class="cityDetail__value___1JX2Z">
                                        {{resources_data.parent_name}}
                                    </div>
                                    <div class="ant-divider ant-divider-horizontal"></div>
                                </div>
                            </div>
                            <div class="pagePanel pagePanel__pagePanel___3fszW cityDetail__rightElt___3zSnP pagePanel__sider___3KzU1" style="flex:0 0 320px;max-width:320px;min-width:320px;width:320px">
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
                                                {{resources_data.user}} {{resources_data.add_time}}
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
    <?php include(dirname(__FILE__,2) . '/layout/project_city.php');?>
    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_del.php');?>

</div>

</body>

</html>
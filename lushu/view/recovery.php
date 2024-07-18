<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<body class="appName-workbench">
<style>
    .projectLibrary__avatarsAndQuickContainer___22ioE:hover{

    }
</style>

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
                        <?php include(dirname(__FILE__,2) . '/layout/project_list_top.php');?>

                        <div class="clear basicLayout__subRow___1Crow">
                            <div class="clear tabsNav__tabNav___1-jmV">

                                <div class="tabsNav__tabsGroup___3G2wf tabsNav__tabsGroupRight___11F19" >
                                    <span class="tabsNav__tab___cgToo">回收站</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">

                        <?php include(dirname(__FILE__,2) . '/search/recovery.php');?>
                        <div class="pagePanel pagePanel__pagePanel___3fszW projectLibrary__tableContainer___OSXFw">
                            <div>
                                <div class="ant-table-wrapper ant-table-dark ant-table-inpanel ant-table-cursor projectLibrary__projectList___3dOOk">
                                    <div class="ant-spin-nested-loading">
                                        <div class="ant-spin-container">
                                            <div class="ant-table ant-table-default ant-table-scroll-position-left">
                                                <div class="ant-table-content">
                                                    <div class="ant-table-body">
                                                        <table class="">
                                                            <colgroup>
                                                                <col style="width:40px;min-width:40px">
                                                                <col style="width:30%;min-width:30%">
                                                                <col style="width:116px;min-width:116px">
                                                                <col>
                                                                <col style="width:200px;min-width:200px">
                                                            </colgroup>
                                                            <thead class="ant-table-thead">
                                                            <tr>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                </th>
                                                                <th class="">
                                                                    <div>
                                                                        <span class="projectLibrary__tableTitleCenter___aqgoA">项目信息</span>
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align:center">

                                                                </th>
                                                                <th class="">
                                                                    <div>
                                                                        <span class="projectLibrary__tableTitleCenter___aqgoA">行程信息</span>
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-right" style="text-align:right">
                                                                    <div>
                                                                        <span class="projectLibrary__tableTitleCenter___aqgoA">参与成员 </span>
                                                                    </div>
                                                                </th>
                                                                <th width="100" class="ant-table-align-right" style="text-align:right">
                                                                    <div>
                                                                        <span class="projectLibrary__tableTitleCenter___aqgoA">操作 </span>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody">
                                                            <tr v-if="project_list"  class="ant-table-row ant-table-row-level-0"   v-for="(item,index) in project_list" :key="index"  >
                                                                <td class="" style="text-align:center">

                                                                </td>
                                                                <td class="">
                                                                    <div class="projectLibrary__projectInfo___2qPeS">
                                                                        <div class="projectLibrary__titleContainer___3YQqN">
                                                                            <div id="antd-pro-ellipsis-168653441611467" class="index__ellipsis___29TdG projectLibrary__title___33ADX index__lineClamp___3S2HX">
                                                                                {{item.title}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="projectLibrary__latestModified___3z_o2">
                                                                            <div id="antd-pro-ellipsis-168653441611417" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                                最近更新
                                                                                <!-- -->：
                                                                                <!-- -->{{item.time}}
                                                                                <span class="projectLibrary__lastOperator___3_Q1C">{{item.user.name}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align:center">

                                                                </td>
                                                                <td class="">
                                                                    <div class="tripInfoView__tripInfo___1AFfG">
                                                                        <div class="tripInfoView__top___Rl7dS">
                                                                            <div id="antd-pro-ellipsis-168653441611434" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                                <style>

                                                                                </style>
                                                                                <i aria-label="图标: calendar" class="anticon anticon-calendar tripInfoView__icon___13HLt">
                                                                                    <img src="/lushu/static/svg/icon-14.svg" style="width: 0.8rem;height: 0.8rem">
                                                                                </i>
                                                                                <span class="tripInfoView__depart___ozY0R">{{item.setout.time}}</span>·
                                                                                <span class="tripInfoView__departCity___22uGG">{{item.setout.adress}}</span>·
                                                                                <span class="tripInfoView__duration___1dq2x">{{item.setout.duration}}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tripInfoView__bottom___1fr_-">
                                                                            <div id="antd-pro-ellipsis-168653441611494" class="index__ellipsis___29TdG index__lineClamp___3S2HX">

                                                                                <i aria-label="图标: location-city" class="anticon anticon-location-city tripInfoView__icon___13HLt">
                                                                                    <img src="/lushu/static/svg/icon-5.svg" style="width: 0.8rem;height: 0.8rem">
                                                                                </i>{{item.trip}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align: right;">
                                                                    <div class="projectLibrary__avatarsAndQuickContainer___22ioE">
                                                                        <div class="projectLibrary__avatarContainer___2UXHC">
                                                                            <span class=" projectLibrary__avatar___2CZwr">
                                                                                <span class="avatar__avatarInner___1y0H-">
                                                                                    <span class="ant-avatar ant-avatar-circle" style="background-color: rgb(89, 157, 250);">
                                                                                        <span class="ant-avatar-string" style="transform: scale(1) translateX(-50%);">{{item.user.name}}</span>
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>


                                                                </td>
                                                                <td style="text-align: right;" >
                                                                    <div class="project_list">
                                                                        <i aria-label="图标: ellipsis" class="anticon anticon-ellipsis ant-dropdown-trigger" >
                                                                            <img src="/lushu/static/svg/icon-109.svg" style="width: 0.8rem;height: 0.8rem">
                                                                        </i>
                                                                        <ul  style="position: absolute;display: none;"  class="ant-dropdown-menu ant-dropdown-menu-light ant-dropdown-menu-root ant-dropdown-menu-vertical" role="menu">
                                                                            <li class="ant-dropdown-menu-item" role="menuitem" v-on:click="Restore(item)">恢复内容</li>
                                                                            <li class="ant-dropdown-menu-item" role="menuitem"  v-on:click="Completely(item)">彻底删除</li>
                                                                        </ul>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagePanel pagePanel__pagePanel___3fszW libraryPageBase__footer___19ORW">
                            <div class="widgets__paginationWrap___1QI1J"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
        </div>
    </div>

    <!-- 通知 -->
    <?php include(dirname(__FILE__,2) . '/layout/notice.php');?>

    <?php include(dirname(__FILE__,2) . '/layout/resources_poi_del.php');?>
    <!-- 通知 -->
    <?php include(dirname(__FILE__,2) . '/layout/notice.php');?>


</div>



</body>

</html>
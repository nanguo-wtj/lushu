<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<body class="appName-workbench">
<style>
    #antd-pro-ellipsis-168653441611467 {
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    #antd-pro-ellipsis-168653441611417 {
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    #antd-pro-ellipsis-168653441611434 {
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    #antd-pro-ellipsis-168653441611494 {
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
    .el-date-editor{
        height: 0;
    }
</style>

<!-- Google Tag Manager -->

<!-- End Google Tag Manager -->
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

          <!--              <div class="clear basicLayout__subRow___1Crow">-->
          <!--                  <div class="clear tabsNav__tabNav___1-jmV">-->
          <!--                      <div class="tabsNav__tabsGroup___3G2wf">-->
										<!--<span class="tabsNav__tab___cgToo tabsNav__active___3OOMW">全部</span>-->
          <!--                      </div>-->
          <!--                      <div onclick="location.href='./recovery.html'" class="tabsNav__tabsGroup___3G2wf tabsNav__tabsGroupRight___11F19" >-->
          <!--                          <span class="tabsNav__tab___cgToo">回收站</span>-->
          <!--                      </div>-->
          <!--                  </div>-->
          <!--              </div>-->
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <!---->
                         <div class="clear basicLayout__subRow___1Crow">
                            <div class="clear tabsNav__tabNav___1-jmV">
                                <div class="tabsNav__tabsGroup___3G2wf">
										<span class="tabsNav__tab___cgToo tabsNav__active___3OOMW">全部</span>
                                </div>
                                <div onclick="location.href='./recovery.html'" class="tabsNav__tabsGroup___3G2wf tabsNav__tabsGroupRight___11F19" >
                                    <span class="tabsNav__tab___cgToo">回收站</span>
                                </div>
                            </div>
                        </div>
                        <!---->

                        <?php include(dirname(__FILE__,2) . '/search/project.php');?>
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
                                                                    <div></div>
                                                                </th>
                                                                <th class="">
                                                                    <div>
                                                                        <span class="projectLibrary__tableTitleCenter___aqgoA">项目信息</span>
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                    <div>
                                                                        项目状态
                                                                    </div>
                                                                </th>
                                                                <th class="">
                                                                    <div>
                                                                        <span class="projectLibrary__tableTitleCenter___aqgoA">行程信息</span>
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-right" style="text-align:right">
                                                                    <div>
                                                                        <span class="projectLibrary__tableTitleCenter___aqgoA">参与成员</span>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody">
                                                            <tr v-if="project_list"  class="ant-table-row ant-table-row-level-0"   v-for="(item,index) in project_list" :key="index"  v-on:click="project_detail(item)">
                                                                <td class="" style="text-align:center">
                                                                    <span style="padding-left:0px" class="ant-table-row-indent indent-level-0"></span>
                                                                    <div class="projectLibrary__starContainer___N5117" v-on:click="Collect(item)">
                                                                        <i aria-label="图标: star" tabindex="-1" class="anticon anticon-star projectLibrary__star___1IeqA">
                                                                            <img v-if="item.travel == 0" src="/lushu/static/svg/icon-33.svg" style="width: 1.3rem; height: 1.3rem;max-width:unset;">
                                                                            <img v-if="item.travel == 1" src="/lushu/static/svg/icon-33s.svg" style="width: 1.3rem; height: 1.3rem;max-width:unset;">
                                                                        </i>
                                                                    </div>
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
                                                                    <div v-if="item.is_sale == 0">
                                                                        <i aria-label="图标: project-status-1" class="anticon anticon-project-status-1 projectLibrary__statusDeveloping___w7uOR">
                                                                            <img src="/lushu/static/svg/icon-89.svg" style="width: 0.8rem;height: 0.8rem">
                                                                        </i>
                                                                        <span  class="projectLibrary__statusName___3XNc-">制作中</span>
                                                                    </div>
                                                                    <div v-if="item.is_sale == 1">
                                                                        <i aria-label="图标: project-status-1" class="anticon anticon-project-status-1 projectLibrary__statusDeveloping___w7uOR">
                                                                            <img src="/lushu/static/svg/icon-891.svg" style="width: 0.8rem;height: 0.8rem">
                                                                        </i>
                                                                        <span  class="projectLibrary__statusName___3XNc-">已完成</span>
                                                                    </div>
                                                                    <div v-if="item.is_sale == 2">
                                                                        <i aria-label="图标: project-status-1" class="anticon anticon-project-status-1 projectLibrary__statusDeveloping___w7uOR">
                                                                            <img src="/lushu/static/svg/icon-892.svg" style="width: 0.8rem;height: 0.8rem">
                                                                        </i>
                                                                        <span  class="projectLibrary__statusName___3XNc-">已关闭</span>
                                                                    </div>

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
                                                                        <!-- 鼠标移入时 -->
                                                                        <div class="projectLibrary__quickButtonContainer___1iQxa ant-popover-hidden">
                                                                            <button type="button" class="ant-btn projectLibrary__btnEdit___4xGYA ant-btn-primary ant-btn-lg" v-on:click="Edit_project(item)"><span>编辑行程</span></button>
                                                                            <button id="project_caoz" type="button" class="ant-btn ant-dropdown-trigger ant-btn-primary ant-btn-lg">
                                                                                <i aria-label="图标: ellipsis" class="anticon anticon-ellipsis">
                                                                                    <img src="/lushu/static/svg/icon-12.svg" style="width: 0.8rem;height: 0.8rem">
                                                                                </i>
                                                                                <!-- 项目相关 -->
                                                                                <div class="project-operations" >
                                                                                    <div>
                                                                                        <div class="ant-dropdown ant-dropdown-placement-bottomLeft ant-popover-hidden" style="left: -40px; top: 45px;">
                                                                                            <ul class="ant-dropdown-menu ant-dropdown-menu-light ant-dropdown-menu-root ant-dropdown-menu-vertical" role="menu">
                                                                                                <li class="ant-dropdown-menu-item" role="menuitem"  v-on:click="Copy_project(item)">复制项目</li>
                                                                                                <li class=" ant-dropdown-menu-item-divider"></li>
                                                                                                <li :class="item.is_sale == 0?'ant-dropdown-menu-item ant-dropdown-menu-item-active':'ant-dropdown-menu-item  ant-dropdown-menu-item-disabled' " v-on:click="Complete_project(item)">完成项目</li>
                                                                                                <li :class="item.is_sale == 0?'ant-dropdown-menu-item ':'ant-dropdown-menu-item ant-dropdown-menu-item-disabled' " v-on:click="Close_project(item)">关闭项目</li>
                                                                                                <li class="ant-dropdown-menu-item" role="menuitem" v-on:click="Del_project(item)">删除项目</li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <!-- 鼠标移出时 -->
                                                                    <div class="projectLibrary__avatarContainer___2UXHC">
                                                                                <span class="an-avatar projectLibrary__avatar___2CZwr avatar__avatar___4NUXc">
                                                                                    <span class="avatar__avatarInner___1y0H-">
                                                                                        <span class="ant-avatar ant-avatar-circle" style="background-color: rgb(89, 157, 250);">
                                                                                            <span class="ant-avatar-string" style="transform: scale(1) translateX(-50%);">{{item.user.name}}</span>
                                                                                        </span>
                                                                                    </span>
                                                                                </span>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widgets__empty___8_50e widgets__large___1ny40" v-if="project_list.length < 1">
                                                <div class="widgets__header___3RBY_">
                                                    暂无数据
                                                </div>
                                                <div class="widgets__description___3PlNA"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include(dirname(__FILE__,2) . '/layout/page_list.php');?>

                    </div>
                </div>
            </div>
            <div class="authWatcher accessoryWrapper "></div>
            <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
        </div>
    </div>
    <!-- 创建项目 -->
    <?php include(dirname(__FILE__,2) . '/layout/add_project.php');?>

    <!-- 添加协作者 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_collaborator.php');?>
    <!-- 通知 -->
    <?php include(dirname(__FILE__,2) . '/layout/notice.php');?>

    <!--    项目详细信息-->
    <?php include(dirname(__FILE__,2) . '/layout/project_information.php');?>
    <!--    复制项目-->
    <?php include(dirname(__FILE__,2) . '/layout/Copy_project.php');?>
    <!--    完成项目-->
    <?php include(dirname(__FILE__,2) . '/layout/Complete_project.php');?>
    <!--    关闭项目-->
    <?php include(dirname(__FILE__,2) . '/layout/Close_project.php');?>
    <!--    删除项目-->
    <?php include(dirname(__FILE__,2) . '/layout/Del_project.php');?>




</div>
<!-- 通知 -->
<div class="notice" style="display: none;"></div>



</body>

</html>
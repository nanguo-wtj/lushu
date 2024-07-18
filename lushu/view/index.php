<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');
    $Day_list    =   GetDay7();
?>

<body class="appName-workbench">
<!-- Google Tag Manager -->

<script>

    (function (w, d, s, l, i) {
        w[l] = w[l] || []; w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        }); var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NW2CSP');</script>
<!-- End Google Tag Manager -->
<div id="webMain" ref="pageTop">
    <div>
        <div class="">
            <div id="pageWrap" class="basicLayout__basicLayout___3_npk homepage__pageHome___3fq4d">
                <div class="transitIndicator__transitIndicator___3m8Gd">
                    <div class="transitIndicator__transitBar___2q3uc"></div>
                </div>
                <!-- 导入导航栏目  -->
                <?php include(dirname(__FILE__,2) . '/layout/menu.php');?>

                <div class="basicLayout__layoutMain___1NUHo">
                    <div class="pageTopBar basicLayout__pageTopBar___3r1fF">

                        <!-- 导入顶部栏目  -->
                        <?php include(dirname(__FILE__,2) . '/layout/top.php');?>
                    </div>

                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="pagePanel__pagePanelContainer___3FpIY">
                            <div class="homepage__leftMainContainer___24qi0">
                                <div class="ant-row">
                                    <div class="ant-col-12">
                                        <div class="pagePanel pagePanel__pagePanel___3fszW homepage__topBox___1Iukd">
                                            <div class="headerRow pagePanel__headerRow___3m5MI pagePanel__subHeader___18-Ex">
                                                <div class="pagePanel__leftSection___1fa4I">
                                                    <div class="pagePanel__title___xcib4">
                                                        项目统计
                                                    </div>
                                                    <div class="pagePanel__leftAction___1ekDO"></div>
                                                </div>
                                                <div class="pagePanel__actionGroup___2s1HV"></div>
                                            </div>
                                            <div class="homepage__statisticsBox___3uuZ1" >
                                                <div class="homepage__box___1CTXF" v-for="item in count_list" :key="item.id">
                                                    <div class="homepage__count___whbhC">
                                                        {{item.number}}
                                                    </div>{{item.prompt}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="ant-col-12">
                                        <div class="pagePanel pagePanel__pagePanel___3fszW homepage__topBox___1Iukd homepage__chartTrendPanel___iaexn">
                                            <div class="headerRow pagePanel__headerRow___3m5MI pagePanel__subHeader___18-Ex">
                                                <div class="pagePanel__leftSection___1fa4I">
                                                    <div class="pagePanel__title___xcib4">
                                                        出行项目走势
                                                    </div>
<!--                                                    <div class="pagePanel__leftAction___1ekDO">-->
<!--                                                        <div class="ant-select-sm homepage__leftActionSelect___35dVz ant-select-no-border ant-select ant-select-enabled">-->
<!--                                                            <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="" aria-expanded="false" tabindex="0">-->
<!--                                                                <div class="ant-select-selection__rendered">-->
<!--                                                                    <div class="ant-select-selection-selected-value" title="天"-->
<!--                                                                         style="display:block;opacity:1">-->
<!--                                                                        天-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                                <span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none" unselectable="on">-->
<!--                                                                    <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">-->
<!--                                                                        <img src="/lushu/static/svg/icon-1.svg" style="width: 1rem;height: 1rem">-->
<!--                                                                    </i>-->
<!--                                                                </span>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                </div>
                                                <div class="pagePanel__actionGroup___2s1HV">
                                                    <div class="ant-radio-group ant-radio-group-outline homepage__chartRadioGroup___1qWPj">
                                                        <label v-on:click="set_Project_day(1)" :class="trendStatus == false? 'ant-radio-button-wrapper ant-radio-button-wrapper-checked':'ant-radio-button-wrapper'">
                                                            <span class="ant-radio-button ant-radio-button-checked">
                                                                <span class="ant-radio-button-inner"></span>
                                                            </span>
                                                            <span>制作中</span>
                                                        </label>
                                                        <label v-on:click="set_Project_day(2)" :class="trendStatus == true? 'ant-radio-button-wrapper ant-radio-button-wrapper-checked':'ant-radio-button-wrapper'">
                                                            <span class="ant-radio-button">
                                                                <span class="ant-radio-button-inner"></span>
                                                            </span>
                                                            <span>已完成</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="homepage__chartTrend___ncS-7">
                                                <div id="main" style="width: 100%;height:100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pagePanel pagePanel__pagePanel___3fszW homepage__projectPanel___37FsH">
                                    <div class="headerRow pagePanel__headerRow___3m5MI pagePanel__subHeader___18-Ex">
                                        <div class="pagePanel__leftSection___1fa4I">
                                            <div class="pagePanel__title___xcib4">
                                                出行项目
                                            </div>
                                            <div class="pagePanel__leftAction___1ekDO"></div>
                                        </div>
                                        <div class="pagePanel__actionGroup___2s1HV">
                                            <!--<label class="homepage__starCheck___nxVnl ant-checkbox-wrapper">
                                                <span class="ant-checkbox" onclick="selectCheck(this)">
                                                    <input type="checkbox" class="ant-checkbox-input" name="star" value="true">
                                                    <span class="ant-checkbox-inner"></span>
                                                </span>
                                                <span>星标项目</span>
                                            </label>
                                            <div class="homepage__selectWrap___Mj5K_">
                                                <div class="ant-select-sm ant-select-no-border ant-select ant-select-enabled">
                                                    <div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="" aria-expanded="false" tabindex="0">
                                                        <div class="ant-select-selection__rendered">
                                                            <div class="ant-select-selection-selected-value" title="排序: 按更新时间"
                                                                 style="display:block;opacity:1">
                                                                排序: 按更新时间
                                                            </div>
                                                        </div>
                                                        <span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none" unselectable="on">
                                                            <i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                                                                <img src="/lushu/static/svg/icon-1.svg" style="width: 1rem;height: 1rem">
                                                            </i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <span>
                                                <button type="button" class="ant-btn ant-btn-primary created-btn" v-on:click="CreateProject">
                                                    <i aria-label="图标: plus" class="anticon anticon-plus">
                                                        <img src="/lushu/static/svg/icon-2.svg" style="width: 1rem;height: 1rem">
                                                    </i>
                                                    <span>创建项目</span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="ant-table-wrapper ant-table-dark ant-table-inpanel ant-table-cursor projectLibrary__projectList___3dOOk homepage__projectTable___Lu4wX">
                                            <div class="ant-spin-nested-loading">
                                                <div class="ant-spin-container">
                                                    <div class="ant-table ant-table-default ant-table-scroll-position-left">
                                                        <div class="ant-table-content">
                                                            <div class="ant-table-body">
                                                                <table class="">
                                                                    <colgroup>
                                                                        <col style="width: 40px; min-width: 40px;">
                                                                        <col style="width: 30%; min-width: 30%;">
                                                                        <col>
                                                                        <col style="width: 200px; min-width: 200px;">
                                                                    </colgroup>

                                                                    <tbody class="ant-table-tbody">
                                                                    <tr v-if="project_list" class="ant-table-row ant-table-row-level-0" data-row-key="7NkPJYl8"  v-for="item in project_list" :key="item.id"  v-on:click="project_detail(item)">
                                                                        <td class="" style="text-align: center;">
                                                                            <span class="ant-table-row-indent indent-level-0" style="padding-left: 0;"></span>
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
                                                                                    <div id="antd-pro-ellipsis-168655716756225"
                                                                                         class="index__ellipsis___29TdG projectLibrary__title___33ADX index__lineClamp___3S2HX">
                                                                                        <style>
                                                                                            #antd-pro-ellipsis-168655716756225 {
                                                                                                -webkit-line-clamp: 1;
                                                                                                -webkit-box-orient: vertical;
                                                                                            }
                                                                                        </style>{{item.title}}
                                                                                    </div>
<!--                                                                                    <span class="projectLibrary__planName___22CDr">方案 1</span>-->
                                                                                </div>
                                                                                <div class="projectLibrary__latestModified___3z_o2">
                                                                                    <div id="antd-pro-ellipsis-168655716756264"
                                                                                         class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                                        <style>
                                                                                            #antd-pro-ellipsis-168655716756264 {
                                                                                                -webkit-line-clamp: 1;
                                                                                                -webkit-box-orient: vertical;
                                                                                            }
                                                                                        </style>
                                                                                        最近更新：{{item.time}}
                                                                                        <span class="projectLibrary__lastOperator___3_Q1C">{{item.user.name}}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="">
                                                                            <div class="tripInfoView__tripInfo___1AFfG">
                                                                                <div class="tripInfoView__top___Rl7dS">
                                                                                    <div id="antd-pro-ellipsis-168655716756258" class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                                        <style>
                                                                                            #antd-pro-ellipsis-168655716756258 {
                                                                                                -webkit-line-clamp: 1;
                                                                                                -webkit-box-orient: vertical;
                                                                                            }
                                                                                        </style>
                                                                                        <i aria-label="图标: calendar" class="anticon anticon-calendar tripInfoView__icon___13HLt">
                                                                                            <img src="/lushu/static/svg/icon-4.svg" style="width: 0.8rem;height: 0.8rem">
                                                                                        </i>
                                                                                        <span class="tripInfoView__depart___ozY0R">{{item.setout.time}}</span>·
                                                                                        <span class="tripInfoView__departCity___22uGG">{{item.setout.adress}}</span>·
                                                                                        <span class="tripInfoView__duration___1dq2x">{{item.setout.duration}}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="tripInfoView__bottom___1fr_-">
                                                                                    <div id="antd-pro-ellipsis-16865571675632"
                                                                                         class="index__ellipsis___29TdG index__lineClamp___3S2HX">
                                                                                        <style>
                                                                                            #antd-pro-ellipsis-16865571675632 {
                                                                                                -webkit-line-clamp: 1;
                                                                                                -webkit-box-orient: vertical;
                                                                                            }
                                                                                        </style>
                                                                                        <i aria-label="图标: location-city" class="anticon anticon-location-city tripInfoView__icon___13HLt">
                                                                                            <img src="/lushu/static/svg/icon-5.svg" style="width: 0.8rem;height: 0.8rem">
                                                                                        </i>
                                                                                        {{item.trip}}
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="homepage__rightSubContainer___2NxS4">

                                <div class="pagePanel pagePanel__pagePanel___3fszW resource__resourceCenter___3tYp8">
                                    <div class="headerRow pagePanel__headerRow___3m5MI pagePanel__subHeader___18-Ex">
                                        <div class="pagePanel__leftSection___1fa4I">
                                            <div class="pagePanel__title___xcib4">
                                                旅行资源中心
                                            </div>
                                            <div class="pagePanel__leftAction___1ekDO"></div>
                                        </div>
                                        <div class="pagePanel__actionGroup___2s1HV"></div>
                                    </div>
                                    <div class="resource__btnResourceList___KK0Bs">
                                        <div class="ant-row" style="margin-left:-4px;margin-right:-4px">
                                            <div v-for="(item,index) in ResourcesAll" :key="index" style="padding-left:4px;padding-right:4px" class="ant-col-12">
                                                <a class="globalLink resource__btnResource___gF3Wf" :href="item.url">
                                                    <i aria-label="图标: find-route" class="anticon anticon-find-route resource__icon___2kCyE">
                                                        <img :src="item.img" style="width: 2rem;height: 2rem">
                                                    </i>
                                                    <div class="resource__btmCont___46RNz">
                                                        <div class="resource__title___WDXfR">
                                                            {{item.title}}
                                                        </div>
                                                        <div class="resource__intro___28GSP">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="resource__resourceListHeader___3BzXA">
                                        <div class="resource__header___3_8WA">
                                            资源由以下合作伙伴提供
                                        </div>
                                        <div class="resource__btnMore___1L6R0">
                                            <button type="button" class="ant-btn ant-btn-link">
                                                <a class="globalLink globalLink" href="./home.html">查看更多
                                                    <i aria-label="图标: right" class="anticon anticon-right">
                                                        <img src="/lushu/static/svg/icon-10.svg" style="width: 1rem;height: 1rem">
                                                    </i>
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="resource__resourceList___2sJ18"></div>
                                </div>
                            </div>

                            -->

                        </div>
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
    <!-- 选择成员 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_members.php');?>
</div>
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

</body>



</html>
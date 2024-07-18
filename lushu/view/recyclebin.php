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

                        <div class="pagePanel pagePanel__pagePanel___3fszW recycleLibrary__panelLeftMenu___34rkj">
                            <div class="recycleLibrary__leftMenu___2lQO5">
                                <ul class="ant-menu ant-menu-light ant-menu-root ant-menu-inline" role="menu">
                                    <li v-for="(item,index) in menu" :key="index" :class="item.status == true ?'ant-menu-item ant-menu-item-selected':'ant-menu-item'" v-on:click="GetMenu(item)"  style="padding-left: 24px;">
                                        <a class="globalLink globalLink" href="javascript:">{{item.title}}</a>
                                    </li>

                                </ul>
                            </div>
                            <div>
                                <div class="ant-table-wrapper ant-table-dark recycleLibrary__recycleTable____TksN">
                                    <div class="ant-spin-nested-loading">
                                        <div class="ant-spin-container">
                                            <div class="ant-table ant-table-default ant-table-empty ant-table-scroll-position-left">
                                                <div class="ant-table-content">
                                                    <div class="ant-table-body">
                                                        <table class="">
                                                            <colgroup>
                                                                <col>
                                                                <col style="width: 20%; min-width: 20%;">
                                                                <col style="width: 20%; min-width: 20%;">
                                                                <col style="width: 140px; min-width: 140px;">
                                                            </colgroup>
                                                            <thead class="ant-table-thead">
                                                            <tr>
                                                                <th class="recycleLibrary__itemName___1_ac4">
                                                                    <div>名称</div>
                                                                </th>
                                                                <th class="">
                                                                    <div>删除时间</div>
                                                                </th>
                                                                <th class="recycleLibrary__deletedBy___XMDC2">
                                                                    <div>管理员</div>
                                                                </th>
                                                                <th class="">
                                                                    <div>操作</div>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody">
                                                            <tr v-for="(item,index) in recyclebin_list" :key="index" class="ant-table-row ant-table-row-level-0" data-row-key="dgWqlX8o">
                                                                <td class="recycleLibrary__itemName___1_ac4">
                                                                    {{item.title}}
                                                                </td>
                                                                <td class="">{{item.time}}</td>
                                                                <td class="recycleLibrary__deletedBy___XMDC2">{{item.user}}</td>
                                                                <td class="">
                                                                    <div class="recycleLibrary__operationGroup___3cvz1" v-on:click="restore(item)">
                                                                        <button preventspace="true" type="button" class="ant-btn ant-btn-link">
                                                                            <span>恢复</span>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div v-if="recyclebin_list.length < 1" class="ant-table-placeholder">
                                                        <div class="widgets__empty___8_50e widgets__large___1ny40">
                                                            <div class="widgets__header___3RBY_">暂无数据</div>
                                                            <div class="widgets__description___3PlNA"></div>
                                                        </div>
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
</div>



</body>
<script type="application/javascript">



</script>
</html>
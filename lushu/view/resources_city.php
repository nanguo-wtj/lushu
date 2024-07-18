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
                        <?php include(dirname(__FILE__,2) . '/search/resources_city.php');?>

                        <div>
                            <div class="pagePanel pagePanel__pagePanel___3fszW cityLibrary__fitHeight___3QoYS">
                                <div class="ant-table-wrapper ant-table-dark ant-table-inpanel ant-table-cursor">
                                    <div class="ant-spin-nested-loading">
                                        <div class="ant-spin-container">
                                            <div class="ant-table ant-table-default ant-table-empty ant-table-scroll-position-left">
                                                <div class="ant-table-content">
                                                    <div class="ant-table-body">
                                                        <table class="">
                                                            <colgroup>
                                                                <col>
                                                                <col style="width:388px;min-width:388px">
                                                                <col style="width:352px;min-width:352px">
                                                                <col style="width:148px;min-width:148px">
                                                            </colgroup>
                                                            <thead class="ant-table-thead">
                                                            <tr>
                                                                <th class="ant-table-align-start" style="text-align:start">
                                                                    <div>
                                                                        城市中文名称
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                    <div>
                                                                        城市英文名称
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                    <div>
                                                                        国家/地区
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                    <div>
                                                                        最后更新
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody">
                                                            <tr class="ant-table-row ant-table-row-level-0" data-row-key="mNAXangA" v-for="item in city_list" :key="item.id"  v-on:click="get_details(item.id)">
                                                                <td class="" style="text-align: start;">
                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                    <span class="cityLibrary__text___3K3Tw">{{item.region_name}}</span>
                                                                </td>
                                                                <td class="" style="text-align: center;">
                                                                    <span class="cityLibrary__text___3K3Tw">{{item.en_name}}</span>
                                                                </td>
                                                                <td class="" style="text-align: center;">
                                                                    <span class="cityLibrary__text___3K3Tw">{{item.parent_city}}</span>
                                                                </td>
                                                                <td class="" style="text-align: center;">
                                                                    <div>
                                                                        <div class="lastEditInfo__lastEditor___1kHQf">{{item.user}}</div>
                                                                        <div class="lastEditInfo__lastEdited___33kvU">{{item.time}}</div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="widgets__empty___8_50e widgets__large___1ny40" v-if="city_list.length < 1">
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
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- 多页面共用弹出页面 -->
    <?php include(dirname(__FILE__,2) . '/layout/foot.php');?>

    <!-- 新增城市 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_city.php');?>
</div>



</body>

</html>
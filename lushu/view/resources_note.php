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
                        <div>
                            <?php include(dirname(__FILE__,2) . '/search/resources_note.php');?>
                            <div class="pagePanel pagePanel__pagePanel___3fszW cardList__fitHeight___3k0Ym">
                                <div class="ant-table-wrapper ant-table-dark ant-table-inpanel ant-table-cursor cardList__table___2t2z8">
                                    <div class="ant-spin-nested-loading">
                                        <div class="ant-spin-container">
                                            <div class="ant-table ant-table-default ant-table-scroll-position-left">
                                                <div class="ant-table-content">
                                                    <div class="ant-table-body">
                                                        <table class="">
                                                            <colgroup>
                                                                <col>
                                                                <col style="width:248px;min-width:248px">
                                                                <col style="width:340px;min-width:340px">
                                                                <col style="width:148px;min-width:148px">
                                                            </colgroup>
                                                            <thead class="ant-table-thead">
                                                            <tr>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                    <div>
                                                                        名称
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                    <div>
                                                                        相关目的地
                                                                    </div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align:center">
                                                                    <div>
                                                                        标签
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
                                                            <tr v-for="item in project_note" :key="item.id"  class="ant-table-row ant-table-row-level-0" data-row-key="v8pZ6Wg7"  v-on:click="get_details(item.id)">
                                                                <td class="" style="text-align:center">
                                                                    <span style="padding-left:0px" class="ant-table-row-indent indent-level-0"></span>
                                                                    <div class="imageText__imageTextContainer___3YHZ8">
                                                                        <div class="imageText__image___2SuEP">
                                                                            <span v-if="!item.url" class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                                <div class="widgets__noImgCont___blaq6">
                                                                                    <i aria-label="图标: picture" style="font-size:26px" class="anticon anticon-picture">
                                                                                        <img  src="/lushu/static/svg/icon-23.svg" style="width: 1rem;height: 1rem">
                                                                                    </i>
                                                                                </div>
                                                                            </span>

                                                                            <span v-if="item.url" class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                                    <img :src="item.url" style="width: 100%;height: 100%">
                                                                            </span>
                                                                        </div>
                                                                        <div class="imageText__textContent___28V1T">
                                                                            <div class="imageText__name_cn___5kdN2">
                                                                                {{item.title}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align:center" >
                                                                    <div class="destinationListText__item___3FMZT"  v-for="(item_ad,index) in item.address" :key="index">
                                                                        <!--                                                                                <span class="destinationListText__country___GMItw">中国</span>-->
                                                                        <span>{{item_ad}}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align:center">
                                                                    <div class="materialFilterTags__container___Dj1ek">
                                                                        <div class="materialFilterTags__wrapped___GA1ii poiList__ellipsis___3pZOW">
                                                                            <span class="materialFilterTags__tag___1x6Ei" v-for="item_la in item.label" :key="item_la.id">{{item_la.label}}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align:center">
                                                                    <div>
                                                                        <div class="lastEditInfo__lastEditor___1kHQf">
                                                                            {{item.user}}
                                                                        </div>
                                                                        <div class="lastEditInfo__lastEdited___33kvU">
                                                                            {{item.time}}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widgets__empty___8_50e widgets__large___1ny40" v-if="project_note.length < 1">
                                                <div class="widgets__header___3RBY_">
                                                    暂无数据
                                                </div>
                                                <div class="widgets__description___3PlNA"></div>
                                            </div>
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
    <!-- 多页面共用弹出页面 -->
    <?php include(dirname(__FILE__,2) . '/layout/foot.php');?>
    <!-- 标签 -->
    <?php include(dirname(__FILE__,2) . '/layout/label.php');?>
    <!-- 新增笔记 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_note.php');?>
</div>

</body>

</html>
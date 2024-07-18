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


    .editPriceOptions:hover  .field.editing{
        background: #fff!important;
    }
    .field.editing input{
        background: #fff;
    }

    .tosPieceBox .btnDelete {
        opacity: 1!important;
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
                            <?php include(dirname(__FILE__,2) . '/search/resources_activities.php');?>

                            <div>
                                <div class="pagePanel pagePanel__pagePanel___3fszW templateList__fitHeight___2AYOX">
                                    <div class="ant-table-wrapper ant-table-dark ant-table-inpanel ant-table-cursor templateList__table___Mm8Yw">
                                        <div class="ant-spin-nested-loading">
                                            <div class="ant-spin-container">
                                                <div class="ant-table ant-table-default ant-table-scroll-position-left">
                                                    <div class="ant-table-content">
                                                        <div class="ant-table-body">
                                                            <table class="">
                                                                <colgroup>
                                                                    <col>
                                                                    <col style="width:268px;min-width:268px">
                                                                    <col style="width:148px;min-width:148px">
                                                                    <col style="width:180px;min-width:180px">
                                                                    <col style="width:148px;min-width:148px">
                                                                </colgroup>
                                                                <thead class="ant-table-thead">
                                                                <tr>
                                                                    <th class="ant-table-align-left" style="text-align:left">
                                                                        <div>
                                                                            名称
                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-align-center" style="text-align:center">
                                                                        <div>
                                                                            相关目的地
                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-column-has-actions ant-table-column-has-sorters ant-table-align-center" style="text-align:center">
                                                                        <div class="ant-table-column-sorters">
                                                                            标签

                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-align-center" style="text-align:center">
                                                                        <div>
                                                                            参考价格
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
                                                                    <tr v-for="(item,index) in ActivitiesList"  :key="index"  v-on:click="open_details(item)" class="ant-table-row ant-table-row-level-0" data-row-key="jgMBJYwN">
                                                                        <td class="" style="text-align:left">
                                                                            <span style="padding-left:0px" class="ant-table-row-indent indent-level-0"></span>
                                                                            <div class="imageText__imageTextContainer___3YHZ8">
                                                                                <div class="imageText__image___2SuEP">
                                                                                    <span class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                                        <div class="widgets__noImgCont___blaq6">
                                                                                            <i aria-label="图标: picture" style="font-size:26px" class="anticon anticon-picture">
                                                                                                <img v-if="!item.url" src="/lushu/static/svg/icon-104.svg" style="width: 1rem;height: 1rem">
                                                                                            </i>
                                                                                        </div>
                                                                                        <img v-if="item.url" :src="item.url" style="width: 100%;height: 100%">
                                                                                    </span>
                                                                                </div>
                                                                                <div class="imageText__textContent___28V1T">
                                                                                    <div class="imageText__name_cn___5kdN2">
                                                                                        {{item.title}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="" style="text-align:center">
                                                                            <span v-for="(a,b) in item.address">
                                                                                {{a}}
                                                                            </span>
                                                                        </td>
                                                                        <td class="ant-table-column-has-actions ant-table-column-has-sorters" style="text-align:center">
                                                                            <div class="materialFilterTags__container___Dj1ek">
                                                                                <div class="materialFilterTags__wrapped___GA1ii hotelLibrary__ellipsis___2TfjJ">
                                                                                    <span v-for="(a,b) in item.label" class="materialFilterTags__tag___1x6Ei">
                                                                                        {{a.label}}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="" style="text-align:center">- -</td>
                                                                        <td class="" style="text-align:center">
                                                                            <div>
                                                                                 <p>{{item.time}}</p>
                                                                                <p>{{item.user}}</p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widgets__empty___8_50e widgets__large___1ny40" v-if="ActivitiesList.length < 1">
                                                    <div class="widgets__header___3RBY_">
                                                        暂无数据
                                                    </div>
                                                    <div class="widgets__description___3PlNA"></div>
                                                </div>
                                            </div>
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

    <!-- 标签 -->
    <?php include(dirname(__FILE__,2) . '/layout/label.php');?>
    <!-- 多页面共用弹出页面 -->
    <?php include(dirname(__FILE__,2) . '/layout/foot.php');?>
    <!--编辑-->
    <!-- 地图 -->
    <div style="position:absolute;top:0">
        <?php include(dirname(__FILE__,2) . '/layout/resources_edit_activities.php');?>
    </div>
</div>
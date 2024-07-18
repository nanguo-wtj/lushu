<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>
<style>
    /* reset */
    html,body,h1,h2,h3,h4,h5,h6,div,dl,dt,dd,ul,ol,li,p,blockquote,pre,hr,figure,table,caption,th,td,form,fieldset,legend,input,button,textarea,menu{margin:0;padding:0;}
    ul,li{list-style-type: none}
    h1{font-size: 26px;}
    p{font-size: 14px; margin-top: 10px;}
    pre{padding:15px;margin-top: 15px;}
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
                        <?php include(dirname(__FILE__,2) . '/search/resources_hotel.php');?>

                        <div class="hotelLibrary__hotelList___gRwfO">
                            <div class="pagePanel pagePanel__pagePanel___3fszW hotelLibrary__fitHeight___1f4-e">
                                <div class="ant-table-wrapper ant-table-dark ant-table-inpanel ant-table-cursor hotelLibrary__table___2Np89">
                                    <div class="ant-spin-nested-loading">
                                        <div class="ant-spin-container">
                                            <div class="ant-table ant-table-default ant-table-scroll-position-left">
                                                <div class="ant-table-content">
                                                    <div class="ant-table-body">
                                                        <table class="">
                                                            <colgroup>
                                                                <col>
                                                                <col style="width: 170px; min-width: 170px;">
                                                                <col style="width: 250px; min-width: 250px;">
                                                                <col style="width: 152px; min-width: 152px;">
                                                                <col style="width: 180px; min-width: 180px;">
                                                            </colgroup>
                                                            <thead class="ant-table-thead">
                                                            <tr>
                                                                <th class="ant-table-align-center" style="text-align: center;">
                                                                    <div>名称</div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align: center;">
                                                                    <div>星级</div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align: center;">
                                                                    <div>标签</div>
                                                                </th>
                                                                <th class="ant-table-align-left" style="text-align: left;">
                                                                    <div>参考价格</div>
                                                                </th>
                                                                <th class="ant-table-align-center" style="text-align: center;">
                                                                    <div>最后更新</div>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody">
                                                            <tr class="ant-table-row ant-table-row-level-0" data-row-key="NkPPn2z8" v-for="item in resources_List" :key="item.id" v-on:click="get_details(item.id)">
                                                                <td class="" style="text-align: center;">
                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                    <div class="imageText__imageTextContainer___3YHZ8">
                                                                        <div class="imageText__image___2SuEP">
                                                                            <span v-if="!item.picture"  class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                                <div class="widgets__noImgCont___blaq6">
                                                                                    <i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 26px;">
                                                                                        <img  src="/lushu/static/svg/icon-23.svg" style="width: 1rem;height: 1rem">                                                                                            <img  src="/lushu/static/svg/icon-23.svg" style="width: 1rem;height: 1rem">
                                                                                    </i>
                                                                                </div>
                                                                            </span>
                                                                            <span v-if="item.picture" class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
                                                                                    <img :src="item.picture" style="width: 100%;height: 100%">
                                                                            </span>
                                                                        </div>
                                                                        <div class="imageText__textContent___28V1T">
                                                                            <div class="imageText__name_cn___5kdN2">{{item.title}}</div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align: center;">
                                                                    <div>
                                                                        <span v-for="rating in item.rating" >
                                                                            <i aria-label="图标: star" class="anticon anticon-star hotelStars__star___6fMzT">
                                                                                <img  src="/lushu/static/svg/icon-33.svg" style="width: 1.5rem;height: 1.5rem">
                                                                            </i>
                                                                        </span>

                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align: center;">
                                                                    <div class="materialFilterTags__container___Dj1ek">
                                                                        <div class="materialFilterTags__wrapped___GA1ii hotelLibrary__ellipsis___2TfjJ">
                                                                            <span v-for="label in item.label" :key="label.id" class="materialFilterTags__tag___1x6Ei" >{{label.label}}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="text-align: left;">￥{{item.min_money}}</td>
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
                                                </div>
                                            </div>
                                            <div class="widgets__empty___8_50e widgets__large___1ny40" v-if="resources_List.length < 1">
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
    <!-- 多页面共用弹出页面 -->
    <?php include(dirname(__FILE__,2) . '/layout/foot.php');?>
    <!-- 新增笔记 -->
    <?php include(dirname(__FILE__,2) . '/layout/project_hotel.php');?>
    <!-- 标签 -->
    <?php include(dirname(__FILE__,2) . '/layout/label.php');?>
</div>

</body>

</html>
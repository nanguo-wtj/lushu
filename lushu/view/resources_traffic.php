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
                            <?php include(dirname(__FILE__,2) . '/search/resources_traffic.php');?>
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
                                                                            相关城市
                                                                        </div>
                                                                    </th>
                                                                    <th class="ant-table-column-has-actions ant-table-column-has-sorters ant-table-align-center" style="text-align:center">
                                                                        <div class="ant-table-column-sorters">
                                                                            出行天数
                                                                            <div title="排序" class="ant-table-column-sorter">
                                                                                <i aria-label="图标: caret-up" class="anticon anticon-caret-up ant-table-column-sorter-up off">
                                                                                    <svg viewbox="0 0 1024 1024" class="" data-icon="caret-up" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                                                        <path d="M858.9 689L530.5 308.2c-9.4-10.9-27.5-10.9-37 0L165.1 689c-12.2 14.2-1.2 35 18.5 35h656.8c19.7 0 30.7-20.8 18.5-35z">
                                                                                        </path>
                                                                                    </svg>
                                                                                </i>
                                                                                <i aria-label="图标: caret-down" class="anticon anticon-caret-down ant-table-column-sorter-down off">
                                                                                    <svg viewbox="0 0 1024 1024" class="" data-icon="caret-down" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                                                                        <path d="M840.4 300H183.6c-19.7 0-30.7 20.8-18.5 35l328.4 380.8c9.4 10.9 27.5 10.9 37 0L858.9 335c12.2-14.2 1.2-35-18.5-35z">
                                                                                        </path>
                                                                                    </svg>
                                                                                </i>
                                                                            </div>
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
                                                                <tr class="ant-table-row ant-table-row-level-0" data-row-key="jgMBJYwN">
                                                                    <td class="" style="text-align:left">
                                                                        <span style="padding-left:0px" class="ant-table-row-indent indent-level-0"></span>
                                                                        <div class="imageText__imageTextContainer___3YHZ8">
                                                                            <div class="imageText__image___2SuEP">
																							<span class="imageText__roundCorner___bSW_R widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
																								<div class="widgets__noImgCont___blaq6">
																									<i aria-label="图标: picture" style="font-size:26px" class="anticon anticon-picture">
																										<svg viewbox="64 64 896 896" class="" data-icon="picture" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																											<path d="M349.22 579.27l-51.7-67.55a29.39 29.39 0 0 0-46.49-.24L73.56 738.43a29.4 29.4 0 0 0 23.36 47.5l153.97-1.1c-5.96-8.41-10.52-17.67-11.98-28.18a64.81 64.81 0 0 1 12.6-48.3zm600.25 142.21L646.1 311.89a36.75 36.75 0 0 0-58.83-.3L274.16 725.6a36.74 36.74 0 0 0 29.57 58.9l616.47-4.37a36.74 36.74 0 0 0 29.27-58.61zM281.62 394.22a78.08 78.08 0 1 0-78.72-77.49 78.1 78.1 0 0 0 78.72 77.5z">
																											</path>
																										</svg>
																									</i>
																								</div>
																							</span>
                                                                            </div>
                                                                            <div class="imageText__textContent___28V1T">
                                                                                <div class="imageText__name_cn___5kdN2">
                                                                                    新建行程1
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="" style="text-align:center">- -</td>
                                                                    <td class="ant-table-column-has-actions ant-table-column-has-sorters" style="text-align:center">
                                                                        <div>
                                                                            12天
                                                                        </div>
                                                                    </td>
                                                                    <td class="" style="text-align:center">- -</td>
                                                                    <td class="" style="text-align:center">
                                                                        <div>
                                                                            <!-- <p>- -</p> -->
                                                                            <p>23分钟前</p>
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
                        <div class="pagePanel pagePanel__pagePanel___3fszW libraryPageBase__footer___19ORW">
                            <div class="widgets__paginationWrap___1QI1J"></div>
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
    <!-- 出行天数 -->
    <?php include(dirname(__FILE__,2) . '/layout/Getday.php');?>
<!--    添加交通方案  -->
    <?php include(dirname(__FILE__,2) . '/layout/resources_traffic_add.php');?>

</div>


</body>

</html>
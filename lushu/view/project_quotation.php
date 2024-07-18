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
                        <?php include(dirname(__FILE__,2) . '/layout/project_top.php');?>
                    </div>
                    <div class="basicLayout__pageContainer___2LQ1G">
                        <div class="pagePanel__pagePanelContainer___3FpIY">
                            <div class="pagePanel pagePanel__pagePanel___3fszW contentBase__contentContainer___2oebb pagePanel__auto___1xn2A">
                                <div class="contentBase__headerContainer___aQ_Tu">
                                    <div class="contentBase__statusContainer___1r1Jm">
                                        <span class="ant-dropdown-trigger">
                                            <span class="planStatus__container___3-d71 planStatus__editable___1-vdr">
                                                <i aria-label="图标: consult-status-0" class="anticon anticon-consult-status-0 planStatus__statusOngoing___TLUgv">
                                                    <img src="/lushu/static/svg/icon-73.svg" style="width: 1rem;height: 1rem">
                                                </i>
                                                <span class="planStatus__status___2m1rw" v-if="project_data.is_sale == 0">正在进行</span>
                                                <span class="planStatus__status___2m1rw" v-else >已完成</span>
                                            </span>
<!--                                            <i aria-label="图标: down" class="anticon anticon-down contentBase__icon___3i5zd">-->
<!--                                                <img src="/lushu/static/svg/icon-74.svg" style="width: 1rem;height: 1rem">-->
<!--                                            </i>-->
                                        </span>
                                    </div>
                                    <span class="contentBase__editContainer___3yjO8">
											<button v-on:click="openQuotaion" type="button" class="ant-btn contentBase__button___kuoT2 ant-btn-plain">
                                                <span class="contentBase__editButton___2Y2JJ">
													<i aria-label="图标: edit" class="anticon anticon-edit">
														<img src="/lushu/static/svg/icon-76.svg" style="width: 1rem;height: 1rem">
													</i>
													<span class="contentBase__editWord___I9w5V">编辑</span>
												</span>
												<span class="contentBase__startEditButton___gPq-S">开始编辑</span>
											</button>
										</span>
                                    <span class="contentBase__actionsContainer___prlIt">
											<button onclick="window.open('./project_pdf.html?key_id=<?=$key_id?>', '_blank');" type="button" class="ant-btn ant-dropdown-trigger ant-btn-plain">
												<i aria-label="图标: download" class="anticon anticon-download">
													<img src="/lushu/static/svg/icon-126.svg" style="width: 1rem;height: 1rem">
												</i>
												<span>下载报价单</span>
											</button>
										</span>
                                </div>
                                <div class="contentBase__contentContainerInner___6KAPZ">
                                    <div class="tosProjectCssMarker">
                                        <div class="editQuote__editQuote___3FZQ0 editQuote__editQuoteComponent___1aUD9 projectTripQuote__tripQuoteContainer___1A-sC">
                                            <div>
                                                <div class="editQuote__headerContainer___3B5EZ">
                                                    <div class="editQuote__btnWrapper___2hBtR"></div>
                                                    <div class="ant-tabs ant-tabs-top ant-tabs-line">
                                                        <div v-if="quotation_top.length > 1" role="tablist" class="ant-tabs-bar ant-tabs-top-bar" tabindex="0">
                                                            <div class="ant-tabs-nav-container">

                                                                <div class="ant-tabs-nav-wrap">
                                                                    <div class="ant-tabs-nav-scroll">
                                                                        <div class="ant-tabs-nav ant-tabs-nav-animated">
                                                                            <div>
                                                                                <div  v-for="(item,index) in quotation_top" :key="index" v-on:click="openItinerary(item)"   :class="item.id == quotation_top_id? 'ant-tabs-tab-active ant-tabs-tab':'ant-tabs-tab '">{{item.class_type}}</div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;">
                                                        </div>
                                                        <div class="ant-tabs-content ant-tabs-content-animated ant-tabs-top-content" style="margin-left: 0%;">
                                                            <div role="tabpanel" aria-hidden="false" class="ant-tabs-tabpane ant-tabs-tabpane-active">
                                                                <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;">
                                                                </div>
                                                                <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;">
                                                                </div>
                                                            </div>
                                                            <div role="tabpanel" aria-hidden="true" class="ant-tabs-tabpane ant-tabs-tabpane-inactive"></div>
                                                            <div role="tabpanel" aria-hidden="true" class="ant-tabs-tabpane ant-tabs-tabpane-inactive"></div>
                                                        </div>
                                                        <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;">
                                                        </div>
                                                    </div>
                                                    <div class="editQuote__headerRow___9_PxR">
                                                        <div class="editQuote__totalPrice___2W7Ue">
                                                            <span class="editQuote__priceTitle___2yZ1U">行程报价：</span>
                                                            <div class="editQuote__price___2uIIZ editQuote__edit___3FmJ2">
                                                                <span class="editQuote__currency___1j9Ql">(货币: 人民币)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tripPriceTable__priceTable___3mNyy">
                                                        <div class="tosProjectCssMarker dataTable__dataTableSet___3xooO">
                                                            <div class="dataTable__dataTable___3z9Jt">
                                                                <div class="dataTable__th___2jo2p">
                                                                    <span style="width: 19%" class="dataTable__tableDimensions___pL2Q9 dataTable__double___1Nv3p">
                                                                        <span class="dataTable__colTitle___dZ1YN">游客分类</span>
                                                                        <span class="dataTable__rowTitle___ydKnj">出行日期</span>
                                                                    </span>
                                                                    <span style="width: 19%"  class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">成人</span>
                                                                    <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">老人</span>
                                                                    <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">儿童</span>
                                                                    <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN dataTable__colHeader___2g_sn">婴儿</span>

                                                                </div>
                                                                <div  v-for="(item,index) in quotation_top_list" :key="index" class="dataTable__tr___3V6y4">
                                                                    <span style="width: 19%" class="dataTable__cell___3kPEN dataTable__rowHeader___xAjP6">{{item.title}}</span>
                                                                    <span style="width: 19%" class="dataTable__cell___3kPEN" >{{item.adult}}</span>
                                                                    <span style="width: 19%" v-if="classification[0].status == true" class="dataTable__cell___3kPEN" >{{item.old}}</span>
                                                                    <span style="width: 19%" v-if="classification[1].status == true" class="dataTable__cell___3kPEN" >{{item.children}}</span>
                                                                    <span style="width: 19%" v-if="classification[2].status == true" class="dataTable__cell___3kPEN" >{{item.baby}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="editQuote__contentContainer___2A0KS">
                                                    <div class="editQuote__section___ZB-wU">
                                                        <div class="editQuote__sectionHeader___bWqD4">费用说明</div>
                                                        <div class="editQuote__header___315Tv">
                                                            <div class="editQuote__column___2B62e editQuote__name___3V3Tn">项目名称
                                                            </div>
                                                            <div class="editQuote__column___2B62e editQuote__description___2x8mR">描述
                                                            </div>
                                                        </div>
                                                        <div v-for="(item,index) in cost_list" :key="index" class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                            <div class="editQuote__column___2B62e editQuote__name___3V3Tn">{{item.title}}</div>
                                                            <div v-html="item.content" class="editQuote__column___2B62e editQuote__description___2x8mR">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="editQuote__section___ZB-wU editQuote__notIncludes___2UqSO">
                                                        <div class="editQuote__sectionHeader___bWqD4">费用不包括</div>
                                                        <div class="editQuote__header___315Tv editQuote__empty___2VV9q"></div>
                                                        <div v-for="(item,index)  in not_included" :key="index" class="editQuote__dataRow___2zh0l editQuote__onlyOneColumn___2keCS">
                                                            <div  v-html="item.content" class="editQuote__column___2B62e editQuote__descriptionOnlyOne___2Vy2L">

                                                            </div>
                                                            <div class="editQuote__column___2B62e editQuote__delete___3NZ8V"></div>
                                                        </div>
                                                    </div>
                                                    <div class="editQuote__section___ZB-wU">
                                                        <div class="editQuote__sectionHeader___bWqD4">可选付费项目</div>
                                                        <div class="editQuote__header___315Tv">
                                                            <div class="editQuote__column___2B62e editQuote__name___3V3Tn">项目名称
                                                            </div>
                                                            <div class="editQuote__column___2B62e editQuote__description___2x8mR">描述
                                                            </div>
                                                        </div>
                                                        <div v-for="(item,index) in PaidItemsList" :key="index"  class="editQuote__dataRow___2zh0l editQuote__noPrice___3CA_B">
                                                            <div class="editQuote__column___2B62e editQuote__name___3V3Tn">{{item.title}}
                                                            </div>
                                                            <div class="editQuote__column___2B62e editQuote__description___2x8mR" v-html="item.content">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="editQuote__section___ZB-wU editQuote__introduction___1yGlX">
                                                        <div class="editQuote__sectionHeader___bWqD4">补充说明</div>
                                                        <div v-html="supplementdata.content" class="editQuote__introductionContent___1GgRE">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pagePanel pagePanel__pagePanel___3fszW contentBase__rightContainer___1aBtT pagePanel__sider___3KzU1" style="flex:0 0 320px;max-width:320px;min-width:320px;width:320px">
                                <div class="operators__operatorsContainer___23nYo">
                                    <div class="operators__title___2E9fz">
                                        负责成员
                                    </div>
                                    <span>
                                        <span>
                                            <span class="an-avatar avatarPlus__avatar___A1CVN operators__avatar___h2-h4 avatar__avatar___4NUXc">
                                                <span class="avatar__avatarInner___1y0H-">
                                                    <span style="background-color:#599DFA" class="ant-avatar ant-avatar-circle">
                                                        <span class="ant-avatar-string">{{project_data.user}}</span>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                                    <!--                            <button type="button" class="ant-btn ant-btn-circle ant-btn-lg ant-btn-icon-only">-->
                                                    <!--                                <i aria-label="图标: plus" class="anticon anticon-plus">-->
                                                    <!--                                    <img src="/lushu/static/svg/icon-60.svg" style="width: 1rem;height: 1rem">-->
                                                    <!--                                </i>-->
                                                    <!--                            </button>-->
                                      </span>
                                </div>
                                <div class="contentBase__divider___RzuGR"></div>
                                <div>
                                    <?php $project_log_type = 2; include(dirname(__FILE__,2) . '/layout/project_log.php');?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <?php include(dirname(__FILE__,2) . '/layout/release.php');//发布路书详情?>

</div>



</body>

</html>
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
<!--												<i aria-label="图标: down" class="anticon anticon-down contentBase__icon___3i5zd">-->
<!--													<img src="/lushu/static/svg/icon-74.svg" style="width: 1rem;height: 1rem">-->
<!--												</i>-->
											</span>
                                    </div>
                                    <span class="contentBase__editContainer___3yjO8">
											<button type="button" class="ant-btn contentBase__button___kuoT2 ant-btn-plain" v-on:click="openCost">
												<span class="contentBase__editButton___2Y2JJ">
													<i aria-label="图标: edit" class="anticon anticon-edit">
														<img src="/lushu/static/svg/icon-76.svg" style="width: 1rem;height: 1rem">
													</i>
													<span class="contentBase__editWord___I9w5V">编辑</span>
												</span>
												<span class="contentBase__startEditButton___gPq-S">开始编辑</span>
											</button>
										</span>
                                    <span class="contentBase__actionsContainer___prlIt"></span>
                                </div>
                                <div class="contentBase__contentContainerInner___6KAPZ">
                                    <div>
                                        <div class="preview__totalPriceRow___K7wYh">
												<span class="piece__totalPrice___3sHSx">
													<span>核价总计: </span>
													<span class="piece__symbol___170sY">￥</span>
													<span class="piece__price___2_9VJ">{{list_code.money}}</span>
												</span>
                                        </div>
                                        <div class="tripBookings__tripBookingsTable___33lph">
                                            <div class="tripBookings__bookingHeaderRow___vwmaJ">
                                                <div class="tripBookings__leftTitle___4Y_Gs">交通方案</div>
                                                <div class="tripBookings__rightPrice___2G_nj">
														<span class="piece__subTotalPrice___1H66p">
															<span>参考价: </span>
															<span class="piece__symbol___170sY">￥</span>
															<span class="piece__price___2_9VJ">{{list_code.Traffic_money}}</span>
														</span>
                                                </div>
                                            </div>
                                            <div class="ant-table-wrapper">
                                                <div class="ant-spin-nested-loading">
                                                    <div class="ant-spin-container">
                                                        <div class="ant-table ant-table-default ant-table-bordered ant-table-scroll-position-left">
                                                            <div class="ant-table-content">
                                                                <div class="ant-table-body">
                                                                    <table class="">
                                                                        <colgroup>
                                                                            <col style="width: 16%; min-width: 16%;">
                                                                            <col style="width: 20%; min-width: 20%;">
                                                                            <col>
                                                                        </colgroup>
                                                                        <thead class="ant-table-thead">
                                                                        <tr>
                                                                            <th class="">
                                                                                <div>时间</div>
                                                                            </th>
                                                                            <th class="">
                                                                                <div>预定项目</div>
                                                                            </th>
                                                                            <th class="tripBookings__multiRow___2eSnW">
                                                                                <div>
                                                                                    <div>
                                                                                        <div class="tripBookings__col1___Y-sZm">预定选项
                                                                                        </div>
                                                                                        <div class="tripBookings__col2___3_Dqi" >单价</div>
                                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                                    </div>
                                                                                </div>
                                                                            </th>

                                                                        </tr>
                                                                        </thead>
                                                                        <tbody class="ant-table-tbody" v-for="(item,index) in list_code.Traffic" :key="index">
                                                                            <tr   class="ant-table-row ant-table-row-level-0" data-row-key="tripLongTransit00">
                                                                                <td class="" :rowspan="item.list_number+1">
                                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                                    <div class="piece__dateRange___H7nLH">
                                                                                        <div class="h5">D{{item.day}} </div>{{item.time}}
                                                                                    </div>
                                                                                </td>

                                                                            </tr>

                                                                            <tr   v-for="(a,b) in item.list" :key="a">
                                                                                <td class="" >
                                                                                    <div class="longTransitMini__longTransitMini___tOVoN longTransitMini__bookingTable___1llNz">
                                                                                        <div>
<!--                                                                                            <div class="longTransitMini__method___2CdLv">-->
<!--                                                                                                <i aria-label="图标: transit-method-1" class="anticon anticon-transit-method-1 longTransitMini__icon___21k3B">-->
<!--                                                                                                    <img src="/lushu/static/svg/icon-79.svg" style="width: 1rem;height: 1rem">-->
<!--                                                                                                </i>-->
<!--                                                                                                <span class="longTransitMini__name___1Vrda">TK021</span>-->
<!--                                                                                            </div>-->
                                                                                            <div class="longTransitMini__meta___1TO2p">
                                                                                                <div>
                                                                                                    <span>{{a.startingPoint.region_name}}</span>
                                                                                                    <i aria-label="图标: swap-right" class="anticon anticon-swap-right">
                                                                                                        <img src="/lushu/static/svg/icon-121.svg" style="width: 1rem;height: 1rem">
                                                                                                    </i>
                                                                                                    <span>{{a.destination.region_name}}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </td>
                                                                                <td class="tripBookings__multiRow___2eSnW">
                                                                                    <div v-for="(c,d) in a.cost" class="tripBookings__row___1OP70">
                                                                                        <div class="tripBookings__col1___Y-sZm">{{c.name}}</div>
                                                                                        <div class="tripBookings__col2___3_Dqi">
																								<span class="">
																									<span class="piece__symbol___170sY">￥</span>
																									<span class="piece__price___2_9VJ">{{c.price}}</span>
																								</span>
                                                                                        </div>
                                                                                        <div class="tripBookings__col2___3_Dqi">{{c.number}}</div>
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
                                        <div class="tripBookings__tripBookingsTable___33lph">
                                            <div class="tripBookings__bookingHeaderRow___vwmaJ">
                                                <div class="tripBookings__leftTitle___4Y_Gs">酒店住宿</div>
                                                <div class="tripBookings__rightPrice___2G_nj">
														<span class="piece__subTotalPrice___1H66p">
															<span>参考价: </span>
															<span class="piece__symbol___170sY">￥</span>
															<span class="piece__price___2_9VJ">{{list_code.hotel_money}}</span>
														</span>
                                                </div>
                                            </div>
                                            <div class="ant-table-wrapper">
                                                <div class="ant-spin-nested-loading">
                                                    <div class="ant-spin-container">
                                                        <div class="ant-table ant-table-default ant-table-bordered ant-table-scroll-position-left">
                                                            <div class="ant-table-content">
                                                                <div class="ant-table-body">
                                                                    <table class="">
                                                                        <colgroup>
                                                                            <col style="width: 16%; min-width: 16%;">
                                                                            <col style="width: 20%; min-width: 20%;">
                                                                            <col>
                                                                        </colgroup>
                                                                        <thead class="ant-table-thead">
                                                                        <tr>
                                                                            <th class="">
                                                                                <div>时间</div>
                                                                            </th>
                                                                            <th class="">
                                                                                <div>预定项目</div>
                                                                            </th>
                                                                            <th class="tripBookings__multiRow___2eSnW">
                                                                                <div>
                                                                                    <div>
                                                                                        <div class="tripBookings__col1___Y-sZm">预定选项
                                                                                        </div>
                                                                                        <div class="tripBookings__col2___3_Dqi">单价</div>
                                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody class="ant-table-tbody">
                                                                            <tr v-for="(item,index) in list_code.hotel" :key="index" class="ant-table-row ant-table-row-level-0" data-row-key="tripAccomadation00">
                                                                                <td class="" rowspan="1">
                                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                                    <div class="piece__dateRange___H7nLH">
                                                                                        <div class="h5">{{item.hotel_time}}</div>{{item.time}}
                                                                                    </div>
                                                                                </td>
                                                                                <td class="">
                                                                                    <div class="h5">{{item.name.title}}</div>
                                                                                </td>
                                                                                <td class="tripBookings__multiRow___2eSnW">
                                                                                    <div v-for="(c,d) in item.cost" class="tripBookings__row___1OP70">
                                                                                        <div class="tripBookings__col1___Y-sZm">{{c.name}}</div>
                                                                                        <div class="tripBookings__col2___3_Dqi">
																								<span class="">
																									<span class="piece__symbol___170sY">￥</span>
																									<span class="piece__price___2_9VJ">{{c.price}}</span>
																								</span>
                                                                                        </div>
                                                                                        <div class="tripBookings__col2___3_Dqi">{{c.number}}</div>
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
<!--                                        <div class="tripBookings__tripBookingsTable___33lph">-->
<!--                                            <div class="tripBookings__bookingHeaderRow___vwmaJ">-->
<!--                                                <div class="tripBookings__leftTitle___4Y_Gs">活动与服务</div>-->
<!--                                                <div class="tripBookings__rightPrice___2G_nj">-->
<!--														<span class="piece__subTotalPrice___1H66p">-->
<!--															<span>参考价: </span>-->
<!--															<span class="piece__symbol___170sY">￥</span>-->
<!--															<span class="piece__price___2_9VJ">00.00</span>-->
<!--														</span>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="ant-table-wrapper">-->
<!--                                                <div class="ant-spin-nested-loading">-->
<!--                                                    <div class="ant-spin-container">-->
<!--                                                        <div class="ant-table ant-table-default ant-table-bordered ant-table-scroll-position-left">-->
<!--                                                            <div class="ant-table-content">-->
<!--                                                                <div class="ant-table-body">-->
<!--                                                                    <table class="">-->
<!--                                                                        <colgroup>-->
<!--                                                                            <col style="width: 16%; min-width: 16%;">-->
<!--                                                                            <col style="width: 20%; min-width: 20%;">-->
<!--                                                                            <col>-->
<!--                                                                        </colgroup>-->
<!--                                                                        <thead class="ant-table-thead">-->
<!--                                                                        <tr>-->
<!--                                                                            <th class="">-->
<!--                                                                                <div>时间</div>-->
<!--                                                                            </th>-->
<!--                                                                            <th class="">-->
<!--                                                                                <div>预定项目</div>-->
<!--                                                                            </th>-->
<!--                                                                            <th class="tripBookings__multiRow___2eSnW">-->
<!--                                                                                <div>-->
<!--                                                                                    <div>-->
<!--                                                                                        <div class="tripBookings__col1___Y-sZm">预定选项-->
<!--                                                                                        </div>-->
<!--                                                                                        <div class="tripBookings__col2___3_Dqi">单价</div>-->
<!--                                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>-->
<!--                                                                                    </div>-->
<!--                                                                                </div>-->
<!--                                                                            </th>-->
<!--                                                                        </tr>-->
<!--                                                                        </thead>-->
<!--                                                                        <tbody class="ant-table-tbody">-->
<!--                                                                        <tr class="ant-table-row ant-table-row-level-0" data-row-key="tripActivity00">-->
<!--                                                                            <td class="" rowspan="1">-->
<!--                                                                                <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>-->
<!--                                                                                <div class="piece__dateRange___H7nLH">-->
<!--                                                                                    <div class="h5">D1 </div>11-18-->
<!--                                                                                </div>-->
<!--                                                                            </td>-->
<!--                                                                            <td class="">-->
<!--                                                                                <div class="h5">接送机服务</div>-->
<!--                                                                            </td>-->
<!--                                                                            <td class="tripBookings__multiRow___2eSnW">-->
<!--                                                                                <div class="tripBookings__row___1OP70">-->
<!--                                                                                    <div class="tripBookings__col1___Y-sZm">6个航班</div>-->
<!--                                                                                    <div class="tripBookings__col2___3_Dqi">-->
<!--																								<span class="">-->
<!--																									<span class="piece__symbol___170sY">￥</span>-->
<!--																									<span class="piece__price___2_9VJ">6000.00</span>-->
<!--																								</span>-->
<!--                                                                                    </div>-->
<!--                                                                                    <div class="tripBookings__col2___3_Dqi">1</div>-->
<!--                                                                                </div>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        </tbody>-->
<!--                                                                    </table>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <div class="tripBookings__tripBookingsTable___33lph">
                                            <div class="tripBookings__bookingHeaderRow___vwmaJ">
                                                <div class="tripBookings__leftTitle___4Y_Gs">POI</div>
                                                <div class="tripBookings__rightPrice___2G_nj">
														<span class="piece__subTotalPrice___1H66p">
															<span>参考价: </span>
															<span class="piece__price___2_9VJ">{{list_code.schedule_money}} </span>
														</span>
                                                </div>
                                            </div>
                                            <div class="ant-table-wrapper">
                                                <div class="ant-spin-nested-loading">
                                                    <div class="ant-spin-container">
                                                        <div class="ant-table ant-table-default ant-table-bordered ant-table-scroll-position-left">
                                                            <div class="ant-table-content">
                                                                <div class="ant-table-body">
                                                                    <table class="">
                                                                        <colgroup>
                                                                            <col style="width: 16%; min-width: 16%;">
                                                                            <col style="width: 20%; min-width: 20%;">
                                                                            <col>
                                                                        </colgroup>
                                                                        <thead class="ant-table-thead">
                                                                        <tr>
                                                                            <th class="">
                                                                                <div>时间</div>
                                                                            </th>
                                                                            <th class="">
                                                                                <div>预定项目</div>
                                                                            </th>
                                                                            <th class="tripBookings__multiRow___2eSnW">
                                                                                <div>
                                                                                    <div>
                                                                                        <div class="tripBookings__col1___Y-sZm">预定选项
                                                                                        </div>
                                                                                        <div class="tripBookings__col2___3_Dqi">单价</div>
                                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody class="ant-table-tbody" v-for="(item,index) in list_code.schedule" :key="index">
                                                                            <tr   class="ant-table-row ant-table-row-level-0" data-row-key="tripLongTransit00">
                                                                                <td class="" :rowspan="item.list_number+1">
                                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                                    <div class="piece__dateRange___H7nLH">
                                                                                        <div class="h5">D{{item.day}} </div>{{item.time}}
                                                                                    </div>
                                                                                </td>

                                                                            </tr>

                                                                            <tr   v-for="(a,b) in item.list" :key="a">
                                                                                <td class="" >
                                                                                    <div class="h5">{{a.title}}</div>
                                                                                </td>
                                                                                <td class="tripBookings__multiRow___2eSnW">
                                                                                    <div v-for="(c,d) in a.cost" class="tripBookings__row___1OP70">
                                                                                        <div class="tripBookings__col1___Y-sZm">{{c.name}}</div>
                                                                                        <div class="tripBookings__col2___3_Dqi">
                                                                                                    <span class="">
                                                                                                        <span class="piece__symbol___170sY">￥</span>
                                                                                                        <span class="piece__price___2_9VJ">{{c.price}}</span>
                                                                                                    </span>
                                                                                        </div>
                                                                                        <div class="tripBookings__col2___3_Dqi">{{c.number}}</div>
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
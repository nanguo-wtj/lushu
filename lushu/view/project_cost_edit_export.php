<!-- 导入顶部数据  -->
<?php include(dirname(__FILE__,2) . '/layout/header.php');?>

<body class="appName-library">
<div id="webMain" ref="pageTop">
    <div class="">
        <div id="pageWrap" class="editLayout__editLayout___3vFVX">
            <div class="transitIndicator__transitIndicator___3m8Gd">
                <div class="transitIndicator__transitBar___2q3uc"></div>
            </div>
            <div class="editLayout__pageTopBar___HuSEJ">
                <div class="editLayout__breadcrumb___mkSjH ant-breadcrumb ant-breadcrumb-dark">

                    <span>
							<span class="ant-breadcrumb-link">
								<a class="globalLink undefined-link" href="./staging_project_export.html?key_id=<?=$key_id?>">{{project_data.title}}</a>
							</span>
							<span class="ant-breadcrumb-separator">
								<i aria-label="图标: right" class="anticon anticon-right">
									<img src="/lushu/static/svg/icon-67.svg" style="width: 1rem;height: 1rem">
								</i>
							</span>
						</span>
                    <span>
							<span class="ant-breadcrumb-link">费用核算</span>
							<span class="ant-breadcrumb-separator">
								<i aria-label="图标: right" class="anticon anticon-right">
									<img src="/lushu/static/svg/icon-67.svg" style="width: 1rem;height: 1rem">
								</i>
							</span>
						</span>
                </div>
                <div class="editLayout__rightActions___3kOHV">
                    <button preventspace="true" type="button" onclick="history.back()" class="ant-btn ant-btn-primary">
                        <span>返回</span>
                    </button>
                </div>
            </div>
            <div class="editLayout__pageContainer___1_d0K">
                <div class="tripBookings__totalPriceRow___SM0k2">
                    <div class="tripBookings__leftTitle___4Y_Gs">* 费用核算用于内部人员核算成本，仅对机构内部可见，对客户不可见。</div>
                    <div class="tripBookings__rightPrice___2G_nj">
							<span class="piece__totalPrice___3sHSx">
								<span>核价总计:</span>
								<span class="piece__symbol___170sY">￥</span>
								<span class="piece__price___2_9VJ">{{list_code.money}}</span>
							</span>
                    </div>
                </div>
                <div class="pagePanel pagePanel__pagePanel___3fszW mainPanel">
                    <div>
                        <div class="tripBookings__tripBookingsTable___33lph">
                            <div class="tripBookings__bookingHeaderRow___vwmaJ">
                                <div class="tripBookings__leftTitle___4Y_Gs">交通方案</div>
                                <div class="tripBookings__rightPrice___2G_nj">
										<span class="piece__subTotalPrice___1H66p">
											<span>参考价:
											</span>
											<span class="piece__symbol___170sY">￥</span>
											<span class="piece__price___2_9VJ">{{list_code.Traffic_money}}</span>
										</span>
                                </div>
                            </div>
                            <div class="ant-table-wrapper traval">
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
                                                            <col style="width: 16%; min-width: 16%;">
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
                                                                        <div class="tripBookings__col1___Y-sZm">预定选项</div>
                                                                        <div class="tripBookings__col2___3_Dqi">单价</div>
                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th class="">
                                                                <div>操作</div>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="ant-table-tbody" v-for="(item,index) in list_code.Traffic" :key="index">
                                                            <tr class="ant-table-row ant-table-row-level-0" data-row-key="tripLongTransit00">
                                                                <td class="" :rowspan="item.list_number+1" >
                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                    <div class="piece__dateRange___H7nLH">
                                                                        <div class="h5">D{{item.day}} </div>{{item.time}}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr  v-for="(a,b) in item.list" :key="a">
                                                                <td class="">
                                                                    <div class="longTransitMini__longTransitMini___tOVoN longTransitMini__bookingTable___1llNz">
                                                                        <div>
<!--                                                                            <div class="longTransitMini__method___2CdLv">-->
<!--                                                                                <i aria-label="图标: transit-method-1" class="anticon anticon-transit-method-1 longTransitMini__icon___21k3B">-->
<!--                                                                                    <img src="/lushu/static/svg/icon-79.svg" style="width: 1rem;height: 1rem">-->
<!--                                                                                </i>-->
<!--                                                                                <span class="longTransitMini__name___1Vrda">TK021</span>-->
<!--                                                                            </div>-->
                                                                            <div class="longTransitMini__meta___1TO2p">
                                                                                <div>
                                                                                    <span>{{a.startingPoint.region_name}}</span>
                                                                                    <i aria-label="图标: swap-right" class="anticon anticon-swap-right">
                                                                                        <img src="/lushu/static/svg/icon-121.svg" style="width: 1rem;height: 1rem">
                                                                                    </i>
                                                                                    <span>{{a.destination.region_name}}({{a.Traffic_value}})</span>
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
                                                                <td  >
                                                                    <button preventspace="true" v-on:click="openCostEdit(a.id,a.startingPoint.region_name+'~'+a.destination.region_name+'('+a.Traffic_value+')',item.day,1)" type="button" class="ant-btn tripBookings__action___UxzNN ant-btn-plain" ant-click-animating-without-extra-node="false">
                                                                        <span>编辑</span>
                                                                    </button>
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
											<span>参考价:
											</span>
											<span class="piece__symbol___170sY">￥</span>
											<span class="piece__price___2_9VJ">{{list_code.hotel_money}}</span>
										</span>
                                </div>
                            </div>
                            <div class="ant-table-wrapper hotel">
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
                                                            <col style="width: 16%; min-width: 16%;">
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
                                                                        <div class="tripBookings__col1___Y-sZm">预定选项</div>
                                                                        <div class="tripBookings__col2___3_Dqi">单价</div>
                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th class="">
                                                                <div>操作</div>
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
                                                                <td class="">
                                                                    <button preventspace="true" v-on:click="openCostEdit(item.id,item.name.title,item.day,2)" type="button" class="ant-btn tripBookings__action___UxzNN ant-btn-plain" ant-click-animating-without-extra-node="false">
                                                                        <span>编辑</span>
                                                                    </button>
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
<!--                        <div class="tripBookings__tripBookingsTable___33lph">-->
<!--                            <div class="tripBookings__bookingHeaderRow___vwmaJ">-->
<!--                                <div class="tripBookings__leftTitle___4Y_Gs">活动与服务</div>-->
<!--                                <div class="tripBookings__rightPrice___2G_nj">-->
<!--										<span class="piece__subTotalPrice___1H66p">-->
<!--											<span>参考价:-->
<!--											</span>-->
<!--											<span class="piece__symbol___170sY">￥</span>-->
<!--											<span class="piece__price___2_9VJ">00.00</span>-->
<!--										</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="ant-table-wrapper activities">-->
<!--                                <div class="ant-spin-nested-loading">-->
<!--                                    <div class="ant-spin-container">-->
<!--                                        <div class="ant-table ant-table-default ant-table-bordered ant-table-scroll-position-left">-->
<!--                                            <div class="ant-table-content">-->
<!--                                                <div class="ant-table-body">-->
<!--                                                    <table class="">-->
<!--                                                        <colgroup>-->
<!--                                                            <col style="width: 16%; min-width: 16%;">-->
<!--                                                            <col style="width: 20%; min-width: 20%;">-->
<!--                                                            <col>-->
<!--                                                            <col style="width: 16%; min-width: 16%;">-->
<!--                                                        </colgroup>-->
<!--                                                        <thead class="ant-table-thead">-->
<!--                                                        <tr>-->
<!--                                                            <th class="">-->
<!--                                                                <div>时间</div>-->
<!--                                                            </th>-->
<!--                                                            <th class="">-->
<!--                                                                <div>预定项目</div>-->
<!--                                                            </th>-->
<!--                                                            <th class="tripBookings__multiRow___2eSnW">-->
<!--                                                                <div>-->
<!--                                                                    <div>-->
<!--                                                                        <div class="tripBookings__col1___Y-sZm">预定选项</div>-->
<!--                                                                        <div class="tripBookings__col2___3_Dqi">单价</div>-->
<!--                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </th>-->
<!--                                                            <th class="">-->
<!--                                                                <div>操作</div>-->
<!--                                                            </th>-->
<!--                                                        </tr>-->
<!--                                                        </thead>-->
<!--                                                        <tbody class="ant-table-tbody">-->
<!--                                                        <tr class="ant-table-row ant-table-row-level-0" data-row-key="tripActivity00">-->
<!--                                                            <td class="" rowspan="1">-->
<!--                                                                <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>-->
<!--                                                                <div class="piece__dateRange___H7nLH">-->
<!--                                                                    <div class="h5">D1 </div>11-18-->
<!--                                                                </div>-->
<!--                                                            </td>-->
<!--                                                            <td class="">-->
<!--                                                                <div class="h5">接送机服务</div>-->
<!--                                                            </td>-->
<!--                                                            <td class="tripBookings__multiRow___2eSnW">-->
<!--                                                                <div class="tripBookings__row___1OP70">-->
<!--                                                                    <div class="tripBookings__col1___Y-sZm">6个航班</div>-->
<!--                                                                    <div class="tripBookings__col2___3_Dqi">-->
<!--																				<span class="">-->
<!--																					<span class="piece__symbol___170sY">￥</span>-->
<!--																					<span class="piece__price___2_9VJ">6000.00</span>-->
<!--																				</span>-->
<!--                                                                    </div>-->
<!--                                                                    <div class="tripBookings__col2___3_Dqi">1</div>-->
<!--                                                                </div>-->
<!--                                                            </td>-->
<!--                                                            <td class="">-->
<!--                                                                <button preventspace="true" type="button" class="ant-btn tripBookings__action___UxzNN ant-btn-plain">-->
<!--                                                                    <span>编辑</span>-->
<!--                                                                </button>-->
<!--                                                            </td>-->
<!--                                                        </tr>-->
<!--                                                        </tbody>-->
<!--                                                    </table>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="tripBookings__tripBookingsTable___33lph">
                            <div class="tripBookings__bookingHeaderRow___vwmaJ">
                                <div class="tripBookings__leftTitle___4Y_Gs">POI</div>
                                <div class="tripBookings__rightPrice___2G_nj">
										<span class="piece__subTotalPrice___1H66p">
											<span>参考价:
											</span>
											<span class="piece__symbol___170sY">￥</span>
											<span class="piece__price___2_9VJ">{{list_code.schedule_money}}</span>
										</span>
                                </div>
                            </div>
                            <div class="ant-table-wrapper poi">
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
                                                            <col style="width: 16%; min-width: 16%;">
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
                                                                        <div class="tripBookings__col1___Y-sZm">预定选项</div>
                                                                        <div class="tripBookings__col2___3_Dqi">单价</div>
                                                                        <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th class="">
                                                                <div>操作</div>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="ant-table-tbody" v-for="(item,index) in list_code.schedule" :key="index">
                                                            <tr class="ant-table-row ant-table-row-level-0" data-row-key="tripPoi00">
                                                                <td class="" :rowspan="item.list_number+1">
                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                    <div class="piece__dateRange___H7nLH">
                                                                        <div class="h5">D{{item.day}} </div>{{item.time}}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr  v-for="(a,b) in item.list" :key="a">
                                                                <td class="">
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
                                                                <td class="">
                                                                    <button preventspace="true" v-on:click="openCostEdit(a.id,a.title,item.day,4)" type="button" class="ant-btn tripBookings__action___UxzNN ant-btn-plain" ant-click-animating-without-extra-node="false">

                                                                        <span>编辑</span>
                                                                    </button>
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
        </div>
        <div class="authWatcher accessoryWrapper "></div>
        <div class="tosAlerts accessoryWrapper tosProjectCssMarker"></div>
        <div class="projectModuleEditing accessoryWrapper "></div>
    </div>
    <?php  include(dirname(__FILE__,2) . '/layout/cost_edit.php');?>
</div>

</body>

</html>
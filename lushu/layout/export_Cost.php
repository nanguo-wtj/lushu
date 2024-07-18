<div id="Cost" style="display: none">
    <div class="ant-drawer ant-drawer-right ant-drawer-open" style="">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 960px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">费用核算</div>
                        <div class="ant-drawer-right-actions">
                            <button aria-label="Close" v-on:click="CloseCost" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
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
											<span class="piece__price___2_9VJ"> {{list_code.Traffic_money}} </span>
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
                                                                            <div class="tripBookings__col1___Y-sZm">预定选项</div>
                                                                            <div class="tripBookings__col2___3_Dqi">单价</div>
                                                                            <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody" v-for="(item,index) in list_code.Traffic" :key="index">
                                                                <tr class="ant-table-row ant-table-row-level-0" data-row-key="tripLongTransit00">
                                                                    <td class="" :rowspan="item.list_number+1">
                                                                        <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                        <div class="piece__dateRange___H7nLH">
                                                                            <div class="h5">D{{item.day}} </div>{{item.time}}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr  v-for="(a,b) in item.list" :key="a">
                                                                    <td >
                                                                        <div class="longTransitMini__longTransitMini___tOVoN longTransitMini__bookingTable___1llNz">
                                                                            <div>
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
                                                                            <div class="tripBookings__col1___Y-sZm">预定选项</div>
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
                                                                        <div v-for="(c,d) in item.cost"  class="tripBookings__row___1OP70">
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
<!--                            <div class="tripBookings__tripBookingsTable___33lph">-->
<!--                                <div class="tripBookings__bookingHeaderRow___vwmaJ">-->
<!--                                    <div class="tripBookings__leftTitle___4Y_Gs">活动与服务</div>-->
<!--                                    <div class="tripBookings__rightPrice___2G_nj">-->
<!--										<span class="piece__subTotalPrice___1H66p">-->
<!--											<span>参考价: </span>-->
<!--											<span class="piece__price___2_9VJ"> - - </span>-->
<!--										</span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="ant-table-wrapper">-->
<!--                                    <div class="ant-spin-nested-loading">-->
<!--                                        <div class="ant-spin-container">-->
<!--                                            <div class="ant-table ant-table-default ant-table-bordered ant-table-scroll-position-left">-->
<!--                                                <div class="ant-table-content">-->
<!--                                                    <div class="ant-table-body">-->
<!--                                                        <table class="">-->
<!--                                                            <colgroup>-->
<!--                                                                <col style="width: 16%; min-width: 16%;">-->
<!--                                                                <col style="width: 20%; min-width: 20%;">-->
<!--                                                                <col>-->
<!--                                                            </colgroup>-->
<!--                                                            <thead class="ant-table-thead">-->
<!--                                                            <tr>-->
<!--                                                                <th class="">-->
<!--                                                                    <div>时间</div>-->
<!--                                                                </th>-->
<!--                                                                <th class="">-->
<!--                                                                    <div>预定项目</div>-->
<!--                                                                </th>-->
<!--                                                                <th class="tripBookings__multiRow___2eSnW">-->
<!--                                                                    <div>-->
<!--                                                                        <div>-->
<!--                                                                            <div class="tripBookings__col1___Y-sZm">预定选项</div>-->
<!--                                                                            <div class="tripBookings__col2___3_Dqi">单价</div>-->
<!--                                                                            <div class="tripBookings__col2___3_Dqi">数量</div>-->
<!--                                                                        </div>-->
<!--                                                                    </div>-->
<!--                                                                </th>-->
<!--                                                            </tr>-->
<!--                                                            </thead>-->
<!--                                                            <tbody class="ant-table-tbody">-->
<!--                                                            <tr class="ant-table-row ant-table-row-level-0" data-row-key="tripActivity00">-->
<!--                                                                <td class="" rowspan="1">-->
<!--                                                                    <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>-->
<!--                                                                    <div class="piece__dateRange___H7nLH">-->
<!--                                                                        <div class="h5">D1 </div>-->
<!--                                                                    </div>-->
<!--                                                                </td>-->
<!--                                                                <td class="">-->
<!--                                                                    <div class="h5">夜爬大蜀山</div>-->
<!--                                                                </td>-->
<!--                                                                <td class="tripBookings__multiRow___2eSnW"></td>-->
<!--                                                            </tr>-->
<!--                                                            </tbody>-->
<!--                                                        </table>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="tripBookings__tripBookingsTable___33lph">
                                <div class="tripBookings__bookingHeaderRow___vwmaJ">
                                    <div class="tripBookings__leftTitle___4Y_Gs">POI</div>
                                    <div class="tripBookings__rightPrice___2G_nj">
										<span class="piece__subTotalPrice___1H66p">
											<span>参考价: </span>
											<span class="piece__price___2_9VJ"> {{list_code.schedule_money}} </span>
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
                                                                            <div class="tripBookings__col1___Y-sZm">预定选项</div>
                                                                            <div class="tripBookings__col2___3_Dqi">单价</div>
                                                                            <div class="tripBookings__col2___3_Dqi">数量</div>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody"  v-for="(item,index) in list_code.schedule" :key="index">
                                                                <tr class="ant-table-row ant-table-row-level-0" data-row-key="tripPoi00">
                                                                    <td class="" :rowspan="item.list_number+1">
                                                                        <span class="ant-table-row-indent indent-level-0" style="padding-left: 0px;"></span>
                                                                        <div class="piece__dateRange___H7nLH">
                                                                            <div class="h5">D1 </div>
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
        </div>
    </div>
</div>
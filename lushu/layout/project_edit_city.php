<div class="plannerMain__pageBody___336Xk" id="project_data_day_city" style="display: none;">
    <div>
        <div class="plannerMain__cell___2Vav9" style="left:0;width:184px;z-index:10">
            <div class="plannerMain__plannerPanelWrap___3vIXb"></div>
        </div>
        <div class="plannerMain__cell___2Vav9" style="left:192px;width:240px;z-index:20">
            <div class="plannerMain__plannerPanelWrap___3vIXb">
                <div class="editRoute__editRoute___3F3vN">
                    <div class="editRoute__searchHeader___1bii1">
                        <div class="editRoute__editRouteTitle___25zll">
                            请选择城市
                            <!-- --> - D
                            <!-- -->{{day}}
                        </div>
                        <span class="ant-input-affix-wrapper">
                            <form  @submit.prevent="get_city_list(1)">
                                <span class="ant-input-prefix">
                                    <i aria-label="图标: search" class="anticon anticon-search">
                                        <img src="/lushu/static/svg/icon-59.svg" style="width: 1rem;height: 1rem">
                                    </i>
                                </span>
                                <input type="text" placeholder="搜索目标城市" v-model="city.key" class="ant-input" value="">
                                <span class="ant-input-suffix"></span>
                            </form>
						</span>
                    </div>
                    <div class="editRoute__content___1Vp4N">
                        <div class="editRoute__contentBody___3QSFX undefined">
                            <div class="editRoute__destinations___gZYOp">
                                <ul class="">
                                    <li style="height: auto;min-height: 32px;" :class="item.status? 'editRoute__inTrip___2qt3Z':''" v-for="(item,index) in city_list" :key="index" :id="'city_'+item.id"  v-on:click="add_city_day(item.id)">
                                        {{item.region_name}}
                                        <span class="editRoute__enTitle___2gfxk">{{item.en_name}}</span>
                                        <i v-if="item.status == true" aria-label="图标: check" class="anticon anticon-check editRoute__rightBtn___3O702 editRoute__inTripIndicator___VSQkP">
                                            <img src="/lushu/static/svg/icon-66.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                        <i aria-label="图标: right"  class="anticon anticon-right editRoute__rightBtn___3O702" >
                                            <img src="/lushu/static/svg/icon-65.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                        <div class="editRoute__addCityPanel___k9GcZ" :id="'city_day'+item.id" style="display:none;width: 225px;margin-left: -9px">
                                            <div class="editRoute__days___1uOM3">
                                                <button v-on:click="city_day.day--" type="button" class="ant-btn ant-btn-plain ant-btn-icon-only">
                                                    <i aria-label="图标: minus" class="anticon anticon-minus">
                                                        <img src="/lushu/static/svg/icon-68.svg" style="width: 1rem;height: 1rem">
                                                    </i>
                                                </button>
                                                <span>{{city_day.day}}天</span>
                                                <button type="button" v-on:click="city_day.day++" class="ant-btn ant-btn-plain ant-btn-icon-only">
                                                    <i aria-label="图标: plus" class="anticon anticon-plus">
                                                        <img src="/lushu/static/svg/icon-60.svg" style="width: 1rem;height: 1rem">
                                                    </i>
                                                </button>
                                            </div>
                                            <div class="editRoute__actions___CnWiu">
                                                <button type="button" class="ant-btn" v-on:click="del_city_day()">
                                                    <span>取消</span>
                                                </button>
                                                <button type="button" v-on:click="add_city(item)" class="ant-btn ant-btn-primary">
                                                    <span>确认</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>



<!--                                    <li class="editRoute__inTrip___2qt3Z">意大利<span class="editRoute__enTitle___2gfxk">Italy</span>-->
<!--                                        <i aria-label="图标: check" class="anticon anticon-check-->
<!--                                  editRoute__rightBtn___3O702-->
<!--                                  editRoute__inTripIndicator___VSQkP">-->
<!--                                            <img src="/lushu/static/svg/icon-66.svg" style="width: 1rem;height: 1rem">-->
<!--                                        </i>-->
<!--                                        <i aria-label="图标: right" class="anticon anticon-right-->
<!--                                  editRoute__rightBtn___3O702">-->
<!--                                            <img src="/lushu/static/svg/icon-65.svg" style="width: 1rem;height: 1rem">-->
<!--                                        </i>-->
<!--                                    </li>-->

                                </ul>
                            </div>
                            <div class="editRoute__paginationContainer___gKhov">
                                <button v-on:click="getPreviousPage()"  type="button" class="ant-btn editRoute__pagination___2ohwR ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                    <i aria-label="图标: left" class="anticon anticon-left">
                                        <img src="/lushu/static/svg/icon-50.svg" style="width: 1rem;height: 1rem">
                                    </i>
                                </button>
                                <span class="editRoute__pageIndex___UL_mT">{{city.page}}</span>
                                <button v-on:click="getNextPage()" type="button" class="ant-btn editRoute__pagination___2ohwR ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                    <i aria-label="图标: right" class="anticon anticon-right">
                                        <img src="/lushu/static/svg/icon-67.svg" style="width: 1rem;height: 1rem">
                                    </i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="plannerMain__cell___2Vav9" style="left:432px;width:calc((100% - 448px) * 1);z-index:20">
            <div class="plannerMain__plannerPanelWrap___3vIXb">
                <div class="editRouteMap__container___1H4zG">
                    <div class="map__piecefulMap___cY63A  editRouteMap__editRouteMap___3pGDv">
                        <div class="map__mapController___1gPju">
                            <div class="map__btnBox___1BBqS map__disabled___31D-2">
                                <i aria-label="图标: plus" class="anticon anticon-plus">
                                    <img src="/lushu/static/svg/icon-22.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </div>
                            <div class="map__btnBoxDivider___29Fz9"></div>
                            <div class="map__btnBox___1BBqS
                            map__disabled___31D-2">
                                <i aria-label="图标: minus" class="anticon
                              anticon-minus">
                                    <img src="/lushu/static/svg/icon-68.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </div>
                        </div>
                        <div class="map__domesticController___rAbSP">
                            <div class="map__btnBox___1BBqS">
                                <i aria-label="图标: map-world" class="anticon anticon-map-world">
                                    <img src="/lushu/static/svg/icon-69.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </div>
                            <div class="map__btnBoxDivider___29Fz9"></div>
                            <div class="map__btnBox___1BBqS
                            map__disabled___31D-2">
                                <i aria-label="图标: map-china" class="anticon anticon-map-china">
                                    <img src="/lushu/static/svg/icon-70.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </div>
                        </div>
                        <div class="map__mapBlock___2rphQ">
                            <iframe src="layout/map_edit.php" id="map_edit" width="100%" height="100%"></iframe>
                        </div>
                    </div>
                    <div class="layerActionPanel__layerActions___2_y2Y">
                        <button type="button" class="ant-btn layerActionPanel__btnClose___3OVE0 ant-btn-danger ant-btn-lg ant-btn-icon-only" v-on:click="close_prject_day_city">
                            <i aria-label="图标: close" class="anticon anticon-close">
                                <img src="/lushu/static/svg/icon-53.svg" style="width: 2rem;height: 2rem">
                            </i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="plannerMain__cell___2Vav9" style="color:#e6e7e8left:0;width:184px;background-color:white;z-index:22">
            <div class="plannerMain__plannerPanelWrap___3vIXb">
                <div class="plannerCalender__calenderMain___EK1f6">
                    <div class="plannerCalender__calenderInner___1sSG4">
                        <div>
                            <div class="plannerCalender__calender___1IiFG plannerCalender__routeCalender___27Tlx">
                                <div class="plannerCalender__insertDay___15L0A plannerCalender__first___1PUnA">
									<span class="widgets__voidLink___1jqQz plannerCalender__insertDayBtn___pngAl">
										<i aria-label="图标: plus" class="anticon anticon-plus">
											<img src="/lushu/static/svg/icon-52.svg" style="width: 1rem;height: 1rem">
										</i>插入一天
									</span>
                                </div>
                                <div class="plannerCalender__body___2SD-1">
                                    <div class="plannerCalender__days___2BwH9">
                                        <div>
                                            <div>
                                                <div v-for="(item,index) in day_list" :key="index"
                                                     :class="item.status? 'plannerCalender__calenderItem___TmBAj plannerCalender__day___Q1zcJ plannerCalender__selected___3meS7':'plannerCalender__calenderItem___TmBAj plannerCalender__day___Q1zcJ ' "
                                                     v-on:click="get_day_code(item)"
                                                >
                                                    <h3>D
                                                        <!-- --> {{item.day}}
                                                    </h3>
                                                    <div class="plannerCalender__date___1JvdJ">
                                                        <span class="plannerCalender__dateDay___2zulE">{{item.time}}</span>
                                                        <span>{{item.work}}</span>
                                                    </div>
                                                    <span class="widgets__voidLink___1jqQz plannerCalender__btnRemoveDay___103I6" v-on:click="del_project_daynumber(item)">删除今日</span>
                                                    <div class="plannerCalender__dayCityList___2mPYV">
                                                        <div class="plannerCalender__city___1rlik " v-for="(a,b) in item.city" :key="a.id">
                                                            <span class="plannerCalender__cityName___Bva1X">
                                                                <i v-if="b == 0 && index == 0" aria-label="图标: flag" class="anticon anticon-flag plannerCalender__flagIcon___1CmwX">
                                                                    <img src="/lushu/static/svg/icon-47.svg" style="width: 1rem;height: 1rem">
                                                                </i>
                                                                {{a.value}}
                                                                <span v-on:click="del_city_day_code(item.day,a.id,b)" class="widgets__voidLink___1jqQz plannerCalender__btnRemoveCity___2uvEZ">
                                                                    <i aria-label="图标: minus-circle" class="anticon anticon-minus-circle">
                                                                        <img src="/lushu/static/svg/icon-72.svg" style="width: 0.7rem;height: 0.7rem">
                                                                    </i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="plannerCalender__addDay___18lVt">
                                                    <button type="button" class="ant-btn plannerCalender__addDayBtn___2_wXU ant-btn-lg" v-on:click="add_project_day">
                                                        <i aria-label="图标: plus" class="anticon anticon-plus">
                                                            <img src="/lushu/static/svg/icon-55.svg" style="width: 1rem;height: 1rem">
                                                        </i>
                                                        <span>增加一天</span>
                                                    </button>
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
        <div  class="plannerMain__layerWrapper___3pJQ9" style="z-index:19;">
            <div class="plannerMain__layerCover___2ZoU_"></div>
        </div>
    </div>
</div>
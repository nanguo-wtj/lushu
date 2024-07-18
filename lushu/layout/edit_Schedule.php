<div class="plannerMain__pageBody___336Xk">
    <div>
        <!-- poi 交通工具等-->
        <div id="day_poi" class="plannerMain__cell___2Vav9" style="left: 512px; width: 608px; z-index: 20;">
            <div class="plannerMain__plannerPanelWrap___3vIXb">
                <div class="editAgendaExplore__addAgendaWrapper___gGXvX">
                    <div class="editAgendaExplore__addAgendaPanel___L6Bnf">
                        <div class="editAgendaExplore__panelHeader___1EgLe">
                            <div>
                                <div class="editAgendaExplore__categories___sEF3b">
                                    <div class="clear tabsNav__tabNav___1-jmV">
                                        <div class="tabsNav__tabsGroup___3G2wf">
                                            <span class="tabsNav__tab___cgToo" :class="{ tabsNav__active___3OOMW : schedule.column == 'poi' }" @click="select_column('poi')">POI</span>
                                            <span class="tabsNav__tab___cgToo" :class="{ tabsNav__active___3OOMW : schedule.column == 'hotel' }" @click="select_column('hotel')">酒店住宿</span>
                                            <span class="tabsNav__tab___cgToo" :class="{ tabsNav__active___3OOMW : schedule.column == 'activity' }" @click="select_column('activity')">活动与服务</span>
                                            <span class="tabsNav__tab___cgToo" :class="{ tabsNav__active___3OOMW : schedule.column == 'traffic' }" @click="select_column('traffic')">交通方案</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- poi -->
                        <?php include(dirname(__FILE__,2) . '/layout/edit_Schedule_poi.php');?>
                        <!-- hotel -->
                        <?php include(dirname(__FILE__,2) . '/layout/edit_Schedule_hotel.php');?>
                        <!-- activity -->
                        <?php include(dirname(__FILE__,2) . '/layout/edit_Schedule_activity.php');?>
                        <!-- 交通方案 -->
                        <?php include(dirname(__FILE__,2) . '/layout/edit_Schedule_traffic.php');?>
<!--                        地图-->
                        <div id="poiMap" style="display:none;width: 829px;margin-left: 120px;position: absolute;height: 93%;">
                            <iframe src="layout/map_edit.php"  id="map_poi_view" width="100%" height="100%"></iframe>
                        </div>
                    </div>
                    <div class="layerActionPanel__layerActions___2_y2Y">
                        <button type="button" @click="close_edit" class="ant-btn layerActionPanel__btnClose___3OVE0 ant-btn-danger ant-btn-lg ant-btn-icon-only">
                            <i aria-label="图标: close" class="anticon anticon-close">
                                <img src="/lushu/static/svg/icon-53.svg" style="width: 1rem;height: 1rem">
                            </i>
                        </button>
                        <button type="button" v-on:click="OperationMap"  class="ant-btn layerActionPanel__btnFooter___2YdAS ant-btn-primary" :class="{'ant-btn-danger': showMap}" ant-click-animating-without-extra-node="false">
                            <span v-if="poiMap == false">查看地图</span>
                            <span v-if="poiMap">关闭地图</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="traffic" style="display: none;">
            <!-- 设置交通 -->
            <?php include(dirname(__FILE__,2) . '/layout/set_Schedule_traffic.php');?>
        </div>
        <!-- 餐食编辑 -->
        <?php include(dirname(__FILE__,2) . '/layout/edit_eat.php');?>
        <!-- 日期，天 -->
        <div class="plannerMain__cell___2Vav9" style="left: 0px; width: 96px; background-color: white; z-index: 22;">
            <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__edit___N0q2x">
                <div class="plannerCalender__calenderMain___EK1f6">
                    <div class="plannerCalender__calenderInner___1sSG4">
                        <div>
                            <div class="plannerCalender__calender___1IiFG plannerCalender__agendaCalender___3mJqQ">
                                <div class="plannerCalender__body___2SD-1">
                                    <div class="plannerCalender__days___2BwH9">
                                        <div v-for="(item,index) in day_list" :key="index" class="plannerCalender__calenderItem___TmBAj plannerCalender__day___Q1zcJ" :class="{ plannerCalender__selected___3meS7: day == item.day }" @click="chengeDay(item)">


                                            <h3>D {{item.day}}
                                            </h3>
                                            <div class="plannerCalender__date___1JvdJ">
                                                <span class="plannerCalender__dateDay___2zulE">{{item.time}}</span>
                                                <!--<span>{{item.work}}</span>-->
                                            </div>
                                            <div class="plannerCalender__dayCityList___2mPYV">
                                                <div class="plannerCalender__city___1rlik " v-for="(a,b) in item.city" :key="a.id">
													<span class="plannerCalender__cityName___Bva1X">
														<i v-if="b == 0 && index == 0" aria-label="图标: flag" class="anticon anticon-flag plannerCalender__flagIcon___1CmwX">
															<img src="/lushu/static/svg/icon-47.svg" style="width: 1rem;height: 1rem">
														</i>
														{{a.value}}
													</span>
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
        <!-- 日程安排 -->
        <div class="plannerMain__cell___2Vav9 enter-done" style="left: 104px; width: 400px; z-index: 22;">
            <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__edit___N0q2x">
                <div class="plannerPanel__plannerPanel___3vpy8">
                    <div class="plannerPanel__body___l2w7l plannerPanel__noHead___Ci-f7">
                        <div>
                            <div class="agenda__editAgenda___2eSMA">
                                <div class="agenda__title___34IEr">D{{day}} ({{day_code.time}} {{day_code.work}}) - 日程安排</div>
                                <div class="agenda__dayCities___1Gdtt">
									<span v-for="(item,index) in schedule.city" :key="index">
										<i v-if="index != 0" aria-label="图标: swap-right" class="anticon anticon-swap-right agenda__arrow___21WbH">
											<img src="/lushu/static/svg/icon-110.svg" style="width: 1rem;height: 1rem">
										</i>
										<span class="agenda__city___3ksgH">
											<i v-if="index == 0" aria-label="图标: flag" class="anticon anticon-flag">
												<img src="/lushu/static/svg/icon-111.svg" style="width: 1rem;height: 1rem">
											</i>
                                            {{item.value}}
										</span>

									</span>
                                    <button v-on:click="Add_day_city()" type="button" class="ant-btn agenda__btnAddCity___39poB ant-btn-plain ant-btn-sm ant-btn-icon-only">
                                        <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
                                            <img src="/lushu/static/svg/icon-112.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                    </button>


                                </div>
                                <div class="agenda__agendaContent___3Wrqi" style="position: absolute; inset: 88px 0px 0px;">
                                    <div class="agenda__agendaContentInner___1VLtG">
                                        <div v-if="eatingMsg.status" class="mealList__mealListWrap___2D_6Y mealList__editPreview___31VfW" @click="eatDlg = true;$('#day_poi').hide();">
                                            <div class="mealList__mealList___3fEB_">
                                                <i aria-label="图标: poi-method-1" class="anticon anticon-poi-method-1 mealList__icon___On4se">
                                                    <img src="/lushu/static/svg/icon-48.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">
                                                </i>
                                                <div class="mealList__mealBox___2VU-l">
                                                    <span class="mealList__label___3T8Vn">早</span>{{ eatingMsg.breakfast }}
                                                </div>
                                                <div class="mealList__mealBox___2VU-l">
                                                    <span class="mealList__label___3T8Vn">午</span>{{ eatingMsg.lunch }}
                                                </div>
                                                <div class="mealList__mealBox___2VU-l">
                                                    <span class="mealList__label___3T8Vn">晚</span>{{ eatingMsg.dinner }}
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="agenda__addMeals___276Oi" @click="eatDlg = true;$('#day_poi').hide();">
                                            <i aria-label="图标: poi-method-1" class="anticon anticon-poi-method-1 agenda__icon___3CviI">
                                                <img src="/lushu/static/svg/icon-112.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                            <label>暂未添加用餐信息</label>
                                            <span class="agenda__addMealsBtn___2rr1H">+ 添加</span>
                                        </div>


                                        <div class="agenda__editingAgendaList___16ejF">
                                            <div class="agenda__agendaListWrapper___1gILO">

                                                <div v-for="(item,index) in selectPoiList"  v-on:click="Getdetails_Resources_data(item.schedule,item.type)" :key="index" @dragstart="handleDragStart($event, item)" @dragover.prevent="handleDragOver($event, item)" @dragenter="handleDragEnter($event, item)" @dragend="handleDragEnd($event, item)">
                                                    <div draggable="true" class="widgets__draggable___3E4Xh agenda__agendaItem___1aX_w">
                                                        <div class="tripDayAgendaList__agendaItem___1E2QK">
                                                            <span class="tripDayAgendaList__indexNum___fNUg5">{{ index + 1 }}</span>
                                                            <span v-if="item.type != 7 " class="tripDayAgendaList__icon___84ljn">
																<i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4">
																	<img src="/lushu/static/svg/icon-101.svg" style="    width: 1rem; height: 1rem;">
																</i>
															</span>
                                                            <span v-if="item.type == 7 " class="tripDayAgendaList__icon___84ljn tripDayAgendaList__activity___2EkUm">
                                                                <i aria-label="图标: activity" class="anticon anticon-activity">
                                                                    <img src="/lushu/static/svg/icon-135.svg" style="    width: 1rem; height: 1rem;">
                                                                </i>
                                                            </span>
                                                            <div class="tripDayAgendaList__title___3S1R9">{{item.title}}</div>
                                                        </div>
                                                        <button type="button" v-on:click="Del_project_poi(item)" class="ant-btn agenda__btnDeleteAgendaItem___kCT0F ant-btn-danger ant-btn-circle ant-btn-sm ant-btn-icon-only">
                                                            <i aria-label="图标: delete" class="anticon anticon-delete">
                                                                <img src="/lushu/static/svg/icon-48.svg" style="width: 0.7rem;height: 0.7rem;margin-top: -4px">
                                                            </i>
                                                        </button>
                                                    </div>
                                                    <div v-if="index != selectPoiList.length - 1" class="agenda__addTransit___b0CGd agenda__agendaItem___1aX_w" @click="addTraffic(item)">
                                                        <i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
                                                            <img src="/lushu/static/svg/icon-112.svg" style="width: 1rem;height: 1rem">
                                                        </i>{{item.traffic}}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- 添加行程 -->
                                    <div id="addCityFlag" style="display: none;">
                                        <?php include(dirname(__FILE__,2) . '/layout/add_city.php');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="plannerMain__layerWrapper___3pJQ9" style="z-index: 19;">
            <div class="plannerMain__layerCover___2ZoU_"></div>
        </div>
    </div>
</div>
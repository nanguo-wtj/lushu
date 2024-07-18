<div class="plannerMain__cell___2Vav9 enter-done" style="left: 196px; width: calc((100% - 240px) * 0.3333); z-index: 12;">
    <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__default___Le6uz">
        <div class="plannerPanel__plannerPanel___3vpy8">
            <div class="plannerPanel__header___3iE-t">
                <h2>日程安排</h2>
                <div class="plannerPanel__headerActions___2-0JG">
                    <button type="button" class="ant-btn ant-btn-primary" @click="edit_Schedule">
                        <span >编辑</span>
                    </button>
                </div>
            </div>
            <div class="plannerPanel__body___l2w7l">
                <div>
                    <div v-if="eatingMsg.status" class="mealList__mealListWrap___2D_6Y mealList__editPreview___31VfW">
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

                    
                    
                    <div class="tripDayAgendaList__agendaListWrap___3nBzv tripDayAgendaList__editPreview___3zpKk">
<!--                        <div class="longTransit__longTransit___3KNeD tripDayAgendaList__longTransit___1klQm">-->
<!--                            <div class="longTransit__meta___3w7EX">-->
<!--                                <div class="longTransit__name___24v8m">TK021</div>-->
<!--                            </div>-->
<!--                            <div class="longTransit__info___2-j7o">-->
<!--                                <div class="longTransit__depart___3yGzq">-->
<!--                                    <div class="longTransit__city___2gqSa">北京</div>-->
<!--                                    <div class="longTransit__time___1qKN0">00:10</div>-->
<!--                                </div>-->
<!--                                <div class="longTransit__method___1RDka">-->
<!--                                    <div class="longTransit__name___24v8m">-->
<!--                                        <i aria-label="图标: transit-method-1" class="anticon anticon-transit-method-1 longTransit__icon___15Lgw">-->
<!--                                            <img src="/lushu/static/svg/icon-79.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">-->
<!--                                        </i>TK021-->
<!--                                    </div>-->
<!--                                    <div class="longTransit__arrow___7sUsx">-->
<!--                                        <img src="https://static.lushu.com/images/new/transit-arrow.svg">-->
<!--                                    </div>-->
<!--                                    <span>5小时5分钟</span>-->
<!--                                </div>-->
<!--                                <div class="longTransit__arrive___3WqQB">-->
<!--                                    <div class="longTransit__city___2gqSa">伊斯坦布尔</div>-->
<!--                                    <div class="longTransit__time___1qKN0">05:15</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="tripDayAgendaList__transit___2luVb">-->
<!--                            <span> </span>-->
<!--                        </div>-->
<!--                        <div class="tripDayAgendaList__agendaItem___1E2QK">-->
<!--                            <span class="tripDayAgendaList__indexNum___fNUg5">1</span>-->
<!--                            <span class="tripDayAgendaList__icon___84ljn tripDayAgendaList__activity___2EkUm">-->
<!--                                <i aria-label="图标: activity" class="anticon anticon-activity">-->
<!--                                    <img src="/lushu/static/svg/icon-99.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">-->
<!--                                </i>-->
<!--                            </span>-->
<!--                            <div class="tripDayAgendaList__title___3S1R9">接送机服务</div>-->
<!--                        </div>-->
<!--                        <div class="tripDayAgendaList__transit___2luVb tripDayAgendaList__transitHover___1BkGD">-->
<!--                            <span>驾车; </span>32.5公里; 38分钟-->
<!--                        </div>-->
<!--                        <div class="tripDayAgendaList__agendaItem___1E2QK">-->
<!--                            <span class="tripDayAgendaList__indexNum___fNUg5">2</span>-->
<!--                            <span class="tripDayAgendaList__icon___84ljn">-->
<!--                                <i aria-label="图标: poi-method-2" class="anticon anticon-poi-method-2">-->
<!--                                    <img src="/lushu/static/svg/icon-100.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">-->
<!--                                </i>-->
<!--                            </span>-->
<!--                            <div class="tripDayAgendaList__title___3S1R9">安德烈拉丁酒店</div>-->
<!--                        </div>-->
                        <div v-for="(item,index) in selectPoiList" :key="index" v-on:click="Getdetails_Resources_data(item.schedule,item.type)">

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
                            <div v-if="index != (selectPoiList.length -1)" class="tripDayAgendaList__transit___2luVb tripDayAgendaList__transitHover___1BkGD">
                                {{item.traffic}}
                            </div>
                        </div>

<!--                        <div class="tripDayAgendaList__transit___2luVb tripDayAgendaList__transitHover___1BkGD">-->
<!--                            <span>步行; </span>370米; 5分钟-->
<!--                        </div>-->
<!--                        <div class="tripDayAgendaList__agendaItem___1E2QK">-->
<!--                            <span class="tripDayAgendaList__indexNum___fNUg5">4</span>-->
<!--                            <span class="tripDayAgendaList__icon___84ljn">-->
<!--                                <i aria-label="图标: poi-method-1" class="anticon anticon-poi-method-1">-->
<!--                                     <img src="/lushu/static/svg/icon-102.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">-->
<!--                                </i>-->
<!--                            </span>-->
<!--                            <div class="tripDayAgendaList__title___3S1R9">拉杜丽</div>-->
<!--                        </div>-->
<!--                        <div class="tripDayAgendaList__transit___2luVb tripDayAgendaList__transitHover___1BkGD">-->
<!--                            <span>步行; </span>690米; 10分钟-->
<!--                        </div>-->
<!--                        <div class="tripDayAgendaList__agendaItem___1E2QK">-->
<!--                            <span class="tripDayAgendaList__indexNum___fNUg5">8</span>-->
<!--                            <span class="tripDayAgendaList__icon___84ljn tripDayAgendaList__accomadation___3dc0N">-->
<!--                                <i aria-label="图标: poi-method-2" class="anticon anticon-poi-method-2">-->
<!--                                     <img src="/lushu/static/svg/icon-103.svg" style="    width: 0.7rem; height: 0.7rem; margin-top: -4px;">-->
<!--                                </i>-->
<!--                            </span>-->
<!--                            <div class="tripDayAgendaList__title___3S1R9">安德烈拉丁酒店</div>-->
<!--                            <div class="tripDayAgendaList__accomadationType___GSDqs">住宿</div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

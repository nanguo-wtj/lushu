<div class="plannerMain__cell___2Vav9" style="left:0;width:184px;background-color:#F7F7F8;z-index:12">
    <div class="plannerMain__plannerPanelWrap___3vIXb">
        <div class="plannerCalender__calenderMain___EK1f6">
            <div class="plannerCalender__calenderInner___1sSG4">
                <div>
                    <div class="plannerCalender__calender___1IiFG plannerCalender__homeCalender___2LIxQ">
                        <div class="plannerCalender__header___3O78C">
                            <h3>行程安排</h3>
                            <button type="button" class="ant-btn plannerCalender__editRouteBtn___3Oy9_ ant-btn-plain ant-btn-sm" v-on:click="get_day_list()">
                                <i aria-label="图标: edit" class="anticon anticon-edit">
                                    <img src="/lushu/static/svg/icon-46.svg" style="width: 1rem;height: 1rem">
                                </i>
                                <span>编辑</span>
                            </button>
                        </div>
                        <div class="plannerCalender__body___2SD-1">
                            <div v-on:click="get_project_day()" class="plannerCalender__calenderItem___TmBAj <? if(!$day && $cmd != 'project_edit_notes_export'){?>plannerCalender__selected___3meS7<? }?>">
                                <h3>行程总览</h3>
                            </div>
                            <div class="plannerCalender__days___2BwH9">


                                <div v-for="(item,index) in day_list" :key="index"  v-on:click="get_project_day(item.day)"
                                     :class="item.status? 'plannerCalender__calenderItem___TmBAj plannerCalender__day___Q1zcJ plannerCalender__selected___3meS7':'plannerCalender__calenderItem___TmBAj plannerCalender__day___Q1zcJ ' "
                                >
                                    <h3>D {{item.day}}
                                    </h3>
                                    <div class="plannerCalender__date___1JvdJ">
                                        <span class="plannerCalender__dateDay___2zulE">{{item.time}}</span>
                                        <span>{{item.work}}</span>
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
                            <div class="plannerCalender__calenderItem___TmBAj <? if(!$day && $cmd == 'project_edit_notes_export'){?>plannerCalender__selected___3meS7<? }?>">
                                <a href="./project_edit_notes_export.html?key_id=<?=$key_id?>">
                                    <h3>行程备注</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

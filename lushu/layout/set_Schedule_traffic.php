<div class="plannerMain__cell___2Vav9" style="left: 512px; width: 400px; z-index: 21;">
    <div class="plannerMain__plannerPanelWrap___3vIXb plannerMain__edit___N0q2x">
        <div class="plannerPanel__plannerPanel___3vpy8 transit__panel___1D4Bt">
            <div class="plannerPanel__header___3iE-t">
                <h2>添加交通</h2>
                <div class="plannerPanel__headerActions___2-0JG">
                    <button type="button" class="ant-btn ant-btn-danger ant-btn-icon-only" @click="closeTraffic">
                        <i aria-label="图标: double-left" class="anticon anticon-double-left">
                            <img src="/lushu/static/svg/icon-116.svg" style="width: 1rem;height: 1rem">
                        </i>
                    </button>
                </div>
            </div>
            <div class="plannerPanel__body___l2w7l">
                <div class="transit__panelInner___2Hb8o">
                    <div class="transit__locationHeader___1EkUp" style="margin-bottom: 20px">
                        <span>{{schedule.Traffic.starting}}</span>
                        <i aria-label="图标: swap-right" class="anticon anticon-swap-right transit__icon___1Dv4D">
                            <img src="/lushu/static/svg/icon-117.svg" style="width: 1rem;height: 1rem">
                        </i>
                        <span>{{schedule.Traffic.end}}</span>
                    </div>
                    <div class="transit__selectTransit___ChDj8">
                        <div class="transit__transitMainType___1QMB0">
                            <div v-for="item,index in Transportation" :key="index" class="tripElementAddControl__tripElementAddControl___2ffiM tripElementAddControl__control___30rqE tripElementAddControl__actionAdd___2YbP8 tripElementAddControl__positionRightCenter___1PRs2" @clcik="setTrafficClick(item,index)">
                                <div class="tripElementAddControl__btns___3cfir">
                                    <button v-if='item.id != schedule.Traffic.traffic'  v-on:click="Editprojectdaytraffic(item.id)" type="button" class="ant-btn tripElementAddControl__btnAdd___3M54d ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                        <i aria-label="图标: plus" class="anticon anticon-plus">
                                            <img src="/lushu/static/svg/icon-52.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                    </button>
                                    
                                    <button v-else type="button" ant-click-animating-without-extra-node="false" class="ant-btn tripElementAddControl__labelAdded___dGYg6 ant-btn-primary ant-btn-sm ant-btn-icon-only">
                                        <i aria-label="图标: check" class="anticon anticon-check editAgendaExplore__addedIndicator___pLHYe">
                                            <img src="/lushu/static/svg/icon-57.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                    </button>
                                </div>
                                <div class="direction__direction___3Ynyg direction__directionBox___1hIBa tripElementAddControl__element___3LZTR tripElementAddControl__direction___2qs6Y">
                                    <div class="direction__directionTitle___2swhd">{{item.value}}</div>
<!--                                    <div class="direction__meta___2tTBN">18.2公里 1小时36分钟</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
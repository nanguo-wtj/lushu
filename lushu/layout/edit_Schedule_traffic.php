<div :style="schedule.column == 'traffic'? '':'display:none;'" class="editAgendaExplore__panelBody___38S7-">
    <div class="exploreLongTransits__exploreLongTransits___1r6xk">
        <div class="exploreLongTransits__filterRow___34XRC" style="position: unset;" v-for="(item,index) in schedule.traffic" :key="index">
            <div class="exploreLongTransits__filterLeft___3VWDz">
                <div class="exploreLongTransits__dropdownInner___jsiIV ant-dropdown-trigger">
                    <span class="exploreLongTransits__dropdownValue___1wIte">{{item.startingPoint.region_name}}</span>
                </div>
                <div class="exploreLongTransits__arrowTo___3AauK">
                    <img src="//static.lushu.com/images/new/transit-arrow.svg">
                </div>
                <div class="exploreLongTransits__dropdownInner___jsiIV ant-dropdown-trigger">
                    <span class="exploreLongTransits__dropdownValue___1wIte">{{item.destination.region_name}}</span>
                </div>
            </div>
            <div class="exploreLongTransits__filterRight___3N4lI trafficlist" style="position: relative">
                <div class="exploreLongTransits__dropdownInner___jsiIV ant-dropdown-trigger">
                    交通方案: <span class="exploreLongTransits__dropdownValue___1wIte">{{item.Traffic_value}}</span>
                    <div class="exploreLongTransits__icon___2NRty">
                        <i aria-label="图标: down" class="anticon anticon-down">
                            <img src="/lushu/static/svg/icon-105.svg" style="width: 1rem;height: 1rem">
                        </i>
                    </div>
                </div>

                <div style="position: absolute; top: 20px; right: 0;display:none;z-index:99;" class="list-box">
                    <div>
                        <div class="ant-dropdown-placement-bottomLeft" style="left: 1011px; top: 149px; min-width: 121px;">
                            <ul class="ant-dropdown-menu ant-dropdown-menu-light ant-dropdown-menu-root ant-dropdown-menu-vertical" role="menu">
                                <li class="ant-dropdown-menu-item" v-for="(a,b) in Transportation" v-on:click="Set_Transportation(item,a)">{{a.value}}</li>

                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div></div>
    </div>
</div>
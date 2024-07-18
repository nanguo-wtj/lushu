<div :style="schedule.column == 'activity'? '':'display:none;'" class="editAgendaExplore__panelBody___38S7-">
    <div class="editAgendaExplore__explorePlaces___1PoZn">
        <div class="editAgendaExplore__destinationList___3doxM">
            <div class="editAgendaExplore__destinationOptions___3hpx6">
                <ul class="ant-menu ant-menu-light ant-menu-root ant-menu-inline" role="menu">
                    <li v-for="(item,index) in schedule.city" :key="index" v-on:click="search_address(item)" :class="schedule_search.address == item.id? 'ant-menu-item ant-menu-item-selected':'ant-menu-item'" role="menuitem" style="padding-left: 24px;">
                        <span class="editAgendaExplore__title___3NGOL">{{item.value}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="editAgendaExplore__exploreMain___gMK78 editAgendaExplore__searchboxVisible___hDf_u">
            <div class="editAgendaExplore__exploreOptions___1eBXI">
                <form @submit.prevent="search">
                    <input type="submit" value="on" style="display: none">
                    <div class="editAgendaExplore__searchbox___2Qeb6">
						<span class="ant-input-affix-wrapper">
							<span class="ant-input-prefix">
								<i aria-label="图标: search" class="anticon anticon-search">
									<img src="/lushu/static/svg/icon-59.svg" style="width: 1rem;height: 1rem">
								</i>
							</span>
							<input placeholder="搜索关键字" class="ant-input" v-model="schedule_search.title" type="text" value="">
						</span>
                    </div>
                </form>
            </div>
            <div class="editAgendaExplore__exploreResults___17l2b" id="activity" style="top: 40px">
                <div class="editAgendaExplore__agendaExploreResults___2UMc1">
                    <div v-for="(item,index) in activityList" :key="index" class="editAgendaExplore__resultItem___gKDrm">
                        <div class="editAgendaExplore__itemCover___1FjuG">

                            <span v-if="!item.picture"  class="widgets__lushuBackgroundImage___3XMmZ" style="background-color: #f4f4f5">
								<img src="/lushu/static/svg/icon-104.svg" style="width: 3rem;height: 3rem">
							</span>
                            <span  v-if="item.picture"  class="widgets__lushuBackgroundImage___3XMmZ" style="background-color: #f4f4f5">
								<img :src="item.picture" style="width: 100%;height: 100%;">
							</span>
                        </div>
                        <div class="editAgendaExplore__itemInfo___2jHZ_">
                            <div class="editAgendaExplore__title___3NGOL">{{item.title}}</div>
                            <div class="editAgendaExplore__subtitle___3YF_V">{{item.user}}</div>
                            <div class="editAgendaExplore__tags___3a8Ti"></div>
                        </div>
                        <button type="button" @click="addActivity(item, index)" class="ant-btn editAgendaExplore__addBtn___1Hipx  ant-btn-primary" :class="{ editAgendaExplore__added___3Wg7X: item.select}" ant-click-animating-without-extra-node="false">
                            <i aria-label="图标: plus" class="anticon anticon-plus editAgendaExplore__addBtnIcon___2s12C">
                                <img src="/lushu/static/svg/icon-52.svg" style="width: 1rem;height: 1rem">
                            </i>
                            <i v-if="item.select" aria-label="图标: check" class="anticon anticon-check editAgendaExplore__addedIndicator___pLHYe">
                                <img src="/lushu/static/svg/icon-57.svg" style="width: 1rem;height: 1rem">
                            </i>
                        </button>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
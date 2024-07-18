<div class="notice" id="message" style="display: none;position: absolute">
    <div class="ant-drawer ant-drawer-right ant-drawer-open reminderAndPromptDrawer__drawer___1DkMx" style="">
        <div class="ant-drawer-mask" style=""></div>
        <div class="ant-drawer-content-wrapper" style="width: 1000px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">提醒与通知</div>
                        <div class="ant-drawer-right-actions">
                            <button aria-label="Close" class="ant-drawer-close" onclick="$('#message').hide()">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="reminderAndPromptDrawer__mainContainer___1cCHK">
                            <div class="reminderAndPromptDrawer__tabNav___1UxAd">
                                <div class="clear tabsNav__tabNav___1-jmV">

                                    <div class="tabsNav__tabsGroup___3G2wf tabsNav__tabsGroupRight___11F19">
										<span class="tabsNav__tab___cgToo tabsNav__active___3OOMW">
											<span class="ant-badge">系统公告
                                                <sup v-if="message_number > 0" data-show="true" class="ant-scroll-number ant-badge-dot" title="1"></sup>
											</span>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="notificationView__container___3w_3Z">
                                <div>

                                    <div v-for="(item,index) in message_list" :key="index"   class="notificationView__element___3Q98_" v-on:click="GetMessageData(item)">
                                        <div class="notificationView__top___1c-S8">
                                            <div :style="item.status == 1? 'color:#747e83':'color:black'"  class="index__ellipsis___29TdG notificationView__read___2R-Oj index__lineClamp___3S2HX">
                                                <style>
                                                    #antd-pro-ellipsis-171375431281067{-webkit-line-clamp:1;-webkit-box-orient: vertical;}
                                                </style>
                                                {{item.title}}
                                            </div>
                                        </div>
                                        <div class="notificationView__bottom___1HfzA">
                                            <span class="notificationView__date___3plVC">{{item.time}}</span>{{item.user}}
                                        </div>
                                        <div class="ant-divider ant-divider-horizontal"></div>
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

<div id="message_content" style="position: absolute;display: none;">
    <div class="ant-modal-mask"></div>
    <div tabindex="-1" class="ant-modal-wrap ant-modal-centered" role="dialog" style="">
        <div role="document" class="ant-modal modalOrderPage" style="width: 600px; transform-origin: 232px 122px;">
            <div tabindex="0" style="width: 0px; height: 0px; overflow: hidden;">sentinelStart</div>
            <div class="ant-modal-content">
                <button aria-label="Close" class="ant-modal-close" onclick="$('#message_content').hide()">
					<span class="ant-modal-close-x">
						<i aria-label="图标: close" class="anticon anticon-close ant-modal-close-icon">
                            <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
						</i>
					</span>
                </button>
                <div class="ant-modal-body">
                    <div class="notificationDetailModal__container___21908">
                        <div>
                            <div class="notificationDetailModal__title___1jaxb">{{message_data.title}}</div>
                            <div class="notificationDetailModal__dateContainer___2Rcsp">
                                <span class="notificationDetailModal__date___3AC_6">{{message_data.time}}</span>{{message_data.user}}
                            </div>
                        </div>
                        <div class="notificationDetailModal__content___2TdD_" v-html="message_data.content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
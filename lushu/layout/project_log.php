<?php if(!isset($project_log_type)){
    $project_log_type   =   1;
}
?>
<?php if($project_log_type == 1){?>
<div class="pagePanel pagePanel__pagePanel___3fszW projectOverview__rightContainer___1Ok4b pagePanel__sider___3KzU1" style="flex:0 0 320px;max-width:320px;min-width:320px;width:320px">
    <div>
<? }?>
        <div id="infiniteScroll" class="logTimeline__infiniteContainer___3WriK projectOverview__logTimeline___3nI_2">
            <div class="logTimeline__logTitle___1tvk4">动态记录</div>
            <div>
                <ul class="ant-timeline">
                    <li class="ant-timeline-item ant-timeline-item_frist">
                        <div class="ant-timeline-item-tail"></div>
                        <div class="ant-timeline-item-head
                                  ant-timeline-item-head-custom
                                  ant-timeline-item-head-blue">
                            <button type="button" class="ant-btn logTimeline__addIcon___2ejqY ant-btn-circle ant-btn-lg ant-btn-icon-only" onclick="addMark(false ,this)">
                                <i aria-label="图标: edit" class="anticon anticon-edit">
                                    <img src="/lushu/static/svg/icon-38.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>

                        <div class="ant-timeline-item-content">
                            <div class="logTimeline__timelineItem___3EcYc">
                                <span class="logTimeline__addMemo___18trs" onclick="addMark(false ,this)">添加备注</span>
                                <div>&nbsp;&nbsp;</div>
                            </div>
                        </div>
                    </li>


                    <li class="ant-timeline-item"  v-for="(item,index) in project_log" :key="index">
                        <div class="ant-timeline-item-tail"></div>
                        <div class="ant-timeline-item-head ant-timeline-item-head-custom ant-timeline-item-head-blue">
                            <span class="an-avatar  avatar__avatar___4NUXc">
                                <span class="avatar__avatarInner___1y0H-">
                                    <span class="ant-avatar ant-avatar-circle" style="background-color: rgb(89, 157,250);">
                                        <span class="ant-avatar-string" style="transform: scale(1) translateX(-50%);">{{item.user}}</span>
                                    </span>
                                </span>
                            </span>
                        </div>
                        <div class="ant-timeline-item-content">
                            <div class="logTimeline__timelineItem___3EcYc">
                                <div class="logTimeline__content___3SY14">
                                    {{item.data}}
                                </div>
                                <div class="logTimeline__memo___1PXKo" style="display: none;">
                                    <span></span>
                                    <div v-on:click="Add_ProjectLogShow(item,index)" class="logTimeline__modifyMemo___3-itX">
                                        <i aria-label="图标: edit" class="anticon anticon-edit logTimeline__icon___1KPae">
                                            <img src="/lushu/static/svg/icon-38.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                    </div>
                                </div>
                                <!-- 内容 -->
                                <div class="logTimeline__memo___1PXKo" v-if="item.msg">
                                    <span>{{item.msg}}</span>
                                    <div v-on:click="Add_ProjectLogShow(item,index)" class="logTimeline__modifyMemo___3-itX">
                                        <i aria-label="图标: edit" class="anticon anticon-edit
                                          logTimeline__icon___1KPae">
                                            <img src="/lushu/static/svg/icon-38.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                    </div>
                                </div>
                                <div>
									<span class="logTimeline__actioned___sDwAp">{{item.time}}</span>
                                    <button type="button" v-if="!item.msg" v-on:click="Add_ProjectLogShow(item,index)" class="ant-btn logTimeline__addMemoButton___2egjU ant-btn-plain">
                                        <span>添加备注</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>



                </ul>
            </div>
        </div>


<?php if($project_log_type == 1){?>
    </div>
</div>
<? }?>



<!-- 备注 -->
<div class="edit_mark" style="display: none;">
    <div>
        <div class="ant-modal-mask"></div>
        <div tabindex="-1" class="ant-modal-wrap ant-modal-centered" role="dialog" aria-labelledby="rcDialogTitle0" style="">
            <div role="document" class="ant-modal modalOrderPage" style="width: 400px; height: 342px; transform-origin: 959px 67.5px;">
                <div tabindex="0" style="width: 0px; height: 0px; overflow:
              hidden;">sentinelStart</div>
                <div class="ant-modal-content">
                    <button aria-label="Close" v-on:click="$('.edit_mark').css('display', 'none');project_log_status =   false;" class="ant-modal-close">
						<span class="ant-modal-close-x">
							<i aria-label="图标: close" class="anticon anticon-close ant-modal-close-icon">
								 <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
							</i>
						</span>
                    </button>
                    <div class="ant-modal-header">
                        <div class="ant-modal-title" id="rcDialogTitle0">备注</div>
                    </div>
                    <div class="ant-modal-body">
                        <form class="ant-form ant-form-horizontal logTimeline__addMemoModal___1IBNF">
                            <span class="logTimeline__addMemo___18trs">请添加备注</span>
                            <div class="ant-row ant-form-item">
                                <div class="ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control has-success">
										<span class="ant-form-item-children">
											<textarea rows="4" v-model="project_log_data" maxlength="100" class="ant-input logTimeline__textarea___2r89P" placeholder="请输入...(限100字)" id="memo"></textarea>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="logTimeline__footer___CDQbD">
                                <button type="button" v-if="project_log_status == true" v-on:click="Del_ProjectLogPost()" class="ant-btn ant-btn-dangerBorder del-mark">
                                    <span>删除</span>
                                </button>
                                <span class="logTimeline__rightButtons___138-m">
									<button type="button" class="ant-btn logTimeline__button___zkGi6" v-on:click="$('.edit_mark').css('display', 'none');project_log_status =   false">
										<span>取消</span>
									</button>
									<button type="button" class="ant-btn ant-btn-primary" v-on:click="Add_ProjectLogPost()">
										<span>确认</span>
									</button>
								</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
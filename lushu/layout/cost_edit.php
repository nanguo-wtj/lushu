<div class="dlg" style="display: none;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open tripBookings__editBookingDwawer___21HLA" style="">
        <div class="ant-drawer-mask" style=""></div>
        <div class="ant-drawer-content-wrapper" style="width: 820px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">{{cost_data.type}}</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" v-on:click="post_cost()" class="ant-btn ant-btn-primary">
                                    <span>保存</span>
                                </button>
                            </div>
                            <button aria-label="Close" onclick="$('.dlg').css('display','none')" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="tripBookings__drawerHeader___2UUls">
                            <h2>
                                {{cost_data.title}}
                            </h2>
                        </div>
                        <div class="tripBookings__tableHeaderRow___11dVV">
                            <div class="ant-row" style="margin-left: -8px; margin-right: -8px;">
                                <div class="ant-col-12" style="padding-left: 8px; padding-right: 8px;">预定选项</div>
                                <div class="ant-col-6" style="padding-left: 8px; padding-right: 8px;">参考单价</div>
                                <div class="ant-col-4" style="padding-left: 8px; padding-right: 8px;">数量</div>
                            </div>
                        </div>
                        <form class="ant-form ant-form-horizontal">
                            <div class="ant-row ant-form-item">
                                <div class="ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control has-success">
											<span class="ant-form-item-children">
												<div v-for="(item,index) in cost_data.list" :key="index" class="ant-row piece__bookingGroup___1k5Xr" style="margin-top:10px;margin-left: -8px; margin-right: -8px;">
													<div class="ant-col-12" style="padding-left: 8px; padding-right: 8px;">
														<input class="ant-input" placeholder="请输入" v-model="cost_data.list[index].name" type="text" value="成人">
													</div>
													<div class="ant-col-6" style="padding-left: 8px; padding-right: 8px;">
														<div class="ant-input-number ant-input-number-block skip-error">
															<div class="ant-input-number-handler-wrap">
																<span unselectable="unselectable" role="button" aria-label="Increase Value" aria-disabled="false" class="ant-input-number-handler ant-input-number-handler-up ">
																	<i aria-label="图标: up" class="anticon anticon-up ant-input-number-handler-up-inner">
																		<img src="/lushu/static/svg/icon-122.svg" style="width: 1rem;height: 1rem">
																	</i>
																</span>
																<span unselectable="unselectable" role="button" aria-label="Decrease Value" aria-disabled="false" class="ant-input-number-handler ant-input-number-handler-down ">
																	<i aria-label="图标: down" class="anticon anticon-down ant-input-number-handler-down-inner">
																		<img src="/lushu/static/svg/icon-123.svg" style="width: 1rem;height: 1rem">
																	</i>
																</span>
															</div>
															<div class="ant-input-number-input-wrap" role="spinbutton" aria-valuemin="0" aria-valuenow="3091">
																<input placeholder="￥0" v-model="cost_data.list[index].price" type="number" class="ant-input-number-input" autocomplete="off" maxlength="7" min="0" step="1" value="￥3091">
															</div>
														</div>
													</div>
													<div class="ant-col-4" style="padding-left: 8px; padding-right: 8px;">
														<div class="ant-input-number ant-input-number-block skip-error">
															<div class="ant-input-number-handler-wrap">
																<span unselectable="unselectable" role="button" aria-label="Increase Value" aria-disabled="false" class="ant-input-number-handler ant-input-number-handler-up ">
																	<i aria-label="图标: up" class="anticon anticon-up ant-input-number-handler-up-inner">
																		<img src="/lushu/static/svg/icon-122.svg" style="width: 1rem;height: 1rem">
																	</i>
																</span>
																<span unselectable="unselectable" role="button" aria-label="Decrease Value" aria-disabled="false" class="ant-input-number-handler ant-input-number-handler-down ">
																	<i aria-label="图标: down" class="anticon anticon-down ant-input-number-handler-down-inner">
																		<img src="/lushu/static/svg/icon-123.svg" style="width: 1rem;height: 1rem">
																	</i>
																</span>
															</div>
															<div class="ant-input-number-input-wrap" role="spinbutton" aria-valuemin="0" aria-valuenow="2">
																<input placeholder="0" v-model="cost_data.list[index].number" type="number" class="ant-input-number-input" autocomplete="off" maxlength="5" min="0" step="1" value="2">
															</div>
														</div>
													</div>
													<div class="ant-col-2" style="padding-left: 8px; padding-right: 8px;">
														<button v-on:click="del_cost_list(index)" type="button" class="ant-btn piece__iconMinus___3SHJy ant-btn-plain ant-btn-icon-only">
															<i aria-label="图标: minus-circle" class="anticon anticon-minus-circle">
																<img src="/lushu/static/svg/icon-72.svg" style="width: 1rem;height: 1rem">
															</i>
														</button>
													</div>
												</div>
											</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control" >
											<span class="ant-form-item-children" v-on:click="add_cost_list">
												<button type="button" class="ant-btn tripBookings__btnPlainNoSpace___yDzd1 ant-btn-plain" >
													<i aria-label="图标: plus-circle" class="anticon anticon-plus-circle">
														<img src="/lushu/static/svg/icon-49.svg" style="width: 1rem;height: 1rem">
													</i>
													<span>添加预定选项</span>
												</button>
											</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
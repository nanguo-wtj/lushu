<div class="add" style="display: none;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open editLongTransit__drawer___m0Ll4" style="">
        <div class="ant-drawer-mask">
        </div>
        <div class="ant-drawer-content-wrapper" style="width: 570px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">
                            新建交通信息
                        </div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" onclick="save()" class="ant-btn ant-btn-primary">
									<span>
										保 存
									</span>
                                </button>
                            </div>
                            <button aria-label="Close" onclick="$('.add').css('display', 'none')" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <form class="ant-form ant-form-horizontal ant-form-item-label-right">
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="method" class="ant-form-item-required" title="交通方式">
                                        交通方式
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<div id="method" class="ant-select ant-select-enabled">
												<div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="df7c49b8-28cb-4151-d529-17f6ddefb068" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]" tabindex="0">
													<div class="ant-select-selection__rendered" v-on:click="search_traffic_mode_show">
														<div  class="ant-select-selection__placeholder"  style="display: block; user-select: none;">
                                                            <img v-if="project_data.mode_img" :src="project_data.mode_img" style="width: 1rem;height: 1rem;margin-right: 10px">{{project_data.mode}}
														</div>
													</div>
													<span class="ant-select-arrow"  style="user-select: none;" v-on:click="search_traffic_mode_show">
														<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
															<img src="/lushu/static/svg/icon-20.svg" style="width: 1rem;height: 1rem">
														</i>
													</span>
                                                    <div class="traffic_body" style="display: none;">
															<div class="traffic_list" v-for="(item,index) in traffic.mode" :key="index" v-on:click="add_search_traffic_mode(item,index+1)" :style="prject_data_post.mode_key == (index+1)? 'background-color: #ececec':''">
																<div class="traffic_icon">
                                                                    <img :src="item.img" style="width: 1rem;height: 1rem">
                                                                </div>
																<div class="traffic_name">
                                                                    {{item.name}}
                                                                </div>
															</div>
                                                    </div>
												</div>
											</div>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="name" class="ant-form-item-required" title="班次">
                                        班次
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<input placeholder="请输入班次号" v-model="prject_data_post.classes" maxlength="20" type="text" id="name" data-__meta="[object Object]" data-__field="[object Object]" class="ant-input" value="">
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="departCity" class="ant-form-item-required" title="出发地">
                                        出发地
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<form class="ant-form ant-form-horizontal">
												<div class="destinationAutoComplete__container___2u6IR editLongTransit__cityInput___2dCia">
													<div class="ant-row ant-form-item">
														<div class="ant-form-item-control-wrapper">
															<div class="ant-form-item-control">
																<span class="ant-form-item-children">
																	<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
																		<div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="434013c1-fb7f-4e48-b33f-fb513cef54c5" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
																			<div class="ant-select-selection__rendered">
																				<ul>
																					<li class="ant-select-search ant-select-search--inline">
																						<div class="ant-select-search__field__wrap">
																							<span class="ant-select-search__field ant-input-affix-wrapper">
                                                                                                <input class="ant-input " @input="search_city(1)" v-model="project_data.departure_value" placeholder="请输入出发城市" type="text" value="">
																							</span>
                                                                                            <div class="city_body" v-if="city_list1_status">
                                                                                            <div class="city_list" v-for="item in city_list.city" :key="item.id" v-on:click="add_address(item,1)">
                                                                                                <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                            </div>
                                                                                            <div class="city_user" v-if="city_list.user.length > 0">以下为用户创建内容</div>
                                                                                            <div class="city_list"  v-for="item in city_list.user" :key="item.id" v-on:click="add_address(item,1)">
                                                                                                 <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                                <div class="city_icon">
                                                                                                    <img src="/lushu/static/svg/icon-15.svg" style="width: 1rem;height: 1rem">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
																							<span class="ant-select-search__field__mirror">&nbsp;</span>
																						</div>
																					</li>
																				</ul>
																			</div>
																			<span class="ant-select-arrow"  style="user-select: none;">
																				<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
																					<img src="/lushu/static/svg/icon-20.svg" style="width: 1rem;height: 1rem">
																				</i>
																			</span>
																		</div>
																	</div>
																</span>
															</div>
														</div>
													</div>
												</div>
											</form>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="departPoi" class="ant-form-item-required" title="出发地点">
                                        出发地点
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<div class="poiAutoComplete__container___2204X">
												<div class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-allow-clear">
													<div class="ant-select-selection
                                ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="d66994b6-34c1-4566-e8dc-d705efa50cda" aria-expanded="false">
														<div class="ant-select-selection__rendered">
															<ul>
																<li class="ant-select-search ant-select-search--inline">
																	<div class="ant-select-search__field__wrap">
																		<input placeholder="请输入出发地点" type="text" class="ant-input ant-select-search__field" value="">
																		<span class="ant-select-search__field__mirror">
																			&nbsp;
																		</span>
																	</div>
																</li>
															</ul>
														</div>
														<span class="ant-select-arrow"  style="user-select: none;">
															<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
																<img src="/lushu/static/svg/icon-20.svg" style="width: 1rem;height: 1rem">
															</i>
														</span>
													</div>
												</div>
											</div>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="arriveCity" class="ant-form-item-required" title="到达地">
                                        到达地
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<form class="ant-form ant-form-horizontal">
												<div class="destinationAutoComplete__container___2u6IR editLongTransit__cityInput___2dCia">
													<div class="ant-row ant-form-item">
														<div class="ant-form-item-control-wrapper">
															<div class="ant-form-item-control">
																<span class="ant-form-item-children">
																	<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
																		<div class="ant-select-selection
                                          ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="af12a03f-e182-4dca-db0f-efe8cfdd7f38" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
																			<div class="ant-select-selection__rendered">
																				<ul>
																					<li class="ant-select-search ant-select-search--inline">
																						<div class="ant-select-search__field__wrap">
																							<span class="ant-select-search__field ant-input-affix-wrapper">
																								<input class="ant-input" placeholder="请输入到达城市" type="text" value="">
																							</span>
																							<span class="ant-select-search__field__mirror">
																								&nbsp;
																							</span>
																						</div>
																					</li>
																				</ul>
																			</div>
																			<span class="ant-select-arrow"  style="user-select: none;">
																				<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
																					<img src="/lushu/static/svg/icon-20.svg" style="width: 1rem;height: 1rem">
																				</i>
																			</span>
																		</div>
																	</div>
																</span>
															</div>
														</div>
													</div>
												</div>
											</form>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="arrivePoi" class="ant-form-item-required" title="到达地点">
                                        到达地点
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<div class="poiAutoComplete__container___2204X">
												<div class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-allow-clear">
													<div class="ant-select-selection
                                ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="8468d867-ab70-44ca-dcc9-921666ab68d4" aria-expanded="false">
														<div class="ant-select-selection__rendered">
															<ul>
																<li class="ant-select-search ant-select-search--inline">
																	<div class="ant-select-search__field__wrap">
																		<input placeholder="请输入到达地点" type="text" class="ant-input ant-select-search__field" value="">
																		<span class="ant-select-search__field__mirror">
																			&nbsp;
																		</span>
																	</div>
																</li>
															</ul>
														</div>
														<span class="ant-select-arrow"  style="user-select: none;">
															<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
																<img src="/lushu/static/svg/icon-20.svg" style="width: 1rem;height: 1rem">
															</i>
														</span>
													</div>
												</div>
											</div>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="departTime" class="" title="出发时间">
                                        出发时间
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<span class="ant-time-picker editLongTransit__timePicker___PI4Sy">
												<input class="ant-time-picker-input" type="text" placeholder="请选择出发时间" id="departTime" value="">
												<span class="ant-time-picker-icon">
													<i aria-label="图标: clock-circle" class="anticon anticon-clock-circle ant-time-picker-clock-icon">
														<img src="/lushu/static/svg/icon-95.svg" style="width: 1rem;height: 1rem">
													</i>
												</span>
											</span>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label for="arriveTime" class="" title="到达时间">
                                        到达时间
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<span class="ant-time-picker editLongTransit__timePicker___PI4Sy">
												<input class="ant-time-picker-input" type="text" placeholder="请选择到达时间" id="arriveTime" value="">
												<span class="ant-time-picker-icon">
													<i aria-label="图标: clock-circle" class="anticon anticon-clock-circle ant-time-picker-clock-icon">
														<img src="/lushu/static/svg/icon-95.svg" style="width: 1rem;height: 1rem">

													</i>
												</span>
											</span>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item formItemGroup">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label class="" title="耗时">
                                        耗时
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<div class="ant-row" style="margin-left: -2px; margin-right: -2px;">
												<div class="ant-col-8" style="padding-left: 2px; padding-right: 2px;">
													<input placeholder="请输入" maxlength="2" type="text" class="ant-input" value="">
												</div>
												<div class="ant-col-4" style="padding-left: 2px; padding-right: 2px;">
													小时
												</div>
												<div class="ant-col-8" style="padding-left: 2px; padding-right: 2px;">
													<input placeholder="请输入" maxlength="2" type="text" class="ant-input" value="">
												</div>
												<div class="ant-col-4" style="padding-left: 2px; padding-right: 2px;">
													分钟
												</div>
											</div>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-6 ant-form-item-label">
                                    <label class="" title="参考价格">
                                        参考价格
                                    </label>
                                </div>
                                <div class="ant-col-18 ant-form-item-control-wrapper ant-form-item-control-price">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<span>
												<input placeholder="请输入类别" type="text" class="ant-input" value="" style="width: 40%; margin-right: 8px;">
												|
												<input placeholder="请输入价格" type="text" class="ant-input" value="" style="width: 40%; margin-left: 8px;">
											</span>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-18 ant-col-offset-6 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<button type="button" onclick="addPrice()" class="ant-btn ant-btn-dashed" style="width: 90%;">
												<i aria-label="图标: plus" class="anticon anticon-plus">
													<img src="/lushu/static/svg/icon-60.svg" style="width: 1rem;height: 1rem">

												</i>
												<span>
												</span>
												<span>
													新建参考价格
												</span>
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
<div>
    <div class="ant-drawer ant-drawer-right ant-drawer-open">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 840px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">路书信息设置</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" class="ant-btn ant-btn-primary" @click="saveSet">
                                    <span>保存</span>
                                </button>
                            </div>
                            <button aria-label="Close" class="ant-drawer-close" @click="setShow = false">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <form class="ant-form ant-form-horizontal tripMeta__form___21pj4">
                            <div class="ant-row" style="margin-left: -16px; margin-right: -16px;">
                                <div class="ant-col-13" style="padding-left: 16px; padding-right: 16px;">
                                    <div class="ant-row ant-form-item">
                                        <div class="ant-col-24 ant-form-item-label">
                                            <label for="title" class="ant-form-item-required" title="行程标题">行程标题</label>
                                        </div>
                                        <div class="ant-col-24 ant-form-item-control-wrapper">
                                            <div class="ant-form-item-control has-success">
												<span class="ant-form-item-children">
													<input v-model="project.title" placeholder="请输入..." maxlength="30" type="text" id="title" class="ant-input" value="">
												</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ant-row ant-form-item">
                                        <div class="ant-col-24 ant-form-item-label">
                                            <label for="depart" class="" title="出行日期">出行日期</label>
                                        </div>
                                        <div class="ant-col-24 ant-form-item-control-wrapper">
                                            <el-date-picker v-model="project.startTime" type="date" placeholder="选择日期">
                                            </el-date-picker>
                                        </div>
                                    </div>
                                    <div class="ant-row ant-form-item">
                                        <div class="ant-col-24 ant-form-item-label">
                                            <label for="days" class="" title="行程天数">行程天数</label>
                                        </div>
                                        <div class="ant-col-24 ant-form-item-control-wrapper">
                                            <el-input-number v-model="project.dayNum" controls-position="right" :min="1"></el-input-number>
                                        </div>
                                    </div>
                                    <div class="ant-row ant-form-item formItemGroup">
                                        <div class="ant-col-24 ant-form-item-label">
                                            <label class="" title="出发与返回（城市）">出发与返回（城市）</label>
                                        </div>
                                        <div class="ant-col-24 ant-form-item-control-wrapper">
                                            <div class="ant-form-item-control">
												<span class="ant-form-item-children">
													<div class="ant-row" style="margin-left: -12px; margin-right: -12px;">
														<div class="ant-col-12" style="padding-left: 12px; padding-right: 12px;">
															<div class="ant-row ant-form-item">
																<div class="ant-form-item-control-wrapper">
																	<div class="ant-form-item-control">
																		<span class="ant-form-item-children">
																			<div class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled">
																				<div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
																					<div class="ant-select-selection__rendered">
																						<ul>
																							<li class="ant-select-search ant-select-search--inline">
																								<div class="ant-select-search__field__wrap">
																									<span class="ant-select-search__field ant-input-affix-wrapper">
																										<span class="ant-input-prefix">
																											<i aria-label="图标: location" class="anticon anticon-location">
																												<img src="/lushu/static/svg/icon-25.svg" style="width: 1rem;height: 1rem">
																											</i>
																										</span>
																										<input placeholder="出发城市" type="text" class="ant-input" v-model="project.startCity_value">
																										<span class="ant-input-suffix"></span>
																									</span>
																									<span class="ant-select-search__field__mirror">&nbsp;</span>
																								</div>
																							</li>
																						</ul>
																					</div>
																					<span class="ant-select-arrow" unselectable="on" style="user-select: none;">
																						<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                                                                                            <img src="/lushu/static/svg/icon-25.svg" style="width: 1rem;height: 1rem">
																						</i>
																					</span>
																				</div>
																			</div>
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="ant-col-12" style="padding-left: 12px; padding-right: 12px;">
															<div class="ant-row ant-form-item">
																<div class="ant-form-item-control-wrapper">
																	<div class="ant-form-item-control">
																		<span class="ant-form-item-children">
																			<div class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled">
																				<div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
																					<div class="ant-select-selection__rendered">
																						<ul>
																							<li class="ant-select-search ant-select-search--inline">
																								<div class="ant-select-search__field__wrap">
																									<span class="ant-select-search__field ant-input-affix-wrapper">
																										<span class="ant-input-prefix">
																											<i aria-label="图标: location" class="anticon anticon-location">
                                                                                                                <img src="/lushu/static/svg/icon-25.svg" style="width: 1rem;height: 1rem">
																											</i>
																										</span>
																										<input placeholder="返回城市" type="text" class="ant-input" v-model="project.endCity_value">

																										<span class="ant-input-suffix"></span>
																									</span>
																									<span class="ant-select-search__field__mirror">&nbsp;</span>
																								</div>
																							</li>
																						</ul>
																					</div>
																					<span class="ant-select-arrow" unselectable="on" style="user-select: none;">
																						<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
                                                                                            <img src="/lushu/static/svg/icon-25.svg" style="width: 1rem;height: 1rem">
																						</i>
																					</span>
																				</div>
																			</div>
																		</span>
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
                                        <div class="ant-col-24 ant-form-item-label">
                                            <label for="memo" class="" title="">
                                                <div>备注信息<span class="ant-form-item-label-sub">（备注内容对用户不展示）</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="ant-col-24 ant-form-item-control-wrapper">
                                            <div class="ant-form-item-control">
												<span class="ant-form-item-children">
													<textarea v-model="project.content" rows="4" placeholder="请输入备注信息" id="memo" class="ant-input"></textarea>
												</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="ant-col-11" style="padding-left: 16px; padding-right: 16px;">
                                    <div class="tripMeta__cover___1s4Ej" v-on:click="upFile2">
										<span class="widgets__lushuBackgroundImage___3XMmZ"   >
											<div class="widgets__noImgCont___blaq6" id="img2" v-if="!project.url">
												<i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 128px;">
                                                    <img src="/lushu/static/svg/icon-97.svg" style="width: 5rem;height: 5rem">
												</i>
												<div>点击上传路书封面</div>
											</div>
                                            <div v-if="project.url" class="widgets__noImgCont___blaq6" id="img3" style="width: 100%;height: 100%">
                                                <img :src="project.url"   style="width: 100%;height: 100%;">
											</div>
										</span>
                                        <div class="tripMeta__uploadHint___oiu6Y">
                                            <div class="tripMeta__icon___2V1-V">
                                                <i aria-label="图标: camera" class="anticon anticon-camera">
                                                    <img src="/lushu/static/svg/icon-98.svg" style="width: 2rem;height: 2rem">
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="tripMeta__editSerial___2cky_">路书编号:
                            <input maxlength="20" class="ant-input ant-input-sm tripMeta__serialInput___3JQdB" type="text" v-model="project.IDCard">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
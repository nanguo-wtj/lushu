<div id="Copy_project" style="display: none;position: absolute">
    <div>
        <div class="ant-modal-mask"></div>
        <div tabindex="-1" class="ant-modal-wrap ant-modal-centered" role="dialog" aria-labelledby="rcDialogTitle4" style="">
            <div role="document" class="ant-modal modalOrderPage" style="width: 472px; transform-origin: 546px 295.6px;">
                <div tabindex="0" style="width: 0px; height: 0px; overflow: hidden;">sentinelStart</div>
                <div class="ant-modal-content">
                    <button aria-label="Close" class="ant-modal-close" onclick="$('#Copy_project').hide();">
						<span class="ant-modal-close-x">
							<i aria-label="图标: close" class="anticon anticon-close ant-modal-close-icon">
								 <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
							</i>
						</span>
                    </button>
                    <div class="ant-modal-header">
                        <div class="ant-modal-title" id="rcDialogTitle4">复制出行项目</div>
                    </div>
                    <div class="ant-modal-body">
                            <div class="ant-row ant-form-item">
                                <div class="ant-form-item-label">
                                    <label for="title" class="" title="">
                                        <span class="createProjectModal__tripTitle___3_s8W">项目标题：</span>
                                    </label>
                                </div>
                                <div class="ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control has-success">
										<span class="ant-form-item-children">
											<input placeholder="请输入项目标题" v-model="Copy_data.title" maxlength="24" type="text" id="title" data-__meta="[object Object]" data-__field="[object Object]" class="ant-input" value="2024/04/02-15:16 葛云峰1创建">
										</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="ant-row ant-form-item">
                                    <div class="ant-form-item-label">
                                        <label for="modules" class="" title="">
                                            <span class="createProjectModal__cloneWord___1Z9QS">选择要复制的项目内容</span>
                                        </label>
                                    </div>
                                    <div class="ant-form-item-control-wrapper">
                                        <div class="ant-form-item-control has-success">
											<span class="ant-form-item-children">
												<div class="ant-checkbox-group" id="modules" data-__meta="[object Object]" data-__field="[object Object]" style="width: 100%;">
													<div class="ant-row">
														<div class="ant-col-6">
															<label class="ant-checkbox-wrapper" v-on:click="Copy_project_type(1)">
																<span :class="Copy_data.demand == true ?  'ant-checkbox ant-checkbox-checked':'ant-checkbox '">
																	<span class="ant-checkbox-inner"></span>
																</span>
																<span>项目需求</span>
															</label>
														</div>
														<div class="ant-col-6">
															<label class="ant-checkbox-wrapper ant-checkbox-wrapper-checked" v-on:click="Copy_project_type(2)">
																<span :class="Copy_data.make == true ?  'ant-checkbox ant-checkbox-checked':'ant-checkbox '">
																	<span class="ant-checkbox-inner"></span>
																</span>
																<span>行程制作</span>
															</label>
														</div>
														<div class="ant-col-6">
															<label class="ant-checkbox-wrapper ant-checkbox-wrapper-disabled" v-on:click="Copy_project_type(3)">
																<span id="CopyCost" :class="Copy_data.cost == true ?  'ant-checkbox ant-checkbox-checked':'ant-checkbox '">
																	<span class="ant-checkbox-inner"></span>
																</span>
																<span>费用核算</span>
															</label>
														</div>
														<div class="ant-col-6">
															<label class="ant-checkbox-wrapper ant-checkbox-wrapper-disabled" v-on:click="Copy_project_type(4)">
																<span id="CopyQuotation" :class="Copy_data.quotation == true ?  'ant-checkbox ant-checkbox-checked':'ant-checkbox '">
																	<span class="ant-checkbox-inner"></span>
																</span>
																<span>行程报价</span>
															</label>
														</div>
													</div>
												</div>
											</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ant-row ant-form-item createProjectModal__inquiryButton___2lx9S">
                                    <div class="ant-form-item-control-wrapper">
                                        <div class="ant-form-item-control">
											<span class="ant-form-item-children">
												<button v-on:click="Copy_Post" type="button" class="ant-btn ant-btn-primary ant-btn-lg ant-btn-block">
													<span>复制</span>
												</button>
											</span>
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
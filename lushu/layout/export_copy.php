<!-- 复制 -->
<div class="copy" style="display: none;">
    <div class="ant-modal-mask"></div>
    <div tabindex="-1" class="ant-modal-wrap ant-modal-centered" role="dialog" aria-labelledby="rcDialogTitle0" style="">
        <div role="document" class="ant-modal modalOrderPage" style="width: 420px; transform-origin: 969px -280.906px;">
            <div tabindex="0" style="width: 0px; height: 0px; overflow: hidden;">sentinelStart</div>
            <div class="ant-modal-content">
                <button aria-label="Close" class="ant-modal-close">
					<span class="ant-modal-close-x" onclick="$('.copy').css('display', 'none')">
						<i aria-label="图标: close" class="anticon anticon-close ant-modal-close-icon">
							<svg viewBox="64 64 896 896" class="" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
								<path d="M576.36 512l235.13-235.11a45.51 45.51 0 1 0-64.34-64.39L512 447.64 276.85 212.5a45.51 45.51 0 1 0-64.33 64.39L447.64 512 212.52 747.11a45.51 45.51 0 0 0 64.33 64.39L512 576.36 747.15 811.5a45.51 45.51 0 1 0 64.34-64.39z">
								</path>
							</svg>
						</i>
					</span>
                </button>
                <div class="ant-modal-header">
                    <div class="ant-modal-title" id="rcDialogTitle0">复制行程</div>
                </div>
                <div class="ant-modal-body">
                    <form class="ant-form ant-form-vertical">
                        <div class="ant-row ant-form-item cloneTemplateModal__label___3Rk_X">
                            <div class="ant-form-item-label">
                                <label for="name" class="ant-form-item-required" title="请输入线路名称">请输入线路名称</label>
                            </div>
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control has-success">
									<span class="ant-form-item-children">
										<input type="text" id="name" v-model="copy_data.title"   class="ant-input" value="">
									</span>
                                </div>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item cloneTemplateModal__label___3Rk_X">
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control has-success">
									<span class="ant-form-item-children">
										<label class="ant-checkbox-wrapper">
											<span class="ant-checkbox" onclick="check()">
												<input id="quote" type="checkbox" class="ant-checkbox-input" value="true">
												<span class="ant-checkbox-inner"></span>
											</span>
											<span>复制报价</span>
										</label>
									</span>
                                </div>
                            </div>
                        </div>
                        <div class="ant-row ant-form-item">
                            <div class="ant-form-item-control-wrapper">
                                <div class="ant-form-item-control">
									<span class="ant-form-item-children">
										<button type="button" v-on:click="ExportCopy" class="ant-btn cloneTemplateModal__button___1Wn4d ant-btn-primary">
											<span>确认复制</span>
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
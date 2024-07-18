<!-- 备注 -->
<div class="edit_mark" id="project_notes" style="display: none;">
    <div>
        <div class="ant-modal-mask"></div>
        <div tabindex="-1" class="ant-modal-wrap ant-modal-centered" role="dialog" aria-labelledby="rcDialogTitle0" style="">
            <div role="document" class="ant-modal modalOrderPage" style="width: 400px; height: 342px; transform-origin: 959px
            67.5px;">
                <div tabindex="0" style="width: 0px; height: 0px; overflow:
              hidden;">sentinelStart</div>
                <div class="ant-modal-content">
                    <button aria-label="Close" onclick="$('.edit_mark').css('display', 'none')" class="ant-modal-close">
						<span class="ant-modal-close-x">
							<i aria-label="图标: close" class="anticon anticon-close ant-modal-close-icon">
								<svg viewBox="64 64 896 896" class="" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
									<path d="M576.36 512l235.13-235.11a45.51 45.51 0 1
                        0-64.34-64.39L512 447.64 276.85 212.5a45.51 45.51 0 1
                        0-64.33 64.39L447.64 512 212.52 747.11a45.51 45.51 0 0 0
                        64.33 64.39L512 576.36 747.15 811.5a45.51 45.51 0 1 0
                        64.34-64.39z">
									</path>
								</svg>
							</i>
						</span>
                    </button>
                    <div class="ant-modal-header">
                        <div class="ant-modal-title" id="rcDialogTitle0">备注</div>
                    </div>
                    <div class="ant-modal-body">
                        <form class="ant-form ant-form-horizontal
                  logTimeline__addMemoModal___1IBNF">
                            <span class="logTimeline__addMemo___18trs">请添加备注</span>
                            <div class="ant-row ant-form-item">
                                <div class="ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control has-success">
										<span class="ant-form-item-children">
											<textarea rows="4" maxlength="100" class="ant-input
                            logTimeline__textarea___2r89P" placeholder="请输入...(限100字)" id="memo"></textarea>
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="logTimeline__footer___CDQbD">
                                <button type="button" onclick="del_mark()" class="ant-btn ant-btn-dangerBorder del-mark">
                                    <span>删除</span>
                                </button>
                                <span class="logTimeline__rightButtons___138-m">
									<button type="button" class="ant-btn logTimeline__button___zkGi6" onclick="$('.edit_mark').css('display', 'none')">
										<span>取消</span>
									</button>
									<button type="button" class="ant-btn ant-btn-primary" onclick="sure_mark()">
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
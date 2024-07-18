<div id="Highlights_details" style="display: none;position: absolute">
    <div class="ant-drawer ant-drawer-right ant-drawer-open">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 544px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">行程亮点</div>
                        <div class="ant-drawer-right-actions">

                            <button onclick="$('#Highlights_details').hide()" aria-label="Close" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="editKeypoint__container___UddNb">
                            <div class="editKeypoint__leftElt___2SGBy">
								<span class="">
									<div class="ant-upload ant-upload-select ant-upload-select-text">
										<span tabindex="0" class="ant-upload" role="button">
											<div class="keypointUploader__coverContainer___1E0Eu" style="width: 440px; height: 440px;">
												<div class="keypointUploader__cover____bPP9">
													<span class="keypointUploader__roundCorner___3uvBN widgets__lushuBackgroundImage___3XMmZ" :style="'background-image:url('+details_trip.picture+');'"></span>
												</div>


											</div>
										</span>
									</div>
								</span>
                                <div class="editKeypoint__titleSection___3MWwM">
                                    <form class="ant-form ant-form-vertical">
                                        <div class="ant-row ant-form-item">
                                            <div class="ant-form-item-label">
                                                <label class="" title="">
                                                    <span class="editKeypoint__title___1QlYV">亮点标题：</span>
                                                </label>
                                            </div>
                                            <div class="ant-form-item-control-wrapper">
                                                <div class="ant-form-item-control">
													<span class="ant-form-item-children">
                                                        {{details_trip.name}}
													</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="editKeypoint__descriptionSection___1cgW5">
                                    <div class="editKeypoint__title___1QlYV">亮点说明：</div>
                                    <form class="ant-form ant-form-horizontal">
                                        <div class="ant-row ant-form-item">
                                            <div class="ant-form-item-control-wrapper">
                                                <div class="ant-form-item-control">
													<span class="ant-form-item-children">
														{{details_trip.notes}}
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
        </div>
    </div>
</div>
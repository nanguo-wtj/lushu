<div class="addNode" style="display: none;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 1024px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">新建笔记</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" onclick="$('.addNode').css('display', 'none')" class="ant-btn ant-btn-primary">
                                    <span>保存</span>
                                </button>
                            </div>
                            <button aria-label="Close" onclick="$('.addNode').css('display', 'none')" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <svg viewBox="64 64 896 896" class="" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
                                        <path d="M576.36 512l235.13-235.11a45.51 45.51 0 1 0-64.34-64.39L512 447.64 276.85 212.5a45.51 45.51 0 1 0-64.33 64.39L447.64 512 212.52 747.11a45.51 45.51 0 0 0 64.33 64.39L512 576.36 747.15 811.5a45.51 45.51 0 1 0 64.34-64.39z">
                                        </path>
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <div class="editCard__container___2uGfQ">
                            <div class="editCard__leftElt___2hQ9l">
                                <div>
                                    <input class="ant-input editCard__input___3nw1G" placeholder="笔记标题" maxlength="64" type="text" value="">
                                </div>
                                <div>
                                    <div>
                                        <div class="editor__piecefulEditor___QSJXD
                      addTripRichText__richEditor___3AXgH">
                                            <!-- 富文本 -->
                                            <!-- 头 -->
                                            <div class="editor__editorActions___3V13t
                        addTripRichText__richEditorActionBar___UDF6g" id="div3">

                                            </div>
                                            <!-- 内容 -->
                                            <div class="editor__richContent___x93pI fr-box fr-top
                        fr-basic" id="div4">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="editCard__rightElt___lh4VN">
                                <div class="editCard__section___FNi4H">
                                    <div class="editCard__subHeader___2GCgN">相关地点</div>
                                    <div class="relateToNewPoi__pois___31qlJ">
                                        <button type="button" onclick="addNewPoi()" class="ant-btn relateToNewPoi__ralateBtn___33CKG">
                                            <span>关联POI</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="editCard__section___FNi4H">
                                    <div class="editCard__subHeader___2GCgN">相关目的地</div>
                                    <div class="relatedDestinationList__relatedDestinationList___v4lHw">
                                        <form class="ant-form ant-form-horizontal">
                                            <div class="destinationAutoComplete__container___2u6IR destinationAutoComplete__hasBorder___3-Prs">
                                                <div class="ant-row ant-form-item">
                                                    <div class="ant-form-item-control-wrapper">
                                                        <div class="ant-form-item-control">
																<span class="ant-form-item-children">
																	<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
																		<div class="ant-select-selection
            ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="628fea43-6a5c-42dd-ad81-b7ecd7f42ea6" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
																			<div class="ant-select-selection__rendered">
																				<ul>
																					<li class="ant-select-search ant-select-search--inline">
																						<div class="ant-select-search__field__wrap">
																							<span class="ant-select-search__field ant-input-affix-wrapper">
																								<span class="ant-input-prefix">
																									<i aria-label="图标: location" class="anticon anticon-location destinationAutoComplete__icon___2aPbK">
																										<svg viewBox="64 64 896 896" class="" data-icon="location" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																											<path d="M768.72 189.47c-141.55-141.55-371.89-141.55-513.44 0s-141.53 371.84 0 513.39l224.53 224.5a45.48 45.48 0 0 0 64.34 0l224.55-224.5c141.55-141.55 141.55-371.86.02-513.39zm-64.36 449.06L512 830.86 319.67 638.53c-106.09-106.06-106.09-278.67 0-384.72a272 272 0 0 1 384.66 0c106.09 106.05 106.09 278.66.03 384.72z">
																											</path>
																											<path d="M512.47 288.81c-96.69 0-175.36 78.66-175.36 175.33s78.67 175.39 175.36 175.39 175.36-78.67 175.36-175.39-78.66-175.33-175.36-175.33zm0 259.72a84.36 84.36 0 1 1 84.36-84.39 84.5 84.5 0 0 1-84.36 84.39z">
																											</path>
																										</svg>
																									</i>
																								</span>
																								<input class="ant-input ant-input-dark" placeholder="搜索目的地" type="text" value="">
																							</span>
																							<span class="ant-select-search__field__mirror">&nbsp;</span>
																						</div>
																					</li>
																				</ul>
																			</div>
																			<span class="ant-select-arrow" unselectable="on" style="user-select: none;">
																				<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
																					<svg viewBox="64 64 896 896" class="" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																						<path d="M153.62 360.52a45.49 45.49 0 0 1 77.17-32.7l281.28 272.39L793.29 329a45.52 45.52 0 1 1 63.22 65.5L543.62 696.24a45.53 45.53 0 0 1-63.27-.06l-312.89-303a45.33 45.33 0 0 1-13.84-32.66z">
																						</path>
																					</svg>
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
                                    </div>
                                </div>
                                <div class="editCard__section___FNi4H editCard__tags___1c7XZ">
                                    <div class="editCard__subHeader___2GCgN">标签</div>
                                    <div>
                                        <div class="relatedTagList relatedItemList clear tosProjectCssMarker">
                                            <div class="btnCube">
                                                <i class="iconTag icon-tag2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="editCard__section___FNi4H">
                                    <div class="editCard__subHeader___2GCgN">笔记封面</div>
                                    <span class="">
											<div class="ant-upload ant-upload-select ant-upload-select-text">
												<span tabindex="0" class="ant-upload" role="button">
													<input type="file" accept="image/bmp,image/jpeg,image/jpg,image/gif,image/png" style="display: none;">
													<div class="pictureUploader__coverContainer___1lm-8" style="width: 256px; height: 192px;">
														<div class="pictureUploader__cover___MOiqv">
															<span class="pictureUploader__roundCorner___3J8rd widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
																<div class="widgets__noImgCont___blaq6">
																	<i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 77px;">
																		<svg viewBox="64 64 896 896" class="" data-icon="picture" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																			<path d="M349.22 579.27l-51.7-67.55a29.39 29.39 0 0 0-46.49-.24L73.56 738.43a29.4 29.4 0 0 0 23.36 47.5l153.97-1.1c-5.96-8.41-10.52-17.67-11.98-28.18a64.81 64.81 0 0 1 12.6-48.3zm600.25 142.21L646.1 311.89a36.75 36.75 0 0 0-58.83-.3L274.16 725.6a36.74 36.74 0 0 0 29.57 58.9l616.47-4.37a36.74 36.74 0 0 0 29.27-58.61zM281.62 394.22a78.08 78.08 0 1 0-78.72-77.49 78.1 78.1 0 0 0 78.72 77.5z">
																			</path>
																		</svg>
																	</i>
																</div>
															</span>
														</div>
														<div class="pictureUploader__mask___4A-xD" onclick="upFile(this)">
															<div class="pictureUploader__camera___2an34">
																<i aria-label="图标: camera" class="anticon anticon-camera pictureUploader__cameraIcon___2Pcwp">
																	<svg viewBox="64 64 896 896" class="" data-icon="camera" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																		<path d="M837.94 239.58H729a14.47 14.47 0 0 1-12.61-7.39L687 179.86a98.37 98.37 0 0 0-85.5-49.94H420.83a98.3 98.3 0 0 0-85.5 50l-29.39 52.3a14.49 14.49 0 0 1-12.61 7.36H186.06A115.4 115.4 0 0 0 70.78 354.86v446.7a115.42 115.42 0 0 0 115.28 115.27h651.88a115.42 115.42 0 0 0 115.28-115.27v-446.7a115.4 115.4 0 0 0-115.28-115.28zm24.28 562a24.3 24.3 0 0 1-24.28 24.27H186.06a24.3 24.3 0 0 1-24.28-24.27V354.86a24.3 24.3 0 0 1 24.28-24.28h107.27a105.59 105.59 0 0 0 91.95-53.77l29.39-52.23a7 7 0 0 1 6.16-3.66H601.5a7.11 7.11 0 0 1 6.17 3.61l29.39 52.25a105.54 105.54 0 0 0 91.94 53.8h108.94a24.3 24.3 0 0 1 24.28 24.28z">
																		</path>
																		<path d="M505.06 355.42c-111.73 0-202.56 90.86-202.56 202.58s90.83 202.5 202.56 202.5S707.61 669.67 707.61 558s-90.83-202.58-202.55-202.58zm0 314.08A111.54 111.54 0 1 1 616.61 558a111.7 111.7 0 0 1-111.55 111.5z">
																		</path>
																	</svg>
																</i>
															</div>
														</div>
													</div>
												</span>
											</div>
										</span>
                                </div>
                            </div>
                        </div>
                        <div class="slideDownMap editLocationMap tosProjectCssMarker">
                            <div class="mapContent">
                                <div class="editLocations">
                                    <div class="poiShortcuts"></div>
                                </div>
                                <a href="javascript:void(0)" class="closeMapBtn">
                                    <i class="icon-close"></i>
                                </a>
                            </div>
                            <div>
                                <div class="showMapTransition"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

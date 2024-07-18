<!-- 新增 -->
<div class="add" id="trip_add" style="display: none;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 824px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">新建行程亮点</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" v-on:click="post_trip" class="ant-btn ant-btn-primary">
									<span>保存</span>
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
                        <div class="editKeypoint__container___UddNb">
                            <div class="editKeypoint__leftElt___2SGBy">
								<span class="">
									<div class="ant-upload ant-upload-select ant-upload-select-text">
										<span tabindex="0" class="ant-upload" role="button">
                                            <input type="hidden" id="picture" value="" >
											<input type="file" accept="image/bmp,image/jpeg,image/jpg,image/gif,image/png" style="display: none;">
											<div class="keypointUploader__coverContainer___1E0Eu" style="width: 440px; height: 440px;">
												<div class="keypointUploader__cover____bPP9" id="img1">
													<span class="keypointUploader__roundCorner___3uvBN widgets__lushuBackgroundImage___3XMmZ widgets__noImg___CsB0Z">
														<div class="widgets__noImgCont___blaq6">
															<i aria-label="图标: picture" class="anticon anticon-picture" style="font-size: 176px;">
																<svg viewBox="64 64 896 896" class="" data-icon="picture" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																	<path d="M349.22 579.27l-51.7-67.55a29.39 29.39 0 0 0-46.49-.24L73.56 738.43a29.4 29.4 0 0 0 23.36 47.5l153.97-1.1c-5.96-8.41-10.52-17.67-11.98-28.18a64.81 64.81 0 0 1 12.6-48.3zm600.25 142.21L646.1 311.89a36.75 36.75 0 0 0-58.83-.3L274.16 725.6a36.74 36.74 0 0 0 29.57 58.9l616.47-4.37a36.74 36.74 0 0 0 29.27-58.61zM281.62 394.22a78.08 78.08 0 1 0-78.72-77.49 78.1 78.1 0 0 0 78.72 77.5z">
																	</path>
																</svg>
															</i>
															<div>
																<div>请尽量上传高清图片
																	<br>（建议800px*800px像素以上）</div>
															</div>
														</div>
													</span>
												</div>
												<div class="keypointUploader__mask___1TaC2">
													<div class="keypointUploader__camera___31y4_" onclick="upFile(this)">
														<i aria-label="图标: camera" class="anticon anticon-camera keypointUploader__cameraIcon___2JoUj">
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
														<input placeholder="请输入（限15字）" v-model="project_trip_data.title" maxlength="15" type="text" class="ant-input" value="">
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
														<textarea placeholder="请输入...(限300字)"  v-model="project_trip_data.content" maxlength="300" rows="4" class="ant-input"></textarea>
													</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="editKeypoint__characters___2IlrW">
                                        <span>0</span>
                                        <span>/300</span>
                                    </div>
                                </div>
                            </div>
                            <div class="editKeypoint__rightElt___1rDVJ">
                                <div class="editKeypoint__section___3460D">
                                    <div class="editKeypoint__subHeader___20fyZ">相关地点</div>


                                    <div class="relateToNewPoi__poiItem___1v0TJ"  v-for="(item,index) in project_trip_data.association" :key="index" >
                                        <div class="relateToNewPoi__pre___2xuDR">
                                            <i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4 relateToNewPoi__poiType___2OY1I">
                                                <img src="/lushu/static/svg/icon-29.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                            <div class="relateToNewPoi__poiName___2ynr4"> {{item.value}}</div>
                                            <i aria-label="图标: close-circle" v-on:click="Del_poi(item.id,index)" tabindex="-1" class="anticon anticon-close-circle relateToNewPoi__delete____5Ts9">
                                                <img src="/lushu/static/svg/icon-30.svg" style="width: 1rem;height: 1rem">
                                            </i>
                                        </div>
                                    </div>
                                    <div class="relateToNewPoi__pois___31qlJ">
                                        <button type="button" onclick="$('.modalWrap').css('display','block')" class="ant-btn relateToNewPoi__ralateBtn___33CKG">
                                            <span>关联POI</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="editKeypoint__section___3460D">
                                    <div class="editKeypoint__subHeader___20fyZ">相关目的地</div>
                                    <div class="relatedDestinationList__relatedDestinationList___v4lHw">
                                        <div>
                                            <div class="relatedTagList relatedItemList clear tosProjectCssMarker">
                                                <div class="item"  v-for="item in project_trip_data.address_code" :key="item.id">
                                                    <div class="name">{{item.value}}</div>
                                                    <span class="removeBtn">
                                                    <i class="icon-minus" v-on:click="del_city(item)"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="ant-form ant-form-horizontal">
                                            <div class="destinationAutoComplete__container___2u6IR destinationAutoComplete__hasBorder___3-Prs">
                                                <div class="ant-row ant-form-item">
                                                    <div class="ant-form-item-control-wrapper">
                                                        <div class="ant-form-item-control">
															<span class="ant-form-item-children">
																<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
																	<div class="ant-select-selection
            ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="f6ad92b4-2ebf-41fe-e01f-e6fd8bb4eb5c" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
																		<div class="ant-select-selection__rendered">
																			<ul>
																				<li class="ant-select-search ant-select-search--inline">
																					<div class="ant-select-search__field__wrap">
																						<span class="ant-select-search__field ant-input-affix-wrapper">
																							<span class="ant-input-prefix">
																								<i aria-label="图标: location" class="anticon anticon-location destinationAutoComplete__icon___2aPbK">
																									<img src="/lushu/static/svg/icon-25.svg" style="width: 1rem;height: 1rem">
																								</i>
																							</span>
																							<input class="ant-input ant-input-dark" placeholder="搜索目的地"  @input="search_city(1)" v-model="project_city" type="text" value="">
																						</span>
																						<span class="ant-select-search__field__mirror">&nbsp;</span>
                                                                                        <div class="city_body" v-if="city_list1_status">
                                                                                            <div class="city_list" v-for="item in city_list1.city" :key="item.id" v-on:click="add_city(item,1)">
                                                                                                <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                            </div>
                                                                                            <div class="city_user" v-if="city_list1.user.length > 0">以下为用户创建内容</div>
                                                                                            <div class="city_list"  v-for="item in city_list1.user" :key="item.id" v-on:click="add_city(item,1)">
                                                                                                 <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                                <div class="city_icon">
                                                                                                    <img src="/lushu/static/svg/icon-15.svg" style="width: 1rem;height: 1rem">
                                                                                                </div>
                                                                                            </div>
                                                                                         </div>
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
                            </div>
                        </div>
                        <div class="slideDownMap editLocationMap tosProjectCssMarker">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- 选择poi -->
<?php include(dirname(__FILE__,2) . '/layout/project_select_poi.php');?>
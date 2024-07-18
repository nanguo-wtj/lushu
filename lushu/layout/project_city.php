<div class="add" id="city_add" style="display: none;">
    <div class="ant-drawer ant-drawer-right ant-drawer-open" style="">
        <div class="ant-drawer-mask"></div>
        <div class="ant-drawer-content-wrapper" style="width: 602px;">
            <div class="ant-drawer-content">
                <div class="ant-drawer-wrapper-body" style="overflow: auto; height: 100%;">
                    <div class="ant-drawer-header">
                        <div class="ant-drawer-title">新建城市</div>
                        <div class="ant-drawer-right-actions">
                            <div class="ant-drawer-actions">
                                <button type="button" v-on:click="add_city" class="ant-btn ant-btn-primary">
									<span>保存</span>
                                </button>
                            </div>
                            <button onclick="$('.add').css('display', 'none')" aria-label="Close" class="ant-drawer-close">
                                <i aria-label="图标: close" class="anticon anticon-close">
                                    <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="ant-drawer-body">
                        <form class="ant-form ant-form-horizontal">
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-7 ant-form-item-label">
                                    <label for="name_cn" class="ant-form-item-required" title="城市中文名称">城市中文名称</label>
                                </div>
                                <div class="ant-col-17 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<input v-model="city_data.region_name" placeholder="请输入城市中文名称" maxlength="32" type="text" id="name_cn"  class="ant-input" value="">
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-7 ant-form-item-label">
                                    <label for="name_en" class="" title="城市英文名称">城市英文名称</label>
                                </div>
                                <div class="ant-col-17 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<input v-model="city_data.en_name" placeholder="请输入英文名称" maxlength="128" type="text" id="name_en"  class="ant-input" value="">
										</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item">
                                <div class="ant-col-7 ant-form-item-label">
                                    <label for="parent" class="ant-form-item-required" title="国家/地区">国家/地区</label>
                                </div>
                                <div class="ant-col-17 ant-form-item-control-wrapper">
                                    <div class="ant-form-item-control">
										<span class="ant-form-item-children">
											<form class="ant-form ant-form-horizontal">
												<div class="destinationAutoComplete__container___2u6IR editCity__cityInput___UNy3R">
													<div class="ant-row ant-form-item">
														<div class="ant-form-item-control-wrapper">
															<div class="ant-form-item-control">
																<span class="ant-form-item-children">
																	<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
																		<div class="ant-select-selection
            ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="40981477-c131-42e0-b6ac-a1ba3c45d35f" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
																			<div class="ant-select-selection__rendered">
																				<ul>
																					<li class="ant-select-search ant-select-search--inline">
																						<div class="ant-select-search__field__wrap">
																							<span class="ant-select-search__field ant-input-affix-wrapper">
																								<input class="ant-input" placeholder="搜索国家/地区" @input="search_city(1)" v-model="project_city" type="text" value="">
																							</span>
																							<span class="ant-select-search__field__mirror">&nbsp;</span>
                                                                                             <div class="city_body" v-if="city_list1_status">
                                                                                            <div class="city_list" v-for="item in city_list1.city" :key="item.id" v-on:click="add_address(item,1)">
                                                                                                <div class="city_name">{{item.region_name}}</div>
                                                                                                <div class="city_enname">{{item.en_name}}  {{item.parent.region_name}}</div>
                                                                                            </div>
                                                                                            <div class="city_user" v-if="city_list1.user.length > 0">以下为用户创建内容</div>
                                                                                            <div class="city_list"  v-for="item in city_list1.user" :key="item.id" v-on:click="add_address(item,1)">
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
										</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="editAddress__poiMap___38tZF">
                            <div class="map__piecefulMap___cY63A editAddress__editPoiMap___263OL">

                                <div class="map__mapBlock___2rphQ mapboxgl-map">
                                    <div style="height: 100%;" class="mapboxgl-canvas-container mapboxgl-interactive mapboxgl-touch-drag-pan mapboxgl-touch-zoom-rotate">
                                        <iframe src="layout/map_edit_poi.php"  id="map_edit" width="100%" height="100%"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="searchWrapS" style="z-index: 200;">
                                <form  @submit.prevent="search_address_map">
                                    <input type="submit" value="on" style="display: none">
                                    <div class="searchBar">
                                        <i aria-label="图标: search" tabindex="-1" class="anticon anticon-search">
                                            <img src="/lushu/static/svg/icon-16.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                        <input type="text" class="mapStr"    placeholder="请输入详细地址" v-model="city_data.address"  value="">
                                        <i aria-label="图标: close" tabindex="-1" class="anticon anticon-close" style="font-size: 10px; display: none;">
                                            <img src="/lushu/static/svg/icon-11.svg" style="width: 1rem;height: 1rem">
                                        </i>
                                    </div>
                                    <div class="traffic_body" style="top: 59px;left: 15px;width: 73%;" v-if="search_data.poi_list">
                                        <div class="traffic_list" v-for="(item,index) in search_data.poi_list" :key="index" v-on:click="add_poi_address(item)">
                                            <div class="city_name">{{item.name}}</div>
                                            <div class="city_enname">{{item.district}} </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="editAddress__tips___s0NrW">定位不准确？请拖动图标，移动到精确的位置。</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pageFilter__pageFilterRow___2A-U3 keypointLibrary__options___3msOP clear">
    <form class="ant-form ant-form-horizontal" @submit.prevent="search">
        <input type="submit" value="on" style="display: none">

        <span class="pageFilter__pageFilterCell___2PklM">
			<span class="ant-input-affix-wrapper" style="width:300px">
				<span class="ant-input-prefix">
					<i aria-label="图标: search" class="anticon anticon-search">
						<img src="/lushu/static/svg/icon-16.svg" style="width: 1rem;height: 1rem">
					</i>
				</span>
				<input type="text" v-model="resources_key.title" placeholder="搜索亮点标题" value="" class="ant-input ant-input-dark">
				<span class="ant-input-suffix"></span>
			</span>
		</span>
        <span class="pageFilter__pageFilterCell___2PklM">
			<div class="destinationAutoComplete__container___2u6IR poiList__queryInput___13z3V">
				<div class="ant-row ant-form-item">
					<div class="ant-form-item-control-wrapper">
						<div class="ant-form-item-control">
							<span class="ant-form-item-children">
								<div id="dest" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
									<div class="ant-select-selection ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
										<div class="ant-select-selection__rendered">
											<ul>
												<li class="ant-select-search ant-select-search--inline">
													<div class="ant-select-search__field__wrap">
														<span class="ant-select-search__field ant-input-affix-wrapper">
															<span class="ant-input-prefix">
																<i aria-label="图标: location" class="anticonanticon-location destinationAutoComplete__icon___2aPbK">
																	<img src="/lushu/static/svg/icon-17.svg" style="width: 1rem;height: 1rem">

																</i>
															</span>
															<input v-model="resources_key.address_value" @input="search_address" type="text" class="ant-input input-area ant-input-dark" placeholder="相关目的地" value="">
														</span>
														<div class="city_body" style="display: none;">
															<div class="city_list" v-for="item in city_address.city" :key="item.id" v-on:click="add_search_address(item,1)">
																<div class="city_name">{{item.region_name}}</div>
																<div class="city_enname">{{item.en_name}} {{item.parent.region_name}}</div>
															</div>
															<div class="city_user" v-if="city_address.user.length > 0">以下为用户创建内容</div>
															<div class="city_list" v-for="item in city_address.user" :key="item.id" v-on:click="add_search_address(item,1)">
																<div class="city_name">{{item.region_name}}</div>
																<div class="city_enname">{{item.en_name}} {{item.parent.region_name}}</div>
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
										<span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none">
											<i aria-label="图标: down" class="anticon anticon-down  ant-select-arrow-icon">
												<img src="/lushu/static/svg/icon-18.svg" style="width: 1rem;height: 1rem">
											</i>
										</span>
									</div>
								</div>
							</span>
						</div>
					</div>
				</div>
			</div>
		</span>

        <span class="pageFilter__pageFilterCell___2PklM">
			<div class="poiSimpleAutoComplete__container___3dzBa">
				<div class="ant-row ant-form-item">
					<div class="ant-form-item-control-wrapper">
						<div class="ant-form-item-control">
							<span class="ant-form-item-children">
								<div id="poi" class="ant-select-show-search ant-select-auto-complete ant-select ant-select-combobox ant-select-enabled ant-select-allow-clear">
									<div class="ant-select-selection
                                    ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="" aria-expanded="false" data-__meta="[object Object]" data-__field="[object Object]">
										<div class="ant-select-selection__rendered">
											<ul>
												<li class="ant-select-search ant-select-search--inline">
													<div class="ant-select-search__field__wrap">
														<span class="ant-select-search__field ant-input-affix-wrapper" style="width:300px" >
															<span class="ant-input-prefix">
																<i aria-label="图标: poi-method-4" class="anticon anticon-poi-method-4 poiSimpleAutoComplete__icon___3v5LA">
																	<svg viewbox="64 64 896 896" class="" data-icon="poi-method-4" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
																		<path d="M827.2 674.8H197.3c-26.5 0-50.9-13.2-65.5-35.3a78.2 78.2 0 0 1-6.5-74.1l155.6-361.3a77.8 77.8 0 0 1 60.5-46.5c27-4 53.7 6 71.4 26.9l151 178.5 72-59.7a78.47 78.47 0 0 1 63-17 78.22 78.22 0 0 1 54 36.6l141.3 232.7a78.3 78.3 0 0 1 1.3 79.1 78.01 78.01 0 0 1-68.2 40.1zM353 233.6h-.4c-.9.1-1.1.5-1.2 1L195.8 595.8c-.2.4-.3.8.1 1.5.5.7.9.7 1.3.7h629.9c.5 0 .9 0 1.4-.8s.2-1.2 0-1.6L687.2 362.9c-.1-.2-.4-.6-1.1-.7-.7-.1-1.1.2-1.3.3l-101.2 83.9a38.4 38.4 0 0 1-53.8-4.8L354.1 234.2c-.2-.3-.5-.6-1.1-.6zm307.3 99.3zm135.1 444.5H226.5c-18.9 0-34.1-15.3-34.1-34.1s15.3-34.1 34.1-34.1h568.9c18.9 0 34.1 15.3 34.1 34.1s-15.2 34.1-34.1 34.1zM737.6 870H284.4c-18.9 0-34.1-15.3-34.1-34.1s15.3-34.1 34.1-34.1h453.2c18.9 0 34.1 15.3 34.1 34.1S756.4 870 737.6 870z">
																		</path>
																	</svg>
																</i>
															</span>
															<input type="text" class="ant-input input-api ant-input-dark" v-model="resources_key.association_value" @input="search_association"   placeholder="相关POI" value="">
														</span>
                                                        <!--  -->
														<div id="poi_list" class="ant-select-dropdown ant-select-dropdown--single ant-select-dropdown-placement-bottomLeft ant-select-dropdown-hidden " style="width: 300px; left: 0px; top: 45px;">
															<div id="7aed36aa-0d92-48cc-c71d-1a0c5d1dbffc" style="overflow: auto; transform: translateZ(0px);">
																<ul role="listbox" class="ant-select-dropdown-menu  ant-select-dropdown-menu-root ant-select-dropdown-menu-vertical" tabindex="0">
																	<li role="option" v-for="(item,index) in association_list" :key="index"  :name="item.title" v-on:click="Set_search_association(item)" class="ant-select-dropdown-menu-item poiSimpleAutoComplete__optionContainer___U9aOS"  style="user-select: none;">
																		<div class="poiSimpleAutoComplete__name___TCRli">{{item.title}}</div>
																	</li>

																</ul>
															</div>
														</div>
														<span class="ant-select-search__field__mirror">&nbsp;</span>
													</div>
												</li>
											</ul>
										</div>
										<span class="ant-select-arrow" style="user-select:none;-webkit-user-select:none" unselectable="on">
											<i aria-label="图标: down" class="anticon anticon-down ant-select-arrow-icon">
												<svg viewbox="64 64 896 896" class="" data-icon="down" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false">
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
		</span>
    </form>

    <span class="pageFilter__pageFilterCell___2PklM pageFilter__right___ArpIX">
		<button type="button" onclick="$('.add').css('display','block')" class="ant-btn ant-btn-primary ant-btn-lg">
			<i aria-label="图标: plus" class="anticon anticon-plus">
				<img src="/lushu/static/svg/icon-22.svg" style="width: 1rem;height: 1rem">
			</i>
			<span>新建行程亮点</span>
		</button>
	</span>
</div>